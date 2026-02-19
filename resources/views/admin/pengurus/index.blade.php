<x-layouts::app :title="__('Sekilas NU Care')">
      <div class="space-y-6">

            {{-- Page Header --}}
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                  <div>
                        <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Data Pengurus</h1>
                        <p class="mt-1 text-sm text-gray-500">
                              Kelola susunan pengurus cabang LAZISNU Kabupaten Bojonegoro
                        </p>
                  </div>
                  <a href="{{ route('pengurus.create') }}"
                        class="inline-flex items-center gap-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold px-5 py-2.5 rounded-lg shadow-sm transition-colors duration-200 whitespace-nowrap">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah Pengurus
                  </a>
            </div>

            {{-- Flash Message --}}
            @if(session('success'))
            <x-alert type="success" :message="session('success')" />
            @endif
            @if(session('error'))
            <x-alert type="error" :message="session('error')" />
            @endif

            {{-- Filter Card --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5">
                  <form method="GET" action="{{ route('pengurus.index') }}"
                        class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

                        {{-- Search --}}
                        <div class="relative lg:col-span-2">
                              <span class="absolute inset-y-0 left-0 flex items-center pl-3 text-gray-400">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                              </span>
                              <input type="text" name="search" value="{{ request('search') }}"
                                    placeholder="Cari nama, jabatan, bidang..."
                                    class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition" />
                        </div>

                        {{-- Filter Jabatan --}}
                        <div>
                              <select name="jabatan"
                                    class="w-full px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition">
                                    <option value="">Semua Jabatan</option>
                                    @foreach($jabatanList as $j)
                                    <option value="{{ $j }}" {{ request('jabatan') === $j ? 'selected' : '' }}>{{ $j }}</option>
                                    @endforeach
                              </select>
                        </div>

                        {{-- Filter Status --}}
                        <div class="flex gap-2">
                              <select name="is_active"
                                    class="flex-1 px-3 py-2 border border-gray-300 rounded-lg text-sm focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 outline-none transition">
                                    <option value="">Semua Status</option>
                                    <option value="1" {{ request('is_active') === '1' ? 'selected' : '' }}>Aktif</option>
                                    <option value="0" {{ request('is_active') === '0' ? 'selected' : '' }}>Nonaktif</option>
                              </select>
                              <button type="submit"
                                    class="bg-emerald-600 hover:bg-emerald-700 text-white px-4 py-2 rounded-lg text-sm font-medium transition">
                                    Cari
                              </button>
                              @if(request()->anyFilled(['search','jabatan','is_active']))
                              <a href="{{ route('pengurus.index') }}"
                                    class="bg-gray-100 hover:bg-gray-200 text-gray-600 px-4 py-2 rounded-lg text-sm font-medium transition">
                                    Reset
                              </a>
                              @endif
                        </div>
                  </form>
            </div>

            {{-- Table Card --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">

                  {{-- Table Info --}}
                  <div class="px-5 py-3 border-b border-gray-100 bg-gray-50 flex items-center justify-between">
                        <span class="text-xs text-gray-500">
                              Menampilkan {{ $pengurusList->firstItem() }}–{{ $pengurusList->lastItem() }}
                              dari {{ $pengurusList->total() }} data
                        </span>
                  </div>

                  <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200 text-sm">
                              <thead>
                                    <tr class="bg-gray-50 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">
                                          <th class="px-4 py-3 w-10">#</th>
                                          <th class="px-4 py-3">Pengurus</th>
                                          <th class="px-4 py-3">Jabatan</th>
                                          <th class="px-4 py-3">Periode</th>
                                          <th class="px-4 py-3 text-center">Status</th>
                                          <th class="px-4 py-3 text-center">Aksi</th>
                                    </tr>
                              </thead>
                              <tbody class="divide-y divide-gray-100 bg-white">
                                    @forelse($pengurusList as $index => $p)
                                    <tr class="hover:bg-gray-50 transition-colors">
                                          {{-- No --}}
                                          <td class="px-4 py-3 text-gray-400 font-mono text-xs">
                                                {{ $pengurusList->firstItem() + $index }}
                                          </td>

                                          {{-- Pengurus --}}
                                          <td class="px-4 py-3">
                                                <div class="flex items-center gap-3">
                                                      <div class="w-10 h-10 rounded-full overflow-hidden bg-emerald-100 flex items-center justify-center shrink-0">
                                                            @if($p->foto)
                                                            <img src="{{ $p->foto_url }}" alt="{{ $p->nama }}"
                                                                  class="w-full h-full object-cover" />
                                                            @else
                                                            <span class="text-emerald-600 font-bold text-sm">
                                                                  {{ strtoupper(substr($p->nama, 0, 1)) }}
                                                            </span>
                                                            @endif
                                                      </div>
                                                      <div>
                                                            <p class="font-semibold text-gray-900">{{ $p->nama_lengkap }}</p>
                                                            @if($p->email)
                                                            <p class="text-xs text-gray-400">{{ $p->email }}</p>
                                                            @endif
                                                      </div>
                                                </div>
                                          </td>

                                          {{-- Jabatan --}}
                                          <td class="px-4 py-3">
                                                <span class="font-medium text-gray-700">{{ $p->jabatan_label }}</span>
                                          </td>

                                          {{-- Periode --}}
                                          <td class="px-4 py-3">
                                                <span class="inline-flex items-center gap-1 bg-blue-50 text-blue-700 px-2 py-0.5 rounded-full text-xs font-medium">
                                                      {{ $p->periode }}
                                                </span>
                                          </td>

                                          {{-- Status --}}
                                          <td class="px-4 py-3 text-center">
                                                <form method="POST"
                                                      action="{{ route('pengurus.toggle-status', $p) }}"
                                                      class="inline">
                                                      @csrf @method('PATCH')
                                                      <button type="submit"
                                                            class="inline-flex items-center gap-1 text-xs font-semibold px-2.5 py-1 rounded-full transition
                                            {{ $p->is_active
                                                ? 'bg-emerald-100 text-emerald-700 hover:bg-emerald-200'
                                                : 'bg-gray-100 text-gray-500 hover:bg-gray-200' }}"
                                                            title="Klik untuk toggle status">
                                                            <span class="w-1.5 h-1.5 rounded-full {{ $p->is_active ? 'bg-emerald-500' : 'bg-gray-400' }}"></span>
                                                            {{ $p->is_active ? 'Aktif' : 'Nonaktif' }}
                                                      </button>
                                                </form>
                                          </td>

                                          {{-- Aksi --}}
                                          <td class="px-4 py-3">
                                                <div class="flex items-center justify-center gap-1">
                                                      <a href="{{ route('pengurus.show', $p) }}"
                                                            class="p-1.5 text-blue-600 hover:bg-blue-50 rounded-lg transition" title="Detail">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                        d="M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                            </svg>
                                                      </a>
                                                      <a href="{{ route('pengurus.edit', $p) }}"
                                                            class="p-1.5 text-amber-600 hover:bg-amber-50 rounded-lg transition" title="Edit">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                            </svg>
                                                      </a>
                                                      <form method="POST"
                                                            action="{{ route('pengurus.destroy', $p) }}"
                                                            onsubmit="return confirm('Hapus pengurus {{ $p->nama }}?')">
                                                            @csrf @method('DELETE')
                                                            <button type="submit"
                                                                  class="p-1.5 text-red-500 hover:bg-red-50 rounded-lg transition" title="Hapus">
                                                                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                                  </svg>
                                                            </button>
                                                      </form>
                                                </div>
                                          </td>
                                    </tr>
                                    @empty
                                    <tr>
                                          <td colspan="6" class="px-4 py-16 text-center">
                                                <div class="flex flex-col items-center gap-2 text-gray-400">
                                                      <svg class="w-12 h-12 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                                  d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                                                      </svg>
                                                      <p class="text-sm font-medium">Belum ada data pengurus</p>
                                                      <a href="{{ route('pengurus.create') }}"
                                                            class="text-emerald-600 hover:underline text-xs">Tambah sekarang</a>
                                                </div>
                                          </td>
                                    </tr>
                                    @endforelse
                              </tbody>
                        </table>
                  </div>

                  {{-- Pagination --}}
                  @if($pengurusList->hasPages())
                  <div class="px-5 py-3 border-t border-gray-100">
                        {{ $pengurusList->links() }}
                  </div>
                  @endif
            </div>
      </div>
</x-layouts::app>