@extends('layouts.public.app')
@section('title', $program->nama . ' - LAZIZNU Bojonegoro')
@section('content')

{{-- Hero --}}
<section class="relative bg-gray-900 overflow-hidden">
      <div class="absolute inset-0">
            <img src="{{ $program->thumbnail_url }}"
                  alt="{{ $program->nama }}"
                  class="w-full h-full object-cover opacity-40">
            <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/80 to-transparent"></div>
      </div>

      <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14 sm:py-16 lg:py-20">
            <div class="max-w-3xl">
                  <nav class="flex items-center gap-2 text-sm text-gray-300 mb-6">
                        <a href="{{ route('home') }}" class="hover:text-white transition-colors">Beranda</a>
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                              <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                        <a href="{{ route($program->type . '.index') }}" class="hover:text-white transition-colors">{{ ucfirst($program->type) }}</a>
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                              <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-white font-medium truncate max-w-xs">{{ $program->nama }}</span>
                  </nav>

                  <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-white leading-tight mb-4">
                        {{ $program->nama }}
                  </h1>

                  <div class="flex items-center gap-3 text-gray-300">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                              <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                        </svg>
                        <span>Kabupaten Bojonegoro, Jawa Timur</span>
                  </div>
            </div>
      </div>
</section>

{{-- Main --}}
<section class="bg-gray-50 py-16">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            @if(session('success'))
            <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 rounded-xl text-emerald-700 text-sm font-medium">
                  {{ session('success') }}
            </div>
            @endif

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">

                  {{-- LEFT: Stats + Deskripsi + Riwayat --}}
                  <div class="lg:col-span-2 space-y-8">

                        {{-- Stats & Progress --}}
                        <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100">
                              <div class="p-8 space-y-6">

                                    <div class="grid grid-cols-1 sm:grid-cols-{{ $program->target_dana ? '3' : '2' }} gap-4 sm:gap-6">
                                          <div class="text-center p-6 bg-gradient-to-br from-emerald-50 to-emerald-100/50 rounded-2xl">
                                                <p class="text-sm text-emerald-700 font-medium mb-2">Dana Terkumpul</p>
                                                <h2 class="text-2xl font-bold text-emerald-600">Rp {{ number_format($totalTerkumpul, 0, ',', '.') }}</h2>
                                          </div>
                                          <div class="text-center p-6 bg-gradient-to-br from-blue-50 to-blue-100/50 rounded-2xl">
                                                <p class="text-sm text-blue-700 font-medium mb-2">Total Donatur</p>
                                                <h2 class="text-3xl font-bold text-blue-600">{{ number_format($totalDonatur) }}</h2>
                                          </div>
                                          @if($program->target_dana)
                                          <div class="text-center p-6 bg-gradient-to-br from-purple-50 to-purple-100/50 rounded-2xl">
                                                <p class="text-sm text-purple-700 font-medium mb-2">Target Dana</p>
                                                <h2 class="text-xl font-bold text-purple-600">Rp {{ number_format($program->target_dana, 0, ',', '.') }}</h2>
                                          </div>
                                          @else
                                          <div class="text-center p-6 bg-gradient-to-br from-purple-50 to-purple-100/50 rounded-2xl">
                                                <p class="text-sm text-purple-700 font-medium mb-2">Hari Tersisa</p>
                                                <h2 class="text-3xl font-bold text-purple-600">
                                                      @if($program->end_date)
                                                      {{ max(0, now()->diffInDays($program->end_date, false)) }}
                                                      @else
                                                      ∞
                                                      @endif
                                                </h2>
                                          </div>
                                          @endif
                                    </div>

                                    @if($program->target_dana)
                                    @php $persen = $progressPersen ?? 0; @endphp
                                    <div class="space-y-3">
                                          <div class="flex justify-between items-center">
                                                <span class="text-gray-700 font-semibold">Progress</span>
                                                <span class="text-emerald-600 font-bold">{{ $persen }}%</span>
                                          </div>
                                          <div class="relative w-full bg-gray-200 rounded-full h-4 overflow-hidden">
                                                <div class="absolute inset-0 bg-gradient-to-r from-emerald-500 to-emerald-600 h-4 rounded-full shadow-lg"
                                                      style="width: {{ $persen }}%">
                                                      <div class="absolute inset-0 bg-white/20 animate-pulse"></div>
                                                </div>
                                          </div>
                                    </div>
                                    @else
                                    <p class="text-sm text-gray-600">Program berkelanjutan untuk mendukung kegiatan kemanusiaan</p>
                                    @endif

                                    {{-- CTA tombol donasi - scroll ke form --}}
                                    <a href="#form-donasi"
                                          class="flex-1 group bg-gradient-to-r from-emerald-600 to-emerald-500 hover:from-emerald-700 hover:to-emerald-600 text-white py-4 rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all duration-300 flex items-center justify-center gap-3">
                                          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                          </svg>
                                          <span>{{ $program->type === 'infaq' ? 'Infaq' : 'Donasi' }} Sekarang</span>
                                          <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                          </svg>
                                    </a>
                              </div>
                        </div>

                        {{-- Deskripsi Program --}}
                        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
                              <h2 class="text-xl font-bold text-gray-900 mb-5">Tentang Program</h2>
                              <div class="prose prose-emerald max-w-none text-gray-700 leading-relaxed">
                                    @if($program->konten)
                                    {!! $program->konten !!}
                                    @else
                                    <p>{{ $program->deskripsi }}</p>
                                    @endif
                              </div>
                        </div>

                        {{-- FORM DONASI --}}
                        @if($program->is_open)
                        <div id="form-donasi" class="bg-white rounded-3xl shadow-xl border border-gray-100 p-8 scroll-mt-8">
                              <h2 class="text-xl font-bold text-gray-900 mb-6">
                                    {{ $program->type === 'infaq' ? 'Form Infaq' : 'Form Donasi' }}
                              </h2>

                              @if($errors->any())
                              <div class="mb-5 p-4 bg-red-50 border border-red-200 rounded-xl text-red-600 text-sm">
                                    <ul class="list-disc list-inside space-y-1">
                                          @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                                    </ul>
                              </div>
                              @endif

                              <form action="{{ route($program->type . '.store', $program->slug) }}" method="POST">
                                    @csrf

                                    {{-- Pilihan nominal cepat --}}
                                    <div class="mb-5">
                                          <label class="block text-sm font-medium text-gray-700 mb-3">
                                                Pilih Nominal <span class="text-red-500">*</span>
                                          </label>
                                          <div class="grid grid-cols-3 sm:grid-cols-4 gap-2 mb-3">
                                                @foreach([50000, 100000, 200000, 500000] as $nominal)
                                                <button type="button"
                                                      onclick="setNominal({{ $nominal }})"
                                                      data-nominal="{{ $nominal }}"
                                                      class="nominal-btn py-2.5 px-2 rounded-xl border-2 border-gray-200 text-sm font-semibold text-gray-700 hover:border-emerald-500 hover:text-emerald-600 transition-all text-center">
                                                      Rp {{ number_format($nominal, 0, ',', '.') }}
                                                </button>
                                                @endforeach
                                          </div>
                                          <div class="relative">
                                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 font-semibold">Rp</span>
                                                <input type="number" name="jumlah" id="jumlah_input"
                                                      value="{{ old('jumlah') }}"
                                                      placeholder="Nominal lainnya..."
                                                      min="1000"
                                                      oninput="clearNominalBtns()"
                                                      class="w-full pl-12 pr-4 py-3 rounded-xl border-2 border-gray-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 text-gray-900 @error('jumlah') border-red-500 @enderror">
                                          </div>
                                          @error('jumlah')
                                          <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                                          @enderror
                                    </div>

                                    {{-- Anonim --}}
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
                                                <label class="block text-sm font-medium text-gray-700 mb-1.5">Doa / Catatan (opsional)</label>
                                                <textarea name="catatan" rows="2"
                                                      placeholder="Semoga program ini memberikan manfaat..."
                                                      class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-emerald-500 resize-none">{{ old('catatan') }}</textarea>
                                          </div>
                                    </div>

                                    <div class="mt-6 p-4 bg-gray-50 rounded-xl border border-gray-200">
                                          <div class="flex justify-between items-center">
                                                <span class="text-gray-600 text-sm">Total yang akan dibayar:</span>
                                                <span id="summary-nominal" class="text-xl font-bold text-emerald-600">Rp 0</span>
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
                        @else
                        <div class="bg-gray-100 rounded-3xl p-8 text-center">
                              <p class="text-gray-500 font-semibold">Program ini sudah berakhir. Terima kasih atas dukungan Anda.</p>
                        </div>
                        @endif

                        {{-- Riwayat Donatur --}}
                        @if($riwayatDonasi->count() > 0)
                        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-8">
                              <h2 class="text-xl font-bold text-gray-900 mb-5">Donatur Terbaru</h2>
                              <div class="space-y-3">
                                    @foreach($riwayatDonasi as $trx)
                                    <div class="flex items-center gap-4 p-4 bg-gray-50 rounded-2xl border border-gray-100">
                                          <div class="w-10 h-10 rounded-full bg-emerald-100 flex items-center justify-center text-emerald-700 font-bold text-sm flex-shrink-0">
                                                {{ strtoupper(substr($trx->nama_tampil, 0, 1)) }}
                                          </div>
                                          <div class="flex-1 min-w-0">
                                                <p class="font-semibold text-gray-900 text-sm truncate">{{ $trx->nama_tampil }}</p>
                                                <p class="text-xs text-gray-500">{{ $trx->created_at->diffForHumans() }}</p>
                                          </div>
                                          <div class="text-right">
                                                <p class="font-bold text-emerald-600 text-sm">{{ $trx->jumlah_format }}</p>
                                                @if($trx->catatan)
                                                <p class="text-xs text-gray-400 max-w-32 truncate">{{ $trx->catatan }}</p>
                                                @endif
                                          </div>
                                    </div>
                                    @endforeach
                              </div>
                        </div>
                        @endif

                  </div>

                  {{-- RIGHT: Org Card --}}
                  <div class="lg:col-span-1">
                        <div class="sticky top-8 space-y-6">
                              <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden">
                                    <div class="p-8">
                                          <div class="flex items-center gap-4 mb-6">
                                                <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-emerald-600 to-emerald-500 flex items-center justify-center text-white font-bold text-2xl shadow-lg">NU</div>
                                                <div class="flex-1">
                                                      <h3 class="font-bold text-gray-900 text-lg mb-1">LAZISNU Bojonegoro</h3>
                                                      <p class="text-emerald-600 text-sm font-medium flex items-center gap-1">
                                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                                  <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                            </svg>
                                                            Verified Organization
                                                      </p>
                                                </div>
                                          </div>
                                          <div class="space-y-3 mb-6 text-sm text-gray-600">
                                                <div class="flex items-center gap-2">
                                                      <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                                      </svg>
                                                      <span>Bojonegoro, Jawa Timur</span>
                                                </div>
                                          </div>
                                          <a href="{{ route('profile') }}" class="block w-full py-3 border-2 border-emerald-600 text-emerald-600 rounded-xl font-semibold hover:bg-emerald-50 transition-all text-center">
                                                Lihat Profil
                                          </a>
                                    </div>
                              </div>

                              <div class="bg-gradient-to-br from-emerald-50 to-emerald-100/50 rounded-3xl p-6 border border-emerald-200">
                                    <h4 class="font-bold text-gray-900 mb-4">Jaminan Kami</h4>
                                    <div class="space-y-2.5 text-sm text-gray-700">
                                          @foreach(['Dana dikelola secara profesional dan amanah', 'Laporan transparansi berkala', 'Penyaluran tepat sasaran'] as $item)
                                          <p class="flex items-start gap-2">
                                                <svg class="w-4 h-4 text-emerald-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                                      <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                </svg>
                                                {{ $item }}
                                          </p>
                                          @endforeach
                                    </div>
                              </div>
                        </div>
                  </div>

            </div>
      </div>
</section>

@push('scripts')
<script>
      function setNominal(amount) {
            document.getElementById('jumlah_input').value = amount;
            document.getElementById('summary-nominal').textContent = 'Rp ' + amount.toLocaleString('id-ID');
            document.querySelectorAll('.nominal-btn').forEach(btn => {
                  const isSelected = parseInt(btn.dataset.nominal) === amount;
                  btn.className = isSelected ?
                        'nominal-btn py-2.5 px-2 rounded-xl border-2 border-emerald-600 bg-emerald-50 text-sm font-semibold text-emerald-700 transition-all text-center' :
                        'nominal-btn py-2.5 px-2 rounded-xl border-2 border-gray-200 text-sm font-semibold text-gray-700 hover:border-emerald-500 hover:text-emerald-600 transition-all text-center';
            });
      }

      function clearNominalBtns() {
            const val = parseInt(document.getElementById('jumlah_input').value) || 0;
            document.getElementById('summary-nominal').textContent = 'Rp ' + val.toLocaleString('id-ID');
            document.querySelectorAll('.nominal-btn').forEach(btn => {
                  btn.className = 'nominal-btn py-2.5 px-2 rounded-xl border-2 border-gray-200 text-sm font-semibold text-gray-700 hover:border-emerald-500 hover:text-emerald-600 transition-all text-center';
            });
      }

      function toggleAnonim(checkbox, fieldId) {
            const field = document.getElementById(fieldId);
            field.value = checkbox.checked ? 'Hamba Allah' : '';
            field.disabled = checkbox.checked;
            field.classList.toggle('bg-gray-100', checkbox.checked);
      }
</script>
@endpush

@endsection