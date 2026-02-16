<x-layouts::app :title="$dokumen->nama_dokumen">
      <div class="min-h-screen py-8 px-4">
            <div class="max-w-2xl mx-auto space-y-6">

                  <!-- Header -->
                  <div>
                        <a href="{{ route('dokumens.index') }}" class="inline-flex items-center gap-2 text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 mb-4">
                              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                              </svg>
                              {{ __('Kembali') }}
                        </a>
                        <h1 class="text-3xl font-bold text-slate-900 dark:text-white">
                              {{ $dokumen->nama_dokumen }}
                        </h1>
                        <p class="text-slate-600 dark:text-slate-400 mt-2">
                              {{ __('Detail dokumen') }}
                        </p>
                  </div>

                  <!-- Document Info Card -->
                  <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-xl border border-slate-200 dark:border-zinc-800 p-6 md:p-8 space-y-6">

                        <!-- File Section -->
                        <div class="flex items-center justify-between p-6 bg-gradient-to-r from-blue-50 to-blue-100 dark:from-blue-900/20 dark:to-blue-800/20 rounded-xl border border-blue-200 dark:border-blue-800">
                              <div class="flex items-center gap-4">
                                    <div class="w-16 h-16 bg-blue-500 rounded-lg flex items-center justify-center">
                                          <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                          </svg>
                                    </div>
                                    <div>
                                          <p class="text-sm text-slate-600 dark:text-slate-400">{{ __('Nama File') }}</p>
                                          <p class="font-semibold text-slate-900 dark:text-white">{{ basename($dokumen->file) }}</p>
                                          <p class="text-xs text-slate-500 dark:text-slate-500 mt-1">{{ number_format($dokumen->ukuran_file / 1024, 2) }} KB</p>
                                    </div>
                              </div>
                              <a href="{{ asset('storage/' . $dokumen->file) }}" download class="inline-flex items-center justify-center gap-2 px-6 py-3 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-all duration-200 shadow-lg">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                                    </svg>
                                    {{ __('Download') }}
                              </a>
                        </div>

                        <!-- Description Section -->
                        @if ($dokumen->deskripsi)
                        <div>
                              <h3 class="text-lg font-semibold text-slate-900 dark:text-white mb-3">{{ __('Deskripsi') }}</h3>
                              <p class="text-slate-600 dark:text-slate-400 leading-relaxed whitespace-pre-wrap">{{ $dokumen->deskripsi }}</p>
                        </div>
                        @endif

                        <!-- Stats Section -->
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                              <div class="p-4 bg-slate-50 dark:bg-zinc-800 rounded-lg border border-slate-200 dark:border-zinc-700">
                                    <p class="text-xs text-slate-600 dark:text-slate-400 uppercase tracking-wide font-semibold">{{ __('Ukuran File') }}</p>
                                    <p class="text-2xl font-bold text-slate-900 dark:text-white mt-1">{{ number_format($dokumen->ukuran_file / 1024, 2) }}</p>
                                    <p class="text-xs text-slate-500 dark:text-slate-500 mt-1">KB</p>
                              </div>
                              <div class="p-4 bg-slate-50 dark:bg-zinc-800 rounded-lg border border-slate-200 dark:border-zinc-700">
                                    <p class="text-xs text-slate-600 dark:text-slate-400 uppercase tracking-wide font-semibold">{{ __('Download') }}</p>
                                    <p class="text-2xl font-bold text-slate-900 dark:text-white mt-1">{{ $dokumen->jumlah_download }}</p>
                                    <p class="text-xs text-slate-500 dark:text-slate-500 mt-1">{{ __('kali') }}</p>
                              </div>
                              <div class="p-4 bg-slate-50 dark:bg-zinc-800 rounded-lg border border-slate-200 dark:border-zinc-700">
                                    <p class="text-xs text-slate-600 dark:text-slate-400 uppercase tracking-wide font-semibold">{{ __('Dibuat') }}</p>
                                    <p class="text-2xl font-bold text-slate-900 dark:text-white mt-1">{{ $dokumen->created_at->format('d M') }}</p>
                                    <p class="text-xs text-slate-500 dark:text-slate-500 mt-1">{{ $dokumen->created_at->format('Y') }}</p>
                              </div>
                        </div>

                        <!-- Actions -->
                        <div class="flex gap-3 pt-6 border-t border-slate-200 dark:border-zinc-700">
                              <a href="{{ route('dokumens.edit', $dokumen) }}" class="inline-flex items-center justify-center gap-2 px-6 py-2.5 bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-700 hover:to-cyan-700 text-white font-medium rounded-lg transition-all duration-200 shadow-lg">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                    {{ __('Edit') }}
                              </a>
                              <form action="{{ route('dokumens.destroy', $dokumen) }}" method="POST" class="inline" onsubmit="return confirm('{{ __('Yakin ingin menghapus dokumen ini?') }}')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="inline-flex items-center justify-center gap-2 px-6 py-2.5 text-red-600 dark:text-red-400 bg-red-50 dark:bg-red-900/20 hover:bg-red-100 dark:hover:bg-red-900/30 font-medium rounded-lg transition-all duration-200 border border-red-200 dark:border-red-800">
                                          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                          </svg>
                                          {{ __('Hapus') }}
                                    </button>
                              </form>
                        </div>
                  </div>
            </div>
      </div>
</x-layouts::app>