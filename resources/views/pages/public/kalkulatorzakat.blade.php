@extends('layouts.public.app')
@section('title', 'Hitung Zakat - LAZIZNU Bojonegoro')
@section('content')

{{-- ================= HERO ================= --}}
<section class="relative bg-gradient-to-br from-emerald-900 via-emerald-800 to-emerald-700 py-16 sm:py-20 lg:py-24 overflow-hidden">

      <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 right-0 w-72 sm:w-96 h-72 sm:h-96 bg-white rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 w-64 sm:w-80 h-64 sm:h-80 bg-white rounded-full blur-3xl"></div>
      </div>

      <div class="max-w-5xl mx-auto px-5 sm:px-6 lg:px-8 text-center relative z-10">

            <div class="inline-flex items-center justify-center w-16 h-16 sm:w-20 sm:h-20 bg-white/10 rounded-2xl mb-6 border border-white/20">
                  <svg class="w-8 h-8 sm:w-10 sm:h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z" />
                  </svg>
            </div>

            <h1 class="text-3xl sm:text-4xl lg:text-6xl font-bold text-white mb-6">
                  Kalkulator <span class="text-emerald-300">Zakat</span>
            </h1>

            <p class="text-emerald-50 text-base sm:text-lg max-w-3xl mx-auto">
                  Hitung kewajiban zakat Anda secara mudah dan sesuai ketentuan syariat Islam.
            </p>

            {{-- Stats --}}
            <div class="mt-10 grid grid-cols-1 sm:grid-cols-3 gap-4 sm:gap-6">
                  <div class="bg-white/10 backdrop-blur-md rounded-2xl p-5 border border-white/20">
                        <h3 class="text-2xl sm:text-3xl font-bold text-white">2.5%</h3>
                        <p class="text-emerald-200 text-sm">Nisab Maal</p>
                  </div>
                  <div class="bg-white/10 backdrop-blur-md rounded-2xl p-5 border border-white/20">
                        <h3 class="text-2xl sm:text-3xl font-bold text-white">85g</h3>
                        <p class="text-emerald-200 text-sm">Emas</p>
                  </div>
                  <div class="bg-white/10 backdrop-blur-md rounded-2xl p-5 border border-white/20">
                        <h3 class="text-2xl sm:text-3xl font-bold text-white">1 Haul</h3>
                        <p class="text-emerald-200 text-sm">Periode</p>
                  </div>
            </div>

      </div>
</section>


{{-- ================= CALCULATOR ================= --}}
<section class="py-16 sm:py-20 bg-gradient-to-b from-gray-50 to-white">
      <div class="max-w-6xl mx-auto px-5 sm:px-6 lg:px-8">

            <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden">

                  {{-- FORM --}}
                  <div class="p-6 sm:p-8 lg:p-10 space-y-10">

                        <div>
                              <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-2">
                                    Zakat Harta (Maal)
                              </h2>
                              <p class="text-gray-600 mb-6">
                                    Masukkan total harta Anda
                              </p>

                              <div class="space-y-5">

                                    {{-- Input --}}
                                    @foreach([
                                    'Uang Tunai & Tabungan',
                                    'Emas / Perak',
                                    'Properti Investasi',
                                    'Saham & Investasi'
                                    ] as $label)

                                    <div>
                                          <label class="text-sm font-semibold text-gray-700 block mb-2">
                                                {{ $label }}
                                          </label>

                                          <div class="flex items-center border-2 border-gray-200 focus-within:border-emerald-500 rounded-xl overflow-hidden transition">
                                                <span class="px-4 py-3 bg-gray-100 text-gray-600 font-semibold">Rp</span>
                                                <input type="text"
                                                      placeholder="0"
                                                      class="flex-1 px-4 py-3 outline-none text-gray-900 font-semibold">
                                          </div>
                                    </div>

                                    @endforeach

                              </div>
                        </div>

                        {{-- RESULT --}}
                        <div class="bg-gradient-to-br from-emerald-600 to-emerald-500 rounded-3xl p-6 sm:p-10 text-white shadow-xl">

                              <h3 class="text-xl sm:text-2xl font-bold mb-6">
                                    Estimasi Zakat
                              </h3>

                              <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-8">

                                    <div class="bg-white text-emerald-700 rounded-2xl p-6">
                                          <p class="text-sm font-semibold mb-2">Per Tahun (2.5%)</p>
                                          <h2 class="text-3xl sm:text-4xl font-bold">Rp 0</h2>
                                    </div>

                                    <div class="bg-white text-blue-700 rounded-2xl p-6">
                                          <p class="text-sm font-semibold mb-2">Per Bulan (Opsional)</p>
                                          <h2 class="text-3xl sm:text-4xl font-bold">Rp 0</h2>
                                    </div>

                              </div>

                              <div class="flex flex-col sm:flex-row gap-4">
                                    <button class="flex-1 bg-white text-emerald-700 py-4 rounded-xl font-bold hover:bg-gray-100 transition">
                                          Tunaikan Zakat
                                    </button>
                                    <button class="flex-1 border border-white py-4 rounded-xl font-bold hover:bg-white/10 transition">
                                          Konsultasi
                                    </button>
                              </div>

                        </div>

                  </div>

            </div>

            {{-- INFO CARDS --}}
            <div class="mt-12 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                  <div class="bg-white p-6 rounded-2xl shadow border border-gray-100">
                        <h3 class="font-bold text-lg mb-2">Perhitungan Akurat</h3>
                        <p class="text-gray-600 text-sm">
                              Mengikuti ketentuan syariat Islam.
                        </p>
                  </div>

                  <div class="bg-white p-6 rounded-2xl shadow border border-gray-100">
                        <h3 class="font-bold text-lg mb-2">Privasi Terjamin</h3>
                        <p class="text-gray-600 text-sm">
                              Data Anda aman dan tidak disimpan.
                        </p>
                  </div>

                  <div class="bg-white p-6 rounded-2xl shadow border border-gray-100">
                        <h3 class="font-bold text-lg mb-2">Konsultasi Gratis</h3>
                        <p class="text-gray-600 text-sm">
                              Tim siap membantu Anda.
                        </p>
                  </div>

            </div>

      </div>
</section>

@endsection