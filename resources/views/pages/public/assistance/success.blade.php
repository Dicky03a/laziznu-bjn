@extends('layouts.public.app')

@section('title', 'Pengajuan Berhasil - NU Care Lazisnu Bojonegoro')

@section('content')
<section class="bg-gray-50 py-20 sm:py-28">
    <div class="max-w-2xl mx-auto px-4 text-center">

        <h1 class="text-3xl sm:text-4xl font-bold text-gray-900 mb-4">Pengajuan Berhasil Dikirim!</h1>
        <p class="text-lg text-gray-600 mb-10 leading-relaxed">
            Terima kasih, permohonan bantuan Anda telah kami terima dan akan segera diproses oleh tim LAZISNU Bojonegoro.
        </p>

        <div class="bg-white rounded-3xl shadow-xl border border-gray-100 p-8 sm:p-10 mb-10 relative overflow-hidden">
            <div class="absolute top-0 right-0 w-32 h-32 bg-emerald-50 rounded-full -mr-16 -mt-16 opacity-50"></div>
            
            <p class="text-xs font-bold text-gray-400 uppercase tracking-widest mb-3">Nomor Tiket Pengajuan</p>
            <div class="text-3xl sm:text-4xl font-mono font-bold text-emerald-700 bg-emerald-50/50 py-5 rounded-2xl border-2 border-dashed border-emerald-200">
                {{ $ticket }}
            </div>
            <p class="text-sm text-gray-500 mt-5 italic">
                Mohon simpan atau salin nomor tiket di atas untuk mengecek status pengajuan Anda secara berkala.
            </p>
        </div>

        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('assistance.check') }}" 
                class="px-8 py-3.5 bg-emerald-600 text-white font-bold rounded-xl shadow-lg hover:bg-emerald-700 transition-all">
                Lacak Pengajuan
            </a>
            <a href="{{ route('home') }}" 
                class="px-8 py-3.5 bg-white text-gray-700 font-bold rounded-xl border border-gray-200 hover:bg-gray-50 transition-all">
                Kembali ke Beranda
            </a>
        </div>

        <div class="mt-16 text-left p-8 bg-white rounded-3xl border border-gray-100 shadow-sm">
            <h3 class="font-bold text-gray-900 mb-4 flex items-center gap-2">
                <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                Apa Langkah Selanjutnya?
            </h3>
            <div class="space-y-4">
                <div class="flex gap-4">
                    <div class="flex-shrink-0 w-8 h-8 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold text-sm">1</div>
                    <p class="text-sm text-gray-600">Verifikasi berkas oleh admin akan dilakukan dalam waktu <strong>3-7 hari kerja</strong>.</p>
                </div>
                <div class="flex gap-4">
                    <div class="flex-shrink-0 w-8 h-8 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold text-sm">2</div>
                    <p class="text-sm text-gray-600">Jika lolos seleksi berkas, petugas kami akan menghubungi Anda untuk jadwal <strong>survei lapangan</strong>.</p>
                </div>
                <div class="flex gap-4">
                    <div class="flex-shrink-0 w-8 h-8 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center font-bold text-sm">3</div>
                    <p class="text-sm text-gray-600">Keputusan akhir akan diinformasikan melalui WhatsApp atau dapat Anda cek di menu <strong>Lacak Pengajuan</strong>.</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
