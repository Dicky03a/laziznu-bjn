{{-- FILE: resources/views/public/qurban/payment.blade.php --}}
@extends('layouts.public.app')
@section('title', 'Pembayaran Qurban ' . $registration->kode_registrasi)
@section('content')

<div class="bg-gray-50 min-h-screen py-10 sm:py-14">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

        {{-- Header Status --}}
        <div class="text-center mb-8">
            @if($registration->is_confirmed)
            <div class="w-20 h-20 bg-emerald-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-10 h-10 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <h1 class="text-2xl font-bold text-emerald-700 mb-1">Pendaftaran Terkonfirmasi!</h1>
            <p class="text-gray-500">Jazakallahu Khairan atas niat qurban Anda</p>
            @elseif($registration->is_cancelled)
            <div class="w-20 h-20 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-4">
                <svg class="w-10 h-10 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </div>
            <h1 class="text-2xl font-bold text-red-700 mb-1">Pendaftaran Dibatalkan</h1>
            <p class="text-gray-500">{{ $registration->catatan_admin ?: 'Pendaftaran ini telah dibatalkan.' }}</p>
            @else
            <div class="w-20 h-20 bg-amber-100 rounded-full flex items-center justify-center mx-auto mb-4 text-4xl">
                🐄
            </div>
            <h1 class="text-2xl font-bold text-gray-900 mb-1">Selesaikan Pembayaran</h1>
            <p class="text-gray-500">Segera lakukan transfer untuk mengamankan slot qurban Anda</p>
            @endif
        </div>

        {{-- Flash --}}
        @if(session('success'))
        <div class="mb-6 p-4 bg-emerald-50 border border-emerald-200 rounded-2xl text-emerald-700 text-sm flex items-center gap-2">
            <svg class="w-5 h-5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>
            {{ session('success') }}
        </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-5 gap-6">

            {{-- LEFT: Info Pendaftaran + Instruksi ─────────────────── --}}
            <div class="lg:col-span-3 space-y-5">

                {{-- Ringkasan Pendaftaran --}}
                <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm">
                    <div class="flex justify-between items-start mb-5">
                        <h2 class="font-bold text-gray-900">Detail Pendaftaran</h2>
                        @php
                        $badgeClasses = [
                            'pending'   => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                            'confirmed' => 'bg-emerald-100 text-emerald-800 border-emerald-200',
                            'cancelled' => 'bg-red-100 text-red-800 border-red-200',
                        ][$registration->status] ?? 'bg-gray-100 text-gray-700';
                        @endphp
                        <span class="px-3 py-1 rounded-full text-xs font-semibold border {{ $badgeClasses }}">
                            {{ $registration->status_label }}
                        </span>
                    </div>

                    {{-- Kode --}}
                    <div class="p-4 bg-amber-50 rounded-xl border border-amber-200 mb-5">
                        <p class="text-xs text-amber-700 font-medium mb-1">Kode Pendaftaran</p>
                        <div class="flex items-center gap-3">
                            <p class="text-2xl font-mono font-black text-amber-800 tracking-widest" id="kode-text">
                                {{ $registration->kode_registrasi }}
                            </p>
                            <button onclick="copyKode()"
                                    id="copy-kode-btn"
                                    class="px-3 py-1.5 bg-amber-600 text-white text-xs font-semibold rounded-lg hover:bg-amber-700 transition-all flex-shrink-0">
                                Salin
                            </button>
                        </div>
                        <p class="text-xs text-amber-600 mt-1">Sertakan kode ini pada berita transfer</p>
                    </div>

                    <dl class="grid grid-cols-2 gap-x-6 gap-y-4 text-sm">
                        <div>
                            <dt class="text-gray-500">Nama Pendaftar</dt>
                            <dd class="font-semibold text-gray-900 mt-0.5">{{ $registration->nama_peserta }}</dd>
                        </div>
                        @if($registration->atas_nama)
                        <div>
                            <dt class="text-gray-500">Atas Nama Qurban</dt>
                            <dd class="font-semibold text-gray-900 mt-0.5">{{ $registration->atas_nama }}</dd>
                        </div>
                        @endif
                        <div>
                            <dt class="text-gray-500">Hewan</dt>
                            <dd class="font-semibold text-gray-900 mt-0.5">
                                {{ $registration->hewan?->jenis_icon }} {{ $registration->hewan?->nama }}
                            </dd>
                        </div>
                        <div>
                            <dt class="text-gray-500">Jenis</dt>
                            <dd class="font-semibold text-gray-900 mt-0.5">
                                {{ $registration->hewan?->jenis_label }}
                                @if($registration->hewan?->is_patungan)
                                <span class="text-xs text-gray-400">(patungan)</span>
                                @endif
                            </dd>
                        </div>
                        <div>
                            <dt class="text-gray-500">Periode</dt>
                            <dd class="font-semibold text-gray-900 mt-0.5">{{ $registration->period?->nama }}</dd>
                        </div>
                        <div>
                            <dt class="text-gray-500">Tanggal Daftar</dt>
                            <dd class="font-semibold text-gray-900 mt-0.5">{{ $registration->created_at->format('d M Y, H:i') }}</dd>
                        </div>
                    </dl>

                    <div class="mt-5 pt-4 border-t border-gray-200 flex justify-between items-center">
                        <span class="font-bold text-gray-900">Total yang Dibayarkan</span>
                        <span class="text-2xl font-black text-emerald-600">{{ $registration->total_bayar_format }}</span>
                    </div>
                </div>

                {{-- Instruksi Pembayaran (hanya tampil jika masih pending) --}}
                @if($registration->is_pending)
                <div class="bg-white rounded-2xl border border-gray-200 shadow-sm overflow-hidden">
                    <div class="px-6 py-4 bg-gray-50 border-b border-gray-200">
                        <h2 class="font-bold text-gray-900">Cara Pembayaran</h2>
                    </div>

                    {{-- Tab Transfer vs QRIS --}}
                    <div class="p-6">
                        <div class="flex rounded-xl border border-gray-200 overflow-hidden mb-5 text-sm font-semibold">
                            <button onclick="showTab('transfer')" id="tab-transfer"
                                    class="flex-1 py-2.5 bg-amber-500 text-white transition-all">
                                🏦 Transfer Bank
                            </button>
                            <button onclick="showTab('qris')" id="tab-qris"
                                    class="flex-1 py-2.5 bg-white text-gray-600 hover:bg-gray-50 transition-all">
                                📱 QRIS
                            </button>
                        </div>

                        {{-- Transfer --}}
                        <div id="panel-transfer">
                            @if($rekenings->isNotEmpty())
                            <div class="space-y-3">
                                @foreach($rekenings as $rek)
                                <div class="p-4 rounded-xl border border-gray-200 hover:border-amber-300 transition-all">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <p class="text-xs text-gray-500 mb-0.5">{{ $rek->bank_atas_nama ?? $rek->nama }}</p>
                                            <p class="font-bold text-gray-900 text-lg tracking-wider font-mono">{{ $rek->nomor_rekening }}</p>
                                            <p class="text-sm text-gray-600">a.n. {{ $rek->nama }}</p>
                                        </div>
                                        <button onclick="copyText('{{ $rek->nomor_rekening }}', this)"
                                                class="ml-3 px-3 py-1.5 bg-gray-100 hover:bg-gray-200 text-gray-700 text-xs font-semibold rounded-lg transition-all flex-shrink-0">
                                            Salin
                                        </button>
                                    </div>
                                </div>
                                @endforeach
                            </div>

                            <div class="mt-4 p-4 bg-blue-50 rounded-xl border border-blue-100 text-sm text-blue-800">
                                <p class="font-semibold mb-2">Langkah Pembayaran:</p>
                                <ol class="space-y-1 list-decimal list-inside text-blue-700">
                                    <li>Transfer ke salah satu rekening di atas</li>
                                    <li>Nominal tepat: <strong>{{ $registration->total_bayar_format }}</strong></li>
                                    <li>Berita transfer: <code class="bg-blue-100 px-1 rounded font-mono text-xs">{{ $registration->kode_registrasi }}</code></li>
                                    <li>Upload bukti transfer di form di bawah</li>
                                </ol>
                            </div>
                            @else
                            <p class="text-gray-500 text-sm text-center py-4">
                                Hubungi kami untuk informasi rekening.
                            </p>
                            @endif
                        </div>

                        {{-- QRIS --}}
                        <div id="panel-qris" class="hidden">
                            <div class="text-center">
                                <img src="{{ asset('asset/qris-qurban.png') }}"
                                     onerror="this.src='{{ asset('asset/qris-infaq.png') }}'"
                                     alt="QRIS LAZIZNU"
                                     class="max-w-xs mx-auto rounded-2xl border border-gray-200 shadow-sm">
                                <p class="text-sm text-gray-500 mt-3">Scan dengan aplikasi dompet digital / m-banking</p>
                                <div class="mt-3 inline-flex items-center gap-2 px-4 py-2 bg-amber-50 rounded-lg border border-amber-200">
                                    <span class="text-sm font-bold text-amber-800">Nominal: {{ $registration->total_bayar_format }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

            </div>

            {{-- RIGHT: Form Konfirmasi ──────────────────────────────── --}}
            <div class="lg:col-span-2">

                @if($registration->is_confirmed)
                {{-- Sudah dikonfirmasi --}}
                <div class="bg-emerald-50 rounded-2xl border border-emerald-200 p-6 text-center">
                    <div class="text-4xl mb-3">🎉</div>
                    <h3 class="font-bold text-emerald-800 mb-2">Pembayaran Terkonfirmasi</h3>
                    <p class="text-sm text-emerald-700 mb-4">
                        Pendaftaran qurban Anda telah kami verifikasi.
                        @if($registration->hewan?->period?->tanggal_pelaksanaan)
                        Penyembelihan akan dilaksanakan pada
                        <strong>{{ $registration->hewan->period->tanggal_pelaksanaan->format('d F Y') }}</strong>.
                        @endif
                    </p>
                    <p class="text-xs text-emerald-600 bg-emerald-100 rounded-xl p-3">
                        Insya Allah qurban Anda diterima. Jazakallahu Khairan 🤲
                    </p>
                </div>

                @elseif($registration->is_cancelled)
                {{-- Dibatalkan --}}
                <div class="bg-red-50 rounded-2xl border border-red-200 p-6 text-center">
                    <div class="text-4xl mb-3">❌</div>
                    <h3 class="font-bold text-red-800 mb-2">Pendaftaran Dibatalkan</h3>
                    @if($registration->catatan_admin)
                    <p class="text-sm text-red-700 mb-4">{{ $registration->catatan_admin }}</p>
                    @endif
                    <a href="{{ route('qurban.index') }}"
                       class="block w-full py-3 bg-amber-500 hover:bg-amber-600 text-white font-bold rounded-xl transition-all">
                        Daftar Ulang
                    </a>
                </div>

                @elseif($registration->paymentConfirmation)
                {{-- Sudah submit konfirmasi, menunggu --}}
                <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm text-center">
                    <div class="w-16 h-16 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-4">
                        <svg class="w-8 h-8 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="font-bold text-gray-900 mb-2">Menunggu Verifikasi</h3>
                    <p class="text-sm text-gray-500 mb-4">
                        Konfirmasi transfer Anda sudah kami terima. Tim LAZIZNU akan memverifikasi dalam <strong>1×24 jam</strong>.
                    </p>
                    <div class="p-3 bg-gray-50 rounded-xl text-left text-xs text-gray-600 space-y-1">
                        <p><strong>Pengirim:</strong> {{ $registration->paymentConfirmation->nama_pengirim }}</p>
                        <p><strong>Bank:</strong> {{ $registration->paymentConfirmation->bank_pengirim }}</p>
                        <p><strong>Jumlah:</strong> {{ $registration->paymentConfirmation->jumlah_format }}</p>
                        <p><strong>Tanggal:</strong> {{ $registration->paymentConfirmation->tanggal_transfer->format('d M Y') }}</p>
                    </div>
                    <p class="mt-3 text-xs text-gray-400">
                        Ada pertanyaan?
                        <a href="https://wa.me/6282XXXXXXXX" class="text-emerald-600 hover:underline">Hubungi kami via WhatsApp</a>
                    </p>
                </div>

                @else
                {{-- Form Konfirmasi Transfer --}}
                <div class="bg-white rounded-2xl border border-gray-200 p-6 shadow-sm sticky top-6">
                    <h3 class="font-bold text-gray-900 mb-2">Konfirmasi Transfer</h3>
                    <p class="text-xs text-gray-500 mb-5">Sudah transfer? Isi form ini untuk mempercepat verifikasi.</p>

                    @if($errors->any())
                    <div class="mb-4 p-3 bg-red-50 border border-red-200 rounded-xl text-red-600 text-xs">
                        @foreach($errors->all() as $error)<p>• {{ $error }}</p>@endforeach
                    </div>
                    @endif

                    <form action="{{ route('qurban.payment.confirm', $registration->kode_registrasi) }}"
                          method="POST"
                          enctype="multipart/form-data"
                          class="space-y-4">
                        @csrf

                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1.5">
                                Nama Pengirim <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="nama_pengirim"
                                   value="{{ old('nama_pengirim', $registration->nama_peserta) }}"
                                   class="w-full px-3 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-amber-500 text-sm @error('nama_pengirim') border-red-500 @enderror">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1.5">
                                Bank / E-Wallet <span class="text-red-500">*</span>
                            </label>
                            <input type="text" name="bank_pengirim"
                                   value="{{ old('bank_pengirim') }}"
                                   placeholder="BRI, BNI, BSI, GoPay, dll"
                                   class="w-full px-3 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-amber-500 text-sm @error('bank_pengirim') border-red-500 @enderror">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1.5">No. Rekening Pengirim</label>
                            <input type="text" name="nomor_rekening_pengirim"
                                   value="{{ old('nomor_rekening_pengirim') }}"
                                   placeholder="Opsional"
                                   class="w-full px-3 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-amber-500 text-sm">
                        </div>

                        <div class="grid grid-cols-2 gap-3">
                            <div>
                                <label class="block text-xs font-semibold text-gray-700 mb-1.5">
                                    Jumlah Transfer <span class="text-red-500">*</span>
                                </label>
                                <input type="number" name="jumlah_transfer"
                                       value="{{ old('jumlah_transfer', $registration->total_bayar) }}"
                                       class="w-full px-3 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-amber-500 text-sm @error('jumlah_transfer') border-red-500 @enderror">
                            </div>
                            <div>
                                <label class="block text-xs font-semibold text-gray-700 mb-1.5">
                                    Tanggal Transfer <span class="text-red-500">*</span>
                                </label>
                                <input type="date" name="tanggal_transfer"
                                       value="{{ old('tanggal_transfer', now()->format('Y-m-d')) }}"
                                       max="{{ now()->format('Y-m-d') }}"
                                       class="w-full px-3 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-amber-500 text-sm @error('tanggal_transfer') border-red-500 @enderror">
                            </div>
                        </div>

                        {{-- Upload Bukti --}}
                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1.5">Bukti Transfer</label>
                            <label class="block cursor-pointer">
                                <div id="upload-area" class="border-2 border-dashed border-gray-300 rounded-xl p-4 text-center hover:border-amber-400 hover:bg-amber-50/30 transition-all">
                                    <span class="text-2xl block mb-1">📸</span>
                                    <p class="text-xs text-gray-500">Upload foto bukti transfer</p>
                                    <p class="text-xs text-gray-400">JPG/PNG, maks 2MB</p>
                                </div>
                                <input type="file" name="bukti_transfer" accept="image/*"
                                       class="hidden" onchange="previewBukti(this)">
                            </label>
                            <img id="preview-bukti" class="hidden mt-2 w-full rounded-xl border border-gray-200" src="" alt="Preview">
                        </div>

                        <div>
                            <label class="block text-xs font-semibold text-gray-700 mb-1.5">Catatan</label>
                            <textarea name="catatan" rows="2"
                                      placeholder="Catatan tambahan (opsional)"
                                      class="w-full px-3 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-amber-500 text-sm resize-none">{{ old('catatan') }}</textarea>
                        </div>

                        <button type="submit"
                                class="w-full py-3.5 bg-amber-500 hover:bg-amber-600 text-white font-bold rounded-xl transition-all shadow-sm hover:shadow-md">
                            Kirim Konfirmasi Transfer
                        </button>
                    </form>
                </div>
                @endif

            </div>
        </div>

    </div>
</div>

@push('scripts')
<script>
function showTab(tab) {
    document.getElementById('panel-transfer').classList.toggle('hidden', tab !== 'transfer');
    document.getElementById('panel-qris').classList.toggle('hidden', tab !== 'qris');
    document.getElementById('tab-transfer').className = 'flex-1 py-2.5 transition-all ' +
        (tab === 'transfer' ? 'bg-amber-500 text-white' : 'bg-white text-gray-600 hover:bg-gray-50');
    document.getElementById('tab-qris').className = 'flex-1 py-2.5 transition-all ' +
        (tab === 'qris' ? 'bg-amber-500 text-white' : 'bg-white text-gray-600 hover:bg-gray-50');
}

function copyText(text, btn) {
    navigator.clipboard.writeText(text).then(() => {
        const orig = btn.textContent;
        btn.textContent = '✓ Disalin';
        btn.classList.add('bg-emerald-100', 'text-emerald-700');
        setTimeout(() => {
            btn.textContent = orig;
            btn.classList.remove('bg-emerald-100', 'text-emerald-700');
        }, 2000);
    });
}

function copyKode() {
    const kode = document.getElementById('kode-text').textContent.trim();
    const btn   = document.getElementById('copy-kode-btn');
    navigator.clipboard.writeText(kode).then(() => {
        btn.textContent = '✓ Tersalin!';
        setTimeout(() => btn.textContent = 'Salin', 2000);
    });
}

function previewBukti(input) {
    const img = document.getElementById('preview-bukti');
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => { img.src = e.target.result; img.classList.remove('hidden'); };
        reader.readAsDataURL(input.files[0]);
        document.getElementById('upload-area').querySelector('p').textContent = input.files[0].name;
    }
}
</script>
@endpush

@endsection
