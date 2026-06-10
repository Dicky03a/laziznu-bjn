@extends('layouts.error')

@section('title', '503 - Sedang Pemeliharaan | NU Care LAZISNU Bojonegoro')

@section('content')
<div class="flex items-center justify-center min-h-[70vh] px-4 py-16 bg-white dark:bg-zinc-900">
      <div class="text-center max-w-xl">
            <flux:heading size="xl" class="mb-4 text-3xl font-bold tracking-tight text-zinc-900 dark:text-white">
                  503 - Sedang Pemeliharaan
            </flux:heading>

            <flux:text variant="subtle" class="mb-10 text-lg leading-relaxed">
                  Layanan kami saat ini sedang dalam pemeliharaan rutin untuk meningkatkan kualitas layanan. Kami akan segera kembali. Silakan coba lagi beberapa saat lagi.
            </flux:text>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                  <flux:button variant="outline" onclick="window.location.reload()" icon="arrow-path" size="lg" class="w-full sm:w-auto">
                        Cek Kembali
                  </flux:button>
            </div>
      </div>
</div>
@endsection
