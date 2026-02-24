<x-layouts::app :title="__('Edit Profil')">
      <div class="min-h-screen  dark:from-zinc-900 dark:to-zinc-800 py-8 px-4">
            <div class="max-w-4xl mx-auto">

                  <!-- Breadcrumb -->
                  <nav class="mb-6 flex items-center gap-2 text-sm text-slate-600 dark:text-slate-400">
                        <a href="{{ route('profiles.index') }}" class="hover:text-green-600 dark:hover:text-green-400 transition-colors">
                              Data Profil
                        </a>
                        <span>/</span>
                        <a href="{{ route('profiles.show', $profile) }}" class="hover:text-green-600 dark:hover:text-green-400 transition-colors">
                              Detail Profil
                        </a>
                        <span>/</span>
                        <span class="text-slate-900 dark:text-white font-medium">Edit Profil</span>
                  </nav>

                  <!-- Main Card -->
                  <div class="bg-white dark:bg-zinc-900 rounded-2xl shadow-xl border border-slate-200 dark:border-zinc-800 overflow-hidden">

                        <!-- Header -->
                        <div class="bg-emerald-600 px-8 py-6">
                              <h1 class="text-2xl font-bold text-white flex items-center gap-3">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                    </svg>
                                    Edit Profil
                              </h1>
                              <p class="text-amber-100 mt-1 text-sm">Perbarui informasi profil organisasi</p>
                        </div>

                        <!-- Profile Info Banner -->
                        <div class="bg-slate-50 dark:bg-zinc-800/50 px-8 py-4 border-b border-slate-200 dark:border-zinc-800">
                              <div class="flex items-center gap-3">
                                    <div class="w-12 h-12 bg-emerald-600 rounded-lg flex items-center justify-center flex-shrink-0">
                                          <span class="text-white font-bold text-lg">{{ substr($profile->title, 0, 2) }}</span>
                                    </div>
                                    <div>
                                          <p class="font-semibold text-slate-900 dark:text-white">{{ $profile->title }}</p>
                                          <p class="text-xs text-slate-500 dark:text-slate-400">ID: #{{ $profile->id }}</p>
                                    </div>
                              </div>
                        </div>

                        <!-- Form -->
                        <form method="POST" action="{{ route('profiles.update', $profile) }}" class="p-8 space-y-6">
                              @csrf
                              @method('PUT')

                              <!-- Judul -->
                              <div class="space-y-2">
                                    <label for="title" class="block text-sm font-semibold text-slate-700 dark:text-slate-300">
                                          Judul Profil <span class="text-red-500">*</span>
                                    </label>
                                    <input
                                          type="text"
                                          id="title"
                                          name="title"
                                          value="{{ old('title', $profile->title) }}"
                                          required
                                          class="w-full px-4 py-3 border border-slate-300 dark:border-zinc-700 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent dark:bg-zinc-800 dark:text-white transition-all duration-200 placeholder:text-slate-400">
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
                                          required
                                          class="w-full px-4 py-3 border border-slate-300 dark:border-zinc-700 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent dark:bg-zinc-800 dark:text-white transition-all duration-200 placeholder:text-slate-400 resize-none">{{ old('deskripsi', $profile->deskripsi) }}</textarea>
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
                                          <div class="relative">
                                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                      <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                      </svg>
                                                </div>
                                                <input
                                                      type="text"
                                                      id="tahun_berdiri"
                                                      name="tahun_berdiri"
                                                      value="{{ old('tahun_berdiri', $profile->tahun_berdiri) }}"
                                                      required
                                                      class="w-full pl-10 pr-4 py-3 border border-slate-300 dark:border-zinc-700 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent dark:bg-zinc-800 dark:text-white transition-all duration-200">
                                          </div>
                                          @error('tahun_berdiri')
                                          <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                          @enderror
                                    </div>

                                    <!-- Penerima Manfaat -->
                                    <div class="space-y-2">
                                          <label for="penerima_manfaat" class="block text-sm font-semibold text-slate-700 dark:text-slate-300">
                                                Penerima Manfaat <span class="text-red-500">*</span>
                                          </label>
                                          <div class="relative">
                                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                      <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                                      </svg>
                                                </div>
                                                <input
                                                      type="number"
                                                      id="penerima_manfaat"
                                                      name="penerima_manfaat"
                                                      value="{{ old('penerima_manfaat', $profile->penerima_manfaat) }}"
                                                      required
                                                      min="0"
                                                      class="w-full pl-10 pr-4 py-3 border border-slate-300 dark:border-zinc-700 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent dark:bg-zinc-800 dark:text-white transition-all duration-200">
                                          </div>
                                          @error('penerima_manfaat')
                                          <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                          @enderror
                                    </div>

                                    <!-- Program Tersalurkan -->
                                    <div class="space-y-2">
                                          <label for="program_tersalurkan" class="block text-sm font-semibold text-slate-700 dark:text-slate-300">
                                                Program Tersalurkan <span class="text-red-500">*</span>
                                          </label>
                                          <div class="relative">
                                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                                      <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                                                      </svg>
                                                </div>
                                                <input
                                                      type="number"
                                                      id="program_tersalurkan"
                                                      name="program_tersalurkan"
                                                      value="{{ old('program_tersalurkan', $profile->program_tersalurkan) }}"
                                                      required
                                                      min="0"
                                                      class="w-full pl-10 pr-4 py-3 border border-slate-300 dark:border-zinc-700 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent dark:bg-zinc-800 dark:text-white transition-all duration-200">
                                          </div>
                                          @error('program_tersalurkan')
                                          <p class="text-sm text-red-600 dark:text-red-400">{{ $message }}</p>
                                          @enderror
                                    </div>
                              </div>

                              <!-- Visi -->
                              <div class="space-y-2">
                                    <label for="visi" class="block text-sm font-semibold text-slate-700 dark:text-slate-300">
                                          Visi Organisasi <span class="text-red-500">*</span>
                                    </label>
                                    <textarea
                                          id="visi"
                                          name="visi"
                                          rows="3"
                                          required
                                          class="w-full px-4 py-3 border border-slate-300 dark:border-zinc-700 rounded-lg focus:ring-2 focus:ring-amber-500 focus:border-transparent dark:bg-zinc-800 dark:text-white transition-all duration-200 placeholder:text-slate-400 resize-none">{{ old('visi', $profile->visi) }}</textarea>
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
                                                      <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                      </svg>
                                                      Misi Organisasi
                                                </h3>
                                                <p class="text-sm text-slate-600 dark:text-slate-400 mt-1">Tambahkan misi-misi organisasi</p>
                                          </div>
                                          <button
                                                type="button"
                                                onclick="addMission()"
                                                class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg text-sm font-medium transition-all duration-200 flex items-center gap-2">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                                </svg>
                                                Tambah Misi
                                          </button>
                                    </div>

                                    <div id="missions-container" class="space-y-3">
                                          <!-- Existing missions will be loaded here -->
                                    </div>
                              </div>

                              <!-- Divider -->
                              <div class="border-t border-slate-200 dark:border-zinc-700 my-6"></div>

                              <!-- PILAR Section -->
                              <div class="space-y-4">
                                    <div class="flex items-center justify-between">
                                          <div>
                                                <h3 class="text-lg font-semibold text-slate-900 dark:text-white flex items-center gap-2">
                                                      <svg class="w-5 h-5 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                                      </svg>
                                                      Pilar Program
                                                </h3>
                                                <p class="text-sm text-slate-600 dark:text-slate-400 mt-1">Tambahkan pilar-pilar program organisasi</p>
                                          </div>
                                          <button
                                                type="button"
                                                onclick="addPillar()"
                                                class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg text-sm font-medium transition-all duration-200 flex items-center gap-2">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                                                </svg>
                                                Tambah Pilar
                                          </button>
                                    </div>

                                    <div id="pillars-container" class="space-y-4">
                                          <!-- Existing pillars will be loaded here -->
                                    </div>
                              </div>

                              <!-- Info Box -->
                              <div class="bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-200 dark:border-emerald-800/30 rounded-lg p-4 flex gap-3">
                                    <svg class="w-5 h-5 text-emerald-600 dark:text-emerald-400 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    <div class="text-sm text-emerald-800 dark:text-emerald-300">
                                          <p class="font-semibold mb-1">Perhatian</p>
                                          <p>Pastikan semua informasi yang dimasukkan sudah benar sebelum menyimpan perubahan.</p>
                                    </div>
                              </div>

                              <!-- Divider -->
                              <div class="border-t border-slate-200 dark:border-zinc-700 pt-6">
                                    <div class="flex flex-col sm:flex-row justify-between items-center gap-4">
                                          <a
                                                href="{{ route('profiles.show', $profile) }}"
                                                class="px-6 py-3 bg-slate-100 hover:bg-slate-200 dark:bg-zinc-800 dark:hover:bg-zinc-700 text-slate-700 dark:text-slate-300 rounded-lg font-medium transition-all duration-200 flex items-center gap-2 w-full sm:w-auto justify-center">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                                Batal
                                          </a>

                                          <button
                                                type="submit"
                                                class="px-8 py-3 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg font-semibold shadow-lg shadow-emerald-500/30 hover:shadow-xl hover:shadow-emerald-500/40 transition-all duration-200 flex items-center justify-center gap-2 w-full sm:w-auto">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                </svg>
                                                Simpan Perubahan
                                          </button>
                                    </div>
                              </div>
                        </form>

                  </div>

                  <!-- Last Updated Info -->
                  <div class="mt-4 text-center text-sm text-slate-500 dark:text-slate-400">
                        <p>Terakhir diperbarui: <span class="font-medium">{{ $profile->updated_at->format('d M Y, H:i') }}</span></p>
                  </div>

            </div>
      </div>

      @push('scripts')
      <script>
            let missionCounter = 0;
            let pillarCounter = 0;

            // Load existing missions
            const existingMissions = @json($profile-> missions);
            const existingPillars = @json($profile-> pillars);

            function addMission(text = '', urutan = null, missionId = null) {
                  const container = document.getElementById('missions-container');
                  const missionDiv = document.createElement('div');
                  const currentUrutan = urutan !== null ? urutan : missionCounter;
                  missionDiv.className = 'mission-item bg-emerald-50 dark:bg-emerald-900/10 border border-emerald-200 dark:border-emerald-800/30 rounded-lg p-4';
                  missionDiv.innerHTML = `
                        <div class="flex gap-3">
                              <div class="flex-1 space-y-2">
                                    <label class="block text-sm font-medium text-slate-700 dark:text-slate-300">
                                          Misi ${currentUrutan + 1}
                                    </label>
                                    <input
                                          type="text"
                                          name="missions[${currentUrutan}][text]"
                                          value="${text}"
                                          placeholder="Masukkan teks misi"
                                          required
                                          class="w-full px-4 py-2 border border-slate-300 dark:border-zinc-700 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent dark:bg-zinc-800 dark:text-white transition-all duration-200 placeholder:text-slate-400">
                                    <input type="hidden" name="missions[${currentUrutan}][urutan]" value="${currentUrutan}">
                                    ${missionId ? `<input type="hidden" name="missions[${currentUrutan}][id]" value="${missionId}">` : ''}
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
                        const urutanInput = mission.querySelector('input[name*="[urutan]"]');
                        urutanInput.value = index;
                  });
            }

            function addPillar(title = '', deskripsi = '', urutan = null, pillarId = null) {
                  const container = document.getElementById('pillars-container');
                  const pillarDiv = document.createElement('div');
                  const currentUrutan = urutan !== null ? urutan : pillarCounter;
                  pillarDiv.className = 'pillar-item bg-emerald-50 dark:bg-emerald-900/10 border border-emerald-200 dark:border-emerald-800/30 rounded-lg p-4';
                  pillarDiv.innerHTML = `
                        <div class="flex gap-3">
                              <div class="flex-1 space-y-3">
                                    <div>
                                          <label class="block text-sm font-medium text-slate-700 dark:text-slate-300 mb-2">
                                                Pilar ${currentUrutan + 1}
                                          </label>
                                          <input
                                                type="text"
                                                name="pillars[${currentUrutan}][title]"
                                                value="${title}"
                                                placeholder="Judul pilar"
                                                required
                                                class="w-full px-4 py-2 border border-slate-300 dark:border-zinc-700 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent dark:bg-zinc-800 dark:text-white transition-all duration-200 placeholder:text-slate-400">
                                    </div>
                                    <div>
                                          <textarea
                                                name="pillars[${currentUrutan}][deskripsi]"
                                                rows="2"
                                                placeholder="Deskripsi pilar"
                                                class="w-full px-4 py-2 border border-slate-300 dark:border-zinc-700 rounded-lg focus:ring-2 focus:ring-emerald-500 focus:border-transparent dark:bg-zinc-800 dark:text-white transition-all duration-200 placeholder:text-slate-400 resize-none">${deskripsi}</textarea>
                                    </div>
                                    <input type="hidden" name="pillars[${currentUrutan}][urutan]" value="${currentUrutan}">
                                    ${pillarId ? `<input type="hidden" name="pillars[${currentUrutan}][id]" value="${pillarId}">` : ''}
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
                        const urutanInput = pillar.querySelector('input[name*="[urutan]"]');
                        urutanInput.value = index;
                  });
            }

            // Load existing data on page load
            document.addEventListener('DOMContentLoaded', function() {
                  // Load existing missions
                  if (existingMissions && existingMissions.length > 0) {
                        existingMissions.forEach((mission, index) => {
                              addMission(mission.text, mission.urutan, mission.id);
                        });
                  } else {
                        addMission();
                  }

                  // Load existing pillars
                  if (existingPillars && existingPillars.length > 0) {
                        existingPillars.forEach((pillar, index) => {
                              addPillar(pillar.title, pillar.deskripsi || '', pillar.urutan, pillar.id);
                        });
                  } else {
                        addPillar();
                  }
            });
      </script>
      @endpush
</x-layouts::app>