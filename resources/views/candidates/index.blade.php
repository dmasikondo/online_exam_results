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
                {{$candidates->links()}}
              </div>                         		
  <!-- .candidates clearance Table --> 
      @if($candidates->count()>0)         	
              <table class="w-full">
                <thead>
                  <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b">
                    <th class="px-4 py-3">Candidate</th>                   
                    <th class="px-4 py-3">Level</th>   
                    <th class="px-4 py-3">Discipline</th>                  
                    <th class="px-4 py-3">Comment</th>                    
                    <th class="px-4 py-3">Accounts Status</th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
               {{-- @foreach($candidates->unique('candidate_number') as $candidate) --}}
               @foreach($candidates as $candidate)
                  <tr class="bg-gray-50">
                    <td class="px-4 py-3">
                      <div class="flex items-center text-sm">
                        <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block bg-gray-800 border-1">

                          {{-- <span class="text-red-700 text-sm object-fill m-1">{{$candidate['surname'][0]}} {{$candidate['names']}}</span> --}}
                        
                          <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                        </div>
                        <div>
                        <a href="/candidates/{{$candidate->candidate_number}}" class="text-blue-400 hover:text-gray-400">
                          <p class="font-semibold">{{$candidate['surname']}} {{$candidate->names}} </p>
                          <p class="text-xs text-gray-600 dark:text-gray-400">{{$candidate['candidate_number']}}</p>
                        </a>

                        </div>
                      </div>
                    </td>
                    <td class="px-4 py-3 text-sm">{{$candidate->course_code}}</td>
                    <td class="px-4 py-3 text-sm">{{$candidate->discipline}}</td>
                    <td class="px-4 py-3 text-sm">{{$candidate->comment}}</td>
                    <td class="px-4 py-3 text-xs">
     {{-- Display clearannce status--}}
              @if($candidate->isRegisteredInSystem())
                    @if($candidate->user->fees[0]->is_cleared)
                      <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full"> 
                        Approved 
                        <x-icon name="check-circle" class="inline w-4 h-4"/>
                      </span>
                     @elseif($candidate->user->fees[0]->cleared_at == null && $candidate->user->fees[0]->is_cleared == false)
                      <span class="px-2 py-1 font-semibold leading-tight text-yellow-700 bg-yellow-100 rounded-full"> 
                        Pending
                      </span>                       
                     @elseif(!$candidate->user->fees[0]->cleared_at == null && $candidate->user->fees[0]->is_cleared == false)
                      <span class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full"> 
                        Declined
                        <x-icon name="exclamation" class="inline w-4 h-4"/>
                      </span>                      
                    @endif
                @if($candidate->user->isClearedOffline()) 
                      <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full"> 
                        Approved Offline
                        <x-icon name="check-circle" class="inline w-4 h-4"/>
                      </span>                 
                @endif                    
              @endif

       {{-- ./ Display clearannce status--}}              
                      
                      <p class="text-xs text-gray-600 dark:text-gray-400">
                      	{{-- {{!is_null($candidate->user->fees[0]->cleared_at)? $candidate->user->fees[0]->cleared_at->diffForHumans():''}} --}}
                      </p>
                    </td>
                   
                  </tr>
                @endforeach              
                </tbody>
              </table>
        @else
            <h2 class="my-4 px-4 font-semibold text-xl text-center text-gray-400  bg-white inline-block self-center leading-loose rounded-lg">
              No candidate exists in this section's criteria
            </h2>
        @endif
              <div class="my-2 px-2">
                {{$candidates->links()}}
              </div>
              
            </div>   
</x-app-layout>