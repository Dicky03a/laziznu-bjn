@php $isEdit = isset($distributionProgram); @endphp

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

      <div class="lg:col-span-2 space-y-5">

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

            <div class="bg-white rounded-2xl border border-gray-200 p-6 space-y-5">
                  <div class="flex items-center gap-2 mb-1">
                        <span class="inline-flex items-center justify-center w-6 h-6 bg-emerald-100 text-emerald-700 rounded-full text-xs font-bold">1</span>
                        <h3 class="font-semibold text-gray-900 text-sm">Informasi Program Distribusi</h3>
                  </div>

                  <div>
                        <label for="nama" class="block text-sm font-medium text-gray-700 mb-1.5">Nama Program <span class="text-red-500">*</span></label>
                        <input type="text" name="nama" id="nama"
                              value="{{ old('nama', $distributionProgram->nama ?? '') }}"
                              placeholder="Nama program distribusi"
                              class="w-full px-4 py-3 rounded-xl border border-gray-300 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition @error('nama') border-red-500 @enderror">
                        @error('nama') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                  </div>

                  <div>
                        <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-1.5">Deskripsi Singkat <span class="text-red-500">*</span></label>
                        <textarea name="deskripsi" id="deskripsi" rows="3"
                              placeholder="Ringkasan program distribusi"
                              class="w-full px-4 py-3 rounded-xl border border-gray-300 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none resize-none transition @error('deskripsi') border-red-500 @enderror">{{ old('deskripsi', $distributionProgram->deskripsi ?? '') }}</textarea>
                        @error('deskripsi') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                  </div>

                  <div>
                        <label for="konten" class="block text-sm font-medium text-gray-700 mb-1.5">Konten Lengkap <span class="text-gray-400 font-normal">(opsional)</span></label>
                        <textarea name="konten" id="konten" rows="6"
                              placeholder="Informasi lengkap program distribusi"
                              class="w-full px-4 py-3 rounded-xl border border-gray-300 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none resize-none font-mono transition">{{ old('konten', $distributionProgram->konten ?? '') }}</textarea>
                        <p class="text-xs text-gray-400 mt-1">Ceritakan tujuan distribusi dan sasaran yang akan dijangkau.</p>
                  </div>
            </div>

            <div class="bg-white rounded-2xl border border-gray-200 p-6 space-y-5">
                  <div class="flex items-center gap-2 mb-1">
                        <span class="inline-flex items-center justify-center w-6 h-6 bg-emerald-100 text-emerald-700 rounded-full text-xs font-bold">2</span>
                        <h3 class="font-semibold text-gray-900 text-sm">Sumber Dana & Target</h3>
                  </div>

                  <div>
                        <label for="source_program_id" class="block text-sm font-medium text-gray-700 mb-1.5">Program Pengumpulan Sumber Dana <span class="text-red-500">*</span></label>
                        <select name="source_program_id" id="source_program_id"
                              onchange="updateSourceInfo()"
                              class="w-full px-4 py-3 rounded-xl border border-gray-300 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition @error('source_program_id') border-red-500 @enderror">
                              <option value="">Pilih sumber program</option>
                              @foreach($sourcePrograms as $program)
                              <option value="{{ $program->id }}"
                                    data-available="{{ $program->available_for_distribution }}"
                                    {{ old('source_program_id', $distributionProgram->source_program_id ?? '') == $program->id ? 'selected' : '' }}>
                                    {{ $program->nama }} ({{ ucfirst($program->type) }})
                              </option>
                              @endforeach
                        </select>
                        @error('source_program_id') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                        <p class="text-xs text-gray-500 mt-2" id="source-available-text">
                              Pilih program sumber untuk melihat sisa dana yang tersedia.
                        </p>
                  </div>

                  <div>
                        <label for="target_dana" class="block text-sm font-medium text-gray-700 mb-1.5">Target Dana Distribusi <span class="text-red-500">*</span></label>
                        <div class="relative">
                              <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 text-sm">Rp</span>
                              <input type="number" name="target_dana" id="target_dana"
                                    value="{{ old('target_dana', $distributionProgram->target_dana ?? '') }}"
                                    min="1000"
                                    step="1000"
                                    placeholder="0"
                                    class="w-full pl-12 pr-4 py-3 rounded-xl border border-gray-300 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition @error('target_dana') border-red-500 @enderror">
                        </div>
                        @error('target_dana') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                        <p class="text-xs text-gray-500 mt-2">Jumlah dana yang akan diambil dari sumber program pengumpulan.</p>
                  </div>

                  <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                              <label for="start_date" class="block text-sm font-medium text-gray-700 mb-1.5">Tanggal Mulai</label>
                              <input type="date" name="start_date" id="start_date"
                                    value="{{ old('start_date', isset($distributionProgram->start_date) ? $distributionProgram->start_date->format('Y-m-d') : '') }}"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-300 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition @error('start_date') border-red-500 @enderror">
                              @error('start_date') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                              <label for="end_date" class="block text-sm font-medium text-gray-700 mb-1.5">Tanggal Berakhir</label>
                              <input type="date" name="end_date" id="end_date"
                                    value="{{ old('end_date', isset($distributionProgram->end_date) ? $distributionProgram->end_date->format('Y-m-d') : '') }}"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-300 text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition @error('end_date') border-red-500 @enderror">
                              @error('end_date') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                        </div>
                  </div>
            </div>

      </div>

      <div class="space-y-5">

            <div class="bg-white rounded-2xl border border-gray-200 p-6">
                  <h3 class="font-semibold text-gray-900 text-sm mb-4">Gambar Program Distribusi</h3>

                  @if($isEdit && $distributionProgram->thumbnail)
                  <div class="mb-4 relative group">
                        <img src="{{ asset('storage/' . $distributionProgram->thumbnail) }}"
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
                              <p class="text-xs text-gray-400 mt-1">JPG, PNG, WebP · Maks 2 MB</p>
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

            <div class="bg-white rounded-2xl border border-gray-200 p-6 space-y-4">
                  <h3 class="font-semibold text-gray-900 text-sm mb-1">Pengaturan Tampilan</h3>

                  <label class="flex items-start gap-3 cursor-pointer group">
                        <input type="hidden" name="is_active" value="0">
                        <div class="relative mt-0.5 shrink-0">
                              <input type="checkbox" name="is_active" value="1" class="sr-only peer"
                                    {{ old('is_active', $distributionProgram->is_active ?? true) ? 'checked' : '' }}>
                              <div class="w-11 h-6 bg-gray-200 peer-focus:ring-2 peer-focus:ring-emerald-500 peer-focus:ring-offset-1 rounded-full peer-checked:bg-emerald-500 transition-colors"></div>
                              <div class="absolute left-1 top-1 w-4 h-4 bg-white rounded-full shadow transition-transform peer-checked:translate-x-5"></div>
                        </div>
                        <div>
                              <p class="text-sm font-medium text-gray-800">Program Aktif</p>
                              <p class="text-xs text-gray-400 leading-relaxed">Tampilkan program distribusi di halaman publik.</p>
                        </div>
                  </label>
            </div>

      </div>

</div>

<script>
      function updateSourceInfo() {
            const select = document.getElementById('source_program_id');
            const detail = document.getElementById('source-available-text');
            if (!select || !detail) return;
            const selected = select.selectedOptions[0];
            const available = selected?.dataset?.available;
            if (available !== undefined) {
                  detail.textContent = 'Sisa dana di sumber program: Rp ' + Number(available).toLocaleString('id-ID') + '.';
            } else {
                  detail.textContent = 'Pilih program sumber untuk melihat sisa dana yang tersedia.';
            }
      }

      function previewThumbnail(input) {
            const img = document.getElementById('preview-img');
            if (!input.files || !input.files[0]) {
                  img.classList.add('hidden');
                  img.src = '';
                  return;
            }
            const reader = new FileReader();
            reader.onload = function(e) {
                  img.src = e.target.result;
                  img.classList.remove('hidden');
            };
            reader.readAsDataURL(input.files[0]);
      }

      document.addEventListener('DOMContentLoaded', updateSourceInfo);
</script>