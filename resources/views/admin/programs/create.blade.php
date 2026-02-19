{{-- resources/views/admin/programs/create.blade.php --}}
<x-layouts::app :title="__('Tambah Program')">

      {{-- Header --}}
      <div class="mb-6 flex items-center gap-3">
            <a href="{{ route('programs.index') }}"
                  class="p-2 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-lg transition-all">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                  </svg>
            </a>
            <div>
                  <h1 class="text-2xl font-bold text-gray-900">Tambah Program Baru</h1>
                  <p class="text-sm text-gray-500 mt-0.5">Buat program infaq atau donasi baru</p>
            </div>
      </div>

      <form action="{{ route('programs.store') }}"
            method="POST"
            enctype="multipart/form-data">
            @csrf
            @include('admin.programs._form')
      </form>

      @push('scripts')
      @endpush

</x-layouts::app>