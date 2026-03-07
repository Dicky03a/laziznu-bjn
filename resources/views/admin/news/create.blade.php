<x-layouts::app :title="__('Tambah Berita')">
      <div class="min-h-screen py-8 px-4">
            <div class="max-w-4xl mx-auto space-y-6">

                  <!-- Header -->
                  <div>
                        <h1 class="text-3xl font-bold text-slate-900 ">
                              {{ __('Tambah Berita Baru') }}
                        </h1>
                        <p class="text-slate-600  mt-2">
                              {{ __('Isi formulir di bawah untuk membuat berita baru') }}
                        </p>
                  </div>

                  <!-- Form Card -->
                  <div class="bg-white  rounded-2xl shadow-xl border border-slate-200  p-6 md:p-8">
                        <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                              @csrf

                              <!-- Title -->
                              <div>
                                    <label for="title" class="block text-sm font-semibold text-slate-900  mb-2">
                                          {{ __('Judul') }} <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="title" name="title" value="{{ old('title') }}"
                                          placeholder="{{ __('Masukkan judul berita') }}"
                                          class="w-full px-4 py-2.5 bg-slate-50  border border-slate-300  rounded-lg text-slate-900  placeholder-slate-500  focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                          required>
                                    @error('title')
                                    <p class="text-red-600  text-sm mt-1">{{ $message }}</p>
                                    @enderror
                              </div>

                              <!-- Slug -->
                              <div>
                                    <label for="slug" class="block text-sm font-semibold text-slate-900  mb-2">
                                          {{ __('Slug') }} <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="slug" name="slug" value="{{ old('slug') }}"
                                          placeholder="{{ __('auto-generate-dari-judul') }}"
                                          class="w-full px-4 py-2.5 bg-slate-50  border border-slate-300  rounded-lg text-slate-900  placeholder-slate-500  focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                          required>
                                    @error('slug')
                                    <p class="text-red-600  text-sm mt-1">{{ $message }}</p>
                                    @enderror
                              </div>

                              <!-- Category -->
                              <div>
                                    <label for="category_id" class="block text-sm font-semibold text-slate-900  mb-2">
                                          {{ __('Kategori') }}
                                    </label>
                                    <select id="category_id" name="category_id"
                                          class="w-full px-4 py-2.5 bg-slate-50  border border-slate-300  rounded-lg text-slate-900  focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                                          <option value="">{{ __('Pilih Kategori') }}</option>
                                          @foreach ($categories as $category)
                                          <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                          </option>
                                          @endforeach
                                    </select>
                                    @error('category_id')
                                    <p class="text-red-600  text-sm mt-1">{{ $message }}</p>
                                    @enderror
                              </div>

                              <!-- Featured Image -->
                              <div>
                                    <label for="featured_image" class="block text-sm font-semibold text-slate-900  mb-2">
                                          {{ __('Gambar Unggulan') }}
                                    </label>
                                    <div class="relative border-2 border-dashed border-slate-300  rounded-lg p-6 transition-colors hover:border-blue-400  cursor-pointer group" id="uploadArea">
                                          <input type="file" id="featured_image" name="featured_image" accept="image/*"
                                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer"
                                                onchange="handleFileChange(this)">

                                          <!-- Placeholder Content -->
                                          <div id="placeholderContent" class="text-center">
                                                <svg class="mx-auto h-12 w-12 text-slate-400 " stroke="currentColor" fill="none" viewBox="0 0 48 48">
                                                      <path d="M28 8H12a4 4 0 00-4 4v20a4 4 0 004 4h24a4 4 0 004-4V20" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                      <circle cx="14" cy="20" r="4" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                      <path d="M40 24L26 10" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                                <p class="mt-2 text-sm font-medium text-slate-600 ">
                                                      {{ __('Klik atau seret gambar ke sini') }}
                                                </p>
                                                <p class="text-xs text-slate-500 ">{{ __('JPG, PNG, GIF (max 2MB)') }}</p>
                                          </div>

                                          <!-- Preview Image -->
                                          <div id="previewContent" class="hidden text-center relative">
                                                <img id="previewImage" src="" alt="Preview" class="mx-auto max-h-96 rounded-lg">
                                                <button type="button" onclick="clearFileInput()" class="mt-4 inline-flex items-center gap-2 px-4 py-2 bg-red-500 hover:bg-red-600 text-white text-sm font-medium rounded-lg transition-colors">
                                                      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                      </svg>
                                                      {{ __('Hapus Gambar') }}
                                                </button>
                                          </div>
                                    </div>
                                    @error('featured_image')
                                    <p class="text-red-600  text-sm mt-1">{{ $message }}</p>
                                    @enderror
                              </div>

                              <!-- Excerpt -->
                              <div>
                                    <label for="excerpt" class="block text-sm font-semibold text-slate-900  mb-2">
                                          {{ __('Ringkasan') }}
                                    </label>
                                    <textarea id="excerpt" name="excerpt" rows="3"
                                          placeholder="{{ __('Ringkasan singkat berita (opsional)') }}"
                                          class="w-full px-4 py-2.5 bg-slate-50  border border-slate-300  rounded-lg text-slate-900  placeholder-slate-500  focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all resize-none">{{ old('excerpt') }}</textarea>
                                    @error('excerpt')
                                    <p class="text-red-600  text-sm mt-1">{{ $message }}</p>
                                    @enderror
                              </div>

                              <!-- Content with Tiptap Editor -->
                              <div>
                                    <label for="content" class="block text-sm font-semibold text-slate-900  mb-2">
                                          {{ __('Konten') }} <span class="text-red-500">*</span>
                                    </label>
                                    <textarea id="content" name="content"
                                          class="hidden"
                                          required>{{ old('content') }}</textarea>
                                    <div data-tiptap-editor data-tiptap-input="content"
                                          class="w-full px-4 py-2.5 bg-slate-50  border border-slate-300  rounded-b-lg text-slate-900  placeholder-slate-500 ">
                                    </div>
                                    @error('content')
                                    <p class="text-red-600  text-sm mt-2">{{ $message }}</p>
                                    @enderror
                              </div>

                              <!-- Published At -->
                              <div>
                                    <label for="published_at" class="block text-sm font-semibold text-slate-900  mb-2">
                                          {{ __('Tanggal Publikasi') }}
                                    </label>
                                    <input type="datetime-local" id="published_at" name="published_at" value="{{ old('published_at') }}"
                                          class="w-full px-4 py-2.5 bg-slate-50  border border-slate-300  rounded-lg text-slate-900  focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                                    <p class="text-xs text-slate-500  mt-1">{{ __('Biarkan kosong untuk disimpan sebagai draft') }}</p>
                                    @error('published_at')
                                    <p class="text-red-600  text-sm mt-1">{{ $message }}</p>
                                    @enderror
                              </div>

                              <!-- Form Actions -->
                              <div class="flex items-center justify-between pt-6 border-t border-slate-200 ">
                                    <a href="{{ route('news.index') }}" class="inline-flex items-center gap-2 px-6 py-2.5 text-slate-700  hover:bg-slate-100  rounded-lg transition-colors font-medium">
                                          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                          </svg>
                                          {{ __('Kembali') }}
                                    </a>
                                    <div class="flex gap-3">
                                          <button type="submit" name="action" value="draft" class="inline-flex items-center gap-2 px-6 py-2.5 bg-slate-200  hover:bg-slate-300  text-slate-900  font-medium rounded-lg transition-all duration-200">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                </svg>
                                                {{ __('Simpan Draf') }}
                                          </button>
                                          <button type="submit" name="action" value="publish" class="inline-flex items-center justify-center gap-2 px-6 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-medium rounded-lg transition-all duration-200 shadow-lg">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                                </svg>
                                                {{ __('Publikasikan') }}
                                          </button>
                                    </div>
                              </div>
                        </form>
                  </div>
            </div>
      </div>

      <script>
            // Auto-generate slug from title
            document.getElementById('title').addEventListener('input', function() {
                  const title = this.value;
                  const slug = title
                        .toLowerCase()
                        .trim()
                        .replace(/[^\w\s-]/g, '')
                        .replace(/[\s_-]+/g, '-')
                        .replace(/^-+|-+$/g, '');
                  document.getElementById('slug').value = slug;
            });

            // File input styling dengan preview
            function handleFileChange(input) {
                  const file = input.files && input.files[0];

                  if (file) {
                        // Validasi ukuran file (max 2MB)
                        const maxSize = 2 * 1024 * 1024;
                        if (file.size > maxSize) {
                              alert('{{ __("Ukuran gambar terlalu besar. Maksimal 2MB") }}');
                              input.value = '';
                              showPlaceholder();
                              return;
                        }

                        // Validasi tipe file
                        if (!file.type.startsWith('image/')) {
                              alert('{{ __("File harus berupa gambar") }}');
                              input.value = '';
                              showPlaceholder();
                              return;
                        }

                        // Tampilkan preview
                        const reader = new FileReader();
                        reader.onload = function(e) {
                              document.getElementById('previewImage').src = e.target.result;
                              hidePlaceholder();
                        };
                        reader.readAsDataURL(file);
                  }
            }

            function showPlaceholder() {
                  document.getElementById('placeholderContent').classList.remove('hidden');
                  document.getElementById('previewContent').classList.add('hidden');
            }

            function hidePlaceholder() {
                  document.getElementById('placeholderContent').classList.add('hidden');
                  document.getElementById('previewContent').classList.remove('hidden');
            }

            function clearFileInput() {
                  document.getElementById('featured_image').value = '';
                  showPlaceholder();
            }
      </script>
</x-layouts::app>