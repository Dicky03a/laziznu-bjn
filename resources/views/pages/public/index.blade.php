@extends('layouts.public.app')
@section('title', 'Beranda - NU Care LAZIZNU Bojonegoro')

@section('content')

<!-- HERO SECTION -->
<section class="max-w-7xl mx-auto mt-10 px-6">
      <div class="relative rounded-3xl overflow-hidden bg-white shadow-lg">

            <!-- Background Image -->
            <img src="{{ asset('asset/hero.jpg') }}"
                  class="w-full h-[420px] object-cover"
                  alt="Hero">

            <!-- Green Overlay -->
            <div class="absolute inset-0 bg-gradient-to-r from-green-700/80 to-green-400/60"></div>

            <!-- Content -->
            <div class="absolute inset-0 flex items-center justify-between px-16">
                  <div class="text-white max-w-xl ml-auto">
                        <h1 class="text-4xl font-bold mb-4">
                              CSR Partner Anda
                        </h1>
                        <p class="text-lg leading-relaxed">
                              Bersama dalam gerakan kemandirian umat
                              dengan tujuan pembangunan berkelanjutan
                              program Kampung Nusantara
                        </p>
                  </div>
            </div>

            <!-- Arrow Navigation -->
            <div class="absolute bottom-6 right-6 flex gap-4">
                  <button class="w-12 h-12 rounded-full border border-white text-white flex items-center justify-center hover:bg-white hover:text-green-700 transition">
                        ❮
                  </button>
                  <button class="w-12 h-12 rounded-full border border-white text-white flex items-center justify-center hover:bg-white hover:text-green-700 transition">
                        ❯
                  </button>
            </div>

      </div>
</section>

<section class="max-w-7xl mx-auto py-24 px-6">

      <div class="bg-white rounded-3xl border-2 border-gray-200 p-12">

            <!-- Grid Menu -->
            <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-7 gap-10 text-center">

                  <!-- Item -->
                  <div class="group cursor-pointer">
                        <div class="w-20 h-20 mx-auto rounded-full 
                            bg-gradient-to-br from-green-500 to-green-700
                            flex items-center justify-center
                            shadow-md shadow-green-500/30
                            transition duration-300
                            group-hover:-translate-y-2 group-hover:shadow-xl">

                              <span class="text-2xl text-white">💰</span>
                        </div>
                        <p class="mt-4 text-sm font-semibold text-gray-700 
                          group-hover:text-green-700 transition">
                              Infaq Sedekah
                        </p>
                  </div>

                  <div class="group cursor-pointer">
                        <div class="w-20 h-20 mx-auto rounded-full 
                            bg-gradient-to-br from-green-500 to-green-700
                            flex items-center justify-center
                            shadow-md shadow-green-500/30
                            transition duration-300
                            group-hover:-translate-y-2 group-hover:shadow-xl">
                              <span class="text-2xl text-white">🕌</span>
                        </div>
                        <p class="mt-4 text-sm font-semibold text-gray-700 group-hover:text-green-700 transition">
                              Zakat
                        </p>
                  </div>

                  <div class="group cursor-pointer">
                        <div class="w-20 h-20 mx-auto rounded-full 
                            bg-gradient-to-br from-green-500 to-green-700
                            flex items-center justify-center
                            shadow-md shadow-green-500/30
                            transition duration-300
                            group-hover:-translate-y-2 group-hover:shadow-xl">
                              <span class="text-2xl text-white">🧮</span>
                        </div>
                        <p class="mt-4 text-sm font-semibold text-gray-700 group-hover:text-green-700 transition">
                              Kalkulator Zakat
                        </p>
                  </div>

                  <div class="group cursor-pointer">
                        <div class="w-20 h-20 mx-auto rounded-full 
                            bg-gradient-to-br from-green-500 to-green-700
                            flex items-center justify-center
                            shadow-md shadow-green-500/30
                            transition duration-300
                            group-hover:-translate-y-2 group-hover:shadow-xl">
                              <span class="text-2xl text-white">🏠</span>
                        </div>
                        <p class="mt-4 text-sm font-semibold text-gray-700 group-hover:text-green-700 transition">
                              Peduli Bencana
                        </p>
                  </div>

                  <div class="group cursor-pointer">
                        <div class="w-20 h-20 mx-auto rounded-full 
                            bg-gradient-to-br from-green-500 to-green-700
                            flex items-center justify-center
                            shadow-md shadow-green-500/30
                            transition duration-300
                            group-hover:-translate-y-2 group-hover:shadow-xl">
                              <span class="text-2xl text-white">🚑</span>
                        </div>
                        <p class="mt-4 text-sm font-semibold text-gray-700 group-hover:text-green-700 transition">
                              Mobil Sehat NU
                        </p>
                  </div>

                  <div class="group cursor-pointer">
                        <div class="w-20 h-20 mx-auto rounded-full 
                            bg-gradient-to-br from-green-500 to-green-700
                            flex items-center justify-center
                            shadow-md shadow-green-500/30
                            transition duration-300
                            group-hover:-translate-y-2 group-hover:shadow-xl">
                              <span class="text-2xl text-white">🌙</span>
                        </div>
                        <p class="mt-4 text-sm font-semibold text-gray-700 group-hover:text-green-700 transition">
                              Ramadhan
                        </p>
                  </div>

                  <div class="group cursor-pointer">
                        <div class="w-20 h-20 mx-auto rounded-full 
                            bg-gradient-to-br from-green-500 to-green-700
                            flex items-center justify-center
                            shadow-md shadow-green-500/30
                            transition duration-300
                            group-hover:-translate-y-2 group-hover:shadow-xl">
                              <span class="text-2xl text-white">🐄</span>
                        </div>
                        <p class="mt-4 text-sm font-semibold text-gray-700 group-hover:text-green-700 transition">
                              Qurban
                        </p>
                  </div>

            </div>

      </div>

</section>

<!-- HERO SECTION -->


<!-- Infaq Section -->
<section class="w-full bg-gray-50 py-24">

      <!-- Heading -->
      <div class="text-center max-w-3xl mx-auto px-6">
            <h2 class="text-4xl font-bold bg-gradient-to-r from-green-700 to-green-500 bg-clip-text text-transparent">
                  AYO BERINFAQ DI LAZISNU
            </h2>

            <p class="mt-4 text-gray-600 leading-relaxed">
                  Tunaikan zakat, infaq, dan shadaqah melalui LAZISNU dengan berbagai
                  program kemanfaatan untuk ummat.
            </p>
      </div>


      <!-- Cards -->
      <div class="max-w-7xl mx-auto mt-16 px-6">
            <div class="grid md:grid-cols-3 gap-10">

                  <!-- CARD 1 -->
                  <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition duration-300 overflow-hidden group">

                        <div class="relative">
                              <img src="{{ asset('asset/program1.jpg') }}"
                                    class="w-full h-56 object-cover group-hover:scale-105 transition duration-500"
                                    alt="">
                        </div>

                        <div class="p-6">
                              <h3 class="font-semibold text-lg">
                                    Wujudkan Santripreneur Terampil Berwirausaha
                              </h3>

                              <p class="text-sm text-gray-500 mt-2">
                                    LAZISNU JEPARA
                              </p>

                              <!-- Progress -->
                              <div class="mt-4">
                                    <div class="flex justify-between text-sm text-gray-600 mb-1">
                                          <span>Rp 0</span>
                                          <span>Target Rp 10.000.000</span>
                                    </div>

                                    <div class="w-full bg-gray-200 h-2 rounded-full">
                                          <div class="bg-green-600 h-2 rounded-full w-[10%]"></div>
                                    </div>
                              </div>

                              <button class="w-full mt-6 bg-green-400 hover:bg-green-700 text-white py-3 rounded-lg transition">
                                    Salurkan Niat Baik
                              </button>
                        </div>
                  </div>


                  <!-- CARD 2 -->
                  <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition duration-300 overflow-hidden group">

                        <div class="relative">
                              <img src="{{ asset('asset/program2.jpg') }}"
                                    class="w-full h-56 object-cover group-hover:scale-105 transition duration-500"
                                    alt="">
                        </div>

                        <div class="p-6">
                              <h3 class="font-semibold text-lg">
                                    Bantu Guru Membangun Masa Depan Pendidikan
                              </h3>

                              <p class="text-sm text-gray-500 mt-2">
                                    LAZISNU JEPARA
                              </p>

                              <div class="mt-4">
                                    <div class="flex justify-between text-sm text-gray-600 mb-1">
                                          <span>Rp 150.000</span>
                                          <span>Target Rp 5.000.000</span>
                                    </div>

                                    <div class="w-full bg-gray-200 h-2 rounded-full">
                                          <div class="bg-green-600 h-2 rounded-full w-[30%]"></div>
                                    </div>
                              </div>

                              <button class="w-full mt-6 bg-green-400 hover:bg-green-700 text-white py-3 rounded-lg transition">
                                    Salurkan Niat Baik
                              </button>
                        </div>
                  </div>


                  <!-- CARD 3 -->
                  <div class="bg-white rounded-2xl shadow-md hover:shadow-xl transition duration-300 overflow-hidden group">

                        <div class="relative">
                              <img src="{{ asset('asset/program3.jpg') }}"
                                    class="w-full h-56 object-cover group-hover:scale-105 transition duration-500"
                                    alt="">
                        </div>

                        <div class="p-6">
                              <h3 class="font-semibold text-lg">
                                    Beasiswa Santri dan Siswa Nusantara
                              </h3>

                              <p class="text-sm text-gray-500 mt-2">
                                    LAZISNU JEPARA
                              </p>

                              <div class="mt-4">
                                    <div class="flex justify-between text-sm text-gray-600 mb-1">
                                          <span>Rp 0</span>
                                          <span>Target Rp 8.000.000</span>
                                    </div>

                                    <div class="w-full bg-gray-200 h-2 rounded-full">
                                          <div class="bg-green-600 h-2 rounded-full w-[5%]"></div>
                                    </div>
                              </div>

                              <button class="w-full mt-6 bg-green-400 hover:bg-green-700 text-white py-3 rounded-lg transition">
                                    Salurkan Niat Baik
                              </button>
                        </div>
                  </div>

            </div>
      </div>


      <!-- Button Lihat Semua -->
      <div class="text-center mt-16">
            <button class="bg-green-400 hover:bg-green-700 text-white px-8 py-3 rounded-xl shadow-md transition">
                  Lihat Semua Program
            </button>
      </div>

</section>
<!-- Infaq Section -->

<!-- Pres Release -->
<section class="w-full bg-gray-50 py-24">

      <!-- Heading -->
      <div class="text-center max-w-3xl mx-auto px-6">
            <h2 class="text-3xl md:text-4xl font-bold tracking-wide
                   bg-gradient-to-r from-green-700 to-green-500 
                   bg-clip-text text-transparent">
                  PRESS RELEASE
            </h2>

            <div class="w-24 h-1 bg-green-600 mx-auto mt-4 rounded-full"></div>
      </div>


      <!-- Cards -->
      <div class="max-w-7xl mx-auto mt-16 px-6 md:px-16">
            <div class="grid md:grid-cols-3 gap-10">

                  <!-- CARD 1 -->
                  <div class="group bg-white rounded-2xl shadow-md hover:shadow-xl 
                        transition duration-500 overflow-hidden">

                        <div class="overflow-hidden">
                              <img src="{{ asset('asset/press1.jpg') }}"
                                    class="w-full h-60 object-cover 
                               group-hover:scale-105 transition duration-700"
                                    alt="">
                        </div>

                        <div class="p-6">
                              <h3 class="text-lg font-semibold text-green-700 
                               group-hover:text-green-600 transition">
                                    Ribuan Relawan NU Berkumpul di Batang, PCNU Jepara
                              </h3>

                              <p class="text-gray-600 text-sm mt-3 leading-relaxed">
                                    Ribuan relawan Nahdlatul Ulama dari berbagai daerah
                                    di Jawa Tengah berkumpul dalam aksi sosial...
                              </p>

                              <div class="flex items-center gap-2 mt-4 text-sm text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                          class="w-4 h-4" fill="none"
                                          viewBox="0 0 24 24" stroke="currentColor">
                                          <path stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10m-11 9h12a2 2 0 002-2V7a2 2 0 00-2-2H6a2 2 0 00-2 2v11a2 2 0 002 2z" />
                                    </svg>
                                    01/02/2026
                              </div>
                        </div>
                  </div>


                  <!-- CARD 2 -->
                  <div class="group bg-white rounded-2xl shadow-md hover:shadow-xl 
                        transition duration-500 overflow-hidden">

                        <div class="overflow-hidden">
                              <img src="{{ asset('asset/press2.jpg') }}"
                                    class="w-full h-60 object-cover 
                               group-hover:scale-105 transition duration-700"
                                    alt="">
                        </div>

                        <div class="p-6">
                              <h3 class="text-lg font-semibold text-green-700 
                               group-hover:text-green-600 transition">
                                    NU Peduli Jepara Sambangi Warga Terdampak Cuaca Ekstrim
                              </h3>

                              <p class="text-gray-600 text-sm mt-3 leading-relaxed">
                                    NU Peduli dan LAZISNU PCNU Jepara menyalurkan bantuan
                                    kebencanaan kepada warga terdampak...
                              </p>

                              <div class="flex items-center gap-2 mt-4 text-sm text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                          class="w-4 h-4" fill="none"
                                          viewBox="0 0 24 24" stroke="currentColor">
                                          <path stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10m-11 9h12a2 2 0 002-2V7a2 2 0 00-2-2H6a2 2 0 00-2 2v11a2 2 0 002 2z" />
                                    </svg>
                                    31/01/2026
                              </div>
                        </div>
                  </div>


                  <!-- CARD 3 -->
                  <div class="group bg-white rounded-2xl shadow-md hover:shadow-xl 
                        transition duration-500 overflow-hidden">

                        <div class="overflow-hidden">
                              <img src="{{ asset('asset/press3.jpg') }}"
                                    class="w-full h-60 object-cover 
                               group-hover:scale-105 transition duration-700"
                                    alt="">
                        </div>

                        <div class="p-6">
                              <h3 class="text-lg font-semibold text-green-700 
                               group-hover:text-green-600 transition">
                                    Peduli Bencana, PCNU Jepara Salurkan Bantuan ke Tiga
                              </h3>

                              <p class="text-gray-600 text-sm mt-3 leading-relaxed">
                                    PCNU Jepara melalui NU Peduli Bencana menyalurkan
                                    bantuan sembako, pendidikan, dan santunan...
                              </p>

                              <div class="flex items-center gap-2 mt-4 text-sm text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg"
                                          class="w-4 h-4" fill="none"
                                          viewBox="0 0 24 24" stroke="currentColor">
                                          <path stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10m-11 9h12a2 2 0 002-2V7a2 2 0 00-2-2H6a2 2 0 00-2 2v11a2 2 0 002 2z" />
                                    </svg>
                                    29/01/2026
                              </div>
                        </div>
                  </div>

            </div>
      </div>


      <!-- Button -->
      <div class="text-center mt-16">
            <button class="bg-green-400 hover:bg-green-700 
                       text-white px-8 py-3 rounded-xl 
                       shadow-md hover:shadow-lg 
                       transition duration-300">
                  Lebih Banyak
            </button>
      </div>

</section>
<!-- Pres Release -->

<!-- 5 Pilar -->
<section class="w-full bg-green-400 py-24">

      <!-- Heading -->
      <div class="text-center mb-16 px-6">
            <h2 class="text-3xl md:text-4xl font-bold tracking-wide">
                  <span class="text-yellow-400">5 PILAR</span>
                  <span class="text-white">PROGRAM</span>
            </h2>
      </div>


      <!-- Content -->
      <div class="max-w-7xl mx-auto px-6 md:px-12">

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-5 gap-12 text-center">

                  <!-- ITEM -->
                  <div class="group">
                        <div class="w-28 h-28 mx-auto rounded-full 
                            bg-green-700/50 backdrop-blur 
                            flex items-center justify-center 
                            mb-6 transition duration-300 
                            group-hover:scale-110">

                              <!-- ICON -->
                              <svg class="w-12 h-12 text-white opacity-90" fill="none" stroke="currentColor" stroke-width="1.8"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M12 14l9-5-9-5-9 5 9 5z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M12 14l6.16-3.422M12 14v7m0-7L5.84 10.578" />
                              </svg>
                        </div>

                        <h3 class="text-lg font-semibold text-white">
                              NUCARE <span class="text-yellow-400">CERDAS</span>
                        </h3>

                        <p class="text-green-100 text-sm mt-4 leading-relaxed">
                              Membantu memberikan akses pendidikan berkualitas yang merata serta membuka kesempatan belajar bagi semua orang khususnya bagi siswa yatim-dhuafa dan berprestasi.
                        </p>
                  </div>


                  <!-- ITEM -->
                  <div class="group">
                        <div class="w-28 h-28 mx-auto rounded-full 
                            bg-green-700/50 backdrop-blur 
                            flex items-center justify-center 
                            mb-6 transition duration-300 
                            group-hover:scale-110">

                              <svg class="w-12 h-12 text-white opacity-90" fill="none" stroke="currentColor" stroke-width="1.8"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M3 10h18M7 10V6a5 5 0 0110 0v4" />
                              </svg>
                        </div>

                        <h3 class="text-lg font-semibold text-white">
                              NUCARE <span class="text-yellow-400">BERDAYA</span>
                        </h3>

                        <p class="text-green-100 text-sm mt-4 leading-relaxed">
                              Mendorong kemandirian dan meningkatkan pendapatan, kesejahteraan serta semangat kewirausahaan melalui kegiatan ekonomi dan pembentukan usaha.
                        </p>
                  </div>


                  <!-- ITEM -->
                  <div class="group">
                        <div class="w-28 h-28 mx-auto rounded-full 
                            bg-green-700/50 backdrop-blur 
                            flex items-center justify-center 
                            mb-6 transition duration-300 
                            group-hover:scale-110">

                              <svg class="w-12 h-12 text-white opacity-90" fill="none" stroke="currentColor" stroke-width="1.8"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M12 21c-4.97-4.97-8-8-8-11a4 4 0 018 0 4 4 0 018 0c0 3-3.03 6.03-8 11z" />
                              </svg>
                        </div>

                        <h3 class="text-lg font-semibold text-white">
                              NUCARE <span class="text-yellow-400">SEHAT</span>
                        </h3>

                        <p class="text-green-100 text-sm mt-4 leading-relaxed">
                              Bertujuan meningkatkan layanan di bidang kesehatan masyarakat, khususnya keluarga kurang mampu melalui tindakan kuratif maupun preventif.
                        </p>
                  </div>


                  <!-- ITEM -->
                  <div class="group">
                        <div class="w-28 h-28 mx-auto rounded-full 
                            bg-green-700/50 backdrop-blur 
                            flex items-center justify-center 
                            mb-6 transition duration-300 
                            group-hover:scale-110">

                              <svg class="w-12 h-12 text-white opacity-90" fill="none" stroke="currentColor" stroke-width="1.8"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M12 8c-1.5-2-4-2-5 0-1.5 2 0 5 5 9 5-4 6.5-7 5-9-1-2-3.5-2-5 0z" />
                              </svg>
                        </div>

                        <h3 class="text-lg font-semibold text-white">
                              NUCARE <span class="text-yellow-400">DAMAI</span>
                        </h3>

                        <p class="text-green-100 text-sm mt-4 leading-relaxed">
                              Meningkatkan layanan sosial dengan semangat dakwah Islam Ahlussunnah wal Jama’ah melalui bantuan kebencanaan dan aksi sosial.
                        </p>
                  </div>


                  <!-- ITEM -->
                  <div class="group">
                        <div class="w-28 h-28 mx-auto rounded-full 
                            bg-green-700/50 backdrop-blur 
                            flex items-center justify-center 
                            mb-6 transition duration-300 
                            group-hover:scale-110">

                              <svg class="w-12 h-12 text-white opacity-90" fill="none" stroke="currentColor" stroke-width="1.8"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          d="M9 19V6l12-2v13" />
                              </svg>
                        </div>

                        <h3 class="text-lg font-semibold text-white">
                              NUCARE <span class="text-yellow-400">HIJAU</span>
                        </h3>

                        <p class="text-green-100 text-sm mt-4 leading-relaxed">
                              Program untuk memelihara lingkungan dan sumber daya alam serta mendorong keberlanjutan sebagai sumber penghidupan masyarakat.
                        </p>
                  </div>

            </div>

      </div>

</section>
<!-- 5 Pilar -->




@endsection