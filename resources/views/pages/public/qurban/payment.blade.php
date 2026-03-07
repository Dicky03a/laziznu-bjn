{{-- FILE: resources/views/public/qurban/payment.blade.php --}}
@extends('layouts.public.app')
@section('title', 'Pembayaran Qurban ' . $registration->kode_registrasi)
@section('content')

<section class="bg-gray-50 py-12 sm:py-16 min-h-screen">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Alert Messages --}}
        @if(session('success'))
        <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 rounded-xl text-emerald-700 text-sm font-medium flex items-center gap-3">
            <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>
            {{ session('success') }}
        </div>
        @endif

        {{-- Header Status --}}
        <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6 mb-6">
            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                <div>
                    <p class="text-sm text-gray-500 mb-1">Kode Pendaftaran</p>
                    <div class="flex items-center gap-3">
                        <p class="text-xl font-bold font-mono text-gray-900">{{ $registration->kode_registrasi }}</p>
                        <button onclick="copyKode('{{ $registration->kode_registrasi }}')"
                            class="text-xs px-2.5 py-1 bg-gray-100 hover:bg-gray-200 text-gray-600 rounded-lg transition-all">
                            Salin
                        </button>
                    </div>
                    <p class="text-xs text-gray-400 mt-1">{{ $registration->created_at->format('d F Y, H:i') }} WIB</p>
                </div>
                <div class="text-right">
                    @php
                    $statusColors = [
                    'pending' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                    'confirmed' => 'bg-emerald-100 text-emerald-800 border-emerald-200',
                    'cancelled' => 'bg-red-100 text-red-800 border-red-200',
                    ];
                    @endphp
                    <span class="inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold border {{ $statusColors[$registration->status] ?? 'bg-gray-100 text-gray-700' }}">
                        {{ $registration->status_label }}
                    </span>
                    @if($registration->is_confirmed)
                    <p class="text-xs text-gray-400 mt-1">Dikonfirmasi {{ $registration->confirmed_at->format('d M Y') }}</p>
                    @endif
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">

            {{-- LEFT — Detail Pendaftaran + Instruksi --}}
            <div class="lg:col-span-3 space-y-6">

                {{-- Ringkasan Pendaftaran --}}
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6">
                    <h2 class="font-bold text-gray-900 mb-5 text-lg">Detail Pendaftaran</h2>

                    <div class="space-y-3">
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Nama Pendaftar</span>
                            <span class="font-semibold text-gray-900">{{ $registration->nama_peserta }}</span>
                        </div>

                        @if($registration->atas_nama)
                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Atas Nama Qurban</span>
                            <span class="font-semibold text-gray-900">{{ $registration->atas_nama }}</span>
                        </div>
                        @endif

                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Hewan</span>
                            <span class="font-semibold text-gray-900">
                                {{ $registration->hewan?->jenis_icon }} {{ $registration->hewan?->nama }}
                            </span>
                        </div>

                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Jenis</span>
                            <span class="font-semibold text-gray-900">
                                {{ $registration->hewan?->jenis_label }}
                                @if($registration->hewan?->is_patungan)
                                <span class="text-xs text-gray-400">(patungan)</span>
                                @endif
                            </span>
                        </div>

                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Periode</span>
                            <span class="font-semibold text-gray-900">{{ $registration->period?->nama }}</span>
                        </div>

                        <div class="flex justify-between text-sm">
                            <span class="text-gray-500">Tanggal Daftar</span>
                            <span class="font-semibold text-gray-900">{{ $registration->created_at->format('d M Y, H:i') }}</span>
                        </div>

                        <div class="border-t border-gray-100 pt-3 flex justify-between items-center">
                            <span class="text-gray-700 font-semibold">Total Pembayaran</span>
                            <span class="text-2xl font-bold text-emerald-600">{{ $registration->total_bayar_format }}</span>
                        </div>
                    </div>
                </div>

                {{-- Instruksi Pembayaran (hanya tampil jika masih pending) --}}
                @if($registration->is_pending)
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6">
                    <h2 class="font-bold text-gray-900 mb-2 text-lg">Cara Pembayaran</h2>
                    <p class="text-sm text-gray-500 mb-6">Pilih metode pembayaran berikut:</p>

                    {{-- Tabs --}}
                    <div class="flex border-b border-gray-200 mb-5">
                        <button onclick="showTab('transfer')" id="tab-transfer"
                            class="px-4 py-2.5 text-sm font-semibold text-emerald-600 border-b-2 border-emerald-600 -mb-px">
                            Transfer Bank
                        </button>
                        <button onclick="showTab('qris')" id="tab-qris"
                            class="px-4 py-2.5 text-sm font-semibold text-gray-400 hover:text-gray-600 -mb-px">
                            QRIS
                        </button>
                    </div>

                    {{-- Tab Transfer --}}
                    <div id="content-transfer">
                        @forelse($rekenings as $rek)
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-xl border border-gray-100 mb-3 last:mb-0">
                            <div>
                                <p class="text-sm font-semibold text-gray-900">{{ $rek->bank_atas_nama ?? $rek->nama }}</p>
                                <p class="text-xs text-gray-500 mt-0.5">a.n {{ $rek->nama }}</p>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="font-mono font-semibold text-gray-900 text-sm">{{ $rek->nomor_rekening }}</span>
                                <button onclick="copyToClipboard('{{ $rek->nomor_rekening }}', this)"
                                    class="text-xs px-2.5 py-1 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg transition-all copy-btn">
                                    Salin
                                </button>
                            </div>
                        </div>
                        @empty
                        <p class="text-sm text-gray-500 text-center py-4">Data rekening belum tersedia. Hubungi kami langsung.</p>
                        @endforelse

                        <div class="mt-4 p-4 bg-amber-50 border border-amber-200 rounded-xl">
                            <p class="text-xs text-amber-800">
                                <strong>Penting:</strong> Transfer tepat sesuai nominal
                                <strong>{{ $registration->total_bayar_format }}</strong>
                                dan gunakan kode pendaftaran <strong>{{ $registration->kode_registrasi }}</strong> sebagai berita acara transfer.
                            </p>
                        </div>
                    </div>

                    {{-- Tab QRIS --}}
                    <div id="content-qris" class="hidden">
                        <div class="text-center">
                            <img src="{{ asset('asset/qris-qurban.png') }}"
                                onerror="this.src='{{ asset('asset/qris-infaq.png') }}'"
                                alt="QRIS LAZIZNU"
                                class="mx-auto max-w-xs rounded-2xl shadow-md border-4 border-white shadow-gray-200">
                            <p class="text-sm text-gray-600 mt-4">Scan dengan aplikasi e-wallet atau mobile banking apapun</p>
                        </div>
                    </div>

                    {{-- Steps --}}
                    <div class="mt-6 space-y-2">
                        <h4 class="text-sm font-semibold text-gray-700">Langkah-langkah:</h4>
                        <ol class="space-y-1.5 text-sm text-gray-600">
                            <li class="flex gap-2"><span class="w-5 h-5 rounded-full bg-emerald-100 text-emerald-700 text-xs flex items-center justify-center font-bold flex-shrink-0 mt-0.5">1</span> Lakukan transfer sesuai nominal di atas</li>
                            <li class="flex gap-2"><span class="w-5 h-5 rounded-full bg-emerald-100 text-emerald-700 text-xs flex items-center justify-center font-bold flex-shrink-0 mt-0.5">2</span> Simpan bukti transfer</li>
                            <li class="flex gap-2"><span class="w-5 h-5 rounded-full bg-emerald-100 text-emerald-700 text-xs flex items-center justify-center font-bold flex-shrink-0 mt-0.5">3</span> Isi form konfirmasi di bawah (opsional tapi sangat membantu)</li>
                            <li class="flex gap-2"><span class="w-5 h-5 rounded-full bg-emerald-100 text-emerald-700 text-xs flex items-center justify-center font-bold flex-shrink-0 mt-0.5">4</span> Tim kami akan memverifikasi dalam 1×24 jam</li>
                        </ol>
                    </div>
                </div>
                @endif

                {{-- Form Konfirmasi Transfer --}}
                @if(!$registration->paymentConfirmation && $registration->is_pending)
                <div class="bg-white rounded-3xl shadow-sm border border-gray-100 p-6">
                    <h2 class="font-bold text-gray-900 mb-2 text-lg">Konfirmasi Transfer</h2>
                    <p class="text-sm text-gray-500 mb-5">Kirim bukti transfer agar kami dapat memverifikasi lebih cepat</p>

                    @if($errors->any())
                    <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-xl text-red-600 text-sm">
                        <ul class="list-disc list-inside space-y-1">
                            @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                        </ul>
                    </div>
                    @endif

                    <form action="{{ route('qurban.payment.confirm', $registration->kode_registrasi) }}" method="POST"
                        enctype="multipart/form-data" class="space-y-4">
                        @csrf

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1.5">Nama Pengirim <span class="text-red-500">*</span></label>
                                <input type="text" name="nama_pengirim" value="{{ old('nama_pengirim', $registration->nama_peserta) }}"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-emerald-500 @error('nama_pengirim') border-red-500 @enderror">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1.5">Bank / E-Wallet <span class="text-red-500">*</span></label>
                                <input type="text" name="bank_pengirim" value="{{ old('bank_pengirim') }}"
                                    placeholder="BCA / Mandiri / GoPay / dll"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-emerald-500 @error('bank_pengirim') border-red-500 @enderror">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1.5">No. Rekening Pengirim</label>
                                <input type="text" name="nomor_rekening_pengirim" value="{{ old('nomor_rekening_pengirim') }}"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-emerald-500">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1.5">Jumlah Transfer <span class="text-red-500">*</span></label>
                                <input type="number" name="jumlah_transfer" value="{{ old('jumlah_transfer', $registration->total_bayar) }}"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-emerald-500 @error('jumlah_transfer') border-red-500 @enderror">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1.5">Tanggal Transfer <span class="text-red-500">*</span></label>
                                <input type="date" name="tanggal_transfer" value="{{ old('tanggal_transfer', now()->format('Y-m-d')) }}"
                                    max="{{ now()->format('Y-m-d') }}"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-emerald-500 @error('tanggal_transfer') border-red-500 @enderror">
                            </div>
                            <div>
                                <label class="block text-sm font-medium text-gray-700 mb-1.5">Bukti Transfer (foto/screenshot)</label>
                                <input type="file" name="bukti_transfer" accept="image/*"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-emerald-500 text-sm">
                                <p class="text-xs text-gray-400 mt-1">JPG, PNG, WEBP. Maks 2MB</p>
                            </div>
                            <div class="sm:col-span-2">
                                <label class="block text-sm font-medium text-gray-700 mb-1.5">Catatan</label>
                                <textarea name="catatan" rows="2"
                                    class="w-full px-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-emerald-500 resize-none">{{ old('catatan') }}</textarea>
                            </div>
                        </div>

                        <button type="submit"
                            class="w-full py-3.5 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl transition-all shadow-sm hover:shadow-md">
                            Kirim Konfirmasi Transfer
                        </button>
                    </form>
                </div>
                @elseif($registration->paymentConfirmation)
                {{-- Sudah konfirmasi --}}
                <div class="bg-emerald-50 rounded-3xl border border-emerald-200 p-6">
                    <div class="flex items-center gap-3 mb-4">
                        <svg class="w-7 h-7 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                        <h3 class="font-bold text-emerald-800">Konfirmasi Sudah Dikirim</h3>
                    </div>
                    <p class="text-sm text-emerald-700">
                        Konfirmasi transfer diterima pada
                        {{ $registration->paymentConfirmation->created_at->format('d F Y, H:i') }} WIB.
                        Tim kami sedang memverifikasi. Mohon tunggu 1×24 jam.
                    </p>
                </div>
                @endif

                {{-- Status confirmed atau cancelled --}}
                @if($registration->is_confirmed)
                <div class="bg-emerald-50 rounded-3xl border border-emerald-200 p-6 text-center">
                    <div class="w-16 h-16 bg-emerald-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <h3 class="font-bold text-emerald-800 text-xl mb-2">Jazakallah Khair!</h3>
                    <p class="text-emerald-700 text-sm mb-4">
                        Pembayaran Anda sebesar <strong>{{ $registration->total_bayar_format }}</strong> telah dikonfirmasi.
                        @if($registration->hewan?->period?->tanggal_pelaksanaan)
                        Penyembelihan akan dilaksanakan pada
                        <strong>{{ $registration->hewan->period->tanggal_pelaksanaan->format('d F Y') }}</strong>.
                        @endif
                    </p>
                    <p class="text-xs text-emerald-600 bg-emerald-100 rounded-xl p-3">
                        Insya Allah qurban Anda diterima. Semoga menjadi amal yang diterima Allah SWT. 🤲
                    </p>
                </div>
                @elseif($registration->is_cancelled)
                <div class="bg-red-50 rounded-3xl border border-red-200 p-6">
                    <h3 class="font-bold text-red-800 mb-2">Pendaftaran Dibatalkan</h3>
                    <p class="text-red-700 text-sm mb-4">{{ $registration->catatan_admin ?? 'Pendaftaran ini telah dibatalkan.' }}</p>
                    <a href="{{ route('qurban.index') }}"
                        class="inline-block w-full py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl transition-all text-center">
                        Daftar Ulang
                    </a>
                </div>
                @endif

            </div>

            {{-- RIGHT — Sidebar Info --}}
            <div class="lg:col-span-2 space-y-4">

                {{-- Info LAZIZNU --}}
                <div class="bg-white rounded-2xl shadow-sm border border-gray-100 p-5">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-emerald-600 to-emerald-500 flex items-center justify-center text-white font-bold shadow">NU</div>
                        <div>
                            <h3 class="font-bold text-gray-900 text-sm">LAZIZNU Bojonegoro</h3>
                            <p class="text-xs text-emerald-600">Lembaga Terverifikasi</p>
                        </div>
                    </div>
                    <div class="space-y-2 text-xs text-gray-600">
                        <div class="flex items-center gap-2">
                            <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                            <span>085743229703 (Admin)</span>
                        </div>
                        <div class="flex items-center gap-2">
                            <svg class="w-3.5 h-3.5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span>Bojonegoro, Jawa Timur</span>
                        </div>
                    </div>
                </div>

                {{-- Reminder --}}
                @if($registration->is_pending)
                <div class="bg-amber-50 rounded-2xl border border-amber-200 p-5">
                    <p class="text-xs font-semibold text-amber-800 mb-1">💡 Simpan halaman ini</p>
                    <p class="text-xs text-amber-700">Bookmark halaman ini atau catat kode pendaftaran <strong>{{ $registration->kode_registrasi }}</strong> untuk melacak status pembayaran Anda.</p>
                </div>
                @endif

            </div>

        </div>

    </div>
</section>

@push('scripts')
<script>
    function copyToClipboard(text, btn) {
        navigator.clipboard.writeText(text).then(() => {
            btn.textContent = '✓';
            btn.classList.add('bg-emerald-700');
            setTimeout(() => {
                btn.textContent = 'Salin';
                btn.classList.remove('bg-emerald-700');
            }, 2000);
        });
    }

    function copyKode(kode) {
        navigator.clipboard.writeText(kode);
    }

    function showTab(tab) {
        document.getElementById('content-transfer').classList.toggle('hidden', tab !== 'transfer');
        document.getElementById('content-qris').classList.toggle('hidden', tab !== 'qris');

        document.getElementById('tab-transfer').className = tab === 'transfer' ?
            'px-4 py-2.5 text-sm font-semibold text-emerald-600 border-b-2 border-emerald-600 -mb-px' :
            'px-4 py-2.5 text-sm font-semibold text-gray-400 hover:text-gray-600 -mb-px';
        document.getElementById('tab-qris').className = tab === 'qris' ?
            'px-4 py-2.5 text-sm font-semibold text-emerald-600 border-b-2 border-emerald-600 -mb-px' :
            'px-4 py-2.5 text-sm font-semibold text-gray-400 hover:text-gray-600 -mb-px';
    }
</script>
@endpush

@endsection