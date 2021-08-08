<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Student Fees Clearances') }} 
        </h2>
    </x-slot> 
 {{--    @livewire('comment.comment-upload') --}}

        <div class="mt-4 mx-4">
          <div class="max-w-7xl mx-auto overflow-hidden rounded-lg shadow-xs">
          	<x-session-message/>
          	<x-session-warning/>
            <div class="overflow-x-auto">          	

              @php
                $random =time().time();
              @endphp                      
              @livewire('fees.clear-student', key($random))            		
  <!-- .students clearance Table -->          	
              <table class="w-full">
                <thead>
                  <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b">
                    <th class="px-4 py-3">Student</th>
                    <th class="px-4 py-3">Discipline</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Processed by</th>
                    <th class="px-4 py-3">Date</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
               @foreach($students as $student)
                  <tr class="bg-gray-50">
                    <td class="px-4 py-3">
                      <div class="flex items-center text-sm">
                        <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block bg-gray-800 border-1">
                       
                          {{-- <img class="object-cover w-full h-full rounded-full" src="{{$student->profile_photo_url}} alt="" /> --}}
                       
                          {{-- <span class="text-red-700 text-sm object-fill m-1">{{$student->first_name[0]}} {{$student->second_name[0]}}</span> --}}
                        
                          <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                        </div>
                        <div>
                          <p class="font-semibold">{{$student->second_name}} {{$student->first_name}}</p>
                          <p class="text-xs text-gray-600 dark:text-gray-400">{{$student->national_id}}</p>
                        </div>
                      </div>
                    </td>
                    <td class="px-4 py-3 text-sm">{{$student->results[0]->discipline}}</td>
                    <td class="px-4 py-3 text-xs">
     {{-- Display clearannce status--}}
                     @if($student->fees[0]->cleared_at == null && $student->fees[0]->is_cleared == false)
                     	<span class="px-2 py-1 font-semibold leading-tight text-yellow-700 bg-yellow-100 rounded-full"> 
                     		Pending
                     	</span>                     	
                     @elseif(!$student->fees[0]->cleared_at == null && $student->fees[0]->is_cleared == false)
                     	<span class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full"> 
                     		Declined
                     	</span>
                     @elseif(!$student->fees[0]->cleared_at == null && $student->fees[0]->is_cleared)
                     	<span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full"> 
                     		Approved
                     	</span>
                     @endif
       {{-- Endof Display clearannce status--}}              
                      
                      <p class="text-xs text-gray-600 dark:text-gray-400">
                      	{{!is_null($student->fees[0]->cleared_at)? $student->fees[0]->cleared_at->diffForHumans():''}}
                      </p>
                    </td>
                    <td class="px-4 py-3 text-sm">
                      <p class="font-semibold">
                      	{{$student->fees[0]->approver->second_name ?? false}}
                      	{{$student->fees[0]->approver->first_name ?? false}}
                      </p>
                      <p class="text-xs text-gray-600 dark:text-gray-400">
                      	{{$student->fees[0]->cleared_at? Carbon\Carbon::parse($student->fees[0]->cleared_at)->format('D d M Y h:i:s'): ''}}
                      </p>
                    </td>
                    <td class="px-4 py-3 text-sm">{{$student->updated_at}}</td>
                    <td>
     {{-- action buttons--}}                    
                     @if(!$student->fees[0]->cleared_at == null && $student->fees[0]->is_cleared)
                       <x-icon name="check-circle" class="w-4 h-4 text-green-700"/>
                      
                     @elseif(!$student->fees[0]->cleared_at == null && $student->fees[0]->is_cleared == false)
                        <x-icon name="exclamation" class="w-4 h-4 text-red-700"/>
                     @else        
                    	<button onclick="window.livewire.emitTo('fees.clear-student','updateFeesClearanceState','{{$student->fees[0]->slug}}')" 
            				    class="text-sm py-1 px-2 rounded-lg bg-indigo-500 text-white hover:text-indigo-500 hover:bg-white hover:border-4 hover:border-indigo-500">
            				    update fees clearance
            			   </button>
                    @endif
                {{-- ./action buttons--}} 
                    </td>
                  </tr>
                @endforeach              
                </tbody>
              </table>
            </div>   
</x-app-layout>