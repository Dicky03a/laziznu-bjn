@extends('layouts.public.app')
@section('title', 'Kebijakan Privasi - Lazisnu Bojonegoro')

@section('content')

{{-- HERO SECTION --}}
<section class="relative bg-gradient-to-r from-emerald-900 via-emerald-800 to-emerald-700 py-24">
      <div class="absolute inset-0 bg-black/20"></div>

      <div class="relative max-w-6xl mx-auto px-6 text-center text-white">
            <h1 class="text-4xl md:text-5xl font-bold tracking-tight mb-6">
                  Kebijakan Privasi
            </h1>
            <p class="max-w-3xl mx-auto text-lg text-emerald-100 leading-relaxed">
                  Komitmen kami dalam menjaga dan melindungi informasi pribadi
                  setiap pengguna layanan LAZISNU Bojonegoro.
            </p>
      </div>
</section>


{{-- CONTENT SECTION --}}
<section class="bg-gray-50 py-20">
      <div class="max-w-5xl mx-auto px-6">

            <div class="bg-white rounded-2xl shadow-lg p-10 md:p-14 space-y-12">

                  {{-- Intro --}}
                  <div class="text-gray-700 leading-relaxed">
                        <p>
                              Kebijakan privasi ini menjelaskan bagaimana LAZISNU Bojonegoro
                              mengumpulkan, menggunakan, dan melindungi informasi pribadi
                              pengguna yang dikumpulkan melalui website resmi kami.
                        </p>
                  </div>

                  {{-- Section Item --}}
                  <div>
                        <h2 class="text-2xl font-semibold text-emerald-800 mb-4">
                              Informasi yang Kami Kumpulkan
                        </h2>
                        <ul class="space-y-3 text-gray-700 leading-relaxed list-disc pl-6">
                              <li>Data pribadi seperti nama, email, nomor telepon, dan informasi relevan lainnya.</li>
                              <li>Data penggunaan seperti alamat IP, perangkat, browser, halaman yang dikunjungi, dan waktu akses.</li>
                        </ul>
                  </div>

                  <div>
                        <h2 class="text-2xl font-semibold text-emerald-800 mb-4">
                              Penggunaan Informasi
                        </h2>
                        <ul class="space-y-3 text-gray-700 leading-relaxed list-disc pl-6">
                              <li>Memberikan layanan dan menjawab pertanyaan pengguna.</li>
                              <li>Meningkatkan kualitas layanan dan pengalaman pengguna.</li>
                              <li>Mengelola donasi, zakat, dan layanan sosial lainnya.</li>
                        </ul>
                  </div>

                  <div>
                        <h2 class="text-2xl font-semibold text-emerald-800 mb-4">
                              Keamanan Informasi
                        </h2>
                        <p class="text-gray-700 leading-relaxed">
                              Kami menerapkan langkah-langkah keamanan teknis dan
                              administratif untuk melindungi informasi pribadi dari
                              akses tidak sah, perubahan, atau penyalahgunaan.
                        </p>
                  </div>

                  <div>
                        <h2 class="text-2xl font-semibold text-emerald-800 mb-4">
                              Pengungkapan kepada Pihak Ketiga
                        </h2>
                        <p class="text-gray-700 leading-relaxed">
                              Kami tidak menjual atau membagikan data pribadi kepada pihak
                              ketiga tanpa persetujuan pengguna, kecuali diwajibkan oleh hukum.
                        </p>
                  </div>

                  <div>
                        <h2 class="text-2xl font-semibold text-emerald-800 mb-4">
                              Perubahan Kebijakan
                        </h2>
                        <p class="text-gray-700 leading-relaxed">
                              LAZISNU Bojonegoro berhak memperbarui kebijakan ini sewaktu-waktu.
                              Perubahan akan diumumkan melalui halaman ini.
                        </p>
                  </div>

                  {{-- CTA BOX --}}
                  <div class="bg-emerald-50 border border-emerald-200 rounded-xl p-8 text-center">
                        <h3 class="text-xl font-semibold text-emerald-900 mb-3">
                              Dukung Program Kebaikan Kami
                        </h3>
                        <p class="text-gray-600 mb-6">
                              Setiap infaq Anda membantu program sosial dan kemanusiaan
                              yang bermanfaat bagi masyarakat.
                        </p>

                        <a href="{{ route('infaq.index') }}"
                              class="inline-block bg-emerald-700 text-white px-8 py-3 rounded-lg font-semibold hover:bg-emerald-800 transition duration-300 shadow-md">
                              Infaq Sekarang
                        </a>
                  </div>

            </div>
      </div>
</section>

@endsection