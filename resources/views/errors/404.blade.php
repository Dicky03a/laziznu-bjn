@extends('layouts.error')

@section('title', '404 - Halaman Tidak Ditemukan | NU Care LAZISNU Bojonegoro')

@section('content')
<div class="flex items-center justify-center min-h-[60vh] px-4 py-16">
      <div class="text-center max-w-xl">

            <h1 class="mb-4 text-3xl font-bold tracking-tight text-zinc-900 dark:text-white">
                  404 - Halaman Tidak Ditemukan
            </h1>

            <p class="mb-10 text-lg leading-relaxed text-zinc-500 dark:text-zinc-400">
                  Maaf, halaman yang Anda cari tidak dapat ditemukan atau mungkin telah dipindahkan. Pastikan alamat yang Anda masukkan benar.
            </p>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                  <a href="/" class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-green-600 hover:bg-green-700 w-full sm:w-auto transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                              <path stroke-linecap="round" stroke-linejoin="round" d="m2.25 12 8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                        </svg>
                        Kembali ke Beranda
                  </a>
                  <button onclick="window.history.back()" class="inline-flex items-center justify-center px-6 py-3 border border-zinc-300 dark:border-zinc-700 text-base font-medium rounded-md text-zinc-700 dark:text-zinc-300 bg-white dark:bg-zinc-800 hover:bg-zinc-50 dark:hover:bg-zinc-700 w-full sm:w-auto transition-colors">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5 mr-2">
                              <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 19.5 3 12m0 0 7.5-7.5M3 12h18" />
                        </svg>
                        Kembali
                  </button>
            </div>
      </div>
</div>
@endsection
