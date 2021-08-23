
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Statistics') }} 
        </h2>
    </x-slot>
   <div class="py-3">
        <div class="max-w-7xl overflow-hidden rounded-lg shadow-xs">
            <div class="w-full lg:w-9/12 mx-auto bg-white p-5 rounded-lg lg:rounded-l-none">
              @livewire('statistics.candidates')   
            </div>
              
        </div>
    </div>
</x-app-layout>
