<x-layouts::app :title="__('Pendaftaran Qurban')">

    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Pendaftaran Qurban</h1>
            <p class="text-sm text-gray-500 mt-1">Semua peserta yang mendaftar qurban</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('qurban.registrations.export', request()->query()) }}"
                class="inline-flex items-center gap-2 px-4 py-2.5 bg-emerald-50 hover:bg-emerald-100 text-emerald-700 text-sm font-semibold rounded-xl transition-all border border-emerald-200 shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                Export Excel
            </a>
            <a href="{{ route('qurban.registrations.create') }}"
                class="inline-flex items-center gap-2 px-4 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold rounded-xl transition-all shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Pendaftaran
            </a>
        </div>
    </div>

    @if($stats)
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
        <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm hover:shadow-md transition">
            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Menunggu Konfirmasi</p>
            <p class="text-2xl font-bold text-yellow-600">{{ $stats['total_pending'] }}</p>
            <p class="text-xs text-gray-400 mt-2">Pendaftaran perlu diverifikasi</p>
        </div>
        <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm hover:shadow-md transition">
            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Terkonfirmasi</p>
            <p class="text-2xl font-bold text-emerald-600">{{ $stats['total_confirmed'] }}</p>
            <p class="text-xs text-gray-400 mt-2">Pendaftaran sudah sah</p>
        </div>
        <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm hover:shadow-md transition">
            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider mb-2">Dana Terkumpul</p>
            <p class="text-2xl font-bold text-blue-600">Rp {{ number_format($stats['total_nominal'], 0, ',', '.') }}</p>
            <p class="text-xs text-gray-400 mt-2">Berdasarkan data konfirmasi</p>
        </div>
    </div>
    @endif

    <div class="bg-white rounded-2xl border border-gray-200 p-6 mb-5 shadow-sm">
        <form method="GET" action="{{ route('qurban.registrations.index') }}" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Periode</label>
                    <select name="period_id" class="w-full px-3 py-2 rounded-lg border border-gray-300 text-sm focus:ring-2 focus:ring-emerald-500">
                        <option value="">Semua Periode</option>
                        @foreach ($periods as $period)
                        <option value="{{ $period->id }}" {{ request('period_id') == $period->id ? 'selected' : '' }}>
                            {{ $period->nama }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Status</label>
                    <select name="status" class="w-full px-3 py-2 rounded-lg border border-gray-300 text-sm focus:ring-2 focus:ring-emerald-500">
                        <option value="">Semua Status</option>
                        <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Menunggu</option>
                        <option value="confirmed" {{ request('status') === 'confirmed' ? 'selected' : '' }}>Dikonfirmasi</option>
                        <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                    </select>
                </div>
                <div class="md:col-span-2">
                    <label class="block text-sm font-semibold text-gray-900 mb-2">Pencarian</label>
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari kode, nama peserta, atau email..."
                        class="w-full px-4 py-2 rounded-lg border border-gray-300 text-sm focus:ring-2 focus:ring-emerald-500">
                </div>
            </div>
            <div class="flex justify-end gap-2 pt-3 border-t border-gray-100">
                <a href="{{ route('qurban.registrations.index') }}" class="px-5 py-2 bg-gray-100 text-gray-700 text-sm font-semibold rounded-lg hover:bg-gray-200 transition-all">
                    Reset Filter
                </a>
                <button type="submit" class="px-5 py-2 bg-emerald-600 text-white text-sm font-semibold rounded-lg hover:bg-emerald-700 transition-all flex items-center gap-2">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                    Terapkan Filter
                </button>
            </div>
        </form>
    </div>

    <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden shadow-sm">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Kode / Peserta</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Hewan</th>
                        <th class="px-6 py-3 text-right text-xs font-semibold text-gray-500 uppercase tracking-wider">Total Bayar</th>
                        <th class="px-6 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">Konfirmasi</th>
                        <th class="px-6 py-3 text-center text-xs font-semibold text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-100">
                    @forelse($registrations as $reg)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4">
                            <div class="flex flex-col">
                                <span class="font-mono text-xs font-bold text-gray-900">{{ $reg->kode_registrasi }}</span>
                                <span class="text-sm font-semibold text-gray-900 mt-1">{{ $reg->nama_peserta }}</span>
                                <span class="text-xs text-gray-500">{{ $reg->created_at->format('d M Y, H:i') }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex flex-col">
                                <span class="text-sm font-medium text-gray-900">{{ $reg->hewan?->nama ?? '-' }}</span>
                                <span class="text-xs text-gray-500">{{ $reg->jumlah_slot }} Slot</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-right">
                            <span class="text-sm font-bold text-gray-900">Rp {{ number_format($reg->total_bayar, 0, ',', '.') }}</span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            @php
                            $statusColors = [
                                'pending' => 'bg-yellow-100 text-yellow-700',
                                'confirmed' => 'bg-emerald-100 text-emerald-700',
                                'cancelled' => 'bg-red-100 text-red-700',
                            ];
                            @endphp
                            <span class="inline-flex px-3 py-1 rounded-full text-xs font-bold {{ $statusColors[$reg->status] ?? 'bg-gray-100 text-gray-700' }}">
                                {{ $reg->status_label }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-center">
                            @if($reg->paymentConfirmation)
                            <span class="inline-flex items-center gap-1 text-xs text-emerald-600 font-bold">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                </svg>
                                Ada Bukti
                            </span>
                            @else
                            <span class="text-xs text-gray-400">Belum Ada</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center">
                            <a href="{{ route('qurban.registrations.show', $reg) }}"
                                class="inline-flex items-center px-3 py-1.5 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-bold rounded-lg transition-all">
                                Detail
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-12 text-center text-gray-400">
                            <p class="font-medium">Tidak ada data pendaftaran</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($registrations->hasPages())
        <div class="px-6 py-4 border-t border-gray-100">
            {{ $registrations->links() }}
        </div>
        @endif
    </div>

</x-layouts::app>
