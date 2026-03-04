<x-layouts::app :title="__('Sekilas NU Care')">
      <div class="min-h-screen  dark:bg-slate-900 py-8 px-4">
            <div class="max-w-7xl mx-auto space-y-8">

                  <!-- Header -->
                  <div>
                        <h1 class="text-4xl font-bold text-slate-900 dark:text-white">
                              Peta Sebaran Muzaki
                        </h1>
                        <p class="mt-2 text-slate-600 dark:text-slate-400">
                              Visualisasi distribusi muzaki berdasarkan lokasi geografis (kecamatan & desa)
                        </p>
                  </div>

                  <!-- Statistics Cards -->


                  <!-- Filter & Search Section -->
                  <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-lg border border-slate-200 dark:border-zinc-800 p-6">
                        <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-6 flex items-center gap-2">
                              <svg class="w-6 h-6 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                              </svg>
                              Filter & Pencarian Data
                        </h2>

                        <form method="GET" action="{{ route('peta-sebaran.index') }}" id="filterForm" class="space-y-6">
                              <!-- Search Bar -->
                              <div>
                                    <label class="block text-sm font-semibold text-slate-900 dark:text-white mb-2">
                                          🔍 Pencarian
                                    </label>
                                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama, email, telepon, atau kode transaksi..."
                                          class="w-full px-4 py-3 rounded-xl border border-slate-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-slate-900 dark:text-white placeholder-slate-400 dark:placeholder-slate-500 focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all">
                              </div>

                              <!-- Filter Grid -->
                              <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                                    <!-- Kecamatan Filter -->
                                    <div x-data="{ kecId: '{{ request('kecamatan_id') }}' }">
                                          <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                                                Kecamatan
                                          </label>
                                          <select name="kecamatan_id" x-model="kecId" @change="document.getElementById('filterForm').submit()"
                                                class="w-full px-4 py-2.5 rounded-xl border border-slate-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-emerald-500">
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
                                          <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                                                Desa/Kelurahan
                                          </label>
                                          <select name="desa_id"
                                                class="w-full px-4 py-2.5 rounded-xl border border-slate-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-emerald-500">
                                                <option value="">-- Semua Desa --</option>
                                                @foreach ($desas as $desa)
                                                <option value="{{ $desa->id }}" {{ request('desa_id') == $desa->id ? 'selected' : '' }}>
                                                      {{ $desa->nama }}
                                                </option>
                                                @endforeach
                                          </select>
                                    </div>

                                    <!-- Type Filter -->
                                    <div>
                                          <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                                                Jenis Donasi
                                          </label>
                                          <select name="type"
                                                class="w-full px-4 py-2.5 rounded-xl border border-slate-300 dark:border-zinc-700 bg-white dark:bg-zinc-800 text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-emerald-500">
                                                <option value="">-- Semua Jenis --</option>
                                                <option value="zakat" {{ request('type') == 'zakat' ? 'selected' : '' }}>Zakat</option>
                                                <option value="infaq" {{ request('type') == 'infaq' ? 'selected' : '' }}>Infaq</option>
                                                <option value="donasi" {{ request('type') == 'donasi' ? 'selected' : '' }}>Donasi</option>
                                                <option value="fidyah" {{ request('type') == 'fidyah' ? 'selected' : '' }}>Fidyah</option>
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
                                          <a href="{{ route('peta-sebaran.index') }}" class="px-4 py-2.5 bg-slate-200 dark:bg-zinc-800 text-slate-700 dark:text-slate-300 font-medium rounded-xl hover:bg-slate-300 dark:hover:bg-zinc-700 transition-all">
                                                Reset
                                          </a>
                                    </div>
                              </div>
                        </form>
                  </div>

                  <!-- Data Muzaki Table -->
                  <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-lg border border-slate-200 dark:border-zinc-800 overflow-hidden">
                        <!-- Table Header with Export -->
                        <div class="px-6 py-4 border-b border-slate-200 dark:border-zinc-800 bg-slate-50 dark:bg-zinc-800 flex items-center justify-between">
                              <h2 class="text-lg font-bold text-slate-900 dark:text-white flex items-center gap-2">
                                    <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                    </svg>
                                    Data Muzaki {{ $muzakis->total() > 0 ? '(' . $muzakis->total() . ')' : '' }}
                              </h2>

                              <!-- Export Button -->
                              <form action="{{ route('peta-sebaran.export') }}" method="GET" class="inline">
                                    @foreach (request()->query() as $key => $value)
                                    @if ($key !== '_token')
                                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                                    @endif
                                    @endforeach
                                    <button type="submit" class="inline-flex items-center gap-2 px-4 py-2 bg-green-600 hover:bg-green-700 text-white font-medium rounded-lg transition-all shadow-md hover:shadow-lg">
                                          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                          </svg>
                                          Export Excel
                                    </button>
                              </form>
                        </div>

                        <!-- Table -->
                        <div class="overflow-x-auto">
                              <table class="w-full">
                                    <thead class="bg-slate-100 dark:bg-zinc-800 border-b border-slate-200 dark:border-zinc-700">
                                          <tr>
                                                <th class="px-6 py-3 text-left text-sm font-semibold text-slate-900 dark:text-slate-100">No</th>
                                                <th class="px-6 py-3 text-left text-sm font-semibold text-slate-900 dark:text-slate-100">Kode</th>
                                                <th class="px-6 py-3 text-left text-sm font-semibold text-slate-900 dark:text-slate-100">Nama Donatur</th>
                                                <th class="px-6 py-3 text-left text-sm font-semibold text-slate-900 dark:text-slate-100">Kontak</th>
                                                <th class="px-6 py-3 text-left text-sm font-semibold text-slate-900 dark:text-slate-100">Lokasi</th>
                                                <th class="px-6 py-3 text-left text-sm font-semibold text-slate-900 dark:text-slate-100">Jenis</th>
                                                <th class="px-6 py-3 text-right text-sm font-semibold text-slate-900 dark:text-slate-100">Jumlah</th>
                                                <th class="px-6 py-3 text-left text-sm font-semibold text-slate-900 dark:text-slate-100">Tanggal</th>
                                          </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-200 dark:divide-zinc-700">
                                          @forelse ($muzakis as $index => $muzaki)
                                          <tr class="hover:bg-slate-50 dark:hover:bg-zinc-800 transition-colors">
                                                <td class="px-6 py-4 text-sm text-slate-600 dark:text-slate-400">
                                                      {{ ($muzakis->currentPage() - 1) * $muzakis->perPage() + $index + 1 }}
                                                </td>
                                                <td class="px-6 py-4">
                                                      <code class="px-2.5 py-1.5 bg-slate-100 dark:bg-zinc-800 text-xs font-mono text-slate-900 dark:text-white rounded-lg">
                                                            {{ $muzaki->kode_transaksi }}
                                                      </code>
                                                </td>
                                                <td class="px-6 py-4 font-medium text-slate-900 dark:text-white">
                                                      {{ $muzaki->nama_donatur }}
                                                </td>
                                                <td class="px-6 py-4 text-sm">
                                                      <div class="text-slate-900 dark:text-white">{{ $muzaki->email ?? '-' }}</div>
                                                      <div class="text-slate-600 dark:text-slate-400 text-xs">{{ $muzaki->telepon ?? '-' }}</div>
                                                </td>
                                                <td class="px-6 py-4 text-sm">
                                                      <div class="text-slate-900 dark:text-white font-medium">{{ $muzaki->desa->nama ?? '-' }}</div>
                                                      <div class="text-slate-600 dark:text-slate-400 text-xs">{{ $muzaki->kecamatan->nama ?? '-' }}</div>
                                                </td>
                                                <td class="px-6 py-4">
                                                      @php
                                                      $jenis = $muzaki->metadata['jenis'] ?? 'N/A';
                                                      $typeClass = [
                                                      'mal' => 'bg-emerald-100 dark:bg-emerald-900/30 text-emerald-700 dark:text-emerald-300',
                                                      'fitrah' => 'bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300',
                                                      ];
                                                      $typeColor = $typeClass[$jenis] ?? 'bg-gray-100 dark:bg-gray-900/30 text-gray-700 dark:text-gray-300';
                                                      @endphp
                                                      <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold {{ $typeColor }}">
                                                            {{ ucfirst($jenis) }}
                                                      </span>
                                                </td>
                                                <td class="px-6 py-4 text-right font-semibold text-slate-900 dark:text-white">
                                                      Rp {{ number_format($muzaki->jumlah, 0, ',', '.') }}
                                                </td>
                                                <td class="px-6 py-4 text-sm text-slate-600 dark:text-slate-400">
                                                      {{ $muzaki->created_at->format('d-m-Y') }}
                                                </td>
                                          </tr>
                                          @empty
                                          <tr>
                                                <td colspan="8" class="px-6 py-12 text-center">
                                                      <div class="flex flex-col items-center justify-center">
                                                            <svg class="w-16 h-16 text-slate-300 dark:text-zinc-700 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                                            </svg>
                                                            <p class="text-slate-600 dark:text-slate-400 font-medium">Tidak ada data muzaki</p>
                                                            <p class="text-slate-500 dark:text-slate-500 text-sm mt-1">Coba ubah filter atau pencarian Anda</p>
                                                      </div>
                                                </td>
                                          </tr>
                                          @endforelse
                                    </tbody>
                              </table>
                        </div>

                        <!-- Pagination -->
                        @if ($muzakis->hasPages())
                        <div class="px-6 py-4 border-t border-slate-200 dark:border-zinc-800 bg-slate-50 dark:bg-zinc-800">
                              <div class="flex items-center justify-between">
                                    <div class="text-sm text-slate-600 dark:text-slate-400">
                                          Menampilkan <strong>{{ ($muzakis->currentPage() - 1) * $muzakis->perPage() + 1 }}</strong> sampai
                                          <strong>{{ min($muzakis->currentPage() * $muzakis->perPage(), $muzakis->total()) }}</strong>
                                          dari <strong>{{ $muzakis->total() }}</strong> data
                                    </div>
                                    <div>
                                          {{ $muzakis->links() }}
                                    </div>
                              </div>
                        </div>
                        @endif
                  </div>

                  <!-- Statistik by Desa (jika ada kecamatan tertentu) -->
                  @if (request('kecamatan_id') && $statistikDesa->count() > 0)
                  <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-lg border border-slate-200 dark:border-zinc-800 p-6">
                        <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-6 flex items-center gap-2">
                              <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                              </svg>
                              Statistik Per Desa - {{ $kecamatans->find(request('kecamatan_id'))->nama ?? '' }}
                        </h2>

                        <div class="overflow-x-auto">
                              <table class="w-full">
                                    <thead class="bg-slate-50 dark:bg-zinc-800 border-b border-slate-200 dark:border-zinc-700">
                                          <tr>
                                                <th class="px-6 py-3 text-left text-sm font-semibold text-slate-900 dark:text-slate-100">Desa</th>
                                                <th class="px-6 py-3 text-right text-sm font-semibold text-slate-900 dark:text-slate-100">Total Muzaki</th>
                                                <th class="px-6 py-3 text-right text-sm font-semibold text-slate-900 dark:text-slate-100">Total Donasi</th>
                                                <th class="px-6 py-3 text-right text-sm font-semibold text-slate-900 dark:text-slate-100">Rata-rata Donasi</th>
                                          </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-200 dark:divide-zinc-700">
                                          @foreach ($statistikDesa as $stat)
                                          <tr class="hover:bg-slate-50 dark:hover:bg-zinc-800 transition-colors">
                                                <td class="px-6 py-4 font-medium text-slate-900 dark:text-white">
                                                      {{ $stat->nama }}
                                                </td>
                                                <td class="px-6 py-4 text-right">
                                                      <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-sm font-semibold bg-purple-100 dark:bg-purple-900/30 text-purple-700 dark:text-purple-300">
                                                            {{ $stat->total_muzaki }}
                                                      </span>
                                                </td>
                                                <td class="px-6 py-4 text-right text-slate-900 dark:text-white font-medium">
                                                      Rp {{ number_format($stat->total_donasi, 0, ',', '.') }}
                                                </td>
                                                <td class="px-6 py-4 text-right text-slate-600 dark:text-slate-400">
                                                      @if ($stat->total_muzaki > 0)
                                                      Rp {{ number_format($stat->total_donasi / $stat->total_muzaki, 0, ',', '.') }}
                                                      @else
                                                      -
                                                      @endif
                                                </td>
                                          </tr>
                                          @endforeach
                                    </tbody>
                              </table>
                        </div>
                  </div>
                  @endif

                  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                        <!-- Total Muzaki Card -->
                        <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-lg border border-slate-200 dark:border-zinc-800 p-6 hover:shadow-xl transition-shadow">
                              <div class="flex items-start justify-between">
                                    <div>
                                          <p class="text-slate-600 dark:text-slate-400 text-sm font-medium">Total Muzaki</p>
                                          <p class="text-3xl font-bold text-slate-900 dark:text-white mt-2">
                                                {{ number_format($totalMuzaki) }}
                                          </p>
                                          <p class="text-xs text-slate-500 dark:text-slate-500 mt-2">Yang sudah dikonfirmasi</p>
                                    </div>
                                    <div class="w-12 h-12 rounded-xl bg-blue-100 dark:bg-blue-900/30 flex items-center justify-center">
                                          <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                                          </svg>
                                    </div>
                              </div>
                        </div>

                        <!-- Total Donasi Card -->
                        <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-lg border border-slate-200 dark:border-zinc-800 p-6 hover:shadow-xl transition-shadow">
                              <div class="flex items-start justify-between">
                                    <div>
                                          <p class="text-slate-600 dark:text-slate-400 text-sm font-medium">Total Donasi</p>
                                          <p class="text-3xl font-bold text-slate-900 dark:text-white mt-2">
                                                <span class="text-lg">Rp</span> {{ number_format($totalDonasi / 1_000_000, 1) }}M
                                          </p>
                                          <p class="text-xs text-slate-500 dark:text-slate-500 mt-2">
                                                {{ 'Rp ' . number_format($totalDonasi, 0, ',', '.') }}
                                          </p>
                                    </div>
                                    <div class="w-12 h-12 rounded-xl bg-emerald-100 dark:bg-emerald-900/30 flex items-center justify-center">
                                          <svg class="w-6 h-6 text-emerald-600 dark:text-emerald-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                          </svg>
                                    </div>
                              </div>
                        </div>

                        <!-- Total Kecamatan Card -->
                        <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-lg border border-slate-200 dark:border-zinc-800 p-6 hover:shadow-xl transition-shadow">
                              <div class="flex items-start justify-between">
                                    <div>
                                          <p class="text-slate-600 dark:text-slate-400 text-sm font-medium">Kecamatan</p>
                                          <p class="text-3xl font-bold text-slate-900 dark:text-white mt-2">
                                                {{ $totalKecamatan }}
                                          </p>
                                          <p class="text-xs text-slate-500 dark:text-slate-500 mt-2">Area yang tercakup</p>
                                    </div>
                                    <div class="w-12 h-12 rounded-xl bg-purple-100 dark:bg-purple-900/30 flex items-center justify-center">
                                          <svg class="w-6 h-6 text-purple-600 dark:text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20l-5.447-2.724A1 1 0 003 16.382V5.618a1 1 0 011.553-.894L9 7m0 13l6.447-3.276A1 1 0 0021 16.382V5.618a1 1 0 00-1.553-.894L15 7m0 13V7m0 13L9 7" />
                                          </svg>
                                    </div>
                              </div>
                        </div>

                        <!-- Total Desa Card -->
                        <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-lg border border-slate-200 dark:border-zinc-800 p-6 hover:shadow-xl transition-shadow">
                              <div class="flex items-start justify-between">
                                    <div>
                                          <p class="text-slate-600 dark:text-slate-400 text-sm font-medium">Desa/Kelurahan</p>
                                          <p class="text-3xl font-bold text-slate-900 dark:text-white mt-2">
                                                {{ $totalDesa }}
                                          </p>
                                          <p class="text-xs text-slate-500 dark:text-slate-500 mt-2">Di semua kecamatan</p>
                                    </div>
                                    <div class="w-12 h-12 rounded-xl bg-orange-100 dark:bg-orange-900/30 flex items-center justify-center">
                                          <svg class="w-6 h-6 text-orange-600 dark:text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5.217m0 0a1 1 0 00-.02 0m.02 0a5 5 0 010 .217m8.217 0H21" />
                                          </svg>
                                    </div>
                              </div>
                        </div>
                  </div>
                  <!-- Statistik by Kecamatan (Section) -->
                  <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-lg border border-slate-200 dark:border-zinc-800 p-6">
                        <h2 class="text-xl font-bold text-slate-900 dark:text-white mb-6 flex items-center gap-2">
                              <svg class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                              </svg>
                              Statistik Per Kecamatan
                        </h2>

                        <div class="overflow-x-auto">
                              <table class="w-full">
                                    <thead class="bg-slate-50 dark:bg-zinc-800 border-b border-slate-200 dark:border-zinc-700">
                                          <tr>
                                                <th class="px-6 py-3 text-left text-sm font-semibold text-slate-900 dark:text-slate-100">Kecamatan</th>
                                                <th class="px-6 py-3 text-right text-sm font-semibold text-slate-900 dark:text-slate-100">Total Muzaki</th>
                                                <th class="px-6 py-3 text-right text-sm font-semibold text-slate-900 dark:text-slate-100">Total Donasi</th>
                                                <th class="px-6 py-3 text-right text-sm font-semibold text-slate-900 dark:text-slate-100">Rata-rata Donasi</th>
                                          </tr>
                                    </thead>
                                    <tbody class="divide-y divide-slate-200 dark:divide-zinc-700">
                                          @forelse ($statistikKecamatan as $stat)
                                          <tr class="hover:bg-slate-50 dark:hover:bg-zinc-800 transition-colors">
                                                <td class="px-6 py-4 font-medium text-slate-900 dark:text-white">
                                                      {{ $stat->nama }}
                                                </td>
                                                <td class="px-6 py-4 text-right">
                                                      <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-sm font-semibold bg-blue-100 dark:bg-blue-900/30 text-blue-700 dark:text-blue-300">
                                                            {{ $stat->total_muzaki }}
                                                      </span>
                                                </td>
                                                <td class="px-6 py-4 text-right text-slate-900 dark:text-white font-medium">
                                                      Rp {{ number_format($stat->total_donasi, 0, ',', '.') }}
                                                </td>
                                                <td class="px-6 py-4 text-right text-slate-600 dark:text-slate-400">
                                                      @if ($stat->total_muzaki > 0)
                                                      Rp {{ number_format($stat->total_donasi / $stat->total_muzaki, 0, ',', '.') }}
                                                      @else
                                                      -
                                                      @endif
                                                </td>
                                          </tr>
                                          @empty
                                          <tr>
                                                <td colspan="4" class="px-6 py-8 text-center text-slate-500 dark:text-slate-400">
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
            // Alpine.js untuk filter kecamatan dinamis
            document.addEventListener('DOMContentLoaded', function() {
                  const kecSelect = document.querySelector('select[name="kecamatan_id"]');
                  const desaSelect = document.querySelector('select[name="desa_id"]');

                  if (kecSelect) {
                        kecSelect.addEventListener('change', function() {
                              const kecId = this.value;
                              if (!kecId) {
                                    // Reset desa options
                                    desaSelect.innerHTML = '<option value="">-- Semua Desa --</option>';
                                    return;
                              }

                              // Fetch desa via AJAX
                              fetch(`{{ route('peta-sebaran.getDesa') }}?kecamatan_id=${kecId}`)
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