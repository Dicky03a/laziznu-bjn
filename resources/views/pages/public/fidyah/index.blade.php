@extends('layouts.public.app')
@section('title', 'Fidyah - LAZIZNU Bojonegoro')
@section('content')

{{-- HERO --}}
<section class="relative bg-gray-900 overflow-hidden">
      <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1564769625905-50e93615e769"
                  alt="Fidyah Banner"
                  class="w-full h-full object-cover opacity-30">
            <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/80 to-transparent"></div>
      </div>

      <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14 sm:py-16 lg:py-20">
            <div class="max-w-3xl">
                  <nav class="flex items-center gap-2 text-sm text-gray-300 mb-6">
                        <a href="{{ route('home') }}" class="hover:text-white">Beranda</a>
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                              <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-white font-medium">Fidyah</span>
                  </nav>
                  <h1 class="text-2xl sm:text-4xl lg:text-5xl font-bold text-white leading-tight mb-4">
                        Fidyah — Tebus Hutang Puasa
                  </h1>
                  <p class="text-gray-300 text-base sm:text-lg max-w-2xl">
                        Fidyah diwajibkan bagi yang tidak mampu mengganti (qadha) puasa Ramadhan karena uzur syar'i
                  </p>
                  <div class="flex gap-6 mt-8">
                        <div>
                              <p class="text-2xl font-bold text-emerald-400">{{ number_format($totalMembayar) }}</p>
                              <p class="text-xs text-gray-400 mt-0.5">Total Pembayar</p>
                        </div>
                        <div class="w-px bg-white/20"></div>
                        <div>
                              <p class="text-2xl font-bold text-emerald-400">Rp {{ number_format($totalTerkumpul, 0, ',', '.') }}</p>
                              <p class="text-xs text-gray-400 mt-0.5">Dana Terkumpul</p>
                        </div>
                  </div>
            </div>
      </div>
</section>

{{-- MAIN --}}
<section class="bg-gray-50 py-16">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if(session('success'))
            <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 rounded-xl text-emerald-700 text-sm font-medium">
                  {{ session('success') }}
            </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">

                  {{-- LEFT --}}
                  <div class="lg:col-span-2 space-y-6">

                        {{-- Info Fidyah --}}
                        <div class="bg-amber-50 border border-amber-200 rounded-3xl p-6">
                              <h3 class="font-bold text-amber-900 mb-3 flex items-center gap-2">
                                    <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    Siapa yang Wajib Membayar Fidyah?
                              </h3>
                              <div class="grid sm:grid-cols-2 gap-3 text-sm text-amber-800">
                                    <div class="flex items-start gap-2">
                                          <span class="w-1.5 h-1.5 bg-amber-500 rounded-full mt-2 flex-shrink-0"></span>
                                          <p>Orang tua renta yang tidak mampu puasa dan tidak bisa qadha</p>
                                    </div>
                                    <div class="flex items-start gap-2">
                                          <span class="w-1.5 h-1.5 bg-amber-500 rounded-full mt-2 flex-shrink-0"></span>
                                          <p>Orang sakit kronis yang tidak ada harapan sembuh</p>
                                    </div>
                                    <div class="flex items-start gap-2">
                                          <span class="w-1.5 h-1.5 bg-amber-500 rounded-full mt-2 flex-shrink-0"></span>
                                          <p>Ibu hamil / menyusui yang khawatir membahayakan bayinya</p>
                                    </div>
                                    <div class="flex items-start gap-2">
                                          <span class="w-1.5 h-1.5 bg-amber-500 rounded-full mt-2 flex-shrink-0"></span>
                                          <p>Yang menunda qadha hingga datang Ramadhan berikutnya tanpa uzur</p>
                                    </div>
                              </div>
                        </div>

                        {{-- Kalkulator Fidyah --}}
                        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6">
                              <h3 class="font-bold text-gray-900 mb-2">Kalkulator Fidyah</h3>
                              <p class="text-sm text-gray-500 mb-5">
                                    Besaran fidyah: <strong>Rp {{ number_format($hargaPerHari, 0, ',', '.') }}</strong> per hari
                                    (setara 1 mud / 0.75 kg makanan pokok)
                              </p>

                              <div class="space-y-4">
                                    <div>
                                          <label class="block text-sm font-medium text-gray-700 mb-1.5">Jumlah Hari Hutang Puasa</label>
                                          <div class="flex items-center gap-3">
                                                <button type="button" onclick="adjustHari(-1)"
                                                      class="w-10 h-10 rounded-full border-2 border-gray-300 flex items-center justify-center text-gray-600 hover:border-emerald-500 hover:text-emerald-600 transition-all font-bold text-lg">−</button>
                                                <input type="number" id="hari_input" value="1" min="1" max="365"
                                                      oninput="hitungFidyah()"
                                                      class="flex-1 text-center px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-emerald-500 text-gray-900 font-semibold text-lg">
                                                <button type="button" onclick="adjustHari(1)"
                                                      class="w-10 h-10 rounded-full border-2 border-gray-300 flex items-center justify-center text-gray-600 hover:border-emerald-500 hover:text-emerald-600 transition-all font-bold text-lg">+</button>
                                          </div>
                                    </div>

                                    <div class="p-5 bg-emerald-50 rounded-xl border border-emerald-200">
                                          <div class="flex justify-between items-center">
                                                <div>
                                                      <p class="text-sm text-emerald-700"><span id="hari_display">1</span> hari × Rp {{ number_format($hargaPerHari, 0, ',', '.') }}</p>
                                                      <p class="text-xs text-emerald-600 mt-0.5">Total Fidyah yang Harus Dibayar</p>
                                                </div>
                                                <span id="fidyah-result" class="font-bold text-emerald-700 text-2xl">
                                                      Rp {{ number_format($hargaPerHari, 0, ',', '.') }}
                                                </span>
                                          </div>
                                    </div>
                              </div>
                        </div>

                        {{-- Form --}}
                        <form action="{{ route('fidyah.store') }}" method="POST"
                              class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6">
                              @csrf
                              <input type="hidden" name="jumlah_hari" id="input-jumlah-hari" value="1">

                              <h3 class="font-bold text-gray-900 mb-5">Data Pembayar Fidyah</h3>

                              @if($errors->any())
                              <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-xl text-red-600 text-sm">
                                    <ul class="list-disc list-inside space-y-1">
                                          @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                                    </ul>
                              </div>
                              @endif

                              <div class="flex items-center gap-3 mb-5">
                                    <label class="relative inline-flex items-center cursor-pointer">
                                          <input type="checkbox" name="is_anonim" value="1" class="sr-only peer"
                                                onchange="toggleAnonim(this, 'nama_fidyah')">
                                          <div class="w-11 h-6 bg-gray-200 peer-focus:ring-2 peer-focus:ring-emerald-500 rounded-full peer peer-checked:bg-emerald-600 transition-all"></div>
                                          <div class="absolute left-1 top-1 w-4 h-4 bg-white rounded-full shadow peer-checked:translate-x-5 transition-all"></div>
                                    </label>
                                    <span class="text-sm text-gray-600">Bayar sebagai <strong>Hamba Allah</strong></span>
                              </div>

                              <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                    <div class="sm:col-span-2">
                                          <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama Lengkap <span class="text-red-500">*</span></label>
                                          <input type="text" name="nama_donatur" id="nama_fidyah"
                                                value="{{ old('nama_donatur') }}" placeholder="Nama Anda"
                                                class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-emerald-500 @error('nama_donatur') border-red-500 @enderror">
                                    </div>
                                    <div>
                                          <label class="block text-sm font-medium text-gray-700 mb-1.5">Email</label>
                                          <input type="email" name="email" value="{{ old('email') }}"
                                                placeholder="email@contoh.com"
                                                class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-emerald-500">
                                    </div>
                                    <div>
                                          <label class="block text-sm font-medium text-gray-700 mb-1.5">No. WhatsApp</label>
                                          <input type="tel" name="telepon" value="{{ old('telepon') }}"
                                                placeholder="08xxxxxxxxxx"
                                                class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-emerald-500">
                                    </div>
                                    <div class="sm:col-span-2">
                                          <label class="block text-sm font-medium text-gray-700 mb-1.5">Catatan (opsional)</label>
                                          <textarea name="catatan" rows="2"
                                                class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-emerald-500 resize-none"
                                                placeholder="Misal: fidyah atas nama almarhum...">{{ old('catatan') }}</textarea>
                                    </div>
                              </div>

                              <div class="mt-6 p-4 bg-gray-50 rounded-xl border border-gray-200">
                                    <div class="flex justify-between items-center">
                                          <span class="text-gray-600 text-sm">Total Fidyah:</span>
                                          <span id="summary-fidyah" class="text-xl font-bold text-emerald-600">Rp {{ number_format($hargaPerHari, 0, ',', '.') }}</span>
                                    </div>
                              </div>

                              <button type="submit"
                                    class="mt-6 w-full py-4 bg-gradient-to-r from-emerald-600 to-emerald-500 hover:from-emerald-700 hover:to-emerald-600 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition-all flex items-center justify-center gap-3">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                                    </svg>
                                    Lanjutkan ke Pembayaran
                              </button>
                        </form>

                  </div>

                  {{-- RIGHT sidebar (sama dengan zakat) --}}
                  <div class="lg:col-span-1">
                        <div class="sticky top-8 space-y-6">
                              <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6">
                                    <div class="flex items-center gap-4 mb-5">
                                          <div class="w-14 h-14 rounded-2xl bg-gradient-to-br from-emerald-600 to-emerald-500 flex items-center justify-center text-white font-bold text-xl shadow-lg">NU</div>
                                          <div>
                                                <h3 class="font-bold text-gray-900">LAZIZNU Bojonegoro</h3>
                                                <p class="text-emerald-600 text-xs font-medium">Lembaga Terverifikasi</p>
                                          </div>
                                    </div>
                                    <a href="{{ route('rekening-lengkap') }}" class="block w-full py-2.5 border-2 border-emerald-600 text-emerald-600 rounded-xl font-semibold text-center text-sm hover:bg-emerald-50 transition-all">
                                          Lihat Rekening Donasi
                                    </a>
                              </div>

                              <div class="bg-gradient-to-br from-emerald-50 to-emerald-100/50 rounded-3xl p-6 border border-emerald-200">
                                    <h4 class="font-bold text-gray-900 mb-4">Jaminan Kami</h4>
                                    <div class="space-y-3 text-sm text-gray-700">
                                          <p class="flex items-start gap-2">
                                                <svg class="w-4 h-4 text-emerald-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                                      <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                </svg>
                                                Dana dikelola secara profesional dan amanah
                                          </p>
                                          <p class="flex items-start gap-2">
                                                <svg class="w-4 h-4 text-emerald-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                                      <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                </svg>
                                                Disalurkan kepada yang berhak
                                          </p>
                                          <p class="flex items-start gap-2">
                                                <svg class="w-4 h-4 text-emerald-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                                      <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                </svg>
                                                Laporan transparan berkala
                                          </p>
                                    </div>
                              </div>
                        </div>
                  </div>

            </div>
      </div>
</section>

@push('scripts')
<script>
      document.addEventListener('DOMContentLoaded', function() {

            // Ambil harga dari backend (AMAN & valid JS)
            const HARGA_PER_HARI = Number(@json($hargaPerHari));

            window.hitungFidyah = function() {
                  const input = document.getElementById('hari_input');
                  let hari = parseInt(input.value) || 1;

                  // Batasi min 1 max 365
                  hari = Math.max(1, Math.min(365, hari));
                  input.value = hari;

                  const total = hari * HARGA_PER_HARI;

                  document.getElementById('hari_display').textContent = hari;
                  document.getElementById('fidyah-result').textContent =
                        'Rp ' + total.toLocaleString('id-ID');

                  document.getElementById('summary-fidyah').textContent =
                        'Rp ' + total.toLocaleString('id-ID');

                  document.getElementById('input-jumlah-hari').value = hari;
            }

            window.adjustHari = function(delta) {
                  const input = document.getElementById('hari_input');
                  let current = parseInt(input.value) || 1;

                  current = Math.max(1, Math.min(365, current + delta));
                  input.value = current;  

                  hitungFidyah();
            }

            window.toggleAnonim = function(checkbox, fieldId) {
                  const field = document.getElementById(fieldId);

                  if (checkbox.checked) {
                        field._originalValue = field.value; // simpan nilai asli
                        field.value = 'Hamba Allah';
                        field.readOnly = true;
                        field.classList.add('bg-gray-100', 'text-gray-400', 'cursor-not-allowed');
                  } else {
                        field.value = field._originalValue ?? '';
                        field.readOnly = false;
                        field.classList.remove('bg-gray-100', 'text-gray-400', 'cursor-not-allowed');
                  }
            }
            // Init pertama kali
            hitungFidyah();

      });
</script>
@endpush


@endsection