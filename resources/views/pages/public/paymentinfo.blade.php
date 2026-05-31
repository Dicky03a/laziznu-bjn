@extends('layouts.public.app')

@section('title', 'Informasi Pembayaran - NU Care Lazisnu Bojonegoro')

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
                <span class="text-white font-medium">Informasi Pembayaran</span>
            </nav>
            <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-white leading-tight mb-4">
                Panduan Alur Pembayaran
            </h1>
            <p class="text-gray-300 text-base sm:text-lg">
                Mudah, Aman, dan Transparan. Ikuti panduan di bawah ini untuk menunaikan zakat, infaq, dan sedekah Anda.
            </p>
        </div>
    </div>
</section>

<section class="bg-gray-50 py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <!-- Alur Pembayaran -->
        <div class="mb-16">
            <h2 class="text-2xl font-bold text-gray-900 text-center mb-10">Langkah-Langkah Bertransaksi</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-6">
                <!-- Step 1 -->
                <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100 text-center relative group hover:shadow-md transition-all">
                    <h3 class="font-bold text-gray-900 mb-2 text-sm">1. Pilih Layanan</h3>
                    <p class="text-xs text-gray-500">Pilih menu Zakat, Infaq, Donasi, atau Qurban di halaman utama.</p>
                </div>
                <!-- Step 2 -->
                <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100 text-center relative group hover:shadow-md transition-all">
                    <h3 class="font-bold text-gray-900 mb-2 text-sm">2. Lengkapi Data</h3>
                    <p class="text-xs text-gray-500">Isi data diri Anda dan masukkan nominal yang ingin ditunaikan.</p>
                </div>
                <!-- Step 3 -->
                <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100 text-center relative group hover:shadow-md transition-all">
                    <h3 class="font-bold text-gray-900 mb-2 text-sm">3. Metode Bayar</h3>
                    <p class="text-xs text-gray-500">Pilih metode transfer Bank atau Scan QRIS yang tersedia.</p>
                </div>
                <!-- Step 4 -->
                <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100 text-center relative group hover:shadow-md transition-all">
                    <h3 class="font-bold text-gray-900 mb-2 text-sm">4. Pembayaran</h3>
                    <p class="text-xs text-gray-500">Lakukan pembayaran sesuai nominal dan simpan bukti transfernya.</p>
                </div>
                <!-- Step 5 -->
                <div class="bg-white rounded-3xl p-6 shadow-sm border border-gray-100 text-center relative group hover:shadow-md transition-all">
                    <h3 class="font-bold text-gray-900 mb-2 text-sm">5. Konfirmasi</h3>
                    <p class="text-xs text-gray-500">Unggah bukti pembayaran anda dan otomatis akan diarahkan ke WhatsApp Admin.</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Rekening Section -->
            <div class="lg:col-span-2 space-y-6">
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden">
                    <div class="px-8 py-6 border-b border-gray-50 flex items-center justify-between bg-gray-50/50">
                        <h2 class="text-lg font-bold text-gray-900">Rekening Resmi LAZISNU Bojonegoro</h2>
                    </div>
                    <div class="p-8">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @foreach($rekenings as $rekening)
                            <div class="p-5 rounded-2xl border border-gray-100 bg-gray-50/50 group hover:border-emerald-200 transition-colors">
                                <div class="flex items-center gap-4 mb-4">
                                    <div class="w-10 h-10 rounded-xl bg-white border border-gray-100 flex items-center justify-center p-1 shadow-sm">
                                        @if($rekening->icon)
                                        <img src="{{ asset('storage/' . $rekening->icon) }}" class="max-h-full max-w-full object-contain" alt="{{ $rekening->nama }}">
                                        @else
                                        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                        </svg>
                                        @endif
                                    </div>
                                    <div>
                                        <p class="font-bold text-gray-900 leading-tight">{{ $rekening->nama }}</p>
                                    </div>
                                </div>
                                <div class="flex items-center justify-between bg-white p-3 rounded-xl border border-gray-100">
                                    <span class="text-lg font-mono font-bold text-emerald-700 tracking-tighter">{{ $rekening->nomor_rekening }}</span>
                                    <button onclick="copyToClipboard('{{ $rekening->nomor_rekening }}')" class="text-gray-400 hover:text-emerald-600 transition-colors p-1">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z" />
                                        </svg>
                                    </button>
                                </div>
                                <p class="text-[10px] text-gray-500 mt-2 ml-1">Atas Nama: <span class="font-semibold">{{ $rekening->bank_atas_nama }}</span></p>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="bg-emerald-50 border border-emerald-100 rounded-3xl p-8 relative overflow-hidden">
                    <div class="relative z-10">
                        <h3 class="text-emerald-900 font-bold text-lg mb-3 flex items-center gap-2">
                            Scan QRIS LAZISNU
                        </h3>
                        <p class="text-emerald-700 text-sm leading-relaxed mb-6">
                            Anda juga dapat melakukan pembayaran secara instan menggunakan scan QRIS yang mendukung semua aplikasi pembayaran digital (Gopay, OVO, LinkAja, Dana, Mobile Banking, dll).
                        </p>
                        <a href="{{ route('rekening-lengkap') }}" class="inline-flex items-center gap-2 px-6 py-2.5 bg-emerald-600 text-white rounded-xl font-bold text-sm hover:bg-emerald-700 shadow-md shadow-emerald-200 transition-all">
                            Lihat Kode QRIS Lengkap
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                            </svg>
                        </a>
                    </div>
                    <svg class="absolute -bottom-10 -right-10 w-48 h-48 text-emerald-100 opacity-50" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h3a1 1 0 011 1v3a1 1 0 01-1 1H4a1 1 0 01-1-1V4zm2 2V5h1v1H5zM3 13a1 1 0 011-1h3a1 1 0 011 1v3a1 1 0 01-1 1H4a1 1 0 01-1-1v-3zm2 2v-1h1v1H5zM13 3a1 1 0 00-1 1v3a1 1 0 001 1h3a1 1 0 001-1V4a1 1 0 00-1-1h-3zm1 2h1v1h-1V5z" clip-rule="evenodd" />
                        <path d="M11 4a1 1 0 10-2 0v1a1 1 0 102 0V4zM10 7a1 1 0 011 1v1h2a1 1 0 110 2h-3a1 1 0 01-1-1V8a1 1 0 011-1zM16 9a1 1 0 100 2 1 1 0 000-2zM9 13a1 1 0 011-1h1a1 1 0 110 2v2a1 1 0 11-2 0v-3zM7 11a1 1 0 100-2H4a1 1 0 100 2h3zM17 13a1 1 0 01-1 1h-2a1 1 0 110-2h2a1 1 0 011 1zM16 17a1 1 0 100-2h-3a1 1 0 100 2h3z" />
                    </svg>
                </div>
            </div>

            <!-- Sidebar Info -->
            <div class="space-y-6">
                <div class="bg-white rounded-3xl p-8 shadow-sm border border-gray-100">
                    <h3 class="font-bold text-gray-900 mb-6 flex items-center gap-2 border-b pb-4">
                        <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Penting Diperhatikan
                    </h3>
                    <div class="space-y-6">
                        <div class="flex gap-4">
                            <p class="text-sm text-gray-600 leading-relaxed">Pastikan Anda memilih rekening yang sesuai dengan jenis transaksi Anda agar mempermudah alokasi dana.</p>
                        </div>
                        <div class="flex gap-4">
                            <p class="text-sm text-gray-600 leading-relaxed">Admin akan mengonfirmasi transaksi Anda melalui pesan WhatsApp resmi kami setelah verifikasi pembayaran berhasil.</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden">
                    <div class="p-8">
                        <div class="flex items-center gap-4 mb-6">
                            <img src="{{ asset('asset/laziznulogo.svg') }}" class="w-20" alt="Lazisnu Bojonegoro">
                            <div class="flex-1">
                                <h3 class="font-bold text-gray-900 text-lg mb-1">LAZISNU Bojonegoro</h3>
                                <p class="text-emerald-600 text-sm font-medium flex items-center gap-1">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                    Verified Organization
                                </p>
                            </div>
                        </div>
                        <div class="space-y-3 mb-6 text-sm text-gray-600">
                            <div class="flex items-center gap-2">
                                <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                <span>Bojonegoro, Jawa Timur</span>
                            </div>
                        </div>
                        <a href="{{ route('profile') }}" class="block w-full py-3 border-2 border-emerald-600 text-emerald-600 rounded-xl font-semibold hover:bg-emerald-50 transition-all text-center">
                            Lihat Profil
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(() => {
            alert('Nomor rekening berhasil disalin!');
        }).catch(err => {
            console.error('Gagal menyalin text: ', err);
        });
    }
</script>
@endpush
@endsection