<x-layouts::app :title="__('Detail Laporan Tahunan')">
      <div class="min-h-screen py-8 px-4">
            <div class="max-w-2xl mx-auto space-y-6">

                  <!-- Header -->
                  <div>
                        <h1 class="text-3xl font-bold text-slate-900 ">
                              {{ $laporanTahunan->nama }}
                        </h1>
                        <p class="text-slate-600  mt-2">
                              {{ __('Detail informasi laporan tahunan') }}
                        </p>
                  </div>

                  <!-- Success Message -->
                  @if (session()->has('success'))
                  <div class="bg-green-50  border border-green-200  rounded-lg p-4">
                        <p class="text-green-800 ">{{ session('success') }}</p>
                  </div>
                  @endif

                  <!-- Detail Card -->
                  <div class="bg-white  rounded-2xl shadow-xl border border-slate-200  p-6 md:p-8">
                        <div class="space-y-6">

                              <!-- Nama Laporan -->
                              <div>
                                    <label class="block text-sm font-semibold text-slate-900  mb-2">
                                          {{ __('Nama Laporan') }}
                                    </label>
                                    <div class="px-4 py-3 bg-slate-50  border border-slate-300  rounded-lg text-slate-900 ">
                                          {{ $laporanTahunan->nama }}
                                    </div>
                              </div>

                              <!-- Link -->
                              <div>
                                    <label class="block text-sm font-semibold text-slate-900  mb-2">
                                          {{ __('Link') }}
                                    </label>
                                    <div class="px-4 py-3 bg-slate-50  border border-slate-300  rounded-lg">
                                          <a href="{{ $laporanTahunan->link_from }}" target="_blank" class="text-blue-600  hover:underline break-all">
                                                {{ $laporanTahunan->link_from }}
                                          </a>
                                    </div>
                              </div>

                              <!-- Dibuat -->
                              <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                    <div>
                                          <label class="block text-sm font-semibold text-slate-900  mb-2">
                                                {{ __('Dibuat') }}
                                          </label>
                                          <div class="px-4 py-3 bg-slate-50  border border-slate-300  rounded-lg text-slate-900 ">
                                                {{ $laporanTahunan->created_at->format('d M Y H:i') }}
                                          </div>
                                    </div>
                                    <div>
                                          <label class="block text-sm font-semibold text-slate-900  mb-2">
                                                {{ __('Diperbarui') }}
                                          </label>
                                          <div class="px-4 py-3 bg-slate-50  border border-slate-300  rounded-lg text-slate-900 ">
                                                {{ $laporanTahunan->updated_at->format('d M Y H:i') }}
                                          </div>
                                    </div>
                              </div>

                              <!-- Actions -->
                              <div class="flex flex-wrap items-center justify-between gap-4 pt-6 border-t border-slate-200 ">
                                    <a href="{{ route('laporan-tahunans.index') }}" class="inline-flex items-center justify-center gap-2 px-6 py-2.5 text-slate-700  bg-slate-100  hover:bg-slate-200  font-medium rounded-lg transition-all duration-200">
                                          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                          </svg>
                                          Kembali
                                    </a>
                                    <div class="flex gap-3">
                                          <a href="{{ route('laporan-tahunans.edit', $laporanTahunan) }}" class="inline-flex items-center justify-center gap-2 px-6 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-medium rounded-lg transition-all duration-200 shadow-lg">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                                </svg>
                                                Edit
                                          </a>
                                          <form action="{{ route('laporan-tahunans.destroy', $laporanTahunan) }}" method="POST" class="inline" onsubmit="return confirm('{{ __('Yakin ingin menghapus?') }}')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="inline-flex items-center justify-center gap-2 px-6 py-2.5 bg-red-600 hover:bg-red-700 text-white font-medium rounded-lg transition-all duration-200 shadow-lg">
                                                      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                                      </svg>
                                                      Hapus
                                                </button>
                                          </form>
                                    </div>
                              </div>
                        </div>
                  </div>
            </div>
      </div>
</x-layouts::app>