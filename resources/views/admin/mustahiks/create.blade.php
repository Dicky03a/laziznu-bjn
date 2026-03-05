<x-layouts::app :title="__('Tambah Mustahik')">
      <div class="min-h-screen py-8 px-4">
            <div class="max-w-2xl mx-auto space-y-6">

                  <!-- Header -->
                  <div>
                        <h1 class="text-3xl font-bold text-slate-900 dark:text-white">
                              Tambah Mustahik Baru
                        </h1>
                        <p class="text-slate-600 dark:text-slate-400 mt-2">
                              Isi formulir di bawah untuk menambah data mustahik baru
                        </p>
                  </div>

                  <!-- Form Card -->
                  <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-xl border border-slate-200 dark:border-zinc-800 p-6 md:p-8">
                        <form action="{{ route('mustahiks.store') }}" method="POST" x-data="Mustahik()"
                              x-init="init()" class="space-y-6">
                              @csrf

                              <!-- Nama -->
                              <div>
                                    <label for="nama" class="block text-sm font-semibold text-slate-900 dark:text-white mb-2">
                                          Nama <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="nama" name="nama" value="{{ old('nama') }}"
                                          placeholder="Nama lengkap mustahik"
                                          class="w-full px-4 py-2.5 bg-slate-50 dark:bg-zinc-800 border @error('nama') border-red-500 @else border-slate-300 dark:border-zinc-700 @enderror rounded-lg text-slate-900 dark:text-white placeholder-slate-500 dark:placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                          required>
                                    @error('nama')
                                    <p class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                              </div>

                              <!-- NIK -->
                              <div>
                                    <label for="nik" class="block text-sm font-semibold text-slate-900 dark:text-white mb-2">
                                          NIK <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="nik" name="nik" value="{{ old('nik') }}"
                                          placeholder="16 digit nomor identitas"
                                          class="w-full px-4 py-2.5 bg-slate-50 dark:bg-zinc-800 border @error('nik') border-red-500 @else border-slate-300 dark:border-zinc-700 @enderror rounded-lg text-slate-900 dark:text-white placeholder-slate-500 dark:placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                          maxlength="16"
                                          inputmode="numeric"
                                          required>
                                    @error('nik')
                                    <p class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                              </div>

                              <!-- Jenis Kelamin -->
                              <div>
                                    <label for="jenis_kelamin" class="block text-sm font-semibold text-slate-900 dark:text-white mb-2">
                                          Jenis Kelamin <span class="text-red-500">*</span>
                                    </label>
                                    <select id="jenis_kelamin" name="jenis_kelamin"
                                          class="w-full px-4 py-2.5 bg-slate-50 dark:bg-zinc-800 border @error('jenis_kelamin') border-red-500 @else border-slate-300 dark:border-zinc-700 @enderror rounded-lg text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                          required>
                                          <option value="">-- Pilih Jenis Kelamin --</option>
                                          <option value="laki-laki" {{ old('jenis_kelamin') == 'laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                                          <option value="perempuan" {{ old('jenis_kelamin') == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                                    </select>
                                    @error('jenis_kelamin')
                                    <p class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                              </div>
                              <!-- Kecamatan -->
                              <div>
                                    <label class="block text-sm font-semibold text-slate-900 dark:text-white mb-2">
                                          Kecamatan <span class="text-red-500">*</span>
                                    </label>

                                    <select
                                          name="kecamatan_id"
                                          id="kecamatan_id"
                                          x-model="kecamatanId"
                                          @change="loadDesa()"
                                          class="w-full px-4 py-2.5 bg-slate-50 dark:bg-zinc-800 border 
        @error('kecamatan_id') border-red-500 
        @else border-slate-300 dark:border-zinc-700 
        @enderror rounded-lg text-slate-900 dark:text-white"
                                          required>
                                          <option value="">-- Pilih Kecamatan --</option>

                                          @foreach($kecamatans as $kecamatan)
                                          <option
                                                value="{{ $kecamatan->id }}"
                                                {{ old('kecamatan_id') == $kecamatan->id ? 'selected' : '' }}>
                                                {{ $kecamatan->nama }}
                                          </option>
                                          @endforeach
                                    </select>

                                    @error('kecamatan_id')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                              </div>
                              <!-- Desa -->
                              <!-- Desa -->
                              <div>
                                    <label class="block text-sm font-semibold text-slate-900 dark:text-white mb-2">
                                          Desa <span class="text-red-500">*</span>
                                    </label>

                                    <select
                                          name="desa_id"
                                          id="desa_id"
                                          x-model="desaId"
                                          :disabled="!kecamatanId"
                                          class="w-full px-4 py-2.5 bg-slate-50 dark:bg-zinc-800 border 
        @error('desa_id') border-red-500 
        @else border-slate-300 dark:border-zinc-700 
        @enderror rounded-lg text-slate-900 dark:text-white"
                                          required>

                                          <option value="">-- Pilih Desa --</option>

                                          <template x-for="desa in desas" :key="desa.id">
                                                <option
                                                      :value="desa.id"
                                                      x-text="desa.nama"
                                                      :selected="desa.id == desaId"></option>
                                          </template>

                                    </select>

                                    @error('desa_id')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                              </div>

                              <!-- No HP -->
                              <div>
                                    <label for="no_hp" class="block text-sm font-semibold text-slate-900 dark:text-white mb-2">
                                          Nomor HP <span class="text-red-500">*</span>
                                    </label>
                                    <input type="tel" id="no_hp" name="no_hp" value="{{ old('no_hp') }}"
                                          placeholder="081234567890"
                                          class="w-full px-4 py-2.5 bg-slate-50 dark:bg-zinc-800 border @error('no_hp') border-red-500 @else border-slate-300 dark:border-zinc-700 @enderror rounded-lg text-slate-900 dark:text-white placeholder-slate-500 dark:placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                          required>
                                    @error('no_hp')
                                    <p class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                              </div>

                              <!-- Kategori Asnaf -->
                              <div>
                                    <label for="kategori_asnaf" class="block text-sm font-semibold text-slate-900 dark:text-white mb-2">
                                          Kategori Asnaf <span class="text-red-500">*</span>
                                    </label>
                                    <select id="kategori_asnaf" name="kategori_asnaf"
                                          class="w-full px-4 py-2.5 bg-slate-50 dark:bg-zinc-800 border @error('kategori_asnaf') border-red-500 @else border-slate-300 dark:border-zinc-700 @enderror rounded-lg text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                          required>
                                          <option value="">-- Pilih Kategori Asnaf --</option>
                                          <option value="fakir" {{ old('kategori_asnaf') == 'fakir' ? 'selected' : '' }}>Fakir</option>
                                          <option value="miskin" {{ old('kategori_asnaf') == 'miskin' ? 'selected' : '' }}>Miskin</option>
                                          <option value="amil" {{ old('kategori_asnaf') == 'amil' ? 'selected' : '' }}>Amil</option>
                                          <option value="muallaf" {{ old('kategori_asnaf') == 'muallaf' ? 'selected' : '' }}>Muallaf</option>
                                          <option value="riqab" {{ old('kategori_asnaf') == 'riqab' ? 'selected' : '' }}>Riqab</option>
                                          <option value="gharim" {{ old('kategori_asnaf') == 'gharim' ? 'selected' : '' }}>Gharim</option>
                                          <option value="fisabilillah" {{ old('kategori_asnaf') == 'fisabilillah' ? 'selected' : '' }}>Fisabilillah</option>
                                          <option value="ibnu_sabil" {{ old('kategori_asnaf') == 'ibnu_sabil' ? 'selected' : '' }}>Ibnu Sabil</option>
                                    </select>
                                    @error('kategori_asnaf')
                                    <p class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                              </div>

                              <!-- Status -->
                              <div>
                                    <label for="status" class="block text-sm font-semibold text-slate-900 dark:text-white mb-2">
                                          Status <span class="text-red-500">*</span>
                                    </label>
                                    <select id="status" name="status"
                                          class="w-full px-4 py-2.5 bg-slate-50 dark:bg-zinc-800 border @error('status') border-red-500 @else border-slate-300 dark:border-zinc-700 @enderror rounded-lg text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                          required>
                                          <option value="">-- Pilih Status --</option>
                                          <option value="aktif" {{ old('status', 'aktif') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                          <option value="nonaktif" {{ old('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                                    </select>
                                    @error('status')
                                    <p class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                              </div>

                              <!-- Form Actions -->
                              <div class="flex items-center justify-between gap-4 pt-6 border-t border-slate-200 dark:border-zinc-700">
                                    <a href="{{ route('mustahiks.index') }}" class="inline-flex items-center justify-center gap-2 px-6 py-2.5 text-slate-700 dark:text-slate-300 bg-slate-100 dark:bg-zinc-800 hover:bg-slate-200 dark:hover:bg-zinc-700 font-medium rounded-lg transition-all duration-200">
                                          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                          </svg>
                                          Kembali
                                    </a>
                                    <button type="submit" class="inline-flex items-center justify-center gap-2 px-6 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-medium rounded-lg transition-all duration-200 shadow-lg">
                                          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                          </svg>
                                          Simpan
                                    </button>
                              </div>
                        </form>
                  </div>
            </div>
      </div>

      <script>
            function Mustahik() {
                  return {

                        kecamatanId: '{{ old("kecamatan_id") }}',
                        desaId: '{{ old("desa_id") }}',
                        desas: [],

                        async loadDesa() {

                              if (!this.kecamatanId) {
                                    this.desas = [];
                                    return;
                              }

                              try {

                                    const response = await fetch(
                                          `/mustahiks/desa/${this.kecamatanId}`
                                    );

                                    const data = await response.json();

                                    this.desas = data;

                              } catch (error) {

                                    console.error("Gagal mengambil desa", error);

                              }

                        },

                        init() {

                              if (this.kecamatanId) {
                                    this.loadDesa();
                              }

                        }

                  }
            }
      </script>
</x-layouts::app>