@extends('layouts.public.app')
@section('title', 'Dokumen - LAZIZNU Bojonegoro')
@section('content')

<!-- HERO -->
<section class="relative bg-gradient-to-br from-emerald-600 to-emerald-700 py-20 sm:py-24 overflow-hidden">
      <!-- Decorative Elements -->
      <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 left-0 w-96 h-96 bg-emerald-500 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-emerald-600 rounded-full blur-3xl"></div>
      </div>

      <div class="relative max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
            <div class="inline-block mb-6 px-4 py-1.5 bg-emerald-500/20 backdrop-blur-sm rounded-full border border-emerald-400/30">
                  <span class="text-emerald-200 text-sm font-medium">Repositori Dokumen</span>
            </div>

            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white tracking-tight mb-4">
                  Dokumen Resmi LAZISNU PCNU Bojonegoro
            </h1>

            <p class="text-base sm:text-lg text-emerald-100/90 max-w-2xl mx-auto leading-relaxed">
                  Kumpulan pedoman, regulasi dan laporan resmi lembaga
            </p>
      </div>
</section>


<!-- DOCUMENT LIST -->
<section class="bg-slate-50/50 py-16 sm:py-20 lg:py-24">
      <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="space-y-6">

                  @forelse($dokumens as $dokumen)
                  <article class="group bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 border border-slate-200 hover:border-emerald-200 p-6 sm:p-8">
                        <div class="flex flex-col lg:flex-row lg:items-center gap-6">

                              <!-- Icon & Content -->
                              <div class="flex items-start gap-4 sm:gap-6 flex-1">

                                    <!-- Icon File -->
                                    <div class="flex-shrink-0">
                                          <div class="w-14 h-14 sm:w-16 sm:h-16 bg-gradient-to-br from-red-50 to-red-100 border-2 border-red-200 rounded-xl flex items-center justify-center group-hover:scale-110 transition-transform duration-300">
                                                <svg class="w-7 h-7 sm:w-8 sm:h-8 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                                                      <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd" />
                                                </svg>
                                          </div>
                                    </div>

                                    <!-- Text Content -->
                                    <div class="flex-1 min-w-0">

                                          <h3 class="font-bold text-slate-900 text-base sm:text-lg leading-snug group-hover:text-emerald-600 transition-colors duration-200">
                                                {{ $dokumen->nama_dokumen }}
                                          </h3>

                                          <p class="text-sm sm:text-base text-slate-600 leading-relaxed mb-4">
                                                {{ $dokumen->deskripsi }}
                                          </p>

                                          <div class="flex flex-wrap items-center gap-4 sm:gap-6 text-xs sm:text-sm text-slate-500">

                                                <!-- Ukuran File -->
                                                <span class="inline-flex items-center gap-1.5">
                                                      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                                                      </svg>
                                                      {{ number_format($dokumen->ukuran_file / 1024 / 1024, 1) }} MB
                                                </span>

                                                <!-- Download Count -->
                                                <span class="inline-flex items-center gap-1.5">
                                                      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                                      </svg>
                                                      {{ $dokumen->jumlah_download }} downloads
                                                </span>

                                                <!-- Tanggal Upload -->
                                                <span class="inline-flex items-center gap-1.5">
                                                      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                      </svg>
                                                      {{ $dokumen->created_at->format('d M Y') }}
                                                </span>

                                          </div>
                                    </div>
                              </div>

                              <!-- Download Button -->
                              <div class="lg:flex-shrink-0">
                                    <a href="{{ route('dokumens.download', $dokumen) }}"
                                          class="inline-flex items-center justify-center gap-2 w-full lg:w-auto px-6 py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-lg transition-all duration-200 shadow-sm hover:shadow-md hover:-translate-y-0.5">
                                          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                          </svg>
                                          Download
                                    </a>
                              </div>

                        </div>
                  </article>

                  @empty
                  <div class="text-center py-12 text-slate-500">
                        Dokumen belum tersedia.
                  </div>
                  @endforelse

            </div>
      </div>
</section>


<!-- CTA -->
<section class="relative bg-gradient-to-br from-emerald-600 to-emerald-700 py-16 sm:py-20 overflow-hidden">
      <!-- Decorative Elements -->
      <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 right-0 w-64 h-64 bg-white rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 w-64 h-64 bg-white rounded-full blur-3xl"></div>
      </div>

      <div class="relative max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl sm:text-3xl font-bold text-white mb-4">
                  Membutuhkan Dokumen Lain?
            </h2>
            <p class="text-emerald-100 mb-8 max-w-xl mx-auto">
                  Silakan hubungi admin untuk permintaan dokumen tambahan atau informasi lebih lanjut
            </p>

            <div class="flex flex-wrap gap-4 justify-center">
                  <a href="https://wa.me/625743229703?text=Assalamu%E2%80%99alaikum,%20saya%20ingin%20menghubungi%20admin%20zakat,%20sedekah,%20dan%20donasi."
                        class="group inline-flex items-center gap-2 px-8 py-3.5 bg-white text-emerald-700 font-semibold rounded-lg hover:bg-emerald-50 transition-all duration-200 shadow-lg hover:shadow-xl hover:-translate-y-0.5">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        Hubungi Admin
                        <span class="inline-block transition-transform duration-200 group-hover:translate-x-1">→</span>
                  </a>
            </div>
      </div>
</section>

@endsection