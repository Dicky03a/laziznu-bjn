<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreQurbanPeriodRequest;
use App\Models\QurbanPeriod;

class QurbanPeriodController extends Controller
{
      public function index()
      {
            $periods = QurbanPeriod::withCount([
                  'registrations',
                  'registrations as confirmed_count' => fn($q) => $q->confirmed(),
                  'registrations as pending_count'   => fn($q) => $q->pending(),
            ])
                  ->withSum(['registrations as total_terkumpul' => fn($q) => $q->confirmed()], 'total_bayar')
                  ->latest()
                  ->paginate(10);

            return view('admin.qurban.periods.index', compact('periods'));
      }

      public function create()
      {
            return view('admin.qurban.periods.create');
      }

      public function store(StoreQurbanPeriodRequest $request)
      {
            $validated            = $request->validated();
            $validated['is_active'] = $request->boolean('is_active');

            $period = QurbanPeriod::create($validated);

            if ($period->is_active) {
                  $period->activate();
            }

            return redirect()
                  ->route('qurban.periods.index')
                  ->with('success', 'Periode qurban berhasil ditambahkan.');
      }

      public function edit(QurbanPeriod $period)
      {
            return view('admin.qurban.periods.create', compact('period'));
      }

      public function update(StoreQurbanPeriodRequest $request, QurbanPeriod $period)
      {
            $validated              = $request->validated();
            $validated['is_active'] = $request->boolean('is_active');

            $period->update($validated);

            if ($period->fresh()->is_active) {
                  $period->activate();
            }

            return redirect()
                  ->route('qurban.periods.index')
                  ->with('success', 'Periode qurban berhasil diperbarui.');
      }

      public function destroy(QurbanPeriod $period)
      {
            if ($period->registrations()->confirmed()->exists()) {
                  return back()->with('error', 'Tidak dapat menghapus periode yang memiliki registrasi terkonfirmasi.');
            }

            $period->delete();

            return redirect()
                  ->route('qurban.periods.index')
                  ->with('success', 'Periode berhasil dihapus.');
      }

      public function toggleActive(QurbanPeriod $period)
      {
            if (! $period->is_active) {
                  $period->activate();
            } else {
                  $period->update(['is_active' => false]);
            }

            return back()->with('success', 'Status periode diperbarui.');
      }
}
