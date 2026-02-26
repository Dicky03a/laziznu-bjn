{{-- FILE: resources/views/public/qurban/index.blade.php --}}
@extends('layouts.public.app')
@section('title', 'Program Qurban - LAZIZNU Bojonegoro')
@section('content')

{{-- Hero --}}
<section class="relative bg-gradient-to-br from-emerald-600 to-emerald-700 py-20 sm:py-24 overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute -top-24 -left-24 w-96 h-96 bg-yellow-300 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-red-400 rounded-full blur-3xl"></div>
    </div>
    <div class="relative max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
        <div class="inline-block mb-6 px-4 py-1.5 bg-white/20 backdrop-blur-sm rounded-full border border-white/30">
            <span class="text-orange-100 text-sm font-medium">LAZIZNU Bojonegoro</span>
        </div>
        <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white tracking-tight mb-4">
            Qurban Bersama LAZIZNU
        </h1>
        @if($period)
        <p class="text-base sm:text-lg text-orange-100/90 max-w-2xl mx-auto mb-6">
            {{ $period->nama }}
        </p>
        @php $statusDaftar = $period->status_daftar; @endphp
        @if($statusDaftar === 'buka')
        <div class="inline-flex items-center gap-2 px-5 py-2 bg-white/20 backdrop-blur-sm rounded-full border border-white/30">
            <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
            <span class="text-white font-semibold text-sm">Pendaftaran Terbuka</span>
            @if($period->tanggal_tutup)
            <span class="text-orange-200 text-sm">· Tutup {{ $period->tanggal_tutup->format('d M Y') }}</span>
            @endif
        </div>
        @elseif($statusDaftar === 'belum_buka')
        <div class="inline-flex items-center gap-2 px-5 py-2 bg-white/20 backdrop-blur-sm rounded-full border border-white/30">
            <span class="text-white font-semibold text-sm">⏳ Segera Dibuka · {{ $period->tanggal_buka->format('d M Y') }}</span>
        </div>
        @else
        <div class="inline-flex items-center gap-2 px-5 py-2 bg-white/20 backdrop-blur-sm rounded-full border border-white/30">
            <span class="text-white font-semibold text-sm">🔒 Pendaftaran Ditutup</span>
        </div>
        @endif
        @else
        <p class="text-orange-100/90 max-w-2xl mx-auto">
            Belum ada program qurban yang tersedia saat ini. Silakan cek kembali nanti.
        </p>
        @endif
    </div>
</section>

{{-- Ketentuan --}}
<div class="py-8">
    <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
        <h2 class="text-center text-base font-bold text-amber-900 mb-5">Ketentuan Syar'i Qurban Iuran</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="bg-white rounded-2xl border border-amber-200 p-5 flex gap-4">
                <div>
                    <p class="font-bold text-gray-900 text-sm mb-1">Sapi & Unta — Iuran Patungan</p>
                    <p class="text-sm text-gray-600">Satu ekor sapi atau unta boleh untuk <strong>maksimal 7 orang</strong>. Setiap orang membayar 1/7 dari harga hewan.</p>
                </div>
            </div>
            <div class="bg-white rounded-2xl border border-amber-200 p-5 flex gap-4">
                <div>
                    <p class="font-bold text-gray-900 text-sm mb-1">Kambing & Domba — Perorangan</p>
                    <p class="text-sm text-gray-600">Satu ekor kambing atau domba hanya untuk <strong>1 orang</strong>. Tidak diperbolehkan iuran/patungan menurut mayoritas ulama.</p>
                </div>
            </div>
        </div>
    </div>
</div>

@if($period && ($hewanPatungan->isNotEmpty() || $hewanSendiri->isNotEmpty()))
<section class="bg-gray-50 py-16 sm:py-20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Hewan Patungan: Sapi & Unta --}}
        @if($hewanPatungan->isNotEmpty())
        <div class="mb-14">
            <div class="flex items-center gap-3 mb-7">
                <div>
                    <h2 class="text-xl font-bold text-gray-900">Sapi & Unta — Iuran Patungan</h2>
                    <p class="text-sm text-gray-500">1 ekor untuk 7 orang · Bayar per slot</p>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($hewanPatungan as $h)
                @php
                $slotTerisi = $h->slot_active ?? 0;
                $slotTersedia = max(0, $h->max_peserta - $slotTerisi);
                $isPenuh = $slotTersedia <= 0;
                    $persen=$h->max_peserta > 0 ? round(($slotTerisi / $h->max_peserta) * 100) : 0;
                    @endphp
                    <div class="group bg-white rounded-3xl shadow-sm hover:shadow-xl border border-gray-100 hover:border-amber-200 overflow-hidden transition-all duration-300 flex flex-col
                    {{ !$h->is_active ? 'opacity-60' : '' }}">

                        {{-- Gambar --}}
                        <div class="relative h-48 overflow-hidden bg-amber-50">
                            <img src="{{ $h->gambar_url }}"
                                alt="{{ $h->nama }}"
                                class="w-full h-full object-cover {{ !$isPenuh ? 'group-hover:scale-105 transition-transform duration-500' : '' }}">

                            {{-- Overlay penuh --}}
                            @if($isPenuh)
                            <div class="absolute inset-0 bg-gray-900/50 flex items-center justify-center">
                                <span class="px-4 py-2 bg-red-500 text-white font-bold text-lg rounded-full">PENUH</span>
                            </div>
                            @endif

                            {{-- Badge slot --}}
                            @if(!$isPenuh && $slotTersedia <= 2)
                                <div class="absolute top-3 right-3">
                                <span class="px-3 py-1 bg-emerald-400 text-white text-xs font-bold rounded-full animate-pulse">
                                    {{ $slotTersedia }} Slot Tersisa!
                                </span>
                        </div>
                        @endif

                        {{-- Badge jenis --}}
                        <div class="absolute top-3 left-3">
                            <span class="px-2.5 py-1 bg-white/90 text-gray-800 text-xs font-bold rounded-full">
                                {{ $h->jenis_label }}
                            </span>
                        </div>
                    </div>

                    {{-- Content --}}
                    <div class="p-5 flex flex-col flex-1">
                        <h3 class="font-bold text-gray-900 text-lg mb-1">{{ $h->nama }}</h3>
                        @if($h->berat_estimasi)
                        <p class="text-xs text-gray-400 mb-3">{{ $h->berat_estimasi }}</p>
                        @endif

                        {{-- Progress slot --}}
                        <div class="mb-4">
                            <div class="flex justify-between text-xs text-gray-500 mb-1.5">
                                <span>Slot Terisi</span>
                                <span class="font-semibold text-gray-900">{{ $slotTerisi }}/{{ $h->max_peserta }}</span>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2.5 overflow-hidden">
                                <div class="h-2.5 rounded-full transition-all
                                    {{ $isPenuh ? 'bg-red-500' : ($persen >= 71 ? 'bg-emerald-400' : 'bg-emerald-500') }}"
                                    style="width: {{ $persen }}%"></div>
                            </div>
                        </div>

                        {{-- Harga --}}
                        <div class="flex justify-between items-baseline mb-4 flex-1">
                            <div>
                                <p class="text-xs text-gray-400">Harga per slot</p>
                                <p class="text-2xl font-bold text-emerald-600">{{ $h->harga_per_slot_format }}</p>
                            </div>
                            <div class="text-right">
                                <p class="text-xs text-gray-400">1 ekor</p>
                                <p class="text-sm text-gray-500">{{ $h->harga_total_format }}</p>
                            </div>
                        </div>

                        {{-- CTA --}}
                        @if(!$isPenuh && $h->is_active && $period->is_open)
                        <a href="{{ route('qurban.show', $h) }}"
                            class="block py-3 bg-emerald-600 group-hover:bg-emerald-700 text-white font-bold rounded-xl text-center transition-all shadow-sm hover:shadow-md">
                            Daftar Qurban →
                        </a>
                        @elseif($isPenuh)
                        <div class="py-3 bg-gray-100 text-gray-400 font-bold rounded-xl text-center text-sm">
                            Slot Penuh
                        </div>
                        @else
                        <div class="py-3 bg-gray-100 text-gray-400 font-bold rounded-xl text-center text-sm">
                            Tidak Tersedia
                        </div>
                        @endif
                    </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    {{-- Hewan Perorangan: Kambing & Domba --}}
    @if($hewanSendiri->isNotEmpty())
    <div>
        <div class="flex items-center gap-3 mb-7">
            <div class="w-10 h-10 bg-emerald-100 rounded-xl flex items-center justify-center text-xl">🐐</div>
            <div>
                <h2 class="text-xl font-bold text-gray-900">Kambing & Domba — Perorangan</h2>
                <p class="text-sm text-gray-500">1 ekor untuk 1 orang · Bayar penuh</p>
            </div>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($hewanSendiri as $h)
            @php
            $slotTerisi = $h->slot_active ?? 0;
            $isPenuh = $slotTerisi >= $h->max_peserta;
            @endphp
            <div class="group bg-white rounded-3xl shadow-sm hover:shadow-xl border border-gray-100 hover:border-emerald-200 overflow-hidden transition-all duration-300 flex flex-col
                    {{ !$h->is_active ? 'opacity-60' : '' }}">

                <div class="relative h-48 overflow-hidden bg-green-50">
                    <img src="{{ $h->gambar_url }}"
                        alt="{{ $h->nama }}"
                        class="w-full h-full object-cover {{ !$isPenuh ? 'group-hover:scale-105 transition-transform duration-500' : '' }}">

                    @if($isPenuh)
                    <div class="absolute inset-0 bg-gray-900/50 flex items-center justify-center">
                        <span class="px-4 py-2 bg-red-500 text-white font-bold text-lg rounded-full">TERISI</span>
                    </div>
                    @endif

                    <div class="absolute top-3 left-3">
                        <span class="px-2.5 py-1 bg-white/90 text-gray-800 text-xs font-bold rounded-full">
                            {{ $h->jenis_icon }} {{ $h->jenis_label }}
                        </span>
                    </div>

                    @if(!$isPenuh)
                    <div class="absolute top-3 right-3">
                        <span class="px-2.5 py-1 bg-emerald-500 text-white text-xs font-bold rounded-full">
                            Tersedia
                        </span>
                    </div>
                    @endif
                </div>

                <div class="p-5 flex flex-col flex-1">
                    <h3 class="font-bold text-gray-900 text-lg mb-1">{{ $h->nama }}</h3>
                    @if($h->berat_estimasi)
                    <p class="text-xs text-gray-400 mb-3">🏋️ {{ $h->berat_estimasi }}</p>
                    @endif

                    {{-- Info 1 orang --}}
                    <div class="mb-4 p-3 bg-emerald-50 rounded-xl border border-emerald-100">
                        <p class="text-xs text-emerald-700 font-semibold text-center">
                            1 Ekor untuk 1 Orang · Tidak boleh iuran
                        </p>
                    </div>

                    <div class="flex-1">
                        <p class="text-xs text-gray-400">Harga</p>
                        <p class="text-2xl font-bold text-emerald-600 mb-4">{{ $h->harga_per_slot_format }}</p>
                    </div>

                    @if(!$isPenuh && $h->is_active && $period->is_open)
                    <a href="{{ route('qurban.show', $h) }}"
                        class="block py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl text-center transition-all shadow-sm hover:shadow-md">
                        Daftar Qurban →
                    </a>
                    @elseif($isPenuh)
                    <div class="py-3 bg-gray-100 text-gray-400 font-bold rounded-xl text-center text-sm">
                        Sudah Ada Pendaftar
                    </div>
                    @else
                    <div class="py-3 bg-gray-100 text-gray-400 font-bold rounded-xl text-center text-sm">
                        Tidak Tersedia
                    </div>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif

    </div>
</section>
@else
{{-- Tidak ada periode aktif --}}
<section class="bg-gray-50 py-20">
    <div class="max-w-lg mx-auto text-center px-4">
        <div class="text-6xl mb-4">🐄</div>
        <h2 class="text-xl font-bold text-gray-900 mb-2">Belum Ada Program Qurban</h2>
        <p class="text-gray-500 mb-6">Program qurban akan segera dibuka. Ikuti informasi terbaru kami.</p>
        <a href="/" class="inline-block px-6 py-3 bg-emerald-600 text-white font-semibold rounded-xl hover:bg-emerald-700 transition-all">
            Kembali ke Beranda
        </a>
    </div>
</section>
@endif

@endsection