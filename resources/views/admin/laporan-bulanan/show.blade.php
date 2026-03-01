<x-layouts::app :title="$laporanBulanan->nama_laporan">

      {{-- Header --}}
      <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4 mb-6">
            <div class="flex items-start gap-3">
                  <a href="{{ route('laporan-bulanan.index') }}"
                        class="p-2 text-gray-500 hover:bg-gray-100 rounded-lg transition-colors mt-0.5 flex-shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                        </svg>
                  </a>
                  <div>
                        <h1 class="text-2xl font-bold text-gray-900">{{ $laporanBulanan->nama_laporan }}</h1>
                        <p class="text-sm text-gray-500 mt-0.5 flex items-center gap-1.5">
                              <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                              </svg>
                              Diupload {{ $laporanBulanan->created_at->format('d M Y') }}
                        </p>
                  </div>
            </div>
            <div class="flex items-center gap-2 flex-wrap">
                  @if($laporanBulanan->file_laporan)
                  <a href="{{ asset('storage/laporan-bulanan/' . $laporanBulanan->file_laporan) }}"
                        target="_blank" rel="noopener noreferrer"
                        class="inline-flex items-center gap-2 px-3 py-2 text-sm border border-gray-300 text-gray-600 rounded-lg hover:bg-gray-50 transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                        </svg>
                        Tab Baru
                  </a>
                  <a href="{{ asset('storage/laporan-bulanan/' . $laporanBulanan->file_laporan) }}"
                        download
                        class="inline-flex items-center gap-2 px-3 py-2 text-sm bg-blue-600 hover:bg-blue-700 text-white rounded-lg transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                        </svg>
                        Unduh PDF
                  </a>
                  @endif
                  <a href="{{ route('laporan-bulanan.edit', $laporanBulanan->id) }}"
                        class="inline-flex items-center gap-2 px-3 py-2 text-sm bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg transition-colors">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                        </svg>
                        Edit
                  </a>
            </div>
      </div>

      @if(session('success'))
      <div class="mb-5 flex items-center gap-2 px-4 py-3 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-lg text-sm">
            <svg class="w-4 h-4 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
            </svg>
            {{ session('success') }}
      </div>
      @endif

      <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- PDF Viewer --}}
            <div class="lg:col-span-2">
                  @if($laporanBulanan->file_laporan)
                  <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
                        <div class="px-5 py-4 border-b border-gray-100 flex items-center gap-2">
                              <svg class="w-4 h-4 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd" />
                              </svg>
                              <h2 class="font-semibold text-gray-900 text-sm">Pratinjau PDF</h2>
                              <span class="ml-auto text-xs text-gray-400 font-mono">{{ $laporanBulanan->file_laporan }}</span>
                        </div>

                        {{-- PDF Iframe --}}
                        <iframe
                              src="{{ asset('storage/laporan-bulanan/' . $laporanBulanan->file_laporan) }}"
                              class="w-full border-none"
                              style="height: calc(100vh - 220px); min-height: 500px;"
                              loading="lazy">
                              <div class="p-8 text-center text-gray-500">
                                    <p class="text-sm">Browser Anda tidak mendukung tampilan PDF langsung.</p>
                                    <a href="{{ asset('storage/laporan-bulanan/' . $laporanBulanan->file_laporan) }}"
                                          class="mt-2 inline-flex items-center gap-1 text-blue-600 hover:underline text-sm">
                                          Klik di sini untuk membuka file
                                    </a>
                              </div>
                        </iframe>

                        <div class="px-5 py-3 bg-gray-50 border-t border-gray-100 flex items-center justify-between gap-4">
                              <div class="flex items-center gap-2 text-sm text-gray-600">
                                    <svg class="w-4 h-4 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                                          <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4z" clip-rule="evenodd" />
                                    </svg>
                                    <span class="font-medium truncate max-w-xs">{{ $laporanBulanan->file_laporan }}</span>
                              </div>
                              <div class="flex gap-2 flex-shrink-0">
                                    <a href="{{ asset('storage/laporan-bulanan/' . $laporanBulanan->file_laporan) }}"
                                          target="_blank" rel="noopener noreferrer"
                                          class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs border border-gray-300 text-gray-600 rounded-lg hover:bg-white transition-colors">
                                          <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                          </svg>
                                          Buka
                                    </a>
                                    <a href="{{ asset('storage/laporan-bulanan/' . $laporanBulanan->file_laporan) }}"
                                          download
                                          class="inline-flex items-center gap-1.5 px-3 py-1.5 text-xs bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg transition-colors">
                                          <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                          </svg>
                                          Unduh
                                    </a>
                              </div>
                        </div>
                  </div>
                  @else
                  <div class="bg-white rounded-xl border border-gray-200 py-20 text-center">
                        <div class="w-16 h-16 rounded-full bg-gray-100 flex items-center justify-center mx-auto mb-4">
                              <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                              </svg>
                        </div>
                        <h3 class="font-bold text-gray-700 mb-1">Belum Ada File PDF</h3>
                        <p class="text-sm text-gray-500 mb-4">File belum diunggah untuk laporan ini.</p>
                        <a href="{{ route('laporan-bulanan.edit', $laporanBulanan->id) }}"
                              class="inline-flex items-center gap-2 px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-semibold rounded-lg transition-colors">
                              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                              </svg>
                              Upload File
                        </a>
                  </div>
                  @endif
            </div>

            {{-- Sidebar --}}
            <div class="space-y-5">

                  {{-- Informasi Laporan --}}
                  <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
                        <div class="px-5 py-4 border-b border-gray-100">
                              <h2 class="font-semibold text-gray-900 text-sm">Informasi Laporan</h2>
                        </div>
                        <div class="p-5 space-y-3 text-sm">
                              <div>
                                    <p class="text-xs text-gray-400 uppercase tracking-wide font-medium mb-1">Nama Laporan</p>
                                    <p class="font-semibold text-gray-900">{{ $laporanBulanan->nama_laporan }}</p>
                              </div>
                              <div class="border-t border-gray-100 pt-3">
                                    <p class="text-xs text-gray-400 uppercase tracking-wide font-medium mb-1">Status File</p>
                                    @if($laporanBulanan->file_laporan)
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-emerald-50 text-emerald-700 text-xs font-semibold border border-emerald-200">
                                          <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                          </svg>
                                          Sudah Diunggah
                                    </span>
                                    @else
                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full bg-amber-50 text-amber-700 text-xs font-semibold border border-amber-200">
                                          Belum Diunggah
                                    </span>
                                    @endif
                              </div>
                              <div class="border-t border-gray-100 pt-3">
                                    <p class="text-xs text-gray-400 uppercase tracking-wide font-medium mb-1">Tanggal Dibuat</p>
                                    <p class="font-semibold text-gray-900">{{ $laporanBulanan->created_at->format('d F Y') }}</p>
                                    <p class="text-xs text-gray-400">{{ $laporanBulanan->created_at->format('H:i') }}</p>
                              </div>
                              <div class="border-t border-gray-100 pt-3">
                                    <p class="text-xs text-gray-400 uppercase tracking-wide font-medium mb-1">Terakhir Diperbarui</p>
                                    <p class="font-semibold text-gray-900">{{ $laporanBulanan->updated_at->format('d F Y') }}</p>
                                    <p class="text-xs text-gray-400">{{ $laporanBulanan->updated_at->format('H:i') }}</p>
                              </div>
                              <div class="border-t border-gray-100 pt-3 flex justify-between items-center">
                                    <span class="text-xs text-gray-400">Umur laporan</span>
                                    <span class="text-xs font-semibold text-gray-700">{{ $laporanBulanan->created_at->diffInDays() }} hari</span>
                              </div>
                        </div>
                  </div>

                  {{-- Aksi --}}
                  <div class="bg-white rounded-xl border border-gray-200 overflow-hidden">
                        <div class="px-5 py-4 border-b border-gray-100">
                              <h2 class="font-semibold text-gray-900 text-sm">Aksi</h2>
                        </div>
                        <div class="p-5 space-y-2.5">
                              @if($laporanBulanan->file_laporan)
                              <a href="{{ asset('storage/laporan-bulanan/' . $laporanBulanan->file_laporan) }}"
                                    download
                                    class="w-full py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-semibold rounded-lg text-sm transition-colors flex items-center justify-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" />
                                    </svg>
                                    Unduh PDF
                              </a>
                              <a href="{{ asset('storage/laporan-bulanan/' . $laporanBulanan->file_laporan) }}"
                                    target="_blank" rel="noopener noreferrer"
                                    class="w-full py-2.5 border border-gray-300 text-gray-700 font-semibold rounded-lg text-sm hover:bg-gray-50 transition-colors flex items-center justify-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                    </svg>
                                    Buka di Tab Baru
                              </a>
                              @endif
                              <a href="{{ route('laporan-bulanan.edit', $laporanBulanan->id) }}"
                                    class="w-full py-2.5 border border-amber-300 text-amber-700 font-semibold rounded-lg text-sm hover:bg-amber-50 transition-colors flex items-center justify-center gap-2">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    Edit Laporan
                              </a>
                              <form method="POST" action="{{ route('laporan-bulanan.destroy', $laporanBulanan->id) }}"
                                    onsubmit="return confirm('Yakin ingin menghapus laporan ini? Tindakan ini tidak dapat dibatalkan.')">
                                    @csrf @method('DELETE')
                                    <button type="submit"
                                          class="w-full py-2.5 border border-red-300 text-red-600 font-semibold rounded-lg text-sm hover:bg-red-50 transition-colors flex items-center justify-center gap-2">
                                          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                          </svg>
                                          Hapus Laporan
                                    </button>
                              </form>
                        </div>
                  </div>

            </div>
      </div>

</x-layouts::app>