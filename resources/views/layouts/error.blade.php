<!DOCTYPE html>
<html lang="id">

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>@yield('title', 'Error | NU Care LAZISNU Bojonegoro')</title>
      <link rel="icon" href="{{ asset('asset/favicon.ico') }}" type="image/x-icon">
      
      @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="min-h-screen bg-white dark:bg-zinc-900 antialiased font-sans">

      <main>
            @yield('content')
      </main>

      <footer class="border-t border-zinc-200 dark:border-zinc-800 py-8 bg-zinc-50 dark:bg-zinc-950">
            <div class="max-w-7xl mx-auto px-4 text-center">
                  <p class="text-zinc-500 dark:text-zinc-400 text-sm italic">
                        &copy; {{ date('Y') }} NU Care LAZISNU Bojonegoro. Seluruh hak cipta dilindungi.
                  </p>
            </div>
      </footer>
</body>

</html>
