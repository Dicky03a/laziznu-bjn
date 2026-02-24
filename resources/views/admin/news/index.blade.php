<x-layouts::app :title="__('Daftar Berita')">
      <div class="min-h-screen py-8 px-4">
            <div class="max-w-7xl mx-auto space-y-6">

                  <!-- Header with Create Button -->
                  <div class="flex items-center justify-between">
                        <div>
                              <h1 class="text-3xl font-bold text-slate-900 dark:text-white">
                                    {{ __('Berita') }}
                              </h1>
                              <p class="mt-2 text-slate-600 dark:text-slate-400">
                                    {{ __('Kelola semua berita di sini') }}
                              </p>
                        </div>
                        <a href="{{ route('news.create') }}" class="inline-flex items-center justify-center gap-2 px-6 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-medium rounded-lg transition-all duration-200 shadow-lg">
                              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                              </svg>
                              {{ __('Tambah Berita') }}
                        </a>
                  </div>

                  <!-- Success Message -->
                  @if (session()->has('success'))
                  <div class="bg-green-50 dark:bg-green-900/30 border border-green-200 dark:border-green-800 rounded-lg p-4">
                        <p class="text-green-800 dark:text-green-200">{{ session('success') }}</p>
                  </div>
                  @endif

                  <!-- News Table Card -->
                  <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-xl border border-slate-200 dark:border-zinc-800 overflow-hidden">
                        <div class="overflow-x-auto">
                              <table class="w-full">
                                    <thead class="bg-slate-50 dark:bg-zinc-800 border-b border-slate-200 dark:border-zinc-700">
                                          <tr>
                                                <th class="px-6 py-3 text-left text-sm font-semibold text-slate-900 dark:text-slate-100">{{ __('Judul') }}</th>
                                                <th class="px-6 py-3 text-left text-sm font-semibold text-slate-900 dark:text-slate-100">{{ __('Kategori') }}</th>
                                                <th class="px-6 py-3 text-left text-sm font-semibold text-slate-900 dark:text-slate-100">{{ __('Tanggal') }}</th>
                                                <th class="px-6 py-3 text-left text-sm font-semibold text-slate-900 dark:text-slate-100">{{ __('Status') }}</th>
                                                <th class="px-6 py-3 text-right text-sm font-semibold text-slate-900 dark:text-slate-100">{{ __('Aksi') }}</th>
                                          </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-200 dark:divide-zinc-700">
                                          @forelse ($news as $item)
                                          <tr class="hover:bg-slate-50 dark:hover:bg-zinc-800 transition-colors">
                                                <td class="px-6 py-4">
                                                      <p class="font-medium text-slate-900 dark:text-white">{{ $item->title }}</p>
                                                      <p class="text-sm text-slate-600 dark:text-slate-400 mt-1">{{ Str::limit($item->excerpt ?? strip_tags($item->content), 50) }}</p>
                                                </td>
                                                <td class="px-6 py-4">
                                                      @if ($item->category)
                                                      <span class="inline-flex items-center px-3 py-1 rounded-full text-sm font-medium bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-300">
                                                            {{ $item->category->name }}
                                                      </span>
                                                      @else
                                                      <span class="text-slate-500 dark:text-slate-400 text-sm">-</span>
                                                      @endif
                                                </td>
                                                <td class="px-6 py-4 text-sm text-slate-600 dark:text-slate-400">
                                                      @if ($item->published_at)
                                                      {{ $item->published_at->format('d M Y') }}
                                                      @else
                                                      <span class="text-slate-400 dark:text-slate-500">-</span>
                                                      @endif
                                                </td>
                                                <td class="px-6 py-4">
                                                      @if ($item->published_at && $item->published_at <= now())
                                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 dark:bg-green-900/30 text-green-800 dark:text-green-300">
                                                            {{ __('Dipublikasikan') }}
                                                            </span>
                                                            @else
                                                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 dark:bg-yellow-900/30 text-yellow-800 dark:text-yellow-300">
                                                                  {{ __('Draft') }}
                                                            </span>
                                                            @endif
                                                </td>
                                                <td class="px-6 py-4 text-right">
                                                      <div class="flex items-center justify-end gap-3">
                                                            <a href="{{ route('news.edit', $item) }}" class="inline-flex items-center gap-2 px-3 py-1.5 text-sm font-medium text-blue-600 dark:text-blue-400 hover:bg-blue-50 dark:hover:bg-blue-900/30 rounded-lg transition-colors">
                                                                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                                  </svg>
                                                                  {{ __('Edit') }}
                                                            </a>
                                                            <a href="{{ route('berita.show', $item->slug) }}" class="inline-flex items-center gap-2 px-3 py-1.5 text-sm font-medium text-blue-600 dark:text-blue-400 hover:bg-blue-50 dark:hover:bg-blue-900/30 rounded-lg transition-colors">
                                                                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                                  </svg>
                                                                  {{ __('Show') }}
                                                            </a>
                                                            <form action="{{ route('news.destroy', $item) }}" method="POST" class="inline" onsubmit="return confirm('{{ __('Yakin ingin menghapus?') }}')">
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
                                                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v4m2 10a2 2 0 002-2m0 0V9a2 2 0 00-2-2m2 2V5m2 0a2 2 0 012 2v10a2 2 0 01-2 2m0 0H9m0 0a2 2 0 01-2-2m2 2v4"></path>
                                                            </svg>
                                                            <p class="text-slate-600 dark:text-slate-400 font-medium">{{ __('Belum ada berita') }}</p>
                                                            <p class="text-slate-500 dark:text-slate-500 text-sm mt-1">{{ __('Mulai buat berita pertama Anda dengan klik tombol di atas') }}</p>
                                                            <a href="{{ route('news.create') }}" class="mt-4 inline-flex items-center gap-2 px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white font-medium rounded-lg transition-all duration-200">
                                                                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                                                  </svg>
                                                                  {{ __('Buat Berita') }}
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
                  @if ($news->hasPages())
                  <div class="mt-6">
                        {{ $news->links() }}
                  </div>
                  @endif
            </div>
      </div>
</x-layouts::app>