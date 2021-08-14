<div class="min-h-screen flex flex-col sm:justify-center items-center max-w-4xl mx-auto pt-6 sm:pt-0 bg-gray-50 opacity-75">
    <div class="flex flex-col sm:justify-center items-center">
        {{ $logo }}
    </div>

   {{--  <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
        {{ $slot }}
    </div> --}}
    <div class=" shadow-md rounded-md p-4 m-4">
         {{ $slot }}      
    </div>    
</div>


