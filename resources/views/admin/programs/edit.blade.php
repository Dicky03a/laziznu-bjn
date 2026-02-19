{{-- resources/views/admin/programs/edit.blade.php --}}
<x-layouts::app :title="__('Edit Program')">

      {{-- Header --}}
      <div class="mb-6 flex items-center gap-3">
            <a href="{{ route('programs.index') }}"
                  class="p-2 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-lg transition-all">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                  </svg>
            </a>
            <div>
                  <h1 class="text-2xl font-bold text-gray-900">Edit Program</h1>
                  <p class="text-sm text-gray-500 mt-0.5">
                        <span class="inline-flex items-center gap-1.5">
                              <span class="inline-block w-2 h-2 rounded-full {{ $program->type === 'infaq' ? 'bg-blue-500' : 'bg-purple-500' }}"></span>
                              <span class="font-medium {{ $program->type === 'infaq' ? 'text-blue-600' : 'text-purple-600' }}">
                                    {{ ucfirst($program->type) }}
                              </span>
                              &middot;
                              {{ $program->nama }}
                        </span>
                  </p>
            </div>
      </div>

      <form action="{{ route('programs.update', $program) }}"
            method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin.programs._form')
      </form>

      @push('scripts')
      @endpush

</x-layouts::app>