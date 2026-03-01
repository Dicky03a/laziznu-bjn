<x-layouts::app :title="__('Laporan Tahunan')">

      {{-- Header --}}
      <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-6">
            <div>
                  <h1 class="text-2xl font-bold text-gray-900">Laporan Bulanan</h1>
                  <p class="text-sm text-gray-500 mt-1">Kelola dan pantau semua laporan bulanan</p>
            </div>
            <a href="{{ route('laporan-bulanan.create') }}"
                  class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold rounded-lg transition-colors shadow-sm">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                  </svg>
                  Tambah Laporan
            </a>
      </div>

      {{-- Flash Messages --}}
      @if($errors->any())
      <div class="mb-4 px-4 py-3 bg-red-50 border border-red-200 rounded-lg text-sm">
            <p class="font-semibold text-red-800 mb-1">Terjadi Kesalahan:</p>
            <ul class="space-y-0.5 text-red-700">
                  @foreach($errors->all() as $error)
                  <li class="flex items-center gap-2">
                        <span class="w-1 h-1 rounded-full bg-red-500 flex-shrink-0"></span>
                        {{ $error }}
                  </li>
                  @endforeach
            </ul>
      </div>
      @endif

      @if(session('success'))
      <div class="mb-4 flex items-center gap-2 px-4 py-3 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-lg text-sm">
            <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>
            {{ session('success') }}
      </div>
      @endif

      @if(session('error'))
      <div class="mb-4 flex items-center gap-2 px-4 py-3 bg-red-50 border border-red-200 text-red-800 rounded-lg text-sm">
            <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
            </svg>
            {{ session('error') }}
      </div>
      @endif

      {{-- Tabel --}}
      @if($laporanBulanans->count() > 0)
      <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
            <div class="px-5 py-4 border-b border-gray-100 flex items-center gap-2">
                  <svg class="w-4 h-4 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                  </svg>
                  <h2 class="font-semibold text-gray-900 text-sm">Daftar Laporan Tahunan</h2>
                  <span class="ml-auto text-xs text-gray-400">{{ $laporanBulanans->total() }} laporan</span>
            </div>

            <div class="overflow-x-auto">
                  <table class="w-full text-sm">
                        <thead class="bg-gray-50 border-b border-gray-200">
                              <tr>
                                    <th class="text-left px-5 py-3 font-semibold text-gray-600 text-xs uppercase tracking-wide">No</th>
                                    <th class="text-left px-5 py-3 font-semibold text-gray-600 text-xs uppercase tracking-wide">Nama Laporan</th>
                                    <th class="text-center px-5 py-3 font-semibold text-gray-600 text-xs uppercase tracking-wide">File</th>
                                    <th class="text-left px-5 py-3 font-semibold text-gray-600 text-xs uppercase tracking-wide">Tanggal Upload</th>
                                    <th class="text-center px-5 py-3 font-semibold text-gray-600 text-xs uppercase tracking-wide">Aksi</th>
                              </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                              @foreach($laporanBulanans as $laporan)
                              <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-5 py-3.5">
                                          <span class="inline-flex items-center justify-center w-7 h-7 rounded-full bg-gray-100 text-gray-600 font-semibold text-xs">
                                                {{ ($laporanBulanans->currentPage() - 1) * $laporanBulanans->perPage() + $loop->iteration }}
                                          </span>
                                    </td>
                                    <td class="px-5 py-3.5">
                                          <p class="font-semibold text-gray-900">{{ $laporan->nama_laporan }}</p>
                                          <p class="text-xs text-gray-400 mt-0.5">ID #{{ $laporan->id }}</p>
                                    </td>
                                    <td class="px-5 py-3.5 text-center">
                                          @if($laporan->file_laporan)
                                          <span class="inline-flex items-center gap-1 px-2.5 py-1 rounded-full bg-blue-50 text-blue-700 text-xs font-semibold border border-blue-200">
                                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                      <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd" />
                                                </svg>
                                                PDF
                                          </span>
                                          @else
                                          <span class="inline-flex items-center px-2.5 py-1 rounded-full bg-gray-100 text-gray-500 text-xs font-medium">
                                                Belum Ada
                                          </span>
                                          @endif
                                    </td>
                                    <td class="px-5 py-3.5">
                                          <p class="font-medium text-gray-900">{{ $laporan->created_at->format('d M Y') }}</p>
                                          <p class="text-xs text-gray-400">{{ $laporan->created_at->format('H:i') }}</p>
                                    </td>
                                    <td class="px-5 py-3.5">
                                          <div class="flex items-center justify-center gap-1">
                                                <a href="{{ route('laporan-bulanan.show', $laporan->id) }}"
                                                      title="Lihat Detail"
                                                      class="p-1.5 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors">
                                                      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                      </svg>
                                                </a>
                                                <a href="{{ route('laporan-bulanan.edit', $laporan->id) }}"
                                                      title="Edit"
                                                      class="p-1.5 text-amber-600 hover:bg-amber-50 rounded-lg transition-colors">
                                                      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                      </svg>
                                                </a>
                                                <form method="POST" action="{{ route('laporan-bulanan.destroy', $laporan->id) }}" class="inline"
                                                      onsubmit="return confirm('Yakin ingin menghapus laporan ini? Tindakan ini tidak dapat dibatalkan.')">
                                                      @csrf @method('DELETE')
                                                      <button type="submit" title="Hapus"
                                                            class="p-1.5 text-red-600 hover:bg-red-50 rounded-lg transition-colors">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                            </svg>
                                                      </button>
                                                </form>
                                          </div>
                                    </td>
                              </tr>
                              @endforeach
                        </tbody>
                  </table>
            </div>

            @if($laporanBulanans->hasPages())
            <div class="px-5 py-3 border-t border-gray-100">
                  {{ $laporanBulanans->links() }}
            </div>
            @endif
      </div>

      @else
      {{-- Empty State --}}
      <div class="bg-white rounded-xl border border-gray-200 py-20 text-center">
            <div class="w-16 h-16 rounded-full bg-gray-100 flex items-center justify-center mx-auto mb-4">
                  <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                  </svg>
            </div>
            <h3 class="text-lg font-bold text-gray-900 mb-1">Belum Ada Laporan Tahunan</h3>
            <p class="text-sm text-gray-500 mb-6 max-w-sm mx-auto">
                  Mulai buat laporan bulanan pertama untuk mengelola data dengan lebih terorganisir.
            </p>
            <a href="{{ route('laporan-bulanan.create') }}"
                  class="inline-flex items-center gap-2 px-5 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold rounded-lg transition-colors shadow-sm">
                  <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                  </svg>
                  Buat Laporan Pertama
            </a>
      </div>
      @endif

</x-layouts::app>