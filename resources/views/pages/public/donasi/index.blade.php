{{--
  FILE: resources/views/public/infaq/index.blade.php
  FILE: resources/views/public/donasi/index.blade.php  — sama strukturnya, ganti variable
  Untuk donasi, route('donasi.show') dan judul "Donasi"
--}}
@extends('layouts.public.app')
@section('title', 'Program Donasi - LAZIZNU Bojonegoro')
@section('content')

{{-- Hero --}}
<section class="relative bg-gradient-to-br from-emerald-600 to-emerald-700 py-20 sm:py-24 overflow-hidden">
      <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 left-0 w-96 h-96 bg-emerald-500 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-emerald-600 rounded-full blur-3xl"></div>
      </div>
      <div class="relative max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
            <div class="inline-block mb-6 px-4 py-1.5 bg-emerald-500/20 backdrop-blur-sm rounded-full border border-emerald-400/30">
                  <span class="text-emerald-200 text-sm font-medium">Program LAZIZNU Bojonegoro</span>
            </div>
            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white tracking-tight mb-4">
                  Program Infaq
            </h1>
            <p class="text-base sm:text-lg text-emerald-100/90 max-w-2xl mx-auto leading-relaxed">
                  Salurkan infaq terbaik Anda untuk program-program kemanusiaan dan sosial LAZIZNU Bojonegoro
            </p>
      </div>
</section>

{{-- Programs Grid --}}
<section class="bg-gray-50 py-16 sm:py-20">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if($programs->isEmpty())
            <div class="text-center py-20">
                  <svg class="w-16 h-16 text-gray-300 mx-auto mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                  </svg>
                  <p class="text-gray-500 font-semibold text-lg">Belum ada program infaq tersedia</p>
                  <p class="text-gray-400 text-sm mt-1">Silakan cek kembali nanti</p>
            </div>
            @else
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                  @foreach($programs as $program)
                  <a href="{{ route('donasi.show', $program->slug) }}"
                        class="group bg-white rounded-3xl shadow-sm hover:shadow-xl transition-all duration-300 border border-gray-100 hover:border-emerald-200 overflow-hidden flex flex-col">

                        {{-- Thumbnail --}}
                        <div class="relative h-48 overflow-hidden bg-gray-100">
                              <img src="{{ $program->thumbnail_url }}"
                                    alt="{{ $program->nama }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                              @if($program->is_featured)
                              <div class="absolute top-3 left-3">
                                    <span class="px-2.5 py-1 bg-amber-400 text-amber-900 text-xs font-bold rounded-full">⭐ Unggulan</span>
                              </div>
                              @endif
                              @if($program->end_date && $program->end_date->diffInDays(now()) <= 7 && !$program->end_date->isPast())
                                    <div class="absolute top-3 right-3">
                                          <span class="px-2.5 py-1 bg-red-500 text-white text-xs font-bold rounded-full">Segera Berakhir</span>
                                    </div>
                                    @endif
                        </div>

                        {{-- Content --}}
                        <div class="p-6 flex flex-col flex-1">
                              <div class="flex items-center gap-2 mb-3">
                                    <span class="px-2.5 py-0.5 bg-blue-100 text-blue-700 text-xs font-semibold rounded-full">Infaq</span>
                                    @if(!$program->end_date)
                                    <span class="px-2.5 py-0.5 bg-gray-100 text-gray-600 text-xs font-medium rounded-full">Berkelanjutan</span>
                                    @endif
                              </div>

                              <h3 class="font-bold text-gray-900 text-lg mb-2 line-clamp-2 group-hover:text-emerald-700 transition-colors">
                                    {{ $program->nama }}
                              </h3>
                              <p class="text-gray-500 text-sm line-clamp-3 flex-1">{{ $program->deskripsi }}</p>

                              {{-- Stats --}}
                              <div class="mt-5 pt-4 border-t border-gray-100">
                                    <div class="flex justify-between items-center text-sm">
                                          <div>
                                                <p class="font-bold text-emerald-600">Rp {{ number_format($program->total_terkumpul, 0, ',', '.') }}</p>
                                                <p class="text-xs text-gray-400 mt-0.5">terkumpul</p>
                                          </div>
                                          <div class="text-right">
                                                <p class="font-bold text-blue-600">{{ number_format($program->total_donatur) }}</p>
                                                <p class="text-xs text-gray-400 mt-0.5">donatur</p>
                                          </div>
                                    </div>
                              </div>

                              <div class="mt-4 py-3 px-4 bg-emerald-600 group-hover:bg-emerald-700 text-white text-sm font-semibold rounded-xl text-center transition-all">
                                    Donasi Sekarang →
                              </div>
                        </div>
                  </a>
                  @endforeach
            </div>

            {{-- Pagination --}}
            @if($programs->hasPages())
            <div class="mt-10 flex justify-center">
                  {{ $programs->links() }}
            </div>
            @endif

            @endif
      </div>
</section>

@endsection