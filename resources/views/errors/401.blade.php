@extends('layouts.error')

@section('title', '401 - Tidak Diizinkan | NU Care LAZISNU Bojonegoro')

@section('content')
<div class="flex items-center justify-center min-h-[70vh] px-4 py-16 bg-white dark:bg-zinc-900">
      <div class="text-center max-w-xl">


            <flux:heading size="xl" class="mb-4 text-3xl font-bold tracking-tight text-zinc-900 dark:text-white">
                  401 - Tidak Diizinkan
            </flux:heading>

            <flux:text variant="subtle" class="mb-10 text-lg leading-relaxed">
                  Anda harus login terlebih dahulu untuk mengakses halaman ini. Silakan masuk ke akun Anda atau kembali ke halaman utama.
            </flux:text>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                  <flux:button variant="primary" href="{{ route('login') }}" icon="arrow-right-end-on-rectangle" size="lg" class="w-full sm:w-auto">
                        Masuk ke Akun
                  </flux:button>
                  <flux:button variant="outline" href="/" icon="home" size="lg" class="w-full sm:w-auto">
                        Beranda
                  </flux:button>
            </div>
      </div>
</div>
@endsection
