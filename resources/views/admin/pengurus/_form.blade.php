@php $isEdit = isset($pengurus); @endphp

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

      {{-- ─── Kolom Utama ─── --}}
      <div class="lg:col-span-2 space-y-6">

            {{-- Identitas --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                  <h2 class="text-base font-semibold text-gray-800 mb-5 pb-3 border-b border-gray-100">
                        Identitas Pengurus
                  </h2>
                  <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

                        {{-- Gelar Depan --}}
                        <div>
                              <label class="block text-sm font-medium text-gray-700 mb-1.5">
                                    Gelar Depan <span class="text-gray-400 font-normal">(opsional)</span>
                              </label>
                              <input type="text" name="gelar_depan" id="gelar_depan"
                                    value="{{ old('gelar_depan', $pengurus->gelar_depan ?? '') }}"
                                    placeholder="Cth: Dr., Prof."
                                    class="w-full px-3 py-2 border rounded-lg text-sm transition outline-none
                                  @error('gelar_depan') border-red-400 focus:ring-red-400 @else border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 @enderror
                                  focus:ring-2" />
                              @error('gelar_depan')
                              <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                              @enderror
                        </div>

                        {{-- Nama --}}
                        <div>
                              <label for="nama" class="block text-sm font-medium text-gray-700 mb-1.5">
                                    Nama <span class="text-red-500">*</span>
                              </label>
                              <input type="text" name="nama" id="nama"
                                    value="{{ old('nama', $pengurus->nama ?? '') }}"
                                    placeholder="Nama tanpa gelar"
                                    required
                                    class="w-full px-3 py-2 border rounded-lg text-sm transition outline-none
                                  @error('nama') border-red-400 focus:ring-red-400 @else border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 @enderror
                                  focus:ring-2" />
                              @error('nama')
                              <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                              @enderror
                        </div>

                        {{-- Gelar Belakang --}}
                        <div class="sm:col-span-2">
                              <label class="block text-sm font-medium text-gray-700 mb-1.5">
                                    Gelar Belakang <span class="text-gray-400 font-normal">(opsional)</span>
                              </label>
                              <input type="text" name="gelar_belakang" id="gelar_belakang"
                                    value="{{ old('gelar_belakang', $pengurus->gelar_belakang ?? '') }}"
                                    placeholder="Cth: S.E., M.M., M.Pd."
                                    class="w-full px-3 py-2 border rounded-lg text-sm transition outline-none
                                  @error('gelar_belakang') border-red-400 focus:ring-red-400 @else border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 @enderror
                                  focus:ring-2" />
                              @error('gelar_belakang')
                              <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                              @enderror
                        </div>

                        {{-- Email --}}
                        <div>
                              <label class="block text-sm font-medium text-gray-700 mb-1.5">Email</label>
                              <input type="email" name="email" id="email"
                                    value="{{ old('email', $pengurus->email ?? '') }}"
                                    placeholder="contoh@email.com"
                                    class="w-full px-3 py-2 border rounded-lg text-sm transition outline-none
                                  @error('email') border-red-400 @else border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 @enderror
                                  focus:ring-2" />
                              @error('email')
                              <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                              @enderror
                        </div>

                        {{-- No HP --}}
                        <div>
                              <label class="block text-sm font-medium text-gray-700 mb-1.5">No. HP / WhatsApp</label>
                              <input type="text" name="no_hp" id="no_hp"
                                    value="{{ old('no_hp', $pengurus->no_hp ?? '') }}"
                                    placeholder="08xxxxxxxxxx"
                                    class="w-full px-3 py-2 border rounded-lg text-sm transition outline-none
                                  @error('no_hp') border-red-400 @else border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 @enderror
                                  focus:ring-2" />
                              @error('no_hp')
                              <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                              @enderror
                        </div>
                  </div>
            </div>

            {{-- Jabatan & Periode --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                  <h2 class="text-base font-semibold text-gray-800 mb-5 pb-3 border-b border-gray-100">
                        Jabatan &amp; Masa Khidmat
                  </h2>
                  <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">

                        {{-- Jabatan --}}
                        <div>
                              <label for="jabatan" class="block text-sm font-medium text-gray-700 mb-1.5">
                                    Jabatan <span class="text-red-500">*</span>
                              </label>
                              <select name="jabatan" id="jabatan" required
                                    onchange="toggleBidang(this.value)"
                                    class="w-full px-3 py-2 border rounded-lg text-sm transition outline-none
                                   @error('jabatan') border-red-400 @else border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 @enderror
                                   focus:ring-2">
                                    <option value="">-- Pilih Jabatan --</option>
                                    @foreach($jabatanList as $j)
                                    <option value="{{ $j }}"
                                          {{ old('jabatan', $pengurus->jabatan ?? '') === $j ? 'selected' : '' }}>
                                          {{ $j }}
                                    </option>
                                    @endforeach
                              </select>
                              @error('jabatan')
                              <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                              @enderror
                        </div>

                        {{-- Urutan --}}
                        <div>
                              <label for="urutan" class="block text-sm font-medium text-gray-700 mb-1.5">
                                    Urutan Tampil <span class="text-red-500">*</span>
                              </label>
                              <input type="number" name="urutan" id="urutan" min="0" max="255"
                                    value="{{ old('urutan', $pengurus->urutan ?? 0) }}"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm transition outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" />
                              <p class="mt-1 text-xs text-gray-400">Angka kecil tampil lebih dahulu.</p>
                        </div>

                        {{-- Bidang (hidden default) --}}
                        <div id="bidang-wrapper"
                              class="{{ old('jabatan', $pengurus->jabatan ?? '') === 'Anggota' ? '' : 'hidden' }} sm:col-span-2">
                              <label for="bidang" class="block text-sm font-medium text-gray-700 mb-1.5">
                                    Bidang <span class="text-red-500">*</span>
                              </label>
                              <select name="bidang" id="bidang"
                                    class="w-full px-3 py-2 border rounded-lg text-sm transition outline-none
                                   @error('bidang') border-red-400 @else border-gray-300 focus:ring-emerald-500 focus:border-emerald-500 @enderror
                                   focus:ring-2">
                                    <option value="">-- Pilih Bidang --</option>
                                    @foreach($bidangList as $b)
                                    <option value="{{ $b }}"
                                          {{ old('bidang', $pengurus->bidang ?? '') === $b ? 'selected' : '' }}>
                                          {{ $b }}
                                    </option>
                                    @endforeach
                              </select>
                              @error('bidang')
                              <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                              @enderror
                        </div>

                        {{-- Masa Khidmat Mulai --}}
                        <div>
                              <label for="masa_khidmat_mulai" class="block text-sm font-medium text-gray-700 mb-1.5">
                                    Tahun Mulai <span class="text-red-500">*</span>
                              </label>
                              <input type="number" name="masa_khidmat_mulai" id="masa_khidmat_mulai"
                                    min="2000" max="2099"
                                    value="{{ old('masa_khidmat_mulai', $pengurus->masa_khidmat_mulai ?? 2025) }}"
                                    required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm transition outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" />
                              @error('masa_khidmat_mulai')
                              <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                              @enderror
                        </div>

                        {{-- Masa Khidmat Selesai --}}
                        <div>
                              <label for="masa_khidmat_selesai" class="block text-sm font-medium text-gray-700 mb-1.5">
                                    Tahun Selesai <span class="text-red-500">*</span>
                              </label>
                              <input type="number" name="masa_khidmat_selesai" id="masa_khidmat_selesai"
                                    min="2000" max="2099"
                                    value="{{ old('masa_khidmat_selesai', $pengurus->masa_khidmat_selesai ?? 2030) }}"
                                    required
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm transition outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" />
                              @error('masa_khidmat_selesai')
                              <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                              @enderror
                        </div>

                        {{-- Nomor SK --}}
                        <div class="sm:col-span-2">
                              <label for="no_sk" class="block text-sm font-medium text-gray-700 mb-1.5">
                                    Nomor SK
                              </label>
                              <input type="text" name="no_sk" id="no_sk"
                                    value="{{ old('no_sk', $pengurus->no_sk ?? '') }}"
                                    placeholder="Cth: 265/PC.01/A.II.01.07/1614/01/2026"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm transition outline-none focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500" />
                        </div>
                  </div>
            </div>
      </div>

      {{-- ─── Kolom Samping ─── --}}
      <div class="space-y-6">

            {{-- Foto --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                  <h2 class="text-base font-semibold text-gray-800 mb-5 pb-3 border-b border-gray-100">
                        Foto Pengurus
                  </h2>

                  {{-- Preview --}}
                  <div class="flex justify-center mb-4">
                        <div id="foto-preview-wrapper"
                              class="w-32 h-32 rounded-full overflow-hidden bg-gray-100 border-2 border-gray-200 flex items-center justify-center">
                              @if($isEdit && $pengurus->foto)
                              <img id="foto-preview" src="{{ $pengurus->foto_url }}"
                                    class="w-full h-full object-cover" alt="{{ $pengurus->nama }}" />
                              @else
                              <span id="foto-placeholder">
                                    <svg class="w-12 h-12 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                    </svg>
                              </span>
                              <img id="foto-preview" class="w-full h-full object-cover hidden" src="" alt="Preview" />
                              @endif
                        </div>
                  </div>

                  <label class="block w-full cursor-pointer">
                        <span class="block w-full text-center text-sm bg-gray-50 hover:bg-gray-100 border border-gray-300 border-dashed rounded-lg py-2.5 px-4 transition font-medium text-gray-600">
                              Pilih Foto
                        </span>
                        <input type="file" name="foto" id="foto" accept="image/*" class="hidden"
                              onchange="previewFoto(this)" />
                  </label>
                  <p class="mt-2 text-xs text-gray-400 text-center">JPG, PNG, WebP. Maks 2 MB.</p>

                  @error('foto')
                  <p class="mt-1 text-xs text-red-500 text-center">{{ $message }}</p>
                  @enderror

                  {{-- Tombol hapus foto (edit saja) --}}
                  @if($isEdit && $pengurus->foto)
                  <form method="POST"
                        action="{{ route('pengurus.destroy-foto', $pengurus) }}"
                        onsubmit="return confirm('Hapus foto?')"
                        class="mt-3">
                        @csrf @method('DELETE')
                        <button type="submit"
                              class="w-full text-xs text-red-500 hover:text-red-700 border border-red-200 hover:border-red-400 rounded-lg py-1.5 transition">
                              Hapus Foto
                        </button>
                  </form>
                  @endif
            </div>

            {{-- Status --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                  <h2 class="text-base font-semibold text-gray-800 mb-4">Status</h2>
                  <label class="flex items-center gap-3 cursor-pointer select-none">
                        <input type="hidden" name="is_active" value="0" />
                        <input type="checkbox" name="is_active" id="is_active" value="1"
                              {{ old('is_active', $pengurus->is_active ?? true) ? 'checked' : '' }}
                              class="w-4 h-4 text-emerald-600 border-gray-300 rounded focus:ring-emerald-500" />
                        <span class="text-sm text-gray-700">Tampilkan sebagai pengurus aktif</span>
                  </label>
            </div>

            {{-- Action Buttons --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6 space-y-3">
                  <button type="submit"
                        class="w-full bg-emerald-600 hover:bg-emerald-700 text-white font-semibold py-2.5 px-4 rounded-lg transition-colors duration-200 text-sm">
                        {{ $isEdit ? 'Simpan Perubahan' : 'Tambah Pengurus' }}
                  </button>
                  <a href="{{ route('pengurus.index') }}"
                        class="block w-full text-center bg-white hover:bg-gray-50 text-gray-700 font-medium py-2.5 px-4 rounded-lg border border-gray-300 transition text-sm">
                        Batal
                  </a>
            </div>
      </div>
</div>

@push('scripts')
<script>
      // Toggle bidang field
      function toggleBidang(jabatan) {
            const wrapper = document.getElementById('bidang-wrapper');
            const select = document.getElementById('bidang');
            if (jabatan === 'Anggota') {
                  wrapper.classList.remove('hidden');
                  select.required = true;
            } else {
                  wrapper.classList.add('hidden');
                  select.required = false;
                  select.value = '';
            }
      }

      // Preview foto sebelum upload
      function previewFoto(input) {
            const preview = document.getElementById('foto-preview');
            const placeholder = document.getElementById('foto-placeholder');
            if (input.files && input.files[0]) {
                  const reader = new FileReader();
                  reader.onload = function(e) {
                        preview.src = e.target.result;
                        preview.classList.remove('hidden');
                        if (placeholder) placeholder.classList.add('hidden');
                  };
                  reader.readAsDataURL(input.files[0]);
            }
      }
</script>
@endpush