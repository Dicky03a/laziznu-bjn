@extends('layouts.public.app')
@section('title', 'Berita - LAZISNU Jepara')

@section('content')
<div class="min-h-screen bg-gradient-to-b from-blue-50  to-white ">
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
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-6 mb-8">
                  <!-- Sidebar Filters -->
                  <div class="lg:col-span-1 space-y-6">
                        <!-- Search Box -->
                        <div class="bg-white  rounded-xl shadow-md border border-slate-200  p-5 sticky top-6">
                              <h3 class="text-base font-bold text-slate-900  mb-4 pb-3 border-b border-slate-200 ">
                                    Cari Berita
                              </h3>
                              <form action="{{ route('berita.public.index') }}" method="GET" class="flex flex-col gap-3">
                                    <div class="relative">
                                          <input type="text"
                                                name="search"
                                                value="{{ request('search') }}"
                                                placeholder="Ketik kata kunci..."
                                                class="w-full px-3 py-2 bg-slate-50  border border-slate-300  rounded-lg text-sm text-slate-900  placeholder-slate-500  focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all">
                                          <svg class="absolute right-3 top-1/2 -translate-y-1/2 w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                          </svg>
                                    </div>
                                    <button type="submit" class="w-full px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium rounded-lg transition-colors">
                                          Cari
                                    </button>
                              </form>
                              @if (request('search') || request('category'))
                              <div class="mt-3 pt-3 border-t border-slate-200 ">
                                    @if (request('search'))
                                    <p class="text-xs text-slate-600  mb-2">Pencarian: <span class="font-semibold text-slate-900 ">{{ request('search') }}</span></p>
                                    @endif
                                    <a href="{{ route('berita.public.index') }}" class="text-xs text-emerald-600  hover:underline font-medium">
                                          Hapus Filter
                                    </a>
                              </div>
                              @endif
                        </div>

                        <!-- Categories -->
                        <div class="bg-white  rounded-xl shadow-md border border-slate-200  p-5 sticky top-64">
                              <h3 class="text-base font-bold text-slate-900  mb-4 pb-3 border-b border-slate-200 ">
                                    Kategori
                              </h3>

                              <div class="space-y-2">
                                    <a href="{{ route('berita.public.index') }}"
                                          class="flex items-center justify-between px-3 py-2 rounded-lg transition-colors text-sm {{ !request('category') ? 'bg-emerald-100  text-emerald-700  font-medium' : 'text-slate-700  hover:bg-slate-100  }}">
                                          <span>Semua Berita</span>
                                          <span class="text-xs bg-slate-200  px-2 py-0.5 rounded-full">
                                                {{ $allCategories->sum('news_count') ?? 0 }}
                                          </span>
                                    </a>

                                    @if ($allCategories && $allCategories->count() > 0)
                                    @foreach ($allCategories as $category)
                                    <a href="{{ route('berita.public.index', ['category' => $category->id]) }}"
                                          class="flex items-center justify-between px-3 py-2 rounded-lg transition-colors text-sm {{ request('category') == $category->id ? 'bg-emerald-100  text-emerald-700  font-medium' : 'text-slate-700  hover:bg-slate-100  }}">
                                          <span>{{ $category->name }}</span>
                                          <span class="text-xs bg-slate-200  px-2 py-0.5 rounded-full">
                                                {{ $category->news_count ?? 0 }}
                                          </span>
                                    </a>
                                    @endforeach
                                    @else
                                    <p class="text-xs text-slate-500  py-2">Tidak ada kategori</p>
                                    @endif
                              </div>
                        </div>
                  </div>

                  <!-- News Grid -->
                  <div class="lg:col-span-3">
                        @if ($news->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">

                              @foreach ($news as $item)
                              <article class="bg-white  rounded-xl overflow-hidden shadow-md hover:shadow-xl transition-shadow duration-300 border border-slate-200  flex flex-col">

                                    <!-- Featured Image -->
                                    @if ($item->featured_image)
                                    <div class="relative h-48 overflow-hidden">
                                          <img src="{{ asset('storage/' . $item->featured_image) }}"
                                                alt="{{ $item->title }}"
                                                class="w-full h-full object-cover hover:scale-105 transition-transform duration-300">
                                    </div>
                                    @else
                                    <div class="h-48 bg-gradient-to-r from-slate-200 to-slate-300   flex items-center justify-center">
                                          <svg class="w-16 h-16 text-slate-400 " fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                          </svg>
                                    </div>
                                    @endif

                                    <!-- Content -->
                                    <div class="p-6 flex-1 flex flex-col">
                                          <!-- Category Badge -->
                                          @if ($item->category)
                                          <span class="inline-flex w-fit items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100  text-blue-800  mb-3">
                                                {{ $item->category->name }}
                                          </span>
                                          @endif

                                          <!-- Title -->
                                          <h3 class="text-xl font-bold text-slate-900  mb-2 line-clamp-2">
                                                {{ $item->title }}
                                          </h3>

                                          <!-- Meta Info -->
                                          <div class="flex items-center gap-4 text-sm text-slate-600  mb-4">
                                                <span class="flex items-center gap-1">
                                                      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                                      </svg>
                                                      {{ $item->published_at->format('d M Y') }}
                                                </span>
                                          </div>

                                          <!-- Excerpt -->
                                          <p class="text-slate-600  text-sm mb-4 flex-1 line-clamp-3">
                                                {{ $item->excerpt ? $item->excerpt : Str::limit(strip_tags($item->content), 150) }}
                                          </p>

                                          <!-- Read More Link -->
                                          <a href="{{ route('berita.show', $item->slug) }}"
                                                class="inline-flex items-center gap-2 text-blue-600  hover:text-blue-700  font-medium text-sm transition-colors">
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
                              <svg class="mx-auto h-16 w-16 text-slate-300  mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v4m2 10a2 2 0 002-2m0 0V9a2 2 0 00-2-2m2 2V5m2 0a2 2 0 012 2v10a2 2 0 01-2 2m0 0H9m0 0a2 2 0 01-2-2m2 2v4"></path>
                              </svg>
                              <p class="text-slate-600  font-medium">{{ __('Tidak ada berita yang sesuai dengan pencarian') }}</p>
                              <p class="text-slate-500  text-sm mt-1">{{ __('Coba ubah filter atau kata kunci pencarian') }}</p>
                              <a href="{{ route('berita.public.index') }}" class="inline-flex items-center gap-2 mt-4 px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium rounded-lg transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                    </svg>
                                    Kembali ke Semua Berita
                              </a>
                        </div>
                        @endif
                  </div>
            </div>
            @endsection