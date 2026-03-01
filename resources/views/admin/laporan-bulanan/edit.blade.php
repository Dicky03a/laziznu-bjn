<x-layouts::app :title="__('Edit Laporan Tahunan')">

      {{-- Header --}}
      <div class="flex items-center gap-3 mb-6">
            <a href="{{ route('laporan-bulanan.show', $laporanBulanan->id) }}"
                  class="p-2 text-gray-500 hover:bg-gray-100 rounded-lg transition-colors">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                  </svg>
            </a>
            <div>
                  <h1 class="text-2xl font-bold text-gray-900">Edit Laporan Tahunan</h1>
                  <p class="text-sm text-gray-500 mt-0.5">{{ $laporanBulanan->nama_laporan }}</p>
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
            <div class="lg:col-span-2 space-y-6">
                  <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
                        <div class="px-5 py-4 border-b border-gray-100 flex items-center gap-2">
                              <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                              </svg>
                              <h2 class="font-semibold text-gray-900 text-sm">Edit Informasi Laporan</h2>
                        </div>

                        <form method="POST" action="{{ route('laporan-bulanan.update', $laporanBulanan->id) }}"
                              enctype="multipart/form-data" class="p-5 md:p-6 space-y-5">
                              @csrf @method('PUT')

                              {{-- Nama Laporan --}}
                              <div>
                                    <label for="nama_laporan" class="block text-sm font-medium text-gray-700 mb-1.5">
                                          Nama Laporan <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="nama_laporan" name="nama_laporan"
                                          value="{{ old('nama_laporan', $laporanBulanan->nama_laporan) }}"
                                          placeholder="Contoh: Laporan Tahunan 2024"
                                          required
                                          class="w-full px-3 py-2.5 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 @error('nama_laporan') border-red-400 @enderror">
                                    @error('nama_laporan')
                                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                    @enderror
                              </div>

                              {{-- Info file saat ini --}}
                              @if($laporanBulanan->file_laporan)
                              <div class="flex items-start gap-3 p-3.5 bg-blue-50 border border-blue-200 rounded-xl text-sm">
                                    <svg class="w-4 h-4 text-blue-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <div>
                                          <p class="font-semibold text-blue-800">File saat ini sudah ada</p>
                                          <p class="text-blue-700 text-xs mt-0.5">{{ $laporanBulanan->file_laporan }}</p>
                                          <p class="text-blue-600 text-xs mt-1">Upload file baru di bawah hanya jika ingin mengganti (opsional)</p>
                                    </div>
                              </div>
                              @endif

                              {{-- Upload PDF Baru --}}
                              <div>
                                    <label class="block text-sm font-medium text-gray-700 mb-1.5">
                                          Ganti File PDF
                                          <span class="text-xs font-normal text-gray-400 ml-1">(opsional)</span>
                                    </label>

                                    <div id="dropZone"
                                          class="border-2 border-dashed border-gray-300 rounded-xl p-8 text-center cursor-pointer hover:border-emerald-400 hover:bg-emerald-50 transition-all"
                                          onclick="document.getElementById('fileInput').click()"
                                          ondragover="event.preventDefault(); this.classList.add('border-emerald-500','bg-emerald-100')"
                                          ondragleave="this.classList.remove('border-emerald-500','bg-emerald-100')"
                                          ondrop="event.preventDefault(); this.classList.remove('border-emerald-500','bg-emerald-100'); document.getElementById('fileInput').files = event.dataTransfer.files; handleFileSelect(event.dataTransfer.files[0])">

                                          <div id="uploadPlaceholder">
                                                <svg class="w-10 h-10 mx-auto text-gray-400 mb-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                                                </svg>
                                                <p class="font-medium text-gray-600 text-sm">Klik atau drag & drop untuk ganti file</p>
                                                <p class="text-xs text-gray-400 mt-1">Format PDF · Maks. 10MB</p>
                                          </div>

                                          <div id="uploadSuccess" class="hidden">
                                                <svg class="w-10 h-10 mx-auto text-emerald-500 mb-2" fill="currentColor" viewBox="0 0 20 20">
                                                      <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                </svg>
                                                <p id="selectedFileName" class="font-semibold text-emerald-800 text-sm"></p>
                                                <p id="selectedFileSize" class="text-xs text-emerald-600 mt-0.5"></p>
                                                <p class="text-xs text-gray-400 mt-2">Klik untuk ganti</p>
                                          </div>

                                          <input type="file" id="fileInput" name="file_laporan"
                                                accept=".pdf" class="hidden"
                                                onchange="handleFileSelect(this.files[0])">
                                    </div>
                                    @error('file_laporan')
                                    <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                                    @enderror
                              </div>

                              {{-- Preview File Baru --}}
                              <div id="previewContainerNew" class="hidden">
                                    <p class="text-sm font-medium text-gray-700 mb-1.5 flex items-center gap-2">
                                          <svg class="w-4 h-4 text-emerald-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                          </svg>
                                          Preview File Baru
                                    </p>
                                    <div class="border border-emerald-200 rounded-xl overflow-hidden">
                                          <div class="px-4 py-2.5 bg-emerald-50 border-b border-emerald-100 flex items-center gap-2 text-xs text-emerald-700">
                                                <svg class="w-3.5 h-3.5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                                      <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd" />
                                                </svg>
                                                <span id="previewFileNameNew"></span>
                                                <span class="ml-auto text-emerald-500 font-medium">File baru dipilih</span>
                                          </div>
                                          <iframe id="pdfFrameNew" class="w-full h-80 border-none" src="about:blank"></iframe>
                                    </div>
                              </div>

                              {{-- Preview File Lama --}}
                              @if($laporanBulanan->file_laporan)
                              <div>
                                    <p class="text-sm font-medium text-gray-700 mb-1.5 flex items-center gap-2">
                                          <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                          </svg>
                                          Preview File Saat Ini
                                    </p>
                                    <div class="border border-gray-200 rounded-xl overflow-hidden">
                                          <div class="px-4 py-2.5 bg-gray-50 border-b border-gray-100 flex items-center gap-2 text-xs text-gray-500">
                                                <svg class="w-3.5 h-3.5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                                      <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd" />
                                                </svg>
                                                {{ $laporanBulanan->file_laporan }}
                                                <span class="ml-auto text-gray-400">File original</span>
                                          </div>
                                          <iframe class="w-full h-80 border-none"
                                                src="{{ asset('storage/laporan-bulanan/' . $laporanBulanan->file_laporan) }}"
                                                loading="lazy"></iframe>
                                    </div>
                              </div>
                              @endif

                              {{-- Actions --}}
                              <div class="flex flex-col sm:flex-row gap-3 pt-2 border-t border-gray-100">
                                    <button type="submit"
                                          class="flex-1 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-lg text-sm transition-colors shadow-sm flex items-center justify-center gap-2">
                                          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                          </svg>
                                          Simpan Perubahan
                                    </button>
                                    <a href="{{ route('laporan-bulanan.show', $laporanBulanan->id) }}"
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

                  {{-- Info Laporan --}}
                  <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
                        <div class="px-5 py-4 border-b border-gray-100">
                              <h3 class="font-semibold text-gray-900 text-sm">Info Laporan</h3>
                        </div>
                        <div class="p-5 space-y-3 text-sm">
                              <div class="flex justify-between py-2 border-b border-gray-50">
                                    <span class="text-gray-500">ID</span>
                                    <span class="font-semibold text-gray-800">#{{ $laporanBulanan->id }}</span>
                              </div>
                              <div class="flex justify-between py-2 border-b border-gray-50">
                                    <span class="text-gray-500">Dibuat</span>
                                    <div class="text-right">
                                          <p class="font-semibold text-gray-800">{{ $laporanBulanan->created_at->format('d M Y') }}</p>
                                          <p class="text-xs text-gray-400">{{ $laporanBulanan->created_at->format('H:i') }}</p>
                                    </div>
                              </div>
                              <div class="flex justify-between py-2 border-b border-gray-50">
                                    <span class="text-gray-500">Diperbarui</span>
                                    <div class="text-right">
                                          <p class="font-semibold text-gray-800">{{ $laporanBulanan->updated_at->format('d M Y') }}</p>
                                          <p class="text-xs text-gray-400">{{ $laporanBulanan->updated_at->format('H:i') }}</p>
                                    </div>
                              </div>
                              <div class="flex justify-between py-2">
                                    <span class="text-gray-500">File</span>
                                    @if($laporanBulanan->file_laporan)
                                    <span class="inline-flex items-center gap-1 px-2 py-0.5 rounded-full bg-emerald-50 text-emerald-700 text-xs font-semibold border border-emerald-200">
                                          <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                          </svg>
                                          Ada
                                    </span>
                                    @else
                                    <span class="inline-flex items-center px-2 py-0.5 rounded-full bg-amber-50 text-amber-700 text-xs font-semibold border border-amber-200">Belum Ada</span>
                                    @endif
                              </div>
                        </div>
                  </div>

                  {{-- Danger Zone --}}
                  <div class="bg-white rounded-xl border border-red-200 overflow-hidden">
                        <div class="px-5 py-4 border-b border-red-100">
                              <h3 class="font-semibold text-red-700 text-sm flex items-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                    </svg>
                                    Zona Bahaya
                              </h3>
                        </div>
                        <div class="p-5">
                              <p class="text-xs text-gray-600 mb-3">Menghapus laporan tidak dapat dibatalkan.</p>
                              <form method="POST" action="{{ route('laporan-bulanan.destroy', $laporanBulanan->id) }}"
                                    onsubmit="return confirm('Yakin ingin menghapus laporan ini? Tindakan ini tidak dapat dibatalkan.')">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                          class="w-full py-2.5 bg-red-600 hover:bg-red-700 text-white font-semibold rounded-lg text-sm transition-colors flex items-center justify-center gap-2">
                                          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                          </svg>
                                          Hapus Laporan
                                    </button>
                              </form>
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

                  document.getElementById('uploadPlaceholder').classList.add('hidden');
                  document.getElementById('uploadSuccess').classList.remove('hidden');
                  document.getElementById('selectedFileName').textContent = file.name;
                  document.getElementById('selectedFileSize').textContent = (file.size / 1024).toFixed(1) + ' KB';
                  document.getElementById('dropZone').classList.add('border-emerald-400', 'bg-emerald-50');

                  document.getElementById('previewContainerNew').classList.remove('hidden');
                  document.getElementById('pdfFrameNew').src = url;
                  document.getElementById('previewFileNameNew').textContent = file.name;
            }
      </script>

</x-layouts::app>