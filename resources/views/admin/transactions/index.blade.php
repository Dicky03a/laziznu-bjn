<x-layouts::app :title="__('Manajemen Transaksi')">

      <div class="flex items-center justify-between mb-6">
            <div>
                  <h1 class="text-2xl font-bold text-gray-900">Transaksi</h1>
                  <p class="text-sm text-gray-500 mt-1">Semua transaksi zakat, infaq, donasi, dan fidyah</p>
            </div>
            <div class="flex items-center gap-3">
                  <a href="{{ route('transactions.export', request()->query()) }}"
                        class="inline-flex items-center gap-2 px-4 py-2.5 bg-emerald-50 hover:bg-emerald-100 text-emerald-700 text-sm font-semibold rounded-xl transition-all border border-emerald-200 shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                        Export Excel
                  </a>
                  <a href="{{ route('transactions.create') }}"
                        class="inline-flex items-center gap-2 px-4 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold rounded-xl transition-all shadow-sm">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah Transaksi
                  </a>
            </div>
      </div>

      <!-- Statistik Dashboard -->
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
            <!-- Total Transaksi -->
            <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm hover:shadow-md transition">
                  <div class="flex items-center justify-between mb-3">
                        <h3 class="text-xs font-semibold text-gray-600 tracking-wider">Total Transaksi</h3>
                  </div>
                  <p class="text-2xl font-bold text-blue-600">{{ $stats['total_count'] }}</p>
                  <p class="text-xs text-gray-500 mt-2">{{ $stats['total_confirmed'] }} dikonfirmasi, {{ $stats['total_pending'] }} menunggu</p>
            </div>

            <!-- Menunggu Konfirmasi -->
            <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm hover:shadow-md transition">
                  <div class="flex items-center justify-between mb-3">
                        <h3 class="text-xs font-semibold text-gray-600 tracking-wider">Menunggu Konfirmasi</h3>
                  </div>
                  <p class="text-2xl font-bold text-yellow-600">{{ $stats['total_pending'] }}</p>
                  <p class="text-xs text-gray-500 mt-2">Transaksi belum dikonfirmasi</p>
            </div>

            <!-- Terkonfirmasi -->
            <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm hover:shadow-md transition">
                  <div class="flex items-center justify-between mb-3">
                        <h3 class="text-xs font-semibold text-gray-600 tracking-wider">Terkonfirmasi</h3>
                  </div>
                  <p class="text-2xl font-bold text-emerald-600">{{ $stats['total_confirmed'] }}</p>
                  <p class="text-xs text-gray-500 mt-2">Transaksi sudah dikonfirmasi</p>
            </div>

            <!-- Total Dana Masuk -->
            <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm hover:shadow-md transition">
                  <div class="flex items-center justify-between mb-3">
                        <h3 class="text-xs font-semibold text-gray-600 tracking-wider">Total Dana Masuk</h3>
                  </div>
                  <p class="text-2xl font-bold text-purple-600">Rp {{ number_format($stats['total_nominal'], 0, ',', '.') }}</p>
                  <p class="text-xs text-gray-500 mt-2">Semua: Rp {{ number_format($stats['total_all_nominal'], 0, ',', '.') }}</p>
            </div>
      </div>

      <!-- Info Filter Status -->
      @if(request()->hasAny(['types', 'type', 'status', 'search', 'tanggal_dari', 'tanggal_sampai']))
      <div class="bg-emerald-50 border border-emerald-200 rounded-2xl p-4 mb-6 flex items-center gap-3">
            <div class="p-2 bg-emerald-100 rounded-lg">
                  <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4" />
                  </svg>
            </div>
            <div class="flex-1">
                  <p class="text-sm font-semibold text-emerald-900">Statistik Terfilter</p>
                  <p class="text-xs text-emerald-700">Data ditampilkan berdasarkan filter yang diterapkan</p>
            </div>
      </div>
      @endif

      <!-- Filter Section -->
      <div class="bg-white rounded-2xl border border-gray-200 p-6 mb-5">
            <form method="GET" action="{{ route('transactions.index') }}" class="space-y-5">
                  <!-- Jenis Transaksi (Checkbox) -->
                  <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-3">Jenis Transaksi</label>
                        <div class="grid grid-cols-2 md:grid-cols-5 gap-4">
                              @php
                              $transactionTypes = [
                              ['value' => 'infaq', 'label' => 'DSKL'],
                              ['value' => 'donasi', 'label' => 'Infaq & Sodakoh'],
                              ['value' => 'zakat', 'label' => 'Zakat'],
                              ['value' => 'zakat_program', 'label' => 'Zakat Program'],
                              ['value' => 'fidyah', 'label' => 'Fidyah'],
                              ];
                              $selectedTypes = request()->has('types') ? (array) request()->input('types', []) : [];
                              @endphp
                              @foreach($transactionTypes as $type)
                              <label class="flex items-center gap-3 p-3 rounded-lg border-2 cursor-pointer transition-all
                                    {{ in_array($type['value'], $selectedTypes) ? 'border-emerald-500 bg-emerald-50' : 'border-gray-200 hover:border-gray-300' }}">
                                    <input type="checkbox" name="types[]" value="{{ $type['value'] }}"
                                          {{ in_array($type['value'], $selectedTypes) ? 'checked' : '' }}
                                          class="w-4 h-4 rounded border-gray-300 text-emerald-600 focus:ring-emerald-500">
                                    <span class="font-medium text-gray-900">{{ $type['label'] }}</span>
                              </label>
                              @endforeach
                        </div>
                  </div>

                  <!-- Status -->
                  <div class="grid grid-cols-1 md:grid-cols-3 gap-5">
                        <div>
                              <label class="block text-sm font-semibold text-gray-900 mb-2">Status</label>
                              <select name="status" class="w-full px-3 py-2 rounded-lg border border-gray-300 text-sm focus:ring-2 focus:ring-emerald-500">
                                    <option value="">Semua Status</option>
                                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Menunggu</option>
                                    <option value="confirmed" {{ request('status') === 'confirmed' ? 'selected' : '' }}>Dikonfirmasi</option>
                                    <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Ditolak</option>
                              </select>
                        </div>

                        <div>
                              <label class="block text-sm font-semibold text-gray-900 mb-2">Dari Tanggal</label>
                              <input type="date" name="tanggal_dari" value="{{ request('tanggal_dari') }}"
                                    class="w-full px-3 py-2 rounded-lg border border-gray-300 text-sm focus:ring-2 focus:ring-emerald-500">
                        </div>

                        <div>
                              <label class="block text-sm font-semibold text-gray-900 mb-2">Sampai Tanggal</label>
                              <input type="date" name="tanggal_sampai" value="{{ request('tanggal_sampai') }}"
                                    class="w-full px-3 py-2 rounded-lg border border-gray-300 text-sm focus:ring-2 focus:ring-emerald-500">
                        </div>
                  </div>

                  <!-- Search -->
                  <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">Pencarian</label>
                        <input type="text" name="search" value="{{ request('search') }}"
                              placeholder="Cari berdasarkan kode transaksi, nama donatur, atau email..."
                              class="w-full px-4 py-2 rounded-lg border border-gray-300 text-sm focus:ring-2 focus:ring-emerald-500">
                  </div>

                  <!-- Action Buttons -->
                  <div class="flex gap-2 justify-end pt-3 border-t border-gray-100">
                        <a href="{{ route('transactions.index') }}" class="px-5 py-2 bg-gray-100 text-gray-700 text-sm font-semibold rounded-lg hover:bg-gray-200 transition-all">
                              Reset Filter
                        </a>
                        <button type="submit" class="px-5 py-2 bg-emerald-600 text-white text-sm font-semibold rounded-lg hover:bg-emerald-700 transition-all flex items-center gap-2">
                              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" />
                              </svg>
                              Terapkan Filter
                        </button>
                  </div>
            </form>
      </div>

      <!-- $1 -->
      <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden">
            <div class="overflow-x-auto">
                  <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                              <tr>
                                    <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Kode / Tanggal</th>
                                    <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Muzakki / Donatur</th>
                                    <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Jenis</th>
                                    <th class="px-5 py-3 text-right text-xs font-semibold text-gray-500 uppercase">Jumlah</th>
                                    <th class="px-5 py-3 text-center text-xs font-semibold text-gray-500 uppercase">Status</th>
                                    <th class="px-5 py-3 text-center text-xs font-semibold text-gray-500 uppercase">Konfirmasi</th>
                                    <th class="px-5 py-3 text-center text-xs font-semibold text-gray-500 uppercase">Detail</th>
                              </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                              @forelse($transactions as $trx)
                              <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-5 py-4">
                                          <p class="font-mono text-xs font-semibold text-gray-900">{{ $trx->kode_transaksi }}</p>
                                          <p class="text-xs text-gray-400 mt-0.5">{{ $trx->created_at->format('d M Y, H:i') }}</p>
                                    </td>
                                    <td class="px-5 py-4">
                                          <p class="text-sm font-semibold text-gray-900">{{ $trx->nama_tampil }}</p>
                                          <p class="text-xs text-gray-400">{{ $trx->email ?? $trx->telepon ?? '-' }}</p>
                                    </td>
                                    <td class="px-5 py-4">
                                          @php
                                          $typeColors = [
                                          'zakat' => 'emerald',
                                          'infaq' => 'blue',
                                          'donasi' => 'purple',
                                          'fidyah' => 'amber'
                                          ];
                                          $color = $typeColors[$trx->type] ?? 'gray';
                                          @endphp

                                          <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-{{ $color }}-100 text-{{ $color }}-700">
                                                {{
                                                      $trx->type === 'infaq' ? 'DSKL' :
                                                      ($trx->type === 'donasi' ? 'Infaq dan Sodakoh' :
                                                      ($trx->type === 'zakat' && $trx->program_id ? 'Zakat Program' : $trx->type_label))
                                                }}
                                          </span>

                                          @if($trx->subtype)
                                          <span class="ml-1 text-xs text-gray-400">
                                                ({{ $trx->subtype }})
                                          </span>
                                          @endif

                                          @if($trx->program)
                                          <p class="text-xs text-gray-400 mt-0.5 truncate max-w-32">
                                                {{ $trx->program->nama }}
                                          </p>
                                          @endif
                                    </td>
                                    <td class="px-5 py-4 text-right">
                                          <p class="font-bold text-gray-900 text-sm">{{ $trx->jumlah_format }}</p>
                                    </td>
                                    <td class="px-5 py-4 text-center">
                                          @php
                                          $statusStyle = [
                                          'pending' => 'bg-yellow-100 text-yellow-700',
                                          'confirmed' => 'bg-emerald-100 text-emerald-700',
                                          'rejected' => 'bg-red-100 text-red-700',
                                          ];
                                          @endphp
                                          <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold {{ $statusStyle[$trx->status] ?? 'bg-gray-100 text-gray-700' }}">
                                                {{ $trx->status_label }}
                                          </span>
                                    </td>
                                    <td class="px-5 py-4 text-center">
                                          @if($trx->paymentConfirmation)
                                          <span class="inline-flex items-center gap-1 text-xs text-emerald-600 font-semibold">
                                                <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                                      <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                </svg>
                                                Ada bukti
                                          </span>
                                          @else
                                          <span class="text-xs text-gray-400">Belum ada</span>
                                          @endif
                                    </td>
                                    <td class="px-5 py-4 text-center">
                                          <a href="{{ route('transactions.show', $trx) }}"
                                                class="inline-flex items-center gap-1 px-3 py-1.5 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-semibold rounded-lg transition-all">
                                                Detail
                                          </a>
                                    </td>
                              </tr>
                              @empty
                              <tr>
                                    <td colspan="7" class="px-5 py-12 text-center text-gray-400">
                                          <p class="font-medium">Tidak ada transaksi</p>
                                    </td>
                              </tr>
                              @endforelse
                        </tbody>
                  </table>
            </div>

            @if($transactions->hasPages())
            <div class="px-5 py-4 border-t border-gray-100">
                  {{ $transactions->links() }}
            </div>
            @endif
      </div>

</x-layouts::app>