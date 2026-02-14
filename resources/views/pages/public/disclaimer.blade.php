@extends('layouts.public.app')
@section('title', 'Syarat & Ketentuan - LAZISNU Jepara')

@section('content')

{{-- HERO SECTION --}}
<section class="relative bg-gradient-to-r from-emerald-900 via-emerald-800 to-emerald-700 py-24">
      <div class="absolute inset-0 bg-black/20"></div>

      <div class="relative max-w-6xl mx-auto px-6 text-center text-white">
            <h1 class="text-4xl md:text-5xl font-bold tracking-tight mb-6">
                  Syarat & Ketentuan
            </h1>

            <p class="max-w-3xl mx-auto text-lg text-emerald-100 leading-relaxed">
                  Ketentuan resmi penggunaan layanan website LAZISNU Jepara.
                  Dengan mengakses situs ini, Anda dianggap telah memahami
                  dan menyetujui seluruh syarat yang berlaku.
            </p>
      </div>
</section>


{{-- MAIN CONTENT --}}
<section class="bg-gray-50 py-20">
      <div class="max-w-6xl mx-auto px-6">

            <div class="bg-white rounded-2xl shadow-xl p-10 md:p-14 space-y-14">

                  {{-- Intro --}}
                  <div class="text-gray-700 leading-relaxed space-y-4">
                        <p>
                              Selamat datang di website resmi LAZISNU Jepara.
                              Dengan menggunakan layanan di website ini, Anda setuju
                              untuk tunduk dan patuh terhadap seluruh syarat dan ketentuan
                              yang telah ditetapkan.
                        </p>
                        <p>
                              Jika Anda tidak menyetujui sebagian atau seluruh ketentuan,
                              mohon untuk tidak menggunakan layanan website ini.
                        </p>
                  </div>

                  {{-- Penggunaan Konten --}}
                  <div>
                        <h2 class="text-2xl font-semibold text-emerald-800 mb-6 border-b pb-3">
                              Penggunaan Konten
                        </h2>
                        <ul class="space-y-4 text-gray-700 leading-relaxed list-decimal pl-6">
                              <li>Seluruh konten di website dilindungi hak cipta dan merupakan milik LAZISNU Jepara.</li>
                              <li>Konten hanya boleh digunakan untuk tujuan informasi dan non-komersial.</li>
                              <li>Dilarang mendistribusikan ulang tanpa izin tertulis.</li>
                        </ul>
                  </div>

                  {{-- Kebijakan Privasi --}}
                  <div>
                        <h2 class="text-2xl font-semibold text-emerald-800 mb-6 border-b pb-3">
                              Kebijakan Privasi
                        </h2>
                        <p class="text-gray-700 leading-relaxed">
                              Informasi pribadi pengguna akan dikelola sesuai dengan
                              Kebijakan Privasi yang berlaku. Kami berkomitmen menjaga
                              keamanan dan kerahasiaan data pengguna.
                        </p>
                  </div>

                  {{-- Tautan Eksternal --}}
                  <div>
                        <h2 class="text-2xl font-semibold text-emerald-800 mb-6 border-b pb-3">
                              Tautan Eksternal
                        </h2>
                        <p class="text-gray-700 leading-relaxed">
                              Website ini dapat berisi tautan ke situs pihak ketiga.
                              LAZISNU Jepara tidak bertanggung jawab atas isi maupun
                              kebijakan privasi dari situs tersebut.
                        </p>
                  </div>

                  {{-- Batasan Tanggung Jawab --}}
                  <div>
                        <h2 class="text-2xl font-semibold text-emerald-800 mb-6 border-b pb-3">
                              Batasan Tanggung Jawab
                        </h2>
                        <p class="text-gray-700 leading-relaxed">
                              Website disediakan sebagaimana adanya tanpa jaminan
                              tersurat maupun tersirat. Penggunaan informasi sepenuhnya
                              menjadi tanggung jawab pengguna.
                        </p>
                  </div>

                  {{-- Perubahan Ketentuan --}}
                  <div>
                        <h2 class="text-2xl font-semibold text-emerald-800 mb-6 border-b pb-3">
                              Perubahan Syarat & Ketentuan
                        </h2>
                        <p class="text-gray-700 leading-relaxed">
                              LAZISNU Jepara berhak memperbarui syarat dan ketentuan
                              sewaktu-waktu tanpa pemberitahuan sebelumnya.
                        </p>
                  </div>

                  {{-- CTA BOX --}}
                  <div class="bg-gradient-to-r from-emerald-700 to-emerald-800 text-white rounded-xl p-10 text-center shadow-lg">
                        <h3 class="text-2xl font-semibold mb-4">
                              Mari Berkontribusi dalam Kebaikan
                        </h3>
                        <p class="mb-6 text-emerald-100 max-w-2xl mx-auto">
                              Setiap donasi dan infaq Anda membantu program sosial,
                              pendidikan, dan kemanusiaan yang bermanfaat bagi umat.
                        </p>

                        <a href="{{ route('infaq') }}"
                              class="inline-block bg-white text-emerald-800 px-8 py-3 rounded-lg font-semibold hover:bg-gray-100 transition duration-300 shadow-md">
                              Infaq Sekarang
                        </a>
                  </div>

            </div>
      </div>
</section>

@endsection