<div class="w-full bg-white rounded-2xl shadow-lg border border-slate-200 overflow-hidden">
      <!-- Header -->
      <div class="px-6 py-6 border-b border-slate-200 bg-linear-to-r from-emerald-50 to-emerald-100">
            <h2 class="text-2xl font-bold text-slate-900 flex items-center gap-3">
                  Pemetaan Zakat Bojonegoro
            </h2>
      </div>

      <!-- Data Store -->
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

      <!-- Info Kecamatan - Dropdown/Accordion -->
      <div class="px-6 py-6 bg-white">
            <h3 class="font-semibold text-slate-900 text-base mb-4">Daftar Kecamatan</h3>
            <div class="space-y-2">
                  @forelse($kecamatans as $index => $kec)

                  <div class="border border-slate-200 rounded-lg overflow-hidden hover:border-emerald-300 transition-all">
                        <!-- Accordion Header -->
                        <button class="kecamatan-toggle w-full px-4 py-3 flex items-center justify-between bg-slate-50 hover:bg-slate-100 transition-colors text-left"
                              data-target="accordion-{{ $index }}"
                              @if ($kec['has_coordinates'])
                              data-lat="{{ $kec['latitude'] }}"
                              data-lng="{{ $kec['longitude'] }}"
                              @endif
                              title="{{ $kec['has_coordinates'] ? 'Klik untuk pindah ke lokasi' : 'Belum ada koordinat' }}">

                              <div class="flex items-center gap-3 flex-1">
                                    <svg class="w-5 h-5 text-slate-600 transition-transform duration-300 accordion-icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                                    <span class="font-semibold text-slate-900">{{ $kec['nama'] }}</span>
                                    @if (!$kec['has_coordinates'])
                                    <span class="text-xs bg-yellow-100 text-yellow-800 px-2 py-1 rounded">⚠️ Belum ada koordinat</span>
                                    @endif
                              </div>

                              <div class="flex items-center gap-4 text-xs text-slate-600">
                                    <div class="flex items-center gap-1">
                                          <span class="text-red-600 font-medium">●</span>
                                          <span>{{ $kec['jumlah_muzakki'] }}</span>
                                    </div>
                                    <div class="flex items-center gap-1">
                                          <span class="text-blue-600 font-medium">●</span>
                                          <span>{{ $kec['jumlah_mustahik'] }}</span>
                                    </div>
                              </div>
                        </button>

                        <!-- Accordion Body -->
                        <div id="accordion-{{ $index }}" class="accordion-body hidden px-4 py-3 bg-white border-t border-slate-200">
                              <div class="grid grid-cols-2 gap-4">
                                    <div class="bg-red-50 p-3 rounded">
                                          <p class="text-xs text-slate-600 mb-1">Muzakki (Donatur)</p>
                                          <p class="text-xl font-bold text-red-600">{{ $kec['jumlah_muzakki'] }}</p>
                                    </div>
                                    <div class="bg-blue-50 p-3 rounded">
                                          <p class="text-xs text-slate-600 mb-1">Mustahik (Penerima)</p>
                                          <p class="text-xl font-bold text-blue-600">{{ $kec['jumlah_mustahik'] }}</p>
                                    </div>
                              </div>
                              @if ($kec['has_coordinates'])
                              <button class="mt-3 w-full px-3 py-2 bg-emerald-500 hover:bg-emerald-600 text-white text-sm font-medium rounded transition-colors kecamatan-card"
                                    data-lat="{{ $kec['latitude'] }}"
                                    data-lng="{{ $kec['longitude'] }}">
                                    Lihat di Peta
                              </button>
                              @endif
                        </div>
                  </div>

                  @empty
                  <div class="text-center py-8 text-slate-500">
                        <p class="text-sm">Belum ada data kecamatan</p>
                  </div>
                  @endforelse
            </div>
      </div>

      <!-- JavaScript untuk Accordion dan Map Navigation -->
      <script>
            document.addEventListener('DOMContentLoaded', function() {
                  // Accordion Toggle
                  const toggleButtons = document.querySelectorAll('.kecamatan-toggle');

                  toggleButtons.forEach(button => {
                        button.addEventListener('click', function(e) {
                              const targetId = this.getAttribute('data-target');
                              const targetBody = document.getElementById(targetId);
                              const icon = this.querySelector('.accordion-icon');

                              // Toggle body visibility
                              targetBody.classList.toggle('hidden');

                              // Rotate icon
                              if (targetBody.classList.contains('hidden')) {
                                    icon.style.transform = 'rotate(0deg)';
                              } else {
                                    icon.style.transform = 'rotate(90deg)';
                              }

                              // Jika ada koordinat dan bukan klik pada tombol "Lihat di Peta", navigasi ke lokasi
                              const lat = this.getAttribute('data-lat');
                              const lng = this.getAttribute('data-lng');

                              // Cek apakah target klik adalah tombol sendiri (bukan child button)
                              if (lat && lng && e.target === this) {
                                    navigateToLocation(lat, lng);
                              }
                        });
                  });

                  // Klik pada "Lihat di Peta" button
                  const mapButtons = document.querySelectorAll('.kecamatan-card[data-lat][data-lng]');
                  mapButtons.forEach(button => {
                        button.addEventListener('click', function(e) {
                              e.stopPropagation();
                              const lat = this.getAttribute('data-lat');
                              const lng = this.getAttribute('data-lng');
                              navigateToLocation(lat, lng);
                        });
                  });

                  function navigateToLocation(lat, lng) {

                        const mapElement = document.getElementById('peta-zakat');

                        mapElement.scrollIntoView({
                              behavior: 'smooth',
                              block: 'center'
                        });

                        if (window.pemetaanZakatMap) {
                              window.pemetaanZakatMap.flyTo([lat, lng], 13, {
                                    duration: 1
                              });
                        }
                  }
            });
      </script>

      <style>
            .accordion-icon {
                  transition: transform 0.3s ease;
            }
      </style>
</div>