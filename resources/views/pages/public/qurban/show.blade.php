{{-- FILE: resources/views/public/qurban/show.blade.php --}}
@extends('layouts.public.app')
@section('title', $hewan->nama . ' - Qurban LAZIZNU')
@section('content')

{{-- Breadcrumb --}}
<div class="bg-white border-b border-gray-100">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 py-3">
        <nav class="flex items-center gap-2 text-sm text-gray-500">
            <a href="/" class="hover:text-gray-700">Beranda</a>
            <span>/</span>
            <a href="{{ route('qurban.index') }}" class="hover:text-gray-700">Qurban</a>
            <span>/</span>
            <span class="text-gray-900 font-medium truncate">{{ $hewan->nama }}</span>
        </nav>
    </div>
</div>

<div class="bg-gray-50 py-12 sm:py-16">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 lg:grid-cols-5 gap-8">

            {{-- LEFT: Detail Hewan ───────────────────────────────────── --}}
            <div class="lg:col-span-3 space-y-5">

                {{-- Gambar + Slot --}}
                <div class="bg-white rounded-3xl border border-gray-200 overflow-hidden shadow-sm">
                    <div class="relative h-64 sm:h-80 overflow-hidden">
                        <img src="{{ $hewan->gambar_url }}"
                            alt="{{ $hewan->nama }}"
                            class="w-full h-full object-cover">
                        <div class="absolute top-4 left-4">
                            <span class="px-3 py-1.5 bg-white/90 backdrop-blur-sm text-gray-900 font-bold text-sm rounded-full shadow-sm">
                                {{ $hewan->jenis_icon }} {{ $hewan->jenis_label }}
                            </span>
                        </div>
                    </div>

                    <div class="p-6">
                        <div class="flex justify-between items-start mb-2">
                            <h1 class="text-2xl font-bold text-gray-900">{{ $hewan->nama }}</h1>
                            @if($hewan->berat_estimasi)
                            <span class="ml-3 text-sm text-gray-500 bg-gray-100 px-3 py-1 rounded-full flex-shrink-0">
                                {{ $hewan->berat_estimasi }}
                            </span>
                            @endif
                        </div>

                        <p class="text-sm text-gray-500 mb-5">{{ $hewan->period->nama }}</p>

                        {{-- Harga --}}
                        @if($hewan->is_patungan)
                        <div class="grid grid-cols-2 gap-3 p-4 bg-emerald-50 rounded-2xl border border-emerald-100 mb-5">
                            <div>
                                <p class="text-xs text-emerald-700 font-medium mb-1">Harga per Slot (1/7)</p>
                                <p class="text-2xl font-bold text-emerald-600">{{ $hewan->harga_per_slot_format }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-xs text-gray-500 font-medium mb-1">Total 1 Ekor</p>
                                <p class="text-lg font-bold text-gray-700">{{ $hewan->harga_total_format }}</p>
                            </div>
                        </div>
                        @else
                        <div class="p-4 bg-emerald-50 rounded-2xl border border-emerald-100 mb-5">
                            <p class="text-xs text-emerald-700 font-medium mb-1">Harga (1 ekor penuh)</p>
                            <p class="text-2xl font-bold text-emerald-600">{{ $hewan->harga_per_slot_format }}</p>
                        </div>
                        @endif

                        {{-- Deskripsi --}}
                        @if($hewan->deskripsi)
                        <p class="text-gray-600 text-sm leading-relaxed">{{ $hewan->deskripsi }}</p>
                        @endif
                    </div>
                </div>

                {{-- Slot Progress (hanya patungan) --}}
                @if($hewan->is_patungan)
                <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm">
                    <h2 class="font-bold text-gray-900 mb-4">Status Slot Qurban Ini</h2>

                    @php
                    $slotTerisi = $summary['slot_terisi'];
                    $slotTersedia = $summary['slot_tersedia'];
                    $maxPeserta = $summary['max_peserta'];
                    $isPenuh = $summary['is_penuh'];
                    $persen = $maxPeserta > 0 ? round(($slotTerisi / $maxPeserta) * 100) : 0;
                    @endphp

                    {{-- Visual slots --}}
                    <div class="flex gap-2 mb-4">
                        @for($i = 1; $i <= $maxPeserta; $i++)
                            @php
                            $confirmed=$summary['confirmed'];
                            $pending=$summary['pending'];
                            if ($i <=$confirmed) $slotClass='bg-emerald-500' ;
                            elseif ($i <=$confirmed + $pending) $slotClass='bg-yellow-400' ;
                            else $slotClass='bg-gray-200' ;
                            @endphp
                            <div class="flex-1 flex flex-col items-center gap-1.5">
                            <div class="w-full h-8 rounded-lg {{ $slotClass }} transition-all
                                {{ $slotClass === 'bg-gray-200' ? 'border-2 border-dashed border-gray-300' : '' }}">
                            </div>
                            <span class="text-xs text-gray-400">{{ $i }}</span>
                    </div>
                    @endfor
                </div>

                <div class="flex gap-3 flex-wrap text-xs">
                    <div class="flex items-center gap-1.5">
                        <div class="w-3 h-3 bg-emerald-500 rounded"></div>
                        <span class="text-gray-600">Terkonfirmasi ({{ $summary['confirmed'] }})</span>
                    </div>
                    <div class="flex items-center gap-1.5">
                        <div class="w-3 h-3 bg-yellow-400 rounded"></div>
                        <span class="text-gray-600">Menunggu ({{ $summary['pending'] }})</span>
                    </div>
                    <div class="flex items-center gap-1.5">
                        <div class="w-3 h-3 bg-gray-200 border border-gray-300 rounded"></div>
                        <span class="text-gray-600">Tersedia ({{ $slotTersedia }})</span>
                    </div>
                </div>

                @if(!$isPenuh)
                <p class="mt-3 text-sm font-semibold
                        {{ $slotTersedia <= 1 ? 'text-orange-600' : 'text-emerald-700' }}">
                    {{ $slotTersedia === 1 ? '⚠ Hanya 1 slot tersisa! Segera daftar.' : "{$slotTersedia} slot masih tersedia." }}
                </p>
                @else
                <p class="mt-3 text-sm font-semibold text-red-600">Semua slot sudah terisi.</p>
                @endif
            </div>
            @endif

            {{-- Peserta terdaftar --}}
            @if($pesertaTerdaftar->isNotEmpty())
            <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm">
                <h2 class="font-bold text-gray-900 mb-4">
                    Peserta Terdaftar
                    <span class="ml-2 text-sm font-normal text-gray-400">({{ $pesertaTerdaftar->count() }} orang)</span>
                </h2>
                <div class="space-y-2">
                    @foreach($pesertaTerdaftar as $peserta)
                    <div class="flex items-center gap-3 py-2 border-b border-gray-50 last:border-0">
                        <div class="w-8 h-8 bg-gradient-to-br
                                {{ $peserta->status === 'confirmed' ? 'from-emerald-400 to-emerald-600' : 'from-yellow-300 to-yellow-500' }}
                                rounded-full flex items-center justify-center text-white text-xs font-bold flex-shrink-0">
                            {{ strtoupper(substr($peserta->nama_tampil, 0, 1)) }}
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-gray-900 truncate">{{ $peserta->nama_tampil }}</p>
                        </div>
                        <span class="text-xs px-2 py-0.5 rounded-full flex-shrink-0
                                {{ $peserta->status === 'confirmed' ? 'bg-emerald-100 text-emerald-700' : 'bg-yellow-100 text-yellow-700' }}">
                            {{ $peserta->status === 'confirmed' ? '✓ Lunas' : 'Proses' }}
                        </span>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

        </div>

        {{-- RIGHT: Form Daftar ───────────────────────────────────── --}}
        <div class="lg:col-span-2">
            <div class="sticky top-6">

                @if(!$hewan->is_active || !$hewan->period->is_open)
                {{-- Tidak aktif --}}
                <div class="bg-white rounded-3xl border border-gray-200 p-8 text-center shadow-sm">
                    <span class="text-4xl block mb-3">🔒</span>
                    <h3 class="font-bold text-gray-900 mb-2">Pendaftaran Ditutup</h3>
                    <p class="text-sm text-gray-500">Hewan ini tidak tersedia atau pendaftaran periode ini sudah ditutup.</p>
                    <a href="{{ route('qurban.index') }}" class="mt-4 inline-block text-sm text-emerald-600 hover:underline">
                        Lihat hewan lainnya →
                    </a>
                </div>

                @elseif($summary['is_penuh'])
                {{-- Penuh --}}
                <div class="bg-white rounded-3xl border border-red-200 p-8 text-center shadow-sm">
                    <span class="text-4xl block mb-3">😔</span>
                    <h3 class="font-bold text-gray-900 mb-2">Slot Penuh</h3>
                    <p class="text-sm text-gray-500 mb-4">Semua slot untuk hewan ini sudah terisi. Silakan pilih hewan lain.</p>
                    <a href="{{ route('qurban.index') }}"
                        class="block w-full py-3 bg-amber-500 hover:bg-amber-600 text-white font-bold rounded-xl transition-all text-center">
                        Pilih Hewan Lain
                    </a>
                </div>

                @else
                {{-- Form Pendaftaran --}}
                <div class="bg-white rounded-3xl border border-gray-200 p-6 shadow-sm">

                    {{-- Ringkasan biaya --}}
                    <div class="mb-6 p-4 bg-gray-50 rounded-2xl border border-gray-100">
                        <div class="flex justify-between items-center text-sm mb-2">
                            <span class="text-gray-600">Jenis Hewan</span>
                            <span class="font-semibold">{{ $hewan->jenis_icon }} {{ $hewan->jenis_label }}</span>
                        </div>
                        @if($hewan->is_patungan)
                        <div class="flex justify-between items-center text-sm mb-2">
                            <span class="text-gray-600">Slot (1 dari {{ $hewan->max_peserta }})</span>
                            <span class="font-semibold">1 slot</span>
                        </div>
                        @endif
                        <div class="flex justify-between items-center border-t border-gray-200 pt-2 mt-2">
                            <span class="font-bold text-gray-900">Yang Anda Bayar</span>
                            <span class="font-bold text-lg {{ $hewan->is_patungan ? 'text-emerald-600' : 'text-emerald-600' }}">
                                {{ $hewan->harga_per_slot_format }}
                            </span>
                        </div>
                    </div>

                    <h2 class="font-bold text-gray-900 text-lg mb-5 text-center">Formulir Pendaftaran</h2>

                    @if(session('success'))
                    <div class="mb-4 p-3 bg-emerald-50 border border-emerald-200 rounded-xl text-emerald-700 text-sm">
                        {{ session('success') }}
                    </div>
                    @endif

                    @if($errors->any())
                    <div class="mb-4 p-3 bg-red-50 border border-red-200 rounded-xl text-red-600 text-sm">
                        @foreach($errors->all() as $error)
                        <p>• {{ $error }}</p>
                        @endforeach
                    </div>
                    @endif

                    <form action="{{ route('qurban.store', $hewan) }}" method="POST" class="space-y-4">
                        @csrf

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                                Nama Pendaftar <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="nama_peserta"
                                value="{{ old('nama_peserta') }}"
                                placeholder="Nama lengkap Anda"
                                class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-amber-500 focus:border-amber-500 text-sm @error('nama_peserta') border-red-500 @enderror">
                            @error('nama_peserta')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                                Atas Nama Qurban
                                <span class="text-gray-400 font-normal">(bila berbeda)</span>
                            </label>
                            <input type="text" name="atas_nama"
                                value="{{ old('atas_nama') }}"
                                placeholder="Nama yang diniatkan untuk qurban"
                                class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-amber-500 text-sm">
                            <p class="text-xs text-gray-400 mt-1">Kosongkan jika sama dengan nama pendaftar</p>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">
                                No. WhatsApp <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="telepon"
                                value="{{ old('telepon') }}"
                                placeholder="08xxxxxxxxxx"
                                class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-amber-500 text-sm @error('telepon') border-red-500 @enderror">
                            @error('telepon')<p class="text-xs text-red-600 mt-1">{{ $message }}</p>@enderror
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Email</label>
                            <input type="email" name="email"
                                value="{{ old('email') }}"
                                placeholder="contoh@email.com"
                                class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-amber-500 text-sm">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Alamat</label>
                            <textarea name="alamat" rows="2"
                                placeholder="Alamat lengkap Anda"
                                class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-amber-500 text-sm resize-none">{{ old('alamat') }}</textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-1.5">Catatan</label>
                            <textarea name="catatan" rows="2"
                                placeholder="Catatan tambahan (opsional)"
                                class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-amber-500 text-sm resize-none">{{ old('catatan') }}</textarea>
                        </div>

                        {{-- Konfirmasi --}}
                        <div class="p-3 bg-amber-50 rounded-xl border border-amber-200 text-xs text-amber-800">
                            <p class="font-semibold mb-1">⚠ Penting:</p>
                            @if($hewan->is_patungan)
                            <p>Setelah mendaftar, Anda wajib membayar <strong>{{ $hewan->harga_per_slot_format }}</strong> untuk 1 slot patungan dalam 1×24 jam. Slot belum terjamin sampai pembayaran terkonfirmasi.</p>
                            @else
                            <p>Setelah mendaftar, Anda wajib membayar <strong>{{ $hewan->harga_per_slot_format }}</strong> untuk 1 ekor {{ $hewan->jenis_label }} dalam 1×24 jam.</p>
                            @endif
                        </div>

                        <button type="submit"
                            class="w-full py-4 {{ $hewan->is_patungan ? 'bg-emerald-600 group-hover:bg-emerald-700' : 'bg-emerald-600 hover:bg-emerald-700' }} text-white font-bold rounded-xl transition-all shadow-sm hover:shadow-md text-base">
                            Daftar Sekarang →
                        </button>
                    </form>
                </div>
                @endif

                {{-- Kembali --}}
                <a href="{{ route('qurban.index') }}"
                    class="mt-4 block text-center text-sm text-gray-500 hover:text-gray-700">
                    ← Kembali ke daftar hewan
                </a>

            </div>
        </div>

    </div>
</div>
</div>

@endsection