<!DOCTYPE html>
<html lang="id">

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">

      <title>@yield('title', 'NU Care LAZISNU Bojonegoro')</title>
      <link rel="icon" href="{{ asset('asset/favicon.ico') }}" type="image/x-icon">
      <link rel="shortcut icon" href="{{ asset('asset/favicon.ico') }}">
      <link rel="apple-touch-icon" href="{{ asset('asset/favicon.ico') }}">

      <meta name="description" content="@yield('description','LAZISNU Bojonegoro - Lembaga Amil Zakat, Infaq dan Shadaqah Nahdlatul Ulama Bojonegoro')">

      <meta name="keywords" content="lazisnu bojonegoro, zakat bojonegoro, infaq bojonegoro">

      <link rel="canonical" href="{{ url()->current() }}">

      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

      <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

      @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gray-50 min-h-screen flex flex-col font-sans">


      @include('layouts.public.navbar')

      <!-- Main Content -->
      <main class="flex-grow">
            @yield('content')
      </main>

      <!-- Include Footer -->
      @include('layouts.public.footer')

      @stack('scripts')

</body>

</html>