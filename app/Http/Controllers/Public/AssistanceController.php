<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\AssistanceAttachment;
use App\Models\AssistanceRequest;
use App\Models\AssistanceRequirement;
use App\Models\Pillars;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AssistanceController extends Controller
{
    public function index()
    {
        $pillars = Pillars::orderBy('urutan')->get();

        return view('pages.public.assistance.index', compact('pillars'));
    }

    public function getRequirements($pillarId)
    {
        $requirements = AssistanceRequirement::where('pillar_id', $pillarId)->get();

        return response()->json($requirements);
    }

    public function store(Request $request)
    {
        $rules = [
            'pillar_id' => 'required|exists:pillars,id',
            'nik' => 'required|numeric|digits:16',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'description' => 'required|string',
        ];

        // Dynamic validation for requirements
        $requirements = AssistanceRequirement::where('pillar_id', $request->pillar_id)->get();
        $attributes = [];
        $messages = [];

        foreach ($requirements as $req) {
            $key = 'requirement_'.$req->id;
            $attributes[$key] = $req->name;
            $reqRules = [];

            if ($req->is_required) {
                $reqRules[] = 'required';
                $messages[$key.'.required'] = 'Field :attribute wajib diisi.';
            } else {
                $reqRules[] = 'nullable';
            }

            if ($req->type == 'file' || $req->type == 'image') {
                $reqRules[] = 'file';
                $reqRules[] = 'max:5120'; // 5MB (Will still be limited by PHP config)

                if ($req->type == 'image') {
                    // Using mimes for better control and adding webp
                    $reqRules[] = 'mimes:jpg,jpeg,png,webp';
                    $messages[$key.'.mimes'] = 'Field :attribute harus berupa gambar (JPG, PNG, atau WEBP).';
                    $messages[$key.'.image'] = 'Field :attribute harus berupa file gambar yang valid.';
                } else {
                    $reqRules[] = 'mimes:pdf,doc,docx,jpg,jpeg,png';
                    $messages[$key.'.mimes'] = 'Field :attribute harus berupa file dengan format: PDF, DOC, atau Gambar.';
                }

                $messages[$key.'.file'] = 'Field :attribute gagal diunggah. Pastikan ukuran file tidak terlalu besar.';
                $messages[$key.'.max'] = 'Ukuran file :attribute tidak boleh lebih dari 5MB.';
            } else {
                $reqRules[] = 'string';
            }

            $rules[$key] = implode('|', $reqRules);
        }

        $validated = $request->validate($rules, $messages, $attributes);

        $ticket = 'REQ-'.date('Ymd').'-'.strtoupper(Str::random(5));

        $assistanceRequest = AssistanceRequest::create([
            'ticket_number' => $ticket,
            'pillar_id' => $validated['pillar_id'],
            'nik' => $validated['nik'],
            'name' => $validated['name'],
            'phone' => $validated['phone'],
            'address' => $validated['address'],
            'description' => $validated['description'],
            'status' => 'pending',
        ]);

        foreach ($requirements as $req) {
            $key = 'requirement_'.$req->id;
            $value = $request->file($key) ?: $request->input($key);

            if ($request->hasFile($key)) {
                $path = $request->file($key)->store('assistance', 'public');
                $value = $path;
            }

            AssistanceAttachment::create([
                'assistance_request_id' => $assistanceRequest->id,
                'assistance_requirement_id' => $req->id,
                'value' => $value ?? '',
            ]);
        }

        return redirect()->route('assistance.success', $ticket);
    }

    public function success($ticket)
    {
        return view('pages.public.assistance.success', compact('ticket'));
    }

    public function check(Request $request)
    {
        $assistanceRequest = null;
        $searched = false;

        if ($request->has('ticket_number') && $request->has('nik')) {
            $request->validate([
                'ticket_number' => 'required|string',
                'nik' => 'required|numeric|digits:16',
            ]);

            $assistanceRequest = AssistanceRequest::where('ticket_number', $request->ticket_number)
                ->where('nik', $request->nik)
                ->with(['pillar', 'attachments.requirement'])
                ->first();

            $searched = true;
        }

        return view('pages.public.assistance.check', compact('assistanceRequest', 'searched'));
    }
}
