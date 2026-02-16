@extends('layouts.public.app')
@section('title', $news->title . ' - LAZISNU Jepara')

@section('content')
<article class="min-h-screen bg-gray-50 dark:bg-zinc-950">
      <div class="max-w-7xl mx-auto px-4 py-6 md:py-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:gap-8">

                  <!-- Main Content -->
                  <div class="lg:col-span-2">
                        <!-- Article Header -->
                        <div class="bg-white dark:bg-zinc-900 rounded-lg shadow-sm border border-gray-200 dark:border-zinc-800 p-6 md:p-8 mb-6">
                              <!-- Title -->
                              <h1 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white mb-4 leading-tight">
                                    {{ $news->title }}
                              </h1>

                              <!-- Meta Information -->
                              <div class="flex flex-wrap items-center gap-3 text-sm text-gray-600 dark:text-gray-400 mb-4">
                                    <div class="flex items-center gap-1.5">
                                          <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                          </svg>
                                          <time datetime="{{ $news->published_at->toIso8601String() }}">
                                                {{ $news->published_at->format('d F Y') }}, {{ $news->published_at->format('H:i') }}
                                          </time>
                                    </div>

                                    <span class="inline-flex items-center gap-1.5 px-2.5 py-1 bg-gray-100 dark:bg-zinc-800 rounded text-xs font-medium">
                                          <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
                                          </svg>
                                          No Comments
                                    </span>
                              </div>

                              <!-- Category Badge -->
                              @if ($news->category)
                              <div class="mb-4">
                                    <span class="inline-flex items-center px-3 py-1 rounded-md text-xs font-semibold bg-blue-100 dark:bg-blue-900/40 text-blue-800 dark:text-blue-300 border border-blue-200 dark:border-blue-800">
                                          {{ $news->category->name }}
                                    </span>
                              </div>
                              @endif
                        </div>

                        <!-- Featured Image -->
                        @if ($news->featured_image)
                        <div class="mb-6 rounded-lg overflow-hidden shadow-sm border border-gray-200 dark:border-zinc-800">
                              <img src="{{ asset('storage/' . $news->featured_image) }}"
                                    alt="{{ $news->title }}"
                                    class="w-full h-auto object-cover"
                                    loading="eager">
                        </div>
                        @endif

                        <!-- Article Content -->
                        <div class="bg-white dark:bg-zinc-900 rounded-lg shadow-sm border border-gray-200 dark:border-zinc-800 p-6 md:p-8 mb-6">
                              <!-- Excerpt -->
                              @if ($news->excerpt)
                              <div class="mb-6 pb-6 border-b border-gray-200 dark:border-zinc-800">
                                    <p class="text-base md:text-lg text-gray-700 dark:text-gray-300 leading-relaxed font-medium">
                                          {{ $news->excerpt }}
                                    </p>
                              </div>
                              @endif

                              <!-- Article Body -->
                              <div class="prose prose-base prose-gray dark:prose-invert max-w-none 
                                    prose-headings:font-bold prose-headings:text-gray-900 dark:prose-headings:text-white prose-headings:mb-4
                                    prose-p:text-gray-700 dark:prose-p:text-gray-300 prose-p:leading-relaxed prose-p:mb-4
                                    prose-a:text-blue-600 dark:prose-a:text-blue-400 prose-a:no-underline hover:prose-a:underline
                                    prose-strong:text-gray-900 dark:prose-strong:text-white prose-strong:font-semibold
                                    prose-ul:my-4 prose-ol:my-4 prose-li:my-1
                                    prose-img:rounded-lg prose-img:shadow-md prose-img:border prose-img:border-gray-200 dark:prose-img:border-zinc-700 prose-img:my-6
                                    tiptap-content">
                                    {!! $news->content !!}
                              </div>
                        </div>

                        <!-- Social Share Buttons -->
                        <div class="bg-white dark:bg-zinc-900 rounded-lg shadow-sm border border-gray-200 dark:border-zinc-800 p-6 mb-6">
                              <p class="text-sm font-semibold text-gray-700 dark:text-gray-300 mb-3">SEBARANYA</p>
                              <div class="flex items-center gap-2">
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('berita.show', $news->slug)) }}"
                                          target="_blank"
                                          class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-blue-600 hover:bg-blue-700 text-white transition-colors">
                                          <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z" />
                                          </svg>
                                    </a>
                                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('berita.show', $news->slug)) }}&text={{ urlencode($news->title) }}"
                                          target="_blank"
                                          class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-sky-500 hover:bg-sky-600 text-white transition-colors">
                                          <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M23.953 4.57a10 10 0 01-2.825.775 4.958 4.958 0 002.163-2.723c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 00-8.384 4.482C7.69 8.095 4.067 6.13 1.64 3.162a4.822 4.822 0 00-.666 2.475c0 1.71.87 3.213 2.188 4.096a4.904 4.904 0 01-2.228-.616v.06a4.923 4.923 0 003.946 4.827 4.996 4.996 0 01-2.212.085 4.936 4.936 0 004.604 3.417 9.867 9.867 0 01-6.102 2.105c-.39 0-.779-.023-1.17-.067a13.995 13.995 0 007.557 2.209c9.053 0 13.998-7.496 13.998-13.985 0-.21 0-.42-.015-.63A9.935 9.935 0 0024 4.59z" />
                                          </svg>
                                    </a>
                                    <a href="https://telegram.me/share/url?url={{ urlencode(route('berita.show', $news->slug)) }}&text={{ urlencode($news->title) }}"
                                          target="_blank"
                                          class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-blue-500 hover:bg-blue-600 text-white transition-colors">
                                          <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z" />
                                          </svg>
                                    </a>
                                    <a href="https://wa.me/?text={{ urlencode($news->title . ' - ' . route('berita.show', $news->slug)) }}"
                                          target="_blank"
                                          class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-green-500 hover:bg-green-600 text-white transition-colors">
                                          <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
                                          </svg>
                                    </a>
                              </div>
                        </div>

                        <!-- Back to News Button -->
                        <div class="mb-6">
                              <a href="{{ route('berita.public.index') }}"
                                    class="inline-flex items-center gap-2 text-sm text-gray-600 dark:text-gray-400 hover:text-blue-600 dark:hover:text-blue-400 transition-colors group">
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
                        <div class="bg-white dark:bg-zinc-900 rounded-lg shadow-sm border border-gray-200 dark:border-zinc-800 p-5 lg:sticky lg:top-6">
                              <h3 class="text-base font-bold text-gray-900 dark:text-white mb-4 pb-3 border-b border-gray-200 dark:border-zinc-800">
                                    Terbaru
                              </h3>

                              <div class="space-y-4">
                                    @foreach ($relatedNews as $related)
                                    <a href="{{ route('berita.show', $related->slug) }}"
                                          class="block group">
                                          <div class="flex items-start gap-3">
                                                <div class="flex-shrink-0 w-2 h-2 mt-2 rounded-full bg-blue-600"></div>
                                                <div class="flex-1 min-w-0">
                                                      <p class="text-sm font-medium text-gray-900 dark:text-white group-hover:text-blue-600 dark:group-hover:text-blue-400 line-clamp-2 mb-1 leading-snug transition-colors">
                                                            {{ $related->title }}
                                                      </p>
                                                      <p class="text-xs text-gray-500 dark:text-gray-400">
                                                            {{ $related->published_at->format('d M Y') }}
                                                      </p>
                                                </div>
                                          </div>
                                    </a>
                                    @if (!$loop->last)
                                    <div class="border-b border-gray-100 dark:border-zinc-800"></div>
                                    @endif
                                    @endforeach
                              </div>
                        </div>
                        @endif

                        <!-- Categories -->
                        <div class="bg-white dark:bg-zinc-900 rounded-lg shadow-sm border border-gray-200 dark:border-zinc-800 p-5 mb-6 lg:sticky lg:top-6">
                              <h3 class="text-base font-bold text-gray-900 dark:text-white mb-4 pb-3 border-b border-gray-200 dark:border-zinc-800">
                                    Kategori
                              </h3>

                              <div class="space-y-2">
                                    <a href="{{ route('berita.public.index', ['category' => 'artikel']) }}"
                                          class="flex items-center gap-2 text-sm text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors group">
                                          <svg class="w-4 h-4 text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                          </svg>
                                          Artikel
                                    </a>
                                    <a href="{{ route('berita.public.index', ['category' => 'berita']) }}"
                                          class="flex items-center gap-2 text-sm text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors group">
                                          <svg class="w-4 h-4 text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                          </svg>
                                          Berita
                                    </a>
                                    <a href="{{ route('berita.public.index', ['category' => 'kegiatan']) }}"
                                          class="flex items-center gap-2 text-sm text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors group">
                                          <svg class="w-4 h-4 text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                          </svg>
                                          Kegiatan
                                    </a>
                                    <a href="{{ route('berita.public.index', ['category' => 'pengumuman']) }}"
                                          class="flex items-center gap-2 text-sm text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors group">
                                          <svg class="w-4 h-4 text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                          </svg>
                                          Pengumuman
                                    </a>
                                    <a href="{{ route('berita.public.index', ['category' => 'program-kegiatan']) }}"
                                          class="flex items-center gap-2 text-sm text-gray-700 dark:text-gray-300 hover:text-blue-600 dark:hover:text-blue-400 transition-colors group">
                                          <svg class="w-4 h-4 text-gray-400 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                          </svg>
                                          Program Kegiatan
                                    </a>
                              </div>
                        </div>

                        <!-- Donation Banner (Optional) -->
                        <div class="bg-gradient-to-br from-green-500 to-teal-600 rounded-lg shadow-sm p-6 text-white">
                              <div class="text-center mb-4">
                                    <svg class="w-12 h-12 mx-auto mb-3 opacity-90" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <h4 class="text-lg font-bold mb-2">Donasi Siaga dan Peduli Bencana</h4>
                                    <p class="text-sm opacity-90 mb-4">LAZISNU JEPARA</p>
                                    <div class="bg-white/20 rounded-lg p-3 mb-4">
                                          <p class="text-xs opacity-75 mb-1">Rekening:</p>
                                          <p class="text-lg font-bold">Rp 25.000.000</p>
                                    </div>
                              </div>
                              <a href="#" class="block w-full bg-white text-green-600 hover:bg-green-50 text-center font-semibold py-2.5 px-4 rounded-lg transition-colors">
                                    Donasi Sekarang
                              </a>
                        </div>
                  </div>

            </div>
      </div>
</article>

<style>
      /* Custom CSS untuk menangani whitespace dari Tiptap */
      .tiptap-content p:empty {
            min-height: 1.5em;
            /* Memberikan tinggi minimum untuk paragraph kosong */
            display: block;
      }

      .tiptap-content p:empty::before {
            content: '\00a0';
            /* Non-breaking space untuk memastikan paragraph memiliki konten */
            display: inline-block;
            visibility: hidden;
      }

      .tiptap-content br {
            display: block;
            content: "";
            margin-top: 0.5em;
            /* Memberikan spacing untuk br tag */
      }

      /* Alternatif: Preserve whitespace dari HTML */
      .tiptap-content {
            white-space: pre-wrap;
            /* Mempertahankan whitespace dari HTML */
      }
</style>

@endsection