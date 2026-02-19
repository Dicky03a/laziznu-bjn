<x-layouts::app :title="__('Sekilas NU Care')">
      <div class="space-y-6">

            {{-- Breadcrumb --}}
            <nav class="flex items-center gap-2 text-sm text-gray-500">
                  <a href="{{ route('pengurus.index') }}" class="hover:text-emerald-600 transition">Data Pengurus</a>
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                  </svg>
                  <span class="text-gray-900 font-medium">Tambah Pengurus</span>
            </nav>

            {{-- Page Title --}}
            <div>
                  <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Tambah Pengurus Baru</h1>
                  <p class="mt-1 text-sm text-gray-500">Isi form di bawah untuk menambahkan data pengurus.</p>
            </div>

            {{-- Form --}}
            <form method="POST" action="{{ route('pengurus.store') }}" enctype="multipart/form-data"
                  novalidate>
                  @csrf
                  @include('admin.pengurus._form')
            </form>
      </div>
</x-layouts::app>