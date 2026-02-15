<x-layouts::app :title="__('Tambah Profil')">
      <div class="min-h-screen dark:from-zinc-900 dark:to-zinc-800 py-8 px-4">
            <div class="max-w-4xl mx-auto">

                  <!-- Breadcrumb -->
                  <nav class="mb-6 flex items-center gap-2 text-sm text-slate-600 dark:text-slate-400">
                        <a href="{{ route('profiles.index') }}" class="hover:text-green-600 dark:hover:text-green-400 transition-colors">
                              Data Profil
                        </a>
                        <span>/</span>
                        <span class="text-slate-900 dark:text-white font-medium">Tambah Profil</span>
                  </nav>

                  <!-- Main Card -->
                  <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-xl border border-slate-200 dark:border-zinc-800 overflow-hidden">

                        <!-- Header -->
                        <div class="bg-gradient-to-r from-green-600 to-emerald-600 px-8 py-6">
                              <h1 class="text-2xl font-bold text-white flex items-center gap-3">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                    </svg>
                                    Tambah Profil Baru
                              </h1>
                              <p class="text-green-100 mt-1 text-sm">Lengkapi informasi profil organisasi</p>
                        </div>

                        <!-- Form -->
                        <form action="{{ route('profiles.store') }}" method="POST" class="p-8 space-y-6">
                              @csrf

                              <!-- Judul -->
                              <div class="space-y-2">
                                    <label for="title" class="block text-sm font-semibold text-slate-700 dark:text-slate-300">
                                          Judul Profil <span class="text-red-500">*</span>
                                    </label>
                                    <input
                                          type="text"
                                          id="title"
                                          name="title"
                                          value="{{ old('title') }}"
                                          placeholder="Masukkan judul profil"
                                          required
                                          class="w-full px-4 py-3 border border-slate-300 dark:border-zinc-700 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent dark:bg-zinc-800 dark:text-white transition-all duration-200 placeholder:text-slate-400">
                                    @error('title')
                                    <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                              </div>

                              <!-- Deskripsi -->
                              <div class="space-y-2">
                                    <label for="deskripsi" class="block text-sm font-semibold text-slate-700 dark:text-slate-300">
                                          Deskripsi Singkat <span class="text-red-500">*</span>
                                    </label>
                                    <textarea
                                          id="deskripsi"
                                          name="deskripsi"
                                          rows="4"
                                          placeholder="Jelaskan secara singkat tentang organisasi"
                                          required
                                          class="w-full px-4 py-3 border border-slate-300 dark:border-zinc-700 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent dark:bg-zinc-800 dark:text-white transition-all duration-200 placeholder:text-slate-400 resize-none">{{ old('deskripsi') }}</textarea>
                                    @error('deskripsi')
                                    <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                              </div>

                              <!-- Grid 3 Columns -->
                              <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                                    <!-- Tahun Berdiri -->
                                    <div class="space-y-2">
                                          <label for="tahun_berdiri" class="block text-sm font-semibold text-slate-700 dark:text-slate-300">
                                                Tahun Berdiri <span class="text-red-500">*</span>
                                          </label>
                                          <input
                                                type="text"
                                                id="tahun_berdiri"
                                                name="tahun_berdiri"
                                                value="{{ old('tahun_berdiri') }}"
                                                placeholder="2024"
                                                required
                                                class="w-full px-4 py-3 border border-slate-300 dark:border-zinc-700 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent dark:bg-zinc-800 dark:text-white transition-all duration-200 placeholder:text-slate-400">
                                          @error('tahun_berdiri')
                                          <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                          @enderror
                                    </div>

                                    <!-- Penerima Manfaat -->
                                    <div class="space-y-2">
                                          <label for="penerima_manfaat" class="block text-sm font-semibold text-slate-700 dark:text-slate-300">
                                                Penerima Manfaat <span class="text-red-500">*</span>
                                          </label>
                                          <input
                                                type="number"
                                                id="penerima_manfaat"
                                                name="penerima_manfaat"
                                                value="{{ old('penerima_manfaat') }}"
                                                placeholder="1000"
                                                required
                                                min="0"
                                                class="w-full px-4 py-3 border border-slate-300 dark:border-zinc-700 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent dark:bg-zinc-800 dark:text-white transition-all duration-200 placeholder:text-slate-400">
                                          @error('penerima_manfaat')
                                          <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                          @enderror
                                    </div>

                                    <!-- Program Tersalurkan -->
                                    <div class="space-y-2">
                                          <label for="program_tersalurkan" class="block text-sm font-semibold text-slate-700 dark:text-slate-300">
                                                Program Tersalurkan <span class="text-red-500">*</span>
                                          </label>
                                          <input
                                                type="number"
                                                id="program_tersalurkan"
                                                name="program_tersalurkan"
                                                value="{{ old('program_tersalurkan') }}"
                                                placeholder="50"
                                                required
                                                min="0"
                                                class="w-full px-4 py-3 border border-slate-300 dark:border-zinc-700 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent dark:bg-zinc-800 dark:text-white transition-all duration-200 placeholder:text-slate-400">
                                          @error('program_tersalurkan')
                                          <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                          @enderror
                                    </div>
                              </div>

                              <!-- Visi -->
                              <div class="space-y-2">
                                    <label for="visi" class="block text-sm font-semibold text-slate-700 dark:text-slate-300">
                                          Visi <span class="text-red-500">*</span>
                                    </label>
                                    <textarea
                                          id="visi"
                                          name="visi"
                                          rows="3"
                                          placeholder="Tuliskan visi organisasi"
                                          required
                                          class="w-full px-4 py-3 border border-slate-300 dark:border-zinc-700 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent dark:bg-zinc-800 dark:text-white transition-all duration-200 placeholder:text-slate-400 resize-none">{{ old('visi') }}</textarea>
                                    @error('visi')
                                    <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                    @enderror
                              </div>

                              <!-- Divider -->
                              <div class="border-t border-slate-200 dark:border-zinc-700 my-6"></div>

                              <!-- MISI Section -->
                              <div class="space-y-4">
                                    <div class="flex items-center justify-between">
                                          <div>
                                                <h3 class="text-lg font-semibold text-slate-900 dark:text-white flex items-center gap-2">
                                                      <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                      </svg>
                                                      Misi Organisasi
                                                </h3>
                                                <p class="text-sm text-slate-600 dark:text-slate-400 mt-1">Tambahkan misi-misi organisasi</p>
                                          </div>
                                          <button
                                                type="button"
                                                onclick="addMission()"
                                                class="px-4 py-2 bg-blue-600 hover:bg-blue-700 text-white rounded-lg text-sm font-medium transition-all duration-200 flex items-center gap-2">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                                </svg>
                                                Tambah Misi
                                          </button>
                                    </div>

                                    <div id="missions-container" class="space-y-3">
                                          <!-- Mission items will be added here -->
                                    </div>
                              </div>

                              <!-- Divider -->
                              <div class="border-t border-slate-200 dark:border-zinc-700 my-6"></div>

                              <!-- PILAR Section -->
                              <div class="space-y-4">
                                    <div class="flex items-center justify-between">
                                          <div>
                                                <h3 class="text-lg font-semibold text-slate-900 dark:text-white flex items-center gap-2">
                                                      <svg class="w-5 h-5 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                                      </svg>
                                                      Pilar Program
                                                </h3>
                                                <p class="text-sm text-slate-600 dark:text-slate-400 mt-1">Tambahkan pilar-pilar program organisasi</p>
                                          </div>
                                          <button
                                                type="button"
                                                onclick="addPillar()"
                                                class="px-4 py-2 bg-purple-600 hover:bg-purple-700 text-white rounded-lg text-sm font-medium transition-all duration-200 flex items-center gap-2">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                                </svg>
                                                Tambah Pilar
                                          </button>
                                    </div>

                                    <div id="pillars-container" class="space-y-4">
                                          <!-- Pillar items will be added here -->
                                    </div>
                              </div>

                              <!-- Divider -->
                              <div class="border-t border-slate-200 dark:border-zinc-700 pt-6">
                                    <div class="flex flex-col sm:flex-row justify-end gap-3">
                                          <a
                                                href="{{ route('profiles.index') }}"
                                                class="px-6 py-3 bg-slate-100 hover:bg-slate-200 dark:bg-zinc-800 dark:hover:bg-zinc-700 text-slate-700 dark:text-slate-300 rounded-lg font-medium transition-all duration-200 text-center">
                                                Batal
                                          </a>

                                          <button
                                                type="submit"
                                                class="px-6 py-3 bg-gradient-to-r from-green-600 to-emerald-600 hover:from-green-700 hover:to-emerald-700 text-white rounded-lg font-medium shadow-lg shadow-green-500/30 hover:shadow-xl hover:shadow-green-500/40 transition-all duration-200 flex items-center justify-center gap-2">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                                Simpan Profil
                                          </button>
                                    </div>
                              </div>
                        </form>

                  </div>
            </div>
      </div>

      @push('scripts')
      <script>
            let missionCounter = 0;
            let pillarCounter = 0;

            function addMission() {
                  const container = document.getElementById('missions-container');
                  const missionDiv = document.createElement('div');
                  missionDiv.className = 'mission-item bg-blue-50 dark:bg-blue-900/10 border border-blue-200 dark:border-blue-800/30 rounded-lg p-4';
                  missionDiv.innerHTML = `
                        <div class="flex gap-3">
                              <div class="flex-1 space-y-2">
                                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">
                                          Misi ${missionCounter + 1}
                                    </label>
                                    <input
                                          type="text"
                                          name="missions[${missionCounter}][text]"
                                          placeholder="Masukkan teks misi"
                                          required
                                          class="w-full px-4 py-2 border border-slate-300 dark:border-zinc-700 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-transparent dark:bg-zinc-800 dark:text-white transition-all duration-200 placeholder:text-slate-400">
                                    <input type="hidden" name="missions[${missionCounter}][urutan]" value="${missionCounter}">
                              </div>
                              <button
                                    type="button"
                                    onclick="removeMission(this)"
                                    class="flex-shrink-0 w-10 h-10 flex items-center justify-center bg-red-100 hover:bg-red-200 dark:bg-red-900/20 dark:hover:bg-red-900/30 text-red-600 dark:text-red-400 rounded-lg transition-all duration-200">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                              </button>
                        </div>
                  `;
                  container.appendChild(missionDiv);
                  missionCounter++;
                  updateMissionNumbers();
            }

            function removeMission(button) {
                  button.closest('.mission-item').remove();
                  updateMissionNumbers();
            }

            function updateMissionNumbers() {
                  const missions = document.querySelectorAll('.mission-item');
                  missions.forEach((mission, index) => {
                        const label = mission.querySelector('label');
                        label.textContent = `Misi ${index + 1}`;
                        const urutanInput = mission.querySelector('input[type="hidden"]');
                        urutanInput.value = index;
                  });
            }

            function addPillar() {
                  const container = document.getElementById('pillars-container');
                  const pillarDiv = document.createElement('div');
                  pillarDiv.className = 'pillar-item bg-purple-50 dark:bg-purple-900/10 border border-purple-200 dark:border-purple-800/30 rounded-lg p-4';
                  pillarDiv.innerHTML = `
                        <div class="flex gap-3">
                              <div class="flex-1 space-y-3">
                                    <div>
                                          <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                                                Pilar ${pillarCounter + 1}
                                          </label>
                                          <input
                                                type="text"
                                                name="pillars[${pillarCounter}][title]"
                                                placeholder="Judul pilar"
                                                required
                                                class="w-full px-4 py-2 border border-slate-300 dark:border-zinc-700 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent dark:bg-zinc-800 dark:text-white transition-all duration-200 placeholder:text-slate-400">
                                    </div>
                                    <div>
                                          <textarea
                                                name="pillars[${pillarCounter}][deskripsi]"
                                                rows="2"
                                                placeholder="Deskripsi pilar"
                                                class="w-full px-4 py-2 border border-slate-300 dark:border-zinc-700 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent dark:bg-zinc-800 dark:text-white transition-all duration-200 placeholder:text-slate-400 resize-none"></textarea>
                                    </div>
                                    <input type="hidden" name="pillars[${pillarCounter}][urutan]" value="${pillarCounter}">
                              </div>
                              <button
                                    type="button"
                                    onclick="removePillar(this)"
                                    class="flex-shrink-0 w-10 h-10 flex items-center justify-center bg-red-100 hover:bg-red-200 dark:bg-red-900/20 dark:hover:bg-red-900/30 text-red-600 dark:text-red-400 rounded-lg transition-all duration-200">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                    </svg>
                              </button>
                        </div>
                  `;
                  container.appendChild(pillarDiv);
                  pillarCounter++;
                  updatePillarNumbers();
            }

            function removePillar(button) {
                  button.closest('.pillar-item').remove();
                  updatePillarNumbers();
            }

            function updatePillarNumbers() {
                  const pillars = document.querySelectorAll('.pillar-item');
                  pillars.forEach((pillar, index) => {
                        const label = pillar.querySelector('label');
                        label.textContent = `Pilar ${index + 1}`;
                        const urutanInput = pillar.querySelector('input[type="hidden"]');
                        urutanInput.value = index;
                  });
            }

            // Add initial mission and pillar on page load
            document.addEventListener('DOMContentLoaded', function() {
                  addMission();
                  addPillar();
            });
      </script>
      @endpush
</x-layouts::app>