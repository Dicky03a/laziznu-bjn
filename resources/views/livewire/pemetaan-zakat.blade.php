<div class="w-full bg-white rounded-2xl shadow-lg border border-slate-200 overflow-hidden">
      <!-- Header -->
      <div class="px-6 py-6 border-b border-slate-200 bg-linear-to-r from-emerald-50 to-emerald-100">
            <h2 class="text-2xl font-bold text-slate-900 flex items-center gap-3">
                  Pemetaan Zakat Bojonegoro
            </h2>
            <p class="text-slate-600 text-sm mt-2">
                  Visualisasi distribusi Muzakki <span class="text-red-500 font-semibold">●</span> dan Mustahik
                  <span class="text-blue-500 font-semibold">●</span> per Kecamatan
            </p>
      </div>

      <!-- Data Store untuk JavaScript -->
      <script type="application/json" id="pemetaan-data">
            @json(['kecamatans' => $kecamatans, 'center' => $center, 'zoom' => $zoom])
      </script>

      <!-- Map Container -->
      <div id="peta-zakat" class="w-full z-0" style="height: 500px;"></div>

      <!-- Legend -->
      <div class="px-6 py-4 bg-slate-50 border-t border-slate-200 flex flex-wrap gap-6 items-center">
            <div class="flex items-center gap-2">
                  <div class="w-5 h-5 rounded-full bg-red-500 flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                              <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                        </svg>
                  </div>
                  <span class="text-sm font-medium text-slate-700">Muzakki (Donatur)</span>
            </div>
            <div class="flex items-center gap-2">
                  <div class="w-5 h-5 rounded-full bg-blue-500 flex items-center justify-center">
                        <svg class="w-4 h-4 text-white" fill="currentColor" viewBox="0 0 20 20">
                              <path fill-rule="evenodd"
                                    d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
                                    clip-rule="evenodd" />
                        </svg>
                  </div>
                  <span class="text-sm font-medium text-slate-700">Mustahik (Penerima Manfaat)</span>
            </div>
      </div>

      <!-- Info Kecamatan -->
      <div class="px-6 py-6 bg-white">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                  @forelse($kecamatans as $kec)
                  @if ($kec['has_coordinates'])
                  <div class="p-4 rounded-lg border border-slate-200 hover:border-emerald-300 hover:shadow-md transition-all cursor-pointer bg-slate-50 hover:bg-emerald-50 kecamatan-card"
                        data-lat="{{ $kec['latitude'] }}" data-lng="{{ $kec['longitude'] }}" title="Klik untuk pindah ke lokasi">
                        <h3 class="font-semibold text-slate-900 text-sm">{{ $kec['nama'] }}</h3>
                        <div class="mt-3 flex gap-4">
                              <div class="flex items-center gap-1">
                                    <span class="text-xs font-medium text-red-600">●</span>
                                    <span class="text-xs text-slate-600">Muzakki: <span
                                                class="font-bold text-slate-900">{{ $kec['jumlah_muzakki'] }}</span></span>
                              </div>
                              <div class="flex items-center gap-1">
                                    <span class="text-xs font-medium text-blue-600">●</span>
                                    <span class="text-xs text-slate-600">Mustahik: <span
                                                class="font-bold text-slate-900">{{ $kec['jumlah_mustahik'] }}</span></span>
                              </div>
                        </div>
                  </div>
                  @else
                  <div class="p-4 rounded-lg border border-slate-200 bg-slate-100 opacity-60">
                        <h3 class="font-semibold text-slate-700 text-sm">{{ $kec['nama'] }}</h3>
                        <div class="mt-3 flex gap-4">
                              <div class="flex items-center gap-1">
                                    <span class="text-xs font-medium text-red-600">●</span>
                                    <span class="text-xs text-slate-600">Muzakki: <span
                                                class="font-bold text-slate-900">{{ $kec['jumlah_muzakki'] }}</span></span>
                              </div>
                              <div class="flex items-center gap-1">
                                    <span class="text-xs font-medium text-blue-600">●</span>
                                    <span class="text-xs text-slate-600">Mustahik: <span
                                                class="font-bold text-slate-900">{{ $kec['jumlah_mustahik'] }}</span></span>
                              </div>
                        </div>
                        <p class="text-xs text-slate-500 mt-2 italic">⚠️ Belum ada koordinat</p>
                  </div>
                  @endif
                  @empty
                  <div class="col-span-full text-center py-8 text-slate-500">
                        <p class="text-sm">Belum ada data kecamatan</p>
                  </div>
                  @endforelse
            </div>
      </div>
</div>