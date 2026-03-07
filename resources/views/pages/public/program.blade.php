@extends('layouts.public.app')
@section('title', 'Program - LAZIZNU Bojonegoro')
@section('content')

<section class="relative bg-gradient-to-br from-emerald-900 via-emerald-800 to-emerald-700 py-16 sm:py-20 lg:py-24 overflow-hidden">

      {{-- Decorative Blur --}}
      <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 right-0 w-72 sm:w-96 h-72 sm:h-96 bg-white rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 w-64 sm:w-80 h-64 sm:h-80 bg-white rounded-full blur-3xl"></div>
      </div>

      <div class="max-w-7xl mx-auto px-5 sm:px-6 lg:px-8 relative z-10">

            @if($programUnggulan)

            <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">

                  {{-- LEFT CONTENT --}}
                  <div class="space-y-6 sm:space-y-8">

                        <div>
                              <span class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-600/30 backdrop-blur-sm rounded-full text-emerald-100 text-xs sm:text-sm font-medium mb-4">
                                    Program Unggulan
                              </span>

                              <h1 class="text-3xl sm:text-4xl lg:text-6xl font-bold text-white leading-tight">
                                    {{ $programUnggulan->nama }}
                              </h1>
                        </div>

                        <p class="text-emerald-50 text-base sm:text-lg leading-relaxed">
                              {{ \Illuminate\Support\Str::limit($programUnggulan->deskripsi, 180) }}
                        </p>

                        {{-- Stats --}}
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mt-6 sm:mt-10">

                              <div class="bg-white/10 backdrop-blur-md rounded-2xl p-5 sm:p-6 border border-white/20">
                                    <p class="text-emerald-200 text-sm font-medium mb-2">Dana Terkumpul</p>
                                    <h2 class="text-2xl sm:text-3xl font-bold text-white">
                                          Rp {{ number_format($programUnggulan->total_terkumpul ?? 0,0,',','.') }}
                                    </h2>
                              </div>

                              <div class="bg-white/10 backdrop-blur-md rounded-2xl p-5 sm:p-6 border border-white/20">
                                    <p class="text-emerald-200 text-sm font-medium mb-2">Target Dana</p>
                                    <h2 class="text-2xl sm:text-3xl font-bold text-white">
                                          Rp {{ number_format($programUnggulan->target_dana ?? 0,0,',','.') }}
                                    </h2>
                              </div>

                        </div>

                        {{-- Progress --}}
                        <div class="space-y-3">
                              <div class="flex justify-between items-center">
                                    <span class="text-emerald-100 text-sm font-medium">Progress Donasi</span>
                                    <span class="text-white text-sm font-bold">
                                          {{ $programUnggulan->progress_persen }}%
                                    </span>
                              </div>

                              <div class="w-full bg-emerald-950/50 rounded-full h-3 sm:h-4 overflow-hidden">
                                    <div class="bg-gradient-to-r from-emerald-400 to-emerald-500 h-3 sm:h-4 rounded-full transition-all duration-500"
                                          style="width:{{ $programUnggulan->progress_persen }}%">
                                    </div>
                              </div>

                              <p class="text-emerald-200 text-sm">
                                    Rp {{ number_format(
                            max(0, ($programUnggulan->target_dana ?? 0) - ($programUnggulan->total_terkumpul ?? 0)),
                            0, ',', '.'
                        ) }} lagi untuk mencapai target
                              </p>
                        </div>
                  </div>

                  {{-- RIGHT IMAGE --}}
                  <div class="relative mt-10 lg:mt-0">

                        <div>
                              <img src="{{ $programUnggulan->thumbnail_url }}"
                                    class="rounded-3xl shadow-2xl w-300 transition-transform duration-500 hover:scale-105">
                        </div>

                  </div>

            </div>

            @else

            {{-- Fallback jika tidak ada program unggulan --}}
            <div class="text-center text-white py-20">
                  <h2 class="text-3xl font-bold mb-4">Belum Ada Program Unggulan</h2>
                  <p class="text-emerald-200">Silakan tambahkan program unggulan dari panel admin.</p>
            </div>

            @endif

      </div>
</section>



<section class="bg-gradient-to-b from-gray-50 to-white py-16 sm:py-20">
      <div class="max-w-5xl mx-auto px-5 sm:px-6 lg:px-8">

            <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden">

                  <div class="bg-gradient-to-r from-emerald-600 to-emerald-500 px-5 sm:px-8 py-5 sm:py-6">
                        <div class="flex flex-col sm:flex-row sm:justify-between gap-3">
                              <h3 class="text-xl sm:text-2xl font-bold text-white">
                                    Donasi Terbaru
                              </h3>
                              <span class="px-4 py-2 bg-white/20 rounded-full text-white text-sm">
                                    Live Update
                              </span>
                        </div>
                  </div>

                  <div class="p-5 sm:p-6 lg:p-8 space-y-4">

                        {{-- Donation Item --}}
                        @forelse($donasiTerbaru as $donasi)
                        <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-5 p-5 rounded-2xl bg-gray-50 border border-gray-100 hover:shadow-md transition">

                              <div>
                                    <p class="font-semibold text-gray-800 text-lg">
                                          {{ $donasi->nama_tampil }}
                                    </p>
                                    <p class="text-xs text-gray-500">
                                          {{ $donasi->program?->nama ?? '-' }}
                                    </p>
                              </div>

                              <div class="sm:text-right">
                                    <p class="text-xl sm:text-2xl font-bold text-emerald-600">
                                          Rp {{ number_format($donasi->jumlah,0,',','.') }}
                                    </p>
                                    <p class="text-xs text-gray-500">
                                          {{ $donasi->metode_pembayaran ?? 'Transfer Bank' }}
                                    </p>
                              </div>
                        </div>
                        @empty
                        <p class="text-gray-500 text-center py-6">
                              Belum ada donasi terbaru.
                        </p>
                        @endforelse


                  </div>

            </div>

      </div>
</section>


<section class="py-20 sm:py-24 bg-white">
      <div class="max-w-7xl mx-auto px-5 sm:px-6 lg:px-8">

            <div class="flex flex-col md:flex-row md:justify-between gap-6 mb-10 sm:mb-12">
                  <div>
                        <h2 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-gray-900 mb-2">
                              Semua Program
                        </h2>
                        <p class="text-gray-600">
                              Pilih program sesuai kepedulian Anda
                        </p>
                  </div>
            </div>

            {{-- Grid --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-6 sm:gap-8">

                  {{-- Card --}}
                  @forelse($programs as $program)
                  <div class="bg-white rounded-3xl shadow-md hover:shadow-xl transition overflow-hidden border border-gray-100">

                        <div class="h-56 overflow-hidden">
                              <img src="{{ $program->thumbnail_url }}"
                                    class="w-full h-full object-cover hover:scale-110 transition duration-700">
                        </div>

                        <div class="p-5 sm:p-6">
                              <h3 class="font-bold text-gray-900 text-lg sm:text-xl mb-3">
                                    {{ $program->nama }}
                              </h3>

                              <p class="text-gray-600 text-sm mb-5">
                                    {{ \Illuminate\Support\Str::limit($program->deskripsi, 100) }}
                              </p>

                              <div class="space-y-2 mb-4">
                                    <div class="flex justify-between text-sm">
                                          <span>{{ $program->progress_persen }}%</span>
                                          <span>
                                                Rp {{ number_format($program->total_terkumpul ?? 0,0,',','.') }}
                                                /
                                                {{ number_format($program->target_dana ?? 0,0,',','.') }}
                                          </span>
                                    </div>

                                    <div class="w-full bg-gray-200 h-2 rounded-full overflow-hidden">
                                          <div class="bg-emerald-500 h-2 rounded-full"
                                                style="width:{{ $program->progress_persen }}%">
                                          </div>
                                    </div>
                              </div>

                              <div class="flex flex-col sm:flex-row sm:justify-between gap-3 pt-4 border-t border-gray-100">
                                    <span class="text-sm text-gray-600">
                                          {{ $program->total_donatur ?? 0 }} Donatur
                                    </span>
                                    <a href="{{ route($program->type . '.show', $program->slug) }}"
                                          class="inline-block px-4 py-2 bg-emerald-600 text-white rounded-full text-sm font-medium hover:bg-emerald-700 transition">
                                          Donasi Sekarang
                                    </a>
                              </div>
                        </div>
                  </div>
                  @empty
                  <p class="text-gray-500 col-span-3 text-center py-12">
                        Belum ada program tersedia.
                  </p>
                  @endforelse


            </div>



      </div>
</section>

@endsection