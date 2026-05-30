<x-layouts::app :title="__('Detail Profil')">
      <div class="min-h-screen   py-8 px-4">
            <div class="max-w-5xl mx-auto space-y-6">

                  <!-- Breadcrumb -->
                  <nav class="flex items-center gap-2 text-sm text-slate-600 ">
                        <a href="{{ route('profiles.index') }}" class="hover:text-green-600  transition-colors">
                              Data Profil
                        </a>
                        <span>/</span>
                        <span class="text-slate-900  font-medium">Detail Profil</span>
                  </nav>

                  <!-- Main Card -->
                  <div class="bg-white  rounded-2xl shadow-xl border border-slate-200  overflow-hidden">

                        <!-- Header dengan Gradient -->
                        <div class="relative bg-emerald-600 px-8 py-12">
                              <div class="absolute inset-0 bg-black/10"></div>
                              <div class="relative">
                                    <h1 class="text-3xl font-bold text-white mb-2">{{ $profile->title }}</h1>
                                    <p class="text-green-100 text-sm">ID Profil: #{{ $profile->id }}</p>
                              </div>
                        </div>

                        <!-- Content Section -->
                        <div class="p-8 space-y-8">

                              <!-- Deskripsi -->
                              <div class="space-y-3">
                                    <div class="flex items-center gap-2 text-slate-700 ">
                                          <h2 class="text-lg font-semibold">Tentang</h2>
                                    </div>
                                    <p class="text-slate-600  leading-relaxed">
                                          {{ $profile->deskripsi }}
                                    </p>
                              </div>

                              <!-- Statistics Grid -->
                              <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                                    <!-- Tahun Berdiri -->
                                    <div class="bg-gradient-to-br from-emerald-50 to-emerald-100   rounded-xl p-6 border border-emerald-200 ">
                                          <p class="text-sm font-medium text-emerald-700  mb-1">Tahun Berdiri</p>
                                          <p class="text-3xl font-bold text-emerald-900 ">{{ $profile->tahun_berdiri }}</p>
                                    </div>

                                    <!-- Penerima Manfaat -->
                                    <div class="bg-gradient-to-br from-green-50 to-green-100   rounded-xl p-6 border border-green-200 ">
                                          <p class="text-sm font-medium text-green-700  mb-1">Penerima Manfaat</p>
                                          <p class="text-3xl font-bold text-green-900 ">{{ number_format($profile->penerima_manfaat, 0, ',', '.') }}</p>
                                          <p class="text-xs text-green-600  mt-1">orang terdampak</p>
                                    </div>

                                    <!-- Program Tersalurkan -->
                                    <div class="bg-gradient-to-br from-emerald-50 to-emerald-100   rounded-xl p-6 border border-emerald-200 ">
                                          <p class="text-sm font-medium text-emerald-700  mb-1">Program Tersalurkan</p>
                                          <p class="text-3xl font-bold text-emerald-900 ">{{ $profile->program_tersalurkan }}</p>
                                          <p class="text-xs text-emerald-600  mt-1">program aktif</p>
                                    </div>
                              </div>

                              <!-- Visi Section -->
                              <div class="bg-white   rounded-xl p-6 border ">
                                    <div class="flex items-start gap-4">
                                          <div class="flex-1">
                                                <h2 class="text-lg font-bold text-black  mb-2">Visi Organisasi</h2>
                                                <p class="text-black  leading-relaxed">{{ $profile->visi }}</p>
                                          </div>
                                    </div>
                              </div>

                              <!-- Misi Section -->
                              @if($profile->missions->count() > 0)
                              <div class="bg-white   rounded-xl p-6 border border-emerald-200 ">
                                    <div class="flex items-center gap-3 mb-4">
                                          <h2 class="text-lg font-bold text-emerald-900 ">Misi Organisasi</h2>
                                    </div>
                                    <div class="space-y-3 pl-13">
                                          @foreach($profile->missions as $mission)
                                          <div class="flex gap-3 items-start">
                                                <div class="flex-shrink-0 w-6 h-6 bg-emerald-600 rounded-full flex items-center justify-center text-white text-xs font-bold mt-0.5">
                                                      {{ $loop->iteration }}
                                                </div>
                                                <p class="text-emerald-800  leading-relaxed flex-1">{{ $mission->text }}</p>
                                          </div>
                                          @endforeach
                                    </div>
                              </div>
                              @endif

                              <!-- Pilar Section -->
                              @if($profile->pillars->count() > 0)
                              <div class="space-y-4">
                                    <div class="flex items-center gap-3">
                                          <h2 class="text-lg font-bold text-slate-900 ">Pilar Program</h2>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                          @foreach($profile->pillars as $pillar)
                                          <div class="bg-gradient-to-br from-emerald-50 to-pink-50   rounded-xl p-5 border border-emerald-200  hover:shadow-lg transition-shadow duration-200">
                                                <div class="flex items-start gap-3">

                                                      <div class="flex-1">
                                                            <h3 class="font-bold text-emerald-900  mb-2">{{ $pillar->title }}</h3>
                                                            @if($pillar->deskripsi)
                                                            <p class="text-sm text-emerald-800  leading-relaxed">{{ $pillar->deskripsi }}</p>
                                                            @endif
                                                      </div>
                                                </div>
                                          </div>
                                          @endforeach
                                    </div>
                              </div>
                              @endif

                              <!-- Action Buttons -->
                              <div class="flex flex-col sm:flex-row justify-between items-center gap-4 pt-6 border-t border-slate-200 ">
                                    <a
                                          href="{{ route('profiles.index') }}"
                                          class="px-6 py-3 bg-slate-100 hover:bg-slate-200   text-slate-700  rounded-lg font-medium transition-all duration-200 flex items-center gap-2 w-full sm:w-auto justify-center">
                                          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                                          </svg>
                                          Kembali ke Daftar
                                    </a>

                                    <div class="flex gap-3 w-full sm:w-auto">
                                          <a
                                                href="{{ route('profiles.edit', $profile) }}"
                                                class="flex-1 sm:flex-none px-6 py-3 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg font-medium shadow-lg shadow-emerald-500/30 hover:shadow-xl hover:shadow-emerald-500/40 transition-all duration-200 flex items-center justify-center gap-2">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                                </svg>
                                                Edit Profil
                                          </a>
                                    </div>
                              </div>

                        </div>
                  </div>

            </div>
      </div>
</x-layouts::app>