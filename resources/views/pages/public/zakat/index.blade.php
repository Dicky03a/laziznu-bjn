@extends('layouts.public.app')
@section('title', 'Kalkulator & Pembayaran Zakat - LAZIZNU Bojonegoro')
@section('content')

{{-- HERO --}}
<section class="relative  bg-gradient-to-br from-emerald-600 to-emerald-700 overflow-hidden">
      <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 left-0 w-96 h-96 bg-emerald-500 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-emerald-600 rounded-full blur-3xl"></div>
      </div>

      <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14 sm:py-16 lg:py-20">
            <div class="max-w-3xl">
                  <nav class="flex items-center gap-2 text-sm text-gray-300 mb-6">
                        <a href="{{ route('home') }}" class="hover:text-white transition-colors">Beranda</a>
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                              <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-white font-medium">Zakat</span>
                  </nav>
                  <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-white leading-tight mb-4">
                        Zakat — Sucikan Harta & Jiwa
                  </h1>
                  <p class="text-gray-300 text-base sm:text-lg">
                        Tunaikan zakat Anda melalui LAZIZNU Bojonegoro — amanah, transparan, dan tepat sasaran
                  </p>

                  {{-- Quick stats --}}
                  <div class="flex gap-6 mt-8">
                        <div>
                              <p class="text-2xl font-bold text-white">{{ number_format($totalMuzakki) }}</p>
                              <p class="text-xs text-white mt-0.5">Total Muzakki</p>
                        </div>
                        <div class="w-px bg-white/20"></div>
                        <div>
                              <p class="text-2xl font-bold text-white">Rp {{ number_format($totalTerkumpul, 0, ',', '.') }}</p>
                              <p class="text-xs text-white mt-0.5">Dana Terkumpul</p>
                        </div>
                  </div>
            </div>
      </div>
</section>

{{-- MAIN CONTENT --}}
<section class="bg-gray-50 py-16">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if(session('success'))
            <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 rounded-xl text-emerald-700 text-sm font-medium">
                  {{ session('success') }}
            </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">

                  {{-- LEFT — Tab pilih jenis + kalkulator + form --}}
                  <div class="lg:col-span-2 space-y-6">

                        {{-- Pilih Jenis Zakat --}}
                        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6">
                              <h2 class="text-lg font-bold text-gray-900 mb-4">Pilih Jenis Zakat</h2>
                              <div class="grid grid-cols-2 gap-4">
                                    <button type="button"
                                          onclick="setJenis('mal')"
                                          id="btn-mal"
                                          class="jenis-btn flex flex-col items-center gap-3 p-5 rounded-2xl border-2 border-emerald-600 bg-emerald-50 transition-all">
                                          <div class="w-12 h-12 rounded-xl bg-emerald-100 flex items-center justify-center">
                                                <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                          </div>
                                          <div class="text-center">
                                                <p class="font-bold text-gray-900">Zakat Mal</p>
                                                <p class="text-xs text-gray-500 mt-0.5">2.5% dari harta</p>
                                          </div>
                                    </button>

                                    <button type="button"
                                          onclick="setJenis('fitrah')"
                                          id="btn-fitrah"
                                          class="jenis-btn flex flex-col items-center gap-3 p-5 rounded-2xl border-2 border-gray-200 bg-white hover:border-emerald-400 transition-all">
                                          <div class="w-12 h-12 rounded-xl bg-gray-100 flex items-center justify-center">
                                                <svg class="w-6 h-6 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                                                </svg>
                                          </div>
                                          <div class="text-center">
                                                <p class="font-bold text-gray-900">Zakat Fitrah</p>
                                                <p class="text-xs text-gray-500 mt-0.5">Per jiwa / kepala</p>
                                          </div>
                                    </button>
                              </div>
                        </div>

                        {{-- Kalkulator Zakat Mal --}}
                        <div id="calc-mal" class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6">
                              <h3 class="font-bold text-gray-900 mb-2">Kalkulator Zakat Mal</h3>
                              <p class="text-sm text-gray-500 mb-5">
                                    Nisab: setara <strong>{{ $settings['nisab_emas_gram'] }} gram emas</strong>
                                    ≈ <strong>Rp {{ number_format($settings['nisab_mal'], 0, ',', '.') }}</strong>
                              </p>

                              <div class="space-y-4">
                                    <div>
                                          <label class="block text-sm font-medium text-gray-700 mb-1.5">Total Nilai Harta (Rp)</label>
                                          <input type="number"
                                                id="nilai_harta_input"
                                                placeholder="Contoh: 50000000"
                                                min="0"
                                                oninput="hitungZakatMal()"
                                                class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 text-gray-900">
                                          <p class="text-xs text-gray-400 mt-1">
                                                Harta emas, perak, uang, tabungan, hasil usaha yang sudah mencapai haul (1 tahun)
                                          </p>
                                    </div>

                                    <div id="result-mal" class="hidden p-4 bg-emerald-50 rounded-xl border border-emerald-200">
                                          <div class="flex justify-between items-center">
                                                <span class="text-sm text-emerald-700">Zakat yang harus dibayar (2.5%):</span>
                                                <span id="zakat-mal-result" class="font-bold text-emerald-700 text-lg">Rp 0</span>
                                          </div>
                                          <p id="nisab-warning" class="hidden text-xs text-amber-600 mt-2">
                                                ⚠ Harta belum mencapai nisab. Zakat Mal belum wajib, namun infaq tetap dianjurkan.
                                          </p>
                                    </div>
                              </div>
                        </div>

                        {{-- Kalkulator Zakat Fitrah --}}
                        <div id="calc-fitrah" class="hidden bg-white rounded-3xl shadow-sm border border-gray-100 p-6">
                              <h3 class="font-bold text-gray-900 mb-2">Kalkulator Zakat Fitrah</h3>
                              <p class="text-sm text-gray-500 mb-5">
                                    Besaran: <strong>Rp {{ number_format($settings['zakat_fitrah_per_jiwa'], 0, ',', '.') }}</strong> per jiwa
                                    (setara 2.5 kg beras)
                              </p>

                              <div class="space-y-4">
                                    <div>
                                          <label class="block text-sm font-medium text-gray-700 mb-1.5">Jumlah Jiwa yang Dizakati</label>
                                          <div class="flex items-center gap-3">
                                                <button type="button" onclick="adjustJiwa(-1)"
                                                      class="w-10 h-10 rounded-full border-2 border-gray-300 flex items-center justify-center text-gray-600 hover:border-emerald-500 hover:text-emerald-600 transition-all font-bold text-lg">−</button>
                                                <input type="number" id="jumlah_jiwa_input" value="1" min="1" max="100"
                                                      oninput="hitungZakatFitrah()"
                                                      class="flex-1 text-center px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-emerald-500 text-gray-900 font-semibold text-lg">
                                                <button type="button" onclick="adjustJiwa(1)"
                                                      class="w-10 h-10 rounded-full border-2 border-gray-300 flex items-center justify-center text-gray-600 hover:border-emerald-500 hover:text-emerald-600 transition-all font-bold text-lg">+</button>
                                          </div>
                                    </div>

                                    <div class="p-4 bg-emerald-50 rounded-xl border border-emerald-200">
                                          <div class="flex justify-between items-center">
                                                <span class="text-sm text-emerald-700">Total Zakat Fitrah:</span>
                                                <span id="zakat-fitrah-result" class="font-bold text-emerald-700 text-lg">
                                                      Rp {{ number_format($settings['zakat_fitrah_per_jiwa'], 0, ',', '.') }}
                                                </span>
                                          </div>
                                    </div>
                              </div>
                        </div>

                        {{-- FORM PEMBAYARAN --}}
                        <form action="{{ route('zakat.store') }}" method="POST" id="form-zakat"
                              class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6">
                              @csrf
                              <input type="hidden" name="jenis" id="input-jenis" value="mal">
                              <input type="hidden" name="nilai_harta" id="input-nilai-harta" value="">
                              <input type="hidden" name="jumlah_jiwa" id="input-jumlah-jiwa" value="1">

                              <h3 class="font-bold text-gray-900 mb-5">Data Muzakki</h3>

                              @if($errors->any())
                              <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-xl text-red-600 text-sm">
                                    <ul class="list-disc list-inside space-y-1">
                                          @foreach($errors->all() as $error)
                                          <li>{{ $error }}</li>
                                          @endforeach
                                    </ul>
                              </div>
                              @endif

                              {{-- Anonim toggle --}}
                              <div class="flex items-center gap-3 mb-5">
                                    <label class="relative inline-flex items-center cursor-pointer">
                                          <input type="checkbox" name="is_anonim" value="1" class="sr-only peer"
                                                onchange="toggleAnonim(this, 'nama_program')">
                                          <div class="w-11 h-6 bg-gray-200 peer-focus:ring-2 peer-focus:ring-emerald-500 rounded-full peer peer-checked:bg-emerald-600 transition-all"></div>
                                          <div class="absolute left-1 top-1 w-4 h-4 bg-white rounded-full shadow peer-checked:translate-x-5 transition-all"></div>
                                    </label>
                                    <span class="text-sm text-gray-600">Donasi sebagai <strong>Hamba Allah</strong></span>
                              </div>

                              <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div class="sm:col-span-2">
                                          <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama Lengkap <span class="text-red-500">*</span></label>
                                          <input type="text" name="nama_donatur" id="nama_program"
                                                value="{{ old('nama_donatur') }}" placeholder="Nama Anda"
                                                class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-emerald-500 @error('nama_donatur') border-red-500 @enderror">
                                    </div>

                                    <div>
                                          <label class="block text-sm font-medium text-gray-700 mb-1.5">Email</label>
                                          <input type="email" name="email"
                                                value="{{ old('email') }}"
                                                placeholder="email@contoh.com"
                                                class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-emerald-500">
                                    </div>

                                    <div>
                                          <label class="block text-sm font-medium text-gray-700 mb-1.5">No. Telepon / WhatsApp</label>
                                          <input type="tel" name="telepon"
                                                value="{{ old('telepon') }}"
                                                placeholder="08xxxxxxxxxx"
                                                class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-emerald-500">
                                    </div>

                                    <div class="sm:col-span-2">
                                          <label class="block text-sm font-medium text-gray-700 mb-1.5">Catatan (opsional)</label>
                                          <textarea name="catatan" rows="2" placeholder="Catatan tambahan..."
                                                class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-emerald-500 resize-none">{{ old('catatan') }}</textarea>
                                    </div>
                              </div>

                              {{-- Ringkasan nominal --}}
                              <div class="mt-6 p-4 bg-gray-50 rounded-xl border border-gray-200">
                                    <div class="flex justify-between items-center">
                                          <span class="text-gray-600 text-sm">Total yang akan dibayar:</span>
                                          <span id="summary-jumlah" class="text-xl font-bold text-emerald-600">Rp 0</span>
                                    </div>
                              </div>

                              <button type="submit" id="btn-submit"
                                    class="mt-6 w-full py-4 bg-gradient-to-r from-emerald-600 to-emerald-500 hover:from-emerald-700 hover:to-emerald-600 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 flex items-center justify-center gap-3 disabled:opacity-50">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    Lanjutkan ke Pembayaran
                              </button>
                        </form>

                  </div>

                  {{-- RIGHT — Sidebar --}}
                  <div class="lg:col-span-1">
                        <div class="sticky top-8 space-y-6">

                              {{-- Info Organisasi --}}
                              <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6">
                                    <div class="flex items-center gap-4 mb-5">
                                          <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-emerald-600 to-emerald-500 flex items-center justify-center text-white font-bold text-xl shadow-lg">NU</div>
                                          <div>
                                                <h3 class="font-bold text-gray-900">LAZIZNU Bojonegoro</h3>
                                                <p class="text-emerald-600 text-xs font-medium flex items-center gap-1 mt-0.5">
                                                      <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                                            <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                      </svg>
                                                      Lembaga Terverifikasi
                                                </p>
                                          </div>
                                    </div>
                                    <a href="{{ route('rekening-lengkap') }}" class="block w-full py-2.5 border-2 border-emerald-600 text-emerald-600 rounded-xl font-semibold text-center text-sm hover:bg-emerald-50 transition-all">
                                          Lihat Rekening Donasi
                                    </a>
                              </div>

                              {{-- Ketentuan Zakat --}}
                              <div class="bg-gradient-to-br from-emerald-50 to-emerald-100/50 rounded-3xl p-6 border border-emerald-200">
                                    <h4 class="font-bold text-gray-900 mb-4 flex items-center gap-2">
                                          <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                          </svg>
                                          Ketentuan Zakat
                                    </h4>
                                    <div class="space-y-3 text-sm text-gray-700">
                                          <div class="flex items-start gap-2">
                                                <svg class="w-4 h-4 text-emerald-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                                      <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                </svg>
                                                <p><strong>Zakat Mal:</strong> Harta yang sudah mencapai nisab dan haul (1 tahun), wajib 2.5%</p>
                                          </div>
                                          <div class="flex items-start gap-2">
                                                <svg class="w-4 h-4 text-emerald-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                                      <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                </svg>
                                                <p><strong>Zakat Fitrah:</strong> Wajib bagi setiap muslim yang mampu, dibayar sebelum Idul Fitri</p>
                                          </div>
                                          <div class="flex items-start gap-2">
                                                <svg class="w-4 h-4 text-emerald-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                                      <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                </svg>
                                                <p>Pembayaran melalui transfer bank atau QRIS</p>
                                          </div>
                                    </div>
                              </div>

                              {{-- Hubungi Kami --}}
                              <div class="bg-white rounded-3xl p-5 border border-gray-100">
                                    <p class="text-sm text-gray-600 mb-2">Ada pertanyaan tentang zakat?</p>
                                    <a href="https://wa.me/6285743229703" target="_blank"
                                          class="flex items-center gap-2 text-emerald-600 font-semibold text-sm hover:text-emerald-700">
                                          <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" />
                                          </svg>
                                          0857-4322-9703
                                    </a>
                              </div>

                        </div>
                  </div>

            </div>
      </div>
</section>

@push('scripts')
<script>
      document.addEventListener('DOMContentLoaded', function() {

            // ==== SAFE BACKEND VALUE ====
            const ZAKAT_FITRAH_PER_JIWA = Number(@json($settings['zakat_fitrah_per_jiwa'] ?? 45000));
            const NISAB_MAL = Number(@json($settings['nisab_mal'] ?? 85000000));
            const ZAKAT_MAL_PERSEN = Number(@json($settings['zakat_mal_persen'] ?? 2.5)) / 100;

            let currentJenis = 'mal';

            window.setJenis = function(jenis) {
                  currentJenis = jenis;

                  const inputJenis = document.getElementById('input-jenis');
                  if (inputJenis) inputJenis.value = jenis;

                  const calcMal = document.getElementById('calc-mal');
                  const calcFitrah = document.getElementById('calc-fitrah');

                  if (calcMal) calcMal.classList.toggle('hidden', jenis !== 'mal');
                  if (calcFitrah) calcFitrah.classList.toggle('hidden', jenis !== 'fitrah');

                  if (jenis === 'mal') {
                        hitungZakatMal();
                  } else {
                        hitungZakatFitrah();
                  }
            }

            window.hitungZakatMal = function() {
                  const input = document.getElementById('nilai_harta_input');
                  if (!input) return;

                  const nilaiHarta = Number(input.value) || 0;
                  const zakatAmount = Math.floor(nilaiHarta * ZAKAT_MAL_PERSEN);
                  const belumNisab = nilaiHarta > 0 && nilaiHarta < NISAB_MAL;

                  const resultBox = document.getElementById('result-mal');
                  const resultText = document.getElementById('zakat-mal-result');
                  const warning = document.getElementById('nisab-warning');
                  const hiddenInput = document.getElementById('input-nilai-harta');

                  if (resultBox) resultBox.classList.remove('hidden');
                  if (resultText) resultText.textContent = 'Rp ' + zakatAmount.toLocaleString('id-ID');
                  if (warning) warning.classList.toggle('hidden', !belumNisab);
                  if (hiddenInput) hiddenInput.value = nilaiHarta;

                  updateSummary(zakatAmount);
            }

            window.hitungZakatFitrah = function() {
                  const input = document.getElementById('jumlah_jiwa_input');
                  if (!input) return;

                  const jiwa = Number(input.value) || 1;
                  const total = jiwa * ZAKAT_FITRAH_PER_JIWA;

                  const resultText = document.getElementById('zakat-fitrah-result');
                  const hiddenInput = document.getElementById('input-jumlah-jiwa');

                  if (resultText) resultText.textContent = 'Rp ' + total.toLocaleString('id-ID');
                  if (hiddenInput) hiddenInput.value = jiwa;

                  updateSummary(total);
            }

            window.adjustJiwa = function(delta) {
                  const input = document.getElementById('jumlah_jiwa_input');
                  if (!input) return;

                  const current = Number(input.value) || 1;
                  const newVal = Math.max(1, Math.min(100, current + delta));
                  input.value = newVal;

                  hitungZakatFitrah();
            }

            function updateSummary(amount) {
                  const summary = document.getElementById('summary-jumlah');
                  if (summary) {
                        summary.textContent = 'Rp ' + amount.toLocaleString('id-ID');
                  }
            }

            window.toggleAnonim = function(checkbox, fieldId) {
                  const field = document.getElementById(fieldId);
                  if (!field) return;

                  if (checkbox.checked) {
                        // Simpan nilai asli hanya sekali
                        if (!field.dataset.original) {
                              field.dataset.original = field.value;
                        }

                        field.value = 'Hamba Allah';
                        field.readOnly = true;
                        field.required = false; // penting agar tidak gagal validasi required
                        field.classList.add('bg-gray-100', 'text-gray-400', 'cursor-not-allowed');

                  } else {
                        field.value = field.dataset.original || '';
                        field.readOnly = false;
                        field.required = true; // aktifkan kembali required
                        field.classList.remove('bg-gray-100', 'text-gray-400', 'cursor-not-allowed');
                  }
            }

            // INIT DEFAULT
            setJenis('mal');

      });
</script>
@endpush



@endsection