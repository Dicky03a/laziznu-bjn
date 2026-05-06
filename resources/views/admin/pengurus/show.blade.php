<x-layouts::app :title="__('Sekilas NU Care')">
      <div class="space-y-6">

            <!-- $1 -->
            <nav class="flex items-center gap-2 text-sm text-gray-500">
                  <a href="{{ route('pengurus.index') }}" class="hover:text-emerald-600 transition">Data Pengurus</a>
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                  </svg>
                  <span class="text-gray-900 font-medium truncate max-w-xs">{{ $pengurus->nama_lengkap }}</span>
            </nav>

            <!-- $1 -->
            @if(session('success'))
            <x-alert type="success" :message="session('success')" />
            @endif

            <!-- $1 -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden">
                  <!-- $1 -->

                  <div class="px-6 pb-6">
                        <div class="flex flex-wrap items-center mt-6 gap-3">
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

            <!-- $1 -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                  <!-- $1 -->
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

                  <!-- $1 -->
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

            <!-- $1 -->
            <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-5">
                  <div class="flex flex-wrap gap-6 text-xs text-gray-400">
                        <span>ID: #{{ $pengurus->id }}</span>
                        <span>Dibuat: {{ $pengurus->created_at->format('d M Y, H:i') }}</span>
                        <span>Diperbarui: {{ $pengurus->updated_at->format('d M Y, H:i') }}</span>
                  </div>
            </div>

            <!-- $1 -->
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