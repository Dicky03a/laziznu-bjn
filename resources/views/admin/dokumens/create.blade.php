<x-layouts::app :title="__('Tambah Dokumen')">
      <div class="min-h-screen py-8 px-4">
            <div class="max-w-2xl mx-auto space-y-6">

                  <!-- Header -->
                  <div>
                        <h1 class="text-3xl font-bold text-slate-900 ">
                              {{ __('Tambah Dokumen Baru') }}
                        </h1>
                        <p class="text-slate-600  mt-2">
                              {{ __('Isi formulir di bawah untuk membuat dokumen baru') }}
                        </p>
                  </div>

                  <!-- Form Card -->
                  <div class="bg-white  rounded-2xl shadow-xl border border-slate-200  p-6 md:p-8">
                        <form action="{{ route('dokumens.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                              @csrf

                              <!-- Nama Dokumen -->
                              <div>
                                    <label for="nama_dokumen" class="block text-sm font-semibold text-slate-900  mb-2">
                                          {{ __('Nama Dokumen') }} <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="nama_dokumen" name="nama_dokumen" value="{{ old('nama_dokumen') }}"
                                          placeholder="{{ __('Contoh: Laporan Keuangan 2025') }}"
                                          class="w-full px-4 py-2.5 bg-slate-50  border border-slate-300  rounded-lg text-slate-900  placeholder-slate-500  focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                          required>
                                    @error('nama_dokumen')
                                    <p class="text-red-600  text-sm mt-1">{{ $message }}</p>
                                    @enderror
                              </div>

                              <!-- Deskripsi -->
                              <div>
                                    <label for="deskripsi" class="block text-sm font-semibold text-slate-900  mb-2">
                                          {{ __('Deskripsi') }}
                                    </label>
                                    <textarea id="deskripsi" name="deskripsi" rows="4"
                                          placeholder="{{ __('Deskripsi dokumen...') }}"
                                          class="w-full px-4 py-2.5 bg-slate-50  border border-slate-300  rounded-lg text-slate-900  placeholder-slate-500  focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all resize-none">{{ old('deskripsi') }}</textarea>
                                    @error('deskripsi')
                                    <p class="text-red-600  text-sm mt-1">{{ $message }}</p>
                                    @enderror
                              </div>

                              <!-- File Upload -->
                              <div>
                                    <label for="file" class="block text-sm font-semibold text-slate-900  mb-2">
                                          {{ __('File Dokumen') }} <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative border-2 border-dashed border-slate-300  rounded-lg p-6 transition-colors hover:border-blue-400  cursor-pointer group" id="uploadArea">
                                          <input type="file" id="file" name="file" accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.txt"
                                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                                                onchange="handleFileChange(this)"
                                                required>

                                          <!-- Placeholder Content -->
                                          <div id="placeholderContent" class="text-center">
                                                <svg class="mx-auto h-12 w-12 text-slate-400 " stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                                      <path d="M28 8H12a4 4 0 00-4 4v20a4 4 0 004 4h24a4 4 0 004-4V20" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                      <path d="M34 8l-4-4m0 0l-4 4m4-4v12" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                                <p class="mt-2 text-sm font-medium text-slate-600 ">
                                                      {{ __('Klik atau seret file ke sini') }}
                                                </p>
                                                <p class="text-xs text-slate-500 ">{{ __('PDF, DOC, DOCX, XLS, XLSX, PPT, PPTX atau TXT (max 10MB)') }}</p>
                                          </div>

                                          <!-- File Info -->
                                          <div id="fileContent" class="hidden text-center">
                                                <svg class="mx-auto h-12 w-12 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                                </svg>
                                                <p id="fileName" class="mt-2 text-sm font-medium text-slate-900 "></p>
                                                <button type="button" onclick="clearFileInput()" class="mt-4 inline-flex items-center gap-2 px-4 py-2 bg-red-500 hover:bg-red-600 text-white text-sm font-medium rounded-lg transition-colors">
                                                      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                      </svg>
                                                      {{ __('Hapus File') }}
                                                </button>
                                          </div>
                                    </div>
                                    @error('file')
                                    <p class="text-red-600  text-sm mt-1">{{ $message }}</p>
                                    @enderror
                              </div>

                              <!-- Form Actions -->
                              <div class="flex items-center justify-between gap-4 pt-6 border-t border-slate-200 ">
                                    <a href="{{ route('dokumens.index') }}" class="inline-flex items-center justify-center gap-2 px-6 py-2.5 text-slate-700  bg-slate-100  hover:bg-slate-200  font-medium rounded-lg transition-all duration-200">
                                          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                          </svg>
                                          {{ __('Kembali') }}
                                    </a>
                                    <button type="submit" class="inline-flex items-center justify-center gap-2 px-6 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-medium rounded-lg transition-all duration-200 shadow-lg">
                                          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                          </svg>
                                          {{ __('Simpan') }}
                                    </button>
                              </div>
                        </form>
                  </div>
            </div>
      </div>

      <script>
            function handleFileChange(input) {
                  const placeholderContent = document.getElementById('placeholderContent');
                  const fileContent = document.getElementById('fileContent');
                  const fileName = document.getElementById('fileName');

                  if (input.files && input.files[0]) {
                        const file = input.files[0];
                        fileName.textContent = file.name + ' (' + (file.size / 1024).toFixed(2) + ' KB)';
                        placeholderContent.classList.add('hidden');
                        fileContent.classList.remove('hidden');
                  }
            }

            function clearFileInput() {
                  const fileInput = document.getElementById('file');
                  fileInput.value = '';
                  const placeholderContent = document.getElementById('placeholderContent');
                  const fileContent = document.getElementById('fileContent');
                  placeholderContent.classList.remove('hidden');
                  fileContent.classList.add('hidden');
            }
      </script>
</x-layouts::app>