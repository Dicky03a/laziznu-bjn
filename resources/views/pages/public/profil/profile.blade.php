@extends('layouts.public.app')
@section('title', 'Profil - LAZIZNU Bojonegoro')
@section('content')

<!-- HERO HEADER -->
<section class="relative bg-gradient-to-br from-emerald-600 to-emerald-700 py-20 sm:py-24 overflow-hidden">
      <!-- Decorative Elements -->
      <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 left-0 w-96 h-96 bg-emerald-500 rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-emerald-600 rounded-full blur-3xl"></div>
      </div>

      <div class="relative max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
            <div class="inline-block mb-6 px-4 py-1.5 bg-emerald-500/20 backdrop-blur-sm rounded-full border border-emerald-400/30">
                  <span class="text-emerald-200 text-sm font-medium">Tentang Kami</span>
            </div>

            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white tracking-tight mb-4">
                  Profil NU Care–LAZISNU
            </h1>

            <p class="text-base sm:text-lg text-emerald-100/90 max-w-2xl mx-auto leading-relaxed">
                  Lembaga Amil Zakat, Infaq, dan Shadaqah Nahdlatul Ulama Kabupaten Bojonegoro
            </p>
      </div>
</section>

<!-- PROFILE CONTENT -->
<section class="max-w-7xl mx-auto py-16 sm:py-20 lg:py-24 px-4 sm:px-6 lg:px-8">
      <div class="grid lg:grid-cols-2 gap-12 lg:gap-16 items-center">

            <!-- TEXT CONTENT -->
            <div class="order-2 lg:order-1">
                  <div class="inline-block mb-4 px-3 py-1 bg-emerald-50 text-emerald-700 text-xs font-semibold border-2 border-emerald-200 rounded-full">
                        Laziznu Bojonegoro
                  </div>

                  <h2 class="text-2xl sm:text-3xl font-bold text-slate-900 mb-6 tracking-tight">
                        NU CARE–LAZISNU
                  </h2>

                  <div class="space-y-4 text-slate-600 leading-relaxed">
                        <p>
                              Lembaga Amil Zakat, Infak, dan Sedekah Nahdlatul Ulama (LAZISNU) merupakan lembaga nirlaba milik Nahdlatul Ulama yang berkhidmat dalam pemberdayaan masyarakat melalui pendayagunaan dana zakat, infak, sedekah, dan wakaf (ZISWAF).
                        </p>

                        <p>
                              Sebagai lembaga resmi di bawah naungan Nahdlatul Ulama, LAZISNU hadir sebagai mitra umat dalam penguatan sosial, pendidikan, kesehatan dan pemberdayaan ekonomi.
                        </p>
                  </div>

                  <!-- Stats -->
                  <div class="grid grid-cols-3 gap-6 mt-8 pt-8 border-t border-slate-200">
                        <div>
                              <div class="text-2xl sm:text-3xl font-bold text-emerald-600">22</div>
                              <div class="text-xs sm:text-sm text-slate-600 mt-1">Tahun Berdiri</div>
                        </div>
                        <div>
                              <div class="text-2xl sm:text-3xl font-bold text-emerald-600">53.314.706</div>
                              <div class="text-xs sm:text-sm text-slate-600 mt-1">Penerima Manfaat</div>
                        </div>
                        <div>
                              <div class="text-2xl sm:text-3xl font-bold text-emerald-600">500+</div>
                              <div class="text-xs sm:text-sm text-slate-600 mt-1">Program Tersalurkan</div>
                        </div>
                  </div>
            </div>

            <!-- IMAGE -->
            <div class="order-1 lg:order-2">
                  <div class="relative">
                        <div class="absolute -inset-4 bg-gradient-to-r from-emerald-500/20 to-emerald-600/20 rounded-3xl blur-2xl"></div>
                        <img src="{{ asset('asset/hero.png') }}"
                              class="relative rounded-2xl shadow-2xl w-full"
                              alt="NU Care LAZISNU"
                              loading="eager">
                  </div>
            </div>

      </div>
</section>

<!-- VISI MISI -->
<section class="bg-slate-50/50 py-16 sm:py-20 lg:py-24">
      <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="text-center mb-12 lg:mb-16">
                  <h2 class="text-3xl sm:text-4xl font-bold text-slate-900 tracking-tight mb-3">
                        Visi & Misi
                  </h2>
                  <div class="w-16 h-1 bg-gradient-to-r from-emerald-500 to-emerald-600 mx-auto rounded-full"></div>
            </div>

            <div class="grid md:grid-cols-2 gap-8 lg:gap-12">

                  <!-- VISI -->
                  <div class="group bg-white p-8 lg:p-10 rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 border border-slate-100 hover:border-emerald-100">
                        <div class="flex items-center gap-3 mb-6">
                              <div class="flex items-center justify-center w-12 h-12 rounded-xl bg-gradient-to-br from-emerald-500 to-emerald-600 shadow-lg shadow-emerald-500/20">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                    </svg>
                              </div>
                              <h3 class="text-xl font-bold text-slate-900">
                                    Visi
                              </h3>
                        </div>

                        <p class="text-slate-600 leading-relaxed">
                              Menjadi lembaga filantropi Islam terpercaya, modern, profesional dan berdampak luas bagi kemaslahatan umat.
                        </p>
                  </div>

                  <!-- MISI -->
                  <div class="group bg-white p-8 lg:p-10 rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 border border-slate-100 hover:border-emerald-100">
                        <div class="flex items-center gap-3 mb-6">
                              <div class="flex items-center justify-center w-12 h-12 rounded-xl bg-gradient-to-br from-emerald-500 to-emerald-600 shadow-lg shadow-emerald-500/20">
                                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                              </div>
                              <h3 class="text-xl font-bold text-slate-900">
                                    Misi
                              </h3>
                        </div>

                        <ul class="space-y-3 text-sm text-slate-600 leading-relaxed">
                              <li class="flex items-start gap-3">
                                    <svg class="w-5 h-5 text-emerald-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                    <span>Menghimpun dana zakat, infaq dan shadaqah secara optimal</span>
                              </li>
                              <li class="flex items-start gap-3">
                                    <svg class="w-5 h-5 text-emerald-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                    <span>Mengelola dana secara transparan dan akuntabel</span>
                              </li>
                              <li class="flex items-start gap-3">
                                    <svg class="w-5 h-5 text-emerald-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                    <span>Mendorong pemberdayaan ekonomi umat</span>
                              </li>
                              <li class="flex items-start gap-3">
                                    <svg class="w-5 h-5 text-emerald-500 mt-0.5 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                                          <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                    </svg>
                                    <span>Menguatkan layanan sosial dan kemanusiaan</span>
                              </li>
                        </ul>
                  </div>

            </div>
      </div>
</section>

<!-- 5 PILAR PROGRAM -->
<section class="py-16 sm:py-20 lg:py-24 bg-white">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="text-center mb-12 lg:mb-16">
                  <h2 class="text-3xl sm:text-4xl font-bold text-slate-900 tracking-tight mb-4">
                        5 Pilar Program
                  </h2>
                  <p class="text-slate-600 max-w-2xl mx-auto">
                        Program pemberdayaan masyarakat untuk kesejahteraan berkelanjutan
                  </p>
            </div>

            <div class="grid sm:grid-cols-2 lg:grid-cols-5 gap-6 lg:gap-8">

                  @php
                  $pillars = [
                  ['name' => 'CERDAS', 'desc' => 'Program pendidikan untuk meningkatkan kualitas SDM dan akses belajar berkualitas'],
                  ['name' => 'BERDAYA', 'desc' => 'Pemberdayaan ekonomi melalui pelatihan kewirausahaan dan modal usaha'],
                  ['name' => 'SEHAT', 'desc' => 'Layanan kesehatan preventif dan kuratif untuk masyarakat kurang mampu'],
                  ['name' => 'DAMAI', 'desc' => 'Bantuan kebencanaan dan aksi sosial kemanusiaan untuk yang membutuhkan'],
                  ['name' => 'HIJAU', 'desc' => 'Pelestarian lingkungan dan pengelolaan sumber daya alam berkelanjutan']
                  ];
                  @endphp

                  @foreach($pillars as $index => $pillar)
                  <div class="group bg-slate-50 hover:bg-white p-6 lg:p-8 rounded-2xl shadow-sm hover:shadow-xl transition-all duration-300 border border-slate-100 hover:border-emerald-200 text-center">
                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-xl bg-gradient-to-br from-emerald-500 to-emerald-600 text-white text-2xl font-bold mb-4 shadow-lg shadow-emerald-500/20 group-hover:scale-110 transition-transform duration-300">
                              {{ $index + 1 }}
                        </div>

                        <h3 class="font-bold text-slate-900 mb-3 text-base">
                              NUCARE {{ $pillar['name'] }}
                        </h3>

                        <p class="text-xs text-slate-600 leading-relaxed">
                              {{ $pillar['desc'] }}
                        </p>
                  </div>
                  @endforeach

            </div>
      </div>
</section>

<!-- CTA SECTION -->
<section class="relative bg-gradient-to-br from-emerald-600 to-emerald-700 py-16 sm:py-20 overflow-hidden">
      <!-- Decorative Elements -->
      <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 right-0 w-96 h-96 bg-white rounded-full blur-3xl"></div>
            <div class="absolute bottom-0 left-0 w-96 h-96 bg-white rounded-full blur-3xl"></div>
      </div>

      <div class="relative max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
            <h2 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-white mb-6 tracking-tight">
                  Bersama Kita Bangun<br class="sm:hidden" /> Kemandirian Umat
            </h2>

            <p class="text-emerald-100 mb-8 max-w-xl mx-auto">
                  Salurkan zakat, infaq, dan shadaqah Anda melalui program-program yang tepat sasaran dan berdampak nyata
            </p>

            <div class="flex flex-wrap gap-4 justify-center">
                  <button class="group px-8 py-3.5 bg-white text-emerald-700 font-semibold rounded-lg hover:bg-emerald-50 transition-all duration-200 shadow-lg hover:shadow-xl hover:-translate-y-0.5">
                        Salurkan Donasi Sekarang
                        <span class="inline-block ml-2 transition-transform duration-200 group-hover:translate-x-1">→</span>
                  </button>

                  <button class="px-8 py-3.5 bg-transparent border-2 border-white text-white font-semibold rounded-lg hover:bg-white/10 backdrop-blur-sm transition-all duration-200">
                        Hubungi Kami
                  </button>
            </div>
      </div>
</section>

@endsection