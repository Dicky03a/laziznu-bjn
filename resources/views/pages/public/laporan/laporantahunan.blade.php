@extends('layouts.public.app')
@section('title', 'Laporan Tahunan - LAZIZNU Bojonegoro')
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
                              Akses laporan dan informasi tahunan kami. Pilih kategori untuk melihat detail laporan.
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

                              <div class="relative h-20 bg-gradient-to-br from-emerald-500 to-emerald-700 rounded-lg shadow-md hover:shadow-lg transform transition-all duration-200 hover:scale-105 flex items-center justify-center overflow-hidden">
                                    <div class="relative z-10 flex items-center justify-center px-2">
                                          <h3 class="text-center font-semibold text-amber-200 text-xl group-hover:text-white transition-colors duration-200">
                                                {{ $laporan->nama }}
                                          </h3>
                                    </div>
                                    <div class="absolute inset-0 bg-emerald-900/0 group-hover:bg-emerald-900/20 transition-colors duration-200">
                                    </div>
                              </div>
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
                              <a href="https://wa.me/628123456789" target="_blank"
                                    class="inline-flex items-center gap-2 px-6 py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-lg transition-colors duration-300 shadow-lg hover:shadow-xl">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                          <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.67-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.076 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421-7.403h-.004a9.87 9.87 0 00-5.031 1.378l-.361.214-3.741-.982.998 3.645-.235.364a9.861 9.861 0 001.516 5.394c.732 1.092 1.771 2.041 2.986 2.71l.476.28 3.911.902-.975-3.648.163-.469a9.87 9.87 0 002.516-5.386c.096-1.161-.023-2.305-.67-3.263a9.809 9.809 0 00-2.164-2.777l-.049-.041zM21.12 11.84c0 5.324-4.376 9.644-9.744 9.644a9.812 9.812 0 01-4.662-1.182l-5.41 1.42 1.536-5.592a9.851 9.851 0 011.523-5.593c2.136-3.205 5.42-5.12 9.013-5.12 5.368 0 9.744 4.32 9.744 9.623z" />
                                    </svg>
                                    Hubungi WhatsApp
                              </a>
                        </div>
                  </div>

            </div>
      </div>
</div>

</div>

@endsection