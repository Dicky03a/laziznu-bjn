<x-layouts::app :title="__('Manajemen Transaksi')">

      <div class="flex items-center justify-between mb-6">
            <div>
                  <h1 class="text-2xl font-bold text-gray-900">Transaksi</h1>
                  <p class="text-sm text-gray-500 mt-1">Semua transaksi zakat, infaq, donasi, dan fidyah</p>
            </div>
            <a href="{{ route('transactions.export', request()->query()) }}"
                  class="inline-flex items-center gap-2 px-4 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-semibold rounded-xl transition-all">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                  </svg>
                  Export CSV
            </a>
      </div>

      {{-- Stats Cards --}}
      <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
            @php
            $statCards = [
            ['label' => 'Menunggu Konfirmasi', 'value' => $stats['total_pending'], 'color' => 'yellow', 'prefix' => ''],
            ['label' => 'Terkonfirmasi', 'value' => $stats['total_confirmed'], 'color' => 'emerald', 'prefix' => ''],
            ['label' => 'Transaksi Hari Ini', 'value' => $stats['total_today'], 'color' => 'blue', 'prefix' => ''],
            ['label' => 'Total Dana Masuk', 'value' => 'Rp ' . number_format($stats['total_nominal'], 0, ',', '.'), 'color' => 'purple', 'prefix' => ''],
            ];
            @endphp
            @foreach($statCards as $card)
            <div class="bg-white rounded-2xl border border-gray-200 p-5">
                  <p class="text-xs text-gray-500 font-medium mb-1">{{ $card['label'] }}</p>
                  <p class="text-xl font-bold text-{{ $card['color'] }}-600">{{ $card['value'] }}</p>
            </div>
            @endforeach
      </div>

      {{-- Filter --}}
      <div class="bg-white rounded-2xl border border-gray-200 p-4 mb-5">
            <form method="GET" action="{{ route('transactions.index') }}" class="flex flex-wrap gap-3 items-end">
                  <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Jenis</label>
                        <select name="type" class="px-3 py-2 rounded-lg border border-gray-300 text-sm focus:ring-2 focus:ring-emerald-500">
                              <option value="">Semua Jenis</option>
                              @foreach(['zakat', 'infaq', 'donasi', 'fidyah'] as $t)
                              <option value="{{ $t }}" {{ request('type') === $t ? 'selected' : '' }}>{{ ucfirst($t) }}</option>
                              @endforeach
                        </select>
                  </div>
                  <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Status</label>
                        <select name="status" class="px-3 py-2 rounded-lg border border-gray-300 text-sm focus:ring-2 focus:ring-emerald-500">
                              <option value="">Semua Status</option>
                              <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Menunggu</option>
                              <option value="confirmed" {{ request('status') === 'confirmed' ? 'selected' : '' }}>Dikonfirmasi</option>
                              <option value="rejected" {{ request('status') === 'rejected' ? 'selected' : '' }}>Ditolak</option>
                        </select>
                  </div>
                  <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Cari</label>
                        <input type="text" name="search" value="{{ request('search') }}"
                              placeholder="Kode / Nama / Email"
                              class="px-3 py-2 rounded-lg border border-gray-300 text-sm focus:ring-2 focus:ring-emerald-500 w-48">
                  </div>
                  <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Dari Tanggal</label>
                        <input type="date" name="tanggal_dari" value="{{ request('tanggal_dari') }}"
                              class="px-3 py-2 rounded-lg border border-gray-300 text-sm focus:ring-2 focus:ring-emerald-500">
                  </div>
                  <div>
                        <label class="block text-xs font-medium text-gray-600 mb-1">Sampai Tanggal</label>
                        <input type="date" name="tanggal_sampai" value="{{ request('tanggal_sampai') }}"
                              class="px-3 py-2 rounded-lg border border-gray-300 text-sm focus:ring-2 focus:ring-emerald-500">
                  </div>
                  <div class="flex gap-2">
                        <button type="submit" class="px-4 py-2 bg-emerald-600 text-white text-sm font-semibold rounded-lg hover:bg-emerald-700 transition-all">Filter</button>
                        <a href="{{ route('transactions.index') }}" class="px-4 py-2 bg-gray-100 text-gray-700 text-sm font-semibold rounded-lg hover:bg-gray-200 transition-all">Reset</a>
                  </div>
            </form>
      </div>

      {{-- Table --}}
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
                                          $typeColors = ['zakat' => 'emerald', 'infaq' => 'blue', 'donasi' => 'purple', 'fidyah' => 'amber'];
                                          $color = $typeColors[$trx->type] ?? 'gray';
                                          @endphp
                                          <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-semibold bg-{{ $color }}-100 text-{{ $color }}-700">
                                                {{ $trx->type_label }}
                                          </span>
                                          @if($trx->subtype)
                                          <span class="ml-1 text-xs text-gray-400">({{ $trx->subtype }})</span>
                                          @endif
                                          @if($trx->program)
                                          <p class="text-xs text-gray-400 mt-0.5 truncate max-w-32">{{ $trx->program->nama }}</p>
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
                                          <svg class="w-12 h-12 mx-auto mb-3 text-gray-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                          </svg>
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