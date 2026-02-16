<?php

namespace App\Http\public;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\Profile;

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


        return view('pages.public.index', compact('profile', 'news'));
    }

    public function profile()
    {
        $profile = Profile::with(['missions', 'pillars'])->latest()->first();

        return view('pages.public.profil.profile', compact('profile'));
    }


    public function pengurus()
    {
        return view('pages.public.profil.pengurus');
    }

    public function rekening()
    {
        return view('pages.public.profil.rekeninglengkap');
    }

    public function dokumen()
    {
        return view('pages.public.profil.dokumen');
    }

    public function pressrelease()
    {
        return view('pages.public.profil.pressrelease');
    }

    public function program()
    {
        return view('pages.public.program');
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
        $news = \App\Models\News::with('category')
            ->where('published_at', '<=', now())
            ->orderByDesc('published_at')
            ->paginate(10);

        return view('pages.public.berita.index', compact('news'));
    }
}
