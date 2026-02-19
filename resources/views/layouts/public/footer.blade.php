<footer class="bg-white text-black">
      <!-- Main Footer -->
      <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8 lg:gap-12">

                  <!-- Tentang Kami -->
                  <div class="space-y-4">
                        <div class="flex items-center space-x-3 mb-4">
                              <img class="h-12 w-auto" src="{{ asset('asset/laziznulogo.svg') }}" alt="Laziznu" onerror="this.style.display='none'">
                              <div class="flex flex-col">
                                    <span class="text-2xl font-bold text-green-600">LAZIZNU</span>
                                    <span class="text-xs text-gray-400">Bojonegoro</span>
                              </div>
                        </div>
                        <p class="text-sm text-black leading-relaxed">
                              Lembaga Amil Zakat, Infaq dan Shadaqah Nahdlatul Ulama Bojonegoro. Menyalurkan amanah umat untuk kemaslahatan bersama.
                        </p>
                  </div>

                  <!-- Link Cepat -->
                  <div>
                        <h3 class="text-white text-lg font-semibold mb-4 border-b border-gray-700 pb-2">Link Cepat</h3>
                        <ul class="space-y-3">
                              <li>
                                    <a href="{{ route('home') }}" class="text-sm hover:text-green-400 transition duration-300 flex items-center group">
                                          <span class="mr-2 text-green-500 group-hover:translate-x-1 transition-transform duration-300">›</span>
                                          Beranda
                                    </a>
                              </li>
                              <li>
                                    <a href="{{ route('profile') }}" class="text-sm hover:text-green-400 transition duration-300 flex items-center group">
                                          <span class="mr-2 text-green-500 group-hover:translate-x-1 transition-transform duration-300">›</span>
                                          Tentang Kami
                                    </a>
                              </li>
                              <li>
                                    <a href="{{ route('donasi.index') }}" class="text-sm hover:text-green-400 transition duration-300 flex items-center group">
                                          <span class="mr-2 text-green-500 group-hover:translate-x-1 transition-transform duration-300">›</span>
                                          Donasi
                                    </a>
                              </li>
                              <li>
                                    <a href="{{ route('berita.public.index') }}" class="text-sm hover:text-green-400 transition duration-300 flex items-center group">
                                          <span class="mr-2 text-green-500 group-hover:translate-x-1 transition-transform duration-300">›</span>
                                          Berita
                                    </a>
                              </li>
                              <li>
                                    <a href="{{ route('program') }}" class="text-sm hover:text-green-400 transition duration-300 flex items-center group">
                                          <span class="mr-2 text-green-500 group-hover:translate-x-1 transition-transform duration-300">›</span>
                                          Program
                                    </a>
                              </li>
                        </ul>
                  </div>

                  <!-- Program -->
                  <div>
                        <h3 class="text-white text-lg font-semibold mb-4 border-b border-gray-700 pb-2">Program Kami</h3>
                        <ul class="space-y-3">
                              <li>
                                    <a href="{{ route('zakat.index') }}" class="text-sm hover:text-green-400 transition duration-300 flex items-center group">
                                          <span class="mr-2 text-green-500 group-hover:translate-x-1 transition-transform duration-300">›</span>
                                          Zakat
                                    </a>
                              </li>
                              <li>
                                    <a href="{{ route('infaq.index') }}" class="text-sm hover:text-green-400 transition duration-300 flex items-center group">
                                          <span class="mr-2 text-green-500 group-hover:translate-x-1 transition-transform duration-300">›</span>
                                          Infaq & Sedekah
                                    </a>
                              </li>
                              <li>
                                    <a href="{{ route('donasi.index') }}" class="text-sm hover:text-green-400 transition duration-300 flex items-center group">
                                          <span class="mr-2 text-green-500 group-hover:translate-x-1 transition-transform duration-300">›</span>
                                          Program Sosial
                                    </a>
                              </li>
                        </ul>
                  </div>

                  <!-- Kontak -->
                  <div>
                        <h3 class="text-white text-lg font-semibold mb-4 border-b border-gray-700 pb-2">Hubungi Kami</h3>
                        <ul class="space-y-4">
                              <li class="flex items-start space-x-3">
                                    <svg class="h-5 w-5 text-green-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    <span class="text-sm">Jl. Ahmad Yani No. 12, Sukorejo, Bojonegoro, Jawa Timur</span>
                              </li>
                              <li class="flex items-start space-x-3">
                                    <svg class="h-5 w-5 text-green-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                    </svg>
                                    <div class="text-sm">
                                          <a href="https://wa.me/6285743229703?text=Assalamu%E2%80%99alaikum,%20saya%20ingin%20menghubungi%20admin%20zakat,%20sedekah,%20dan%20donasi."
                                                target="_blank"
                                                rel="noopener">
                                                <p>085743229703 (Admin)</p>
                                          </a>
                                    </div>
                              </li>
                              <li class="flex items-start space-x-3">
                                    <svg class="h-5 w-5 text-green-500 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                    <span class="text-sm">nucarelazisnu.bjn@gmail.com
                                    </span>
                              </li>
                        </ul>
                  </div>
            </div>
      </div>

      <!-- Bottom Footer -->
      <div class="border-t border-gray-700">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                  <div class="flex flex-col md:flex-row justify-between items-center space-y-4 md:space-y-0">
                        <div class="text-sm text-gray-400 text-center md:text-left">
                              &copy; {{ date('Y') }} LAZIZNU Bojonegoro. All rights reserved.
                        </div>
                        <div class="flex flex-wrap justify-center md:justify-end items-center gap-4 text-sm text-gray-400">
                              <a href="{{ route('kebijakan-privasi') }}" class="hover:text-green-400 transition duration-300">Privacy Policy</a>
                              <span class="text-gray-600">|</span>
                              <a href="{{ route('terms-conditions') }}" class="hover:text-green-400 transition duration-300">Terms & Conditions</a>
                              <span class="text-gray-600">|</span>
                              <a href="{{ route('disclaimer') }}" class="hover:text-green-400 transition duration-300">Disclaimer</a>
                        </div>
                  </div>
            </div>
      </div>

      <!-- Scroll to Top Button -->
      <button id="scroll-to-top" class="fixed bottom-8 right-8 bg-green-600 hover:bg-green-700 text-white p-3 rounded-full shadow-lg opacity-0 invisible transition-all duration-300 transform hover:scale-110 z-50">
            <svg class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path>
            </svg>
      </button>
</footer>

<script>
      // Scroll to Top Button Functionality
      const scrollToTopButton = document.getElementById('scroll-to-top');

      window.addEventListener('scroll', () => {
            if (window.pageYOffset > 300) {
                  scrollToTopButton.classList.remove('opacity-0', 'invisible');
                  scrollToTopButton.classList.add('opacity-100', 'visible');
            } else {
                  scrollToTopButton.classList.add('opacity-0', 'invisible');
                  scrollToTopButton.classList.remove('opacity-100', 'visible');
            }
      });

      scrollToTopButton.addEventListener('click', () => {
            window.scrollTo({
                  top: 0,
                  behavior: 'smooth'
            });
      });
</script>