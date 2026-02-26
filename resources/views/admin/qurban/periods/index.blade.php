<x-layouts::app :title="__('Periode Qurban')">

    <div class="flex items-center justify-between mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Periode Qurban</h1>
            <p class="text-sm text-gray-500 mt-1">Kelola periode / tahun penyelenggaraan qurban</p>
        </div>
        <a href="{{ route('qurban.periods.create') }}"
           class="inline-flex items-center gap-2 px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold rounded-xl transition-all shadow-sm">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Tambah Periode
        </a>
    </div>

    @if(session('success'))
    <div class="mb-5 p-4 bg-emerald-50 border border-emerald-200 rounded-xl text-emerald-700 text-sm flex items-center gap-2">
        <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
        {{ session('success') }}
    </div>
    @endif

    @if(session('error'))
    <div class="mb-5 p-4 bg-red-50 border border-red-200 rounded-xl text-red-700 text-sm">{{ session('error') }}</div>
    @endif

    <div class="space-y-4">
        @forelse($periods as $period)
        <div class="bg-white rounded-2xl border {{ $period->is_active ? 'border-emerald-300 ring-2 ring-emerald-100' : 'border-gray-200' }} p-6">
            <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">

                {{-- Info --}}
                <div class="flex-1">
                    <div class="flex items-center gap-3 mb-2">
                        <h3 class="font-bold text-gray-900 text-lg">{{ $period->nama }}</h3>
                        @if($period->is_active)
                        <span class="inline-flex items-center gap-1 px-2.5 py-0.5 bg-emerald-100 text-emerald-700 text-xs font-bold rounded-full">
                            <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full animate-pulse"></span>
                            AKTIF
                        </span>
                        @endif
                    </div>

                    <div class="flex flex-wrap gap-4 text-sm text-gray-500 mb-4">
                        @if($period->tanggal_buka)
                        <span class="flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                            Buka: {{ $period->tanggal_buka->format('d M Y') }}
                        </span>
                        @endif
                        @if($period->tanggal_tutup)
                        <span class="flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                            Tutup: {{ $period->tanggal_tutup->format('d M Y') }}
                        </span>
                        @endif
                        @if($period->tanggal_pelaksanaan)
                        <span class="flex items-center gap-1.5">
                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"/></svg>
                            Penyembelihan: {{ $period->tanggal_pelaksanaan->format('d M Y') }}
                        </span>
                        @endif
                    </div>

                    {{-- Stats --}}
                    <div class="flex gap-6">
                        <div>
                            <p class="text-xs text-gray-400">Terkonfirmasi</p>
                            <p class="font-bold text-emerald-600">{{ number_format($period->confirmed_count ?? 0) }} peserta</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400">Menunggu</p>
                            <p class="font-bold text-yellow-600">{{ number_format($period->pending_count ?? 0) }} peserta</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400">Dana Masuk</p>
                            <p class="font-bold text-blue-600">Rp {{ number_format($period->total_terkumpul ?? 0, 0, ',', '.') }}</p>
                        </div>
                    </div>
                </div>

                {{-- Actions --}}
                <div class="flex items-center gap-2 flex-shrink-0">
                    {{-- Toggle Aktif --}}
                    <form action="{{ route('qurban.periods.toggle-active', $period) }}" method="POST">
                        @csrf @method('PATCH')
                        <button type="submit"
                                class="px-3 py-2 text-xs font-semibold rounded-lg border transition-all
                                    {{ $period->is_active
                                        ? 'bg-emerald-50 text-emerald-700 border-emerald-200 hover:bg-emerald-100'
                                        : 'bg-gray-50 text-gray-600 border-gray-200 hover:bg-gray-100' }}">
                            {{ $period->is_active ? '✓ Aktif' : 'Nonaktif' }}
                        </button>
                    </form>

                    {{-- Lihat Hewan --}}
                    <a href="{{ route('qurban.binatang.index', ['period_id' => $period->id]) }}"
                       class="px-3 py-2 text-xs font-semibold rounded-lg bg-blue-50 text-blue-700 border border-blue-200 hover:bg-blue-100 transition-all">
                        Kelola Hewan
                    </a>

                    {{-- Edit --}}
                    <a href="{{ route('qurban.periods.edit', $period) }}"
                       class="p-2 text-gray-400 hover:text-emerald-600 hover:bg-emerald-50 rounded-lg transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                    </a>

                    {{-- Hapus --}}
                    <form action="{{ route('qurban.periods.destroy', $period) }}" method="POST"
                          onsubmit="return confirm('Hapus periode {{ addslashes($period->nama) }}?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="p-2 text-gray-400 hover:text-red-600 hover:bg-red-50 rounded-lg transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
        @empty
        <div class="bg-white rounded-2xl border border-gray-200 p-12 text-center">
            <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <span class="text-3xl">🐄</span>
            </div>
            <p class="font-semibold text-gray-700 mb-1">Belum ada periode qurban</p>
            <p class="text-sm text-gray-400 mb-4">Buat periode qurban pertama untuk mulai menerima pendaftaran</p>
            <a href="{{ route('qurban.periods.create') }}"
               class="inline-flex items-center gap-2 px-5 py-2.5 bg-emerald-600 text-white text-sm font-semibold rounded-xl hover:bg-emerald-700 transition-all">
                Buat Periode Pertama
            </a>
        </div>
        @endforelse
    </div>

    @if($periods->hasPages())
    <div class="mt-5">{{ $periods->links() }}</div>
    @endif

</x-layouts::app>
