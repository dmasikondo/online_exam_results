<div>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-indigo-200 leading-tight">
            {{ __('Upload CSV File') }} 
        </h2>
    </x-slot> 

    <div class="py-12">
        <div class="max-w-7xl {{-- mx-auto --}} sm:px-6 lg:px-8 bg-indigo-200 shadow-inner">
            @livewire('result.upload-csv')           
        </div>

        
    </div>
</x-app-layout>
</div>


