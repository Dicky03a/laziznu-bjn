<x-layouts::app :title="'Transaksi ' . $transaction->kode_transaksi">

      <div class="mb-6 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-3">
            <div class="flex items-center gap-3">
                  <a href="{{ route('transactions.index') }}"
                        class="p-2 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-lg transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                  </a>
                  <div>
                        <h1 class="text-xl font-bold text-gray-900 font-mono">{{ $transaction->kode_transaksi }}</h1>
                        <p class="text-sm text-gray-400">{{ $transaction->created_at->format('d F Y, H:i') }} WIB</p>
                  </div>
            </div>

            @php
            $badge = [
            'pending' => 'bg-yellow-100 text-yellow-800 border border-yellow-200',
            'confirmed' => 'bg-emerald-100 text-emerald-800 border border-emerald-200',
            'rejected' => 'bg-red-100 text-red-800 border border-red-200',
            ][$transaction->status] ?? 'bg-gray-100 text-gray-700';
            @endphp
            <span class="self-start sm:self-auto inline-flex items-center gap-1.5 px-4 py-2 rounded-full text-sm font-semibold {{ $badge }}">
                  {{ $transaction->status_label }}
            </span>
      </div>

      @if(session('success'))
      <div class="mb-5 p-4 bg-emerald-50 border border-emerald-200 rounded-xl text-emerald-700 text-sm flex items-center gap-2">
            <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>
            {{ session('success') }}
      </div>
      @endif

      <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- LEFT: Detail --}}
            <div class="lg:col-span-2 space-y-5">

                  {{-- Info Transaksi --}}
                  <div class="bg-white rounded-2xl border border-gray-200 p-6">
                        <h2 class="font-bold text-gray-900 mb-5">Detail Transaksi</h2>
                        <dl class="grid grid-cols-2 gap-x-6 gap-y-4 text-sm">
                              <div>
                                    <dt class="text-gray-500">Jenis</dt>
                                    <dd class="font-semibold text-gray-900 mt-0.5">
                                          {{ $transaction->type_label }}
                                          @if($transaction->subtype)
                                          <span class="text-gray-500">({{ ucfirst($transaction->subtype) }})</span>
                                          @endif
                                    </dd>
                              </div>
                              @if($transaction->program)
                              <div>
                                    <dt class="text-gray-500">Program</dt>
                                    <dd class="font-semibold text-gray-900 mt-0.5">{{ $transaction->program->nama }}</dd>
                              </div>
                              @endif
                              <div>
                                    <dt class="text-gray-500">Nama Donatur</dt>
                                    <dd class="font-semibold text-gray-900 mt-0.5">
                                          {{ $transaction->nama_donatur }}
                                          @if($transaction->is_anonim)
                                          <span class="ml-1 text-xs bg-gray-100 text-gray-600 px-1.5 py-0.5 rounded">Anonim</span>
                                          @endif
                                    </dd>
                              </div>
                              <div>
                                    <dt class="text-gray-500">Email</dt>
                                    <dd class="font-semibold text-gray-900 mt-0.5">{{ $transaction->email ?? '-' }}</dd>
                              </div>
                              <div>
                                    <dt class="text-gray-500">Telepon</dt>
                                    <dd class="font-semibold text-gray-900 mt-0.5">
                                          @if($transaction->telepon)
                                          <a href="https://wa.me/62{{ ltrim($transaction->telepon, '0') }}" target="_blank"
                                                class="text-emerald-600 hover:underline">{{ $transaction->telepon }}</a>
                                          @else -
                                          @endif
                                    </dd>
                              </div>
                              <div>
                                    <dt class="text-gray-500">Tanggal</dt>
                                    <dd class="font-semibold text-gray-900 mt-0.5">{{ $transaction->created_at->format('d F Y, H:i') }}</dd>
                              </div>
                              @if($transaction->catatan)
                              <div class="col-span-2">
                                    <dt class="text-gray-500">Catatan Donatur</dt>
                                    <dd class="font-semibold text-gray-900 mt-0.5">{{ $transaction->catatan }}</dd>
                              </div>
                              @endif
                        </dl>

                        {{-- Metadata khusus --}}
                        @if($transaction->metadata && count($transaction->metadata) > 0)
                        <div class="mt-5 pt-5 border-t border-gray-100">
                              <h3 class="text-sm font-semibold text-gray-700 mb-3">Detail Perhitungan</h3>
                              <dl class="grid grid-cols-2 gap-x-6 gap-y-3 text-sm bg-gray-50 rounded-xl p-4">
                                    @foreach($transaction->metadata as $key => $value)
                                    <div>
                                          <dt class="text-gray-500 capitalize">
                                                {{ str_replace('_', ' ', $key) }}
                                          </dt>
                                          <dd class="font-semibold text-gray-900 mt-0.5">

                                                @if(is_numeric($value))

                                                @if(str_contains($key, 'persen'))
                                                {{ $value }}%
                                                @else
                                                Rp {{ number_format((int) $value, 0, ',', '.') }}
                                                @endif

                                                @else
                                                {{ $value }}
                                                @endif

                                          </dd>
                                    </div>
                                    @endforeach
                              </dl>
                        </div>
                        @endif

                        <div class="mt-5 pt-5 border-t border-gray-200 flex justify-between items-center">
                              <span class="text-gray-700 font-semibold">Total Pembayaran</span>
                              <span class="text-2xl font-bold text-emerald-600">{{ $transaction->jumlah_format }}</span>
                        </div>
                  </div>

                  {{-- Bukti Transfer --}}
                  @if($transaction->paymentConfirmation)
                  <div class="bg-white rounded-2xl border border-gray-200 p-6">
                        <h2 class="font-bold text-gray-900 mb-5">Konfirmasi Transfer dari Donatur</h2>
                        @php $pc = $transaction->paymentConfirmation; @endphp
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
                                    <dd class="font-semibold text-gray-900 mt-0.5">{{ $pc->nomor_rekening_pengirim ?? '-' }}</dd>
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
                                    <img src="{{ $pc->bukti_url }}"
                                          alt="Bukti Transfer"
                                          class="max-w-sm w-full rounded-xl border border-gray-200 hover:opacity-90 transition-opacity cursor-zoom-in">
                              </a>
                        </div>
                        @endif
                  </div>
                  @else
                  <div class="bg-gray-50 rounded-2xl border border-dashed border-gray-200 p-6 text-center">
                        <p class="text-gray-400 text-sm">Donatur belum mengirim konfirmasi transfer</p>
                  </div>
                  @endif

                  {{-- Admin Notes --}}
                  @if($transaction->catatan_admin)
                  <div class="bg-amber-50 rounded-2xl border border-amber-200 p-5">
                        <p class="text-sm font-semibold text-amber-800 mb-1">Catatan Admin</p>
                        <p class="text-sm text-amber-700">{{ $transaction->catatan_admin }}</p>
                        @if($transaction->confirmedBy)
                        <p class="text-xs text-amber-600 mt-1">oleh: {{ $transaction->confirmedBy->name }}</p>
                        @endif
                  </div>
                  @endif

            </div>

            {{-- RIGHT: Actions --}}
            <div class="space-y-5">

                  {{-- Aksi Konfirmasi --}}
                  @if($transaction->is_pending)
                  <div class="bg-white rounded-2xl border border-gray-200 p-6">
                        <h3 class="font-bold text-gray-900 mb-4">Aksi Verifikasi</h3>

                        {{-- Konfirmasi --}}
                        <form action="{{ route('transactions.confirm', $transaction) }}" method="POST" class="mb-4">
                              @csrf
                              <div class="mb-3">
                                    <label class="block text-xs font-medium text-gray-600 mb-1">Catatan (opsional)</label>
                                    <textarea name="catatan_admin" rows="2" placeholder="Catatan konfirmasi..."
                                          class="w-full px-3 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-emerald-500 text-sm resize-none"></textarea>
                              </div>
                              <button type="submit"
                                    onclick="return confirm('Konfirmasi transaksi ini?')"
                                    class="w-full py-3 bg-emerald-600 hover:bg-emerald-700 text-white font-bold rounded-xl transition-all shadow-sm flex items-center justify-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                    </svg>
                                    Konfirmasi Transaksi
                              </button>
                        </form>

                        <div class="relative">
                              <div class="absolute inset-0 flex items-center"><span class="w-full border-t border-gray-200"></span></div>
                              <div class="relative flex justify-center"><span class="bg-white px-3 text-xs text-gray-400">atau</span></div>
                        </div>

                        {{-- Tolak --}}
                        <form action="{{ route('transactions.reject', $transaction) }}" method="POST" class="mt-4">
                              @csrf
                              <div class="mb-3">
                                    <label class="block text-xs font-medium text-gray-600 mb-1">Alasan Penolakan <span class="text-red-500">*</span></label>
                                    <textarea name="catatan_admin" rows="2" placeholder="Jelaskan alasan penolakan..."
                                          required
                                          class="w-full px-3 py-2.5 rounded-xl border border-gray-300 focus:ring-2 focus:ring-red-500 text-sm resize-none"></textarea>
                              </div>
                              <button type="submit"
                                    onclick="return confirm('Tolak transaksi ini?')"
                                    class="w-full py-2.5 border-2 border-red-400 text-red-600 font-semibold rounded-xl hover:bg-red-50 transition-all text-sm">
                                    Tolak Transaksi
                              </button>
                        </form>
                  </div>
                  @else
                  <div class="bg-white rounded-2xl border border-gray-200 p-6">
                        <h3 class="font-bold text-gray-900 mb-3">Status Akhir</h3>
                        <div class="p-4 rounded-xl {{ $transaction->is_confirmed ? 'bg-emerald-50 border border-emerald-200' : 'bg-red-50 border border-red-200' }}">
                              <p class="text-sm font-semibold {{ $transaction->is_confirmed ? 'text-emerald-800' : 'text-red-800' }}">
                                    {{ $transaction->status_label }}
                              </p>
                              @if($transaction->confirmed_at)
                              <p class="text-xs {{ $transaction->is_confirmed ? 'text-emerald-600' : 'text-red-600' }} mt-1">
                                    {{ $transaction->confirmed_at->format('d F Y, H:i') }} WIB
                              </p>
                              @endif
                              @if($transaction->catatan_admin)
                              <p class="text-xs mt-2 {{ $transaction->is_confirmed ? 'text-emerald-700' : 'text-red-700' }}">
                                    {{ $transaction->catatan_admin }}
                              </p>
                              @endif
                        </div>
                  </div>
                  @endif

                  {{-- Link publik --}}
                  <div class="bg-white rounded-2xl border border-gray-200 p-5">
                        <p class="text-xs font-semibold text-gray-600 mb-2">Link Halaman Pembayaran</p>
                        <div class="flex items-center gap-2 p-2.5 bg-gray-50 rounded-xl border border-gray-200">
                              <p class="text-xs text-gray-500 truncate flex-1">{{ route('payment.show', $transaction->kode_transaksi) }}</p>
                              <button onclick="navigator.clipboard.writeText('{{ route('payment.show', $transaction->kode_transaksi) }}')"
                                    class="text-xs px-2.5 py-1 bg-gray-200 hover:bg-gray-300 text-gray-700 rounded-lg flex-shrink-0 transition-all">
                                    Salin
                              </button>
                        </div>
                        <a href="{{ route('payment.show', $transaction->kode_transaksi) }}" target="_blank"
                              class="mt-2 block text-center text-xs text-emerald-600 hover:underline">
                              Buka halaman donatur →
                        </a>
                  </div>

            </div>
      </div>

</x-layouts::app>