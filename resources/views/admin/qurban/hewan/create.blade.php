<x-layouts::app :title="isset($hewan) ? __('Edit Hewan Qurban') : __('Tambah Hewan Qurban')">

    <div class="mb-6 flex items-center gap-3">
        <a href="{{ route('qurban.binatang.index') }}"
            class="p-2 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-lg transition-all">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-gray-900">
                {{ isset($hewan) ? 'Edit Hewan Qurban' : 'Tambah Hewan Qurban' }}
            </h1>
            <p class="text-sm text-gray-500 mt-0.5">Max peserta akan diatur otomatis berdasarkan jenis hewan</p>
        </div>
    </div>

    <form action="{{ isset($hewan) ? route('qurban.binatang.update', $hewan) : route('qurban.binatang.store') }}"
        method="POST"
        enctype="multipart/form-data"
        class="grid grid-cols-1 lg:grid-cols-3 gap-6"
        id="form-hewan">
        @csrf
        @if(isset($hewan)) @method('PUT') @endif

        {{-- LEFT: Form Utama --}}
        <div class="lg:col-span-2 space-y-5">

            @if($errors->any())
            <div class="p-4 bg-red-50 border border-red-200 rounded-xl text-red-600 text-sm">
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                </ul>
            </div>
            @endif

            {{-- Periode --}}
            <div class="bg-white rounded-2xl border border-gray-200 p-6">
                <h3 class="font-semibold text-gray-900 mb-4">Periode Qurban</h3>
                <select name="period_id"
                    class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-emerald-500 @error('period_id') border-red-500 @enderror">
                    <option value="">-- Pilih Periode --</option>
                    @foreach($periods as $p)
                    <option value="{{ $p->id }}"
                        {{ old('period_id', isset($hewan) ? $hewan->period_id : ($selectedPeriod?->id ?? '')) == $p->id ? 'selected' : '' }}>
                        {{ $p->nama }} {{ $p->is_active ? 'Aktif' : '' }}
                    </option>
                    @endforeach
                </select>
                @error('period_id')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
            </div>

            {{-- Jenis Hewan --}}
            <div class="bg-white rounded-2xl border border-gray-200 p-6">
                <h3 class="font-semibold text-gray-900 mb-4">Jenis Hewan</h3>

                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3" id="jenis-selector">
                    @foreach([
                    'sapi' => ['emoji' => '🐄', 'label' => 'Sapi', 'info' => 'Max 7 orang'],
                    'unta' => ['emoji' => '🐪', 'label' => 'Unta', 'info' => 'Max 7 orang'],
                    'kambing' => ['emoji' => '🐐', 'label' => 'Kambing', 'info' => '1 orang saja'],
                    'domba' => ['emoji' => '🐑', 'label' => 'Domba', 'info' => '1 orang saja'],
                    ] as $val => $opt)
                    <label class="cursor-pointer">
                        <input type="radio" name="jenis" value="{{ $val }}"
                            {{ old('jenis', $hewan->jenis ?? '') === $val ? 'checked' : '' }}
                            class="sr-only peer"
                            onchange="updateJenisInfo('{{ $val }}')">
                        <div class="p-4 rounded-xl border-2 border-gray-200 peer-checked:border-emerald-500 peer-checked:bg-emerald-50 hover:border-gray-300 transition-all text-center">
                            <span class="text-3xl block mb-2">{{ $opt['emoji'] }}</span>
                            <p class="font-semibold text-gray-900 text-sm">{{ $opt['label'] }}</p>
                            <p class="text-xs text-gray-400 mt-0.5">{{ $opt['info'] }}</p>
                        </div>
                    </label>
                    @endforeach
                </div>

                {{-- Info dinamis --}}
                <div id="jenis-info" class="mt-4 p-4 bg-blue-50 border border-blue-200 rounded-xl hidden">
                    <p class="text-sm text-blue-800" id="jenis-info-text"></p>
                </div>

                @error('jenis')<p class="text-xs text-red-600 mt-2">{{ $message }}</p>@enderror
            </div>

            {{-- Info Hewan --}}
            <div class="bg-white rounded-2xl border border-gray-200 p-6 space-y-4">
                <h3 class="font-semibold text-gray-900">Informasi Hewan</h3>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">
                        Nama Hewan <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nama"
                        value="{{ old('nama', $hewan->nama ?? '') }}"
                        placeholder="Contoh: Sapi Jawa Premium A"
                        class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-emerald-500 @error('nama') border-red-500 @enderror">
                    @error('nama')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Berat Estimasi</label>
                        <input type="text" name="berat_estimasi"
                            value="{{ old('berat_estimasi', $hewan->berat_estimasi ?? '') }}"
                            placeholder="Contoh: 250–300 kg"
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-emerald-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">
                            Harga Total (1 Ekor) <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 font-semibold text-sm">Rp</span>
                            <input type="number" name="harga_total"
                                value="{{ old('harga_total', $hewan->harga_total ?? '') }}"
                                placeholder="0" min="100000"
                                oninput="hitungHargaSlot()"
                                id="input-harga-total"
                                class="w-full pl-12 pr-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-emerald-500 @error('harga_total') border-red-500 @enderror">
                        </div>
                        @error('harga_total')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
                    </div>
                </div>

                {{-- Preview harga per slot --}}
                <div id="preview-harga" class="p-4 bg-emerald-50 border border-emerald-200 rounded-xl hidden">
                    <div class="flex justify-between items-center text-sm">
                        <span class="text-emerald-700" id="preview-label">Harga per slot:</span>
                        <span class="font-bold text-emerald-800 text-base" id="preview-harga-value">Rp 0</span>
                    </div>
                    <p class="text-xs text-emerald-600 mt-1" id="preview-info"></p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Deskripsi</label>
                    <textarea name="deskripsi" rows="3"
                        placeholder="Keterangan tambahan tentang hewan..."
                        class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-emerald-500 resize-none">{{ old('deskripsi', $hewan->deskripsi ?? '') }}</textarea>
                </div>
            </div>

            {{-- Info slot jika edit --}}
            @if(isset($hewan, $summary))
            <div class="bg-amber-50 rounded-2xl border border-amber-200 p-5">
                <p class="text-sm font-semibold text-amber-800 mb-3">Status Slot Saat Ini</p>
                <div class="grid grid-cols-3 gap-4 text-center text-sm">
                    <div>
                        <p class="text-2xl font-bold text-emerald-600">{{ $summary['confirmed'] }}</p>
                        <p class="text-xs text-gray-500">Terkonfirmasi</p>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-yellow-600">{{ $summary['pending'] }}</p>
                        <p class="text-xs text-gray-500">Pending</p>
                    </div>
                    <div>
                        <p class="text-2xl font-bold text-gray-600">{{ $summary['slot_tersedia'] }}</p>
                        <p class="text-xs text-gray-500">Tersedia</p>
                    </div>
                </div>
                <p class="text-xs text-amber-600 mt-3">
                    ⚠ Mengubah jenis hewan akan mereset max_peserta. Pastikan sudah tidak ada pendaftar aktif jika ingin mengubah jenis.
                </p>
            </div>
            @endif

        </div>

        {{-- RIGHT: Gambar + Status --}}
        <div class="space-y-5">

            {{-- Gambar --}}
            <div class="bg-white rounded-2xl border border-gray-200 p-6">
                <h3 class="font-semibold text-gray-900 mb-4">Foto Hewan</h3>

                @if(isset($hewan) && $hewan->gambar)
                <div class="mb-4">
                    <img src="{{ $hewan->gambar_url }}"
                        alt="{{ $hewan->nama }}"
                        class="w-full h-40 object-cover rounded-xl">
                    <p class="text-xs text-gray-400 text-center mt-1">Foto saat ini</p>
                </div>
                @endif

                <label class="block cursor-pointer">
                    <div class="border-2 border-dashed border-gray-300 rounded-xl p-5 text-center hover:border-emerald-400 hover:bg-emerald-50/30 transition-all">
                        <span class="text-3xl block mb-2">📸</span>
                        <p class="text-sm text-gray-500">Klik untuk upload foto</p>
                        <p class="text-xs text-gray-400 mt-1">JPG, PNG, WEBP. Maks 2MB</p>
                    </div>
                    <input type="file" name="gambar" accept="image/*" class="hidden"
                        onchange="previewGambar(this)">
                </label>
                <img id="preview-gambar" src="" alt="" class="hidden w-full h-40 object-cover rounded-xl mt-3">
            </div>

            {{-- Status --}}
            <div class="bg-white rounded-2xl border border-gray-200 p-6">
                <h3 class="font-semibold text-gray-900 mb-4">Status</h3>
                <label class="flex items-start gap-3 cursor-pointer">
                    <div class="relative mt-0.5">
                        <input type="hidden" name="is_active" value="0">
                        <input type="checkbox" name="is_active" value="1" class="sr-only peer"
                            {{ old('is_active', $hewan->is_active ?? true) ? 'checked' : '' }}>
                        <div class="w-11 h-6 bg-gray-200 peer-focus:ring-2 peer-focus:ring-emerald-500 rounded-full peer peer-checked:bg-emerald-600 transition-all"></div>
                        <div class="absolute left-1 top-1 w-4 h-4 bg-white rounded-full shadow peer-checked:translate-x-5 transition-all"></div>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-700">Hewan Aktif</p>
                        <p class="text-xs text-gray-400 mt-0.5">Tampilkan di halaman publik</p>
                    </div>
                </label>
            </div>

            {{-- Actions --}}
            <div class="flex gap-3">
                <a href="{{ route('qurban.binatang.index') }}"
                    class="flex-1 py-3 border-2 border-gray-300 text-gray-700 text-sm font-semibold rounded-xl text-center hover:bg-gray-50 transition-all">
                    Batal
                </a>
                <button type="submit"
                    class="flex-1 py-3 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold rounded-xl transition-all shadow-sm">
                    {{ isset($hewan) ? 'Simpan' : 'Tambah Hewan' }}
                </button>
            </div>
        </div>
    </form>

    @push('scripts')
    <script>
        // Mapping jenis → max peserta
        const maxPesertaMap = {
            sapi: 7,
            unta: 7,
            kambing: 1,
            domba: 1
        };
        let currentJenis = '{{ old('
        jenis ', $hewan->jenis ?? '
        ') }}';

        function updateJenisInfo(jenis) {
            currentJenis = jenis;
            const info = document.getElementById('jenis-info');
            const text = document.getElementById('jenis-info-text');

            if (jenis === 'sapi' || jenis === 'unta') {
                text.textContent = `✅ ${jenis === 'sapi' ? 'Sapi' : 'Unta'}: Iuran patungan maksimal 7 orang. 1 slot = 1/7 bagian hewan.`;
            } else {
                text.textContent = `✅ ${jenis === 'kambing' ? 'Kambing' : 'Domba'}: Perorangan, 1 ekor untuk 1 orang. Tidak boleh iuran/patungan (ketentuan syar'i).`;
            }
            info.classList.remove('hidden');
            hitungHargaSlot();
        }

        function hitungHargaSlot() {
            const hargaTotal = parseInt(document.getElementById('input-harga-total').value) || 0;
            const maxPeserta = maxPesertaMap[currentJenis] || 1;
            const hargaPerSlot = Math.ceil(hargaTotal / maxPeserta);

            const previewBox = document.getElementById('preview-harga');
            if (hargaTotal > 0 && currentJenis) {
                document.getElementById('preview-harga-value').textContent = 'Rp ' + hargaPerSlot.toLocaleString('id-ID');
                document.getElementById('preview-label').textContent = maxPeserta > 1 ?
                    `Harga per slot (1/${maxPeserta} bagian):` :
                    'Harga (1 ekor penuh):';
                document.getElementById('preview-info').textContent = maxPeserta > 1 ?
                    `Total hewan Rp ${hargaTotal.toLocaleString('id-ID')} ÷ ${maxPeserta} peserta` :
                    `Dibayar penuh oleh 1 orang`;
                previewBox.classList.remove('hidden');
            } else {
                previewBox.classList.add('hidden');
            }
        }

        function previewGambar(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = e => {
                    const img = document.getElementById('preview-gambar');
                    img.src = e.target.result;
                    img.classList.remove('hidden');
                };
                reader.readAsDataURL(input.files[0]);
            }
        }

        // Init jika ada nilai awal
        if (currentJenis) updateJenisInfo(currentJenis);
    </script>
    @endpush

</x-layouts::app>