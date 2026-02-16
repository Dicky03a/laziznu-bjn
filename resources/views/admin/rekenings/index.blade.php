<x-layouts::app :title="__('Daftar Rekening')">
      <div class="min-h-screen py-8 px-4">
            <div class="max-w-7xl mx-auto space-y-6">

                  <!-- Header with Create Button -->
                  <div class="flex items-center justify-between">
                        <div>
                              <h1 class="text-3xl font-bold text-slate-900 dark:text-white">
                                    {{ __('Rekening') }}
                              </h1>
                              <p class="mt-2 text-slate-600 dark:text-slate-400">
                                    {{ __('Kelola semua rekening di sini') }}
                              </p>
                        </div>
                        <a href="{{ route('rekenings.create') }}" class="inline-flex items-center justify-center gap-2 px-6 py-2.5 bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-700 hover:to-cyan-700 text-white font-medium rounded-lg transition-all duration-200 shadow-lg">
                              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                              </svg>
                              {{ __('Tambah Rekening') }}
                        </a>
                  </div>

                  <!-- Success Message -->
                  @if (session()->has('success'))
                  <div class="bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800 rounded-lg p-4">
                        <p class="text-green-800 dark:text-green-200">{{ session('success') }}</p>
                  </div>
                  @endif

                  <!-- Rekening Table Card -->
                  <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-xl border border-slate-200 dark:border-zinc-800 overflow-hidden">
                        <div class="overflow-x-auto">
                              <table class="w-full">
                                    <thead class="bg-slate-50 dark:bg-zinc-800 border-b border-slate-200 dark:border-zinc-700">
                                          <tr>
                                                <th class="px-6 py-3 text-left text-sm font-semibold text-slate-900 dark:text-slate-100">{{ __('Icon') }}</th>
                                                <th class="px-6 py-3 text-left text-sm font-semibold text-slate-900 dark:text-slate-100">{{ __('Nama') }}</th>
                                                <th class="px-6 py-3 text-left text-sm font-semibold text-slate-900 dark:text-slate-100">{{ __('Bank Atas Nama') }}</th>
                                                <th class="px-6 py-3 text-left text-sm font-semibold text-slate-900 dark:text-slate-100">{{ __('Nomor Rekening') }}</th>
                                                <th class="px-6 py-3 text-right text-sm font-semibold text-slate-900 dark:text-slate-100">{{ __('Aksi') }}</th>
                                          </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-200 dark:divide-zinc-700">
                                          @forelse ($rekenings as $item)
                                          <tr class="hover:bg-slate-50 dark:hover:bg-zinc-800 transition-colors">
                                                <td class="px-6 py-4">
                                                      @if ($item->icon)
                                                      <img src="{{ asset('storage/' . $item->icon) }}" alt="{{ $item->nama }}" class="h-12 w-12 object-contain rounded-lg border border-slate-200 dark:border-zinc-700 bg-white dark:bg-zinc-800 p-1">
                                                      @else
                                                      <div class="h-12 w-12 rounded-lg border border-slate-200 dark:border-zinc-700 bg-slate-100 dark:bg-zinc-800 flex items-center justify-center">
                                                            <svg class="w-6 h-6 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                            </svg>
                                                      </div>
                                                      @endif
                                                </td>
                                                <td class="px-6 py-4">
                                                      <p class="font-medium text-slate-900 dark:text-white">{{ $item->nama }}</p>
                                                </td>
                                                <td class="px-6 py-4">
                                                      <p class="text-slate-600 dark:text-slate-400">{{ $item->bank_atas_nama }}</p>
                                                </td>
                                                <td class="px-6 py-4">
                                                      <p class="font-mono text-sm text-slate-600 dark:text-slate-400">{{ $item->nomor_rekening }}</p>
                                                </td>
                                                <td class="px-6 py-4 text-right">
                                                      <div class="flex items-center justify-end gap-3">
                                                            <a href="{{ route('rekenings.edit', $item) }}" class="inline-flex items-center gap-2 px-3 py-1.5 text-sm font-medium text-blue-600 dark:text-blue-400 hover:bg-blue-50 dark:hover:bg-blue-900/30 rounded-lg transition-colors">
                                                                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                                  </svg>
                                                                  {{ __('Edit') }}
                                                            </a>
                                                            <form action="{{ route('rekenings.destroy', $item) }}" method="POST" class="inline" onsubmit="return confirm('{{ __('Yakin ingin menghapus?') }}')">
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
                                                <td colspan="5" class="px-6 py-12 text-center">
                                                      <div class="flex flex-col items-center justify-center">
                                                            <svg class="w-16 h-16 text-slate-300 dark:text-zinc-700 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                                            </svg>
                                                            <p class="text-slate-600 dark:text-slate-400 font-medium">{{ __('Belum ada rekening') }}</p>
                                                            <p class="text-slate-500 dark:text-slate-500 text-sm mt-1">{{ __('Mulai buat rekening pertama Anda dengan klik tombol di atas') }}</p>
                                                            <a href="{{ route('rekenings.create') }}" class="mt-4 inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-blue-600 to-cyan-600 hover:from-blue-700 hover:to-cyan-700 text-white font-medium rounded-lg transition-all duration-200">
                                                                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                                                  </svg>
                                                                  {{ __('Buat Rekening') }}
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
                  @if ($rekenings->hasPages())
                  <div class="mt-6">
                        {{ $rekenings->links() }}
                  </div>
                  @endif
            </div>
      </div>
</x-layouts::app>