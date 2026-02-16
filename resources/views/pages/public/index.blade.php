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
            <div class="grid gap-6 lg:gap-8 justify-center auto-rows-auto grid-cols-[repeat(auto-fit,minmax(110px,1fr))]">

                  @php
                  $menuItems = [
                  [
                  'href' => route('infaq'),
                  'label' => 'Infaq Sedekah',
                  'icon' => '<svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                  </svg>'
                  ],
                  [
                  'href' => route('zakat'),
                  'label' => 'Zakat',
                  'icon' => '<svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M8 21h8M12 3v3m0 0l-3 3m3-3l3 3m-3 9v-3m0 3l-3-3m3 3l3-3M3 12h3m15 0h3" />
                        <circle cx="12" cy="12" r="9" stroke-linecap="round" stroke-linejoin="round" />
                  </svg>'
                  ],
                  [
                  'href' => route('kalkulator-zakat'),
                  'label' => 'Kalkulator Zakat',
                  'icon' => '<svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 15.75V18m-7.5-6.75h.008v.008H8.25v-.008zm0 2.25h.008v.008H8.25V13.5zm0 2.25h.008v.008H8.25v-.008zm0 2.25h.008v.008H8.25V18zm2.498-6.75h.007v.008h-.007v-.008zm0 2.25h.007v.008h-.007V13.5zm0 2.25h.007v.008h-.007v-.008zm0 2.25h.007v.008h-.007V18zm2.504-6.75h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V13.5zm0 2.25h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V18zm2.498-6.75h.008v.008h-.008v-.008zm0 2.25h.008v.008h-.008V13.5zM8.25 6h7.5v2.25h-7.5V6zM12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25z" />
                  </svg>'
                  ],
                  [
                  'href' => route('donasi'),
                  'label' => 'Peduli Bencana',
                  'icon' => '<svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                  </svg>'
                  ],
                  [
                  'href' => '#',
                  'label' => 'Fidyah',
                  'icon' => '<svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M21.752 15.002A9.718 9.718 0 0118 15.75c-5.385 0-9.75-4.365-9.75-9.75 0-1.33.266-2.597.748-3.752A9.753 9.753 0 003 11.25C3 16.635 7.365 21 12.75 21a9.753 9.753 0 009.002-5.998z" />
                  </svg>'
                  ],
                  [
                  'href' => '#',
                  'label' => 'Qurban',
                  'icon' => '<svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 8.25v-1.5m0 1.5c-1.355 0-2.697.056-4.024.166C6.845 8.51 6 9.473 6 10.608v2.513m6-4.87c1.355 0 2.697.055 4.024.165C17.155 8.51 18 9.473 18 10.608v2.513m-3-4.87v-1.5m-6 1.5v-1.5m12 9.75l-1.5.75a3.354 3.354 0 01-3 0 3.354 3.354 0 00-3 0 3.354 3.354 0 01-3 0 3.354 3.354 0 00-3 0 3.354 3.354 0 01-3 0L3 16.5m15-3.38a48.474 48.474 0 00-6-.37c-2.032 0-4.034.125-6 .37m12 0c.39.049.777.102 1.163.16 1.07.16 1.837 1.094 1.837 2.175v5.17c0 .62-.504 1.124-1.125 1.124H4.125A1.125 1.125 0 013 20.625v-5.17c0-1.08.768-2.014 1.837-2.174A47.78 47.78 0 016 13.12" />
                  </svg>'
                  ]
                  ];
                  @endphp

                  @foreach ($menuItems as $item)
                  <x-quick-access-menu-item
                        class="flex flex-col items-center text-center w-full max-w-[110px]"
                        :href="$item['href']"
                        :label="$item['label']"
                        :icon="$item['icon']" />
                  @endforeach

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
                  @foreach ($news as $item)
                  <article class="group bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden border border-slate-100 hover:border-emerald-100">

                        <div class="relative overflow-hidden aspect-[16/11]">
                              <img src="{{ asset('storage/' . $item->featured_image) }}"
                                    class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                                    alt="{{ $item->title }}"
                                    loading="lazy">
                        </div>

                        <div class="p-6">
                              <h3 class="font-semibold text-lg text-slate-900 mb-3 leading-snug group-hover:text-emerald-600 transition-colors duration-200 line-clamp-2">
                                    {{ $item->title }}
                              </h3>

                              <p class="text-sm text-slate-600 leading-relaxed mb-4 line-clamp-3">
                                    {{ $item->excerpt }}
                              </p>
                              <div class="flex justify-between">
                                    <div class="flex items-center gap-2 text-xs text-slate-500">
                                          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                          </svg>

                                          <time datetime="{{ $item->published_at }}">
                                                {{ $item->published_at?->translatedFormat('d F Y') ?? '-' }}
                                          </time>
                                    </div>
                                    <button class="text-emerald-600 hover:text-emerald-700 transition-colors duration-200" onclick="window.location='{{ route('berita.show', $item->slug) }}'">
                                          Baca Selengkapnya
                                          <svg class="w-4 h-4 inline-block ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                          </svg>
                                    </button>
                              </div>
                        </div>
                  </article>
                  @endforeach

            </div>

            <!-- View More Button -->
            <div class="text-center mt-12 lg:mt-16">
                  <a href="{{ route('berita.public.index') }}">
                        <button class="inline-flex items-center gap-2 px-8 py-3 bg-white border-2 border-slate-200 text-slate-900 font-semibold rounded-lg hover:border-emerald-500 hover:text-emerald-600 transition-all duration-200 shadow-sm hover:shadow-md">
                              Lebih Banyak
                              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                              </svg>
                        </button>
                  </a>
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
                  @foreach($profile->pillars as $index => $pillar)
                  <div class="group text-center">
                        <div class="inline-flex items-center justify-center w-20 h-20 rounded-2xl bg-white/10 backdrop-blur-sm border border-white/20 mb-6 transition-all duration-300 group-hover:bg-white/20 group-hover:scale-110 group-hover:-translate-y-1">
                              @if($index == 0)
                              <!-- Program Pendidikan - Graduation Cap -->
                              <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.26 10.147a60.436 60.436 0 00-.491 6.347A48.627 48.627 0 0112 20.904a48.627 48.627 0 018.232-4.41 60.46 60.46 0 00-.491-6.347m-15.482 0a50.57 50.57 0 00-2.658-.813A59.905 59.905 0 0112 3.493a59.902 59.902 0 0110.399 5.84c-.896.248-1.783.52-2.658.814m-15.482 0A50.697 50.697 0 0112 13.489a50.702 50.702 0 017.74-3.342M6.75 15a.75.75 0 100-1.5.75.75 0 000 1.5zm0 0v-3.675A55.378 55.378 0 0112 8.443m-7.007 11.55A5.981 5.981 0 006.75 15.75v-1.5" />
                              </svg>
                              @elseif($index == 1)
                              <!-- Program Kesehatan - Heart with Pulse -->
                              <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M21 8.25c0-2.485-2.099-4.5-4.688-4.5-1.935 0-3.597 1.126-4.312 2.733-.715-1.607-2.377-2.733-4.313-2.733C5.1 3.75 3 5.765 3 8.25c0 7.22 9 12 9 12s9-4.78 9-12z" />
                              </svg>
                              @elseif($index == 2)
                              <!-- Program Ekonomi - Chart/Growth -->
                              <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 18L9 11.25l4.306 4.307a11.95 11.95 0 015.814-5.519l2.74-1.22m0 0l-5.94-2.28m5.94 2.28l-2.28 5.941" />
                              </svg>
                              @elseif($index == 3)
                              <!-- Program Sosial - Users/Community -->
                              <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M18 18.72a9.094 9.094 0 003.741-.479 3 3 0 00-4.682-2.72m.94 3.198l.001.031c0 .225-.012.447-.037.666A11.944 11.944 0 0112 21c-2.17 0-4.207-.576-5.963-1.584A6.062 6.062 0 016 18.719m12 0a5.971 5.971 0 00-.941-3.197m0 0A5.995 5.995 0 0012 12.75a5.995 5.995 0 00-5.058 2.772m0 0a3 3 0 00-4.681 2.72 8.986 8.986 0 003.74.477m.94-3.197a5.971 5.971 0 00-.94 3.197M15 6.75a3 3 0 11-6 0 3 3 0 016 0zm6 3a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0zm-13.5 0a2.25 2.25 0 11-4.5 0 2.25 2.25 0 014.5 0z" />
                              </svg>
                              @else
                              <!-- Program Dakwah - Mosque/Worship -->
                              <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 21v-8.25M15.75 21v-8.25M8.25 21v-8.25M3 9l9-6 9 6m-1.5 12V10.332A48.36 48.36 0 0012 9.75c-2.551 0-5.056.2-7.5.582V21M3 21h18M12 6.75h.008v.008H12V6.75z" />
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