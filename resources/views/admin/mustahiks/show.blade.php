<x-layouts::app :title="__('Detail Mustahik')">
      <div class="min-h-screen py-8 px-4">
            <div class="max-w-4xl mx-auto space-y-6">

                  <!-- Header -->
                  <div class="flex items-center justify-between">
                        <div>
                              <h1 class="text-3xl font-bold text-slate-900 ">
                                    {{ $mustahik->nama }}
                              </h1>
                              <p class="text-slate-600  mt-2">
                                    Detail informasi mustahik
                              </p>
                        </div>
                        <div class="flex items-center gap-2">
                              <a href="{{ route('mustahiks.edit', $mustahik) }}" class="inline-flex items-center justify-center gap-2 px-6 py-2.5 bg-blue-600 hover:bg-blue-700 text-white font-medium rounded-lg transition-all duration-200 shadow-lg">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                    Edit
                              </a>
                              <a href="{{ route('mustahiks.index') }}" class="inline-flex items-center justify-center gap-2 px-6 py-2.5 text-slate-700  bg-slate-100  hover:bg-slate-200  font-medium rounded-lg transition-all duration-200">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                    </svg>
                                    Kembali
                              </a>
                        </div>
                  </div>

                  <!-- Main Info Card -->
                  <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Status Badge -->
                        <div class="md:col-span-1">
                              <div class="bg-white  rounded-2xl shadow-xl border border-slate-200  p-6">
                                    <p class="text-sm font-semibold text-slate-600  mb-3">Status</p>
                                    @if($mustahik->status === 'aktif')
                                    <span class="inline-block px-4 py-2 rounded-full text-sm font-semibold bg-green-100  text-green-700 ">
                                          ✓ Aktif
                                    </span>
                                    @else
                                    <span class="inline-block px-4 py-2 rounded-full text-sm font-semibold bg-red-100  text-red-700 ">
                                          ✗ Nonaktif
                                    </span>
                                    @endif
                              </div>
                        </div>

                        <!-- Kategori Asnaf -->
                        <div class="md:col-span-1">
                              <div class="bg-white  rounded-2xl shadow-xl border border-slate-200  p-6">
                                    <p class="text-sm font-semibold text-slate-600  mb-3">Kategori Asnaf</p>
                                    <span class="inline-block px-4 py-2 rounded-full text-sm font-semibold bg-purple-100  text-purple-700 ">
                                          {{ $mustahik->getKategoriAsnafFormatted() }}
                                    </span>
                              </div>
                        </div>

                        <!-- Jenis Kelamin -->
                        <div class="md:col-span-1">
                              <div class="bg-white  rounded-2xl shadow-xl border border-slate-200  p-6">
                                    <p class="text-sm font-semibold text-slate-600  mb-3">Jenis Kelamin</p>
                                    <p class="text-lg font-semibold text-slate-900 ">
                                          {{ $mustahik->getJenisKelaminFormatted() }}
                                    </p>
                              </div>
                        </div>
                  </div>

                  <!-- Details Card -->
                  <div class="bg-white  rounded-2xl shadow-xl border border-slate-200  p-6 md:p-8">
                        <h2 class="text-xl font-bold text-slate-900  mb-6">Informasi Pribadi</h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                              <!-- NIK -->
                              <div>
                                    <p class="text-sm font-semibold text-slate-600  mb-2">
                                          NIK (Nomor Identitas Kependudukan)
                                    </p>
                                    <p class="text-lg font-mono text-slate-900 ">
                                          {{ $mustahik->nik }}
                                    </p>
                              </div>

                              <!-- No HP -->
                              <div>
                                    <p class="text-sm font-semibold text-slate-600  mb-2">
                                          Nomor Telepon
                                    </p>
                                    <a href="tel:{{ $mustahik->no_hp }}" class="text-lg text-blue-600  hover:underline font-medium">
                                          {{ $mustahik->no_hp }}
                                    </a>
                              </div>

                              <!-- Kecamatan -->
                              <div>
                                    <p class="text-sm font-semibold text-slate-600  mb-2">
                                          Kecamatan
                                    </p>
                                    <p class="text-lg text-slate-900  font-medium">
                                          {{ $mustahik->kecamatan->nama }}
                                    </p>
                              </div>

                              <!-- Desa -->
                              <div>
                                    <p class="text-sm font-semibold text-slate-600  mb-2">
                                          Desa
                                    </p>
                                    <p class="text-lg text-slate-900  font-medium">
                                          {{ $mustahik->desa->nama }}
                                    </p>
                              </div>
                        </div>
                  </div>

                  <!-- Timestamps Card -->
                  <div class="bg-white  rounded-2xl shadow-xl border border-slate-200  p-6">
                        <h2 class="text-xl font-bold text-slate-900  mb-6">Riwayat</h2>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                              <!-- Created At -->
                              <div>
                                    <p class="text-sm font-semibold text-slate-600  mb-2">
                                          Dibuat Pada
                                    </p>
                                    <p class="text-slate-900 ">
                                          {{ $mustahik->created_at->translatedFormat('d F Y H:i') }}
                                    </p>
                              </div>

                              <!-- Updated At -->
                              <div>
                                    <p class="text-sm font-semibold text-slate-600  mb-2">
                                          Diperbarui Pada
                                    </p>
                                    <p class="text-slate-900 ">
                                          {{ $mustahik->updated_at->translatedFormat('d F Y H:i') }}
                                    </p>
                              </div>
                        </div>
                  </div>

                  <!-- Danger Zone -->
                  <div class="bg-red-50  border border-red-200  rounded-2xl p-6">
                        <h2 class="text-xl font-bold text-red-700  mb-4">Zona Berbahaya</h2>
                        <p class="text-red-600  mb-4">
                              Menghapus data mustahik akan menghapus semua informasi terkait secara permanen. Tindakan ini tidak dapat dibatalkan.
                        </p>
                        <form action="{{ route('mustahiks.destroy', $mustahik) }}" method="POST" class="inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data {{ $mustahik->nama }}? Tindakan ini tidak dapat dibatalkan.')">
                              @csrf
                              @method('DELETE')
                              <button type="submit" class="inline-flex items-center gap-2 px-6 py-2.5 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition-all duration-200">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                    Hapus Data Mustahik
                              </button>
                        </form>
                  </div>
            </div>
      </div>
</x-layouts::app>