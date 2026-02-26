<x-layouts::app :title="__('Daftar binatang Qurban')">

    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">binatang Qurban</h1>
            <p class="text-sm text-gray-500 mt-1">Kelola binatang qurban per periode</p>
        </div>
        <a href="{{ route('qurban.binatang.create', request()->only('period_id')) }}"
            class="inline-flex items-center gap-2 px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold rounded-xl transition-all shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Tambah binatang
        </a>
    </div>

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
        <form method="GET" action="{{ route('qurban.binatang.index') }}" class="flex flex-wrap gap-3 items-end">
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Periode</label>
                <select name="period_id" class="px-3 py-2 rounded-lg border border-gray-300 text-sm focus:ring-2 focus:ring-emerald-500">
                    <option value="">Semua Periode</option>
                    @foreach($periods as $p)
                    <option value="{{ $p->id }}" {{ request('period_id') == $p->id ? 'selected' : '' }}>
                        {{ $p->nama }} {{ $p->is_active ? '(Aktif)' : '' }}
                    </option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-xs font-medium text-gray-600 mb-1">Jenis binatang</label>
                <select name="jenis" class="px-3 py-2 rounded-lg border border-gray-300 text-sm focus:ring-2 focus:ring-emerald-500">
                    <option value="">Semua Jenis</option>
                    @foreach(['sapi' => '🐄 Sapi', 'unta' => '🐪 Unta', 'kambing' => '🐐 Kambing', 'domba' => '🐑 Domba'] as $val => $label)
                    <option value="{{ $val }}" {{ request('jenis') === $val ? 'selected' : '' }}>{{ $label }}</option>
                    @endforeach
                </select>
            </div>
            <div class="flex gap-2">
                <button type="submit" class="px-4 py-2 bg-emerald-600 text-white text-sm font-semibold rounded-lg hover:bg-emerald-700 transition-all">Filter</button>
                <a href="{{ route('qurban.binatang.index') }}" class="px-4 py-2 bg-gray-100 text-gray-700 text-sm font-semibold rounded-lg hover:bg-gray-200 transition-all">Reset</a>
            </div>
        </form>
    </div>

    {{-- Grid binatang --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-5">
        @forelse($hewan as $h)
        @php
        $slotTerisi = $h->slot_active ?? 0;
        $slotTersedia = max(0, $h->max_peserta - $slotTerisi);
        $persen = $h->max_peserta > 0 ? round(($slotTerisi / $h->max_peserta) * 100) : 0;
        $isPenuh = $slotTersedia <= 0;
            @endphp
            <div class="bg-white rounded-2xl border {{ $isPenuh ? 'border-red-200' : ($h->is_active ? 'border-gray-200' : 'border-gray-100 opacity-60') }} overflow-hidden">

            {{-- Gambar --}}
            <div class="relative h-40 bg-gray-100">
                <img src="{{ $h->gambar_url }}"
                    alt="{{ $h->nama }}"
                    class="w-full h-full object-cover">

                {{-- Badge Jenis --}}
                <div class="absolute top-3 left-3">
                    <span class="px-2.5 py-1 bg-white/90 backdrop-blur-sm text-gray-800 text-xs font-bold rounded-full shadow-sm">
                        {{ $h->jenis_label }}
                    </span>
                </div>

                {{-- Status Slot --}}
                <div class="absolute top-3 right-3">
                    @if($isPenuh)
                    <span class="px-2.5 py-1 bg-red-500 text-white text-xs font-bold rounded-full">PENUH</span>
                    @elseif($slotTersedia === 1 && $h->is_patungan)
                    <span class="px-2.5 py-1 bg-orange-400 text-white text-xs font-bold rounded-full">1 Slot!</span>
                    @endif
                </div>

                @if(! $h->is_active)
                <div class="absolute inset-0 bg-gray-900/40 flex items-center justify-center">
                    <span class="px-3 py-1.5 bg-gray-800/80 text-white text-sm font-semibold rounded-lg">Nonaktif</span>
                </div>
                @endif
            </div>

            {{-- Content --}}
            <div class="p-5">
                <h3 class="font-bold text-gray-900 mb-1 truncate">{{ $h->nama }}</h3>
                <p class="text-xs text-gray-400 mb-1">{{ $h->period->nama }}</p>
                @if($h->berat_estimasi)
                <p class="text-xs text-gray-500 mb-3">Berat: {{ $h->berat_estimasi }}</p>
                @endif

                {{-- Harga --}}
                <div class="flex justify-between items-baseline mb-4">
                    <div>
                        <p class="text-xs text-gray-400">
                            {{ $h->is_patungan ? 'Per Slot (1/'. $h->max_peserta .')' : 'Harga' }}
                        </p>
                        <p class="font-bold text-emerald-600 text-lg">{{ $h->harga_per_slot_format }}</p>
                    </div>
                    @if($h->is_patungan)
                    <div class="text-right">
                        <p class="text-xs text-gray-400">Total binatang</p>
                        <p class="text-sm font-semibold text-gray-600">{{ $h->harga_total_format }}</p>
                    </div>
                    @endif
                </div>

                {{-- Progress Slot --}}
                @if($h->is_patungan)
                <div class="mb-4">
                    <div class="flex justify-between text-xs text-gray-500 mb-1.5">
                        <span>Slot Terisi</span>
                        <span class="font-semibold">{{ $slotTerisi }} / {{ $h->max_peserta }}</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-2.5 overflow-hidden">
                        <div class="h-2.5 rounded-full transition-all
                            {{ $isPenuh ? 'bg-red-500' : ($persen >= 71 ? 'bg-orange-400' : 'bg-emerald-500') }}"
                            style="width: {{ $persen }}%">
                        </div>
                    </div>
                    {{-- Detail slot: pending vs confirmed --}}
                    <div class="flex gap-3 mt-1.5 text-xs text-gray-400">
                        <span>✅ {{ $h->slot_confirmed ?? 0 }} konfirmasi</span>
                        <span>⏳ {{ $h->slot_pending ?? 0 }} pending</span>
                    </div>
                </div>
                @else
                {{-- Kambing: terisi/tidak --}}
                <div class="mb-4 p-2.5 rounded-lg text-xs text-center font-semibold
                    {{ $isPenuh ? 'bg-red-50 text-red-600 border border-red-200' : 'bg-emerald-50 text-emerald-600 border border-emerald-200' }}">
                    {{ $isPenuh ? 'Sudah Ada Pendaftar' : 'Tersedia' }}
                </div>
                @endif

                {{-- Stats --}}
                <div class="flex justify-between text-xs text-gray-500 mb-4">
                    <span>Terkumpul: <strong>Rp {{ number_format($h->terkumpul ?? 0, 0, ',', '.') }}</strong></span>
                </div>

                {{-- Actions --}}
                <div class="flex gap-2">
                    <form action="{{ route('qurban.hewan.toggle-active', $h) }}" method="POST" class="flex-1">
                        @csrf @method('PATCH')
                        <button type="submit"
                            class="w-full py-2 text-xs font-semibold rounded-lg border transition-all
                                    {{ $h->is_active ? 'bg-emerald-50 text-emerald-700 border-emerald-200 hover:bg-emerald-100' : 'bg-gray-50 text-gray-600 border-gray-200 hover:bg-gray-100' }}">
                            {{ $h->is_active ? '✓ Aktif' : 'Nonaktif' }}
                        </button>
                    </form>
                    <a href="{{ route('qurban.binatang.edit', $h) }}"
                        class="flex-1 py-2 text-xs font-semibold rounded-lg border border-gray-200 bg-gray-50 text-gray-700 hover:bg-gray-100 transition-all text-center">
                        Edit
                    </a>
                    <form action="{{ route('qurban.binatang.destroy', $h) }}" method="POST"
                        onsubmit="return confirm('Hapus binatang ini?')">
                        @csrf @method('DELETE')
                        <button type="submit"
                            class="py-2 px-3 text-xs font-semibold rounded-lg border border-red-200 bg-red-50 text-red-600 hover:bg-red-100 transition-all">
                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
    </div>
    @empty
    <div class="sm:col-span-2 xl:col-span-3 bg-white rounded-2xl border border-gray-200 p-12 text-center">
        <span class="text-5xl block mb-4">🐄</span>
        <p class="font-semibold text-gray-700 mb-1">Belum ada binatang terdaftar</p>
        <p class="text-sm text-gray-400 mb-4">Tambahkan binatang qurban untuk periode ini</p>
        <a href="{{ route('qurban.binatang.create') }}"
            class="inline-flex items-center gap-2 px-5 py-2.5 bg-emerald-600 text-white text-sm font-semibold rounded-xl hover:bg-emerald-700 transition-all">
            Tambah binatang Pertama
        </a>
    </div>
    @endforelse
    </div>

    @if($hewan->hasPages())
    <div class="mt-5">{{ $binatang->links() }}</div>
    @endif

</x-layouts::app>