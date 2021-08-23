<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-indigo-200 leading-tight">
            {{ __('Hexco Candidates') }} 
        </h2>
    </x-slot> 
 {{--    @livewire('comment.comment-upload') --}}

        <div class="mt-4 mx-4">
          <div class="max-w-7xl {{-- mx-auto --}} overflow-hidden rounded-lg shadow-xs">
   
            <div class="overflow-x-auto">          	

             
              @include('includes.search_candidate')              
              <div class="my-2 px-2">
                {{$students->links()}}
              </div>                         		
  <!-- .students clearance Table --> 
      @if($students->count()>0)         	
              <table class="w-full">
                <thead>
                  <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b">
                    <th class="px-4 py-3">Candidate</th>
                    <th class="px-4 py-3">Discipline</th>
                    <th class="px-4 py-3">Status</th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
               @foreach($students->unique('candidate_number') as $student)
                  <tr class="bg-gray-50">
                    <td class="px-4 py-3">
                      <div class="flex items-center text-sm">
                        <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block bg-gray-800 border-1">

                          {{-- <span class="text-red-700 text-sm object-fill m-1">{{$student['surname'][0]}} {{$student['names']}}</span> --}}
                        
                          <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                        </div>
                        <div>
                        <a href="#/{{-- dashboard/fees-clearances/{{$student->slug --}}}}" class="text-blue-400 hover:text-gray-400">
                          <p class="font-semibold">{{$student['surname']}} {{$student->names}} </p>
                          <p class="text-xs text-gray-600 dark:text-gray-400">{{$student['candidate_number']}}</p>
                        </a>

                        </div>
                      </div>
                    </td>
                    <td class="px-4 py-3 text-sm">{{$student->discipline}}</td>
                    <td class="px-4 py-3 text-xs">
     {{-- Display clearannce status--}}
              @if($student->isRegisteredInSystem())
                    @if($student->user->fees[0]->is_cleared)
                      <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full"> 
                        Approved 
                        <x-icon name="check-circle" class="inline w-4 h-4"/>
                      </span>
                     @elseif($student->user->fees[0]->cleared_at == null && $student->user->fees[0]->is_cleared == false)
                      <span class="px-2 py-1 font-semibold leading-tight text-yellow-700 bg-yellow-100 rounded-full"> 
                        Pending
                      </span>                       
                     @elseif(!$student->user->fees[0]->cleared_at == null && $student->user->fees[0]->is_cleared == false)
                      <span class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full"> 
                        Declined
                        <x-icon name="exclamation" class="inline w-4 h-4"/>
                      </span>                      
                    @endif
                @if($student->user->isClearedOffline()) 
                        <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full"> 
                          Approved Offline
                          <x-icon name="check-circle" class="inline w-4 h-4"/>
                        </span>                 
                @endif                    
              @endif

       {{-- ./ Display clearannce status--}}              
                      
                      <p class="text-xs text-gray-600 dark:text-gray-400">
                      	{{-- {{!is_null($student->user->fees[0]->cleared_at)? $student->user->fees[0]->cleared_at->diffForHumans():''}} --}}
                      </p>
                    </td>
                   
                  </tr>
                @endforeach              
                </tbody>
              </table>
        @else
            <h2 class="my-4 px-4 font-semibold text-xl text-center text-gray-400  bg-white inline-block self-center leading-loose rounded-lg">
              No student fees clearances exist in this section
            </h2>
        @endif
              <div class="my-2 px-2">
                {{$students->links()}}
              </div>
              
            </div>   
</x-app-layout>