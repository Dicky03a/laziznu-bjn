<x-layouts::app :title="__('Tambah Laporan Tahunan')">

    {{-- Header --}}
    <div class="flex items-center gap-3 mb-6">
        <a href="{{ route('laporan-bulanan.index') }}"
            class="p-2 text-gray-500 hover:bg-gray-100 rounded-lg transition-colors">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
            </svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Tambah Laporan Tahunan</h1>
            <p class="text-sm text-gray-500 mt-0.5">Unggah laporan tahunan baru dalam format PDF</p>
        </div>
    </div>

    @if($errors->any())
    <div class="mb-5 px-4 py-3 bg-red-50 border border-red-200 rounded-lg text-sm">
        <p class="font-semibold text-red-800 mb-1">Terjadi Kesalahan:</p>
        <ul class="space-y-0.5 text-red-700">
            @foreach($errors->all() as $error)
            <li class="flex items-center gap-1.5">
                <span class="w-1 h-1 rounded-full bg-red-400 flex-shrink-0"></span>
                {{ $error }}
            </li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- Form --}}
        <div class="lg:col-span-2">
            <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
                <div class="px-5 py-4 border-b border-gray-100 flex items-center gap-2">
                    <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    <h2 class="font-semibold text-gray-900 text-sm">Informasi Laporan</h2>
                </div>

                <form method="POST" action="{{ route('laporan-bulanan.store') }}"
                    enctype="multipart/form-data" class="p-5 md:p-6 space-y-5">
                    @csrf

                    {{-- Nama Laporan --}}
                    <div>
                        <label for="nama_laporan" class="block text-sm font-medium text-gray-700 mb-1.5">
                            Nama Laporan <span class="text-red-500">*</span>
                        </label>
                        <input type="text" id="nama_laporan" name="nama_laporan"
                            value="{{ old('nama_laporan') }}"
                            placeholder="Contoh: Laporan Tahunan 2024"
                            required
                            class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 @error('nama_laporan') border-red-400 @enderror">
                        <p class="mt-1 text-xs text-gray-400">Berikan nama deskriptif dan cantumkan tahun agar mudah dicari</p>
                        @error('nama_laporan')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Upload Area --}}
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">
                            File PDF <span class="text-red-500">*</span>
                        </label>

                        <div id="dropZone"
                            class="border-2 border-dashed border-gray-300 rounded-xl p-8 text-center cursor-pointer hover:border-emerald-400 hover:bg-emerald-50 transition-all"
                            onclick="document.getElementById('fileInput').click()"
                            ondragover="event.preventDefault(); this.classList.add('border-emerald-500','bg-emerald-100')"
                            ondragleave="this.classList.remove('border-emerald-500','bg-emerald-100')"
                            ondrop="event.preventDefault(); this.classList.remove('border-emerald-500','bg-emerald-100'); document.getElementById('fileInput').files = event.dataTransfer.files; handleFileSelect(event.dataTransfer.files[0])">

                            <div id="uploadPlaceholder">
                                <svg class="w-12 h-12 mx-auto text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                </svg>
                                <p class="font-medium text-gray-700 text-sm">Klik atau drag & drop file di sini</p>
                                <p class="text-xs text-gray-400 mt-1">Format PDF · Maks. 10MB</p>
                            </div>

                            <div id="uploadSuccess" class="hidden">
                                <svg class="w-10 h-10 mx-auto text-emerald-500 mb-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                <p id="selectedFileName" class="font-semibold text-emerald-800 text-sm"></p>
                                <p id="selectedFileSize" class="text-xs text-emerald-600 mt-0.5"></p>
                                <p class="text-xs text-gray-400 mt-2">Klik untuk ganti file</p>
                            </div>

                            <input type="file" id="fileInput" name="file_laporan"
                                accept=".pdf" required class="hidden"
                                onchange="handleFileSelect(this.files[0])">
                        </div>

                        @error('file_laporan')
                        <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- PDF Preview --}}
                    <div id="previewContainer" class="hidden">
                        <p class="text-sm font-medium text-gray-700 mb-1.5 flex items-center gap-2">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                            </svg>
                            Preview PDF
                        </p>
                        <div class="border border-gray-200 rounded-xl overflow-hidden">
                            <div class="px-4 py-2.5 bg-gray-50 border-b border-gray-100 flex items-center gap-2 text-xs text-gray-500">
                                <svg class="w-3.5 h-3.5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd" />
                                </svg>
                                <span id="previewFileName"></span>
                            </div>
                            <iframe id="pdfFrame" class="w-full h-96 border-none" src="about:blank"></iframe>
                        </div>
                    </div>

                    {{-- Actions --}}
                    <div class="flex flex-col sm:flex-row gap-3 pt-2 border-t border-gray-100">
                        <button type="submit"
                            class="flex-1 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-lg text-sm transition-colors shadow-sm flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                            Simpan Laporan
                        </button>
                        <a href="{{ route('laporan-bulanan.index') }}"
                            class="flex-1 py-2.5 border border-gray-300 text-gray-700 font-semibold rounded-lg text-sm hover:bg-gray-50 transition-colors flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                            </svg>
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>

        {{-- Sidebar --}}
        <div class="space-y-5">
            <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
                <div class="px-5 py-4 border-b border-gray-100">
                    <h3 class="font-semibold text-gray-900 text-sm flex items-center gap-2">
                        <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Panduan
                    </h3>
                </div>
                <div class="p-5 space-y-3.5 text-sm">
                    <div class="flex items-start gap-2.5 pb-3.5 border-b border-gray-100">
                        <div class="w-6 h-6 rounded bg-emerald-50 flex items-center justify-center flex-shrink-0 mt-0.5">
                            <svg class="w-3.5 h-3.5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-800 text-xs">Nama Laporan</p>
                            <p class="text-gray-500 text-xs mt-0.5">Gunakan nama deskriptif, cantumkan tahun agar mudah ditemukan</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-2.5 pb-3.5 border-b border-gray-100">
                        <div class="w-6 h-6 rounded bg-blue-50 flex items-center justify-center flex-shrink-0 mt-0.5">
                            <svg class="w-3.5 h-3.5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-800 text-xs">Format File</p>
                            <p class="text-gray-500 text-xs mt-0.5">Hanya PDF yang didukung, ukuran maksimal 10MB</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-2.5 pb-3.5 border-b border-gray-100">
                        <div class="w-6 h-6 rounded bg-purple-50 flex items-center justify-center flex-shrink-0 mt-0.5">
                            <svg class="w-3.5 h-3.5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-800 text-xs">Preview Otomatis</p>
                            <p class="text-gray-500 text-xs mt-0.5">Preview PDF muncul setelah file dipilih untuk verifikasi</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-2.5">
                        <div class="w-6 h-6 rounded bg-amber-50 flex items-center justify-center flex-shrink-0 mt-0.5">
                            <svg class="w-3.5 h-3.5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                        <div>
                            <p class="font-semibold text-gray-800 text-xs">File Final</p>
                            <p class="text-gray-500 text-xs mt-0.5">Pastikan file sudah versi final sebelum disimpan</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function handleFileSelect(file) {
            if (!file) return;
            if (file.size > 10 * 1024 * 1024) {
                alert('File terlalu besar. Maksimal 10MB');
                document.getElementById('fileInput').value = '';
                return;
            }
            if (file.type !== 'application/pdf') {
                alert('Hanya file PDF yang diterima');
                document.getElementById('fileInput').value = '';
                return;
            }
            const url = URL.createObjectURL(file);

            // Upload zone
            document.getElementById('uploadPlaceholder').classList.add('hidden');
            document.getElementById('uploadSuccess').classList.remove('hidden');
            document.getElementById('selectedFileName').textContent = file.name;
            document.getElementById('selectedFileSize').textContent = (file.size / 1024).toFixed(1) + ' KB';
            document.getElementById('dropZone').classList.add('border-emerald-400', 'bg-emerald-50');

            // Preview
            document.getElementById('previewContainer').classList.remove('hidden');
            document.getElementById('pdfFrame').src = url;
            document.getElementById('previewFileName').textContent = file.name;
        }
    </script>

</x-layouts::app>