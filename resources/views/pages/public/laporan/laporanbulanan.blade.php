@extends('layouts.public.app')
@section('title', 'Laporan Tahunan - LAZIZNU Bojonegoro')
@section('content')

<!-- Hero Section -->
@if($laporanBulanan->count())
@foreach($laporanBulanan as $laporan)
<section class="bg-gradient-to-br from-emerald-700 via-emerald-600 to-emerald-800 py-24 text-white">
      <div class="max-w-5xl mx-auto px-6 text-center">
            <h1 class="text-5xl font-bold tracking-tight mb-4">
                  {{ $laporan->nama_laporan }}
            </h1>
            <p class="text-emerald-50 max-w-2xl mx-auto leading-relaxed text-lg">
                  Transparansi penuh dalam setiap laporan bulanan LAZIZNU Bojonegoro. Akses dan download laporan lengkap kami di sini.
            </p>
      </div>
</section>

<div class="max-w-5xl mx-auto px-6 py-16">
      <div class="mb-16">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6 text-center">
                  {{ $laporan->nama_laporan }}
            </h2>
            <div class="w-full rounded-2xl overflow-hidden shadow-sm border border-gray-100">
                  <iframe
                        src="{{ asset('storage/laporan-bulanan/' . $laporan->file_laporan) }}"
                        class="w-full"
                        style="height: 85vh;"
                        loading="lazy">
                  </iframe>
            </div>
      </div>
      @endforeach
      @else
      <div class="text-center py-24">
            <h3 class="text-lg font-semibold text-gray-700 mb-2">
                  Belum Ada Laporan
            </h3>
            <p class="text-gray-500 text-sm">
                  Laporan tahunan belum tersedia saat ini.
            </p>
      </div>
      @endif
</div>
@endsection