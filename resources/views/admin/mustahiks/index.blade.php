<x-layouts::app :title="__('Daftar Mustahik')">
      <div class="min-h-screen py-8 px-4">
            <div class="max-w-7xl mx-auto space-y-6">

                  <!-- Header with Create Button -->
                  <div class="flex items-center justify-between">
                        <div>
                              <h1 class="text-3xl font-bold text-slate-900 dark:text-white">
                                    Mustahik
                              </h1>
                              <p class="mt-2 text-slate-600 dark:text-slate-400">
                                    Kelola data penerima zakat di sini
                              </p>
                        </div>
                        <a href="{{ route('mustahiks.create') }}" class="inline-flex items-center justify-center gap-2 px-6 py-2.5 bg-emerald-600 hover:bg-emerald-700 hover:to-cyan-700 text-white font-medium rounded-lg transition-all duration-200 shadow-lg">
                              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                              </svg>
                              Tambah Mustahik
                        </a>
                  </div>

                  <!-- Success Message -->
                  @if (session()->has('success'))
                  <div class="bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800 rounded-lg p-4 flex items-start gap-3">
                        <svg class="w-5 h-5 text-green-600 dark:text-green-400 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <p class="text-green-800 dark:text-green-200">{{ session('success') }}</p>
                  </div>
                  @endif

                  <!-- Mustahik Table Card -->
                  <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-xl border border-slate-200 dark:border-zinc-800 overflow-hidden">
                        <div class="overflow-x-auto">
                              <table class="w-full">
                                    <thead class="bg-slate-50 dark:bg-zinc-800 border-b border-slate-200 dark:border-zinc-700">
                                          <tr>
                                                <th class="px-6 py-3 text-left text-sm font-semibold text-slate-900 dark:text-slate-100">{{ __('Nama') }}</th>
                                                <th class="px-6 py-3 text-left text-sm font-semibold text-slate-900 dark:text-slate-100">{{ __('NIK') }}</th>
                                                <th class="px-6 py-3 text-left text-sm font-semibold text-slate-900 dark:text-slate-100">{{ __('No HP') }}</th>
                                                <th class="px-6 py-3 text-left text-sm font-semibold text-slate-900 dark:text-slate-100">{{ __('Desa') }}</th>
                                                <th class="px-6 py-3 text-left text-sm font-semibold text-slate-900 dark:text-slate-100">{{ __('Kategori') }}</th>
                                                <th class="px-6 py-3 text-left text-sm font-semibold text-slate-900 dark:text-slate-100">{{ __('Status') }}</th>
                                                <th class="px-6 py-3 text-right text-sm font-semibold text-slate-900 dark:text-slate-100">{{ __('Aksi') }}</th>
                                          </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-200 dark:divide-zinc-700">
                                          @forelse ($mustahiks as $item)
                                          <tr class="hover:bg-slate-50 dark:hover:bg-zinc-800 transition-colors">
                                                <td class="px-6 py-4">
                                                      <p class="font-medium text-slate-900 dark:text-white">{{ $item->nama }}</p>
                                                </td>
                                                <td class="px-6 py-4">
                                                      <p class="font-mono text-sm text-slate-600 dark:text-slate-400">{{ $item->nik }}</p>
                                                </td>
                                                <td class="px-6 py-4">
                                                      <p class="text-slate-600 dark:text-slate-400">{{ $item->no_hp }}</p>
                                                </td>
                                                <td class="px-6 py-4">
                                                      <div>
                                                            <p class="text-slate-900 dark:text-white font-medium">{{ $item->desa->nama }}</p>
                                                            <p class="text-sm text-slate-500 dark:text-slate-400">{{ $item->kecamatan->nama }}</p>
                                                      </div>
                                                </td>
                                                <td class="px-6 py-4">
                                                      <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold bg-purple-100 dark:bg-purple-900/30 text-purple-700 dark:text-purple-300">
                                                            {{ $item->getKategoriAsnafFormatted() }}
                                                      </span>
                                                </td>
                                                <td class="px-6 py-4">
                                                      @if($item->status === 'aktif')
                                                      <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold bg-green-100 dark:bg-green-900/30 text-green-700 dark:text-green-300">
                                                            ✓ Aktif
                                                      </span>
                                                      @else
                                                      <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-300">
                                                            ✗ Nonaktif
                                                      </span>
                                                      @endif
                                                </td>
                                                <td class="px-6 py-4 text-right">
                                                      <div class="flex items-center justify-end gap-2">
                                                            <a href="{{ route('mustahiks.show', $item) }}" class="inline-flex items-center gap-2 px-3 py-1.5 text-sm font-medium text-cyan-600 dark:text-cyan-400 hover:bg-cyan-50 dark:hover:bg-cyan-900/30 rounded-lg transition-colors">
                                                                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                                  </svg>
                                                                  Lihat
                                                            </a>
                                                            <a href="{{ route('mustahiks.edit', $item) }}" class="inline-flex items-center gap-2 px-3 py-1.5 text-sm font-medium text-blue-600 dark:text-blue-400 hover:bg-blue-50 dark:hover:bg-blue-900/30 rounded-lg transition-colors">
                                                                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                                  </svg>
                                                                  Edit
                                                            </a>
                                                            <form action="{{ route('mustahiks.destroy', $item) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus data {{ $item->nama }}?')">
                                                                  @csrf
                                                                  @method('DELETE')
                                                                  <button type="submit" class="inline-flex items-center gap-2 px-3 py-1.5 text-sm font-medium text-red-600 dark:text-red-400 hover:bg-red-50 dark:hover:bg-red-900/30 rounded-lg transition-colors">
                                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                                        </svg>
                                                                        Hapus
                                                                  </button>
                                                            </form>
                                                      </div>
                                                </td>
                                          </tr>
                                          @empty
                                          <tr>
                                                <td colspan="7" class="px-6 py-12 text-center">
                                                      <div class="flex flex-col items-center justify-center">
                                                            <svg class="w-16 h-16 text-slate-300 dark:text-zinc-700 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                            </svg>
                                                            <p class="text-slate-600 dark:text-slate-400 font-medium">Belum ada mustahik</p>
                                                            <p class="text-slate-500 dark:text-slate-500 text-sm mt-1">Mulai tambah data mustahik dengan klik tombol di atas</p>
                                                            <a href="{{ route('mustahiks.create') }}" class="mt-4 inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-700 hover:to-cyan-700 text-white font-medium rounded-lg transition-all duration-200">
                                                                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                                                  </svg>
                                                                  Tambah Mustahik
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
                  @if ($mustahiks->hasPages())
                  <div class="mt-6">
                        {{ $mustahiks->links() }}
                  </div>
                  @endif
            </div>
      </div>
</x-layouts::app>