<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">              

        <title>{{ config('app.name', 'Laravel') }}</title>

        <link rel="icon" href="{{ URL::asset('storage/images/favicon2.png') }}" type="image/x-icon"/>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <style>
          @media print
          {
            .no-print{
              display: none;
            }
          }
        </style>        

        @livewireStyles
              

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">

        <x-jet-banner />


        <div class="min-h-screen bg-gray-100 bg-gradient-to-br hover:from-yellow-50 hover:via-white to-indigo-50">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow no-print">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 text-gray-200">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <div class="min-h-screen md:flex">
              <div class="flex-none w-full md:max-w-xs">
                <x-sidebar.menu/>
              </div>
              <div class="flex-1 sm:ml-12 ml-12 md:ml-0">
                <main class="">
                    {{ $slot }}
                </main>
              </div>
            </div>



        </div>
        {{-- footer --}} 

        <footer class="mx-auto no-print bg-gradient-to-br from-yellow-50 via-white to-indigo-50 border border-black border-opacity-5 rounded-xl text-center py-16 px-10 mt-16">
            <img src="{{url('storage/images/itunit_cat.png')}}" alt="IT Unit Cat" alt="" class="mx-auto -mb-6" style="width: 145px;">
            <h5 class="text-3xl font-semibold">Harare Polytechnic IT Unit</h5>
            <p class="text-sm mt-3">&copy; {{date('Y')}} </p>

            <div class="mt-10">
                <div class="relative inline-block mx-auto lg:bg-indigo-200 px-6 rounded-full">
                    <nav class="md:flex md:justify-between md:items-center">
                        <div class="mr-4">
                           {{--  <a href="/" class="hover:shadow-xl">
                                <img src="{{url('storage/images/health_plus_logo.svg')}}" alt="Health Plus Logo" class="h-8 hover:shadow-xl">
                            </a> --}}
                        </div>

                        <div class="mt-8 md:mt-0 space-x-12">
                            <x-link href="/">Home Page</x-link>
                            <x-link href="https://portal.hrepoly.ac.zw">Portal</x-link>
                            <x-link href="https://www.hrepoly.ac.zw">Harare Polytechnic</x-link>
                            
                        </div>
                    </nav>

                   
                </div>
            </div>
        </footer>              
        {{-- ./footer--}}
        @stack('modals')

        @livewireScripts
    </body>
</html>

