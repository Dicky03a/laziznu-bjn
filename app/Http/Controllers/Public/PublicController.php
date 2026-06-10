<?php

namespace App\Http\Controllers\Public;

use App\Http\Controllers\Controller;
use App\Models\DistributionProgram;
use App\Models\Dokuemen;
use App\Models\LaporanBulanan;
use App\Models\LaporanMwc;
use App\Models\LaporanTahunan;
use App\Models\News;
use App\Models\Pengurus;
use App\Models\Profile;
use App\Models\Rekening;

class PublicController extends Controller
{
    public function index()
    {
        $profile = \Illuminate\Support\Facades\Cache::remember('public_profile_latest', 3600, function () {
            return Profile::with(['pillars'])->latest()->first() ?? new Profile();
        });

        $news = \Illuminate\Support\Facades\Cache::remember('public_news_latest_3', 1800, function () {
            return News::whereNotNull('published_at')
                ->where('published_at', '<=', now())
                ->latest('published_at')
                ->limit(3)
                ->get();
        });

        $programs = \Illuminate\Support\Facades\Cache::remember('public_programs_latest_3', 1800, function () {
            return \App\Models\Program::active()
                ->ofType('infaq')
                ->withCount(['confirmedTransactions as total_donatur'])
                ->latest('is_featured')
                ->latest()
                ->limit(3)
                ->get();
        });

        return view('pages.public.index', compact('profile', 'news', 'programs'));
    }

    public function paymentInfo()
    {
        $rekenings = \App\Models\Rekening::all();

        return view('pages.public.paymentinfo', compact('rekenings'));
    }

    public function profile()
    {
        $profile = \Illuminate\Support\Facades\Cache::remember('public_profile_full', 3600, function () {
            return Profile::with(['missions', 'pillars'])->latest()->first() ?? new Profile();
        });

        return view('pages.public.profil.profile', compact('profile'));
    }

    public function pengurus()
    {
        if (! \Illuminate\Support\Facades\Cache::has('public_pengurus_periode_aktif')) {
            \Illuminate\Support\Facades\Cache::put('public_pengurus_periode_aktif', Pengurus::active()
                ->selectRaw('CONCAT(masa_khidmat_mulai, "-", masa_khidmat_selesai) as periode, masa_khidmat_mulai, masa_khidmat_selesai')
                ->orderByDesc('masa_khidmat_mulai')
                ->first(), 3600);
        }
        $periodeAktif = \Illuminate\Support\Facades\Cache::get('public_pengurus_periode_aktif');

        $pengurusByJabatan = \Illuminate\Support\Facades\Cache::remember('public_pengurus_by_jabatan', 3600, function () use ($periodeAktif) {
            return Pengurus::active()
                ->when(
                    $periodeAktif,
                    fn ($q) => $q
                        ->where('masa_khidmat_mulai', $periodeAktif->masa_khidmat_mulai)
                        ->where('masa_khidmat_selesai', $periodeAktif->masa_khidmat_selesai)
                )
                ->ordered()
                ->get()
                ->groupBy('jabatan');
        });

        if (! \Illuminate\Support\Facades\Cache::has('public_pengurus_no_sk')) {
            \Illuminate\Support\Facades\Cache::put('public_pengurus_no_sk', Pengurus::active()->value('no_sk'), 3600);
        }
        $noSk = \Illuminate\Support\Facades\Cache::get('public_pengurus_no_sk');

        return view('pages.public.profil.pengurus', compact(
            'pengurusByJabatan',
            'periodeAktif',
            'noSk'
        ));
    }

    public function rekening()
    {
        $rekenings = \Illuminate\Support\Facades\Cache::remember('public_rekenings_all', 3600, function () {
            return Rekening::latest()->get();
        });

        return view('pages.public.profil.rekeninglengkap', compact('rekenings'));
    }

    public function dokumen()
    {
        $dokumens = \Illuminate\Support\Facades\Cache::remember('public_dokumens_all', 3600, function () {
            return Dokuemen::latest()->get();
        });

        return view('pages.public.profil.dokumen', compact('dokumens'));
    }

    public function pressrelease()
    {
        return view('pages.public.profil.pressrelease');
    }

    public function program()
    {
        if (! \Illuminate\Support\Facades\Cache::has('public_program_unggulan')) {
            \Illuminate\Support\Facades\Cache::put('public_program_unggulan', \App\Models\Program::active()
                ->featured()
                ->withSum('confirmedTransactions as total_terkumpul', 'jumlah')
                ->withCount('confirmedTransactions as total_donatur')
                ->latest()
                ->first(), 1800);
        }
        $programUnggulan = \Illuminate\Support\Facades\Cache::get('public_program_unggulan');

        $programs = \Illuminate\Support\Facades\Cache::remember('public_programs_donasi', 1800, function () {
            return \App\Models\Program::active()
                ->withSum('confirmedTransactions as total_terkumpul', 'jumlah')
                ->withCount('confirmedTransactions as total_donatur')
                ->ofType('donasi')
                ->latest()
                ->get();
        });

        $donasiTerbaru = \Illuminate\Support\Facades\Cache::remember('public_donasi_terbaru_5', 600, function () {
            return \App\Models\Transaction::where('status', 'confirmed')
                ->where('type', 'donasi')
                ->with('program')
                ->latest()
                ->take(5)
                ->get();
        });

        $distributionPrograms = \Illuminate\Support\Facades\Cache::remember('public_distribution_programs_active', 1800, function () {
            return DistributionProgram::active()
                ->with('sourceProgram')
                ->latest()
                ->get();
        });

        return view('pages.public.program', compact('programs', 'programUnggulan', 'donasiTerbaru', 'distributionPrograms'));
    }

    public function laporanbulanan()
    {
        $laporanBulanan = \Illuminate\Support\Facades\Cache::remember('public_laporan_bulanan_all', 3600, function () {
            return LaporanBulanan::latest()->get();
        });

        return view('pages.public.laporan.laporanbulanan', compact('laporanBulanan'));
    }

    public function laporantahunan()
    {
        $laporanTahunans = \Illuminate\Support\Facades\Cache::remember('public_laporan_tahunan_all', 3600, function () {
            return LaporanTahunan::latest()->get() ?? collect();
        });

        return view('pages.public.laporan.laporantahunan', compact('laporanTahunans'));
    }

    public function statusmwcranting()
    {
        $laporanMwc = \Illuminate\Support\Facades\Cache::remember('public_laporan_mwc_all', 3600, function () {
            return LaporanMwc::latest()->get();
        });

        return view('pages.public.laporan.statusmwcranting', compact('laporanMwc'));
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
