<x-layouts::app :title="__('Tambah Transaksi')">

    <div class="mb-6 flex items-center gap-3">
        <a href="{{ route('transactions.index') }}"
            class="p-2 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-lg transition-all">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Tambah Transaksi Baru</h1>
            <p class="text-sm text-gray-500 mt-0.5">Input transaksi (Zakat, Infaq, Donasi, Fidyah)</p>
        </div>
    </div>

    <form action="{{ route('transactions.store') }}" method="POST" enctype="multipart/form-data"
        x-data="transactionForm({
            programs: @js($programs),
            oldKecamatan: @js(old('kecamatan_id')),
            oldDesa: @js(old('desa_id')),
            oldProgramId: @js(old('program_id')),
            oldZakatJenis: @js(old('zakat_jenis')),
            oldType: @js(old('type', 'zakat'))
        })">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <div class="lg:col-span-2 space-y-6">
                <!-- Errors -->
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

                <!-- Section 1: Jenis Transaksi -->
                <div class="bg-white rounded-2xl border border-gray-200 p-6">
                    <div class="flex items-center gap-2 mb-4">
                        <span class="inline-flex items-center justify-center w-6 h-6 bg-emerald-100 text-emerald-700 rounded-full text-xs font-bold">1</span>
                        <h3 class="font-semibold text-gray-900">Pilih Jenis Transaksi <span class="text-red-500">*</span></h3>
                    </div>

                    <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                        @foreach(['zakat', 'infaq', 'donasi', 'fidyah'] as $t)
                        <button type="button" @click="type = '{{ $t }}'"
                            :class="type === '{{ $t }}' ? 'border-emerald-500 bg-emerald-50 ring-2 ring-emerald-500' : 'border-gray-200 hover:border-emerald-300'"
                            class="relative p-4 text-center rounded-2xl border-2 transition-all duration-200">

                            <span x-show="type === '{{ $t }}'" class="absolute top-2 right-2 w-4 h-4 bg-emerald-500 rounded-full flex items-center justify-center">
                                <svg class="w-2.5 h-2.5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                                </svg>
                            </span>

                            <p class="font-bold text-gray-900 capitalize">
                                {{
                $t === 'infaq' ? 'DSKL' :
                ($t === 'donasi' ? 'Infaq dan Sodakoh' : $t)
            }}
                            </p>

                        </button>
                        @endforeach
                    </div>
                    <input type="hidden" name="type" :value="type">
                    @error('type') <p class="text-xs text-red-600 mt-2">{{ $message }}</p> @enderror
                </div>

                <!-- Section 2: Informasi Program & Nominal -->
                <div class="bg-white rounded-2xl border border-gray-200 p-6 space-y-6">
                    <div class="flex items-center gap-2">
                        <span class="inline-flex items-center justify-center w-6 h-6 bg-emerald-100 text-emerald-700 rounded-full text-xs font-bold">2</span>
                        <h3 class="font-semibold text-gray-900">Program & Nominal</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Program (Only for Infaq & Donasi) -->
                        <div x-show="type === 'infaq' || type === 'donasi'">
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Program <span class="text-gray-400 font-normal">(opsional)</span></label>
                            <select name="program_id" x-model="programId" class="w-full px-4 py-3 rounded-xl border border-gray-300 text-sm focus:ring-2 focus:ring-emerald-500 outline-none">
                                <option value="">Pilih Program</option>
                                <template x-for="p in filteredPrograms" :key="p.id">
                                    <option :value="p.id" x-text="p.nama" :selected="p.id == programId"></option>
                                </template>
                            </select>
                        </div>

                        <!-- Nominal -->
                        <div :class="(type === 'infaq' || type === 'donasi') ? '' : 'md:col-span-2'">
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Jumlah (Rp) <span class="text-red-500">*</span></label>
                            <div class="relative">
                                <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 font-semibold text-sm">Rp</span>
                                <input type="number" name="jumlah" value="{{ old('jumlah') }}" required min="1000"
                                    class="w-full pl-12 pr-4 py-3 rounded-xl border border-gray-300 text-sm focus:ring-2 focus:ring-emerald-500 outline-none">
                            </div>
                        </div>
                    </div>

                    <!-- Zakat Metadata -->
                    <div x-show="type === 'zakat'" class="p-4 bg-emerald-50 rounded-xl border border-emerald-100 space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-emerald-800 mb-2">Pilih Jenis Zakat</label>
                            <div class="grid grid-cols-1 sm:grid-cols-3 gap-3">
                                <button type="button" @click="zakatMode = 'fitrah'; zakatJenis = 'fitrah'; programId = ''"
                                    :class="zakatMode === 'fitrah' ? 'bg-emerald-600 text-white shadow-md' : 'bg-white text-emerald-700 border border-emerald-200 hover:bg-emerald-50'"
                                    class="px-4 py-2 rounded-lg text-sm font-semibold transition-all">
                                    Zakat Fitrah
                                </button>
                                <button type="button" @click="zakatMode = 'mal'; zakatJenis = 'mal'; programId = ''"
                                    :class="zakatMode === 'mal' ? 'bg-emerald-600 text-white shadow-md' : 'bg-white text-emerald-700 border border-emerald-200 hover:bg-emerald-50'"
                                    class="px-4 py-2 rounded-lg text-sm font-semibold transition-all">
                                    Zakat Mal
                                </button>
                                <button type="button" @click="zakatMode = 'program'; zakatJenis = ''"
                                    :class="zakatMode === 'program' ? 'bg-emerald-600 text-white shadow-md' : 'bg-white text-emerald-700 border border-emerald-200 hover:bg-emerald-50'"
                                    class="px-4 py-2 rounded-lg text-sm font-semibold transition-all">
                                    Zakat Program
                                </button>
                            </div>
                            <input type="hidden" name="zakat_jenis" :value="zakatJenis">
                        </div>

                        <!-- Zakat Program Dropdown -->
                        <div x-show="zakatMode === 'program'" class="pt-2 animate-in fade-in slide-in-from-top-2">
                            <label class="block text-sm font-medium text-emerald-800 mb-1.5">Pilih Program Zakat <span class="text-red-500">*</span></label>
                            <select name="program_id" x-model="programId" :required="type === 'zakat' && zakatMode === 'program'"
                                class="w-full px-4 py-2 rounded-lg border border-emerald-200 text-sm focus:ring-2 focus:ring-emerald-500 outline-none">
                                <option value="">-- Pilih Program Zakat --</option>
                                <template x-for="p in filteredPrograms" :key="p.id">
                                    <option :value="p.id" x-text="p.nama" :selected="p.id == programId"></option>
                                </template>
                            </select>
                        </div>

                        <div x-show="zakatMode === 'fitrah'" class="animate-in fade-in slide-in-from-top-2">
                            <label class="block text-sm font-medium text-emerald-800 mb-1.5">Jumlah Jiwa</label>
                            <input type="number" name="jumlah_jiwa" value="{{ old('jumlah_jiwa', 1) }}" min="1"
                                class="w-full max-w-[150px] px-4 py-2 rounded-lg border border-emerald-200 text-sm focus:ring-2 focus:ring-emerald-500 outline-none">
                        </div>

                        <div x-show="zakatMode === 'mal'" class="animate-in fade-in slide-in-from-top-2">
                            <label class="block text-sm font-medium text-emerald-800 mb-1.5">Nilai Harta (Rp)</label>
                            <input type="number" name="nilai_harta" value="{{ old('nilai_harta') }}" min="0"
                                class="w-full px-4 py-2 rounded-lg border border-emerald-200 text-sm focus:ring-2 focus:ring-emerald-500 outline-none">
                        </div>
                    </div>

                    <!-- Fidyah Metadata -->
                    <div x-show="type === 'fidyah'" class="p-4 bg-amber-50 rounded-xl border border-amber-100 space-y-4">
                        <div>
                            <label class="block text-sm font-medium text-amber-800 mb-1.5">Jumlah Hari</label>
                            <input type="number" name="jumlah_hari" value="{{ old('jumlah_hari', 1) }}" min="1"
                                class="w-full max-w-[150px] px-4 py-2 rounded-lg border border-amber-200 text-sm focus:ring-2 focus:ring-amber-500 outline-none">
                        </div>
                    </div>
                </div>

                <!-- Section 3: Data Donatur & Lokasi -->
                <div class="bg-white rounded-2xl border border-gray-200 p-6 space-y-6">
                    <div class="flex items-center gap-2">
                        <span class="inline-flex items-center justify-center w-6 h-6 bg-emerald-100 text-emerald-700 rounded-full text-xs font-bold">3</span>
                        <h3 class="font-semibold text-gray-900">Data Donatur & Lokasi</h3>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama Donatur <span class="text-red-500">*</span></label>
                            <input type="text" name="nama_donatur" value="{{ old('nama_donatur') }}" required
                                class="w-full px-4 py-3 rounded-xl border border-gray-300 text-sm focus:ring-2 focus:ring-emerald-500 outline-none">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Telepon (WA) <span class="text-gray-400 font-normal">(opsional)</span></label>
                            <input type="text" name="telepon" value="{{ old('telepon') }}" placeholder="08..."
                                class="w-full px-4 py-3 rounded-xl border border-gray-300 text-sm focus:ring-2 focus:ring-emerald-500 outline-none">
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Email <span class="text-gray-400 font-normal">(opsional)</span></label>
                            <input type="email" name="email" value="{{ old('email') }}"
                                class="w-full px-4 py-3 rounded-xl border border-gray-300 text-sm focus:ring-2 focus:ring-emerald-500 outline-none">
                        </div>
                        <div class="flex items-center h-full pt-6">
                            <label class="flex items-center gap-3 cursor-pointer group">
                                <input type="hidden" name="is_anonim" value="0">
                                <input type="checkbox" name="is_anonim" value="1" {{ old('is_anonim') ? 'checked' : '' }} class="w-5 h-5 rounded border-gray-300 text-emerald-600 focus:ring-emerald-500">
                                <span class="text-sm font-medium text-gray-700">Sembunyikan nama (Hamba Allah)</span>
                            </label>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Kecamatan <span class="text-gray-400 font-normal">(opsional)</span></label>
                            <select name="kecamatan_id" x-model="kecamatanId" @change="fetchDesa"
                                class="w-full px-4 py-3 rounded-xl border border-gray-300 text-sm focus:ring-2 focus:ring-emerald-500 outline-none">
                                <option value="">Pilih Kecamatan</option>
                                @foreach($kecamatans as $k)
                                <option value="{{ $k->id }}">{{ $k->nama }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700 mb-1.5">Desa <span class="text-gray-400 font-normal">(opsional)</span></label>
                            <select name="desa_id" x-model="desaId" :disabled="!kecamatanId || loadingDesa"
                                class="w-full px-4 py-3 rounded-xl border border-gray-300 text-sm focus:ring-2 focus:ring-emerald-500 outline-none disabled:bg-gray-50">
                                <option value="">Pilih Desa</option>
                                <template x-for="d in desas" :key="d.id">
                                    <option :value="d.id" x-text="d.nama" :selected="d.id == desaId"></option>
                                </template>
                            </select>
                        </div>
                    </div>
                </div>
            </div>

            <div class="space-y-6">
                <!-- Bukti Transfer -->
                <div class="bg-white rounded-2xl border border-gray-200 p-6">
                    <h3 class="font-semibold text-gray-900 text-sm mb-4">Bukti Transfer <span class="text-gray-400 font-normal">(opsional)</span></h3>

                    <label class="block w-full cursor-pointer">
                        <div class="border-2 border-dashed border-gray-300 rounded-xl p-6 text-center hover:border-emerald-400 hover:bg-emerald-50 transition-all">
                            <svg class="w-8 h-8 text-gray-300 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            <p class="text-xs font-medium text-gray-500">Upload bukti pembayaran jika ada</p>
                        </div>
                        <input type="file" name="bukti_transfer" class="hidden" @change="previewFile">
                    </label>
                    <div x-show="filePreview" class="mt-4">
                        <img :src="filePreview" class="w-full h-40 object-cover rounded-xl border border-gray-200">
                    </div>
                </div>

                <!-- Catatan -->
                <div class="bg-white rounded-2xl border border-gray-200 p-6">
                    <h3 class="font-semibold text-gray-900 text-sm mb-4">Catatan <span class="text-gray-400 font-normal">(opsional)</span></h3>
                    <textarea name="catatan" rows="4" placeholder="Keterangan tambahan..."
                        class="w-full px-4 py-3 rounded-xl border border-gray-300 text-sm focus:ring-2 focus:ring-emerald-500 outline-none resize-none">{{ old('catatan') }}</textarea>
                </div>

                <!-- Actions -->
                <div class="flex gap-3">
                    <a href="{{ route('transactions.index') }}" class="flex-1 py-3 border-2 border-gray-300 text-gray-700 text-sm font-semibold rounded-xl text-center hover:bg-gray-50 transition-all">Batal</a>
                    <button type="submit" class="flex-1 py-3 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold rounded-xl transition-all shadow-sm">Simpan</button>
                </div>
            </div>
        </div>
    </form>

    @push('scripts')
    <script>
        function transactionForm(data) {
            return {
                type: data.oldType || 'zakat',
                zakatJenis: data.oldZakatJenis || (data.oldType === 'zakat' && !data.oldProgramId ? 'fitrah' : ''),
                zakatMode: '', // Will be initialized in init
                programId: data.oldProgramId || '',
                kecamatanId: data.oldKecamatan || '',
                desaId: data.oldDesa || '',
                programs: data.programs,
                desas: [],
                loadingDesa: false,
                filePreview: null,

                init() {
                    // Initialize zakatMode based on old values
                    if (this.type === 'zakat') {
                        if (this.programId) {
                            this.zakatMode = 'program';
                        } else if (this.zakatJenis === 'mal') {
                            this.zakatMode = 'mal';
                        } else {
                            this.zakatMode = 'fitrah';
                            this.zakatJenis = 'fitrah';
                        }
                    } else {
                        this.zakatMode = 'fitrah'; // default
                    }

                    if (this.kecamatanId) {
                        this.fetchDesa();
                    }

                    // Watch type changes
                    this.$watch('type', (value) => {
                        if (value !== 'zakat') {
                            this.zakatJenis = '';
                        } else {
                            // Reset to fitrah when switching back to zakat if nothing selected
                            if (!this.zakatMode) {
                                this.zakatMode = 'fitrah';
                                this.zakatJenis = 'fitrah';
                            }
                        }
                    });
                },

                get filteredPrograms() {
                    if (this.type === 'fidyah') return [];
                    return this.programs.filter(p => p.type === this.type);
                },

                fetchDesa() {
                    if (!this.kecamatanId) {
                        this.desas = [];
                        this.desaId = '';
                        return;
                    }

                    this.loadingDesa = true;
                    fetch(`/mustahiks/getDesa/${this.kecamatanId}`)
                        .then(res => res.json())
                        .then(data => {
                            this.desas = data;
                            this.loadingDesa = false;
                        });
                },

                previewFile(e) {
                    const file = e.target.files[0];
                    if (file) {
                        this.filePreview = URL.createObjectURL(file);
                    }
                }
            }
        }
    </script>
    @endpush
</x-layouts::app>