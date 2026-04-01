@extends('layouts.public.app')
@section('title', 'Hitung Zakat - Lazisnu Bojonegoro')
@section('content')

<div class="min-h-screen py-8 px-4">
      <div class="max-w-4xl mx-auto space-y-6">

            <!-- Header -->
            <div class="text-center space-y-2">
                  <h1 class="text-3xl font-bold text-slate-900 dark:text-white">
                        Informasi Cara Pembayaran
                  </h1>
                  <p class="text-slate-600 dark:text-slate-400">
                        Pilih jenis transaksi untuk melihat rekening pembayaran yang tersedia
                  </p>
            </div>

            <!-- Accordion -->
            <div class="space-y-4">
                  <!-- Infaq Accordion -->
                  <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-xl border border-slate-200 dark:border-zinc-800 overflow-hidden">
                        <button onclick="toggleAccordion('infaq')" class="accordion-btn w-full px-6 py-4 flex items-center justify-between hover:bg-slate-50 dark:hover:bg-zinc-800 transition-colors">
                              <div class="flex items-center gap-4 text-left">
                                    <div>
                                          <h2 class="text-lg font-semibold text-slate-900 dark:text-white">Infaq</h2>
                                          <p class="text-sm text-slate-600 dark:text-slate-400 mt-1">Informasi Cara Pembayaran Infaq</p>
                                    </div>
                              </div>
                              <svg class="accordion-icon w-6 h-6 text-slate-900 dark:text-white transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                              </svg>
                        </button>

                        <div id="infaq" class="accordion-content hidden border-t border-slate-200 dark:border-zinc-700">
                              <div class="p-6 space-y-4">
                                    <div class="grid grid-cols-1 md:grid-cols-1 gap-4">
                                          <div class="border border-slate-200 dark:border-zinc-700 rounded-lg p-4 hover:shadow-lg transition-shadow">
                                                <div class="flex items-start gap-4">
                                                      <div class="flex-1 min-w-0 w-70">
                                                            <ol class="text-sm text-slate-600 dark:text-slate-400 truncate">
                                                                  <li>1.  Pilih Program Infaq Yang Tersedia</li>
                                                                  <li>2. Isi Data Diri</li>
                                                                  <li>3. Masukkan Jumlah Infaq</li>
                                                                  <li>4. Pilih Metode Pembayaran</li>
                                                                  <li>5. Konfirmasi Transaksi</li>
                                                            </ol>
                                                      </div>
                                                </div>
                                          </div>
                                    </div>
                              </div>
                        </div>
                  </div>

                  
            </div>

            <!-- Info Box -->
            <div class="bg-blue-50 dark:bg-blue-900/30 border border-blue-200 dark:border-blue-800 rounded-xl p-6">
                  <div class="flex gap-4">
                        <div>
                              <h3 class="font-semibold text-blue-900 dark:text-blue-100 mb-1">Perhatian</h3>
                              <p class="text-black dark:text-blue-200 text-sm">Pastikan Anda memilih rekening yang sesuai dengan jenis transaksi. Jangan lupa untuk menyimpan bukti transfer sebagai bukti pembayaran Anda dan Admin akan mengkonfirmasi transaksi anda lewat WhahatApp pesan</p>
                        </div>
                  </div>
            </div>
      </div>
</div>

<script>
      function toggleAccordion(id) {
            const content = document.getElementById(id);
            const btn = document.querySelector(`button[onclick="toggleAccordion('${id}')"]`);
            const icon = btn.querySelector('.accordion-icon');

            // Toggle hidden class
            content.classList.toggle('hidden');

            // Rotate icon
            if (content.classList.contains('hidden')) {
                  icon.style.transform = 'rotate(0deg)';
            } else {
                  icon.style.transform = 'rotate(180deg)';
            }
      }
</script>


@endsection