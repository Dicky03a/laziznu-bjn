<x-layouts::app :title="__('Manajemen Program Distribusi')">

      <div class="flex items-center justify-between mb-6">
            <div>
                  <h1 class="text-2xl font-bold text-gray-900">Program Distribusi Dana</h1>
                  <p class="text-sm text-gray-500 mt-1">Kelola program distribusi yang mengambil dana dari program pengumpulan.</p>
            </div>
            <a href="{{ route('distribution-programs.create') }}"
                  class="inline-flex items-center gap-2 px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold rounded-xl transition-all shadow-sm hover:shadow-md">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                  </svg>
                  Tambah Program Distribusi
            </a>
      </div>

      <!-- Statistik Dashboard -->
      <div class="grid grid-cols-1 md:grid-cols-4 gap-5 mb-8">
            <!-- Total Terkumpul -->
            <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm hover:shadow-md transition">
                  <div class="flex items-center justify-between mb-3">
                        <h3 class="text-xs font-semibold text-gray-600 tracking-wider">Total Terkumpul</h3>
                  </div>
                  <p class="text-2xl font-bold text-gray-900">Rp {{ number_format($totalTerkumpul, 0, ',', '.') }}</p>
                  <p class="text-xs text-gray-500 mt-2">Dana dari semua program sumber</p>
            </div>

            <!-- Total Dialokasikan -->
            <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm hover:shadow-md transition">
                  <div class="flex items-center justify-between mb-3">
                        <h3 class="text-xs font-semibold text-gray-600 tracking-wider">Dialokasikan</h3>
                  </div>
                  <p class="text-2xl font-bold text-emerald-600">Rp {{ number_format($totalDialokasikan, 0, ',', '.') }}</p>
                  <p class="text-xs text-gray-500 mt-2">{{ $percentageAllocated }}% dari total terkumpul</p>
            </div>

            <!-- Sisa Dana -->
            <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm hover:shadow-md transition">
                  <div class="flex items-center justify-between mb-3">
                        <h3 class="text-xs font-semibold text-gray-600 tracking-wider">Sisa Dana</h3>
                  </div>
                  <p class="text-2xl font-bold text-orange-600">Rp {{ number_format($totalSisa, 0, ',', '.') }}</p>
                  <p class="text-xs text-gray-500 mt-2">{{ 100 - $percentageAllocated }}% tersedia untuk alokasi</p>
            </div>

            <!-- Jumlah Program -->
            <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm hover:shadow-md transition">
                  <div class="flex items-center justify-between mb-3">
                        <h3 class="text-xs font-semibold text-gray-600 tracking-wider">Program Aktif</h3>
                  </div>
                  <p class="text-2xl font-bold text-purple-600">{{ $programAktif }}</p>
                  <p class="text-xs text-gray-500 mt-2">Program sumber aktif (DSKl, Infaq & Shodaqoh, Zakat Program)</p>
            </div>
      </div>

      <!-- Progress Bar Keseluruhan -->
      <div class="bg-white rounded-2xl border border-gray-200 p-6 mb-8 shadow-sm">
            <h3 class="text-sm font-semibold text-gray-900 mb-4">Status Alokasi Dana Keseluruhan</h3>
            <div class="space-y-3">
                  <div class="flex items-center gap-3">
                        <div class="flex-1">
                              <div class="w-full bg-gray-100 rounded-full h-4 overflow-hidden">
                                    <div class="bg-gradient-to-r from-emerald-500 to-emerald-600 h-full rounded-full transition-all"
                                          style="width: {{ $percentageAllocated }}%"></div>
                              </div>
                        </div>
                        <div class="text-right min-w-fit">
                              <p class="text-sm font-bold text-gray-900">{{ $percentageAllocated }}%</p>
                              <p class="text-xs text-gray-500">Dialokasikan</p>
                        </div>
                  </div>
                  <div class="flex justify-between text-xs text-gray-600 pt-2">
                        <span>Rp {{ number_format($totalDialokasikan, 0, ',', '.') }}</span>
                        <span>Rp {{ number_format($totalTerkumpul, 0, ',', '.') }}</span>
                  </div>
            </div>
      </div>

      @if(session('success'))
      <div class="mb-5 p-4 bg-emerald-50 border border-emerald-200 rounded-xl text-emerald-700 text-sm flex items-center gap-2">
            <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>
            {{ session('success') }}
      </div>
      @endif

      <div class="bg-white rounded-2xl border border-gray-200 p-4 mb-5">
            <form method="GET" action="{{ route('distribution-programs.index') }}" class="flex flex-wrap gap-3 items-end">
                  <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Cari Nama</label>
                        <input type="text" name="search" value="{{ request('search') }}"
                              placeholder="Nama program distribusi..."
                              class="px-3 py-2 rounded-lg border border-gray-300 text-sm focus:ring-2 focus:ring-emerald-500">
                  </div>
                  <div class="flex gap-2">
                        <button type="submit" class="px-4 py-2 bg-emerald-600 text-white text-sm font-semibold rounded-lg hover:bg-emerald-700 transition-all">
                              Filter
                        </button>
                        <a href="{{ route('distribution-programs.index') }}" class="px-4 py-2 bg-gray-100 text-gray-700 text-sm font-semibold rounded-lg hover:bg-gray-200 transition-all">
                              Reset
                        </a>
                  </div>
            </form>
      </div>

      <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                  <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                              <tr>
                                    <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Program Distribusi</th>
                                    <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Sumber Program</th>
                                    <th class="px-5 py-3 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">Target Alokasi</th>
                                    <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Persentase</th>
                                    <th class="px-5 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                                    <th class="px-5 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi</th>
                              </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                              @forelse($distributionPrograms as $distributionProgram)
                              <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-5 py-4">
                                          <div class="flex items-center gap-3">
                                                @if($distributionProgram->thumbnail)
                                                <img src="{{ asset('storage/' . $distributionProgram->thumbnail) }}"
                                                      alt="{{ $distributionProgram->nama }}"
                                                      class="w-10 h-10 rounded-lg object-cover flex-shrink-0">
                                                @else
                                                <div class="w-10 h-10 rounded-lg bg-emerald-100 flex items-center justify-center text-emerald-700 font-bold text-sm flex-shrink-0">
                                                      {{ strtoupper(substr($distributionProgram->nama, 0, 2)) }}
                                                </div>
                                                @endif
                                                <div>
                                                      <p class="font-semibold text-gray-900 text-sm">{{ $distributionProgram->nama }}</p>
                                                      <p class="text-xs text-gray-400 truncate max-w-xs">{{ $distributionProgram->deskripsi }}</p>
                                                </div>
                                          </div>
                                    </td>
                                    <td class="px-5 py-4">
                                          <div>
                                                @if($distributionProgram->sourceProgram)
                                                      <p class="font-semibold text-gray-900 text-sm">
                                                            {{ $distributionProgram->sourceProgram->nama }}
                                                            @if($distributionProgram->sourceProgram->trashed())
                                                                  <span class="ml-1 px-1.5 py-0.5 bg-red-100 text-red-600 text-[10px] rounded-md font-bold uppercase">Terhapus</span>
                                                            @endif
                                                      </p>
                                                      <p class="text-xs text-gray-500">
                                                            Dana Terkumpul: <span class="font-semibold">Rp {{ number_format($distributionProgram->sourceProgram->total_terkumpul, 0, ',', '.') }}</span>
                                                      </p>
                                                @else
                                                      <p class="font-semibold text-red-600 text-sm">Program Sumber Tidak Ditemukan</p>
                                                @endif
                                          </div>
                                    </td>
                                    <td class="px-5 py-4 text-right">
                                          <p class="font-bold text-gray-900 text-sm">Rp {{ number_format($distributionProgram->target_dana, 0, ',', '.') }}</p>
                                          <p class="text-xs text-gray-500">
                                                @if($distributionProgram->sourceProgram)
                                                      @if($distributionProgram->sourceProgram->available_for_distribution < 0)
                                                            <span class="text-red-600 font-semibold">Melampaui batas</span>
                                                      @else
                                                            Sisa: Rp {{ number_format($distributionProgram->sourceProgram->available_for_distribution, 0, ',', '.') }}
                                                      @endif
                                                @else
                                                      -
                                                @endif
                                          </p>
                                    </td>
                                    <td class="px-5 py-4">
                                          <div class="space-y-2">
                                                <div class="flex items-center justify-between mb-1">
                                                      <span class="text-xs font-medium text-gray-600">{{ $distributionProgram->progress_persen }}% dari sumber</span>
                                                </div>
                                                <div class="w-full bg-gray-100 rounded-full h-2 overflow-hidden">
                                                      <div class="bg-emerald-500 h-full rounded-full transition-all"
                                                            style="width: {{ min(100, $distributionProgram->progress_persen) }}%"></div>
                                                </div>
                                          </div>
                                    </td>
                                    <td class="px-5 py-4 text-center">
                                          <form action="{{ route('distribution-programs.toggle-active', $distributionProgram) }}" method="POST" class="inline">
                                                @csrf @method('PATCH')
                                                <button type="submit" class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold
                                                      {{ $distributionProgram->is_active ? 'bg-emerald-100 text-emerald-700 hover:bg-emerald-200' : 'bg-gray-100 text-gray-600 hover:bg-gray-200' }}
                                                      transition-all">
                                                      <span class="w-1.5 h-1.5 rounded-full {{ $distributionProgram->is_active ? 'bg-emerald-500' : 'bg-gray-400' }}"></span>
                                                      {{ $distributionProgram->is_active ? 'Aktif' : 'Nonaktif' }}
                                                </button>
                                          </form>
                                    </td>
                                    <td class="px-5 py-4 text-center">
                                          <div class="flex items-center justify-center gap-2">
                                                <a href="{{ route('distribution-programs.edit', $distributionProgram) }}"
                                                      class="p-1.5 text-gray-400 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition-all" title="Edit">
                                                      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                      </svg>
                                                </a>
                                                <form action="{{ route('distribution-programs.destroy', $distributionProgram) }}" method="POST"
                                                      onsubmit="return confirm('Hapus program distribusi {{ addslashes($distributionProgram->nama) }}?')">
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
                                          <p class="font-medium">Belum ada program distribusi</p>
                                          <p class="text-sm mt-1">Buat program distribusi pertama Anda</p>
                                    </td>
                              </tr>
                              @endforelse
                        </tbody>
                  </table>
            </div>

            @if($distributionPrograms->hasPages())
            <div class="px-5 py-4 border-t border-gray-100">
                  {{ $distributionPrograms->links() }}
            </div>
            @endif
      </div>

</x-layouts::app>