<x-layouts::app :title="isset($period) ? __('Edit Periode Qurban') : __('Tambah Periode Qurban')">

    <div class="mb-6 flex items-center gap-3">
        <a href="{{ route('qurban.periods.index') }}"
           class="p-2 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-lg transition-all">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
        </a>
        <div>
            <h1 class="text-2xl font-bold text-gray-900">
                {{ isset($period) ? 'Edit Periode Qurban' : 'Tambah Periode Qurban' }}
            </h1>
            <p class="text-sm text-gray-500 mt-0.5">Pengaturan tahun / event penyelenggaraan qurban</p>
        </div>
    </div>

    <div class="max-w-2xl">
        <form action="{{ isset($period) ? route('qurban.periods.update', $period) : route('qurban.periods.store') }}"
              method="POST"
              class="space-y-5">
            @csrf
            @if(isset($period)) @method('PUT') @endif

            @if($errors->any())
            <div class="p-4 bg-red-50 border border-red-200 rounded-xl text-red-600 text-sm">
                <ul class="list-disc list-inside space-y-1">
                    @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                </ul>
            </div>
            @endif

            {{-- Informasi Dasar --}}
            <div class="bg-white rounded-2xl border border-gray-200 p-6 space-y-4">
                <h3 class="font-semibold text-gray-900">Informasi Periode</h3>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">
                        Nama Periode <span class="text-red-500">*</span>
                    </label>
                    <input type="text" name="nama"
                           value="{{ old('nama', $period->nama ?? '') }}"
                           placeholder="Contoh: Qurban Idul Adha 1446 H / 2025 M"
                           class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-emerald-500 focus:border-emerald-500 @error('nama') border-red-500 @enderror">
                    @error('nama')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">
                        Tahun <span class="text-red-500">*</span>
                    </label>
                    <input type="number" name="tahun"
                           value="{{ old('tahun', $period->tahun ?? now()->year) }}"
                           min="2020" max="2100"
                           class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-emerald-500 @error('tahun') border-red-500 @enderror">
                    @error('tahun')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700 mb-1.5">Deskripsi</label>
                    <textarea name="deskripsi" rows="3"
                              placeholder="Informasi umum tentang qurban periode ini..."
                              class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-emerald-500 resize-none">{{ old('deskripsi', $period->deskripsi ?? '') }}</textarea>
                </div>
            </div>

            {{-- Jadwal --}}
            <div class="bg-white rounded-2xl border border-gray-200 p-6 space-y-4">
                <h3 class="font-semibold text-gray-900">Jadwal</h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Tanggal Buka Pendaftaran</label>
                        <input type="date" name="tanggal_buka"
                               value="{{ old('tanggal_buka', isset($period->tanggal_buka) ? $period->tanggal_buka->format('Y-m-d') : '') }}"
                               class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-emerald-500">
                        <p class="text-xs text-gray-400 mt-1">Kosongkan = langsung buka</p>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Tanggal Tutup Pendaftaran</label>
                        <input type="date" name="tanggal_tutup"
                               value="{{ old('tanggal_tutup', isset($period->tanggal_tutup) ? $period->tanggal_tutup->format('Y-m-d') : '') }}"
                               class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-emerald-500 @error('tanggal_tutup') border-red-500 @enderror">
                        @error('tanggal_tutup')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
                    </div>
                    <div class="sm:col-span-2">
                        <label class="block text-sm font-medium text-gray-700 mb-1.5">Tanggal Pelaksanaan (Penyembelihan)</label>
                        <input type="date" name="tanggal_pelaksanaan"
                               value="{{ old('tanggal_pelaksanaan', isset($period->tanggal_pelaksanaan) ? $period->tanggal_pelaksanaan->format('Y-m-d') : '') }}"
                               class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-emerald-500">
                    </div>
                </div>
            </div>

            {{-- Status --}}
            <div class="bg-white rounded-2xl border border-gray-200 p-6">
                <h3 class="font-semibold text-gray-900 mb-4">Status</h3>
                <label class="flex items-start gap-4 cursor-pointer">
                    <div class="relative mt-0.5">
                        <input type="hidden" name="is_active" value="0">
                        <input type="checkbox" name="is_active" value="1" class="sr-only peer"
                               {{ old('is_active', $period->is_active ?? false) ? 'checked' : '' }}>
                        <div class="w-11 h-6 bg-gray-200 peer-focus:ring-2 peer-focus:ring-emerald-500 rounded-full peer peer-checked:bg-emerald-600 transition-all"></div>
                        <div class="absolute left-1 top-1 w-4 h-4 bg-white rounded-full shadow peer-checked:translate-x-5 transition-all"></div>
                    </div>
                    <div>
                        <p class="text-sm font-semibold text-gray-700">Periode Aktif</p>
                        <p class="text-xs text-gray-400 mt-0.5">
                            Hanya 1 periode yang bisa aktif sekaligus. Mengaktifkan ini akan menonaktifkan periode lain secara otomatis.
                        </p>
                    </div>
                </label>
            </div>

            <div class="flex gap-3">
                <a href="{{ route('qurban.periods.index') }}"
                   class="flex-1 py-3 border-2 border-gray-300 text-gray-700 text-sm font-semibold rounded-xl text-center hover:bg-gray-50 transition-all">
                    Batal
                </a>
                <button type="submit"
                        class="flex-1 py-3 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold rounded-xl transition-all shadow-sm">
                    {{ isset($period) ? 'Simpan Perubahan' : 'Buat Periode' }}
                </button>
            </div>
        </form>
    </div>

</x-layouts::app>
