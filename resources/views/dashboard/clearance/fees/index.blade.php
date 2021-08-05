<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Student Fees Clearances') }} 
        </h2>
    </x-slot> 
<!-- .students clearance Table -->
        <div class="mt-4 mx-4">
          <div class="w-full overflow-hidden rounded-lg shadow-xs">
          	<x-session-message/>
          	<x-session-warning/>
            <div class="w-full overflow-x-auto">          	

              @php
                $random =time().time();
              @endphp                      
              @livewire('fees.clear-student', key($random))            		
            	
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
                  <tr class="bg-gray-50 dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-900 text-gray-700 dark:text-gray-400">
                    <td class="px-4 py-3">
                      <div class="flex items-center text-sm">
                        <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block bg-gray-800">
                       
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
                {{-- Endof action buttons--}} 
                    </td>
                  </tr>
                @endforeach              
                </tbody>
              </table>
            </div>
 {{--            <div class="grid px-4 py-3 text-xs font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
              <span class="flex items-center col-span-3"> Showing 21-30 of 100 </span>
              <span class="col-span-2"></span>
              <!-- Pagination -->
              <span class="flex col-span-4 mt-2 sm:mt-auto sm:justify-end">
                <nav aria-label="Table navigation">
                  <ul class="inline-flex items-center">
                    <li>
                      <button class="px-3 py-1 rounded-md rounded-l-lg focus:outline-none focus:shadow-outline-purple" aria-label="Previous">
                        <svg aria-hidden="true" class="w-4 h-4 fill-current" viewBox="0 0 20 20">
                          <path d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" fill-rule="evenodd"></path>
                        </svg>
                      </button>
                    </li>
                    <li>
                      <button class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple">1</button>
                    </li>
                    <li>
                      <button class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple">2</button>
                    </li>
                    <li>
                      <button class="px-3 py-1 text-white dark:text-gray-800 transition-colors duration-150 bg-blue-600 dark:bg-gray-100 border border-r-0 border-blue-600 dark:border-gray-100 rounded-md focus:outline-none focus:shadow-outline-purple">3</button>
                    </li>
                    <li>
                      <button class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple">4</button>
                    </li>
                    <li>
                      <span class="px-3 py-1">...</span>
                    </li>
                    <li>
                      <button class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple">8</button>
                    </li>
                    <li>
                      <button class="px-3 py-1 rounded-md focus:outline-none focus:shadow-outline-purple">9</button>
                    </li>
                    <li>
                      <button class="px-3 py-1 rounded-md rounded-r-lg focus:outline-none focus:shadow-outline-purple" aria-label="Next">
                        <svg class="w-4 h-4 fill-current" aria-hidden="true" viewBox="0 0 20 20">
                          <path d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" fill-rule="evenodd"></path>
                        </svg>
                      </button>
                    </li>
                  </ul>
                </nav>
              </span>
            </div>
          </div>
        </div> --}}
        <!-- ./Client Table -->    
</x-app-layout>