@extends('layouts.public.app')
@section('title', 'Beranda - NU Care LAZIZNU Bojonegoro')

@section('content')

<!-- HERO SECTION -->
<section class="max-w-7xl mx-auto mt-8 md:mt-12 px-4 sm:px-6 lg:px-8">
      <div class="relative rounded-2xl md:rounded-3xl overflow-hidden bg-gradient-to-br from-slate-900 to-slate-800 shadow-xl">

            <!-- Background Image with Overlay -->
            <div class="absolute inset-0">
                  <img src="{{ asset('asset/hero.png') }}"
                        class="w-full h-full object-cover opacity-40"
                        alt="Hero Background"
                        loading="eager">
                  <div class="absolute inset-0 bg-gradient-to-r from-emerald-900/90 via-emerald-800/80 to-transparent"></div>
            </div>

            <!-- Content -->
            <div class="relative px-6 sm:px-12 lg:px-16 py-20 sm:py-24 lg:py-32">
                  <div class="max-w-2xl">
                        <div class="inline-block mb-4 px-4 py-1.5 bg-emerald-500/20 backdrop-blur-sm rounded-full border border-emerald-400/30">
                              <span class="text-emerald-200 text-sm font-medium">Laziznu Bojonegoro</span>
                        </div>

                        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white mb-6 leading-tight tracking-tight">
                              Bersama Membangun<br />
                              Kemandirian Umat
                        </h1>

                        <p class="text-base sm:text-lg text-emerald-100/90 leading-relaxed max-w-xl mb-8">
                              NU Care–LAZISNU merupakan lembaga filantropi Islam yang berkhidmat dalam pengelolaan dana zakat, infaq, dan shadaqah secara amanah, transparan dan profesional untuk kemaslahatan umat.
                        </p>

                        <div class="flex flex-wrap gap-4">
                              <a href="{{ route('donasi') }}" class="group px-6 py-3 bg-white text-emerald-900 rounded-lg font-semibold hover:bg-emerald-50 transition-all duration-200 shadow-lg hover:shadow-xl hover:-translate-y-0.5">
                                    Mulai Berdonasi
                                    <span class="inline-block ml-2 transition-transform duration-200 group-hover:translate-x-1">→</span>
                              </a>
                              </button>
                              <button class="px-6 py-3 bg-transparent border-2 border-white/30 text-white rounded-lg font-semibold hover:bg-white/10 backdrop-blur-sm transition-all duration-200">
                                    Pelajari Lebih Lanjut
                              </button>
                        </div>
                  </div>
            </div>
      </div>
</section>

<!-- QUICK ACCESS MENU -->
<section class="max-w-7xl mx-auto py-12 sm:py-16 lg:py-20 px-4 sm:px-6 lg:px-8">
      <div class="bg-white rounded-2xl border border-slate-200/60 p-8 sm:p-10 lg:p-12 shadow-sm hover:shadow-md transition-shadow duration-300">

            <!-- Grid Menu -->
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-7 gap-6 lg:gap-8">

                  <!-- Menu Item -->
                  <a href="{{ route('infaq') }}" class="group flex flex-col items-center text-center">
                        <div class="w-16 h-16 sm:w-18 sm:h-18 rounded-xl bg-gradient-to-br from-emerald-500 to-emerald-600 
                                    flex items-center justify-center shadow-lg shadow-emerald-500/20
                                    transition-all duration-300 ease-out
                                    group-hover:shadow-xl group-hover:shadow-emerald-500/30 
                                    group-hover:-translate-y-1 group-hover:scale-105">
                              <span class="text-2xl">💰</span>
                        </div>
                        <p class="mt-3 text-sm font-semibold text-slate-700 group-hover:text-emerald-600 transition-colors duration-200">
                              Infaq Sedekah
                        </p>
                  </a>

                  <a href="{{ route('zakat') }}" class="group flex flex-col items-center text-center">
                        <div class="w-16 h-16 sm:w-18 sm:h-18 rounded-xl bg-gradient-to-br from-emerald-500 to-emerald-600 
                                    flex items-center justify-center shadow-lg shadow-emerald-500/20
                                    transition-all duration-300 ease-out
                                    group-hover:shadow-xl group-hover:shadow-emerald-500/30 
                                    group-hover:-translate-y-1 group-hover:scale-105">
                              <span class="text-2xl">🕌</span>
                        </div>
                        <p class="mt-3 text-sm font-semibold text-slate-700 group-hover:text-emerald-600 transition-colors duration-200">
                              Zakat
                        </p>
                  </a>

                  <a href="{{ route('kalkulator-zakat') }}" class="group flex flex-col items-center text-center">
                        <div class="w-16 h-16 sm:w-18 sm:h-18 rounded-xl bg-gradient-to-br from-emerald-500 to-emerald-600 
                                    flex items-center justify-center shadow-lg shadow-emerald-500/20
                                    transition-all duration-300 ease-out
                                    group-hover:shadow-xl group-hover:shadow-emerald-500/30 
                                    group-hover:-translate-y-1 group-hover:scale-105">
                              <span class="text-2xl">🧮</span>
                        </div>
                        <p class="mt-3 text-sm font-semibold text-slate-700 group-hover:text-emerald-600 transition-colors duration-200">
                              Kalkulator Zakat
                        </p>
                  </a>

                  <a href="{{ route('donasi') }}" class="group flex flex-col items-center text-center">
                        <div class="w-16 h-16 sm:w-18 sm:h-18 rounded-xl bg-gradient-to-br from-emerald-500 to-emerald-600 
                                    flex items-center justify-center shadow-lg shadow-emerald-500/20
                                    transition-all duration-300 ease-out
                                    group-hover:shadow-xl group-hover:shadow-emerald-500/30 
                                    group-hover:-translate-y-1 group-hover:scale-105">
                              <span class="text-2xl">🏠</span>
                        </div>
                        <p class="mt-3 text-sm font-semibold text-slate-700 group-hover:text-emerald-600 transition-colors duration-200">
                              Peduli Bencana
                        </p>
                  </a>


                  <a href="#" class="group flex flex-col items-center text-center">
                        <div class="w-16 h-16 sm:w-18 sm:h-18 rounded-xl bg-gradient-to-br from-emerald-500 to-emerald-600 
                                    flex items-center justify-center shadow-lg shadow-emerald-500/20
                                    transition-all duration-300 ease-out
                                    group-hover:shadow-xl group-hover:shadow-emerald-500/30 
                                    group-hover:-translate-y-1 group-hover:scale-105">
                              <span class="text-2xl">🌙</span>
                        </div>
                        <p class="mt-3 text-sm font-semibold text-slate-700 group-hover:text-emerald-600 transition-colors duration-200">
                              Fidyah
                        </p>
                  </a>

                  <a href="#" class="group flex flex-col items-center text-center">
                        <div class="w-16 h-16 sm:w-18 sm:h-18 rounded-xl bg-gradient-to-br from-emerald-500 to-emerald-600 
                                    flex items-center justify-center shadow-lg shadow-emerald-500/20
                                    transition-all duration-300 ease-out
                                    group-hover:shadow-xl group-hover:shadow-emerald-500/30 
                                    group-hover:-translate-y-1 group-hover:scale-105">
                              <span class="text-2xl">🐄</span>
                        </div>
                        <p class="mt-3 text-sm font-semibold text-slate-700 group-hover:text-emerald-600 transition-colors duration-200">
                              Qurban
                        </p>
                  </a>

            </div>
      </div>
</section>

<!-- DONATION PROGRAMS -->
<section class="w-full bg-slate-50/50 py-16 sm:py-20 lg:py-24">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Section Header -->
            <div class="text-center max-w-2xl mx-auto mb-12 lg:mb-16">
                  <h2 class="text-3xl sm:text-4xl font-bold text-slate-900 tracking-tight mb-4">
                        Ayo Berinfaq di LAZISNU
                  </h2>
                  <p class="text-base sm:text-lg text-slate-600 leading-relaxed">
                        Tunaikan zakat, infaq, dan shadaqah melalui LAZISNU dengan berbagai program kemanfaatan untuk ummat.
                  </p>
            </div>

            <!-- Program Cards Grid -->
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">

                  <!-- CARD 1 -->
                  <article class="group bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden border border-slate-100 hover:border-emerald-100">
                        <div class="relative overflow-hidden aspect-[16/10]">
                              <img src="{{ asset('asset/santriterampil.jpg') }}"
                                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                                    alt="Wujudkan Santripreneur Terampil Berwirausaha"
                                    loading="lazy">
                              <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </div>

                        <div class="p-6">
                              <div class="mb-3">
                                    <span class="inline-block px-3 py-1 bg-emerald-50 text-emerald-700 text-xs font-semibold rounded-full">
                                          LAZISNU Bojonegoro
                                    </span>
                              </div>

                              <h3 class="font-semibold text-lg text-slate-900 mb-4 leading-snug group-hover:text-emerald-600 transition-colors duration-200">
                                    Wujudkan Santripreneur Terampil Berwirausaha
                              </h3>

                              <!-- Progress Section -->
                              <div class="space-y-3">
                                    <div class="flex justify-between items-baseline text-sm">
                                          <span class="text-slate-600">Terkumpul</span>
                                          <span class="font-semibold text-slate-900">Rp 0</span>
                                    </div>

                                    <div class="relative w-full h-2 bg-slate-100 rounded-full overflow-hidden">
                                          <div class="absolute inset-y-0 left-0 bg-gradient-to-r from-emerald-500 to-emerald-600 rounded-full transition-all duration-500 w-[10%]"></div>
                                    </div>
                              </div>

                              <button class="mt-6 w-full px-6 py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-lg transition-all duration-200 shadow-sm hover:shadow-md hover:-translate-y-0.5">
                                    Salurkan Donasi
                              </button>
                        </div>
                  </article>

                  <!-- CARD 2 -->
                  <article class="group bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden border border-slate-100 hover:border-emerald-100">
                        <div class="relative overflow-hidden aspect-[16/10]">
                              <img src="{{ asset('asset/gurumengajar.webp') }}"
                                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                                    alt="Bantu Guru Membangun Masa Depan Pendidikan"
                                    loading="lazy">
                              <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </div>

                        <div class="p-6">
                              <div class="mb-3">
                                    <span class="inline-block px-3 py-1 bg-emerald-50 text-emerald-700 text-xs font-semibold rounded-full">
                                          LAZISNU Bojonegoro
                                    </span>
                              </div>

                              <h3 class="font-semibold text-lg text-slate-900 mb-4 leading-snug group-hover:text-emerald-600 transition-colors duration-200">
                                    Bantu Guru Membangun Masa Depan Pendidikan
                              </h3>

                              <div class="space-y-3">
                                    <div class="flex justify-between items-baseline text-sm">
                                          <span class="text-slate-600">Terkumpul</span>
                                          <span class="font-semibold text-slate-900">Rp 150.000</span>
                                    </div>

                                    <div class="relative w-full h-2 bg-slate-100 rounded-full overflow-hidden">
                                          <div class="absolute inset-y-0 left-0 bg-gradient-to-r from-emerald-500 to-emerald-600 rounded-full transition-all duration-500 w-[30%]"></div>
                                    </div>
                              </div>

                              <button class="mt-6 w-full px-6 py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-lg transition-all duration-200 shadow-sm hover:shadow-md hover:-translate-y-0.5">
                                    Salurkan Donasi
                              </button>
                        </div>
                  </article>

                  <!-- CARD 3 -->
                  <article class="group bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden border border-slate-100 hover:border-emerald-100">
                        <div class="relative overflow-hidden aspect-[16/10]">
                              <img src="{{ asset('asset/beasiswasantri.jpeg') }}"
                                    class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                                    alt="Beasiswa Santri dan Siswa Nusantara"
                                    loading="lazy">
                              <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                        </div>

                        <div class="p-6">
                              <div class="mb-3">
                                    <span class="inline-block px-3 py-1 bg-emerald-50 text-emerald-700 text-xs font-semibold rounded-full">
                                          LAZISNU Bojonegoro
                                    </span>
                              </div>

                              <h3 class="font-semibold text-lg text-slate-900 mb-4 leading-snug group-hover:text-emerald-600 transition-colors duration-200">
                                    Beasiswa Santri dan Siswa Nusantara
                              </h3>

                              <div class="space-y-3">
                                    <div class="flex justify-between items-baseline text-sm">
                                          <span class="text-slate-600">Terkumpul</span>
                                          <span class="font-semibold text-slate-900">Rp 0</span>
                                    </div>

                                    <div class="relative w-full h-2 bg-slate-100 rounded-full overflow-hidden">
                                          <div class="absolute inset-y-0 left-0 bg-gradient-to-r from-emerald-500 to-emerald-600 rounded-full transition-all duration-500 w-[5%]"></div>
                                    </div>
                              </div>

                              <button class="mt-6 w-full px-6 py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-lg transition-all duration-200 shadow-sm hover:shadow-md hover:-translate-y-0.5">
                                    Salurkan Donasi
                              </button>
                        </div>
                  </article>

            </div>

            <!-- View All Button -->
            <div class="text-center mt-12 lg:mt-16">
                  <button class="inline-flex items-center gap-2 px-8 py-3 bg-white border-2 border-slate-200 text-slate-900 font-semibold rounded-lg hover:border-emerald-500 hover:text-emerald-600 transition-all duration-200 shadow-sm hover:shadow-md">
                        Lihat Semua Program
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                  </button>
            </div>
      </div>
</section>

<!-- PRESS RELEASE -->
<section class="w-full bg-white py-16 sm:py-20 lg:py-24">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Section Header -->
            <div class="text-center mb-12 lg:mb-16">
                  <h2 class="text-3xl sm:text-4xl font-bold text-slate-900 tracking-tight mb-3">
                        Press Release
                  </h2>
                  <div class="w-16 h-1 bg-gradient-to-r from-emerald-500 to-emerald-600 mx-auto rounded-full"></div>
            </div>

            <!-- News Grid -->
            <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">

                  <!-- NEWS CARD 1 -->
                  <article class="group bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden border border-slate-100 hover:border-emerald-100">
                        <div class="relative overflow-hidden aspect-[16/11]">
                              <img src="{{ asset('asset/press1.jpg') }}"
                                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                                    alt="Ribuan Relawan NU Berkumpul"
                                    loading="lazy">
                        </div>

                        <div class="p-6">
                              <h3 class="font-semibold text-lg text-slate-900 mb-3 leading-snug group-hover:text-emerald-600 transition-colors duration-200 line-clamp-2">
                                    Ribuan Relawan NU Berkumpul di Batang, PCNU Bojonegoro
                              </h3>

                              <p class="text-sm text-slate-600 leading-relaxed mb-4 line-clamp-3">
                                    Ribuan relawan Nahdlatul Ulama dari berbagai daerah di Jawa Tengah berkumpul dalam aksi sosial...
                              </p>

                              <div class="flex items-center gap-2 text-xs text-slate-500">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <time datetime="2026-02-01">01 Februari 2026</time>
                              </div>
                        </div>
                  </article>

                  <!-- NEWS CARD 2 -->
                  <article class="group bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden border border-slate-100 hover:border-emerald-100">
                        <div class="relative overflow-hidden aspect-[16/11]">
                              <img src="{{ asset('asset/press2.jpg') }}"
                                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                                    alt="NU Peduli Bojonegoro"
                                    loading="lazy">
                        </div>

                        <div class="p-6">
                              <h3 class="font-semibold text-lg text-slate-900 mb-3 leading-snug group-hover:text-emerald-600 transition-colors duration-200 line-clamp-2">
                                    NU Peduli Bojonegoro Sambangi Warga Terdampak Cuaca Ekstrim
                              </h3>

                              <p class="text-sm text-slate-600 leading-relaxed mb-4 line-clamp-3">
                                    NU Peduli dan LAZISNU PCNU Bojonegoro menyalurkan bantuan kebencanaan kepada warga terdampak...
                              </p>

                              <div class="flex items-center gap-2 text-xs text-slate-500">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <time datetime="2026-01-31">31 Januari 2026</time>
                              </div>
                        </div>
                  </article>

                  <!-- NEWS CARD 3 -->
                  <article class="group bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden border border-slate-100 hover:border-emerald-100">
                        <div class="relative overflow-hidden aspect-[16/11]">
                              <img src="{{ asset('asset/press3.jpg') }}"
                                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                                    alt="Peduli Bencana PCNU Bojonegoro"
                                    loading="lazy">
                        </div>

                        <div class="p-6">
                              <h3 class="font-semibold text-lg text-slate-900 mb-3 leading-snug group-hover:text-emerald-600 transition-colors duration-200 line-clamp-2">
                                    Peduli Bencana, PCNU Bojonegoro Salurkan Bantuan ke Tiga Lokasi
                              </h3>

                              <p class="text-sm text-slate-600 leading-relaxed mb-4 line-clamp-3">
                                    PCNU Bojonegoro melalui NU Peduli Bencana menyalurkan bantuan sembako, pendidikan, dan santunan...
                              </p>

                              <div class="flex items-center gap-2 text-xs text-slate-500">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                    </svg>
                                    <time datetime="2026-01-29">29 Januari 2026</time>
                              </div>
                        </div>
                  </article>

            </div>

            <!-- View More Button -->
            <div class="text-center mt-12 lg:mt-16">
                  <button class="inline-flex items-center gap-2 px-8 py-3 bg-white border-2 border-slate-200 text-slate-900 font-semibold rounded-lg hover:border-emerald-500 hover:text-emerald-600 transition-all duration-200 shadow-sm hover:shadow-md">
                        Lebih Banyak
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                  </button>
            </div>
      </div>
</section>

<!-- 5 PILLARS -->
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

                  <!-- PILLAR 1 -->
                  @foreach($profile->pillars as $index => $pillar)
                  <div class="group text-center">
                        <div class="inline-flex items-center justify-center w-20 h-20 rounded-2xl bg-white/10 backdrop-blur-sm border border-white/20 mb-6 transition-all duration-300 group-hover:bg-white/20 group-hover:scale-110 group-hover:-translate-y-1">
                              <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6.042A8.967 8.967 0 006 3.75c-1.052 0-2.062.18-3 .512v14.25A8.987 8.987 0 016 18c2.305 0 4.408.867 6 2.292m0-14.25a8.966 8.966 0 016-2.292c1.052 0 2.062.18 3 .512v14.25A8.987 8.987 0 0018 18a8.967 8.967 0 00-6 2.292m0-14.25v14.25" />
                              </svg>
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