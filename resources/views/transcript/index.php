<div>
    <x-app-layout>
        <div class="no-print">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-indigo-200 leading-tight">
                {{ __('Candidates with an Award') }} 
            </h2>
        </x-slot>
        </div>
    </x-app-layout>
        <div class="mt-4 mx-4">
          <div class="max-w-7xl {{-- mx-auto --}} overflow-hidden rounded-lg shadow-xs">
   
            <div class="overflow-x-auto">           

             
              @include('includes.search_candidate')              
              <div class="my-2 px-2">
                {{$candidates->links()}}
              </div>  
</div>