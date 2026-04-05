@extends('layouts.public.app')
@section('title', $profile->title ?? 'Profil')

@section('content')

{{-- HERO HEADER --}}
<section class="relative bg-gradient-to-br from-emerald-600 to-emerald-700 py-20 sm:py-24 overflow-hidden">
      <div class="relative max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">

            <div class="inline-block mb-6 px-4 py-1.5 bg-emerald-500/20 rounded-full border border-emerald-400/30">
                  <span class="text-emerald-200 text-sm font-medium">Tentang Kami</span>
            </div>

            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white mb-4">
                  NU CARE Lazisnu
            </h1>

            <p class="text-base sm:text-lg text-emerald-100 max-w-2xl mx-auto">
                  Lembaga Amil Zakat, Infaq, dan Shadaqah Nahdlatul Ulama Kabupaten Bojonegoro
            </p>

      </div>
</section>


{{-- PROFILE CONTENT --}}
<section class="max-w-7xl mx-auto py-16 sm:py-20 lg:py-24 px-4 sm:px-6 lg:px-8">
      <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">

            {{-- TEXT --}}
            <div>

                  <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 mb-6">
                        {{ $profile->title }}
                  </h2>

                  <div class="space-y-4 text-slate-600">
                        <p>{{ $profile->deskripsi }}</p>
                  </div>

                  {{-- STATS --}}
                  <div class="grid grid-cols-3 gap-6 mt-8 pt-8 border-t">

                        <div>
                              <div class="text-2xl font-bold text-emerald-600">
                                    {{ $profile->tahun_berdiri }}
                              </div>
                              <div class="text-sm text-slate-600 mt-1">Tahun Berdiri</div>
                        </div>

                        <div>
                              <div class="text-2xl font-bold text-emerald-600">
                                    {{ number_format($profile->penerima_manfaat) }}
                              </div>
                              <div class="text-sm text-slate-600 mt-1">Penerima Manfaat</div>
                        </div>

                        <div>
                              <div class="text-2xl font-bold text-emerald-600">
                                    {{ $profile->program_tersalurkan }}
                              </div>
                              <div class="text-sm text-slate-600 mt-1">Program</div>
                        </div>

                  </div>

            </div>

            {{-- IMAGE --}}
            <div>
                  <img src="{{ asset('asset/hero.png') }}"
                        class="rounded-2xl shadow-2xl w-full"
                        alt="Profil">
            </div>

      </div>
</section>


{{-- VISI MISI --}}
<section class="bg-slate-50 py-16 sm:py-20 lg:py-24">
      <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="text-center mb-12">
                  <h2 class="text-3xl font-bold text-slate-900">Visi & Misi</h2>
            </div>

            <div class="grid md:grid-cols-2 gap-8">

                  {{-- VISI --}}

                  <div class="bg-white p-8 rounded-2xl shadow border">
                        <div class="flex items-center gap-3 mb-6">
                              <h3 class="text-xl font-bold">Visi</h3>
                        </div>
                        <p class="text-slate-600">
                              {{ $profile->visi }}
                        </p>
                  </div>

                  {{-- MISI DINAMIS --}}
                  <div class="bg-white p-8 rounded-2xl shadow border">
                        <div class="flex items-center gap-3 mb-6">
                              <h3 class="text-xl font-bold">Misi</h3>
                        </div>

                        <ul class="space-y-3 text-slate-600">
                              @foreach($profile->missions as $mission)
                              <li class="flex gap-3">
                                    <span class="text-emerald-500">✔</span>
                                    <span>{{ $mission->text }}</span>
                              </li>
                              @endforeach
                        </ul>

                  </div>

            </div>

      </div>
</section>


{{-- PILAR DINAMIS --}}
<section class="w-full bg-gradient-to-br from-emerald-600 to-emerald-700 py-16 sm:py-20 lg:py-24">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Section Header -->
            <div class="text-center mb-12 lg:mb-16">
                  <h2 class="text-3xl sm:text-4xl font-bold text-white tracking-tight mb-3">
                        5 Pilar Program
                  </h2>
                  <p class="text-emerald-100 max-w-2xl mx-auto">
                        Program pemberdayaan masyarakat untuk kesejahteraan berkelanjutan
                  </p>
            </div>

            <!-- Pillars Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-8 lg:gap-6">
                  @foreach($profile->pillars as $index => $pillar)
                  <div class="group text-center">
                        <div class="inline-flex items-center justify-center w-20 h-20 rounded-2xl bg-white/10 backdrop-blur-sm border border-white/20 mb-6 transition-all duration-300 group-hover:bg-white/20 group-hover:scale-110 group-hover:-translate-y-1">
                              @if($index == 0)
                              <!-- Program Pendidikan - Graduation Cap -->
                              <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                              </svg>
                              @elseif($index == 1)
                              <!-- Program Kesehatan - Heart with Pulse -->
                              <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18.75a60.07 60.07 0 0115.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 013 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 00-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 01-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 003 15h-.75M15 10.5a3 3 0 11-6 0 3 3 0 016 0zm3 0h.008v.008H18V10.5zm-12 0h.008v.008H6V10.5z" />
                              </svg>
                              @elseif($index == 2)
                              <!-- Program Ekonomi - Chart/Growth -->
                              <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                              </svg>
                              @elseif($index == 3)
                              <!-- Program Sosial - Users/Community -->
                              <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                              </svg>
                              @else
                              <!-- Program Dakwah - Mosque/Worship -->
                              <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 013 12c0-1.605.42-3.113 1.157-4.418" />
                              </svg>
                              @endif
                        </div>
                        <h3 class="text-lg font-bold text-white mb-3">
                              {{ $pillar->title }}
                        </h3>
                        <p class="text-sm text-emerald-100 leading-relaxed">
                              {{ $pillar->deskripsi }}
                        </p>
                  </div>
                  @endforeach
            </div>
      </div>
</section>

@endsection