<x-layouts::app :title="__('Edit Berita')">
      <div class="min-h-screen py-8 px-4">
            <div class="max-w-4xl mx-auto space-y-6">

                  <!-- Header -->
                  <div class="flex items-center justify-between">
                        <div>
                              <h1 class="text-3xl font-bold text-slate-900 ">
                                    {{ __('Edit Berita') }}
                              </h1>
                              <p class="text-slate-600  mt-2">
                                    {{ $news->title }}
                              </p>
                        </div>

                        <!-- Status Badge -->
                        <div>
                              @if ($news->published_at)
                              <span class="inline-flex items-center gap-2 px-4 py-2 bg-green-100  text-green-800  rounded-lg font-medium">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                    </svg>
                                    {{ __('Dipublikasikan') }}
                              </span>
                              @else
                              <span class="inline-flex items-center gap-2 px-4 py-2 bg-yellow-100  text-yellow-800  rounded-lg font-medium">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                          <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                                    </svg>
                                    {{ __('Draft') }}
                              </span>
                              @endif
                        </div>
                  </div>

                  <!-- Form Card -->
                  <div class="bg-white  rounded-2xl shadow-xl border border-slate-200  overflow-hidden">

                        <form action="{{ route('news.update', $news) }}" method="POST" enctype="multipart/form-data" id="newsForm">
                              @csrf
                              @method('PUT')

                              <div class="p-6 md:p-8 space-y-6">
                                    <!-- Title -->
                                    <div>
                                          <label for="title" class="block text-sm font-semibold text-slate-900  mb-2">
                                                {{ __('Judul') }} <span class="text-red-500">*</span>
                                          </label>
                                          <input type="text" id="title" name="title" value="{{ old('title', $news->title) }}"
                                                placeholder="{{ __('Masukkan judul berita') }}"
                                                class="w-full px-4 py-3 bg-slate-50  border border-slate-300  rounded-lg text-slate-900  placeholder-slate-500  focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                                required>
                                          @error('title')
                                          <p class="text-red-600  text-sm mt-1.5">{{ $message }}</p>
                                          @enderror
                                    </div>

                                    <!-- Slug -->
                                    <div>
                                          <label for="slug" class="block text-sm font-semibold text-slate-900  mb-2">
                                                {{ __('Slug') }} <span class="text-red-500">*</span>
                                          </label>
                                          <div class="relative">
                                                <input type="text" id="slug" name="slug" value="{{ old('slug', $news->slug) }}"
                                                      placeholder="{{ __('slug-berita') }}"
                                                      class="w-full px-4 py-3 bg-slate-50  border border-slate-300  rounded-lg text-slate-900  placeholder-slate-500  focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                                      required>
                                                <button type="button" onclick="generateSlug()" class="absolute right-2 top-1/2 -translate-y-1/2 px-3 py-1.5 text-xs font-medium text-blue-600  hover:bg-blue-50  rounded transition-colors">
                                                      {{ __('Generate') }}
                                                </button>
                                          </div>
                                          @error('slug')
                                          <p class="text-red-600  text-sm mt-1.5">{{ $message }}</p>
                                          @enderror
                                    </div>

                                    <!-- Category -->
                                    <div>
                                          <label for="category_id" class="block text-sm font-semibold text-slate-900  mb-2">
                                                {{ __('Kategori') }}
                                          </label>
                                          <select id="category_id" name="category_id"
                                                class="w-full px-4 py-3 bg-slate-50  border border-slate-300  rounded-lg text-slate-900  focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                                                <option value="">{{ __('Pilih Kategori') }}</option>
                                                @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" {{ old('category_id', $news->category_id) == $category->id ? 'selected' : '' }}>
                                                      {{ $category->name }}
                                                </option>
                                                @endforeach
                                          </select>
                                          @error('category_id')
                                          <p class="text-red-600  text-sm mt-1.5">{{ $message }}</p>
                                          @enderror
                                    </div>

                                    <!-- Featured Image -->
                                    <div>
                                          <label class="block text-sm font-semibold text-slate-900 mb-2">
                                                {{ __('Gambar Unggulan') }}
                                          </label>

                                          <div class="grid md:grid-cols-2 gap-6">

                                                <!-- Current Image -->
                                                @if ($news->featured_image)
                                                <div id="currentImageContainer"
                                                      class="bg-slate-50 rounded-xl p-4 border border-slate-200 transition-all duration-300">

                                                      <p class="text-sm font-medium text-slate-700 mb-3">
                                                            {{ __('Gambar Saat Ini') }}
                                                      </p>

                                                      <img id="currentImagePreview"
                                                            src="{{ asset('storage/' . $news->featured_image) }}"
                                                            class="rounded-lg shadow-md w-full h-48 object-cover">

                                                      <label class="flex items-center gap-2 mt-3 cursor-pointer hover:opacity-80 transition-opacity">
                                                            <input type="checkbox"
                                                                  id="remove_image"
                                                                  name="remove_image"
                                                                  value="1"
                                                                  class="w-4 h-4 text-red-600 border-slate-300 rounded cursor-pointer">

                                                            <span class="text-sm text-red-600 font-medium">
                                                                  {{ __('Hapus gambar') }}
                                                            </span>
                                                      </label>
                                                </div>
                                                @endif

                                                <!-- Upload Area -->
                                                <div id="dropZone"
                                                      class="relative border-2 border-dashed border-slate-300 rounded-xl p-6 text-center hover:border-blue-400 hover:bg-blue-50 transition-all duration-200 cursor-pointer">

                                                      <input type="file"
                                                            id="featured_image"
                                                            name="featured_image"
                                                            accept="image/*"
                                                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">

                                                      <div id="uploadPrompt" class="pointer-events-none">

                                                            <svg class="mx-auto h-12 w-12 text-slate-400"
                                                                  stroke="currentColor"
                                                                  fill="none"
                                                                  viewBox="0 0 48 48">

                                                                  <path d="M28 8H12a4 4 0 00-4 4v20a4 4 0 004 4h24a4 4 0 004-4V20"
                                                                        stroke-width="2"
                                                                        stroke-linecap="round"
                                                                        stroke-linejoin="round" />

                                                                  <path d="M40 24L26 10"
                                                                        stroke-width="2"
                                                                        stroke-linecap="round"
                                                                        stroke-linejoin="round" />

                                                            </svg>

                                                            <p class="mt-2 text-sm text-slate-600">
                                                                  {{ __('Klik atau drag gambar ke sini') }}
                                                            </p>

                                                            <p class="text-xs text-slate-400">
                                                                  JPG, PNG (Max 2MB)
                                                            </p>

                                                      </div>

                                                      <!-- Preview Image -->
                                                      <div id="newImagePreview" class="hidden">

                                                            <p class="text-sm font-medium text-slate-700 mb-3 pointer-events-none">
                                                                  {{ __('Preview Gambar Baru') }}
                                                            </p>

                                                            <img id="previewImage"
                                                                  class="rounded-lg shadow-md w-full h-48 object-cover">

                                                            <div class="flex gap-2 mt-3 justify-center">
                                                                  <button type="button"
                                                                        onclick="clearNewImage()"
                                                                        class="inline-flex items-center gap-2 px-3 py-1.5 text-xs font-medium text-red-600 hover:bg-red-50 rounded transition-colors">
                                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                                                        </svg>
                                                                        {{ __('Batal') }}
                                                                  </button>
                                                                  <span class="text-xs text-slate-500 py-1.5">{{ __('Siap untuk diunggah') }}</span>
                                                            </div>

                                                      </div>

                                                </div>

                                          </div>

                                    </div>

                                    <!-- Excerpt -->
                                    <div>
                                          <label for="excerpt" class="block text-sm font-semibold text-slate-900  mb-2">
                                                {{ __('Ringkasan') }}
                                          </label>
                                          <textarea id="excerpt" name="excerpt" rows="3"
                                                placeholder="{{ __('Ringkasan singkat berita (opsional)') }}"
                                                class="w-full px-4 py-3 bg-slate-50  border border-slate-300  rounded-lg text-slate-900  placeholder-slate-500  focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all resize-none">{{ old('excerpt', $news->excerpt) }}</textarea>
                                          @error('excerpt')
                                          <p class="text-red-600  text-sm mt-1.5">{{ $message }}</p>
                                          @enderror
                                    </div>

                                    <!-- Content with Tiptap Editor -->
                                    <div>
                                          <label for="content" class="block text-sm font-semibold text-slate-900  mb-2">
                                                {{ __('Konten') }} <span class="text-red-500">*</span>
                                          </label>
                                          <textarea id="content" name="content"
                                                class="hidden"
                                                required>{{ old('content', $news->content) }}</textarea>
                                          <div data-tiptap-editor data-tiptap-input="content"
                                                class="w-full min-h-96 px-4 py-3 bg-slate-50  border border-slate-300  rounded-b-lg text-slate-900  placeholder-slate-500">
                                          </div>
                                          @error('content')
                                          <p class="text-red-600  text-sm mt-2">{{ $message }}</p>
                                          @enderror
                                    </div>

                                    <!-- Published Status Info -->
                                    <div class="bg-slate-50  rounded-xl p-4 border border-slate-200 ">
                                          <div class="flex items-start gap-3">
                                                <svg class="w-5 h-5 mt-0.5 flex-shrink-0 {{ $news->published_at ? 'text-green-600'  : 'text-yellow-600'  }}" fill="currentColor" viewBox="0 0 20 20">
                                                      <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd"></path>
                                                </svg>
                                                <div>
                                                      <p class="text-sm font-semibold text-slate-900  mb-1">
                                                            {{ __('Status Publikasi') }}
                                                      </p>
                                                      @if ($news->published_at)
                                                      <p class="text-sm text-slate-600 ">
                                                            {{ __('Berita ini dipublikasikan pada ') }}
                                                            <span class="font-medium text-slate-900 ">{{ $news->published_at->format('d F Y, H:i') }}</span>
                                                      </p>
                                                      @else
                                                      <p class="text-sm text-slate-600 ">
                                                            {{ __('Berita ini masih dalam status draft dan belum dipublikasikan') }}
                                                      </p>
                                                      @endif
                                                </div>
                                          </div>
                                    </div>
                              </div>

                              <!-- Form Actions -->
                              <div class="bg-slate-50  px-6 md:px-8 py-6 border-t border-slate-200 ">
                                    <div class="flex flex-col sm:flex-row items-stretch sm:items-center justify-between gap-4">
                                          <!-- Left Actions -->
                                          <div class="flex flex-wrap gap-3">
                                                <a href="{{ route('news.index') }}" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 text-slate-700  hover:bg-slate-200  rounded-lg transition-colors font-medium border border-slate-300 ">
                                                      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                                                      </svg>
                                                      {{ __('Kembali') }}
                                                </a>
                                                <button type="button" onclick="confirmDelete()" class="inline-flex items-center justify-center gap-2 px-5 py-2.5 text-red-600  hover:bg-red-50  rounded-lg transition-colors font-medium border border-red-300 ">
                                                      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                      </svg>
                                                      {{ __('Hapus') }}
                                                </button>
                                          </div>

                                          <!-- Right Actions -->
                                          <div class="flex flex-wrap gap-3">
                                                @if ($news->published_at)
                                                <!-- If published, show unpublish and update buttons -->
                                                <button type="submit" name="action" value="draft"
                                                      class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-slate-600  hover:bg-slate-700  text-white font-medium rounded-lg transition-all duration-200 shadow-sm">
                                                      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                      </svg>
                                                      {{ __('Jadikan Draft') }}
                                                </button>
                                                <button type="submit" name="action" value="publish"
                                                      class="inline-flex items-center justify-center gap-2 px-6 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-medium rounded-lg transition-all duration-200 shadow-lg hover:shadow-xl">
                                                      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                      </svg>
                                                      {{ __('Perbarui') }}
                                                </button>
                                                @else
                                                <!-- If draft, show save as draft and publish buttons -->
                                                <button type="submit" name="action" value="draft"
                                                      class="inline-flex items-center justify-center gap-2 px-5 py-2.5 bg-slate-200  hover:bg-slate-300  text-slate-900  font-medium rounded-lg transition-all duration-200">
                                                      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                      </svg>
                                                      {{ __('Simpan Draft') }}
                                                </button>
                                                <button type="submit" name="action" value="publish"
                                                      class="inline-flex items-center justify-center gap-2 px-6 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-medium rounded-lg transition-all duration-200 shadow-lg hover:shadow-xl">
                                                      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M9 19l3 3m0 0l3-3m-3 3v-6"></path>
                                                      </svg>
                                                      {{ __('Publikasikan') }}
                                                </button>
                                                @endif
                                          </div>
                                    </div>
                              </div>
                        </form>

                        <!-- Hidden Delete Form -->
                        <form id="deleteForm" action="{{ route('news.destroy', $news) }}" method="POST" class="hidden">
                              @csrf
                              @method('DELETE')
                        </form>
                  </div>
            </div>
      </div>

      <script>
            // ==================== SLUG GENERATION ====================
            function generateSlug() {
                  const title = document.getElementById('title').value;
                  const slug = title.toLowerCase()
                        .replace(/[^\w\s-]/g, '')
                        .replace(/\s+/g, '-')
                        .replace(/--+/g, '-')
                        .trim();
                  document.getElementById('slug').value = slug;
            }

            // Auto-generate slug when typing title
            document.getElementById('title').addEventListener('input', function() {
                  if (!document.getElementById('slug').value) {
                        generateSlug();
                  }
            });

            // ==================== IMAGE UPLOAD & PREVIEW ====================
            const dropZone = document.getElementById('dropZone');
            const fileInput = document.getElementById('featured_image');
            const removeImageCheckbox = document.getElementById('remove_image');
            const currentImageContainer = document.getElementById('currentImageContainer');

            // Handle file input change
            fileInput.addEventListener('change', function(e) {
                  handleFileChange(this);
            });

            // Prevent default drag behaviors
            ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
                  dropZone.addEventListener(eventName, preventDefaults, false);
            });

            function preventDefaults(e) {
                  e.preventDefault();
                  e.stopPropagation();
            }

            // Highlight drop zone when dragging over
            ['dragenter', 'dragover'].forEach(eventName => {
                  dropZone.addEventListener(eventName, () => {
                        dropZone.classList.add('border-blue-500', 'bg-blue-50');
                  });
            });

            // Remove highlight when leaving
            ['dragleave', 'drop'].forEach(eventName => {
                  dropZone.addEventListener(eventName, () => {
                        dropZone.classList.remove('border-blue-500', 'bg-blue-50');
                  });
            });

            // Handle dropped files
            dropZone.addEventListener('drop', (e) => {
                  const files = e.dataTransfer.files;
                  fileInput.files = files;
                  handleFileChange(fileInput);
            });

            // Handle file change with preview and auto-remove logic
            function handleFileChange(input) {
                  const file = input.files[0];
                  if (!file) return;

                  // Validate file size
                  const maxSize = 2 * 1024 * 1024; // 2MB
                  if (file.size > maxSize) {
                        alert("{{ __('Ukuran gambar maksimal 2MB') }}");
                        input.value = "";
                        return;
                  }

                  // Validate file type
                  if (!file.type.startsWith('image/')) {
                        alert("{{ __('Silakan pilih file gambar yang valid') }}");
                        input.value = "";
                        return;
                  }

                  // Read and preview the file
                  const reader = new FileReader();
                  reader.onload = function(e) {
                        // Hide current image if exists
                        if (currentImageContainer) {
                              currentImageContainer.classList.add('opacity-50', 'pointer-events-none');
                        }

                        // Hide upload prompt and show preview
                        document.getElementById('uploadPrompt').classList.add('hidden');
                        document.getElementById('newImagePreview').classList.remove('hidden');

                        // Set preview image
                        document.getElementById('previewImage').src = e.target.result;

                        // Auto-check remove_image checkbox if current image exists
                        if (removeImageCheckbox && currentImageContainer) {
                              removeImageCheckbox.checked = true;
                        }
                  };

                  reader.readAsDataURL(file);
            }

            // Clear new image selection
            function clearNewImage() {
                  // Clear file input
                  document.getElementById('featured_image').value = "";

                  // Hide preview, show upload prompt
                  document.getElementById('uploadPrompt').classList.remove('hidden');
                  document.getElementById('newImagePreview').classList.add('hidden');

                  // Restore current image visibility
                  if (currentImageContainer) {
                        currentImageContainer.classList.remove('opacity-50', 'pointer-events-none');
                  }

                  // Uncheck remove checkbox
                  if (removeImageCheckbox) {
                        removeImageCheckbox.checked = false;
                  }
            }

            // ==================== DELETE CONFIRMATION ====================
            function confirmDelete() {
                  if (confirm('{{ __("Apakah Anda yakin ingin menghapus berita ini? Tindakan ini tidak dapat dibatalkan.") }}')) {
                        document.getElementById('deleteForm').submit();
                  }
            }
      </script>
</x-layouts::app>