<x-layouts::app :title="__('Tambah Laporan Tahunan')">
      <div class="min-h-screen py-8 px-4">
            <div class="max-w-2xl mx-auto space-y-6">

                  <!-- Header -->
                  <div>
                        <h1 class="text-3xl font-bold text-slate-900 dark:text-white">
                              {{ __('Tambah Laporan Tahunan') }}
                        </h1>
                        <p class="text-slate-600 dark:text-slate-400 mt-2">
                              {{ __('Isi formulir di bawah untuk membuat laporan tahunan baru') }}
                        </p>
                  </div>

                  <!-- Form Card -->
                  <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-xl border border-slate-200 dark:border-zinc-800 p-6 md:p-8">
                        <form action="{{ route('laporan-tahunans.store') }}" method="POST" class="space-y-6">
                              @csrf

                              <!-- Nama Laporan -->
                              <div>
                                    <label for="nama" class="block text-sm font-semibold text-slate-900 dark:text-white mb-2">
                                          {{ __('Nama Laporan') }} <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="nama" name="nama" value="{{ old('nama') }}"
                                          placeholder="{{ __('Contoh: Laporan Tahunan 2024') }}"
                                          class="w-full px-4 py-2.5 bg-slate-50 dark:bg-zinc-800 border border-slate-300 dark:border-zinc-700 rounded-lg text-slate-900 dark:text-white placeholder-slate-500 dark:placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                          required>
                                    @error('nama')
                                    <p class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                              </div>

                              <!-- Link -->
                              <div>
                                    <label for="link_from" class="block text-sm font-semibold text-slate-900 dark:text-white mb-2">
                                          {{ __('Link') }} <span class="text-red-500">*</span>
                                    </label>
                                    <input type="url" id="link_from" name="link_from" value="{{ old('link_from') }}"
                                          placeholder="{{ __('https://example.com/laporan-2024') }}"
                                          class="w-full px-4 py-2.5 bg-slate-50 dark:bg-zinc-800 border border-slate-300 dark:border-zinc-700 rounded-lg text-slate-900 dark:text-white placeholder-slate-500 dark:placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                          required>
                                    @error('link_from')
                                    <p class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                              </div>

                              <!-- Form Actions -->
                              <div class="flex items-center justify-between gap-4 pt-6 border-t border-slate-200 dark:border-zinc-700">
                                    <a href="{{ route('laporan-tahunans.index') }}" class="inline-flex items-center justify-center gap-2 px-6 py-2.5 text-slate-700 dark:text-slate-300 bg-slate-100 dark:bg-zinc-800 hover:bg-slate-200 dark:hover:bg-zinc-700 font-medium rounded-lg transition-all duration-200">
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
</x-layouts::app>