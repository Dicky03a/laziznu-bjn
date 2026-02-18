<form action="{{ isset($program) ? route('programs.update', $program) : route('programs.store') }}"
      method="POST"
      enctype="multipart/form-data"
      class="grid grid-cols-1 lg:grid-cols-3 gap-6">
      @csrf
      @if(isset($program)) @method('PUT') @endif

      {{-- LEFT: Main Form --}}
      <div class="lg:col-span-2 space-y-5">

            @if($errors->any())
            <div class="p-4 bg-red-50 border border-red-200 rounded-xl text-red-600 text-sm">
                  <ul class="list-disc list-inside space-y-1">
                        @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                  </ul>
            </div>
            @endif

            {{-- Jenis --}}
            <div class="bg-white rounded-2xl border border-gray-200 p-6">
                  <label class="block text-sm font-semibold text-gray-700 mb-3">Jenis Program <span class="text-red-500">*</span></label>
                  <div class="grid grid-cols-2 gap-4">
                        @foreach(['infaq' => ['label' => 'Infaq', 'color' => 'blue', 'desc' => 'Program infaq dengan banyak program'], 'donasi' => ['label' => 'Donasi', 'color' => 'purple', 'desc' => 'Program donasi dengan target dana']] as $value => $opt)
                        <label class="relative cursor-pointer">
                              <input type="radio" name="type" value="{{ $value }}"
                                    {{ old('type', $program->type ?? '') === $value ? 'checked' : '' }}
                                    class="peer sr-only">
                              <div class="p-4 rounded-xl border-2 border-gray-200 peer-checked:border-{{ $opt['color'] }}-500 peer-checked:bg-{{ $opt['color'] }}-50 transition-all">
                                    <p class="font-semibold text-gray-900">{{ $opt['label'] }}</p>
                                    <p class="text-xs text-gray-500 mt-0.5">{{ $opt['desc'] }}</p>
                              </div>
                        </label>
                        @endforeach
                  </div>
                  @error('type') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
            </div>

            {{-- Info Dasar --}}
            <div class="bg-white rounded-2xl border border-gray-200 p-6 space-y-4">
                  <h3 class="font-semibold text-gray-900">Informasi Program</h3>

                  <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama Program <span class="text-red-500">*</span></label>
                        <input type="text" name="nama" value="{{ old('nama', $program->nama ?? '') }}"
                              placeholder="Contoh: Infaq Operasional Masjid"
                              class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 @error('nama') border-red-500 @enderror">
                        @error('nama') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                  </div>

                  <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Deskripsi Singkat <span class="text-red-500">*</span></label>
                        <textarea name="deskripsi" rows="3"
                              placeholder="Deskripsi singkat program (tampil di listing)"
                              class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-emerald-500 resize-none @error('deskripsi') border-red-500 @enderror">{{ old('deskripsi', $program->deskripsi ?? '') }}</textarea>
                        @error('deskripsi') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                  </div>

                  <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Konten Lengkap</label>
                        <textarea name="konten" id="konten" rows="8"
                              placeholder="Deskripsi lengkap program (mendukung HTML / Markdown)"
                              class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-emerald-500 resize-none font-mono text-sm">{{ old('konten', $program->konten ?? '') }}</textarea>
                        <p class="text-xs text-gray-400 mt-1">Mendukung HTML dasar untuk formatting konten</p>
                  </div>
            </div>

            {{-- Target & Periode --}}
            <div class="bg-white rounded-2xl border border-gray-200 p-6 space-y-4">
                  <h3 class="font-semibold text-gray-900">Target & Periode</h3>

                  <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Target Dana (kosongkan jika tidak ada target)</label>
                        <div class="relative">
                              <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 font-semibold text-sm">Rp</span>
                              <input type="number" name="target_dana"
                                    value="{{ old('target_dana', $program->target_dana ?? '') }}"
                                    placeholder="0"
                                    min="0"
                                    class="w-full pl-12 pr-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-emerald-500">
                        </div>
                  </div>

                  <div class="grid grid-cols-2 gap-4">
                        <div>
                              <label class="block text-sm font-medium text-gray-700 mb-1.5">Tanggal Mulai</label>
                              <input type="date" name="start_date"
                                    value="{{ old('start_date', isset($program->start_date) ? $program->start_date->format('Y-m-d') : '') }}"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-emerald-500">
                        </div>
                        <div>
                              <label class="block text-sm font-medium text-gray-700 mb-1.5">Tanggal Berakhir</label>
                              <input type="date" name="end_date"
                                    value="{{ old('end_date', isset($program->end_date) ? $program->end_date->format('Y-m-d') : '') }}"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-emerald-500">
                              <p class="text-xs text-gray-400 mt-1">Kosongkan untuk program berkelanjutan</p>
                        </div>
                  </div>
            </div>

      </div>

      {{-- RIGHT: Thumbnail & Settings --}}
      <div class="space-y-5">

            {{-- Thumbnail --}}
            <div class="bg-white rounded-2xl border border-gray-200 p-6">
                  <h3 class="font-semibold text-gray-900 mb-4">Gambar Program</h3>

                  @if(isset($program) && $program->thumbnail)
                  <div class="mb-4">
                        <img src="{{ asset('storage/' . $program->thumbnail) }}"
                              alt="Thumbnail saat ini"
                              class="w-full h-40 object-cover rounded-xl">
                        <p class="text-xs text-gray-400 text-center mt-1">Gambar saat ini</p>
                  </div>
                  @endif

                  <label class="block w-full cursor-pointer">
                        <div class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:border-emerald-400 hover:bg-emerald-50/50 transition-all">
                              <svg class="w-8 h-8 text-gray-400 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                              </svg>
                              <p class="text-sm text-gray-500">Klik untuk upload gambar</p>
                              <p class="text-xs text-gray-400 mt-1">JPG, PNG, WEBP. Maks 2MB</p>
                        </div>
                        <input type="file" name="thumbnail" accept="image/*" class="hidden"
                              onchange="previewImage(this)">
                  </label>
                  <img id="preview-img" src="" alt="" class="hidden w-full h-40 object-cover rounded-xl mt-3">
            </div>

            {{-- Status --}}
            <div class="bg-white rounded-2xl border border-gray-200 p-6 space-y-4">
                  <h3 class="font-semibold text-gray-900">Pengaturan Tampilan</h3>

                  <label class="flex items-center gap-3 cursor-pointer">
                        <input type="hidden" name="is_active" value="0">
                        <div class="relative">
                              <input type="checkbox" name="is_active" value="1" class="sr-only peer"
                                    {{ old('is_active', $program->is_active ?? true) ? 'checked' : '' }}>
                              <div class="w-11 h-6 bg-gray-200 peer-focus:ring-2 peer-focus:ring-emerald-500 rounded-full peer peer-checked:bg-emerald-600 transition-all"></div>
                              <div class="absolute left-1 top-1 w-4 h-4 bg-white rounded-full shadow peer-checked:translate-x-5 transition-all"></div>
                        </div>
                        <div>
                              <p class="text-sm font-medium text-gray-700">Program Aktif</p>
                              <p class="text-xs text-gray-400">Tampilkan di halaman publik</p>
                        </div>
                  </label>

                  <label class="flex items-center gap-3 cursor-pointer">
                        <input type="hidden" name="is_featured" value="0">
                        <div class="relative">
                              <input type="checkbox" name="is_featured" value="1" class="sr-only peer"
                                    {{ old('is_featured', $program->is_featured ?? false) ? 'checked' : '' }}>
                              <div class="w-11 h-6 bg-gray-200 peer-focus:ring-2 peer-focus:ring-amber-500 rounded-full peer peer-checked:bg-amber-500 transition-all"></div>
                              <div class="absolute left-1 top-1 w-4 h-4 bg-white rounded-full shadow peer-checked:translate-x-5 transition-all"></div>
                        </div>
                        <div>
                              <p class="text-sm font-medium text-gray-700">Featured / Unggulan</p>
                              <p class="text-xs text-gray-400">Tampilkan di posisi teratas</p>
                        </div>
                  </label>
            </div>

            {{-- Actions --}}
            <div class="flex gap-3">
                  <a href="{{ route('programs.index') }}"
                        class="flex-1 py-3 border-2 border-gray-300 text-gray-700 text-sm font-semibold rounded-xl text-center hover:bg-gray-50 transition-all">
                        Batal
                  </a>
                  <button type="submit"
                        class="flex-1 py-3 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold rounded-xl transition-all shadow-sm">
                        {{ isset($program) ? 'Simpan Perubahan' : 'Buat Program' }}
                  </button>
            </div>
      </div>

</form>