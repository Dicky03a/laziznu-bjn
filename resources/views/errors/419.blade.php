@extends('layouts.error')

@section('title', '419 - Sesi Berakhir | NU Care LAZISNU Bojonegoro')

@section('content')
<div class="flex items-center justify-center min-h-[70vh] px-4 py-16 bg-white dark:bg-zinc-900">
      <div class="text-center max-w-xl">

            <flux:heading size="xl" class="mb-4 text-3xl font-bold tracking-tight text-zinc-900 dark:text-white">
                  419 - Sesi Berakhir
            </flux:heading>

            <flux:text variant="subtle" class="mb-10 text-lg leading-relaxed">
                  Sesi Anda telah kedaluwarsa karena tidak ada aktivitas dalam waktu lama atau token keamanan telah berakhir. Silakan muat ulang halaman dan coba lagi.
            </flux:text>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                  <flux:button variant="primary" onclick="window.location.reload()" icon="arrow-path" size="lg" class="w-full sm:w-auto">
                        Muat Ulang Halaman
                  </flux:button>
                  <flux:button variant="outline" href="/" icon="home" size="lg" class="w-full sm:w-auto">
                        Ke Beranda
                  </flux:button>
            </div>
      </div>
</div>
@endsection
