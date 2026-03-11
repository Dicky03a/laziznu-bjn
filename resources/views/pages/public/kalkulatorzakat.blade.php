@extends('layouts.public.app')
@section('title', 'Hitung Zakat - Lazisnu Bojonegoro')
@section('content')

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
<section class="py-16 sm:py-20 bg-gradient-to-b from-gray-50 to-white" x-data="{ activeTab: 'maal' }">
      <div class="max-w-6xl mx-auto px-5 sm:px-6 lg:px-8">

            {{-- TAB SWITCHER --}}
            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-2 mb-8 inline-flex w-full max-w-md mx-auto">
                  <button @click="activeTab = 'maal'"
                        :class="activeTab === 'maal' ? 'bg-emerald-600 text-white shadow-md' : 'text-gray-600 hover:bg-gray-50'"
                        class="flex-1 py-3 px-4 rounded-xl font-bold transition-all duration-200">
                        Zakat Maal
                  </button>
                  <button @click="activeTab = 'fitrah'"
                        :class="activeTab === 'fitrah' ? 'bg-emerald-600 text-white shadow-md' : 'text-gray-600 hover:bg-gray-50'"
                        class="flex-1 py-3 px-4 rounded-xl font-bold transition-all duration-200">
                        Zakat Fitrah
                  </button>
            </div>

            {{-- ================= ZAKAT MAAL ================= --}}
            <div
                  x-data="zakatMaal()"
                  x-show="activeTab === 'maal'"
                  x-transition:enter="transition ease-out duration-300"
                  x-transition:enter-start="opacity-0 transform scale-95"
                  x-transition:enter-end="opacity-100 transform scale-100"
                  class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden">

                  <div class="p-6 sm:p-8 lg:p-10 space-y-10">

                        {{-- HEADER --}}
                        <div>
                              <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-2">
                                    Zakat Harta (Maal)
                              </h2>
                              <p class="text-gray-600 mb-6">
                                    Masukkan total harta Anda yang tersimpan selama 1 tahun (haul)
                              </p>

                              {{-- HARGA EMAS --}}
                              <div class="bg-gradient-to-br from-emerald-600 to-emerald-500 rounded-xl p-4 sm:p-5 mb-6">

                                    <div class="flex flex-col sm:flex-row sm:items-start gap-3">
                                          <!-- CONTENT -->
                                          <div class="flex-1 w-full">

                                                <label class="text-sm sm:text-base font-semibold text-white block mb-2">
                                                      Harga Emas per Gram (Update Manual)
                                                </label>

                                                <!-- INPUT -->
                                                <div class="flex items-center w-full border-2 rounded-lg overflow-hidden bg-white">
                                                      <span class="px-3 py-2 text-emerald-700 font-semibold text-sm">
                                                            Rp
                                                      </span>

                                                      <input
                                                            type="text"
                                                            x-model="hargaEmasDisplay"
                                                            @input="updateHargaEmas()"
                                                            placeholder="950000"
                                                            class="flex-1 min-w-0 px-3 py-2 text-sm sm:text-base outline-none text-gray-900 font-semibold">

                                                      <span class="px-3 py-2 text-gray-500 text-xs sm:text-sm whitespace-nowrap">
                                                            /gram
                                                      </span>
                                                </div>

                                                <!-- INFO -->
                                                <p class="text-xs sm:text-sm text-white mt-2 leading-relaxed">
                                                      <svg class="w-3 h-3 inline mr-1" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" />
                                                      </svg>
                                                      Nisab = 85 gram emas =
                                                      <strong x-text="rupiah(nisab)"></strong>
                                                </p>

                                          </div>
                                    </div>
                              </div>


                              {{-- INPUT HARTA --}}
                              <div class="space-y-5">

                                    @foreach([
                                    'cash' => 'Uang Tunai & Tabungan',
                                    'gold' => 'Emas / Perak (nilai rupiah)',
                                    'property' => 'Properti Investasi',
                                    'stock' => 'Saham, Reksadana & Investasi'
                                    ] as $key => $label)

                                    <div>
                                          <label class="text-sm font-semibold text-gray-700 block mb-2">
                                                {{ $label }}
                                          </label>

                                          <div class="flex items-center border-2 border-gray-200 focus-within:border-emerald-500 rounded-xl overflow-hidden transition">
                                                <span class="px-4 py-3 bg-gray-100 text-gray-600 font-semibold">Rp</span>

                                                <input type="text"
                                                      x-model="form.{{ $key }}"
                                                      @input="formatInput('{{ $key }}')"
                                                      placeholder="0"
                                                      class="flex-1 px-4 py-3 outline-none text-gray-900 font-semibold">
                                          </div>
                                    </div>

                                    @endforeach

                              </div>

                              {{-- TOTAL HARTA --}}
                              <div class="mt-6 bg-gray-50 rounded-xl p-4 border border-gray-200">
                                    <div class="flex justify-between items-center">
                                          <span class="text-sm font-semibold text-gray-700">Total Harta Anda:</span>
                                          <span class="text-xl font-bold text-gray-900" x-text="rupiah(total)"></span>
                                    </div>
                              </div>
                        </div>


                        {{-- INFO NISAB --}}
                        <div class="bg-gradient-to-br from-emerald-600 to-emerald-500 rounded-xl p-5 border-2"
                              :class="total >= nisab ? 'from-emerald-600 to-emerald-500 border-emerald-300' : 'from-red-50 to-orange-50 border-red-300'">

                              <div class="flex items-start gap-3">
                                    <div class="w-10 h-10 rounded-lg flex items-center justify-center flex-shrink-0"
                                          :class="total >= nisab ? 'bg-emerald-100' : 'bg-red-100'">
                                          <svg class="w-6 h-6" :class="total >= nisab ? 'text-emerald-600' : 'text-red-600'" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" />
                                          </svg>
                                    </div>

                                    <div class="flex-1">
                                          <h4 class="font-bold text-emerald-900 mb-1">Status Nisab</h4>

                                          <template x-if="total === 0">
                                                <p class="text-sm text-gray-600">
                                                      Silakan masukkan nilai harta Anda untuk menghitung zakat.
                                                </p>
                                          </template>

                                          <template x-if="total > 0 && total < nisab">
                                                <div>
                                                      <p class="text-sm font-semibold text-red-700 mb-2">
                                                            Harta Anda belum mencapai nisab, belum wajib zakat maal.
                                                      </p>
                                                      <p class="text-xs text-gray-600">
                                                            Kekurangan: <strong x-text="rupiah(nisab - total)"></strong> lagi untuk mencapai nisab.
                                                      </p>
                                                </div>
                                          </template>

                                          <template x-if="total >= nisab">
                                                <div>
                                                      <p class="text-sm font-semibold text-white mb-2">
                                                            Alhamdulillah, harta Anda telah mencapai nisab dan <span class="underline">wajib zakat</span>.
                                                      </p>
                                                      <p class="text-xs text-white">
                                                            Nisab: <strong x-text="rupiah(nisab)"></strong> |
                                                            Harta Anda: <strong x-text="rupiah(total)"></strong>
                                                      </p>
                                                </div>
                                          </template>
                                    </div>
                              </div>
                        </div>


                        {{-- RESULT --}}
                        <div class="bg-gradient-to-br from-emerald-600 to-emerald-500 rounded-3xl p-6 sm:p-10 text-white shadow-xl">

                              <div class="flex items-center justify-between mb-6">
                                    <h3 class="text-xl sm:text-2xl font-bold">
                                          Zakat yang Harus Dibayar
                                    </h3>
                                    <div class="bg-white/20 backdrop-blur-sm px-3 py-1 rounded-lg text-sm font-bold">
                                          2.5%
                                    </div>
                              </div>

                              <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">

                                    <div class="bg-white text-emerald-700 rounded-2xl p-6">
                                          <p class="text-sm font-semibold mb-2">Zakat Per Tahun (2.5%)</p>
                                          <h2 class="text-3xl sm:text-4xl font-bold" x-text="rupiah(zakatTahun)"></h2>
                                          <p class="text-xs text-emerald-600 mt-2" x-show="total >= nisab">
                                                = 2.5% × <span x-text="rupiah(total)"></span>
                                          </p>
                                    </div>

                                    <div class="bg-white text-emerald-700 rounded-2xl p-6">
                                          <p class="text-sm font-semibold mb-2">Zakat Per Bulan (Opsional)</p>
                                          <h2 class="text-3xl sm:text-4xl font-bold" x-text="rupiah(zakatBulan)"></h2>
                                          <p class="text-xs text-emerald-700 mt-2" x-show="total >= nisab">
                                                Cicilan 12 bulan
                                          </p>
                                    </div>

                              </div>

                              <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 mb-6 border border-white/20">
                                    <div class="flex items-start gap-3">
                                          <svg class="w-5 h-5 text-yellow-300 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" />
                                          </svg>
                                          <p class="text-sm text-white">
                                                <strong>Contoh:</strong> Jika harta Rp 150.000.000, maka zakat = 2.5% × Rp 150.000.000 = <strong>Rp 3.750.000</strong> per tahun.
                                          </p>
                                    </div>
                              </div>

                              {{-- BUTTON --}}
                              <div class="flex flex-col sm:flex-row gap-4">
                                    <button
                                          @click="bayarZakat()"
                                          :disabled="zakatTahun <= 0"
                                          :class="zakatTahun <= 0 ? 'opacity-50 cursor-not-allowed' : 'hover:bg-gray-100'"
                                          class="flex-1 bg-white text-emerald-700 py-4 rounded-xl font-bold transition">
                                          <a href="{{ route('zakat.index') }}">
                                                <span x-show="zakatTahun > 0">Tunaikan Zakat</span>
                                          </a>
                                          <span x-show="zakatTahun <= 0">Belum Wajib Zakat</span>
                                    </button>
                                    <button
                                          class="flex-1 border-2 border-white py-4 rounded-xl font-bold hover:bg-white/10 transition">
                                          <a href="http://">Konsultasi Gratis</a>
                                    </button>
                              </div>

                        </div>

                  </div>
            </div>


            {{-- ================= ZAKAT FITRAH ================= --}}
            <div x-show="activeTab === 'fitrah'" x-transition:enter="transition ease-out duration-300"
                  x-transition:enter-start="opacity-0 transform scale-95"
                  x-transition:enter-end="opacity-100 transform scale-100"
                  class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden"
                  x-data="{ 
                        jumlahJiwa: 1, 
                        jenisZakat: 'beras',
                        hargaBeras: 15000,
                        hitungZakat() {
                              return this.jumlahJiwa * this.hargaBeras * 2.5;
                        }
                  }">

                  <div class="p-6 sm:p-8 lg:p-10 space-y-10">

                        <div>
                              <h2 class="text-2xl sm:text-3xl font-bold text-gray-900 mb-2">
                                    Zakat Fitrah
                              </h2>
                              <p class="text-gray-600 mb-6">
                                    Hitung zakat fitrah untuk keluarga Anda
                              </p>

                              <div class="space-y-6">

                                    {{-- Jumlah Jiwa --}}
                                    <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl p-6 border-2 border-blue-100">
                                          <label class="text-sm font-semibold text-gray-700 block mb-3">
                                                Jumlah Jiwa
                                          </label>

                                          <div class="flex items-center justify-between bg-white rounded-xl p-2 border-2 border-gray-200">
                                                <button @click="jumlahJiwa = Math.max(1, jumlahJiwa - 1)"
                                                      class="w-12 h-12 flex items-center justify-center bg-gray-100 hover:bg-gray-200 rounded-lg font-bold text-gray-700 transition">
                                                      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M20 12H4" />
                                                      </svg>
                                                </button>

                                                <div class="text-center">
                                                      <input type="number" x-model="jumlahJiwa" min="1"
                                                            class="text-3xl sm:text-4xl font-bold text-gray-900 text-center w-24 outline-none bg-transparent">
                                                      <p class="text-sm text-gray-500 font-medium">Orang</p>
                                                </div>

                                                <button @click="jumlahJiwa++"
                                                      class="w-12 h-12 flex items-center justify-center bg-emerald-600 hover:bg-emerald-700 rounded-lg font-bold text-white transition">
                                                      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4" />
                                                      </svg>
                                                </button>
                                          </div>

                                          <div class="mt-4 grid grid-cols-3 gap-2">
                                                <button @click="jumlahJiwa = 1" class="py-2 px-3 bg-white hover:bg-emerald-50 rounded-lg text-sm font-semibold text-gray-700 transition border border-gray-200">
                                                      1 Jiwa
                                                </button>
                                                <button @click="jumlahJiwa = 3" class="py-2 px-3 bg-white hover:bg-emerald-50 rounded-lg text-sm font-semibold text-gray-700 transition border border-gray-200">
                                                      3 Jiwa
                                                </button>
                                                <button @click="jumlahJiwa = 5" class="py-2 px-3 bg-white hover:bg-emerald-50 rounded-lg text-sm font-semibold text-gray-700 transition border border-gray-200">
                                                      5 Jiwa
                                                </button>
                                          </div>
                                    </div>

                                    {{-- Jenis Zakat --}}
                                    <div>
                                          <label class="text-sm font-semibold text-gray-700 block mb-3">
                                                Jenis Pembayaran
                                          </label>

                                          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                                <button @click="jenisZakat = 'beras'"
                                                      :class="jenisZakat === 'beras' ? 'border-emerald-500 bg-emerald-50' : 'border-gray-200 bg-white hover:border-gray-300'"
                                                      class="relative border-2 rounded-xl p-5 text-left transition">
                                                      <div class="flex items-start justify-between mb-2">
                                                            <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-amber-100">
                                                                  <svg class="w-6 h-6 text-amber-600" fill="currentColor" viewBox="0 0 20 20">
                                                                        <path d="M10 2a8 8 0 100 16 8 8 0 000-16zM9 12a1 1 0 01-1-1V7a1 1 0 112 0v4a1 1 0 01-1 1z" />
                                                                  </svg>
                                                            </div>
                                                            <div x-show="jenisZakat === 'beras'" class="w-5 h-5 bg-emerald-500 rounded-full flex items-center justify-center">
                                                                  <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                                                  </svg>
                                                            </div>
                                                      </div>
                                                      <h4 class="font-bold text-gray-900 mb-1">Beras</h4>
                                                      <p class="text-sm text-gray-600">2.5 kg per jiwa</p>
                                                      <p class="text-xs text-gray-500 mt-2">≈ Rp <span x-text="(15000 * 2.5).toLocaleString('id-ID')"></span>/jiwa</p>
                                                </button>

                                                <button @click="jenisZakat = 'uang'"
                                                      :class="jenisZakat === 'uang' ? 'border-emerald-500 bg-emerald-50' : 'border-gray-200 bg-white hover:border-gray-300'"
                                                      class="relative border-2 rounded-xl p-5 text-left transition">
                                                      <div class="flex items-start justify-between mb-2">
                                                            <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-emerald-100">
                                                                  <svg class="w-6 h-6 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                                                                        <path d="M8.433 7.418c.155-.103.346-.196.567-.267v1.698a2.305 2.305 0 01-.567-.267C8.07 8.34 8 8.114 8 8c0-.114.07-.34.433-.582zM11 12.849v-1.698c.22.071.412.164.567.267.364.243.433.468.433.582 0 .114-.07.34-.433.582a2.305 2.305 0 01-.567.267z" />
                                                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-13a1 1 0 10-2 0v.092a4.535 4.535 0 00-1.676.662C6.602 6.234 6 7.009 6 8c0 .99.602 1.765 1.324 2.246.48.32 1.054.545 1.676.662v1.941c-.391-.127-.68-.317-.843-.504a1 1 0 10-1.51 1.31c.562.649 1.413 1.076 2.353 1.253V15a1 1 0 102 0v-.092a4.535 4.535 0 001.676-.662C13.398 13.766 14 12.991 14 12c0-.99-.602-1.765-1.324-2.246A4.535 4.535 0 0011 9.092V7.151c.391.127.68.317.843.504a1 1 0 101.511-1.31c-.563-.649-1.413-1.076-2.354-1.253V5z" />
                                                                  </svg>
                                                            </div>
                                                            <div x-show="jenisZakat === 'uang'" class="w-5 h-5 bg-emerald-500 rounded-full flex items-center justify-center">
                                                                  <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                                                  </svg>
                                                            </div>
                                                      </div>
                                                      <h4 class="font-bold text-gray-900 mb-1">Uang</h4>
                                                      <p class="text-sm text-gray-600">Setara harga beras</p>
                                                </button>
                                          </div>
                                    </div>

                                    {{-- Harga Beras (jika uang) --}}
                                    <div x-show="jenisZakat === 'uang'" x-transition class="bg-gray-50 rounded-xl p-5 border border-gray-200">
                                          <label class="text-sm font-semibold text-gray-700 block mb-3">
                                                Harga Beras per Kg
                                          </label>

                                          <div class="flex items-center border-2 border-gray-200 focus-within:border-emerald-500 rounded-xl overflow-hidden transition bg-white">
                                                <span class="px-4 py-3 bg-gray-100 text-gray-600 font-semibold">Rp</span>
                                                <input type="number" x-model="hargaBeras" min="1000"
                                                      placeholder="15000"
                                                      class="flex-1 px-4 py-3 outline-none text-gray-900 font-semibold">
                                          </div>

                                          <p class="text-xs text-gray-500 mt-2">* Sesuaikan dengan harga beras di daerah Anda</p>
                                    </div>

                              </div>
                        </div>

                        {{-- RESULT FITRAH --}}
                        <div class="bg-gradient-to-br from-emerald-600 to-emerald-500 rounded-3xl p-6 sm:p-10 text-white shadow-xl">

                              <h3 class="text-xl sm:text-2xl font-bold mb-6">
                                    Total Zakat Fitrah
                              </h3>

                              <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">

                                    <div class="bg-white text-emerald-700 rounded-2xl p-6">
                                          <p class="text-sm font-semibold mb-2" x-text="jenisZakat === 'beras' ? 'Total Beras' : 'Total Uang'"></p>
                                          <h2 class="text-3xl sm:text-4xl font-bold" x-text="jenisZakat === 'beras' ? (jumlahJiwa * 2.5) + ' Kg' : 'Rp ' + hitungZakat().toLocaleString('id-ID')"></h2>
                                          <p class="text-xs text-emerald-700 mt-2" x-text="jumlahJiwa + ' jiwa × 2.5 kg'"></p>
                                    </div>

                                    <div class="bg-white/10 backdrop-blur-sm rounded-2xl p-6 border border-white/20">
                                          <p class="text-sm font-semibold mb-2 text-white">Batas Pembayaran</p>
                                          <p class="text-lg font-bold">Sebelum Sholat Idul Fitri</p>
                                          <p class="text-xs text-blue-100 mt-2">Wajib dibayar tepat waktu</p>
                                    </div>

                              </div>

                              <div class="bg-white/10 backdrop-blur-sm rounded-xl p-4 mb-6 border border-white/20">
                                    <div class="flex items-start gap-3">
                                          <svg class="w-5 h-5 text-yellow-300 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" />
                                          </svg>
                                          <p class="text-sm text-blue-50">
                                                Zakat fitrah wajib bagi setiap Muslim yang memiliki kelebihan makanan pokok pada malam dan hari Idul Fitri
                                          </p>
                                    </div>
                              </div>

                              <div class="flex flex-col sm:flex-row gap-4">
                                    <button class="flex-1 bg-white text-emerald-700 py-4 rounded-xl font-bold hover:bg-gray-100 transition">
                                          <a href="{{ route('zakat.index') }}">Tunaikan Zakat Fitrah</a>
                                    </button>
                                    <button class="flex-1 border border-white py-4 rounded-xl font-bold hover:bg-white/10 transition">
                                          <a href="http://">Konsultasi</a>
                                    </button>
                              </div>

                        </div>

                  </div>

            </div>

            {{-- INFO CARDS --}}
            <div class="mt-12 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">

                  <div class="bg-white p-6 rounded-2xl shadow border border-gray-100">
                        <div class="w-12 h-12 bg-emerald-100 rounded-xl flex items-center justify-center mb-4">
                              <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                              </svg>
                        </div>
                        <h3 class="font-bold text-lg mb-2">Perhitungan Akurat</h3>
                        <p class="text-gray-600 text-sm">
                              Mengikuti ketentuan syariat Islam dan fatwa MUI.
                        </p>
                  </div>

                  <div class="bg-white p-6 rounded-2xl shadow border border-gray-100">
                        <div class="w-12 h-12 bg-blue-100 rounded-xl flex items-center justify-center mb-4">
                              <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                              </svg>
                        </div>
                        <h3 class="font-bold text-lg mb-2">Privasi Terjamin</h3>
                        <p class="text-gray-600 text-sm">
                              Data Anda aman dan tidak disimpan di server kami.
                        </p>
                  </div>

                  <div class="bg-white p-6 rounded-2xl shadow border border-gray-100">
                        <div class="w-12 h-12 bg-purple-100 rounded-xl flex items-center justify-center mb-4">
                              <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8h2a2 2 0 012 2v6a2 2 0 01-2 2h-2v4l-4-4H9a1.994 1.994 0 01-1.414-.586m0 0L11 14h4a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2v4l.586-.586z" />
                              </svg>
                        </div>
                        <h3 class="font-bold text-lg mb-2">Konsultasi Gratis</h3>
                        <p class="text-gray-600 text-sm">
                              Tim ustadz kami siap membantu pertanyaan Anda.
                        </p>
                  </div>

            </div>

      </div>
</section>

{{-- Alpine.js & Scripts --}}
@push('scripts')
@push('scripts')
<script>
      function zakatMaal() {
            return {

                  hargaEmas: 950000,
                  hargaEmasDisplay: '950,000',

                  form: {
                        cash: '',
                        gold: '',
                        property: '',
                        stock: '',
                  },

                  // ===== FORMAT INPUT =====
                  formatInput(key) {
                        let num = this.toNumber(this.form[key]);
                        this.form[key] = num.toLocaleString('id-ID');
                  },

                  // ===== CONVERT STRING KE NUMBER =====
                  toNumber(val) {
                        if (!val) return 0;
                        return parseInt(val.toString().replace(/\D/g, '')) || 0;
                  },

                  // ===== FORMAT RUPIAH =====
                  rupiah(val) {
                        return 'Rp ' + (val || 0).toLocaleString('id-ID');
                  },

                  // ===== UPDATE HARGA EMAS =====
                  updateHargaEmas() {
                        let num = this.toNumber(this.hargaEmasDisplay);
                        this.hargaEmas = num;
                        this.hargaEmasDisplay = num.toLocaleString('id-ID');
                  },

                  // ===== TOTAL HARTA =====
                  get total() {
                        return this.toNumber(this.form.cash) +
                              this.toNumber(this.form.gold) +
                              this.toNumber(this.form.property) +
                              this.toNumber(this.form.stock);
                  },

                  // ===== NISAB =====
                  get nisab() {
                        return this.hargaEmas * 85;
                  },

                  // ===== ZAKAT =====
                  get zakatTahun() {
                        if (this.total < this.nisab) return 0;
                        return Math.round(this.total * 0.025);
                  },

                  get zakatBulan() {
                        if (this.zakatTahun <= 0) return 0;
                        return Math.round(this.zakatTahun / 12);
                  },

                  // ===== BUTTON =====
                  bayarZakat() {
                        alert('Lanjut ke halaman pembayaran zakat');
                  }
            }
      }
</script>
@endpush


@endpush

@endsection