@extends('layouts.public.app')
@section('title', 'Laporan Tahunan - Lazisnu Bojonegoro')
@section('content')

<div class="min-h-screen bg-gradient-to-b from-slate-50 to-white  ">
      <!-- Hero Section -->
      <div class="relative py-12 md:py-20 bg-white  border-b border-slate-200 ">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                  <div class="text-center">
                        <h1 class="text-4xl md:text-5xl font-bold text-emerald-600  mb-3">
                              Laporan Tahunan
                        </h1>
                        <p class="text-lg text-slate-600  max-w-2xl mx-auto">
                              Formulir laporan tahunan untuk memberikan gambaran lengkap tentang kegiatan, keuangan, dan dampak yang telah dicapai oleh NU CARE Lazisnu Bojonegoro selama setahun terakhir.
                        </p>
                  </div>
            </div>
      </div>

      <!-- Main Content -->
      <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-8 md:py-4">

            @if($laporanTahunans->count() > 0)
            <div class="mb-8">
                  <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                        @foreach($laporanTahunans as $laporan)
                        <a href="{{ $laporan->link_from }}" target="_blank" rel="noopener noreferrer"
                              class="group relative block">

                              <h3 class="text-center font-semibold text-black  text-xl">
                                    {{ $laporan->nama }}
                              </h3>
                        </a>
                        @endforeach
                  </div>
            </div>
            @else
            <!-- Empty State -->
            <div class="text-center py-16">
                  <svg class="w-20 h-20 text-slate-300  mx-auto mb-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                  </svg>
                  <h3 class="text-xl font-semibold text-slate-700  mb-2">
                        Laporan Belum Tersedia
                  </h3>
                  <p class="text-slate-600 ">
                        Laporan tahunan akan segera ditampilkan di sini
                  </p>
            </div>
            @endif

      </div>

      <!-- Panduan Section -->
      <div class="bg-slate-100  border-t border-slate-200  py-12 md:py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                  <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
                        <div>
                              <h2 class="text-3xl font-bold text-slate-900  mb-4">
                                    Panduan dan Bantuan
                              </h2>
                              <p class="text-slate-700  leading-relaxed mb-6">
                                    Untuk informasi lebih lanjut tentang laporan tahunan dan pertanyaan umum, silahkan hubungi kami melalui WhatsApp atau email.
                              </p>
                              <div class="flex flex-wrap gap-4">
                                    <a href="https://wa.me/6285743229703" target="_blank"
                                          class="inline-flex items-center gap-2 px-6 py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-lg transition-colors duration-300 shadow-lg hover:shadow-xl">
                                          Hubungi WhatsApp
                                    </a>
                              </div>
                        </div>

                  </div>
            </div>
      </div>

</div>

@endsection