@extends('layouts.public.app')
@section('title', $news->title . ' - LAZISNU Jepara')

@section('content')
<article class="min-h-screen bg-gray-50 ">
      <div class="max-w-7xl mx-auto px-4 py-6 md:py-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">

                  <!-- Main Content -->
                  <div class="lg:col-span-2">
                        <!-- Article Header -->
                        <div class="bg-white  rounded-lg shadow-sm border border-gray-200  p-6 md:p-8 mb-6">
                              <!-- Title -->
                              <h1 class="text-3xl md:text-4xl font-bold text-gray-900  mb-4 leading-tight">
                                    {{ $news->title }}
                              </h1>

                              <!-- Meta Information -->
                              <div class="flex flex-wrap items-center gap-3 text-sm text-gray-600  mb-4">
                                    <div class="flex items-center gap-1.5">
                                          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                          </svg>
                                          <time datetime="{{ $news->published_at->toIso8601String() }}">
                                                {{ $news->published_at->format('d F Y') }}, {{ $news->published_at->format('H:i') }}
                                          </time>
                                    </div>

                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-gray-100  rounded text-xs font-medium">
                                          <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                                          </svg>
                                          No Comments
                                    </span>
                              </div>

                              <!-- Category Badge -->
                              @if ($news->category)
                              <div class="mb-4">
                                    <span class="inline-flex items-center px-3 py-1 rounded-md text-xs font-semibold bg-blue-100  text-blue-800  border border-blue-200 ">
                                          {{ $news->category->name }}
                                    </span>
                              </div>
                              @endif


                              <!-- Featured Image -->
                              @if ($news->featured_image)

                              <img src="{{ asset('storage/' . $news->featured_image) }}"
                                    alt="{{ $news->title }}"
                                    class="w-full h-auto object-cover"
                                    loading="eager">

                              @endif

                              <!-- Article Content -->

                              <!-- Excerpt -->
                              @if ($news->excerpt)
                              <div class="mb-6 pb-6 border-b border-gray-200 ">
                                    <p class="text-base md:text-lg text-gray-700  leading-relaxed font-medium">
                                          {{ $news->excerpt }}
                                    </p>
                              </div>
                              @endif

                              <!-- Article Body -->
                              <div class="prose prose-base prose-gray  max-w-none 
                                    prose-headings:font-bold prose-headings:text-gray-900  prose-headings:mb-4
                                    prose-p:text-gray-700  prose-p:leading-relaxed prose-p:mb-4
                                    prose-a:text-blue-600  prose-a:no-underline hover:prose-a:underline
                                    prose-strong:text-gray-900  prose-strong:font-semibold
                                    prose-ul:my-4 prose-ol:my-4 prose-li:my-1
                                    prose-img:rounded-lg prose-img:shadow-md prose-img:border prose-img:border-gray-200  prose-img:my-6
                                    tiptap-content">
                                    {!! $news->content !!}
                              </div>
                        </div>

                        <!-- Back to News Button -->
                        <div class="mb-6">
                              <a href="{{ route('berita.public.index') }}"
                                    class="inline-flex items-center gap-2 text-sm text-gray-600  hover:text-blue-600  transition-colors group">
                                    <svg class="w-5 h-5 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                                    </svg>
                                    Kembali ke Berita
                              </a>
                        </div>
                  </div>

                  <!-- Sidebar -->
                  <div class="space-y-6">
                        <!-- Related News -->
                        @if ($relatedNews->count() > 0)
                        <div class="bg-white  rounded-lg shadow-sm border border-gray-200  p-5 lg:sticky lg:top-6">
                              <h3 class="text-base font-bold text-gray-900  mb-4 pb-3 border-b border-gray-200 ">
                                    Terbaru
                              </h3>

                              <div class="space-y-4">
                                    @foreach ($relatedNews as $related)
                                    <a href="{{ route('berita.show', $related->slug) }}"
                                          class="block group">
                                          <div class="flex items-start gap-3">
                                                <div class="flex-shrink-0 w-2 h-2 mt-2 rounded-full bg-blue-600"></div>
                                                <div class="flex-1 min-w-0">
                                                      <p class="text-sm font-medium text-gray-900  group-hover:text-blue-600  line-clamp-2 mb-1 leading-snug transition-colors">
                                                            {{ $related->title }}
                                                      </p>
                                                      <p class="text-xs text-gray-500 ">
                                                            {{ $related->published_at->format('d M Y') }}
                                                      </p>
                                                </div>
                                          </div>
                                    </a>
                                    @if (!$loop->last)
                                    <div class="border-b border-gray-100 "></div>
                                    @endif
                                    @endforeach
                              </div>
                        </div>
                        @endif

                        <!-- Search Box -->
                        <div class="bg-white  rounded-lg shadow-sm border border-gray-200  p-5 mb-6 lg:sticky lg:top-6">
                              <h3 class="text-base font-bold text-gray-900  mb-4 pb-3 border-b border-gray-200 ">
                                    Cari Berita
                              </h3>
                              <form action="{{ route('berita.public.index') }}" method="GET" class="flex gap-2">
                                    <div class="flex-1 relative">
                                          <input type="text"
                                                name="search"
                                                value="{{ request('search') }}"
                                                placeholder="Ketik judul atau kata kunci..."
                                                class="w-full px-3 py-2 bg-gray-50  border border-gray-300  rounded-lg text-sm text-gray-900  placeholder-gray-500  focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all">
                                          <svg class="absolute right-3 top-1/2 -translate-y-1/2 w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                                          </svg>
                                    </div>
                                    <button type="submit" class="px-4 py-2 bg-emerald-600 hover:bg-emerald-700 text-white text-sm font-medium rounded-lg transition-colors">
                                          Cari
                                    </button>
                              </form>
                              @if (request('search'))
                              <div class="mt-3 pt-3 border-t border-gray-200 ">
                                    <p class="text-xs text-gray-600 ">Hasil pencarian untuk: <span class="font-semibold text-gray-900 ">{{ request('search') }}</span></p>
                                    <a href="{{ route('berita.public.index') }}" class="text-xs text-emerald-600  hover:underline">Hapus filter</a>
                              </div>
                              @endif
                        </div>

                        <!-- Categories -->
                        <div class="bg-white  rounded-lg shadow-sm border border-gray-200  p-5 mb-6 lg:sticky lg:top-6">
                              <h3 class="text-base font-bold text-gray-900  mb-4 pb-3 border-b border-gray-200 ">
                                    Kategori
                              </h3>

                              <div class="space-y-2">
                                    <a href="{{ route('berita.public.index') }}"
                                          class="flex items-center justify-between px-3 py-2 rounded-lg transition-colors text-sm {{ !request('category') ? 'bg-emerald-100 text-emerald-700 font-medium' : 'text-slate-700 hover:bg-slate-100' }}">
                                          <span>Semua Berita</span>
                                          <span class="text-xs bg-slate-200 px-2 py-0.5 rounded-full">
                                                {{ $allCategories->sum(fn($item) => $item->news_count) ?? 0 }}
                                          </span>
                                    </a>

                                    @if ($allCategories && $allCategories->count() > 0)
                                    @foreach ($allCategories as $category)
                                    <a href="{{ route('berita.public.index', ['category' => $category->id]) }}"
                                          class="flex items-center justify-between px-3 py-2 rounded-lg transition-colors text-sm {{ request('category') == $category->id ? 'bg-emerald-100 text-emerald-700 font-medium' : 'text-slate-700 hover:bg-slate-100' }}">
                                          <span>{{ $category->name }}</span>
                                          <span class="text-xs bg-slate-200 px-2 py-0.5 rounded-full">
                                                {{ $category->news_count ?? 0 }}
                                          </span>
                                    </a>
                                    @endforeach
                                    @else
                                    <p class="text-xs text-slate-500 py-2">Tidak ada kategori</p>
                                    @endif
                              </div>

                              @if (request('category'))
                              <div class="mt-4 pt-4 border-t border-gray-200 ">
                                    <a href="{{ route('berita.public.index') }}" class="text-xs text-blue-600  hover:underline">
                                          Lihat Semua Kategori
                                    </a>
                              </div>
                              @endif
                        </div>
                  </div>

            </div>
      </div>
</article>

<style>
      .tiptap-content p:empty {
            min-height: 1.5em;
            display: block;
      }

      .tiptap-content p:empty::before {
            content: '\00a0';
            display: inline-block;
            visibility: hidden;
      }

      .tiptap-content br {
            display: block;
            content: "";
            margin-top: 0.5em;
      }

      .tiptap-content {
            white-space: pre-wrap;
      }
</style>

@endsection