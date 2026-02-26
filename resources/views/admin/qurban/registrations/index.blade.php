{{-- FILE: resources/views/admin/qurban/registrations/index.blade.php --}}
<x-layouts::app :title="__('Pendaftaran Qurban')">

    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Pendaftaran Qurban</h1>
            <p class="text-sm text-gray-500 mt-1">Semua peserta yang mendaftar qurban</p>
        </div>
        <a href="{{ route('qurban.registrations.export', request()->query()) }}"
            class="inline-flex items-center gap-2 px-4 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-semibold rounded-xl transition-all">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
            Export CSV
        </a>
    </div>

    {{-- Stats --}}
    @if($stats)
    <div class="grid grid-cols-3 gap-4 mb-6">
        <div class="bg-white rounded-2xl border border-gray-200 p-5 text-center">
            <p class="text-xs text-gray-500 mb-1">Menunggu Konfirmasi</p>
            <p class="text-2xl font-bold text-yellow-600">{{ $stats['total_pending'] }}</p>
        </div>
        <div class="bg-white rounded-2xl border border-gray-200 p-5 text-center">
            <p class="text-xs text-gray-500 mb-1">Terkonfirmasi</p>
            <p class="text-2xl font-bold text-emerald-600">{{ $stats['total_confirmed'] }}</p>
        </div>
        <div class="bg-white rounded-2xl border border-gray-200 p-5 text-center">
            <p class="text-xs text-gray-500 mb-1">Dana Terkumpul</p>
            <p class="text-lg font-bold text-blue-600">Rp {{ number_format($stats['total_nominal'], 0, ',', '.') }}</p>
        </div>
    </div>
    @endif

    {{-- Filter --}}
    <div class="bg-white rounded-2xl border border-gray-200 p-4 mb-5">
        <form method="GET" action="{{ route('qurban.registrations.index') }}" class="flex flex-wrap gap-3 items-end">
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Periode</label>
                <select name="period_id" class="px-3 py-2 rounded-lg border border-gray-300 text-sm focus:ring-2 focus:ring-emerald-500">
                    <option value="">Semua</option>
                    @foreach($periods as $p)
                    <option value="{{ $p->id }}" {{ request('period_id') == $p->id ? 'selected' : '' }}>
                        {{ $p->nama }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Status</label>
                <select name="status" class="px-3 py-2 rounded-lg border border-gray-300 text-sm focus:ring-2 focus:ring-emerald-500">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Menunggu</option>
                    <option value="confirmed" {{ request('status') === 'confirmed' ? 'selected' : '' }}>Terkonfirmasi</option>
                    <option value="cancelled" {{ request('status') === 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                </select>
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Jenis Hewan</label>
                <select name="jenis" class="px-3 py-2 rounded-lg border border-gray-300 text-sm focus:ring-2 focus:ring-emerald-500">
                    <option value="">Semua Jenis</option>
                    @foreach(['sapi' => 'Sapi', 'unta' => 'Unta', 'kambing' => 'Kambing', 'domba' => 'Domba'] as $val => $label)
                    <option value="{{ $val }}" {{ request('jenis') === $val ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Cari</label>
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Kode / Nama / Telepon"
                    class="px-3 py-2 rounded-lg border border-gray-300 text-sm focus:ring-2 focus:ring-emerald-500 w-48">
            </div>
            <div class="flex gap-2">
                <button type="submit" class="px-4 py-2 bg-emerald-600 text-white text-sm font-semibold rounded-lg hover:bg-emerald-700 transition-all">Filter</button>
                <a href="{{ route('qurban.registrations.index') }}" class="px-4 py-2 bg-gray-100 text-gray-700 text-sm font-semibold rounded-lg hover:bg-gray-200 transition-all">Reset</a>
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
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Peserta</th>
                        <th class="px-5 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Hewan</th>
                        <th class="px-5 py-3 text-right text-xs font-semibold text-gray-500 uppercase">Total Bayar</th>
                        <th class="px-5 py-3 text-center text-xs font-semibold text-gray-500 uppercase">Bukti</th>
                        <th class="px-5 py-3 text-center text-xs font-semibold text-gray-500 uppercase">Status</th>
                        <th class="px-5 py-3 text-center text-xs font-semibold text-gray-500 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse($registrations as $reg)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-5 py-4">
                            <p class="font-mono text-xs font-semibold text-gray-900">{{ $reg->kode_registrasi }}</p>
                            <p class="text-xs text-gray-400 mt-0.5">{{ $reg->created_at->format('d M Y, H:i') }}</p>
                        </td>
                        <td class="px-5 py-4">
                            <p class="text-sm font-semibold text-gray-900">{{ $reg->nama_peserta }}</p>
                            @if($reg->atas_nama)
                            <p class="text-xs text-gray-500">a.n: {{ $reg->atas_nama }}</p>
                            @endif
                            @if($reg->telepon)
                            <a href="https://wa.me/62{{ ltrim($reg->telepon, '0') }}" target="_blank"
                                class="text-xs text-emerald-600 hover:underline">{{ $reg->telepon }}</a>
                            @endif
                        </td>
                        <td class="px-5 py-4">
                            <p class="text-sm font-semibold text-gray-900">
                                {{ $reg->hewan?->nama }}
                            </p>
                            <p class="text-xs text-gray-400">{{ $reg->hewan?->jenis_label }}</p>
                        </td>
                        <td class="px-5 py-4 text-right">
                            <p class="font-bold text-gray-900 text-sm">{{ $reg->total_bayar_format }}</p>
                        </td>
                        <td class="px-5 py-4 text-center">
                            @if($reg->paymentConfirmation)
                            <span class="text-xs text-emerald-600 font-semibold">Ada</span>
                            @else
                            <span class="text-xs text-gray-400">Belum</span>
                            @endif
                        </td>
                        <td class="px-5 py-4 text-center">
                            @php
                            $badgeColor = [
                            'pending' => 'bg-yellow-100 text-yellow-700',
                            'confirmed' => 'bg-emerald-100 text-emerald-700',
                            'cancelled' => 'bg-red-100 text-red-700',
                            ][$reg->status] ?? 'bg-gray-100 text-gray-700';
                            @endphp
                            <span class="px-2.5 py-1 rounded-full text-xs font-semibold {{ $badgeColor }}">
                                {{ $reg->status_label }}
                            </span>
                        </td>
                        <td class="px-5 py-4 text-center">
                            <a href="{{ route('qurban.registrations.show', $reg) }}"
                                class="inline-flex items-center gap-1 px-3 py-1.5 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-semibold rounded-lg transition-all">
                                Detail
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-5 py-12 text-center text-gray-400">
                            <span class="text-4xl block mb-3">📋</span>
                            <p class="font-medium">Belum ada pendaftaran</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($registrations->hasPages())
        <div class="px-5 py-4 border-t border-gray-100">{{ $registrations->links() }}</div>
        @endif
    </div>

</x-layouts::app>