@extends('layouts.public.app')
@section('title', 'Zakat - LAZIZNU Bojonegoro')
@section('content')

{{-- Hero Banner Section --}}
<section class="relative bg-gray-900 overflow-hidden">
      <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1609137144813-7d9921338f24"
                  alt="Program Banner"
                  class="w-full h-full object-cover opacity-40">
            <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/80 to-transparent"></div>
      </div>

      <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-14 sm:py-16 lg:py-20">
            <div class="max-w-3xl">
                  {{-- Breadcrumb --}}
                  <nav class="flex items-center gap-2 text-sm text-gray-300 mb-6">
                        <a href="{{ route('home') }}" class="hover:text-white transition-colors">Beranda</a>
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                              <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                        <a href="{{ route('program') }}" class="hover:text-white transition-colors">Program</a>
                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                              <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-white font-medium">Zakat</span>
                  </nav>

                  <h1 class="text-2xl sm:text-3xl md:text-4xl lg:text-5xl font-bold text-white leading-tight mb-4">
                        Zakat Maal: Sucikan Hartamu 2,5%
                  </h1>

                  <div class="flex items-center gap-3 text-gray-300">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                              <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                        </svg>
                        <span class="text-sm sm:text-base md:text-lg">Kabupaten Bojonegoro, Jawa Timur</span>
                  </div>
            </div>
      </div>
</section>

{{-- Main Content --}}
<section class="bg-gray-50 py-16">
      <div class="max-w-7xl mx-auto px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">

                  {{-- Left Column - Main Card --}}
                  <div class="lg:col-span-2 space-y-8">

                        {{-- Progress Card --}}
                        <div class="bg-white rounded-3xl shadow-xl overflow-hidden border border-gray-100">
                              <div class="p-8 space-y-6">

                                    {{-- Stats Grid --}}
                                    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4 sm:gap-6">
                                          <div class="text-center p-6 bg-gradient-to-br from-emerald-50 to-emerald-100/50 rounded-2xl">
                                                <p class="text-sm text-emerald-700 font-medium mb-2">Dana Terkumpul</p>
                                                <h2 class="text-3xl font-bold text-emerald-600">Rp 20.000</h2>
                                          </div>

                                          <div class="text-center p-6 bg-gradient-to-br from-blue-50 to-blue-100/50 rounded-2xl">
                                                <p class="text-sm text-blue-700 font-medium mb-2">Total Muzakki</p>
                                                <h2 class="text-3xl font-bold text-blue-600">1</h2>
                                          </div>

                                          <div class="text-center p-6 bg-gradient-to-br from-purple-50 to-purple-100/50 rounded-2xl">
                                                <p class="text-sm text-purple-700 font-medium mb-2">Hari Tersisa</p>
                                                <h2 class="text-3xl font-bold text-purple-600">∞</h2>
                                          </div>
                                    </div>

                                    {{-- Progress Bar --}}
                                    <div class="space-y-3">
                                          <div class="flex justify-between items-center">
                                                <span class="text-gray-700 font-semibold">Progress</span>
                                                <span class="text-emerald-600 font-bold">20%</span>
                                          </div>
                                          <div class="relative w-full bg-gray-200 rounded-full h-4 overflow-hidden">
                                                <div class="absolute inset-0 bg-gradient-to-r from-emerald-500 to-emerald-600 h-4 rounded-full shadow-lg" style="width: 20%">
                                                      <div class="absolute inset-0 bg-white/20 animate-pulse"></div>
                                                </div>
                                          </div>
                                          <p class="text-sm text-gray-600">
                                                Program berkelanjutan untuk mendukung kegiatan kemanusiaan
                                          </p>
                                    </div>

                                    {{-- CTA Buttons --}}
                                    <div class="flex flex-col sm:flex-row gap-4 pt-4 w-full">
                                          <button class="flex-1 group bg-gradient-to-r from-emerald-600 to-emerald-500 hover:from-emerald-700 hover:to-emerald-600 text-white py-4 rounded-xl font-semibold shadow-lg hover:shadow-xl transition-all duration-300 flex items-center justify-center gap-3">
                                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                                <span>Infaq Sekarang</span>
                                                <svg class="w-5 h-5 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                                </svg>
                                          </button>

                                          <button class="w-full sm:w-auto px-8 py-4 border-2 border-emerald-600 text-emerald-600 rounded-xl font-semibold hover:bg-emerald-50 transition-all duration-300 flex items-center justify-center gap-2">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8.684 13.342C8.886 12.938 9 12.482 9 12c0-.482-.114-.938-.316-1.342m0 2.684a3 3 0 110-2.684m0 2.684l6.632 3.316m-6.632-6l6.632-3.316m0 0a3 3 0 105.367-2.684 3 3 0 00-5.367 2.684zm0 9.316a3 3 0 105.368 2.684 3 3 0 00-5.368-2.684z" />
                                                </svg>
                                                <span>Bagikan</span>
                                          </button>
                                    </div>

                              </div>
                        </div>

                        {{-- Tab Section --}}
                        <div x-data="{ tab: 'keterangan' }" class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden">

                              {{-- TAB HEADER --}}
                              <div class="border-b border-gray-200">
                                    <div class="flex gap-1 px-4 sm:px-6 lg:px-8 bg-gray-50 overflow-x-auto">
                                          <button @click="tab = 'keterangan'"
                                                :class="tab === 'keterangan' ? 'bg-white text-emerald-600 shadow-sm' : 'text-gray-600 hover:text-gray-900'"
                                                class="px-5 sm:px-6 py-3 sm:py-4 font-semibold rounded-t-xl transition-all whitespace-nowrap text-sm sm:text-base">
                                                <span class="flex items-center gap-2">
                                                      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                      </svg>
                                                      Keterangan
                                                </span>
                                          </button>

                                          <button @click="tab = 'kabar'"
                                                :class="tab === 'kabar' ? 'bg-white text-emerald-600 shadow-sm' : 'text-gray-600 hover:text-gray-900'"
                                                class="px-5 sm:px-6 py-3 sm:py-4 font-semibold rounded-t-xl transition-all whitespace-nowrap text-sm sm:text-base">
                                                <span class="flex items-center gap-2">
                                                      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                                      </svg>
                                                      Kabar Terbaru
                                                </span>
                                          </button>

                                          <button @click="tab = 'donatur'"
                                                :class="tab === 'donatur' ? 'bg-white text-emerald-600 shadow-sm' : 'text-gray-600 hover:text-gray-900'"
                                                class="px-5 sm:px-6 py-3 sm:py-4 font-semibold rounded-t-xl transition-all whitespace-nowrap text-sm sm:text-base">
                                                <span class="flex items-center gap-2">
                                                      <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                                                      </svg>
                                                      Donatur (30)
                                                </span>
                                          </button>
                                    </div>
                              </div>

                              <div class="p-5 sm:p-6 lg:p-8">

                                    {{-- ================= KETERANGAN ================= --}}
                                    <div x-show="tab === 'keterangan'" x-transition>
                                          <div class="prose prose-lg max-w-none">
                                                <p class="text-gray-700 leading-relaxed">
                                                      Program ini bertujuan untuk memperkuat gerakan infaq jamaah sebagai bentuk kepedulian sosial dan kemandirian umat. Dana yang terkumpul akan disalurkan secara transparan dan amanah untuk berbagai program kemanusiaan dan pemberdayaan masyarakat.
                                                </p>

                                                <div class="mt-6 sm:mt-8 grid grid-cols-1 sm:grid-cols-2 gap-4 sm:gap-6">
                                                      <div class="flex items-start gap-4 p-5 bg-emerald-50 rounded-xl">
                                                            <div class="w-10 h-10 bg-emerald-600 rounded-lg flex items-center justify-center flex-shrink-0">
                                                                  <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                                                                  </svg>
                                                            </div>
                                                            <div>
                                                                  <h4 class="font-semibold text-gray-900 mb-1">Transparan</h4>
                                                                  <p class="text-sm text-gray-600">Laporan keuangan dapat diakses publik</p>
                                                            </div>
                                                      </div>

                                                      <div class="flex items-start gap-4 p-5 bg-blue-50 rounded-xl">
                                                            <div class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center flex-shrink-0">
                                                                  <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                                                  </svg>
                                                            </div>
                                                            <div>
                                                                  <h4 class="font-semibold text-gray-900 mb-1">Amanah</h4>
                                                                  <p class="text-sm text-gray-600">Dikelola oleh tim profesional</p>
                                                            </div>
                                                      </div>
                                                </div>
                                          </div>
                                    </div>

                                    {{-- ================= KABAR TERBARU ================= --}}
                                    <div x-show="tab === 'kabar'" x-transition class="space-y-8">

                                          {{-- Timeline --}}
                                          <div class="relative pl-6 sm:pl-8 border-l-2 border-emerald-200">
                                                <div class="absolute -left-[9px] top-1 w-4 h-4 bg-emerald-600 rounded-full ring-4 ring-emerald-100"></div>
                                                <p class="text-sm text-gray-500 mb-1">December 8, 2024</p>
                                                <h3 class="font-semibold text-gray-900 text-lg">Campaign is published</h3>
                                                <p class="text-gray-600 mt-2">Program telah diluncurkan dan siap menerima donasi dari para dermawan.</p>
                                          </div>

                                          {{-- Prayer Section --}}
                                          <div>
                                                <h3 class="text-xl sm:text-2xl font-bold text-gray-900 mb-5 sm:mb-6 flex items-center gap-3">
                                                      <svg class="w-7 h-7 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                                                      </svg>
                                                      Doa-doa Orang Baik (10)
                                                </h3>

                                                <div class="space-y-4">

                                                      {{-- Doa Card --}}
                                                      <div class="group bg-gradient-to-br from-gray-50 to-white border border-gray-200 rounded-2xl p-6 hover:shadow-lg transition-all duration-300">
                                                            <div class="flex justify-between items-start mb-4">
                                                                  <div class="flex items-center gap-3">
                                                                        <div class="w-12 h-12 bg-gradient-to-br from-emerald-100 to-emerald-50 rounded-full flex items-center justify-center">
                                                                              <svg class="w-6 h-6 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                                                                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                                                              </svg>
                                                                        </div>
                                                                        <div>
                                                                              <h4 class="font-semibold text-gray-900">Hamba Allah</h4>
                                                                              <p class="text-sm text-gray-500">27 hari yang lalu</p>
                                                                        </div>
                                                                  </div>
                                                            </div>

                                                            <p class="text-gray-700 leading-relaxed mb-4">
                                                                  Semoga menjadi amal jariyah dan berkah untuk semua.
                                                            </p>

                                                            <div class="flex items-center gap-2 text-emerald-600 font-medium text-sm">
                                                                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                                                                  </svg>
                                                                  <span>1 Aamiin</span>
                                                            </div>
                                                      </div>

                                                      <div class="group bg-gradient-to-br from-gray-50 to-white border border-gray-200 rounded-2xl p-6 hover:shadow-lg transition-all duration-300">
                                                            <div class="flex justify-between items-start mb-4">
                                                                  <div class="flex items-center gap-3">
                                                                        <div class="w-12 h-12 bg-gradient-to-br from-blue-100 to-blue-50 rounded-full flex items-center justify-center">
                                                                              <svg class="w-6 h-6 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                                                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                                                              </svg>
                                                                        </div>
                                                                        <div>
                                                                              <h4 class="font-semibold text-gray-900">Andhon Kasiono</h4>
                                                                              <p class="text-sm text-gray-500">27 hari yang lalu</p>
                                                                        </div>
                                                                  </div>
                                                            </div>

                                                            <p class="text-gray-700 leading-relaxed mb-4">
                                                                  Semoga segera tertangani dengan baik dan diberi kesabaran.
                                                            </p>

                                                            <div class="flex items-center gap-2 text-emerald-600 font-medium text-sm">
                                                                  <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 10h4.764a2 2 0 011.789 2.894l-3.5 7A2 2 0 0115.263 21h-4.017c-.163 0-.326-.02-.485-.06L7 20m7-10V5a2 2 0 00-2-2h-.095c-.5 0-.905.405-.905.905 0 .714-.211 1.412-.608 2.006L7 11v9m7-10h-2M7 20H5a2 2 0 01-2-2v-6a2 2 0 012-2h2.5" />
                                                                  </svg>
                                                                  <span>4 Aamiin</span>
                                                            </div>
                                                      </div>

                                                </div>
                                          </div>

                                    </div>

                                    {{-- ================= DONATUR ================= --}}
                                    <div x-show="tab === 'donatur'" x-transition class="space-y-8">

                                          {{-- Filter --}}
                                          <div class="w-full sm:w-auto px-6 py-3 flex flex-col sm:flex-row gap-3">
                                                <button class="px-6 py-3 bg-emerald-600 text-white rounded-xl text-sm font-semibold shadow-lg hover:bg-emerald-700 transition-all">
                                                      Terbaru
                                                </button>
                                                <button class="px-6 py-3 border-2 border-emerald-600 text-emerald-600 rounded-xl text-sm font-semibold hover:bg-emerald-50 transition-all">
                                                      Terbesar
                                                </button>
                                          </div>

                                          {{-- Donatur List --}}
                                          <div class="space-y-4">

                                                <div class="group border-2 border-gray-100 rounded-2xl p-6 bg-gradient-to-br from-white to-gray-50 hover:shadow-lg hover:border-emerald-200 transition-all duration-300">
                                                      <div class="flex flex-col sm:flex-row sm:justify-between sm:items-center gap-4">
                                                            <div class="flex items-center gap-4">
                                                                  <div class="w-14 h-14 bg-gradient-to-br from-emerald-100 to-emerald-50 rounded-full flex items-center justify-center">
                                                                        <svg class="w-7 h-7 text-emerald-600" fill="currentColor" viewBox="0 0 20 20">
                                                                              <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd" />
                                                                        </svg>
                                                                  </div>
                                                                  <div>
                                                                        <h4 class="font-bold text-gray-900 text-lg">Hamba Allah</h4>
                                                                        <p class="text-gray-600 mt-1">
                                                                              Berdonasi sebesar <span class="font-bold text-emerald-600">Rp 100.000</span>
                                                                        </p>
                                                                  </div>
                                                            </div>
                                                            <span class="text-sm text-gray-500 font-medium sm:text-right">
                                                                  6 hari yang lalu
                                                            </span>
                                                      </div>
                                                </div>

                                                <div class="group border-2 border-gray-100 rounded-2xl p-6 bg-gradient-to-br from-white to-gray-50 hover:shadow-lg hover:border-emerald-200 transition-all duration-300">
                                                      <div class="flex justify-between items-center">
                                                            <div class="flex items-center gap-4">
                                                                  <div class="w-12 h-12 sm:w-14 sm:h-14 bg-gradient-to-br from-blue-100 to-blue-50 rounded-full flex items-center justify-center">
                                                                        <svg class="w-7 h-7 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                                                                              <path d="M13 6a3 3 0 11-6 0 3 3 0 016 0zM18 8a2 2 0 11-4 0 2 2 0 014 0zM14 15a4 4 0 00-8 0v3h8v-3zM6 8a2 2 0 11-4 0 2 2 0 014 0zM16 18v-3a5.972 5.972 0 00-.75-2.906A3.005 3.005 0 0119 15v3h-3zM4.75 12.094A5.973 5.973 0 004 15v3H1v-3a3 3 0 013.75-2.906z" />
                                                                        </svg>
                                                                  </div>
                                                                  <div>
                                                                        <h4 class="font-bold text-gray-900 text-lg">PC Fatayat NU Demak</h4>
                                                                        <p class="text-gray-600 mt-1">
                                                                              Berdonasi sebesar <span class="font-bold text-emerald-600">Rp 3.000.000</span>
                                                                        </p>
                                                                  </div>
                                                            </div>
                                                            <span class="text-sm text-gray-500 font-medium">
                                                                  24 hari yang lalu
                                                            </span>
                                                      </div>
                                                </div>

                                                <div class="group border-2 border-gray-100 rounded-2xl p-6 bg-gradient-to-br from-white to-gray-50 hover:shadow-lg hover:border-emerald-200 transition-all duration-300">
                                                      <div class="flex justify-between items-center">
                                                            <div class="flex items-center gap-4">
                                                                  <div class="w-14 h-14 bg-gradient-to-br from-purple-100 to-purple-50 rounded-full flex items-center justify-center">
                                                                        <svg class="w-7 h-7 text-purple-600" fill="currentColor" viewBox="0 0 20 20">
                                                                              <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z" />
                                                                        </svg>
                                                                  </div>
                                                                  <div>
                                                                        <h4 class="font-bold text-gray-900 text-lg">PRNU Langon Tahunan</h4>
                                                                        <p class="text-gray-600 mt-1">
                                                                              Berdonasi sebesar <span class="font-bold text-emerald-600">Rp 18.985.500</span>
                                                                        </p>
                                                                  </div>
                                                            </div>
                                                            <span class="text-sm text-gray-500 font-medium">
                                                                  25 hari yang lalu
                                                            </span>
                                                      </div>
                                                </div>

                                          </div>

                                          <div class="text-center pt-6">
                                                <button class="px-8 py-4 rounded-xl bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold transition-all shadow-sm hover:shadow-md">
                                                      Load more
                                                </button>
                                          </div>

                                    </div>

                              </div>

                        </div>

                  </div>

                  {{-- Right Column - Organization Card --}}
                  <div class="lg:col-span-1">
                        <div class="sticky top-8 space-y-6">

                              {{-- Organization Card --}}
                              <div class="bg-white rounded-3xl shadow-xl border border-gray-100 overflow-hidden">
                                    <div class="p-8">
                                          <div class="flex items-center gap-4 mb-6">
                                                <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-emerald-600 to-emerald-500 flex items-center justify-center text-white font-bold text-2xl shadow-lg">
                                                      NU
                                                </div>

                                                <div class="flex-1">
                                                      <h3 class="font-bold text-gray-900 text-lg mb-1">
                                                            LAZISNU Bojonegoro
                                                      </h3>
                                                      <p class="text-emerald-600 text-sm font-medium flex items-center gap-1">
                                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                                  <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                            </svg>
                                                            Verified Organization
                                                      </p>
                                                </div>
                                          </div>

                                          <div class="space-y-4 mb-6">
                                                <div class="flex items-center gap-3 text-gray-600">
                                                      <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                                      </svg>
                                                      <span class="text-sm">Bojonegoro, Jawa Timur</span>
                                                </div>

                                                <div class="flex items-center gap-3 text-gray-600">
                                                      <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                      </svg>
                                                      <span class="text-sm">Aktif sejak 2020</span>
                                                </div>
                                          </div>
                                          <a href="{{ route('profile') }}">
                                                <button class="w-full py-3 border-2 border-emerald-600 text-emerald-600 rounded-xl font-semibold hover:bg-emerald-50 transition-all">
                                                      Lihat Profil
                                                </button>
                                          </a>
                                    </div>
                              </div>

                              {{-- Trust Indicators --}}
                              <div class="bg-gradient-to-br from-emerald-50 to-emerald-100/50 rounded-3xl p-6 border border-emerald-200">
                                    <h4 class="font-bold text-gray-900 mb-4 flex items-center gap-2">
                                          <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                                          </svg>
                                          Jaminan Kami
                                    </h4>
                                    <div class="space-y-3 text-sm text-gray-700">
                                          <p class="flex items-start gap-2">
                                                <svg class="w-5 h-5 text-emerald-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                                      <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                </svg>
                                                Dana dikelola secara profesional dan amanah
                                          </p>
                                          <p class="flex items-start gap-2">
                                                <svg class="w-5 h-5 text-emerald-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                                      <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                </svg>
                                                Laporan transparansi berkala
                                          </p>
                                          <p class="flex items-start gap-2">
                                                <svg class="w-5 h-5 text-emerald-600 flex-shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 20 20">
                                                      <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                                                </svg>
                                                Penyaluran tepat sasaran
                                          </p>
                                    </div>
                              </div>

                        </div>
                  </div>

            </div>
      </div>
</section>

@endsection