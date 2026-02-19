<x-layouts::app :title="__('Sekilas NU Care')">
      <div class="space-y-6">

            {{-- Breadcrumb --}}
            <nav class="flex items-center gap-2 text-sm text-gray-500">
                  <a href="{{ route('pengurus.index') }}" class="hover:text-emerald-600 transition">Data Pengurus</a>
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                  </svg>
                  <span class="text-gray-900 font-medium truncate max-w-xs">{{ $pengurus->nama_lengkap }}</span>
            </nav>

            {{-- Flash --}}
            @if(session('success'))
            <x-alert type="success" :message="session('success')" />
            @endif

            {{-- Header Card --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                  {{-- Banner --}}
                  <div class="h-24 bg-gradient-to-r from-emerald-600 to-teal-500"></div>

                  <div class="px-6 pb-6">
                        <div class="flex flex-col sm:flex-row sm:items-end sm:justify-between gap-4 -mt-12 mb-4">
                              {{-- Avatar --}}
                              <div class="w-24 h-24 rounded-full border-4 border-white shadow-md overflow-hidden bg-emerald-100 flex items-center justify-center shrink-0">
                                    @if($pengurus->foto)
                                    <img src="{{ $pengurus->foto_url }}" alt="{{ $pengurus->nama }}"
                                          class="w-full h-full object-cover" />
                                    @else
                                    <span class="text-emerald-600 font-bold text-3xl">
                                          {{ strtoupper(substr($pengurus->nama, 0, 1)) }}
                                    </span>
                                    @endif
                              </div>

                              {{-- Action Buttons --}}
                              <div class="flex items-center gap-2">
                                    <a href="{{ route('pengurus.edit', $pengurus) }}"
                                          class="inline-flex items-center gap-1.5 bg-amber-500 hover:bg-amber-600 text-white text-sm font-medium px-4 py-2 rounded-lg transition">
                                          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                          </svg>
                                          Edit
                                    </a>
                                    <form method="POST"
                                          action="{{ route('pengurus.destroy', $pengurus) }}"
                                          onsubmit="return confirm('Hapus pengurus ini secara permanen?')">
                                          @csrf @method('DELETE')
                                          <button type="submit"
                                                class="inline-flex items-center gap-1.5 bg-red-500 hover:bg-red-600 text-white text-sm font-medium px-4 py-2 rounded-lg transition">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                                Hapus
                                          </button>
                                    </form>
                              </div>
                        </div>

                        {{-- Nama & Status --}}
                        <div class="flex flex-wrap items-center gap-3">
                              <h1 class="text-xl font-bold text-gray-900">{{ $pengurus->nama_lengkap }}</h1>
                              @if($pengurus->is_active)
                              <span class="inline-flex items-center gap-1 bg-emerald-100 text-emerald-700 text-xs font-semibold px-2.5 py-1 rounded-full">
                                    <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span> Aktif
                              </span>
                              @else
                              <span class="inline-flex items-center gap-1 bg-gray-100 text-gray-500 text-xs font-semibold px-2.5 py-1 rounded-full">
                                    <span class="w-1.5 h-1.5 bg-gray-400 rounded-full"></span> Nonaktif
                              </span>
                              @endif
                        </div>
                        <p class="mt-1 text-emerald-700 font-medium text-sm">{{ $pengurus->jabatan_label }}</p>
                  </div>
            </div>

            {{-- Detail Grid --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                  {{-- Informasi Jabatan --}}
                  <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <h2 class="text-base font-semibold text-gray-800 mb-4 pb-3 border-b border-gray-100">
                              Informasi Jabatan
                        </h2>
                        <dl class="space-y-3 text-sm">
                              <div class="flex justify-between gap-4">
                                    <dt class="text-gray-500">Jabatan</dt>
                                    <dd class="font-medium text-gray-900 text-right">{{ $pengurus->jabatan }}</dd>
                              </div>
                              @if($pengurus->bidang)
                              <div class="flex justify-between gap-4">
                                    <dt class="text-gray-500">Bidang</dt>
                                    <dd class="font-medium text-gray-900 text-right">{{ $pengurus->bidang }}</dd>
                              </div>
                              @endif
                              <div class="flex justify-between gap-4">
                                    <dt class="text-gray-500">Masa Khidmat</dt>
                                    <dd class="font-medium text-gray-900">{{ $pengurus->periode }}</dd>
                              </div>
                              <div class="flex justify-between gap-4">
                                    <dt class="text-gray-500">Urutan Tampil</dt>
                                    <dd class="font-medium text-gray-900">{{ $pengurus->urutan }}</dd>
                              </div>
                              @if($pengurus->no_sk)
                              <div class="pt-3 border-t border-gray-100">
                                    <dt class="text-gray-500 mb-1">Nomor SK</dt>
                                    <dd class="font-mono text-xs bg-gray-50 rounded px-2 py-1.5 text-gray-700 break-all">
                                          {{ $pengurus->no_sk }}
                                    </dd>
                              </div>
                              @endif
                        </dl>
                  </div>

                  {{-- Informasi Kontak --}}
                  <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-6">
                        <h2 class="text-base font-semibold text-gray-800 mb-4 pb-3 border-b border-gray-100">
                              Informasi Kontak
                        </h2>
                        <dl class="space-y-3 text-sm">
                              <div class="flex justify-between gap-4">
                                    <dt class="text-gray-500">Nama Lengkap</dt>
                                    <dd class="font-medium text-gray-900 text-right">{{ $pengurus->nama_lengkap }}</dd>
                              </div>
                              @if($pengurus->gelar_depan)
                              <div class="flex justify-between gap-4">
                                    <dt class="text-gray-500">Gelar Depan</dt>
                                    <dd class="font-medium text-gray-900">{{ $pengurus->gelar_depan }}</dd>
                              </div>
                              @endif
                              @if($pengurus->gelar_belakang)
                              <div class="flex justify-between gap-4">
                                    <dt class="text-gray-500">Gelar Belakang</dt>
                                    <dd class="font-medium text-gray-900">{{ $pengurus->gelar_belakang }}</dd>
                              </div>
                              @endif
                              <div class="flex justify-between gap-4">
                                    <dt class="text-gray-500">Email</dt>
                                    <dd class="font-medium text-gray-900">
                                          @if($pengurus->email)
                                          <a href="mailto:{{ $pengurus->email }}"
                                                class="text-emerald-600 hover:underline">{{ $pengurus->email }}</a>
                                          @else
                                          <span class="text-gray-300">—</span>
                                          @endif
                                    </dd>
                              </div>
                              <div class="flex justify-between gap-4">
                                    <dt class="text-gray-500">No. HP</dt>
                                    <dd class="font-medium text-gray-900">
                                          @if($pengurus->no_hp)
                                          <a href="https://wa.me/{{ preg_replace('/^0/', '62', $pengurus->no_hp) }}"
                                                target="_blank" class="text-emerald-600 hover:underline">
                                                {{ $pengurus->no_hp }}
                                          </a>
                                          @else
                                          <span class="text-gray-300">—</span>
                                          @endif
                                    </dd>
                              </div>
                        </dl>
                  </div>
            </div>

            {{-- Meta --}}
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5">
                  <div class="flex flex-wrap gap-6 text-xs text-gray-400">
                        <span>ID: #{{ $pengurus->id }}</span>
                        <span>Dibuat: {{ $pengurus->created_at->format('d M Y, H:i') }}</span>
                        <span>Diperbarui: {{ $pengurus->updated_at->format('d M Y, H:i') }}</span>
                  </div>
            </div>

            {{-- Back --}}
            <div>
                  <a href="{{ route('pengurus.index') }}"
                        class="inline-flex items-center gap-1.5 text-sm text-gray-500 hover:text-gray-700 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                        Kembali ke Daftar
                  </a>
            </div>
      </div>
</x-layouts::app>