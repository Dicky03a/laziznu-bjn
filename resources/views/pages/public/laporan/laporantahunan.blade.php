@extends('layouts.public.app')
@section('title', 'Laporan Tahunan - LAZIZNU Bojonegoro')
@section('content')

<section class="bg-gradient-to-br from-emerald-800 to-green-700 py-24 text-white">
      <div class="max-w-5xl mx-auto px-6 text-center">

            <h1 class="text-4xl font-bold tracking-tight">
                  Formulir Laporan 2025
            </h1>

            <p class="mt-6 text-green-100 max-w-2xl mx-auto leading-relaxed">
                  Laporan bulanan LAZISNU MWC dan Ranting Kabupaten Jepara.
                  Silakan pilih kecamatan untuk mengakses formulir pelaporan.
            </p>

      </div>
</section>

<section class="py-20 bg-gray-50">
      <div class="max-w-7xl mx-auto px-6">

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">

                  {{-- CARD --}}
                  <a href="#"
                        class="group bg-white rounded-2xl shadow-sm hover:shadow-xl transition duration-300 p-8 border border-gray-100">

                        <div class="flex items-center justify-between">
                              <div>
                                    <h3 class="text-lg font-semibold text-gray-800 group-hover:text-green-700 transition">
                                          Bangsri
                                    </h3>
                                    <p class="text-sm text-gray-400 mt-1">
                                          Akses laporan kecamatan
                                    </p>
                              </div>

                              <div class="bg-green-100 text-green-700 p-3 rounded-xl group-hover:bg-green-600 group-hover:text-white transition">
                                    📁
                              </div>
                        </div>
                  </a>



                  {{-- COPY CARD & GANTI NAMA --}}
                  <a href="#" class="group bg-white rounded-2xl shadow-sm hover:shadow-xl transition p-8 border border-gray-100">
                        <div class="flex items-center justify-between">
                              <div>
                                    <h3 class="text-lg font-semibold text-gray-800 group-hover:text-green-700">
                                          Jepara Kota
                                    </h3>
                                    <p class="text-sm text-gray-400 mt-1">
                                          Akses laporan kecamatan
                                    </p>
                              </div>

                              <div class="bg-green-100 text-green-700 p-3 rounded-xl group-hover:bg-green-600 group-hover:text-white transition">
                                    📁
                              </div>
                        </div>
                  </a>



                  <a href="#" class="group bg-white rounded-2xl shadow-sm hover:shadow-xl transition p-8 border border-gray-100">
                        <div class="flex items-center justify-between">
                              <div>
                                    <h3 class="text-lg font-semibold text-gray-800 group-hover:text-green-700">
                                          Tahunan
                                    </h3>
                                    <p class="text-sm text-gray-400 mt-1">
                                          Akses laporan kecamatan
                                    </p>
                              </div>

                              <div class="bg-green-100 text-green-700 p-3 rounded-xl group-hover:bg-green-600 group-hover:text-white transition">
                                    📁
                              </div>
                        </div>
                  </a>



                  <a href="#" class="group bg-white rounded-2xl shadow-sm hover:shadow-xl transition p-8 border border-gray-100">
                        <div class="flex items-center justify-between">
                              <div>
                                    <h3 class="text-lg font-semibold text-gray-800 group-hover:text-green-700">
                                          Pecangaan
                                    </h3>
                                    <p class="text-sm text-gray-400 mt-1">
                                          Akses laporan kecamatan
                                    </p>
                              </div>

                              <div class="bg-green-100 text-green-700 p-3 rounded-xl group-hover:bg-green-600 group-hover:text-white transition">
                                    📁
                              </div>
                        </div>
                  </a>

            </div>

      </div>
</section>

<section class="pb-24 bg-gray-50">
      <div class="max-w-6xl mx-auto px-6">

            <div class="bg-white rounded-3xl shadow-xl p-12 flex flex-col md:flex-row items-center justify-between gap-8 border border-gray-100">

                  <div>
                        <h3 class="text-2xl font-semibold text-gray-800">
                              Panduan & Bantuan Pelaporan
                        </h3>
                        <p class="text-gray-500 mt-4 max-w-xl leading-relaxed">
                              Jika mengalami kendala dalam pengisian laporan LAZISNU MWC
                              maupun Ranting, silakan hubungi tim administrasi kami
                              untuk mendapatkan bantuan teknis.
                        </p>
                  </div>

                  <a href="#"
                        class="bg-green-600 text-white px-8 py-3 rounded-xl font-medium shadow-md hover:bg-green-700 transition">
                        Hubungi WhatsApp
                  </a>

            </div>

      </div>
</section>


@endsection