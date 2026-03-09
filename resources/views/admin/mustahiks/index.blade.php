<x-layouts::app :title="__('Daftar Mustahik')">
      <div class="min-h-screen py-8 px-4">
            <div class="max-w-7xl mx-auto space-y-8">

                  <!-- Header -->
                  <div>
                        <h1 class="text-4xl font-bold text-slate-900">
                              Daftar Mustahik
                        </h1>
                        <p class="mt-2 text-slate-600">
                              Kelola data penerima zakat dan visualisasi distribusi mustahik berdasarkan lokasi geografis
                        </p>
                  </div>

                  <!-- Statistics Cards -->
                  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <!-- Total Mustahik Card -->
                        <div class="bg-white rounded-2xl shadow-lg border border-slate-200 p-6 hover:shadow-xl transition-shadow">
                              <div class="flex items-start justify-between">
                                    <div>
                                          <p class="text-slate-600 text-sm font-medium">Total Mustahik</p>
                                          <p class="text-3xl font-bold text-slate-900 mt-2">
                                                {{ number_format($totalMustahik) }}
                                          </p>
                                          <p class="text-xs text-slate-500 mt-2">Penerima zakat terdaftar</p>
                                    </div>
                                    <div class="w-12 h-12 rounded-xl bg-blue-100 flex items-center justify-center">
                                          <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                                          </svg>
                                    </div>
                              </div>
                        </div>

                        <!-- Total Aktif Card -->
                        <div class="bg-white rounded-2xl shadow-lg border border-slate-200 p-6 hover:shadow-xl transition-shadow">
                              <div class="flex items-start justify-between">
                                    <div>
                                          <p class="text-slate-600 text-sm font-medium">Status Aktif</p>
                                          <p class="text-3xl font-bold text-slate-900 mt-2">
                                                {{ number_format($totalAktif) }}
                                          </p>
                                          <p class="text-xs text-slate-500 mt-2">
                                                {{ $totalMustahik > 0 ? round(($totalAktif / $totalMustahik) * 100) : 0 }}% dari total
                                          </p>
                                    </div>
                                    <div class="w-12 h-12 rounded-xl bg-emerald-100 flex items-center justify-center">
                                          <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                          </svg>
                                    </div>
                              </div>
                        </div>

                        <!-- Total Nonaktif Card -->
                        <div class="bg-white rounded-2xl shadow-lg border border-slate-200 p-6 hover:shadow-xl transition-shadow">
                              <div class="flex items-start justify-between">
                                    <div>
                                          <p class="text-slate-600 text-sm font-medium">Status Nonaktif</p>
                                          <p class="text-3xl font-bold text-slate-900 mt-2">
                                                {{ number_format($totalNonaktif) }}
                                          </p>
                                          <p class="text-xs text-slate-500 mt-2">
                                                {{ $totalMustahik > 0 ? round(($totalNonaktif / $totalMustahik) * 100) : 0 }}% dari total
                                          </p>
                                    </div>
                                    <div class="w-12 h-12 rounded-xl bg-red-100 flex items-center justify-center">
                                          <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l-2-2m0 0l-2-2m2 2l2-2m-2 2l-2 2m6-6l2 2m0 0l2 2m-2-2l-2 2m2-2l2-2" />
                                          </svg>
                                    </div>
                              </div>
                        </div>

                        <!-- Total Desa Card -->
                        <div class="bg-white rounded-2xl shadow-lg border border-slate-200 p-6 hover:shadow-xl transition-shadow">
                              <div class="flex items-start justify-between">
                                    <div>
                                          <p class="text-slate-600 text-sm font-medium">Desa/Kelurahan</p>
                                          <p class="text-3xl font-bold text-slate-900 mt-2">
                                                {{ $totalDesa }}
                                          </p>
                                          <p class="text-xs text-slate-500 mt-2">Jangkauan distribusi zakat</p>
                                    </div>
                                    <div class="w-12 h-12 rounded-xl bg-orange-100 flex items-center justify-center">
                                          <svg class="w-6 h-6 text-orange-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5.217m0 0a1 1 0 00-.02 0m.02 0a5 5 0 010 .217m8.217 0H21" />
                                          </svg>
                                    </div>
                              </div>
                        </div>
                  </div>

                  <!-- Success Message -->
                  @if (session()->has('success'))
                  <div class="bg-green-50 border border-green-200 rounded-lg p-4 flex items-start gap-3">
                        <svg class="w-5 h-5 text-green-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                              <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <p class="text-green-800">{{ session('success') }}</p>
                  </div>
                  @endif

                  <!-- Filter & Search Section -->
                  <div class="bg-white rounded-2xl shadow-lg border border-slate-200 p-6">
                        <h2 class="text-xl font-bold text-slate-900 mb-6 flex items-center gap-2">
                              <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                              </svg>
                              Filter & Pencarian Data
                        </h2>

                        <form method="GET" action="{{ route('mustahiks.index') }}" id="filterForm" class="space-y-6">
                              <!-- Search Bar -->
                              <div>
                                    <label class="block text-sm font-semibold text-slate-900 mb-2">
                                          🔍 Pencarian
                                    </label>
                                    <input type="text" name="search" value="{{ request('search') }}"
                                          placeholder="Cari nama, NIK, atau nomor telepon..."
                                          class="w-full px-4 py-3 rounded-xl border border-slate-300 bg-white text-slate-900 placeholder-slate-400 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all">
                              </div>

                              <!-- Filter Grid -->
                              <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4">
                                    <!-- Kecamatan Filter -->
                                    <div x-data="{ kecId: '{{ request('kecamatan_id') }}' }">
                                          <label class="block text-sm font-medium text-slate-700 mb-2">
                                                Kecamatan
                                          </label>
                                          <select name="kecamatan_id" x-model="kecId" @change="document.getElementById('filterForm').submit()"
                                                class="w-full px-4 py-2.5 rounded-xl border border-slate-300 bg-white text-slate-900 focus:outline-none focus:ring-2 focus:ring-emerald-500">
                                                <option value="">-- Semua Kecamatan --</option>
                                                @foreach ($kecamatans as $kec)
                                                <option value="{{ $kec->id }}" {{ request('kecamatan_id') == $kec->id ? 'selected' : '' }}>
                                                      {{ $kec->nama }}
                                                </option>
                                                @endforeach
                                          </select>
                                    </div>

                                    <!-- Desa Filter -->
                                    <div>
                                          <label class="block text-sm font-medium text-slate-700 mb-2">
                                                Desa/Kelurahan
                                          </label>
                                          <select name="desa_id" id="desaSelect"
                                                class="w-full px-4 py-2.5 rounded-xl border border-slate-300 bg-white text-slate-900 focus:outline-none focus:ring-2 focus:ring-emerald-500">
                                                <option value="">-- Semua Desa --</option>
                                                @if (request('kecamatan_id'))
                                                @foreach ($desas->where('kecamatan_id', request('kecamatan_id')) as $desa)
                                                <option value="{{ $desa->id }}" {{ request('desa_id') == $desa->id ? 'selected' : '' }}>
                                                      {{ $desa->nama }}
                                                </option>
                                                @endforeach
                                                @endif
                                          </select>
                                    </div>

                                    <!-- Kategori Filter -->
                                    <div>
                                          <label class="block text-sm font-medium text-slate-700 mb-2">
                                                Kategori Asnaf
                                          </label>
                                          <select name="kategori_asnaf"
                                                class="w-full px-4 py-2.5 rounded-xl border border-slate-300 bg-white text-slate-900 focus:outline-none focus:ring-2 focus:ring-emerald-500">
                                                <option value="">-- Semua Kategori --</option>
                                                <option value="fakir" {{ request('kategori_asnaf') == 'fakir' ? 'selected' : '' }}>Fakir</option>
                                                <option value="miskin" {{ request('kategori_asnaf') == 'miskin' ? 'selected' : '' }}>Miskin</option>
                                                <option value="amil" {{ request('kategori_asnaf') == 'amil' ? 'selected' : '' }}>Amil</option>
                                                <option value="muallaf" {{ request('kategori_asnaf') == 'muallaf' ? 'selected' : '' }}>Muallaf</option>
                                                <option value="riqab" {{ request('kategori_asnaf') == 'riqab' ? 'selected' : '' }}>Riqab</option>
                                                <option value="gharim" {{ request('kategori_asnaf') == 'gharim' ? 'selected' : '' }}>Gharim</option>
                                                <option value="fisabilillah" {{ request('kategori_asnaf') == 'fisabilillah' ? 'selected' : '' }}>Fisabilillah</option>
                                                <option value="ibnu_sabil" {{ request('kategori_asnaf') == 'ibnu_sabil' ? 'selected' : '' }}>Ibnu Sabil</option>
                                          </select>
                                    </div>

                                    <!-- Status Filter -->
                                    <div>
                                          <label class="block text-sm font-medium text-slate-700 mb-2">
                                                Status
                                          </label>
                                          <select name="status"
                                                class="w-full px-4 py-2.5 rounded-xl border border-slate-300 bg-white text-slate-900 focus:outline-none focus:ring-2 focus:ring-emerald-500">
                                                <option value="">-- Semua Status --</option>
                                                <option value="aktif" {{ request('status') == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                                <option value="nonaktif" {{ request('status') == 'nonaktif' ? 'selected' : '' }}>Nonaktif</option>
                                          </select>
                                    </div>

                                    <!-- Action Buttons -->
                                    <div class="flex items-end gap-2">
                                          <button type="submit" class="flex-1 px-4 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-medium rounded-xl transition-all flex items-center justify-center gap-2">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                                </svg>
                                                Cari
                                          </button>
                                          <a href="{{ route('mustahiks.index') }}" class="px-4 py-2.5 bg-slate-200 text-slate-700 font-medium rounded-xl hover:bg-slate-300 transition-all">
                                                Reset
                                          </a>
                                    </div>
                              </div>
                        </form>
                  </div>

                  <!-- Data Mustahik Table -->
                  <div class="bg-white rounded-2xl shadow-lg border border-slate-200 overflow-hidden">
                        <!-- Table Header with Create Button -->
                        <div class="px-6 py-4 border-b border-slate-200 bg-slate-50 flex items-center justify-between">
                              <h2 class="text-lg font-bold text-slate-900 flex items-center gap-2">
                                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    Data Mustahik {{ $mustahiks->total() > 0 ? '(' . $mustahiks->total() . ')' : '' }}
                              </h2>

                              <!-- Create Button -->
                              <a href="{{ route('mustahiks.create') }}" class="inline-flex items-center justify-center gap-2 px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white font-medium rounded-lg transition-all shadow-md hover:shadow-lg">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                    </svg>
                                    Tambah Mustahik
                              </a>
                        </div>

                        <!-- Table -->
                        <div class="overflow-x-auto">
                              <table class="w-full">
                                    <thead class="bg-slate-100 border-b border-slate-200">
                                          <tr>
                                                <th class="px-6 py-3 text-left text-sm font-semibold text-slate-900">No</th>
                                                <th class="px-6 py-3 text-left text-sm font-semibold text-slate-900">Nama</th>
                                                <th class="px-6 py-3 text-left text-sm font-semibold text-slate-900">NIK</th>
                                                <th class="px-6 py-3 text-left text-sm font-semibold text-slate-900">No HP</th>
                                                <th class="px-6 py-3 text-left text-sm font-semibold text-slate-900">Lokasi</th>
                                                <th class="px-6 py-3 text-left text-sm font-semibold text-slate-900">Kategori</th>
                                                <th class="px-6 py-3 text-left text-sm font-semibold text-slate-900">Status</th>
                                                <th class="px-6 py-3 text-right text-sm font-semibold text-slate-900">Aksi</th>
                                          </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-200">
                                          @forelse ($mustahiks as $index => $item)
                                          <tr class="hover:bg-slate-50 transition-colors">
                                                <td class="px-6 py-4 text-sm text-slate-600">
                                                      {{ ($mustahiks->currentPage() - 1) * $mustahiks->perPage() + $index + 1 }}
                                                </td>
                                                <td class="px-6 py-4 font-medium text-slate-900">
                                                      {{ $item->nama }}
                                                </td>
                                                <td class="px-6 py-4">
                                                      <code class="px-2.5 py-1.5 bg-slate-100 text-xs font-mono text-slate-900 rounded-lg">
                                                            {{ $item->nik }}
                                                      </code>
                                                </td>
                                                <td class="px-6 py-4 text-sm text-slate-600">
                                                      {{ $item->no_hp }}
                                                </td>
                                                <td class="px-6 py-4 text-sm">
                                                      <div class="text-slate-900 font-medium">{{ $item->desa->nama ?? '-' }}</div>
                                                      <div class="text-slate-600 text-xs">{{ $item->kecamatan->nama ?? '-' }}</div>
                                                </td>
                                                <td class="px-6 py-4">
                                                      <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-purple-100 text-purple-700">
                                                            {{ $item->getKategoriAsnafFormatted() }}
                                                      </span>
                                                </td>
                                                <td class="px-6 py-4">
                                                      @if($item->status === 'aktif')
                                                      <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-700">
                                                            ✓ Aktif
                                                      </span>
                                                      @else
                                                      <span class="inline-flex px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700">
                                                            ✗ Nonaktif
                                                      </span>
                                                      @endif
                                                </td>
                                                <td class="px-6 py-4 text-right">
                                                      <div class="flex items-center justify-end gap-2">
                                                            <a href="{{ route('mustahiks.show', $item) }}" class="inline-flex items-center gap-2 px-3 py-1.5 text-sm font-medium text-cyan-600 hover:bg-cyan-50 rounded-lg transition-colors">
                                                                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                                                  </svg>
                                                                  Lihat
                                                            </a>
                                                            <a href="{{ route('mustahiks.edit', $item) }}" class="inline-flex items-center gap-2 px-3 py-1.5 text-sm font-medium text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                                                                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                                  </svg>
                                                                  Edit
                                                            </a>
                                                            <form action="{{ route('mustahiks.destroy', $item) }}" method="POST" class="inline" onsubmit="return confirm('Yakin ingin menghapus data {{ $item->nama }}?')">
                                                                  @csrf
                                                                  @method('DELETE')
                                                                  <button type="submit" class="inline-flex items-center gap-2 px-3 py-1.5 text-sm font-medium text-red-600 hover:bg-red-50 rounded-lg transition-colors">
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
                                                <td colspan="8" class="px-6 py-12 text-center">
                                                      <div class="flex flex-col items-center justify-center">
                                                            <svg class="w-16 h-16 text-slate-300 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                                            </svg>
                                                            <p class="text-slate-600 font-medium">Tidak ada data mustahik</p>
                                                            <p class="text-slate-500 text-sm mt-1">Coba ubah filter atau pencarian Anda</p>
                                                      </div>
                                                </td>
                                          </tr>
                                          @endforelse
                                    </tbody>
                              </table>
                        </div>

                        <!-- Pagination -->
                        @if ($mustahiks->hasPages())
                        <div class="px-6 py-4 border-t border-slate-200 bg-slate-50">
                              <div class="flex items-center justify-between">
                                    <div class="text-sm text-slate-600">
                                          Menampilkan <strong>{{ ($mustahiks->currentPage() - 1) * $mustahiks->perPage() + 1 }}</strong> sampai
                                          <strong>{{ min($mustahiks->currentPage() * $mustahiks->perPage(), $mustahiks->total()) }}</strong>
                                          dari <strong>{{ $mustahiks->total() }}</strong> data
                                    </div>
                                    <div>
                                          {{ $mustahiks->links() }}
                                    </div>
                              </div>
                        </div>
                        @endif
                  </div>

                  <!-- Statistik Per Desa (jika ada kecamatan tertentu) -->
                  @if (request('kecamatan_id') && $statistikDesa->count() > 0)
                  <div class="bg-white rounded-2xl shadow-lg border border-slate-200 p-6">
                        <h2 class="text-xl font-bold text-slate-900 mb-6 flex items-center gap-2">
                              <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                              </svg>
                              Statistik Per Desa - {{ $kecamatans->find(request('kecamatan_id'))->nama ?? '' }}
                        </h2>

                        <div class="overflow-x-auto">
                              <table class="w-full">
                                    <thead class="bg-slate-50 border-b border-slate-200">
                                          <tr>
                                                <th class="px-6 py-3 text-left text-sm font-semibold text-slate-900">Desa</th>
                                                <th class="px-6 py-3 text-right text-sm font-semibold text-slate-900">Total Mustahik</th>
                                                <th class="px-6 py-3 text-right text-sm font-semibold text-slate-900">Status Aktif</th>
                                                <th class="px-6 py-3 text-right text-sm font-semibold text-slate-900">Status Nonaktif</th>
                                          </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-200">
                                          @foreach ($statistikDesa as $stat)
                                          <tr class="hover:bg-slate-50 transition-colors">
                                                <td class="px-6 py-4 font-medium text-slate-900">
                                                      {{ $stat->nama }}
                                                </td>
                                                <td class="px-6 py-4 text-right">
                                                      <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-sm font-semibold bg-purple-100 text-purple-700">
                                                            {{ $stat->mustahiks_count }}
                                                      </span>
                                                </td>
                                                <td class="px-6 py-4 text-right">
                                                      <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-sm font-semibold bg-green-100 text-green-700">
                                                            {{ $stat->mustahiks_aktif }}
                                                      </span>
                                                </td>
                                                <td class="px-6 py-4 text-right">
                                                      <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-sm font-semibold bg-red-100 text-red-700">
                                                            {{ $stat->mustahiks_count - $stat->mustahiks_aktif }}
                                                      </span>
                                                </td>
                                          </tr>
                                          @endforeach
                                    </tbody>
                              </table>
                        </div>
                  </div>
                  @endif

                  <!-- Statistik Per Kategori Asnaf -->
                  @if ($statistikKategori->count() > 0)
                  <div class="bg-white rounded-2xl shadow-lg border border-slate-200 p-6">
                        <h2 class="text-xl font-bold text-slate-900 mb-6 flex items-center gap-2">
                              <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                              </svg>
                              Statistik Per Kategori Asnaf
                        </h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                              @foreach ($statistikKategori as $stat)
                              <div class="bg-slate-50 rounded-xl border border-slate-200 p-4">
                                    <p class="text-sm font-medium text-slate-600 mb-3">
                                          {{ \App\Models\Mustahik::find(1)?->getKategoriAsnafFormatted() ?? ucfirst(str_replace('_', ' ', $stat->kategori_asnaf)) }}
                                    </p>
                                    <p class="text-2xl font-bold text-slate-900 mb-2">{{ $stat->total }}</p>
                                    <p class="text-xs text-slate-500">
                                          <span class="text-green-600 font-semibold">{{ $stat->aktif }}</span> aktif,
                                          <span class="text-red-600 font-semibold">{{ $stat->total - $stat->aktif }}</span> nonaktif
                                    </p>
                              </div>
                              @endforeach
                        </div>
                  </div>
                  @endif

                  <!-- Statistik Per Kecamatan -->
                  <div class="bg-white rounded-2xl shadow-lg border border-slate-200 p-6">
                        <h2 class="text-xl font-bold text-slate-900 mb-6 flex items-center gap-2">
                              <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                              </svg>
                              Statistik Per Kecamatan
                        </h2>

                        <div class="overflow-x-auto">
                              <table class="w-full">
                                    <thead class="bg-slate-50 border-b border-slate-200">
                                          <tr>
                                                <th class="px-6 py-3 text-left text-sm font-semibold text-slate-900">Kecamatan</th>
                                                <th class="px-6 py-3 text-right text-sm font-semibold text-slate-900">Total Mustahik</th>
                                                <th class="px-6 py-3 text-right text-sm font-semibold text-slate-900">Status Aktif</th>
                                                <th class="px-6 py-3 text-right text-sm font-semibold text-slate-900">Status Nonaktif</th>
                                          </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-200">
                                          @forelse ($statistikKecamatan as $stat)
                                          <tr class="hover:bg-slate-50 transition-colors">
                                                <td class="px-6 py-4 font-medium text-slate-900">
                                                      {{ $stat->nama }}
                                                </td>
                                                <td class="px-6 py-4 text-right">
                                                      <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-sm font-semibold bg-blue-100 text-blue-700">
                                                            {{ $stat->mustahiks_count }}
                                                      </span>
                                                </td>
                                                <td class="px-6 py-4 text-right">
                                                      <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-sm font-semibold bg-green-100 text-green-700">
                                                            {{ $stat->mustahiks_aktif }}
                                                      </span>
                                                </td>
                                                <td class="px-6 py-4 text-right">
                                                      <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-sm font-semibold bg-red-100 text-red-700">
                                                            {{ $stat->mustahiks_count - $stat->mustahiks_aktif }}
                                                      </span>
                                                </td>
                                          </tr>
                                          @empty
                                          <tr>
                                                <td colspan="4" class="px-6 py-8 text-center text-slate-500">
                                                      Tidak ada data statistik kecamatan
                                                </td>
                                          </tr>
                                          @endforelse
                                    </tbody>
                              </table>
                        </div>
                  </div>

            </div>
      </div>

      @push('scripts')
      <script>
            // Alpine.js untuk filter kecamatan dan desa dinamis
            document.addEventListener('DOMContentLoaded', function() {
                  const kecSelect = document.querySelector('select[name="kecamatan_id"]');
                  const desaSelect = document.querySelector('#desaSelect');

                  if (kecSelect && desaSelect) {
                        kecSelect.addEventListener('change', function() {
                              const kecId = this.value;
                              if (!kecId) {
                                    // Reset desa options
                                    desaSelect.innerHTML = '<option value="">-- Semua Desa --</option>';
                                    return;
                              }

                              // Fetch desa via AJAX
                              fetch(`/mustahiks/getDesa/${kecId}`)
                                    .then(response => response.json())
                                    .then(desas => {
                                          desaSelect.innerHTML = '<option value="">-- Semua Desa --</option>';
                                          desas.forEach(desa => {
                                                const option = document.createElement('option');
                                                option.value = desa.id;
                                                option.textContent = desa.nama;
                                                desaSelect.appendChild(option);
                                          });
                                    })
                                    .catch(error => console.error('Error:', error));
                        });
                  }
            });
      </script>
      @endpush

</x-layouts::app>