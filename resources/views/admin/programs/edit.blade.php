<x-layouts::app :title="isset($program) ? __('Edit Program') : __('Tambah Program')">

      <div class="mb-6 flex items-center gap-3">
            <a href="{{ route('programs.index') }}"
                  class="p-2 text-gray-500 hover:text-gray-700 hover:bg-gray-100 rounded-lg transition-all">
                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                  </svg>
            </a>
            <div>
                  <h1 class="text-2xl font-bold text-gray-900">
                        {{ isset($program) ? 'Edit Program' : 'Tambah Program Baru' }}
                  </h1>
                  <p class="text-sm text-gray-500 mt-0.5">Program Infaq atau Donasi</p>
            </div>
      </div>

      @include('admin.programs._form')
      @push('scripts')
      <script>
            function previewImage(input) {
                  if (input.files && input.files[0]) {
                        const reader = new FileReader();
                        reader.onload = e => {
                              const img = document.getElementById('preview-img');
                              img.src = e.target.result;
                              img.classList.remove('hidden');
                        };
                        reader.readAsDataURL(input.files[0]);
                  }
            }
      </script>
      @endpush

</x-layouts::app>