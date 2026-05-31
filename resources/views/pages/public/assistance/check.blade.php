@extends('layouts.public.app')

@section('title', 'Lacak Pengajuan Bantuan - NU Care Lazisnu Bojonegoro')

@section('content')
<section class="relative bg-gradient-to-br from-emerald-600 to-emerald-700 overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 left-0 w-96 h-96 bg-emerald-500 rounded-full blur-3xl"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-emerald-600 rounded-full blur-3xl"></div>
    </div>

    <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14 sm:py-16 lg:py-20">
        <div class="max-w-3xl">
            <nav class="flex items-center gap-2 text-sm text-gray-300 mb-6">
                <a href="{{ route('home') }}" class="hover:text-white transition-colors">Beranda</a>
                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                </svg>
                <span class="text-white font-medium">Lacak Pengajuan</span>
            </nav>
            <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-white leading-tight mb-4">
                Lacak Pengajuan Bantuan
            </h1>
            <p class="text-gray-300 text-base sm:text-lg">
                Gunakan nomor tiket dan NIK Anda untuk memantau status permohonan bantuan.
            </p>
        </div>
    </div>
</section>

<section class="bg-gray-50 py-16">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Search Form -->
        <div class="max-w-xl mx-auto mb-12">
            <div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-8 sm:p-10">
                <form action="{{ route('assistance.check') }}" method="GET" class="space-y-5">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1.5">Nomor Tiket</label>
                        <input type="text" name="ticket_number" value="{{ request('ticket_number') }}" required
                            placeholder="REQ-20260531-XXXXX"
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-emerald-500 text-gray-900 font-mono">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-1.5">NIK (16 Digit)</label>
                        <input type="text" name="nik" value="{{ request('nik') }}" required maxlength="16"
                            placeholder="Sesuai saat pengajuan"
                            class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-emerald-500 text-gray-900">
                    </div>
                    <div class="pt-2">
                        <button type="submit"
                            class="w-full py-4 bg-emerald-600 text-white font-bold rounded-xl shadow-lg hover:bg-emerald-700 hover:-translate-y-0.5 transition-all">
                            Cari Pengajuan
                        </button>
                    </div>
                </form>
            </div>
        </div>

        @if($searched)
        @if($assistanceRequest)
        <!-- Results -->
        <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden animate-in fade-in slide-in-from-bottom-4 duration-500">
            <!-- Status Header -->
            @php
            $statusColors = [
            'approved' => 'bg-emerald-50 border-emerald-100 text-emerald-700',
            'rejected' => 'bg-red-50 border-red-100 text-red-700',
            'reviewing' => 'bg-blue-50 border-blue-100 text-blue-700',
            'pending' => 'bg-yellow-50 border-yellow-100 text-yellow-700',
            ];
            $statusColor = $statusColors[$assistanceRequest->status] ?? 'bg-gray-50 text-gray-700';

            $statusLabels = [
            'pending' => 'Menunggu Verifikasi',
            'reviewing' => 'Sedang Direview/Survei',
            'approved' => 'Pengajuan Disetujui',
            'rejected' => 'Pengajuan Ditolak',
            ];
            $statusLabel = $statusLabels[$assistanceRequest->status] ?? $assistanceRequest->status;
            @endphp

            <div class="px-8 py-8 border-b flex flex-col md:flex-row md:items-center justify-between gap-6 {{ $statusColor }}">
                <div>
                    <p class="text-[10px] font-bold uppercase tracking-widest opacity-70 mb-1">Status Pengajuan Saat Ini:</p>
                    <h2 class="text-2xl sm:text-3xl font-black">
                        @if($assistanceRequest->status == 'pending')
                        @elseif($assistanceRequest->status == 'reviewing')
                        @elseif($assistanceRequest->status == 'approved')
                        @elseif($assistanceRequest->status == 'rejected')
                        @endif
                        {{ $statusLabel }}
                    </h2>
                </div>
                <div class="md:text-right">
                    <p class="text-[10px] font-bold uppercase tracking-widest opacity-70 mb-1">Nomor Tiket:</p>
                    <p class="text-xl font-mono font-bold">{{ $assistanceRequest->ticket_number }}</p>
                </div>
            </div>

            <div class="p-8 sm:p-10">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                    <!-- Info -->
                    <div class="space-y-8">
                        <div>
                            <h3 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-4">Ringkasan Data</h3>
                            <div class="space-y-4">
                                <div class="flex justify-between items-center border-b border-gray-50 pb-3">
                                    <span class="text-gray-500 text-sm">Pemohon</span>
                                    <span class="font-bold text-gray-900">{{ $assistanceRequest->name }}</span>
                                </div>
                                <div class="flex justify-between items-center border-b border-gray-50 pb-3">
                                    <span class="text-gray-500 text-sm">Pilar Bantuan</span>
                                    <span class="font-bold text-emerald-600">{{ $assistanceRequest->pillar->title }}</span>
                                </div>
                                <div class="flex justify-between items-center border-b border-gray-50 pb-3">
                                    <span class="text-gray-500 text-sm">Tanggal Daftar</span>
                                    <span class="font-bold text-gray-900">{{ $assistanceRequest->created_at->format('d M Y') }}</span>
                                </div>
                            </div>
                        </div>

                        @if($assistanceRequest->admin_notes)
                        <div class="p-5 rounded-2xl bg-gray-50 border border-gray-100 relative">
                            <div class="absolute -top-3 left-4 bg-white px-2 text-[10px] font-bold text-gray-400 uppercase tracking-widest">Catatan Admin</div>
                            <p class="text-sm text-gray-700 leading-relaxed italic">"{{ $assistanceRequest->admin_notes }}"</p>
                        </div>
                        @endif
                    </div>

                    <!-- Timeline -->
                    <div>
                        <h3 class="text-sm font-bold text-gray-400 uppercase tracking-wider mb-6">Progress Pengajuan</h3>
                        <div class="relative pl-8 space-y-10 before:absolute before:left-3 before:top-2 before:bottom-2 before:w-0.5 before:bg-gray-100">

                            <!-- Step 1 -->
                            <div class="relative">
                                <div class="absolute -left-8 mt-1.5 h-6 w-6 rounded-full border-4 border-white bg-emerald-500 shadow-sm"></div>
                                <p class="font-bold text-gray-900">Diterima Sistem</p>
                                <p class="text-xs text-gray-500 mt-0.5">{{ $assistanceRequest->created_at->format('d M Y, H:i') }} WIB</p>
                            </div>

                            <!-- Step 2 -->
                            <div class="relative">
                                <div class="absolute -left-8 mt-1.5 h-6 w-6 rounded-full border-4 border-white {{ $assistanceRequest->status != 'pending' ? 'bg-blue-500' : 'bg-gray-200' }} shadow-sm"></div>
                                <p class="font-bold {{ $assistanceRequest->status != 'pending' ? 'text-gray-900' : 'text-gray-300' }}">Verifikasi Berkas</p>
                                <p class="text-xs text-gray-400 mt-0.5">Peninjauan kelengkapan dokumen</p>
                            </div>

                            <!-- Step 3 -->
                            <div class="relative">
                                <div class="absolute -left-8 mt-1.5 h-6 w-6 rounded-full border-4 border-white {{ in_array($assistanceRequest->status, ['approved', 'rejected']) ? ($assistanceRequest->status == 'approved' ? 'bg-emerald-500' : 'bg-red-500') : 'bg-gray-200' }} shadow-sm"></div>
                                <p class="font-bold {{ in_array($assistanceRequest->status, ['approved', 'rejected']) ? 'text-gray-900' : 'text-gray-300' }}">Keputusan Akhir</p>
                                @if(in_array($assistanceRequest->status, ['approved', 'rejected']))
                                <p class="text-xs text-gray-500 mt-0.5">{{ $assistanceRequest->updated_at->format('d M Y, H:i') }} WIB</p>
                                @else
                                <p class="text-xs text-gray-400 mt-0.5">Menunggu hasil verifikasi/survei</p>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="px-8 py-5 bg-gray-50 border-t border-gray-100 flex justify-between items-center">
                <p class="text-xs text-gray-400">Pembaruan terakhir: {{ $assistanceRequest->updated_at->diffForHumans() }}</p>
                <a href="{{ route('assistance.request') }}" class="text-xs font-bold text-emerald-600 hover:text-emerald-700 transition-colors uppercase tracking-widest">Buat Pengajuan Baru</a>
            </div>
        </div>
        @else
        <div class="bg-red-50 border border-red-100 rounded-3xl p-12 text-center animate-in zoom-in duration-300">
            <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-red-100 text-red-600 mb-6 shadow-inner">
                <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
            </div>
            <h2 class="text-2xl font-bold text-red-900 mb-2">Data Tidak Ditemukan</h2>
            <p class="text-red-700 max-w-sm mx-auto leading-relaxed">
                Kombinasi Nomor Tiket dan NIK yang Anda masukkan tidak terdaftar dalam sistem kami. Mohon periksa kembali penulisan Anda.
            </p>
        </div>
        @endif
        @endif
    </div>
</section>
@endsection