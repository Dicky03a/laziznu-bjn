<x-layouts::app :title="__('Edit Rekening')">
      <div class="min-h-screen py-8 px-4">
            <div class="max-w-2xl mx-auto space-y-6">

                  <!-- Header -->
                  <div>
                        <h1 class="text-3xl font-bold text-slate-900 dark:text-white">
                              {{ __('Edit Rekening') }}
                        </h1>
                        <p class="text-slate-600 dark:text-slate-400 mt-2">
                              {{ __('Perbarui informasi rekening') }}
                        </p>
                  </div>

                  <!-- Form Card -->
                  <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-xl border border-slate-200 dark:border-zinc-800 p-6 md:p-8">
                        <form action="{{ route('rekenings.update', $rekening) }}" enctype="multipart/form-data" method="POST" class="space-y-6">
                              @csrf
                              @method('PUT')

                              <!-- Nama -->
                              <div>
                                    <label for="nama" class="block text-sm font-semibold text-slate-900 dark:text-white mb-2">
                                          {{ __('Nama') }} <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="nama" name="nama" value="{{ old('nama', $rekening->nama) }}"
                                          placeholder="{{ __('Contoh: Dana Pendidikan') }}"
                                          class="w-full px-4 py-2.5 bg-slate-50 dark:bg-zinc-800 border border-slate-300 dark:border-zinc-700 rounded-lg text-slate-900 dark:text-white placeholder-slate-500 dark:placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                          required>
                                    @error('nama')
                                    <p class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                              </div>

                              <!-- Bank Atas Nama -->
                              <div>
                                    <label for="bank_atas_nama" class="block text-sm font-semibold text-slate-900 dark:text-white mb-2">
                                          {{ __('Bank Atas Nama') }} <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="bank_atas_nama" name="bank_atas_nama" value="{{ old('bank_atas_nama', $rekening->bank_atas_nama) }}"
                                          placeholder="{{ __('Nama pemilik rekening') }}"
                                          class="w-full px-4 py-2.5 bg-slate-50 dark:bg-zinc-800 border border-slate-300 dark:border-zinc-700 rounded-lg text-slate-900 dark:text-white placeholder-slate-500 dark:placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                          required>
                                    @error('bank_atas_nama')
                                    <p class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                              </div>

                              <!-- Icon -->
                              <div x-data="{ iconPreview: null }">
                                    <label class="block text-sm font-semibold text-slate-900 mb-2">
                                          Icon Bank
                                    </label>

                                    <input type="file"
                                          name="icon"
                                          accept="image/*"
                                          class="w-full px-4 py-2.5 bg-slate-50 border border-slate-300 rounded-lg focus:ring-2 focus:ring-emerald-500"
                                          @change="const file = $event.target.files[0];if (file) {iconPreview = URL.createObjectURL(file);}">

                                    @error('icon')
                                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                                    @enderror

                                    {{-- Preview Icon Lama --}}
                                    @if($rekening->icon)
                                    <div class="mt-4" x-show="!iconPreview">
                                          <p class="text-sm mb-2">Icon Saat Ini:</p>
                                          <img src="{{ asset('storage/'.$rekening->icon) }}"
                                                class="h-24 w-24 object-contain rounded-lg border border-slate-300 p-2 bg-white">
                                    </div>
                                    @endif

                                    {{-- Preview Icon Baru --}}
                                    <div class="mt-4" x-show="iconPreview">
                                          <p class="text-sm mb-2">Preview Baru:</p>
                                          <img :src="iconPreview"
                                                class="h-24 w-24 object-contain rounded-lg border border-slate-300 p-2 bg-white">
                                    </div>
                              </div>


                              <!-- Nomor Rekening -->
                              <div>
                                    <label for="nomor_rekening" class="block text-sm font-semibold text-slate-900 dark:text-white mb-2">
                                          {{ __('Nomor Rekening') }} <span class="text-red-500">*</span>
                                    </label>
                                    <input type="text" id="nomor_rekening" name="nomor_rekening" value="{{ old('nomor_rekening', $rekening->nomor_rekening) }}"
                                          placeholder="{{ __('Nomor rekening bank') }}"
                                          class="w-full px-4 py-2.5 bg-slate-50 dark:bg-zinc-800 border border-slate-300 dark:border-zinc-700 rounded-lg text-slate-900 dark:text-white placeholder-slate-500 dark:placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all"
                                          required>
                                    @error('nomor_rekening')
                                    <p class="text-red-600 dark:text-red-400 text-sm mt-1">{{ $message }}</p>
                                    @enderror
                              </div>

                              <!-- Form Actions -->
                              <div class="flex items-center justify-between gap-4 pt-6 border-t border-slate-200 dark:border-zinc-700">
                                    <a href="{{ route('rekenings.index') }}" class="inline-flex items-center justify-center gap-2 px-6 py-2.5 text-slate-700 dark:text-slate-300 bg-slate-100 dark:bg-zinc-800 hover:bg-slate-200 dark:hover:bg-zinc-700 font-medium rounded-lg transition-all duration-200">
                                          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                          </svg>
                                          {{ __('Kembali') }}
                                    </a>
                                    <button type="submit" class="inline-flex items-center justify-center gap-2 px-6 py-2.5 bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-700 hover:to-cyan-700 text-white font-medium rounded-lg transition-all duration-200 shadow-lg">
                                          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                          </svg>
                                          {{ __('Perbarui') }}
                                    </button>
                              </div>
                        </form>
                  </div>
            </div>
      </div>
</x-layouts::app>