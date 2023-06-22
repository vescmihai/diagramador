<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

       
        {{-- Google Fonts --}}

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
            <script src="https://kit.fontawesome.com/5fd588fe8f.js" crossorigin="anonymous"></script>

      {{-- Select 2 --}}
      <script src="https://code.jquery.com/jquery-3.6.1.min.js" integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous"></script>
      <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
      <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

     {{-- Sections Script & estilos --}}
     @section('script-css')
     @show

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    
    <!-- Styles -->
    @livewireStyles

    @livewireScripts

     {{-- Sweet Alert --}}
     <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

<body class="font-sans antialiased">
    <x-banner />
    
    

    <div class="min-h-screen bg-gray-100">
        @livewire('navigation-menu')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main >
            {{ $slot }}
        </main>
    </div>

    
  
    @stack('js')
    
    <script src="{{ asset('js/alerts.js') }}"></script>
</body>

</html>
