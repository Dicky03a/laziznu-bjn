<x-layouts::app :title="__('Manajemen Program')">

      <div class="flex items-center justify-between mb-6">
            <div>
                  <h1 class="text-2xl font-bold text-gray-900">Program Infaq & Donasi</h1>
                  <p class="text-sm text-gray-500 mt-1">Kelola semua program infaq dan donasi LAZIZNU</p>
            </div>
            <a href="{{ route('programs.create') }}"
                  class="inline-flex items-center gap-2 px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold rounded-xl transition-all shadow-sm hover:shadow-md">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                  </svg>
                  Tambah Program
            </a>
      </div>

      {{-- Alert --}}
      @if(session('success'))
      <div class="mb-5 p-4 bg-emerald-50 border border-emerald-200 rounded-xl text-emerald-700 text-sm flex items-center gap-2">
            <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>
            {{ session('success') }}
      </div>
      @endif

      {{-- Filter --}}
      <div class="bg-white rounded-2xl border border-gray-200 p-4 mb-5">
            <form method="GET" action="{{ route('programs.index') }}" class="flex flex-wrap gap-3 items-end">
                  <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Jenis</label>
                        <select name="type" class="px-3 py-2 rounded-lg border border-gray-300 text-sm focus:ring-2 focus:ring-emerald-500">
                              <option value="">Semua</option>
                              <option value="infaq" {{ request('type') === 'infaq' ? 'selected' : '' }}>Infaq</option>
                              <option value="donasi" {{ request('type') === 'donasi' ? 'selected' : '' }}>Donasi</option>
                        </select>
                  </div>
                  <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Cari Nama</label>
                        <input type="text" name="search" value="{{ request('search') }}"
                              placeholder="Nama program..."
                              class="px-3 py-2 rounded-lg border border-gray-300 text-sm focus:ring-2 focus:ring-emerald-500">
                  </div>
                  <div class="flex gap-2">
                        <button type="submit" class="px-4 py-2 bg-emerald-600 text-white text-sm font-semibold rounded-lg hover:bg-emerald-700 transition-all">
                              Filter
                        </button>
                        <a href="{{ route('programs.index') }}" class="px-4 py-2 bg-gray-100 text-gray-700 text-sm font-semibold rounded-lg hover:bg-gray-200 transition-all">
                              Reset
                        </a>
                  </div>
            </form>
      </div>

      {{-- Table --}}
      <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                  <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                              <tr>
                                    <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Program</th>
                                    <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Jenis</th>
                                    <th class="px-5 py-3 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">Terkumpul</th>
                                    <th class="px-5 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">Donatur</th>
                                    <th class="px-5 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-5 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi</th>
                              </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                              @forelse($programs as $program)
                              <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-5 py-4">
                                          <div class="flex items-center gap-3">
                                                @if($program->thumbnail)
                                                <img src="{{ asset('storage/' . $program->thumbnail) }}"
                                                      alt="{{ $program->nama }}"
                                                      class="w-10 h-10 rounded-lg object-cover flex-shrink-0">
                                                @else
                                                <div class="w-10 h-10 rounded-lg bg-emerald-100 flex items-center justify-center text-emerald-700 font-bold text-sm flex-shrink-0">
                                                      {{ strtoupper(substr($program->nama, 0, 2)) }}
                                                </div>
                                                @endif
                                                <div>
                                                      <p class="font-semibold text-gray-900 text-sm">{{ $program->nama }}</p>
                                                      <p class="text-xs text-gray-400 truncate max-w-xs">{{ $program->deskripsi }}</p>
                                                </div>
                                          </div>
                                    </td>
                                    <td class="px-5 py-4">
                                          <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold
                                {{ $program->type === 'infaq' ? 'bg-blue-100 text-blue-700' : 'bg-purple-100 text-purple-700' }}">
                                                {{ ucfirst($program->type) }}
                                          </span>
                                          @if($program->is_featured)
                                          <span class="ml-1 inline-flex items-center px-2 py-0.5 rounded-full text-xs font-semibold bg-amber-100 text-amber-700">⭐ Featured</span>
                                          @endif
                                    </td>
                                    <td class="px-5 py-4 text-right">
                                          <p class="font-semibold text-gray-900 text-sm">
                                                Rp {{ number_format($program->total_terkumpul ?? 0, 0, ',', '.') }}
                                          </p>
                                          @if($program->target_dana)
                                          <p class="text-xs text-gray-400">dari Rp {{ number_format($program->target_dana, 0, ',', '.') }}</p>
                                          @endif
                                    </td>
                                    <td class="px-5 py-4 text-center">
                                          <span class="text-gray-900 font-semibold text-sm">{{ number_format($program->total_donatur ?? 0) }}</span>
                                    </td>
                                    <td class="px-5 py-4 text-center">
                                          <form action="{{ route('programs.toggle-active', $program) }}" method="POST" class="inline">
                                                @csrf @method('PATCH')
                                                <button type="submit" class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold
                                    {{ $program->is_active ? 'bg-emerald-100 text-emerald-700 hover:bg-emerald-200' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}
                                    transition-all">
                                                      <span class="w-1.5 h-1.5 rounded-full {{ $program->is_active ? 'bg-emerald-500' : 'bg-gray-400' }}"></span>
                                                      {{ $program->is_active ? 'Aktif' : 'Nonaktif' }}
                                                </button>
                                          </form>
                                    </td>
                                    <td class="px-5 py-4 text-center">
                                          <div class="flex items-center justify-center gap-2">
                                                <a href="{{ route($program->type . '.show', $program->slug) }}" target="_blank"
                                                      class="p-1.5 text-gray-400 hover:text-blue-600 hover:bg-blue-50 rounded-lg transition-all" title="Lihat publik">
                                                      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                                      </svg>
                                                </a>
                                                <a href="{{ route('programs.edit', $program) }}"
                                                      class="p-1.5 text-gray-400 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition-all" title="Edit">
                                                      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                      </svg>
                                                </a>
                                                <form action="{{ route('programs.destroy', $program) }}" method="POST"
                                                      onsubmit="return confirm('Hapus program {{ addslashes($program->nama) }}?')">
                                                      @csrf @method('DELETE')
                                                      <button type="submit"
                                                            class="p-1.5 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all" title="Hapus">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                            </svg>
                                                      </button>
                                                </form>
                                          </div>
                                    </td>
                              </tr>
                              @empty
                              <tr>
                                    <td colspan="6" class="px-5 py-12 text-center text-gray-400">
                                          <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                          </svg>
                                          <p class="font-medium">Belum ada program</p>
                                          <p class="text-sm mt-1">Buat program pertama Anda</p>
                                    </td>
                              </tr>
                              @endforelse
                        </tbody>
                  </table>
            </div>

            @if($programs->hasPages())
            <div class="px-5 py-4 border-t border-gray-100">
                  {{ $programs->links() }}
            </div>
            @endif
      </div>

</x-layouts::app>