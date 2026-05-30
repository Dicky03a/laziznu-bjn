<x-layouts::app :title="__('Edit Program Distribusi')">

      <div class="flex items-center justify-between mb-6">
            <div>
                  <h1 class="text-2xl font-bold text-gray-900">Edit Program Distribusi</h1>
                  <p class="text-sm text-gray-500 mt-1">Perbarui detail distribusi dan sumber dana yang digunakan.</p>
            </div>
            <a href="{{ route('distribution-programs.index') }}"
                  class="inline-flex items-center gap-2 px-5 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 text-sm font-semibold rounded-xl transition-all shadow-sm hover:shadow-md">
                  Kembali ke daftar
            </a>
      </div>

      <form action="{{ route('distribution-programs.update', $distributionProgram) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin.distribution-programs._form')

            <div class="mt-6 flex justify-end gap-3">
                  <a href="{{ route('distribution-programs.index') }}" class="px-5 py-2.5 rounded-xl border border-gray-200 text-sm font-semibold text-gray-700 hover:bg-gray-50 transition-all">Batal</a>
                  <button type="submit" class="px-5 py-2.5 bg-emerald-600 text-white rounded-xl text-sm font-semibold hover:bg-emerald-700 transition-all">Perbarui Program Distribusi</button>
            </div>
      </form>

</x-layouts::app>