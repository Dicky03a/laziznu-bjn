@php $isEdit = isset($program); @endphp

<div
      x-data="{
        type: '{{ old('type', $program->type ?? '') }}',

        get isInfaq()  { return this.type === 'infaq'  },
        get isDonasi() { return this.type === 'donasi' },
        get isChosen() { return this.type !== '' },
    }"
      class="grid grid-cols-1 lg:grid-cols-3 gap-6">


      <div class="lg:col-span-2 space-y-5">

            {{-- ── Validation Errors ── --}}
            @if($errors->any())
            <div class="flex gap-3 p-4 bg-red-50 border border-red-200 rounded-xl text-red-700 text-sm">
                  <svg class="w-5 h-5 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 9v2m0 4h.01M10.29 3.86L1.82 18a2 2 0 001.71 3h16.94a2 2 0 001.71-3L13.71 3.86a2 2 0 00-3.42 0z" />
                  </svg>
                  <ul class="space-y-0.5">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                  </ul>
            </div>
            @endif

            {{-- ── STEP 1: Pilih Jenis Program ── --}}
            <div class="bg-white rounded-2xl border border-gray-200 p-6">

                  <div class="flex items-center gap-2 mb-1">
                        <span class="inline-flex items-center justify-center w-6 h-6 bg-emerald-100 text-emerald-700 rounded-full text-xs font-bold">1</span>
                        <h3 class="font-semibold text-gray-900 text-sm">Pilih Jenis Program <span class="text-red-500">*</span></h3>
                  </div>
                  <p class="text-xs text-gray-400 mb-5 ml-8">Setiap jenis program memiliki pengaturan yang berbeda.</p>

                  <input type="hidden" name="type" :value="type">

                  <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                        {{-- ─── Card: Infaq ─── --}}
                        <button type="button" @click="type = 'infaq'"
                              :class="isInfaq
                            ? 'border-blue-500 bg-blue-50 ring-2 ring-blue-500 ring-offset-1'
                            : 'border-gray-200 bg-white hover:border-blue-300 hover:bg-blue-50/40'"
                              class="relative text-left rounded-2xl border-2 p-5 transition-all duration-200 group focus:outline-none focus:ring-2 focus:ring-blue-400">

                              {{-- Check badge --}}
                              <span x-show="isInfaq"
                                    class="absolute top-3 right-3 w-5 h-5 bg-blue-500 rounded-full flex items-center justify-center">
                                    <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                    </svg>
                              </span>

                              {{-- Icon --}}
                              <div :class="isInfaq ? 'bg-blue-500 text-white' : 'bg-blue-100 text-blue-600 group-hover:bg-blue-200'"
                                    class="w-11 h-11 rounded-xl flex items-center justify-center mb-4 transition-colors">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15" />
                                    </svg>
                              </div>

                              <p class="font-bold text-gray-900 mb-1">DSKL Dana Sosial Keagamaan Lainya</p>
                              <p class="text-xs text-gray-500 leading-relaxed">
                                    Program Infaq Shodaqoh dan <strong>berkelanjutan</strong> tanpa batas waktu. Cocok untuk kegiatan rutin seperti operasional masjid, pendidikan, dan sosial.
                              </p>

                              {{-- Tags --}}
                              <div class="flex flex-wrap gap-1.5 mt-4">
                                    <span class="text-[10px] font-semibold px-2 py-0.5 rounded-full bg-blue-100 text-blue-700">Berkelanjutan</span>
                                    <span class="text-[10px] font-semibold px-2 py-0.5 rounded-full bg-blue-100 text-blue-700">Nominal Bebas</span>
                                    <span class="text-[10px] font-semibold px-2 py-0.5 rounded-full bg-blue-100 text-blue-700">Multi Kategori</span>
                              </div>
                        </button>

                        {{-- ─── Card: Donasi ─── --}}
                        <button type="button" @click="type = 'donasi'"
                              :class="isDonasi
                            ? 'border-purple-500 bg-purple-50 ring-2 ring-purple-500 ring-offset-1'
                            : 'border-gray-200 bg-white hover:border-purple-300 hover:bg-purple-50/40'"
                              class="relative text-left rounded-2xl border-2 p-5 transition-all duration-200 group focus:outline-none focus:ring-2 focus:ring-purple-400">

                              <span x-show="isDonasi"
                                    class="absolute top-3 right-3 w-5 h-5 bg-purple-500 rounded-full flex items-center justify-center">
                                    <svg class="w-3 h-3 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                    </svg>
                              </span>

                              <div :class="isDonasi ? 'bg-purple-500 text-white' : 'bg-purple-100 text-purple-600 group-hover:bg-purple-200'"
                                    class="w-11 h-11 rounded-xl flex items-center justify-center mb-4 transition-colors">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                              </div>

                              <p class="font-bold text-gray-900 mb-1">Infaq Shodaqoh dan Peduli Bencana </p>
                              <p class="text-xs text-gray-500 leading-relaxed">
                                    Program donasi dengan <strong>target dana</strong> dan batas waktu. Cocok untuk kegiatan insidental seperti bencana, pembangunan, dan bantuan khusus.
                              </p>

                              <div class="flex flex-wrap gap-1.5 mt-4">
                                    <span class="text-[10px] font-semibold px-2 py-0.5 rounded-full bg-purple-100 text-purple-700">Target Dana</span>
                                    <span class="text-[10px] font-semibold px-2 py-0.5 rounded-full bg-purple-100 text-purple-700">Batas Waktu</span>
                                    <span class="text-[10px] font-semibold px-2 py-0.5 rounded-full bg-purple-100 text-purple-700">Progress Bar</span>
                              </div>
                        </button>
                  </div>

                  @error('type')
                  <p class="text-xs text-red-600 mt-3 flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                              <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                        {{ $message }}
                  </p>
                  @enderror

                  {{-- Info ringkas setelah pilih --}}
                  <div x-show="isInfaq" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-1" x-transition:enter-end="opacity-100 translate-y-0"
                        class="mt-4 flex items-start gap-2.5 p-3 bg-blue-50 rounded-xl border border-blue-100">
                        <svg class="w-4 h-4 text-blue-500 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="text-xs text-blue-700">
                              <strong>Program Infaq Shodaqoh dan Peduli Bencana</strong> tidak memerlukan target dana dan tanggal berakhir.
                              Anda bisa menambahkan nominal infaq rekomendasi dan kategori pengelompokan.
                        </p>
                  </div>

                  <div x-show="isDonasi" x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 -translate-y-1" x-transition:enter-end="opacity-100 translate-y-0"
                        class="mt-4 flex items-start gap-2.5 p-3 bg-purple-50 rounded-xl border border-purple-100">
                        <svg class="w-4 h-4 text-purple-500 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <p class="text-xs text-purple-700">
                              <strong>Program Donasi</strong> memiliki target dana dan batas waktu pengumpulan.
                              Progress pengumpulan akan ditampilkan secara real-time kepada donatur.
                        </p>
                  </div>
            </div>

            {{-- ── STEP 2: Informasi Program (muncul setelah pilih jenis) ── --}}
            <div x-show="isChosen"
                  x-transition:enter="transition ease-out duration-300"
                  x-transition:enter-start="opacity-0 translate-y-2"
                  x-transition:enter-end="opacity-100 translate-y-0"
                  class="bg-white rounded-2xl border border-gray-200 p-6 space-y-5">

                  <div class="flex items-center gap-2">
                        <span class="inline-flex items-center justify-center w-6 h-6 bg-emerald-100 text-emerald-700 rounded-full text-xs font-bold">2</span>
                        <h3 class="font-semibold text-gray-900 text-sm">Informasi Program</h3>
                  </div>

                  {{-- Nama --}}
                  <div>
                        <label for="nama" class="block text-sm font-medium text-gray-700 mb-1.5">
                              Nama Program <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="nama" id="nama"
                              value="{{ old('nama', $program->nama ?? '') }}"
                              :placeholder="isInfaq ? 'Cth: Infaq/Donasi Operasional Masjid Bojonegoro' : 'Cth: Donasi Bencana Banjir Bojonegoro'"
                              class="w-full px-4 py-3 rounded-xl border border-gray-300 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition
                              @error('nama') border-red-500 @enderror">
                        @error('nama') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                  </div>

                  {{-- Deskripsi Singkat --}}
                  <div>
                        <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-1.5">
                              Deskripsi Singkat <span class="text-red-500">*</span>
                        </label>
                        <textarea name="deskripsi" id="deskripsi" rows="3"
                              placeholder="Ringkasan program (ditampilkan di listing & kartu program)"
                              class="w-full px-4 py-3 rounded-xl border border-gray-300 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none resize-none transition
                                 @error('deskripsi') border-red-500 @enderror">{{ old('deskripsi', $program->deskripsi ?? '') }}</textarea>
                        @error('deskripsi') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                  </div>

                  {{-- Konten Lengkap --}}
                  <div>
                        <label for="konten" class="block text-sm font-medium text-gray-700 mb-1.5">
                              Konten Lengkap
                              <span class="text-gray-400 font-normal">(opsional)</span>
                        </label>
                        <textarea name="konten" id="konten" rows="8"
                              placeholder="Deskripsi lengkap program (mendukung HTML dasar)"
                              class="w-full px-4 py-3 rounded-xl border border-gray-300 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none resize-none font-mono transition">{{ old('konten', $program->konten ?? '') }}</textarea>
                        <p class="text-xs text-gray-400 mt-1">Mendukung HTML dasar: &lt;b&gt;, &lt;i&gt;, &lt;ul&gt;, &lt;ol&gt;, &lt;a&gt;, &lt;p&gt;</p>
                  </div>
            </div>

            {{-- ── STEP 3A: Pengaturan Infaq ── --}}
            <div x-show="isInfaq"
                  x-transition:enter="transition ease-out duration-300 delay-75"
                  x-transition:enter-start="opacity-0 translate-y-2"
                  x-transition:enter-end="opacity-100 translate-y-0"
                  class="bg-white rounded-2xl border-2 border-blue-200 p-6 space-y-5">

                  <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                              <span class="inline-flex items-center justify-center w-6 h-6 bg-blue-100 text-blue-700 rounded-full text-xs font-bold">3</span>
                              <h3 class="font-semibold text-gray-900 text-sm">Pengaturan Infaq Shodaqoh dan Peduli Bencana</h3>
                        </div>
                        <span class="text-xs font-semibold px-2.5 py-1 rounded-full bg-blue-100 text-blue-700">Infaq</span>
                  </div>

                  {{-- Nominal Rekomendasi --}}
                  <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">
                              Nominal Infaq/Donasi Rekomendasi
                              <span class="text-gray-400 font-normal">(opsional)</span>
                        </label>
                        <p class="text-xs text-gray-400 mb-3">Berikan pilihan nominal untuk memudahkan muzakki. Nominal pertama akan jadi default.</p>

                        <div class="space-y-2" id="nominal-list">
                              @php
                              $nominalList = old('nominal_rekomendasi', $program->nominal_rekomendasi ?? [10000, 25000, 50000, 100000]);
                              @endphp
                              @foreach((array)$nominalList as $i => $n)
                              <div class="flex items-center gap-2 nominal-row">
                                    <span class="text-sm text-gray-500 font-medium w-5 shrink-0">{{ $i + 1 }}.</span>
                                    <div class="relative flex-1">
                                          <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm font-medium">Rp</span>
                                          <input type="number" name="nominal_rekomendasi[]"
                                                value="{{ $n }}" min="1000" step="1000"
                                                placeholder="Nominal infaq"
                                                class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-300 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                                    </div>
                                    <button type="button" onclick="removeNominal(this)"
                                          class="p-2 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition">
                                          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                          </svg>
                                    </button>
                              </div>
                              @endforeach
                        </div>

                        <button type="button" onclick="addNominal()"
                              class="mt-3 inline-flex items-center gap-1.5 text-xs font-semibold text-blue-600 hover:text-blue-800 px-3 py-1.5 border border-blue-200 hover:border-blue-400 rounded-lg hover:bg-blue-50 transition">
                              <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                              </svg>
                              Tambah Pilihan Nominal
                        </button>
                  </div>

                  {{-- Tanggal Mulai saja --}}
                  <div>
                        <label for="start_date_infaq" class="block text-sm font-medium text-gray-700 mb-1.5">
                              Tanggal Mulai
                              <span class="text-gray-400 font-normal">(opsional)</span>
                        </label>
                        <input type="date" name="start_date" id="start_date_infaq"
                              value="{{ old('start_date', isset($program->start_date) ? $program->start_date->format('Y-m-d') : '') }}"
                              class="w-full sm:w-56 px-4 py-2.5 rounded-xl border border-gray-300 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
                        <p class="text-xs text-gray-400 mt-1">Program infaq tidak memiliki tanggal berakhir.</p>
                  </div>
            </div>

            {{-- ── STEP 3B: Pengaturan Donasi ── --}}
            <div x-show="isDonasi"
                  x-transition:enter="transition ease-out duration-300 delay-75"
                  x-transition:enter-start="opacity-0 translate-y-2"
                  x-transition:enter-end="opacity-100 translate-y-0"
                  class="bg-white rounded-2xl border-2 border-purple-200 p-6 space-y-5">

                  <div class="flex items-center justify-between">
                        <div class="flex items-center gap-2">
                              <span class="inline-flex items-center justify-center w-6 h-6 bg-purple-100 text-purple-700 rounded-full text-xs font-bold">3</span>
                              <h3 class="font-semibold text-gray-900 text-sm">Pengaturan Donasi</h3>
                        </div>
                        <span class="text-xs font-semibold px-2.5 py-1 rounded-full bg-purple-100 text-purple-700">Donasi</span>
                  </div>

                  {{-- Target Dana --}}
                  <div>
                        <label for="target_dana" class="block text-sm font-medium text-gray-700 mb-1.5">
                              Target Dana <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                              <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 font-semibold text-sm">Rp</span>
                              <input type="number" name="target_dana" id="target_dana"
                                    value="{{ old('target_dana', $program->target_dana ?? '') }}"
                                    placeholder="0"
                                    min="10000"
                                    step="1000"
                                    :required="isDonasi"
                                    class="w-full pl-12 pr-4 py-3 rounded-xl border border-gray-300 text-sm focus:ring-2 focus:ring-purple-500 focus:border-purple-500 outline-none transition
                                  @error('target_dana') border-red-500 @enderror"
                                    oninput="updateTargetPreview(this.value)">
                        </div>
                        @error('target_dana') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                        <p id="target-preview" class="text-xs text-purple-600 font-medium mt-1.5 hidden"></p>
                  </div>

                  {{-- Periode Donasi --}}
                  <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                              <label for="start_date_donasi" class="block text-sm font-medium text-gray-700 mb-1.5">
                                    Tanggal Mulai <span class="text-red-500">*</span>
                              </label>
                              <input type="date" name="start_date" id="start_date_donasi"
                                    value="{{ old('start_date', isset($program->start_date) ? $program->start_date->format('Y-m-d') : date('Y-m-d')) }}"
                                    :required="isDonasi"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-300 text-sm focus:ring-2 focus:ring-purple-500 focus:border-purple-500 outline-none transition
                                  @error('start_date') border-red-500 @enderror">
                              @error('start_date') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                              <label for="end_date" class="block text-sm font-medium text-gray-700 mb-1.5">
                                    Tanggal Berakhir <span class="text-red-500">*</span>
                              </label>
                              <input type="date" name="end_date" id="end_date"
                                    value="{{ old('end_date', isset($program->end_date) ? $program->end_date->format('Y-m-d') : '') }}"
                                    :required="isDonasi"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-300 text-sm focus:ring-2 focus:ring-purple-500 focus:border-purple-500 outline-none transition
                                  @error('end_date') border-red-500 @enderror">
                              @error('end_date') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>
                  </div>

                  {{-- Preview Progress Bar --}}
                  <div class="p-4 bg-gray-50 rounded-xl border border-gray-200">
                        <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-3">Preview Progress Bar</p>
                        <div class="flex justify-between text-xs text-gray-500 mb-1.5">
                              <span>Terkumpul: <strong class="text-gray-700">Rp 0</strong></span>
                              <span id="target-label">Target: <strong class="text-gray-700">—</strong></span>
                        </div>
                        <div class="w-full bg-gray-200 rounded-full h-2.5 overflow-hidden">
                              <div id="progress-bar" class="bg-purple-500 h-2.5 rounded-full transition-all duration-500" style="width: 0%"></div>
                        </div>
                        <p class="text-xs text-gray-400 mt-1.5">Progress bar akan tampil otomatis di halaman donasi.</p>
                  </div>
            </div>

      </div>{{-- end col-left --}}

      {{-- ══════════════════════════════════════════════════ --}}
      {{-- KOLOM KANAN – Thumbnail & Settings                --}}
      {{-- ══════════════════════════════════════════════════ --}}
      <div class="space-y-5">

            {{-- ── Gambar Program ── --}}
            <div class="bg-white rounded-2xl border border-gray-200 p-6">
                  <h3 class="font-semibold text-gray-900 text-sm mb-4">Gambar Program</h3>

                  @if($isEdit && $program->thumbnail)
                  <div class="mb-4 relative group">
                        <img src="{{ asset('storage/' . $program->thumbnail) }}"
                              alt="Thumbnail saat ini"
                              class="w-full h-40 object-cover rounded-xl">
                        <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 flex items-center justify-center rounded-xl transition-opacity">
                              <p class="text-white text-xs font-medium">Klik di bawah untuk mengganti</p>
                        </div>
                  </div>
                  @endif

                  <label class="block w-full cursor-pointer">
                        <div id="drop-zone"
                              class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:border-emerald-400 hover:bg-emerald-50/40 transition-all">
                              <svg class="w-9 h-9 text-gray-300 mx-auto mb-2.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                          d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                              </svg>
                              <p class="text-sm font-medium text-gray-500">Klik untuk upload gambar</p>
                              <p class="text-xs text-gray-400 mt-1">JPG, PNG, WebP &middot; Maks 2 MB</p>
                        </div>
                        <input type="file" name="thumbnail" accept="image/*"
                              class="hidden" onchange="previewThumbnail(this)">
                  </label>

                  <img id="preview-img" src="" alt=""
                        class="hidden w-full h-40 object-cover rounded-xl mt-3 border border-gray-200">
                  @error('thumbnail')
                  <p class="text-xs text-red-600 mt-1">{{ $message }}</p>
                  @enderror
            </div>

            {{-- ── Pengaturan Tampilan ── --}}
            <div class="bg-white rounded-2xl border border-gray-200 p-6 space-y-4">
                  <h3 class="font-semibold text-gray-900 text-sm mb-1">Pengaturan Tampilan</h3>

                  {{-- Toggle Aktif --}}
                  <label class="flex items-start gap-3 cursor-pointer group">
                        <input type="hidden" name="is_active" value="0">
                        <div class="relative mt-0.5 shrink-0">
                              <input type="checkbox" name="is_active" value="1" class="sr-only peer"
                                    {{ old('is_active', $program->is_active ?? true) ? 'checked' : '' }}>
                              <div class="w-11 h-6 bg-gray-200 peer-focus:ring-2 peer-focus:ring-emerald-500 peer-focus:ring-offset-1 rounded-full peer-checked:bg-emerald-500 transition-colors"></div>
                              <div class="absolute left-1 top-1 w-4 h-4 bg-white rounded-full shadow transition-transform peer-checked:translate-x-5"></div>
                        </div>
                        <div>
                              <p class="text-sm font-medium text-gray-800">Program Aktif</p>
                              <p class="text-xs text-gray-400 leading-relaxed">Tampilkan di halaman publik dan bisa menerima transaksi</p>
                        </div>
                  </label>

                  <div class="border-t border-gray-100"></div>

                  {{-- Toggle Featured --}}
                  <label class="flex items-start gap-3 cursor-pointer group">
                        <input type="hidden" name="is_featured" value="0">
                        <div class="relative mt-0.5 shrink-0">
                              <input type="checkbox" name="is_featured" value="1" class="sr-only peer"
                                    {{ old('is_featured', $program->is_featured ?? false) ? 'checked' : '' }}>
                              <div class="w-11 h-6 bg-gray-200 peer-focus:ring-2 peer-focus:ring-amber-500 peer-focus:ring-offset-1 rounded-full peer-checked:bg-amber-500 transition-colors"></div>
                              <div class="absolute left-1 top-1 w-4 h-4 bg-white rounded-full shadow transition-transform peer-checked:translate-x-5"></div>
                        </div>
                        <div>
                              <p class="text-sm font-medium text-gray-800">Program Unggulan</p>
                              <p class="text-xs text-gray-400 leading-relaxed">Tampilkan di posisi teratas & halaman utama</p>
                        </div>
                  </label>
            </div>

            {{-- ── Ringkasan (muncul setelah pilih jenis) ── --}}
            <div x-show="isChosen"
                  x-transition:enter="transition ease-out duration-300"
                  x-transition:enter-start="opacity-0"
                  x-transition:enter-end="opacity-100"
                  class="rounded-2xl border p-4 text-xs space-y-2"
                  :class="isInfaq ? 'bg-blue-50 border-blue-200 text-blue-800' : 'bg-purple-50 border-purple-200 text-purple-800'">

                  <p class="font-bold text-sm" x-text="isInfaq ? 'Ringkasan Program Infaq Shodaqoh dan Peduli Bencana' : 'Ringkasan Program DSKI Dana Sosial Keagamaan Lainya'"></p>

                  <template x-if="isInfaq">
                        <ul class="space-y-1">
                              <li class="flex gap-2"><span>✓</span><span>Tidak ada batas waktu pengumpulan</span></li>
                              <li class="flex gap-2"><span>✓</span><span>Nominal bebas ditentukan donatur</span></li>
                              <li class="flex gap-2"><span>✓</span><span>Tidak ada progress bar target dana</span></li>
                              <li class="flex gap-2"><span>✓</span><span>Cocok untuk program jangka panjang</span></li>
                        </ul>
                  </template>

                  <template x-if="isDonasi">
                        <ul class="space-y-1">
                              <li class="flex gap-2"><span>✓</span><span>Target dana harus ditentukan</span></li>
                              <li class="flex gap-2"><span>✓</span><span>Memiliki tanggal mulai & berakhir</span></li>
                              <li class="flex gap-2"><span>✓</span><span>Progress bar tampil di halaman publik</span></li>
                              <li class="flex gap-2"><span>✓</span><span>Cocok untuk program insidental</span></li>
                        </ul>
                  </template>
            </div>

            {{-- ── Action Buttons ── --}}
            <div class="flex gap-3">
                  <a href="{{ route('programs.index') }}"
                        class="flex-1 py-3 border-2 border-gray-300 text-gray-700 text-sm font-semibold rounded-xl text-center hover:bg-gray-50 transition-all">
                        Batal
                  </a>
                  <button type="submit" :disabled="!isChosen"
                        :class="isChosen
                        ? (isDonasi ? 'bg-purple-600 hover:bg-purple-700' : 'bg-blue-600 hover:bg-blue-700')
                        : 'bg-gray-300 cursor-not-allowed'"
                        class="flex-1 py-3 text-white text-sm font-semibold rounded-xl transition-all shadow-sm">
                        {{ $isEdit ? 'Simpan Perubahan' : 'Buat Program' }}
                  </button>
            </div>

            {{-- Hint jika belum pilih --}}
            <p x-show="!isChosen" class="text-center text-xs text-gray-400">
                  Pilih jenis program terlebih dahulu untuk melanjutkan.
            </p>

      </div>{{-- end col-right --}}

</div>{{-- end x-data --}}

@push('scripts')
<script>
      // ── Preview thumbnail ──────────────────────────────
      function previewThumbnail(input) {
            if (input.files && input.files[0]) {
                  const reader = new FileReader();
                  reader.onload = e => {
                        const img = document.getElementById('preview-img');
                        img.src = e.target.result;
                        img.classList.remove('hidden');
                  };
                  reader.readAsDataURL(input.files[0]);
            }
      }

      // ── Update target preview (Donasi) ──────────────────
      function updateTargetPreview(value) {
            const num = parseInt(value) || 0;
            const preview = document.getElementById('target-preview');
            const label = document.getElementById('target-label');
            const bar = document.getElementById('progress-bar');

            if (num > 0) {
                  const formatted = 'Rp ' + num.toLocaleString('id-ID');
                  preview.textContent = `Target: ${formatted}`;
                  preview.classList.remove('hidden');
                  label.innerHTML = `Target: <strong class="text-gray-700">${formatted}</strong>`;
            } else {
                  preview.classList.add('hidden');
                  label.innerHTML = `Target: <strong class="text-gray-700">—</strong>`;
            }
            // Demo progress (0%)
            bar.style.width = '0%';
      }

      // ── Nominal infaq dynamic rows ────────────────────
      function addNominal() {
            const list = document.getElementById('nominal-list');
            const count = list.querySelectorAll('.nominal-row').length + 1;
            const row = document.createElement('div');
            row.className = 'flex items-center gap-2 nominal-row';
            row.innerHTML = `
            <span class="text-sm text-gray-500 font-medium w-5 shrink-0">${count}.</span>
            <div class="relative flex-1">
                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-sm font-medium">Rp</span>
                <input type="number" name="nominal_rekomendasi[]"
                       value="" min="1000" step="1000"
                       placeholder="Nominal infaq"
                       class="w-full pl-10 pr-4 py-2.5 rounded-xl border border-gray-300 text-sm focus:ring-2 focus:ring-blue-500 focus:border-blue-500 outline-none transition">
            </div>
            <button type="button" onclick="removeNominal(this)"
                    class="p-2 text-gray-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>`;
            list.appendChild(row);
            reindexNominal();
      }

      function removeNominal(btn) {
            const list = document.getElementById('nominal-list');
            if (list.querySelectorAll('.nominal-row').length <= 1) return; // min 1
            btn.closest('.nominal-row').remove();
            reindexNominal();
      }

      function reindexNominal() {
            document.querySelectorAll('#nominal-list .nominal-row').forEach((row, i) => {
                  const label = row.querySelector('span');
                  if (label) label.textContent = (i + 1) + '.';
            });
      }

      // Init target preview on edit mode
      document.addEventListener('DOMContentLoaded', () => {
            const target = document.getElementById('target_dana');
            if (target && target.value) updateTargetPreview(target.value);
      });
</script>
@endpush