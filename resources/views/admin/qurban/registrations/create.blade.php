<x-layouts::app :title="__('Tambah Pendaftaran Qurban')">

    <div class="mb-6 flex items-center gap-3">
        <a href="{{ route('qurban.registrations.index') }}"
            class="p-2 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-lg transition-all">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Tambah Pendaftaran Qurban</h1>
            <p class="text-sm text-gray-500 mt-0.5">Pendaftaran manual oleh admin akan langsung berstatus <span class="font-bold text-emerald-600">Terkonfirmasi</span></p>
        </div>
    </div>

    <form action="{{ route('qurban.registrations.store') }}"
        method="POST"
        enctype="multipart/form-data"
        class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        @csrf

        <div class="lg:col-span-2 space-y-5">
            @if($errors->any())
            <div class="p-4 bg-red-50 border border-red-200 rounded-xl text-red-600 text-sm">
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                </ul>
            </div>
            @endif

            <!-- $1 -->
            <div class="bg-white rounded-2xl border border-gray-200 p-6 space-y-4">
                <h3 class="font-semibold text-gray-900 border-b pb-3">Informasi Peserta</h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">
                            Nama Pendaftar <span class="text-red-500">*</span>
                        </label>
                        <input type="text" name="nama_peserta"
                            value="{{ old('nama_peserta') }}"
                            placeholder="Nama Lengkap"
                            required
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-emerald-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">
                            Atas Nama (Niat Qurban)
                        </label>
                        <input type="text" name="atas_nama"
                            value="{{ old('atas_nama') }}"
                            placeholder="Contoh: Fulan bin Fulan"
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-emerald-500">
                        <p class="text-xs text-gray-400 mt-1">Kosongkan jika sama dengan nama pendaftar</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Nomor WhatsApp</label>
                        <input type="text" name="telepon"
                            value="{{ old('telepon') }}"
                            placeholder="0812xxxx"
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-emerald-500">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Email (Opsional)</label>
                        <input type="email" name="email"
                            value="{{ old('email') }}"
                            placeholder="email@contoh.com"
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-emerald-500">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Alamat</label>
                    <textarea name="alamat" rows="2"
                        placeholder="Alamat Lengkap"
                        class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-emerald-500 resize-none">{{ old('alamat') }}</textarea>
                </div>
            </div>

            <!-- $1 -->
            <div class="bg-white rounded-2xl border border-gray-200 p-6 space-y-4">
                <h3 class="font-semibold text-gray-900 border-b pb-3">Detail Qurban</h3>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">
                        Pilih Hewan Qurban <span class="text-red-500">*</span>
                    </label>
                    <select name="hewan_id" id="hewan_id" required
                        class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-emerald-500"
                        onchange="updateHarga()">
                        <option value="">-- Pilih Hewan --</option>
                        @foreach($hewans as $h)
                        <option value="{{ $h->id }}" 
                            data-harga="{{ $h->harga_per_slot }}"
                            data-jenis="{{ $h->jenis_label }}"
                            {{ old('hewan_id') == $h->id ? 'selected' : '' }}>
                            {{ $h->nama }} ({{ $h->period?->nama }}) - Rp {{ number_format($h->harga_per_slot, 0, ',', '.') }}
                        </option>
                        @endforeach
                    </select>
                </div>

                <div id="price-summary" class="hidden p-4 bg-emerald-50 border border-emerald-200 rounded-xl">
                    <div class="flex justify-between items-center">
                        <span class="text-emerald-700 font-medium">Total Pembayaran:</span>
                        <span class="text-xl font-bold text-emerald-800" id="display-harga">Rp 0</span>
                    </div>
                    <p class="text-xs text-emerald-600 mt-1" id="display-jenis"></p>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Catatan Khusus</label>
                    <textarea name="catatan" rows="2"
                        placeholder="Contoh: Titip doa untuk orang tua"
                        class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-emerald-500 resize-none">{{ old('catatan') }}</textarea>
                </div>
            </div>
        </div>

        <div class="space-y-5">
            <!-- $1 -->
            <div class="bg-white rounded-2xl border border-gray-200 p-6">
                <h3 class="font-semibold text-gray-900 mb-4">Bukti Pembayaran</h3>
                
                <p class="text-xs text-gray-500 mb-4">Opsional. Digunakan sebagai arsip administrasi.</p>

                <label class="block cursor-pointer">
                    <div class="border-2 border-dashed border-gray-300 rounded-xl p-5 text-center hover:border-emerald-400 hover:bg-emerald-50/30 transition-all">
                        <p class="text-sm text-gray-500">Klik untuk upload bukti</p>
                        <p class="text-xs text-gray-400 mt-1">JPG, PNG, PDF. Maks 2MB</p>
                    </div>
                    <input type="file" name="bukti_transfer" accept="image/*,application/pdf" class="hidden"
                        onchange="previewFile(this)">
                </label>
                <div id="preview-container" class="hidden mt-3">
                    <p class="text-xs text-emerald-600 font-medium mb-1">File terpilih:</p>
                    <div class="flex items-center gap-2 p-2 bg-gray-50 rounded-lg border">
                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        <span id="file-name" class="text-xs text-gray-600 truncate"></span>
                    </div>
                </div>
            </div>

            <!-- $1 -->
            <div class="bg-blue-50 border border-blue-200 rounded-2xl p-5">
                <div class="flex gap-3">
                    <div class="p-2 bg-blue-100 rounded-lg shrink-0">
                        <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-blue-900">Konfirmasi Langsung</p>
                        <p class="text-xs text-blue-700 mt-1 leading-relaxed">
                            Dengan menyimpan pendaftaran ini, sistem akan menganggap pembayaran telah diterima dan slot hewan akan berkurang.
                        </p>
                    </div>
                </div>
            </div>

            <!-- $1 -->
            <div class="flex gap-3">
                <a href="{{ route('qurban.registrations.index') }}"
                    class="flex-1 py-3 border-2 border-gray-300 text-gray-700 text-sm font-semibold rounded-xl text-center hover:bg-gray-50 transition-all">
                    Batal
                </a>
                <button type="submit"
                    class="flex-1 py-3 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold rounded-xl transition-all shadow-sm">
                    Simpan & Verifikasi
                </button>
            </div>
        </div>
    </form>

    @push('scripts')
    <script>
        function updateHarga() {
            const select = document.getElementById('hewan_id');
            const selected = select.options[select.selectedIndex];
            const priceSummary = document.getElementById('price-summary');
            
            if (selected.value) {
                const harga = parseInt(selected.getAttribute('data-harga'));
                const jenis = selected.getAttribute('data-jenis');
                
                document.getElementById('display-harga').textContent = 'Rp ' + harga.toLocaleString('id-ID');
                document.getElementById('display-jenis').textContent = 'Jenis Hewan: ' + jenis;
                priceSummary.classList.remove('hidden');
            } else {
                priceSummary.classList.add('hidden');
            }
        }

        function previewFile(input) {
            const container = document.getElementById('preview-container');
            const fileName = document.getElementById('file-name');
            
            if (input.files && input.files[0]) {
                fileName.textContent = input.files[0].name;
                container.classList.remove('hidden');
            } else {
                container.classList.add('hidden');
            }
        }

        // Init if redirected back with old input
        if (document.getElementById('hewan_id').value) {
            updateHarga();
        }
    </script>
    @endpush

</x-layouts::app>