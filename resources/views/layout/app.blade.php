<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Tanihub | @yield('title')</title>
  <link rel="icon" href="{{ asset('image/logo.png') }}" type="image/x-icon">
  @vite('resources/css/app.css')
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="h-screen mx-auto antialiased flex justify-between" x-data>
  <x-sidebar />
  <main class="flex-1 bg-gray-100">
    @yield('content')
  </main>
  @vite('resources/js/app.js')
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns/dist/chartjs-adapter-date-fns.bundle.min.js"></script>
  <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
