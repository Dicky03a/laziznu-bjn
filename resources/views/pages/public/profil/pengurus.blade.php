@extends('layouts.public.app')
@section('title', 'Pengurus - LAZIZNU Bojonegoro')
@section('content')

<!-- HERO -->
<section class="relative bg-gradient-to-br from-emerald-600 to-emerald-700 py-20 sm:py-24 overflow-hidden">
      <!-- Decorative Elements -->
      <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 left-0 w-96 h-96 bg-emerald-500 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-emerald-600 rounded-full blur-3xl"></div>
      </div>

      <div class="relative max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
            <div class="inline-block mb-6 px-4 py-1.5 bg-emerald-500/20 backdrop-blur-sm rounded-full border border-emerald-400/30">
                  <span class="text-emerald-200 text-sm font-medium">Struktur Organisasi</span>
            </div>

            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white tracking-tight mb-4 leading-tight">
                  Susunan Pengurus Cabang
            </h1>

            <p class="text-base sm:text-lg text-emerald-100/90 mb-2">
                  Lembaga Amil Zakat, Infaq dan Shadaqah Nahdlatul Ulama
            </p>
            <p class="text-base sm:text-lg text-emerald-100/90 mb-4">
                  Kabupaten Bojonegoro
            </p>

            <div class="inline-block px-4 py-2 bg-white/10 backdrop-blur-sm rounded-lg border border-white/20">
                  <p class="text-emerald-200 text-sm font-medium">
                        Masa Khidmat 2022 – 2026
                  </p>
            </div>
      </div>
</section>

<!-- PENGURUS INTI -->
<section class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 py-16 sm:py-20 lg:py-24">

      <div class="text-center mb-12 lg:mb-16">
            <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 tracking-tight mb-3">
                  Pengurus Inti
            </h2>
            <div class="w-16 h-1 bg-gradient-to-r from-emerald-500 to-emerald-600 mx-auto rounded-full"></div>
      </div>

      <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8">

            <!-- KETUA -->
            <div class="group bg-white p-6 lg:p-8 rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 border border-slate-200 hover:border-emerald-200 text-center">
                  <div class="inline-flex items-center justify-center w-16 h-16 rounded-xl bg-gradient-to-br from-emerald-500 to-emerald-600 text-white mb-4 shadow-lg shadow-emerald-500/20 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                        </svg>
                  </div>
                  <h3 class="font-bold text-slate-900 mb-3 text-sm uppercase tracking-wide">Ketua</h3>
                  <p class="text-emerald-700 font-semibold text-base leading-snug">
                        KH. M. Nur Jalal Mujtaba, SQ
                  </p>
            </div>

            <!-- WAKIL KETUA -->
            <div class="group bg-white p-6 lg:p-8 rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 border border-slate-200 hover:border-emerald-200 text-center">
                  <div class="inline-flex items-center justify-center w-16 h-16 rounded-xl bg-gradient-to-br from-slate-500 to-slate-600 text-white mb-4 shadow-lg shadow-slate-500/20 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                  </div>
                  <h3 class="font-bold text-slate-900 mb-3 text-sm uppercase tracking-wide">Wakil Ketua</h3>
                  <div class="space-y-2">
                        <p class="text-emerald-700 font-medium text-sm leading-snug">
                              Aan Zainul Anwar, S.H.I., M.E.Sy.
                        </p>
                        <p class="text-emerald-700 font-medium text-sm leading-snug">
                              Zainuddin, S.H.I.
                        </p>
                  </div>
            </div>

            <!-- SEKRETARIS -->
            <div class="group bg-white p-6 lg:p-8 rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 border border-slate-200 hover:border-emerald-200 text-center">
                  <div class="inline-flex items-center justify-center w-16 h-16 rounded-xl bg-gradient-to-br from-blue-500 to-blue-600 text-white mb-4 shadow-lg shadow-blue-500/20 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                  </div>
                  <h3 class="font-bold text-slate-900 mb-3 text-sm uppercase tracking-wide">Sekretaris</h3>
                  <div class="space-y-2">
                        <p class="text-emerald-700 font-medium text-sm leading-snug">
                              Ahmad Azka Mahasin
                        </p>
                        <p class="text-emerald-700 font-medium text-sm leading-snug">
                              Ulin Nuha, A.Ha.
                        </p>
                  </div>
            </div>

            <!-- BENDAHARA -->
            <div class="group bg-white p-6 lg:p-8 rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 border border-slate-200 hover:border-emerald-200 text-center">
                  <div class="inline-flex items-center justify-center w-16 h-16 rounded-xl bg-gradient-to-br from-amber-500 to-amber-600 text-white mb-4 shadow-lg shadow-amber-500/20 group-hover:scale-110 transition-transform duration-300">
                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                  </div>
                  <h3 class="font-bold text-slate-900 mb-3 text-sm uppercase tracking-wide">Bendahara</h3>
                  <div class="space-y-2">
                        <p class="text-emerald-700 font-medium text-sm leading-snug">
                              Yuni Astuti Rahayu, SE., Akt.
                        </p>
                        <p class="text-emerald-700 font-medium text-sm leading-snug">
                              Ahmad Fauzan Mubarok, M.Sy.
                        </p>
                  </div>
            </div>

      </div>
</section>

<!-- MANAJEMEN NUCARE -->
<section class="bg-slate-50/50 py-16 sm:py-20 lg:py-24">
      <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="text-center mb-12 lg:mb-16">
                  <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 tracking-tight mb-3">
                        Manajemen NU Care
                  </h2>
                  <div class="w-16 h-1 bg-gradient-to-r from-emerald-500 to-emerald-600 mx-auto rounded-full"></div>
            </div>

            <div class="grid md:grid-cols-2 gap-8 lg:gap-12">

                  <!-- COLUMN 1 -->
                  <div class="bg-white p-8 lg:p-10 rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 border border-slate-200 hover:border-emerald-200">

                        <div class="space-y-6">
                              <!-- Item -->
                              <div class="pb-6 border-b border-slate-100 last:border-0 last:pb-0">
                                    <div class="flex items-start gap-3 mb-2">
                                          <div class="flex items-center justify-center w-8 h-8 rounded-lg bg-emerald-100 text-emerald-600 flex-shrink-0">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                      <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                                </svg>
                                          </div>
                                          <div class="flex-1">
                                                <h3 class="font-bold text-slate-900 text-sm mb-1">Kepala Cabang</h3>
                                                <p class="text-emerald-700 font-medium text-sm">Aan Zainul Anwar, S.H.I., M.E.Sy.</p>
                                          </div>
                                    </div>
                              </div>

                              <!-- Item -->
                              <div class="pb-6 border-b border-slate-100 last:border-0 last:pb-0">
                                    <div class="flex items-start gap-3 mb-2">
                                          <div class="flex items-center justify-center w-8 h-8 rounded-lg bg-blue-100 text-blue-600 flex-shrink-0">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                      <path d="M13 7H7v6h6V7z" />
                                                      <path fill-rule="evenodd" d="M7 2a1 1 0 012 0v1h2V2a1 1 0 112 0v1h2a2 2 0 012 2v2h1a1 1 0 110 2h-1v2h1a1 1 0 110 2h-1v2a2 2 0 01-2 2h-2v1a1 1 0 11-2 0v-1H9v1a1 1 0 11-2 0v-1H5a2 2 0 01-2-2v-2H2a1 1 0 110-2h1V9H2a1 1 0 010-2h1V5a2 2 0 012-2h2V2zM5 5h10v10H5V5z" clip-rule="evenodd" />
                                                </svg>
                                          </div>
                                          <div class="flex-1">
                                                <h3 class="font-bold text-slate-900 text-sm mb-1">Manajer IT & Penghimpunan</h3>
                                                <p class="text-emerald-700 font-medium text-sm">Ahmad Azka Mahasin</p>
                                          </div>
                                    </div>
                              </div>

                              <!-- Item -->
                              <div>
                                    <div class="flex items-start gap-3 mb-3">
                                          <div class="flex items-center justify-center w-8 h-8 rounded-lg bg-purple-100 text-purple-600 flex-shrink-0">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                      <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                                                </svg>
                                          </div>
                                          <div class="flex-1">
                                                <h3 class="font-bold text-slate-900 text-sm mb-2">Staf IT & Penghimpunan</h3>
                                                <ul class="space-y-1.5">
                                                      <li class="flex items-center gap-2 text-slate-600 text-sm">
                                                            <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>
                                                            Muhammad Haidar
                                                      </li>
                                                      <li class="flex items-center gap-2 text-slate-600 text-sm">
                                                            <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>
                                                            Fathur Rizal
                                                      </li>
                                                      <li class="flex items-center gap-2 text-slate-600 text-sm">
                                                            <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>
                                                            Abdul Rohim
                                                      </li>
                                                      <li class="flex items-center gap-2 text-slate-600 text-sm">
                                                            <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>
                                                            Mohammad Kosim
                                                      </li>
                                                </ul>
                                          </div>
                                    </div>
                              </div>
                        </div>

                  </div>

                  <!-- COLUMN 2 -->
                  <div class="bg-white p-8 lg:p-10 rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 border border-slate-200 hover:border-emerald-200">

                        <div class="space-y-6">
                              <!-- Item -->
                              <div class="pb-6 border-b border-slate-100 last:border-0 last:pb-0">
                                    <div class="flex items-start gap-3 mb-2">
                                          <div class="flex items-center justify-center w-8 h-8 rounded-lg bg-orange-100 text-orange-600 flex-shrink-0">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                      <path d="M8 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0zM15 16.5a1.5 1.5 0 11-3 0 1.5 1.5 0 013 0z" />
                                                      <path d="M3 4a1 1 0 00-1 1v10a1 1 0 001 1h1.05a2.5 2.5 0 014.9 0H10a1 1 0 001-1V5a1 1 0 00-1-1H3zM14 7a1 1 0 00-1 1v6.05A2.5 2.5 0 0115.95 16H17a1 1 0 001-1v-5a1 1 0 00-.293-.707l-2-2A1 1 0 0015 7h-1z" />
                                                </svg>
                                          </div>
                                          <div class="flex-1">
                                                <h3 class="font-bold text-slate-900 text-sm mb-1">
                                                      Manajer Pendistribusian & Pemberdayaan
                                                </h3>
                                                <p class="text-emerald-700 font-medium text-sm">Muhammad Miqdad Syatroni</p>
                                          </div>
                                    </div>
                              </div>

                              <!-- Item -->
                              <div class="pb-6 border-b border-slate-100 last:border-0 last:pb-0">
                                    <div class="flex items-start gap-3 mb-3">
                                          <div class="flex items-center justify-center w-8 h-8 rounded-lg bg-purple-100 text-purple-600 flex-shrink-0">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                      <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                                                </svg>
                                          </div>
                                          <div class="flex-1">
                                                <h3 class="font-bold text-slate-900 text-sm mb-2">
                                                      Staf Pendistribusian & Pemberdayaan
                                                </h3>
                                                <ul class="space-y-1.5">
                                                      <li class="flex items-center gap-2 text-slate-600 text-sm">
                                                            <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>
                                                            Ahmad Izzul Fahmi
                                                      </li>
                                                      <li class="flex items-center gap-2 text-slate-600 text-sm">
                                                            <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>
                                                            Ahmad Faiz
                                                      </li>
                                                      <li class="flex items-center gap-2 text-slate-600 text-sm">
                                                            <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>
                                                            Muhammad Abdul Ghofur
                                                      </li>
                                                </ul>
                                          </div>
                                    </div>
                              </div>

                              <!-- Item -->
                              <div class="pb-6 border-b border-slate-100 last:border-0 last:pb-0">
                                    <div class="flex items-start gap-3 mb-2">
                                          <div class="flex items-center justify-center w-8 h-8 rounded-lg bg-amber-100 text-amber-600 flex-shrink-0">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                      <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z" />
                                                      <path fill-rule="evenodd" d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z" clip-rule="evenodd" />
                                                </svg>
                                          </div>
                                          <div class="flex-1">
                                                <h3 class="font-bold text-slate-900 text-sm mb-1">
                                                      Manajer Keuangan & Operasional
                                                </h3>
                                                <p class="text-emerald-700 font-medium text-sm">Ahmad Fauzan Mubarok, M.Sy.</p>
                                          </div>
                                    </div>
                              </div>

                              <!-- Item -->
                              <div>
                                    <div class="flex items-start gap-3 mb-3">
                                          <div class="flex items-center justify-center w-8 h-8 rounded-lg bg-purple-100 text-purple-600 flex-shrink-0">
                                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                      <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                                                </svg>
                                          </div>
                                          <div class="flex-1">
                                                <h3 class="font-bold text-slate-900 text-sm mb-2">
                                                      Staf Keuangan & Operasional
                                                </h3>
                                                <ul class="space-y-1.5">
                                                      <li class="flex items-center gap-2 text-slate-600 text-sm">
                                                            <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>
                                                            Diah Wiat Rina Lilik Laili Muna
                                                      </li>
                                                      <li class="flex items-center gap-2 text-slate-600 text-sm">
                                                            <span class="w-1.5 h-1.5 bg-emerald-500 rounded-full"></span>
                                                            Ahmad Muhyiddin
                                                      </li>
                                                </ul>
                                          </div>
                                    </div>
                              </div>
                        </div>

                  </div>

            </div>
      </div>
</section>

<!-- LEGAL INFO -->
<section class="py-16 sm:py-20">
      <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-gradient-to-br from-slate-50 to-slate-100 p-8 lg:p-10 rounded-2xl border border-slate-200">
                  <div class="flex items-start gap-4 mb-6">
                        <div class="flex items-center justify-center w-10 h-10 bg-emerald-600 rounded-lg flex-shrink-0">
                              <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                              </svg>
                        </div>
                        <div class="flex-1">
                              <h3 class="font-bold text-slate-900 mb-4 text-lg">
                                    Dasar Hukum Susunan Pengurus
                              </h3>

                              <div class="space-y-4 text-sm text-slate-600 leading-relaxed">
                                    <div class="flex items-start gap-3">
                                          <span class="inline-flex items-center justify-center w-6 h-6 bg-emerald-100 text-emerald-700 rounded-full flex-shrink-0 text-xs font-bold">1</span>
                                          <p>
                                                Surat Keputusan PCNU Kabupaten Bojonegoro Nomor: <span class="font-semibold text-slate-900">0454/PC/A.II.a/H.08/III/2024</span> tanggal 26 Maret 2024 tentang Pengesahan Pimpinan Cabang.
                                          </p>
                                    </div>

                                    <div class="flex items-start gap-3">
                                          <span class="inline-flex items-center justify-center w-6 h-6 bg-emerald-100 text-emerald-700 rounded-full flex-shrink-0 text-xs font-bold">2</span>
                                          <p>
                                                Surat Keputusan LAZISNU PBNU Nomor: <span class="font-semibold text-slate-900">00119/C/SK/A.II/LAZISNU-PBNU/IV/2024</span> tanggal 29 April 2024 tentang Pengesahan dan Pemberian Izin Operasional UPZIS.
                                          </p>
                                    </div>
                              </div>
                        </div>
                  </div>
            </div>
      </div>
</section>

@endsection