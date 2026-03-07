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
                                    <div class="inline-flex items-center gap-2 px-3 py-1 bg-white/20 backdrop-blur-sm rounded-full text-white text-xs font-medium mb-4">
                                          <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd" />
                                          </svg>
                                          Sejak {{ $profile->tahun_berdiri }}
                                    </div>
                                    <h1 class="text-3xl font-bold text-white mb-2">{{ $profile->title }}</h1>
                                    <p class="text-green-100 text-sm">ID Profil: #{{ $profile->id }}</p>
                              </div>
                        </div>

                        <!-- Content Section -->
                        <div class="p-8 space-y-8">

                              <!-- Deskripsi -->
                              <div class="space-y-3">
                                    <div class="flex items-center gap-2 text-slate-700 ">
                                          <svg class="w-5 h-5 text-green-600 " fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                          </svg>
                                          <h2 class="text-lg font-semibold">Tentang</h2>
                                    </div>
                                    <p class="text-slate-600  leading-relaxed pl-7">
                                          {{ $profile->deskripsi }}
                                    </p>
                              </div>

                              <!-- Statistics Grid -->
                              <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                                    <!-- Tahun Berdiri -->
                                    <div class="bg-gradient-to-br from-emerald-50 to-emerald-100   rounded-xl p-6 border border-emerald-200 ">
                                          <div class="flex items-start justify-between mb-3">
                                                <div class="w-12 h-12 bg-emerald-500 rounded-lg flex items-center justify-center shadow-lg">
                                                      <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                                      </svg>
                                                </div>
                                          </div>
                                          <p class="text-sm font-medium text-emerald-700  mb-1">Tahun Berdiri</p>
                                          <p class="text-3xl font-bold text-emerald-900 ">{{ $profile->tahun_berdiri }}</p>
                                    </div>

                                    <!-- Penerima Manfaat -->
                                    <div class="bg-gradient-to-br from-green-50 to-green-100   rounded-xl p-6 border border-green-200 ">
                                          <div class="flex items-start justify-between mb-3">
                                                <div class="w-12 h-12 bg-green-500 rounded-lg flex items-center justify-center shadow-lg">
                                                      <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                                      </svg>
                                                </div>
                                          </div>
                                          <p class="text-sm font-medium text-green-700  mb-1">Penerima Manfaat</p>
                                          <p class="text-3xl font-bold text-green-900 ">{{ number_format($profile->penerima_manfaat, 0, ',', '.') }}</p>
                                          <p class="text-xs text-green-600  mt-1">orang terdampak</p>
                                    </div>

                                    <!-- Program Tersalurkan -->
                                    <div class="bg-gradient-to-br from-emerald-50 to-emerald-100   rounded-xl p-6 border border-emerald-200 ">
                                          <div class="flex items-start justify-between mb-3">
                                                <div class="w-12 h-12 bg-emerald-500 rounded-lg flex items-center justify-center shadow-lg">
                                                      <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                                                      </svg>
                                                </div>
                                          </div>
                                          <p class="text-sm font-medium text-emerald-700  mb-1">Program Tersalurkan</p>
                                          <p class="text-3xl font-bold text-emerald-900 ">{{ $profile->program_tersalurkan }}</p>
                                          <p class="text-xs text-emerald-600  mt-1">program aktif</p>
                                    </div>
                              </div>

                              <!-- Visi Section -->
                              <div class="bg-white   rounded-xl p-6 border ">
                                    <div class="flex items-start gap-4">
                                          <div class="w-12 h-12 bg-emerald-500 rounded-lg flex items-center justify-center flex-shrink-0 shadow-lg">
                                                <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                                </svg>
                                          </div>
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
                                          <div class="w-10 h-10 bg-emerald-500 rounded-lg flex items-center justify-center shadow-lg">
                                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                          </div>
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
                                          <div class="w-10 h-10 bg-emerald-500 rounded-lg flex items-center justify-center shadow-lg">
                                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10" />
                                                </svg>
                                          </div>
                                          <h2 class="text-lg font-bold text-slate-900 ">Pilar Program</h2>
                                    </div>

                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                          @foreach($profile->pillars as $pillar)
                                          <div class="bg-gradient-to-br from-emerald-50 to-pink-50   rounded-xl p-5 border border-emerald-200  hover:shadow-lg transition-shadow duration-200">
                                                <div class="flex items-start gap-3">
                                                      <div class="flex-shrink-0 w-8 h-8 bg-emerald-600 rounded-lg flex items-center justify-center text-white text-sm font-bold">
                                                            {{ $loop->iteration }}
                                                      </div>
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

                                          <form method="POST" action="{{ route('profiles.destroy', $profile) }}" class="inline-block" onsubmit="return confirm('Apakah Anda yakin ingin menghapus profil ini? Tindakan ini tidak dapat dibatalkan.')">
                                                @csrf
                                                @method('DELETE')
                                                <button
                                                      type="submit"
                                                      class="px-6 py-3 bg-emerald-600 hover:bg-emerald-700 text-white rounded-lg font-medium shadow-lg shadow-emerald-500/30 hover:shadow-xl hover:shadow-emerald-500/40 transition-all duration-200 flex items-center gap-2">
                                                      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
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