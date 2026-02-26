{{-- FILE: resources/views/admin/qurban/registrations/show.blade.php --}}
<x-layouts::app :title="'Pendaftaran ' . $registration->kode_registrasi">

    {{-- Header --}}
    <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
        <div class="flex items-center gap-3">
            <a href="{{ route('qurban.registrations.index') }}"
               class="p-2 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-lg transition-all">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
            </a>
            <div>
                <h1 class="text-xl font-bold text-gray-900 font-mono">{{ $registration->kode_registrasi }}</h1>
                <p class="text-sm text-gray-400">{{ $registration->created_at->format('d F Y, H:i') }} WIB</p>
            </div>
        </div>

        @php
        $badge = [
            'pending'   => 'bg-yellow-100 text-yellow-800 border border-yellow-200',
            'confirmed' => 'bg-emerald-100 text-emerald-800 border border-emerald-200',
            'cancelled' => 'bg-red-100 text-red-800 border border-red-200',
        ][$registration->status] ?? 'bg-gray-100 text-gray-700';
        @endphp
        <span class="self-start sm:self-auto inline-flex items-center px-4 py-2 rounded-full text-sm font-semibold {{ $badge }}">
            {{ $registration->status_label }}
        </span>
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

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- LEFT: Detail ───────────────────────────────────────────────── --}}
        <div class="lg:col-span-2 space-y-5">

            {{-- Info Hewan --}}
            <div class="bg-white rounded-2xl border border-gray-200 p-6">
                <h2 class="font-bold text-gray-900 mb-5 flex items-center gap-2">
                    <span class="text-xl">{{ $registration->hewan?->jenis_icon }}</span>
                    Detail Hewan Qurban
                </h2>

                <div class="flex gap-5">
                    @if($registration->hewan?->gambar)
                    <img src="{{ $registration->hewan->gambar_url }}"
                         alt="{{ $registration->hewan->nama }}"
                         class="w-24 h-24 rounded-xl object-cover flex-shrink-0">
                    @endif
                    <div class="flex-1 grid grid-cols-2 gap-x-6 gap-y-3 text-sm">
                        <div>
                            <dt class="text-gray-500">Hewan</dt>
                            <dd class="font-semibold text-gray-900 mt-0.5">{{ $registration->hewan?->nama }}</dd>
                        </div>
                        <div>
                            <dt class="text-gray-500">Jenis</dt>
                            <dd class="font-semibold text-gray-900 mt-0.5">{{ $registration->hewan?->jenis_label }}</dd>
                        </div>
                        <div>
                            <dt class="text-gray-500">Periode</dt>
                            <dd class="font-semibold text-gray-900 mt-0.5">{{ $registration->period?->nama }}</dd>
                        </div>
                        @if($registration->hewan?->berat_estimasi)
                        <div>
                            <dt class="text-gray-500">Berat Estimasi</dt>
                            <dd class="font-semibold text-gray-900 mt-0.5">{{ $registration->hewan->berat_estimasi }}</dd>
                        </div>
                        @endif
                        <div>
                            <dt class="text-gray-500">Tipe</dt>
                            <dd class="mt-0.5">
                                @if($registration->hewan?->is_patungan)
                                <span class="px-2 py-0.5 bg-blue-100 text-blue-700 text-xs font-semibold rounded-full">Iuran / Patungan (7 orang)</span>
                                @else
                                <span class="px-2 py-0.5 bg-purple-100 text-purple-700 text-xs font-semibold rounded-full">Perorangan (1 orang)</span>
                                @endif
                            </dd>
                        </div>
                    </div>
                </div>

                {{-- Slot Progress --}}
                @if($registration->hewan?->is_patungan)
                <div class="mt-5 pt-5 border-t border-gray-100">
                    <div class="flex justify-between text-sm mb-2">
                        <span class="text-gray-600 font-medium">Slot Hewan Ini</span>
                        <span class="font-bold text-gray-900">{{ $summary['slot_terisi'] }} / {{ $summary['max_peserta'] }}</span>
                    </div>
                    <div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden">
                        @php $persen = $summary['max_peserta'] > 0 ? round(($summary['slot_terisi'] / $summary['max_peserta']) * 100) : 0; @endphp
                        <div class="h-3 rounded-full {{ $summary['is_penuh'] ? 'bg-red-500' : 'bg-emerald-500' }} transition-all"
                             style="width: {{ $persen }}%"></div>
                    </div>
                    <div class="flex gap-4 mt-2 text-xs text-gray-500">
                        <span>✅ {{ $summary['confirmed'] }} terkonfirmasi</span>
                        <span>⏳ {{ $summary['pending'] }} pending</span>
                        <span>🔓 {{ $summary['slot_tersedia'] }} tersedia</span>
                    </div>
                </div>
                @endif
            </div>

            {{-- Info Peserta --}}
            <div class="bg-white rounded-2xl border border-gray-200 p-6">
                <h2 class="font-bold text-gray-900 mb-5">Data Peserta (Shohibul Qurban)</h2>
                <dl class="grid grid-cols-2 gap-x-6 gap-y-4 text-sm">
                    <div>
                        <dt class="text-gray-500">Nama Pendaftar</dt>
                        <dd class="font-semibold text-gray-900 mt-0.5">{{ $registration->nama_peserta }}</dd>
                    </div>
                    <div>
                        <dt class="text-gray-500">Atas Nama Qurban</dt>
                        <dd class="font-semibold text-gray-900 mt-0.5">{{ $registration->atas_nama ?: '-' }}</dd>
                    </div>
                    <div>
                        <dt class="text-gray-500">Telepon</dt>
                        <dd class="font-semibold text-gray-900 mt-0.5">
                            @if($registration->telepon)
                            <a href="https://wa.me/62{{ ltrim($registration->telepon, '0') }}" target="_blank"
                               class="text-emerald-600 hover:underline">{{ $registration->telepon }}</a>
                            @else -
                            @endif
                        </dd>
                    </div>
                    <div>
                        <dt class="text-gray-500">Email</dt>
                        <dd class="font-semibold text-gray-900 mt-0.5">{{ $registration->email ?: '-' }}</dd>
                    </div>
                    @if($registration->alamat)
                    <div class="col-span-2">
                        <dt class="text-gray-500">Alamat</dt>
                        <dd class="font-semibold text-gray-900 mt-0.5">{{ $registration->alamat }}</dd>
                    </div>
                    @endif
                    @if($registration->catatan)
                    <div class="col-span-2">
                        <dt class="text-gray-500">Catatan</dt>
                        <dd class="font-semibold text-gray-900 mt-0.5">{{ $registration->catatan }}</dd>
                    </div>
                    @endif
                </dl>

                <div class="mt-5 pt-5 border-t border-gray-200 flex justify-between items-center">
                    <span class="text-gray-700 font-semibold">Total Pembayaran</span>
                    <span class="text-2xl font-bold text-emerald-600">{{ $registration->total_bayar_format }}</span>
                </div>
            </div>

            {{-- Bukti Transfer --}}
            @if($registration->paymentConfirmation)
            <div class="bg-white rounded-2xl border border-gray-200 p-6">
                <h2 class="font-bold text-gray-900 mb-5">Konfirmasi Transfer dari Peserta</h2>
                @php $pc = $registration->paymentConfirmation; @endphp
                <dl class="grid grid-cols-2 gap-x-6 gap-y-4 text-sm mb-5">
                    <div>
                        <dt class="text-gray-500">Nama Pengirim</dt>
                        <dd class="font-semibold text-gray-900 mt-0.5">{{ $pc->nama_pengirim }}</dd>
                    </div>
                    <div>
                        <dt class="text-gray-500">Bank / E-Wallet</dt>
                        <dd class="font-semibold text-gray-900 mt-0.5">{{ $pc->bank_pengirim }}</dd>
                    </div>
                    <div>
                        <dt class="text-gray-500">No. Rekening</dt>
                        <dd class="font-semibold text-gray-900 mt-0.5">{{ $pc->nomor_rekening_pengirim ?: '-' }}</dd>
                    </div>
                    <div>
                        <dt class="text-gray-500">Jumlah Transfer</dt>
                        <dd class="font-semibold text-gray-900 mt-0.5">{{ $pc->jumlah_format }}</dd>
                    </div>
                    <div>
                        <dt class="text-gray-500">Tanggal Transfer</dt>
                        <dd class="font-semibold text-gray-900 mt-0.5">{{ $pc->tanggal_transfer->format('d F Y') }}</dd>
                    </div>
                    <div>
                        <dt class="text-gray-500">Dikirim Pada</dt>
                        <dd class="font-semibold text-gray-900 mt-0.5">{{ $pc->created_at->format('d M Y, H:i') }}</dd>
                    </div>
                </dl>

                @if($pc->bukti_url)
                <div>
                    <p class="text-sm text-gray-500 mb-2">Bukti Transfer:</p>
                    <a href="{{ $pc->bukti_url }}" target="_blank">
                        <img src="{{ $pc->bukti_url }}" alt="Bukti Transfer"
                             class="max-w-sm w-full rounded-xl border border-gray-200 hover:opacity-90 transition-opacity cursor-zoom-in">
                    </a>
                </div>
                @endif
            </div>
            @else
            <div class="bg-gray-50 rounded-2xl border border-dashed border-gray-300 p-6 text-center">
                <p class="text-gray-400 text-sm">Peserta belum mengirim konfirmasi transfer</p>
            </div>
            @endif

            {{-- Catatan Admin --}}
            @if($registration->catatan_admin && !$registration->is_pending)
            <div class="bg-amber-50 rounded-2xl border border-amber-200 p-5">
                <p class="text-sm font-semibold text-amber-800 mb-1">Catatan Admin</p>
                <p class="text-sm text-amber-700">{{ $registration->catatan_admin }}</p>
                @if($registration->confirmedBy)
                <p class="text-xs text-amber-600 mt-1">oleh: {{ $registration->confirmedBy->name }}</p>
                @endif
            </div>
            @endif

        </div>

        {{-- RIGHT: Actions ─────────────────────────────────────────────── --}}
        <div class="space-y-5">

            {{-- Aksi Verifikasi --}}
            @if($registration->is_pending)
            <div class="bg-white rounded-2xl border border-gray-200 p-6">
                <h3 class="font-bold text-gray-900 mb-4">Aksi Verifikasi</h3>

                {{-- Konfirmasi --}}
                <form action="{{ route('qurban.registrations.confirm', $registration) }}" method="POST" class="mb-4">
                    @csrf
                    <div class="mb-3">
                        <label class="block text-xs font-medium text-gray-600 mb-1">Catatan (opsional)</label>
                        <textarea name="catatan_admin" rows="2"
                                  placeholder="Catatan konfirmasi..."
                                  class="w-full px-3 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-emerald-500 text-sm resize-none"></textarea>
                    </div>
                    <button type="submit"
                            onclick="return confirm('Konfirmasi pendaftaran qurban ini?')"
                            class="w-full py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl transition-all shadow-sm flex items-center justify-center gap-2">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        Konfirmasi Pembayaran
                    </button>
                </form>

                <div class="relative">
                    <div class="absolute inset-0 flex items-center"><span class="w-full border-t border-gray-200"></span></div>
                    <div class="relative flex justify-center"><span class="bg-white px-3 text-xs text-gray-400">atau</span></div>
                </div>

                {{-- Batalkan --}}
                <form action="{{ route('qurban.registrations.cancel', $registration) }}" method="POST" class="mt-4">
                    @csrf
                    <div class="mb-3">
                        <label class="block text-xs font-medium text-gray-600 mb-1">
                            Alasan Pembatalan <span class="text-red-500">*</span>
                        </label>
                        <textarea name="catatan_admin" rows="2"
                                  required
                                  placeholder="Jelaskan alasan pembatalan..."
                                  class="w-full px-3 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-red-500 text-sm resize-none"></textarea>
                    </div>
                    <button type="submit"
                            onclick="return confirm('Batalkan pendaftaran ini? Slot akan dikembalikan.')"
                            class="w-full py-2.5 border-2 border-red-400 text-red-600 font-semibold rounded-xl hover:bg-red-50 transition-all text-sm">
                        Batalkan Pendaftaran
                    </button>
                </form>
            </div>
            @else
            <div class="bg-white rounded-2xl border border-gray-200 p-6">
                <h3 class="font-bold text-gray-900 mb-3">Status Akhir</h3>
                <div class="p-4 rounded-xl
                    {{ $registration->is_confirmed ? 'bg-emerald-50 border border-emerald-200' : 'bg-red-50 border border-red-200' }}">
                    <p class="text-sm font-semibold {{ $registration->is_confirmed ? 'text-emerald-800' : 'text-red-800' }}">
                        {{ $registration->status_label }}
                    </p>
                    @if($registration->confirmed_at)
                    <p class="text-xs {{ $registration->is_confirmed ? 'text-emerald-600' : 'text-red-600' }} mt-1">
                        {{ $registration->confirmed_at->format('d F Y, H:i') }} WIB
                    </p>
                    @endif
                </div>
            </div>
            @endif

            {{-- Link Halaman Pembayaran --}}
            <div class="bg-white rounded-2xl border border-gray-200 p-5">
                <p class="text-xs font-semibold text-gray-600 mb-2">Link Pembayaran Peserta</p>
                <div class="flex items-center gap-2 p-2.5 bg-gray-50 rounded-xl border border-gray-200">
                    <p class="text-xs text-gray-500 truncate flex-1 font-mono">
                        {{ $registration->kode_registrasi }}
                    </p>
                    <button onclick="navigator.clipboard.writeText('{{ route('qurban.payment', $registration->kode_registrasi) }}')"
                            class="text-xs px-2.5 py-1 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg flex-shrink-0 transition-all">
                        Salin
                    </button>
                </div>
                <a href="{{ route('qurban.payment', $registration->kode_registrasi) }}" target="_blank"
                   class="mt-2 block text-center text-xs text-emerald-600 hover:underline">
                    Buka halaman peserta →
                </a>
            </div>

            {{-- WhatsApp --}}
            @if($registration->telepon)
            <div class="bg-white rounded-2xl border border-gray-200 p-5">
                <p class="text-xs font-semibold text-gray-600 mb-2">Hubungi via WhatsApp</p>
                @php
                $wa = '62' . ltrim($registration->telepon, '0');
                $msg = urlencode("Assalamu'alaikum *{$registration->nama_peserta}*, terima kasih telah mendaftar qurban di LAZIZNU Bojonegoro. Kode pendaftaran Anda: *{$registration->kode_registrasi}*. Silakan lakukan pembayaran sesuai instruksi.");
                @endphp
                <a href="https://wa.me/{{ $wa }}?text={{ $msg }}" target="_blank"
                   class="flex items-center justify-center gap-2 w-full py-2.5 bg-green-500 hover:bg-green-600 text-white text-sm font-semibold rounded-xl transition-all">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                    Kirim WA
                </a>
            </div>
            @endif

        </div>
    </div>

</x-layouts::app>
