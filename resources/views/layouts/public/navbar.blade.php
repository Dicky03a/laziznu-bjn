<nav class="bg-white backdrop-blur-md border-b border-gray-100 sticky top-0 z-50 transition-all duration-300">
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-20">

                  <!-- Logo -->
                  <div class="flex items-center space-x-3">
                        <img
                              src="{{ asset('asset/laziznulogo.svg') }}"
                              alt="Laziznu Bojonegoro"
                              class="h-10 sm:h-16 md:h-16 lg:h-20 w-auto object-contain" />
                  </div>

                  <!-- Desktop Menu -->
                  <div class="hidden lg:flex lg:items-center lg:space-x-10">

                        <!-- Menu Item -->
                        <a href="{{ route('home') }}"
                              class="relative text-gray-700 text-sm font-medium transition-colors duration-300 hover:text-green-600 after:absolute after:left-0 after:-bottom-1 after:h-0.5 after:w-0 after:bg-green-600 after:transition-all after:duration-300 hover:after:w-full">
                              Beranda
                        </a>

                        <!-- Profile -->
                        <div class="relative group">
                              <button class="relative text-gray-700 text-sm font-medium flex items-center gap-1 transition-colors duration-300 hover:text-green-600">
                                    Profile
                                    <svg class="h-4 w-4 transition-transform duration-300 group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                              </button>

                              <div class="absolute left-0 mt-4 w-60 bg-white rounded-2xl shadow-xl
                                opacity-0 invisible translate-y-3
                                group-hover:opacity-100 group-hover:visible group-hover:translate-y-0
                                transition-all duration-300 ease-out p-2">

                                    <a href="{{ route('profile') }}"
                                          class="block px-4 py-3 rounded-xl text-sm text-gray-600
                           hover:bg-green-50 hover:text-green-600 hover:translate-x-1
                           transition-all duration-200">
                                          Sekilas NU Care Laziznu
                                    </a>

                                    <a href="{{ route('pengurus-laziznu-bojonegoro') }}"
                                          class="block px-4 py-3 rounded-xl text-sm text-gray-600
                           hover:bg-green-50 hover:text-green-600 hover:translate-x-1
                           transition-all duration-200">
                                          Pengurus Laziznu PCNU Bojonegoro
                                    </a>

                                    <a href="{{ route('rekening-lengkap') }}"
                                          class="block px-4 py-3 rounded-xl text-sm text-gray-600
                           hover:bg-green-50 hover:text-green-600 hover:translate-x-1
                           transition-all duration-200">
                                          Rekening Lengkap
                                    </a>

                                    <a href="{{ route('dokumen') }}"
                                          class="block px-4 py-3 rounded-xl text-sm text-gray-600
                           hover:bg-green-50 hover:text-green-600 hover:translate-x-1
                           transition-all duration-200">
                                          Unduh Dokumen
                                    </a>

                                    <a href="{{ route('press-release') }}"
                                          class="block px-4 py-3 rounded-xl text-sm text-gray-600
                           hover:bg-green-50 hover:text-green-600 hover:translate-x-1
                           transition-all duration-200">
                                          Press Release
                                    </a>
                              </div>
                        </div>

                        <!-- Program -->
                        <a href="{{ route('program') }}"
                              class="relative text-gray-700 text-sm font-medium transition-colors duration-300 hover:text-green-600 after:absolute after:left-0 after:-bottom-1 after:h-0.5 after:w-0 after:bg-green-600 after:transition-all after:duration-300 hover:after:w-full">
                              Program
                        </a>

                        <!-- Layanan -->
                        <div class="relative group">
                              <button class="relative text-gray-700 text-sm font-medium flex items-center gap-1 transition-colors duration-300 hover:text-green-600">
                                    Layanan
                                    <svg class="h-4 w-4 transition-transform duration-300 group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                              </button>

                              <div class="absolute left-0 mt-4 w-60 bg-white rounded-2xl shadow-xl
                                opacity-0 invisible translate-y-3
                                group-hover:opacity-100 group-hover:visible group-hover:translate-y-0
                                transition-all duration-300 ease-out p-2">

                                    <a href="{{ route('zakat.index') }}"
                                          class="block px-4 py-3 rounded-xl text-sm text-gray-600
                           hover:bg-green-50 hover:text-green-600 hover:translate-x-1
                           transition-all duration-200">
                                          Zakat
                                    </a>

                                    <a href="{{ route('infaq.index') }}"
                                          class="block px-4 py-3 rounded-xl text-sm text-gray-600
                           hover:bg-green-50 hover:text-green-600 hover:translate-x-1
                           transition-all duration-200">
                                          Infaq & Sedekah
                                    </a>

                                    <a href="{{ route('donasi.index') }}"
                                          class="block px-4 py-3 rounded-xl text-sm text-gray-600
                           hover:bg-green-50 hover:text-green-600 hover:translate-x-1
                           transition-all duration-200">
                                          Program Sosial
                                    </a>
                              </div>
                        </div>

                        <!-- Laporan -->
                        <div class="relative group">
                              <button class="relative text-gray-700 text-sm font-medium flex items-center gap-1 transition-colors duration-300 hover:text-green-600">
                                    Laporan
                                    <svg class="h-4 w-4 transition-transform duration-300 group-hover:rotate-180" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                              </button>

                              <div class="absolute left-0 mt-4 w-60 bg-white rounded-2xl shadow-xl
                                opacity-0 invisible translate-y-3
                                group-hover:opacity-100 group-hover:visible group-hover:translate-y-0
                                transition-all duration-300 ease-out p-2">

                                    <a href="{{ route('laporan-bulanan') }}"
                                          class="block px-4 py-3 rounded-xl text-sm text-gray-600
                           hover:bg-green-50 hover:text-green-600 hover:translate-x-1
                           transition-all duration-200">
                                          Laporan Bulanan
                                    </a>

                                    <a href="{{ route('status-mwc-ranting') }}"
                                          class="block px-4 py-3 rounded-xl text-sm text-gray-600
                           hover:bg-green-50 hover:text-green-600 hover:translate-x-1
                           transition-all duration-200">
                                          Status Laporan MWC & Ranting
                                    </a>

                                    <a href="{{ route('laporan-tahunan') }}"
                                          class="block px-4 py-3 rounded-xl text-sm text-gray-600
                           hover:bg-green-50 hover:text-green-600 hover:translate-x-1
                           transition-all duration-200">
                                          Formulir Laporan Tahunan
                                    </a>
                              </div>
                        </div>
                  </div>

                  <!-- CTA Button -->
                  <div class="hidden lg:block">
                        <a href="{{ route('kalkulator-zakat') }}"
                              class="bg-gradient-to-br from-emerald-600 to-emerald-700 text-white px-6 py-2.5 rounded-xl text-sm font-semibold
                   shadow-md hover:shadow-xl
                   hover:bg-emerald-500 hover:-translate-y-0.5
                   transition-all duration-300">
                              Kalkulator Zakat
                        </a>
                  </div>

                  <!-- Mobile Button -->
                  <div class="lg:hidden">
                        <button id="mobile-menu-button" class="text-gray-700 hover:text-green-600 transition">
                              <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path id="menu-icon" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M4 6h16M4 12h16M4 18h16"></path>
                                    <path id="close-icon" class="hidden" stroke-linecap="round" stroke-linejoin="round"
                                          stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                              </svg>
                        </button>
                  </div>
            </div>
      </div>

      <!-- Mobile Menu -->
      <!-- Mobile Menu -->
      <div id="mobile-menu"
            class="hidden lg:hidden bg-white border-t border-gray-100 shadow-lg">

            <div class="px-6 py-6 space-y-2 text-base">

                  <!-- Beranda -->
                  <a href="{{ route('home') }}"
                        class="block px-4 py-3 rounded-xl text-gray-700
                  hover:bg-green-50 hover:text-green-600
                  transition-all duration-200">
                        Beranda
                  </a>

                  <!-- Profile Dropdown -->
                  <div>
                        <button class="mobile-dropdown flex justify-between items-center w-full px-4 py-3 rounded-xl text-gray-700 hover:bg-green-50 hover:text-green-600 transition-all duration-200">
                              Profile
                              <svg class="mobile-icon h-4 w-4 transition-transform duration-300"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          stroke-width="2"
                                          d="M19 9l-7 7-7-7" />
                              </svg>
                        </button>

                        <div class="mobile-content hidden pl-4 mt-1 space-y-1">
                              <a href="{{ route('profile') }}" class="block px-4 py-2 rounded-lg text-gray-600 hover:text-green-600 hover:bg-green-50 transition">Sekilas NU Care</a>
                              <a href="{{ route('pengurus-laziznu-bojonegoro') }}" class="block px-4 py-2 rounded-lg text-gray-600 hover:text-green-600 hover:bg-green-50 transition">Pengurus Laziznu</a>
                              <a href="{{ route('rekening-lengkap') }}" class="block px-4 py-2 rounded-lg text-gray-600 hover:text-green-600 hover:bg-green-50 transition">Rekening Lengkap</a>
                              <a href="{{ route('dokumen') }}" class="block px-4 py-2 rounded-lg text-gray-600 hover:text-green-600 hover:bg-green-50 transition">Unduh Dokumen</a>
                              <a href="{{ route('press-release') }}" class="block px-4 py-2 rounded-lg text-gray-600 hover:text-green-600 hover:bg-green-50 transition">Press Release</a>
                        </div>
                  </div>

                  <!-- Program -->
                  <a href="{{ route('program') }}"
                        class="block px-4 py-3 rounded-xl text-gray-700
                  hover:bg-green-50 hover:text-green-600
                  transition-all duration-200">
                        Program
                  </a>

                  <!-- Layanan Dropdown -->
                  <div>
                        <button class="mobile-dropdown flex justify-between items-center w-full px-4 py-3 rounded-xl text-gray-700 hover:bg-green-50 hover:text-green-600 transition-all duration-200">
                              Layanan
                              <svg class="mobile-icon h-4 w-4 transition-transform duration-300"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          stroke-width="2"
                                          d="M19 9l-7 7-7-7" />
                              </svg>
                        </button>

                        <div class="mobile-content hidden pl-4 mt-1 space-y-1">
                              <a href="{{ route('zakat.index') }}" class="block px-4 py-2 rounded-lg text-gray-600 hover:text-green-600 hover:bg-green-50 transition">Zakat</a>
                              <a href="{{ route('infaq.index') }}" class="block px-4 py-2 rounded-lg text-gray-600 hover:text-green-600 hover:bg-green-50 transition">Infaq & Sedekah</a>
                              <a href="{{ route('donasi.index') }}" class="block px-4 py-2 rounded-lg text-gray-600 hover:text-green-600 hover:bg-green-50 transition">Program Sosial</a>
                        </div>
                  </div>

                  <!-- Laporan Dropdown -->
                  <div>
                        <button class="mobile-dropdown flex justify-between items-center w-full px-4 py-3 rounded-xl text-gray-700 hover:bg-green-50 hover:text-green-600 transition-all duration-200">
                              Laporan
                              <svg class="mobile-icon h-4 w-4 transition-transform duration-300"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                          stroke-width="2"
                                          d="M19 9l-7 7-7-7" />
                              </svg>
                        </button>

                        <div class="mobile-content hidden pl-4 mt-1 space-y-1">
                              <a href="{{ route('laporan-tahunan') }}" class="block px-4 py-2 rounded-lg text-gray-600 hover:text-green-600 hover:bg-green-50 transition">Formulir Laporan</a>
                              <a href="{{ route('laporan-bulanan') }}" class="block px-4 py-2 rounded-lg text-gray-600 hover:text-green-600 hover:bg-green-50 transition">Laporan Bulanan</a>
                              <a href="{{ route('status-mwc-ranting') }}" class="block px-4 py-2 rounded-lg text-gray-600 hover:text-green-600 hover:bg-green-50 transition">Status MWC & Ranting</a>
                        </div>
                  </div>

                  <!-- CTA -->
                  <a href="{{ route('kalkulator-zakat') }}"
                        class="block w-full mt-5 bg-gradient-to-br from-emerald-600 to-emerald-700 text-white text-center px-6 py-3 rounded-xl
                  font-semibold hover:bg-emerald-700 transition duration-300 shadow-md">
                        Kalkulator Zakat
                  </a>

            </div>
      </div>

</nav>

<script>
      document.addEventListener("DOMContentLoaded", function() {

            const mobileMenuButton = document.getElementById('mobile-menu-button');
            const mobileMenu = document.getElementById('mobile-menu');
            const menuIcon = document.getElementById('menu-icon');
            const closeIcon = document.getElementById('close-icon');

            mobileMenuButton.addEventListener('click', () => {
                  mobileMenu.classList.toggle('hidden');
                  menuIcon.classList.toggle('hidden');
                  closeIcon.classList.toggle('hidden');
            });

            // Dropdown Mobile
            const dropdownButtons = document.querySelectorAll('.mobile-dropdown');

            dropdownButtons.forEach(button => {
                  button.addEventListener('click', () => {

                        const content = button.nextElementSibling;
                        const icon = button.querySelector('.mobile-icon');

                        content.classList.toggle('hidden');
                        icon.classList.toggle('rotate-180');
                  });
            });
      });
</script>