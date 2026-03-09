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
                              <div class="flex items-center justify-center w-12 h-12 rounded-xl bg-gradient-to-br from-emerald-500 to-emerald-600 shadow-lg shadow-emerald-500/20">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                              </div>

                              <h3 class="text-xl font-bold">Visi</h3>
                        </div>
                        <p class="text-slate-600">
                              {{ $profile->visi }}
                        </p>
                  </div>

                  {{-- MISI DINAMIS --}}
                  <div class="bg-white p-8 rounded-2xl shadow border">
                        <div class="flex items-center gap-3 mb-6">
                              <div class="flex items-center justify-center w-12 h-12 rounded-xl bg-gradient-to-br from-emerald-500 to-emerald-600 shadow-lg shadow-emerald-500/20">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                              </div>

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
<section class="py-16 sm:py-20 lg:py-24 bg-white">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="text-center mb-12">
                  <h2 class="text-3xl font-bold text-slate-900">Program Pilar</h2>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-5 gap-6">

                  @foreach(optional($profile)->pillars ?? [] as $index => $pillar)

                  <div class="bg-slate-50 hover:bg-white p-6 rounded-2xl shadow border text-center">

                        <div class="w-16 h-16 flex items-center justify-center bg-emerald-600 text-white rounded-xl mx-auto mb-4 text-xl font-bold">
                              {{ $index+1 }}
                        </div>

                        <h3 class="font-bold mb-2">
                              {{ $pillar->title }}
                        </h3>

                        <p class="text-sm text-slate-600">
                              {{ $pillar->deskripsi }}
                        </p>

                  </div>
                  @endforeach

            </div>

      </div>
</section>


{{-- CTA --}}
<section class="relative bg-gradient-to-br from-emerald-600 to-emerald-700 py-16 sm:py-20 overflow-hidden">
      <!-- Decorative Elements -->
      <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 right-0 w-96 h-96 bg-white rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 w-96 h-96 bg-white rounded-full blur-3xl"></div>
      </div>

      <div class="relative max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-white mb-6 tracking-tight">
                  Bersama Kita Bangun<br class="sm:hidden" /> Kemandirian Umat
            </h2>

            <p class="text-emerald-100 mb-8 max-w-xl mx-auto">
                  Salurkan zakat, infaq, dan shadaqah Anda melalui program-program yang tepat sasaran dan berdampak nyata
            </p>

            <div class="flex flex-wrap gap-4 justify-center">
                  <a href="{{ route('donasi.index') }}" class="group px-8 py-3.5 bg-white text-emerald-700 font-semibold rounded-lg hover:bg-emerald-50 transition-all duration-200 shadow-lg hover:shadow-xl hover:-translate-y-0.5">
                        Salurkan Donasi Sekarang
                        <span class="inline-block ml-2 transition-transform duration-200 group-hover:translate-x-1">→</span>
                  </a>
            </div>
      </div>
</section>

@endsection