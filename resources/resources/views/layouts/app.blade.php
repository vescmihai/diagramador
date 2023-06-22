<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Eventos') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    @livewireStyles

    <!-- Scripts -->
    @vite(['resources/css/app.css',
            'resources/js/app.js'])
    @livewireScripts
 
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"> </script>

</head>

<body class="font-inter antialiased bg-slate-100 text-slate-600" :class="{ 'sidebar-expanded': sidebarExpanded }"
    x-data="{ sidebarOpen: false, sidebarExpanded: localStorage.getItem('sidebar-expanded') == 'true' }" x-init="$watch('sidebarExpanded', value => localStorage.setItem('sidebar-expanded', value))">

    <script>
        if (localStorage.getItem('sidebar-expanded') == 'true') {
            document.querySelector('body').classList.add('sidebar-expanded');
        } else {
            document.querySelector('body').classList.remove('sidebar-expanded');
        }
    </script>

    <!-- Page wrapper -->
    <div class="flex h-screen overflow-hidden">

        <x-app.sidebar />

        <!-- Content area -->
        <div class="relative flex flex-col flex-1 overflow-y-auto overflow-x-hidden @if ($attributes['background']) {{ $attributes['background'] }} @endif"
            x-ref="contentarea">

            {{-- @livewire('navigation-menu') --}}
             <x-app.header/>

            <main>
                {{-- <img id="image" src="{{asset('images/avatar-01.jpg')}}" alt=""> --}}
                {{ $slot }}
            </main>

        </div>

    </div>

    
    <script>
        Livewire.on('alert', function(mensaje) {
            Swal.fire(
                mensaje['titulo'],
                mensaje['mensaje'],
                mensaje['icono'],
                )
            })
     </script>


    @stack('js')


</body>

</html>
