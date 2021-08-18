<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">              

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">

        @livewireStyles
              

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>
    </head>
    <body class="font-sans antialiased">

        <x-jet-banner />


        <div class="min-h-screen bg-gray-100">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 text-gray-200">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Side Bar -->
            {{-- <x-sidebar/> --}}

            <!-- Page Content -->
{{--             <main class="ml-12">
                {{ $slot }}
            </main> --}}
            <div class="min-h-screen md:flex">
              <div class="flex-none w-full md:max-w-xs">
                <x-sidebar/>
              </div>
              <div class="flex-1 sm:ml-12 ml-12 md:ml-0">
                <main class="">
                    {{ $slot }}
                </main>
              </div>
            </div>



        </div>
        {{-- footer --}}
        <div class="bg-blue-900 py-4">
            <div class="max-w-7xl mx-auto">
                <div class="flex justify-center mt-4 sm:items-center sm:justify-between">
                    <div class="text-center text-sm text-gray-500 sm:text-left">
                        <div class="flex items-center">

                            <a href="https://portal.hrepoly.ac.zw" class="ml-1 underline">
                                Portal
                            </a>
                        </div>
                    </div>
                    <div class="ml-4">
                        <p>&copy; {{date('Y')}} IT Unit</p>
                    </div>

                    <div class="ml-4 text-center text-sm text-gray-500 sm:text-right sm:ml-0">
                        <a href="https://www.hrepoly.ac.zw">Harare Polytechnic</a>
                    </div>
                </div>                
            </div>
        </div>        

        @stack('modals')

        @livewireScripts
    </body>
</html>

