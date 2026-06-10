<x-layouts::app :title="$rekening->nama">
      <div class="min-h-screen py-8 px-4">
            <div class="max-w-2xl mx-auto space-y-6">

                  <!-- Header -->
                  <div>
                        <a href="{{ route('rekenings.index') }}" class="inline-flex items-center gap-2 text-blue-600 hover:text-blue-700 mb-4">
                              <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                              </svg>
                              Kembali
                        </a>
                        <h1 class="text-3xl font-bold text-slate-900">
                              {{ $rekening->nama }}
                        </h1>
                        <p class="text-slate-600 mt-2">Detail rekening bank</p>
                  </div>

                  <!-- Detail Card -->
                  <div class="bg-white rounded-2xl shadow-xl border border-slate-200 p-6 md:p-8 space-y-6">

                        <!-- Icon & Nama -->
                        <div class="flex items-center gap-6 p-6 bg-gradient-to-r from-emerald-50 to-emerald-100 rounded-xl border border-emerald-200">
                              @if ($rekening->icon)
                              <img src="{{ asset('storage/' . $rekening->icon) }}" alt="{{ $rekening->nama }}"
                                    class="h-20 w-20 object-contain rounded-xl border border-slate-200 bg-white p-2 shadow">
                              @else
                              <div class="h-20 w-20 rounded-xl border border-emerald-200 bg-emerald-600 flex items-center justify-center shadow">
                                    <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                              </div>
                              @endif
                              <div>
                                    <p class="text-sm text-slate-600">Nama Bank / Dompet</p>
                                    <p class="text-xl font-bold text-slate-900 mt-0.5">{{ $rekening->nama }}</p>
                              </div>
                        </div>

                        <!-- Detail Fields -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                              <div class="p-4 bg-slate-50 rounded-lg border border-slate-200">
                                    <p class="text-xs text-slate-600 uppercase tracking-wide font-semibold">Bank Atas Nama</p>
                                    <p class="text-lg font-semibold text-slate-900 mt-1">{{ $rekening->bank_atas_nama }}</p>
                              </div>
                              <div class="p-4 bg-slate-50 rounded-lg border border-slate-200">
                                    <p class="text-xs text-slate-600 uppercase tracking-wide font-semibold">Nomor Rekening</p>
                                    <p class="text-lg font-mono font-semibold text-slate-900 mt-1">{{ $rekening->nomor_rekening }}</p>
                              </div>
                              <div class="p-4 bg-slate-50 rounded-lg border border-slate-200">
                                    <p class="text-xs text-slate-600 uppercase tracking-wide font-semibold">Ditambahkan</p>
                                    <p class="text-lg font-semibold text-slate-900 mt-1">{{ $rekening->created_at->format('d M Y') }}</p>
                              </div>
                              <div class="p-4 bg-slate-50 rounded-lg border border-slate-200">
                                    <p class="text-xs text-slate-600 uppercase tracking-wide font-semibold">Terakhir Diperbarui</p>
                                    <p class="text-lg font-semibold text-slate-900 mt-1">{{ $rekening->updated_at->format('d M Y') }}</p>
                              </div>
                        </div>

                        <!-- Actions -->
                        <div class="flex gap-3 pt-6 border-t border-slate-200">
                              <a href="{{ route('rekenings.edit', $rekening) }}"
                                    class="inline-flex items-center justify-center gap-2 px-6 py-2.5 bg-emerald-600 hover:bg-emerald-700 text-white font-medium rounded-lg transition-all duration-200 shadow-lg">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                    Edit
                              </a>
                              <form action="{{ route('rekenings.destroy', $rekening) }}" method="POST" class="inline"
                                    onsubmit="return confirm('Yakin ingin menghapus rekening ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                          class="inline-flex items-center justify-center gap-2 px-6 py-2.5 text-red-600 bg-red-50 hover:bg-red-100 font-medium rounded-lg transition-all duration-200 border border-red-200">
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
</x-layouts::app>
