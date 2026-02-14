@extends('layouts.public.app')
@section('title', 'Press Release - LAZIZNU Bojonegoro')
@section('content')

<!-- HERO SECTION -->
<section class="relative bg-gradient-to-br from-emerald-600 to-emerald-700 py-20 sm:py-24 overflow-hidden">
      <!-- Decorative Elements -->
      <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 left-0 w-96 h-96 bg-emerald-500 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-emerald-600 rounded-full blur-3xl"></div>
      </div>

      <div class="relative max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
            <div class="inline-block mb-6 px-4 py-1.5 bg-emerald-500/20 backdrop-blur-sm rounded-full border border-emerald-400/30">
                  <span class="text-emerald-200 text-sm font-medium">Berita & Informasi</span>
            </div>

            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white tracking-tight mb-4">
                  Informasi NU Care
            </h1>

            <p class="text-base sm:text-lg text-emerald-100/90 max-w-2xl mx-auto leading-relaxed">
                  Informasi program, kegiatan dan distribusi bantuan NU Care-LAZISNU PCNU Jepara
            </p>
      </div>
</section>

<!-- MAIN CONTENT -->
<section class="bg-slate-50/50 py-16 sm:py-20 lg:py-24">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid lg:grid-cols-4 gap-8 lg:gap-12">

                  <!-- LEFT CONTENT (News Grid) -->
                  <div class="lg:col-span-3">

                        <!-- NEWS GRID -->
                        <div class="grid sm:grid-cols-2 xl:grid-cols-3 gap-6 lg:gap-8 mb-12">

                              @php
                              $news = [
                              [
                              'title' => 'Ribuan Relawan NU Berkumpul di Batang',
                              'desc' => 'Ribuan relawan NU menghadiri kegiatan sosial untuk mendukung masyarakat terdampak bencana.',
                              'category' => 'Sosial',
                              'date' => '12 Feb 2024',
                              'image' => 'https://via.placeholder.com/600x400',
                              'color' => 'emerald'
                              ],
                              [
                              'title' => 'NU Peduli Salurkan Bantuan Cuaca Ekstrem',
                              'desc' => 'Bantuan sosial diberikan kepada masyarakat terdampak cuaca ekstrem di beberapa wilayah.',
                              'category' => 'Kesehatan',
                              'date' => '15 Feb 2024',
                              'image' => 'https://via.placeholder.com/600x400',
                              'color' => 'blue'
                              ],
                              [
                              'title' => 'Penguatan Ambulans NU Jepara',
                              'desc' => 'LAZISNU memperkuat fasilitas ambulans guna meningkatkan pelayanan masyarakat.',
                              'category' => 'Program',
                              'date' => '20 Feb 2024',
                              'image' => 'https://via.placeholder.com/600x400',
                              'color' => 'purple'
                              ],
                              [
                              'title' => 'Bantuan Pendidikan untuk Santri Dhuafa',
                              'desc' => 'Program beasiswa untuk santri dari keluarga kurang mampu di wilayah Jepara.',
                              'category' => 'Pendidikan',
                              'date' => '18 Feb 2024',
                              'image' => 'https://via.placeholder.com/600x400',
                              'color' => 'amber'
                              ],
                              [
                              'title' => 'Pelatihan Kewirausahaan UMKM Nahdliyin',
                              'desc' => 'LAZISNU menyelenggarakan pelatihan untuk meningkatkan kapasitas UMKM warga NU.',
                              'category' => 'Ekonomi',
                              'date' => '10 Feb 2024',
                              'image' => 'https://via.placeholder.com/600x400',
                              'color' => 'orange'
                              ],
                              [
                              'title' => 'Penyaluran Zakat Fitrah 1445 H',
                              'desc' => 'Distribusi zakat fitrah kepada mustahik di seluruh kecamatan Kabupaten Jepara.',
                              'category' => 'Zakat',
                              'date' => '08 Feb 2024',
                              'image' => 'https://via.placeholder.com/600x400',
                              'color' => 'emerald'
                              ],
                              ];
                              @endphp

                              @foreach($news as $item)
                              <article class="group bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden border border-slate-100 hover:border-emerald-100">

                                    <!-- Image -->
                                    <div class="relative overflow-hidden aspect-[16/11]">
                                          <img src="{{ $item['image'] }}"
                                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                                                alt="{{ $item['title'] }}"
                                                loading="lazy">

                                          <!-- Category Badge -->
                                          <div class="absolute top-4 left-4">
                                                <span class="inline-flex items-center px-3 py-1 bg-{{ $item['color'] }}-600 text-white text-xs font-semibold rounded-full shadow-lg">
                                                      {{ $item['category'] }}
                                                </span>
                                          </div>
                                    </div>

                                    <!-- Content -->
                                    <div class="p-6">
                                          <h3 class="font-bold text-slate-900 text-base sm:text-lg mb-3 leading-snug group-hover:text-emerald-600 transition-colors duration-200 line-clamp-2">
                                                {{ $item['title'] }}
                                          </h3>

                                          <p class="text-sm text-slate-600 leading-relaxed mb-4 line-clamp-3">
                                                {{ $item['desc'] }}
                                          </p>

                                          <div class="flex items-center justify-between">
                                                <div class="flex items-center gap-2 text-xs text-slate-500">
                                                      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                      </svg>
                                                      <time datetime="{{ $item['date'] }}">{{ $item['date'] }}</time>
                                                </div>

                                                <a href="#" class="text-emerald-600 text-sm font-semibold hover:text-emerald-700 transition-colors duration-200">
                                                      Baca →
                                                </a>
                                          </div>
                                    </div>
                              </article>
                              @endforeach

                        </div>

                        <!-- LOAD MORE BUTTON -->
                        <div class="text-center">
                              <button class="inline-flex items-center gap-2 px-8 py-3 bg-white border-2 border-slate-200 text-slate-900 font-semibold rounded-lg hover:border-emerald-500 hover:text-emerald-600 transition-all duration-200 shadow-sm hover:shadow-md">
                                    Muat Lebih Banyak
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                    </svg>
                              </button>
                        </div>

                  </div>

                  <!-- SIDEBAR -->
                  <div class="lg:col-span-1">
                        <div class="space-y-8 sticky top-8">

                              <!-- SEARCH -->
                              <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
                                    <h4 class="font-bold text-slate-900 mb-4 text-base">Cari Berita</h4>
                                    <div class="relative">
                                          <input type="text"
                                                placeholder="Ketik kata kunci..."
                                                class="w-full pl-10 pr-4 py-3 border border-slate-200 rounded-xl focus:ring-2 focus:ring-emerald-500 focus:border-transparent outline-none text-sm transition-all duration-200">
                                          <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                                <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                                </svg>
                                          </div>
                                    </div>
                              </div>

                              <!-- CATEGORIES -->
                              <div class="bg-white p-6 rounded-2xl shadow-sm border border-slate-100">
                                    <h4 class="font-bold text-slate-900 mb-6 text-base">Kategori</h4>
                                    <ul class="space-y-3">
                                          @foreach(['Sosial', 'Program', 'Kesehatan', 'Edukasi', 'Ekonomi', 'Zakat'] as $category)
                                          <li>
                                                <a href="#" class="group flex items-center justify-between py-2 text-sm text-slate-600 hover:text-emerald-600 transition-colors duration-200">
                                                      <span class="flex items-center gap-2">
                                                            <span class="w-1.5 h-1.5 bg-slate-300 rounded-full group-hover:bg-emerald-500 transition-colors duration-200"></span>
                                                            {{ $category }}
                                                      </span>
                                                      <svg class="w-4 h-4 opacity-0 group-hover:opacity-100 transition-opacity duration-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                                      </svg>
                                                </a>
                                          </li>
                                          @endforeach
                                    </ul>
                              </div>

                              <!-- QRIS CARD -->
                              <div class="relative bg-gradient-to-br from-emerald-600 to-emerald-700 text-white p-8 rounded-2xl shadow-xl overflow-hidden">
                                    <!-- Decorative -->
                                    <div class="absolute top-0 right-0 w-32 h-32 bg-white/10 rounded-full blur-2xl"></div>

                                    <div class="relative">
                                          <h4 class="font-bold mb-4 text-lg">Dukung Program Kami</h4>

                                          <div class="bg-white p-3 rounded-xl shadow-lg mb-4">
                                                <img src="https://via.placeholder.com/200x200"
                                                      class="w-full rounded-lg"
                                                      alt="QRIS">
                                          </div>

                                          <p class="text-emerald-100 text-sm leading-relaxed">
                                                Scan QRIS untuk berdonasi dan mendukung program kemanfaatan umat.
                                          </p>
                                    </div>
                              </div>

                        </div>
                  </div>

            </div>
      </div>
</section>

@endsection