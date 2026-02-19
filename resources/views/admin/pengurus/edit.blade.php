<x-layouts::app :title="__('Sekilas NU Care')">
      <div class="space-y-6">

            {{-- Breadcrumb --}}
            <nav class="flex items-center gap-2 text-sm text-gray-500">
                  <a href="{{ route('pengurus.index') }}" class="hover:text-emerald-600 transition">Data Pengurus</a>
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                  </svg>
                  <a href="{{ route('pengurus.show', $pengurus) }}" class="hover:text-emerald-600 transition truncate max-w-xs">
                        {{ $pengurus->nama_lengkap }}
                  </a>
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                  </svg>
                  <span class="text-gray-900 font-medium">Edit</span>
            </nav>

            {{-- Page Title --}}
            <div class="flex items-start justify-between">
                  <div>
                        <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Edit Data Pengurus</h1>
                        <p class="mt-1 text-sm text-gray-500">Perbarui informasi pengurus di bawah ini.</p>
                  </div>
                  <a href="{{ route('pengurus.show', $pengurus) }}"
                        class="inline-flex items-center gap-1.5 text-sm text-gray-500 hover:text-gray-700 bg-white border border-gray-300 px-3 py-1.5 rounded-lg transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                        </svg>
                        Lihat Detail
                  </a>
            </div>

            {{-- Form --}}
            <form method="POST" action="{{ route('pengurus.update', $pengurus) }}"
                  enctype="multipart/form-data" novalidate>
                  @csrf @method('PUT')
                  @include('admin.pengurus._form')
            </form>
      </div>
</x-layouts::app>