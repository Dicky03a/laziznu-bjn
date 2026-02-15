@extends('layouts.public.app')
@section('title', 'Rekening - LAZIZNU Bojonegoro')
@section('content')

<!-- HERO -->
<section class="relative bg-gradient-to-br from-emerald-600 to-emerald-700 py-20 sm:py-24 overflow-hidden">
      <!-- Decorative Elements -->
      <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 left-0 w-96 h-96 bg-emerald-500 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-emerald-600 rounded-full blur-3xl"></div>
      </div>

      <div class="relative max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
            <div class="inline-block mb-6 px-4 py-1.5 bg-emerald-500/20 backdrop-blur-sm rounded-full border border-emerald-400/30">
                  <span class="text-emerald-200 text-sm font-medium">Informasi Rekening</span>
            </div>

            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white tracking-tight mb-4">
                  Rekening Donasi
            </h1>

            <p class="text-base sm:text-lg text-emerald-100/90 max-w-2xl mx-auto leading-relaxed">
                  Salurkan Zakat, Infaq dan Shadaqah melalui transfer bank atau QRIS
            </p>
      </div>
</section>

<!-- BANK ACCOUNTS -->
<section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-20 lg:py-24">

      <div class="text-center mb-12 lg:mb-16">
            <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 tracking-tight mb-3">
                  Transfer Melalui Bank
            </h2>
            <p class="text-slate-600">Pilih metode transfer yang paling mudah untuk Anda</p>
      </div>

      <div class="grid md:grid-cols-2 gap-6 lg:gap-8">

            @php
            $rekening = [
            [
            'bank' => 'Bank Rakyat Indonesia',
            'shortName' => 'BRI',
            'nama' => 'LAZISNU Bojonegoro',
            'no' => '0022-01-028613-53-6',
            'color' => 'blue'
            ],
            [
            'bank' => 'Bank Syariah Indonesia',
            'shortName' => 'BSI',
            'nama' => 'LAZISNU Bojonegoro',
            'no' => '7194101451',
            'type' => 'Infaq',
            'color' => 'emerald'
            ],
            [
            'bank' => 'Bank Syariah Indonesia',
            'shortName' => 'BSI',
            'nama' => 'LAZISNU Bojonegoro',
            'no' => '721160084',
            'type' => 'Zakat',
            'color' => 'emerald'
            ],
            [
            'bank' => 'Bank Mandiri',
            'shortName' => 'Mandiri',
            'nama' => 'LAZISNU Bojonegoro',
            'no' => '184-00-0453436-6',
            'color' => 'blue'
            ],
            [
            'bank' => 'BMT LISA (ASKOWANU)',
            'shortName' => 'BMT',
            'nama' => 'PC LAZISNU Bojonegoro',
            'no' => '01.KNU.00142',
            'color' => 'emerald'
            ],
            ];
            @endphp

            @foreach($rekening as $item)
            <div class="group bg-white rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 p-6 lg:p-8 border border-slate-200 hover:border-emerald-200">

                  <div class="flex justify-between items-start mb-6">
                        <div class="flex-1">
                              <div class="flex items-center gap-3 mb-2">
                                    <div class="flex items-center justify-center w-10 h-10 rounded-lg bg-gradient-to-br from-{{ $item['color'] }}-500 to-{{ $item['color'] }}-600 text-white font-bold text-sm shadow-sm">
                                          {{ substr($item['shortName'], 0, 1) }}
                                    </div>
                                    <div>
                                          <h3 class="font-semibold text-slate-900 text-base">
                                                {{ $item['bank'] }}
                                          </h3>
                                          @if(isset($item['type']))
                                          <span class="text-xs text-{{ $item['color'] }}-600 font-medium">
                                                {{ $item['type'] }}
                                          </span>
                                          @endif
                                    </div>
                              </div>
                              <p class="text-sm text-slate-600 ml-13">
                                    a.n {{ $item['nama'] }}
                              </p>
                        </div>

                        <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-emerald-50 text-emerald-700 text-xs font-semibold rounded-full">
                              <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>
                              Aktif
                        </span>
                  </div>

                  <div class="flex items-center gap-3 bg-slate-50 p-4 rounded-xl border border-slate-100 group-hover:border-emerald-100 transition-colors duration-300">
                        <span class="flex-1 font-mono text-slate-900 text-base font-semibold tracking-wide">
                              {{ $item['no'] }}
                        </span>

                        <button onclick="copyToClipboard('{{ $item['no'] }}', this)"
                              class="flex items-center gap-2 px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium rounded-lg transition-all duration-200 shadow-sm hover:shadow-md hover:-translate-y-0.5">
                              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                              </svg>
                              <span class="copy-text">Salin</span>
                        </button>
                  </div>

            </div>
            @endforeach

      </div>
</section>

<!-- QRIS SECTION -->
<section class="bg-slate-50/50 py-16 sm:py-20 lg:py-24">
      <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="text-center mb-12 lg:mb-16">
                  <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 tracking-tight mb-3">
                        Pembayaran Cepat via QRIS
                  </h2>
                  <p class="text-slate-600">Scan QR Code untuk donasi instan dari berbagai aplikasi</p>
            </div>

            <div class="grid md:grid-cols-2 gap-8 lg:gap-12 max-w-4xl mx-auto">

                  <!-- QR ZAKAT -->
                  <div class="group bg-white p-8 lg:p-10 rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 border border-slate-200 hover:border-emerald-200">

                        <div class="text-center mb-6">
                              <span class="inline-flex items-center gap-2 px-4 py-1.5 bg-emerald-50 text-emerald-700 text-sm font-semibold rounded-full border border-emerald-200">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                          <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
                                          <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z" />
                                    </svg>
                                    QRIS Zakat
                              </span>
                        </div>

                        <div class="relative">
                              <div class="absolute -inset-4 bg-gradient-to-r from-emerald-500/10 to-emerald-600/10 rounded-2xl blur-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                              <img src="{{ asset('asset/qris-zakat.png') }}"
                                    class="relative mx-auto w-full max-w-xs rounded-xl shadow-md border-4 border-white"
                                    alt="QRIS Zakat"
                                    loading="lazy">
                        </div>

                        <div class="mt-6 text-center">
                              <p class="font-semibold text-slate-900 mb-1">
                                    Zakat LAZISNU Bojonegoro
                              </p>
                              <p class="text-sm text-slate-600">
                                    Scan untuk pembayaran zakat
                              </p>
                        </div>

                        <div class="mt-6 p-4 bg-slate-50 rounded-lg border border-slate-100">
                              <p class="text-xs text-slate-600 text-center leading-relaxed">
                                    Kompatibel dengan semua aplikasi e-wallet dan mobile banking
                              </p>
                        </div>
                  </div>

                  <!-- QR INFAQ -->
                  <div class="group bg-white p-8 lg:p-10 rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 border border-slate-200 hover:border-emerald-200">

                        <div class="text-center mb-6">
                              <span class="inline-flex items-center gap-2 px-4 py-1.5 bg-emerald-50 text-emerald-700 text-sm font-semibold rounded-full border border-emerald-200">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                          <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
                                    </svg>
                                    QRIS Infaq & Shadaqah
                              </span>
                        </div>

                        <div class="relative">
                              <div class="absolute -inset-4 bg-gradient-to-r from-emerald-500/10 to-emerald-600/10 rounded-2xl blur-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                              <img src="{{ asset('asset/qris-infaq.png') }}"
                                    class="relative mx-auto w-full max-w-xs rounded-xl shadow-md border-4 border-white"
                                    alt="QRIS Infaq"
                                    loading="lazy">
                        </div>

                        <div class="mt-6 text-center">
                              <p class="font-semibold text-slate-900 mb-1">
                                    Infaq LAZISNU Bojonegoro
                              </p>
                              <p class="text-sm text-slate-600">
                                    Scan untuk infaq & shadaqah
                              </p>
                        </div>

                        <div class="mt-6 p-4 bg-slate-50 rounded-lg border border-slate-100">
                              <p class="text-xs text-slate-600 text-center leading-relaxed">
                                    Kompatibel dengan semua aplikasi e-wallet dan mobile banking
                              </p>
                        </div>
                  </div>

            </div>
      </div>
</section>

<!-- HELPDESK -->
<section class="relative bg-gradient-to-br from-emerald-600 to-emerald-700 py-12 sm:py-16 overflow-hidden">
      <!-- Decorative Elements -->
      <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 right-0 w-64 h-64 bg-white rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 w-64 h-64 bg-white rounded-full blur-3xl"></div>
      </div>

      <div class="relative max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white/10 backdrop-blur-sm border border-white/20 rounded-2xl p-6 sm:p-8">
                  <div class="flex flex-col md:flex-row items-center justify-between gap-6">

                        <div class="flex items-start gap-4 text-white">
                              <div class="flex items-center justify-center w-12 h-12 bg-white/20 rounded-xl flex-shrink-0">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                    </svg>
                              </div>
                              <div>
                                    <h3 class="text-lg font-semibold mb-1">Butuh Konfirmasi Transfer?</h3>
                                    <p class="text-emerald-100 text-sm">
                                          Hubungi tim kami untuk konfirmasi dan informasi donasi
                                    </p>
                              </div>
                        </div>

                        <div class="text-center md:text-right bg-white/10 backdrop-blur-sm rounded-xl px-6 py-4 border border-white/20">
                              <p class="text-white font-bold text-lg mb-1">0856-4001-9811</p>
                              <p class="text-emerald-100 text-sm">Ahmad Fauzan (Manajer Keuangan)</p>
                        </div>

                  </div>
            </div>
      </div>
</section>

<script>
      function copyToClipboard(text, button) {
            navigator.clipboard.writeText(text).then(function() {
                  const copyText = button.querySelector('.copy-text');
                  const originalText = copyText.textContent;

                  copyText.textContent = 'Tersalin!';
                  button.classList.add('bg-green-600');

                  setTimeout(function() {
                        copyText.textContent = originalText;
                        button.classList.remove('bg-green-600');
                  }, 2000);
            });
      }
</script>

@endsection