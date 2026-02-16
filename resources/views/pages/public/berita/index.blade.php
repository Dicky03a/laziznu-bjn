@extends('layouts.public.app')
@section('title', 'Berita - LAZISNU Jepara')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-blue-50 dark:from-zinc-900 to-white dark:to-zinc-950">
      <!-- Hero Section -->
      <section class="relative bg-gradient-to-br from-emerald-600 to-emerald-700 py-20 sm:py-24 overflow-hidden">
            <div class="relative max-w-4xl mx-auto text-center px-4 sm:px-6 lg:px-8">
                  <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-white mb-4">
                        Berita Terbaru
                  </h1>
                  <p class="text-base sm:text-lg text-emerald-100 max-w-2xl mx-auto">
                        Dapatkan informasi terbaru seputar kegiatan, program, dan berita terkini dari LAZISNU Jepara.
                  </p>
            </div>
      </section>

      <!-- Main Content -->
      <div class="max-w-6xl mx-auto py-12 px-4">
            @if ($news->count() > 0)
            <!-- News Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-12">
                  @foreach ($news as $item)
                  <article class="bg-white dark:bg-zinc-900 rounded-xl overflow-hidden shadow-md hover:shadow-xl transition-shadow duration-300 border border-slate-200 dark:border-zinc-800 flex flex-col">
                        <!-- Featured Image -->
                        @if ($item->featured_image)
                        <div class="relative h-48 overflow-hidden">
                              <img src="{{ asset('storage/' . $item->featured_image) }}"
                                    alt="{{ $item->title }}"
                                    class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                        </div>
                        @else
                        <div class="h-48 bg-gradient-to-r from-slate-200 to-slate-300 dark:from-zinc-700 dark:to-zinc-800 flex items-center justify-center">
                              <svg class="w-16 h-16 text-slate-400 dark:text-zinc-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                              </svg>
                        </div>
                        @endif

                        <!-- Content -->
                        <div class="p-6 flex-1 flex flex-col">
                              <!-- Category Badge -->
                              @if ($item->category)
                              <span class="inline-flex w-fit items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 dark:bg-blue-900/30 text-blue-800 dark:text-blue-300 mb-3">
                                    {{ $item->category->name }}
                              </span>
                              @endif

                              <!-- Title -->
                              <h3 class="text-xl font-bold text-slate-900 dark:text-white mb-2 line-clamp-2">
                                    {{ $item->title }}
                              </h3>

                              <!-- Meta Info -->
                              <div class="flex items-center gap-4 text-sm text-slate-600 dark:text-slate-400 mb-4">
                                    <span class="flex items-center gap-1">
                                          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                          </svg>
                                          {{ $item->published_at->format('d M Y') }}
                                    </span>
                              </div>

                              <!-- Excerpt -->
                              <p class="text-slate-600 dark:text-slate-400 text-sm mb-4 flex-1 line-clamp-3">
                                    {{ $item->excerpt ? $item->excerpt : Str::limit(strip_tags($item->content), 150) }}
                              </p>

                              <!-- Read More Link -->
                              <a href="{{ route('berita.show', $item->slug) }}"
                                    class="inline-flex items-center gap-2 text-blue-600 dark:text-blue-400 hover:text-blue-700 dark:hover:text-blue-300 font-medium text-sm transition-colors">
                                    {{ __('Baca Selengkapnya') }}
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                    </svg>
                              </a>
                        </div>
                  </article>
                  @endforeach
            </div>

            <!-- Pagination -->
            @if ($news->hasPages())
            <div class="mt-8 flex justify-center">
                  {{ $news->links() }}
            </div>
            @endif
            @else
            <!-- Empty State -->
            <div class="text-center py-20">
                  <svg class="mx-auto h-16 w-16 text-slate-300 dark:text-zinc-700 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v4m2 10a2 2 0 002-2m0 0V9a2 2 0 00-2-2m2 2V5m2 0a2 2 0 012 2v10a2 2 0 01-2 2m0 0H9m0 0a2 2 0 01-2-2m2 2v4"></path>
                  </svg>
                  <p class="text-slate-600 dark:text-slate-400 font-medium">{{ __('Belum ada berita yang dipublikasikan') }}</p>
                  <p class="text-slate-500 dark:text-slate-500 text-sm mt-1">{{ __('Berita akan segera hadir, mohon tunggu') }}</p>
            </div>
            @endif
      </div>
</div>

@endsection