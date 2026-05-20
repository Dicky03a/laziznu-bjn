@extends('layouts.public.app')
@section('title', 'Laporan Bulanan - Lazisnu Bojonegoro')
@section('content')

<!-- Hero Section -->
<section class="bg-gradient-to-br from-emerald-700 via-emerald-600 to-emerald-800 py-24 text-white">
      <div class="max-w-5xl mx-auto px-6 text-center">
            <h1 class="text-5xl font-bold tracking-tight mb-4">
                  Laporan Bulanan
            </h1>
            <p class="text-emerald-50 max-w-2xl mx-auto leading-relaxed text-lg">
                  Transparansi penuh dalam setiap laporan bulanan Lazisnu Bojonegoro. Akses dan lihat laporan lengkap kami di bawah ini.
            </p>
      </div>
</section>

<div class="max-w-5xl mx-auto px-6 py-16" x-data="{ activeAccordion: null }">
      @if($laporanBulanan->count())
            <div class="space-y-4">
                  @foreach($laporanBulanan as $laporan)
                  <div class="border border-gray-200 rounded-2xl overflow-hidden shadow-sm bg-white transition-all duration-300">
                        <!-- Accordion Header -->
                        <button 
                              @click="activeAccordion === {{ $laporan->id }} ? activeAccordion = null : activeAccordion = {{ $laporan->id }}"
                              class="w-full px-8 py-6 flex items-center justify-between text-left hover:bg-gray-50 transition-colors group"
                              :class="activeAccordion === {{ $laporan->id }} ? 'bg-emerald-50' : ''"
                        >
                              <div class="flex items-center gap-4">
                                    <div class="p-3 rounded-xl bg-emerald-100 text-emerald-600 group-hover:bg-emerald-200 transition-colors">
                                          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                          </svg>
                                    </div>
                                    <div>
                                          <h3 class="text-xl font-semibold text-gray-800">{{ $laporan->nama_laporan }}</h3>
                                          <p class="text-sm text-gray-500">Klik untuk melihat detail laporan</p>
                                    </div>
                              </div>
                              <div class="text-gray-400 transition-transform duration-300" :class="activeAccordion === {{ $laporan->id }} ? 'rotate-180 text-emerald-500' : ''">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                              </div>
                        </button>

                        <!-- Accordion Content -->
                        <div 
                              x-show="activeAccordion === {{ $laporan->id }}"
                              x-collapse
                              x-cloak
                        >
                              <div class="p-4 bg-gray-50 border-t border-gray-100">
                                    <div class="w-full rounded-xl overflow-hidden shadow-inner border border-gray-200 bg-white">
                                          <template x-if="activeAccordion === {{ $laporan->id }}">
                                                <iframe
                                                      src="{{ asset('pdfjs/web/viewer.html') }}?file={{ asset('storage/laporan-bulanan/' . $laporan->file_laporan) }}"
                                                      class="w-full h-[80vh]"
                                                      loading="lazy">
                                                </iframe>
                                          </template>
                                    </div>
                              </div>
                        </div>
                  </div>
                  @endforeach
            </div>
      @else
            <div class="text-center py-24">
                  <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-gray-100 text-gray-400 mb-6">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                  </div>
                  <h3 class="text-2xl font-bold text-gray-800 mb-2">
                        Belum Ada Laporan
                  </h3>
                  <p class="text-gray-500 max-w-sm mx-auto">
                        Laporan bulanan belum tersedia saat ini. Silahkan cek kembali di lain waktu.
                  </p>
            </div>
      @endif
</div>
@endsection
