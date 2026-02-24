<x-layouts::app :title="__('Daftar Dokumen')">
      <div class="min-h-screen py-8 px-4">
            <div class="max-w-7xl mx-auto space-y-6">

                  <!-- Header with Create Button -->
                  <div class="flex items-center justify-between">
                        <div>
                              <h1 class="text-3xl font-bold text-slate-900 dark:text-white">
                                    {{ __('Dokumen') }}
                              </h1>
                              <p class="mt-2 text-slate-600 dark:text-slate-400">
                                    {{ __('Kelola semua dokumen di sini') }}
                              </p>
                        </div>
                        <a href="{{ route('dokumens.create') }}" class="inline-flex items-center justify-center gap-2 px-6 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-medium rounded-lg transition-all duration-200 shadow-lg">
                              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                              </svg>
                              {{ __('Tambah Dokumen') }}
                        </a>
                  </div>

                  <!-- Success Message -->
                  @if (session()->has('success'))
                  <div class="bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800 rounded-lg p-4">
                        <p class="text-green-800 dark:text-green-200">{{ session('success') }}</p>
                  </div>
                  @endif

                  <!-- Dokumen Table Card -->
                  <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-xl border border-slate-200 dark:border-zinc-800 overflow-hidden">
                        <div class="overflow-x-auto">
                              <table class="w-full">
                                    <thead class="bg-slate-50 dark:bg-zinc-800 border-b border-slate-200 dark:border-zinc-700">
                                          <tr>
                                                <th class="px-6 py-3 text-left text-sm font-semibold text-slate-900 dark:text-slate-100">{{ __('Nama Dokumen') }}</th>
                                                <th class="px-6 py-3 text-left text-sm font-semibold text-slate-900 dark:text-slate-100">{{ __('Deskripsi') }}</th>
                                                <th class="px-6 py-3 text-left text-sm font-semibold text-slate-900 dark:text-slate-100">{{ __('File') }}</th>
                                                <th class="px-6 py-3 text-left text-sm font-semibold text-slate-900 dark:text-slate-100">{{ __('Ukuran') }}</th>
                                                <th class="px-6 py-3 text-left text-sm font-semibold text-slate-900 dark:text-slate-100">{{ __('Download') }}</th>
                                                <th class="px-6 py-3 text-right text-sm font-semibold text-slate-900 dark:text-slate-100">{{ __('Aksi') }}</th>
                                          </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-200 dark:divide-zinc-700">
                                          @forelse ($dokumens as $item)
                                          <tr class="hover:bg-slate-50 dark:hover:bg-zinc-800 transition-colors">
                                                <td class="px-6 py-4">
                                                      <p class="font-medium text-slate-900 dark:text-white">{{ $item->nama_dokumen }}</p>
                                                </td>
                                                <td class="px-6 py-4">
                                                      <p class="text-slate-600 dark:text-slate-400 text-sm line-clamp-2">{{ $item->deskripsi ?? '-' }}</p>
                                                </td>
                                                <td class="px-6 py-4">
                                                      <div class="flex items-center gap-2">
                                                            <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21h10a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                                            </svg>
                                                            <span class="text-sm text-slate-600 dark:text-slate-400">{{ Str::upper(pathinfo($item->file, PATHINFO_EXTENSION)) }}</span>
                                                      </div>
                                                </td>
                                                <td class="px-6 py-4">
                                                      <p class="text-sm text-slate-600 dark:text-slate-400">{{ number_format($item->ukuran_file / 1024, 2) }} KB</p>
                                                </td>
                                                <td class="px-6 py-4">
                                                      <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-300">
                                                            {{ $item->jumlah_download }} {{ $item->jumlah_download === 1 ? __('kali') : __('kali') }}
                                                      </span>
                                                </td>
                                                <td class="px-6 py-4 text-right">
                                                      <div class="flex items-center justify-end gap-3">
                                                            <a href="{{ route('dokumens.edit', $item) }}" class="inline-flex items-center gap-2 px-3 py-1.5 text-sm font-medium text-blue-600 dark:text-blue-400 hover:bg-blue-50 dark:hover:bg-blue-900/30 rounded-lg transition-colors">
                                                                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                                  </svg>
                                                                  {{ __('Edit') }}
                                                            </a>
                                                            <a href="{{ route('dokumens.show', $item) }}" class="inline-flex items-center gap-2 px-3 py-1.5 text-sm font-medium text-blue-600 dark:text-blue-400 hover:bg-blue-50 dark:hover:bg-blue-900/30 rounded-lg transition-colors">
                                                                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                                  </svg>
                                                                  {{ __('Lihat') }}
                                                            </a>
                                                            <form action="{{ route('dokumens.destroy', $item) }}" method="POST" class="inline" onsubmit="return confirm('{{ __('Yakin ingin menghapus?') }}')">
                                                                  @csrf
                                                                  @method('DELETE')
                                                                  <button type="submit" class="inline-flex items-center gap-2 px-3 py-1.5 text-sm font-medium text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/30 rounded-lg transition-colors">
                                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                                        </svg>
                                                                        {{ __('Hapus') }}
                                                                  </button>
                                                            </form>
                                                      </div>
                                                </td>
                                          </tr>
                                          @empty
                                          <tr>
                                                <td colspan="6" class="px-6 py-12 text-center">
                                                      <div class="flex flex-col items-center justify-center">
                                                            <svg class="w-16 h-16 text-slate-300 dark:text-zinc-700 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                                            </svg>
                                                            <p class="text-slate-600 dark:text-slate-400 font-medium">{{ __('Belum ada dokumen') }}</p>
                                                            <p class="text-slate-500 dark:text-slate-500 text-sm mt-1">{{ __('Mulai buat dokumen pertama Anda dengan klik tombol di atas') }}</p>
                                                            <a href="{{ route('dokumens.create') }}" class="mt-4 inline-flex items-center gap-2 px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white font-medium rounded-lg transition-all duration-200">
                                                                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                                                  </svg>
                                                                  {{ __('Buat Dokumen') }}
                                                            </a>
                                                      </div>
                                                </td>
                                          </tr>
                                          @endforelse
                                    </tbody>
                              </table>
                        </div>
                  </div>

                  <!-- Pagination -->
                  @if (method_exists($dokumens, 'hasPages') && $dokumens->hasPages())
                  <div class="mt-6">
                        {{ $dokumens->links() }}
                  </div>
                  @endif
            </div>
      </div>
</x-layouts::app>