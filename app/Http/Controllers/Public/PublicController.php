<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\Dokuemen;
use App\Models\News;
use App\Models\Pengurus;
use App\Models\Profile;
use App\Models\Rekening;

class PublicController extends Controller
{
    public function index()
    {
        $profile = Profile::with(['pillars'])->latest()->first();
        $news = News::whereNotNull('published_at')
            ->where('published_at', '<=', now())
            ->latest('published_at')
            ->limit(3)
            ->get();
        $programs = \App\Models\Program::active()
            ->ofType('infaq')
            ->withCount(['confirmedTransactions as total_donatur'])
            ->latest('is_featured')
            ->latest()
            ->get();

        return view('pages.public.index', compact('profile', 'news', 'programs'));
    }

    public function profile()
    {
        $profile = Profile::with(['missions', 'pillars'])->latest()->first();

        return view('pages.public.profil.profile', compact('profile'));
    }

    public function pengurus()
    {

        // Ambil pengurus aktif, dikelompokkan per periode terbaru
        $tahunSekarang = now()->year;

        $pengurusList = Pengurus::active()
            ->ordered()
            ->get()
            ->groupBy(fn($p) => "{$p->masa_khidmat_mulai}-{$p->masa_khidmat_selesai}");

        // Ambil no_sk dari pengurus pertama yang ada
        $noSk = Pengurus::active()->value('no_sk');

        // Data untuk periode aktif (tampil di halaman publik)
        $periodeAktif = Pengurus::active()
            ->selectRaw('CONCAT(masa_khidmat_mulai, "-", masa_khidmat_selesai) as periode, masa_khidmat_mulai, masa_khidmat_selesai')
            ->orderByDesc('masa_khidmat_mulai')
            ->first();

        $pengurusByJabatan = Pengurus::active()
            ->when(
                $periodeAktif,
                fn($q) => $q
                    ->where('masa_khidmat_mulai', $periodeAktif->masa_khidmat_mulai)
                    ->where('masa_khidmat_selesai', $periodeAktif->masa_khidmat_selesai)
            )
            ->ordered()
            ->get()
            ->groupBy('jabatan');

        return view('pages.public.profil.pengurus', compact(
            'pengurusByJabatan',
            'periodeAktif',
            'noSk'
        ));
    }

    public function rekening()
    {
        $rekenings = Rekening::latest()->get();

        return view('pages.public.profil.rekeninglengkap', compact('rekenings'));
    }

    public function dokumen()
    {
        $dokumens = Dokuemen::latest()->get();

        return view('pages.public.profil.dokumen', compact('dokumens'));
    }

    public function pressrelease()
    {
        return view('pages.public.profil.pressrelease');
    }

    public function program()
    {
        $programUnggulan = \App\Models\Program::active()
            ->featured()
            ->withSum('confirmedTransactions as total_terkumpul', 'jumlah')
            ->withCount('confirmedTransactions as total_donatur')
            ->latest()
            ->first();

        $programs = \App\Models\Program::active()
            ->withSum('confirmedTransactions as total_terkumpul', 'jumlah')
            ->withCount('confirmedTransactions as total_donatur')
            ->latest()
            ->get();

        $donasiTerbaru = \App\Models\Transaction::where('status', 'confirmed')
            ->latest()
            ->take(5)
            ->get();

        return view('pages.public.program', compact('programs', 'programUnggulan', 'donasiTerbaru'));
    }

    public function laporanbulanan()
    {
        return view('pages.public.laporan.laporanbulanan');
    }

    public function laporantahunan()
    {
        return view('pages.public.laporan.laporantahunan');
    }

    public function statusmwcranting()
    {
        return view('pages.public.laporan.statusmwcranting');
    }

    public function kalkulatorzakat()
    {
        return view('pages.public.kalkulatorzakat');
    }

    public function donasi()
    {
        return view('pages.public.pembayaran.donasi');
    }

    public function infaq()
    {
        return view('pages.public.pembayaran.infaq');
    }

    public function zakat()
    {
        return view('pages.public.pembayaran.zakat');
    }

    public function privasi()
    {
        return view('pages.public.privasi');
    }

    public function syarat()
    {
        return view('pages.public.syarat');
    }

    public function disclaimer()
    {
        return view('pages.public.disclaimer');
    }

    public function berita()
    {
        $query = \App\Models\News::with('category')
            ->where('published_at', '<=', now());

        // Filter by search
        if (request('search')) {
            $search = request('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                    ->orWhere('excerpt', 'like', "%{$search}%")
                    ->orWhere('content', 'like', "%{$search}%");
            });
        }

        // Filter by category
        if (request('category')) {
            $query->where('category_id', request('category'));
        }

        $news = $query->orderByDesc('published_at')->paginate(10);

        // Get all categories with count
        $allCategories = \App\Models\Category::withCount('news')
            ->orderBy('name')
            ->get();

        return view('pages.public.berita.index', compact('news', 'allCategories'));
    }
}
