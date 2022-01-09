<div>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-indigo-200 leading-tight">
            <a href="/dashboard/fees-clearances">Fees Clearance: </a>
            
            <small> {{$user->second_name}} {{$user->first_name}}</small> 
            <x-jet-button class="text-right" onclick="window.history.back()">Back</x-jet-button>

        </h2>
    </x-slot> 

    <div class="py-12">
        <div class="max-w-7xl {{-- mx-auto --}} sm:px-6 lg:px-8 bg-indigo-200 shadow-inner">
            <div class="mb-6 p-6 sm:px-20 {{-- bg-white --}} border-b border-gray-200 shadow-lg">
                <div>
                    <x-jet-application-logo class="block h-12 w-auto" />
                </div>
@livewire('fees.clear-student')
                <div class="mt-8 text-2xl text-gray-800">
                    {{$user->second_name}} {{$user->first_name}}'s 

                <div class="mt-6 text-lg text-gray-500 font-semibold">                   
                   
                    @if($offline_cleared)
                        <p class="leading-relaxed"> clearance was done offline</p>
                    @else
                        <p class="leading-relaxed">Fees clearance state</p>
                    @endif                                     

                </div>
            </div>
            <x-session-message/>
            <x-session-warning/>
        </div>

            <div class="my-24 p-6 sm:px-20 bg-white">
                <div class="my-2 p-6 sm:px-20 bg-white">
              <table class="w-full">
                <thead>
                  <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b">
                    <th class="px-4 py-3">Student</th>
                    <th class="px-4 py-3">Discipline</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Processed by</th>
                    <th class="px-4 py-3">Date</th>
                    <th class="px-4 py-3">Session</th>
                    <th class="px-4 py-3">Action</th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
               @foreach($fees_clearances as $fee_clearance)
                  <tr class="bg-gray-50  text-gray-700">
                    <td class="px-4 py-3">
                      <div class="flex items-center text-sm">
                        <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block">
                          <img class="object-cover w-full h-full rounded-full" src="{{$fee_clearance->user->profile_photo_url}}" alt="{{$fee_clearance->user->second_name}}"  />
                          <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true"></div>
                        </div>
                        <div>
                          <p class="font-semibold">{{$fee_clearance->user->second_name}} {{$fee_clearance->user->first_name}}</p>
                          <p class="text-xs text-gray-600 dark:text-gray-400">{{$fee_clearance->user->national_id}}</p>
                        </div>
                      </div>
                    </td>
                    <td class="px-4 py-3 text-sm">{{$fee_clearance->user->results[0]->discipline}}</td>
                    <td class="px-4 py-3 text-xs">

                     @if($offline_cleared) 
                        <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full"> 
                            Approved
                            <x-icon name="check-circle" class="inline w-4 h-4"/>
                        </span>                     
                     @elseif($fee_clearance->cleared_at == null && $fee_clearance->is_cleared == false)
                        <span class="px-2 py-1 font-semibold leading-tight text-yellow-700 bg-yellow-100 rounded-full"> 
                            Pending
                        </span>                         
                     @elseif(!$fee_clearance->cleared_at == null && $fee_clearance->is_cleared == false)
                        <span class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full"> 
                            Declined
                        </span>
                     @elseif(!$fee_clearance->cleared_at == null && $fee_clearance->is_cleared)
                        <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full"> 
                            Approved
                        </span>
                     @endif
                      <p class="text-xs text-gray-600 dark:text-gray-400">
                        {{!is_null($fee_clearance->cleared_at)? $fee_clearance->cleared_at->diffForHumans():''}}
                      </p>
                    </td>
                    <td class="px-4 py-3 text-sm">
                      <p class="font-semibold">
                    @can('showName',$fee_clearance)
                        {{$fee_clearance->approver->second_name ?? false}}
                        {{$fee_clearance->approver->first_name ?? false}}                        
                    @endcan
                        Accounts Department
                      </p>
                      <p class="text-xs text-gray-600 dark:text-gray-400">
                        {{!is_null($fee_clearance->clearer_id)? Carbon\Carbon::parse($fee_clearance->cleared_at)->format('D d M Y h:i:s'): ''}}
                      </p>
                    </td>
                    <td class="px-4 py-3 text-sm">{{$fee_clearance->updated_at}}</td>
                    <td>{{$fee_clearance->intake->label}}</td>
                    <td>
     {{-- action buttons--}} 
                    @if($user->isClearedOffline($fee_clearance->intake_id))
                      <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full"> 
                        <x-icon name="check-circle" class="inline w-4 h-4"/>
                      </span>                        
                     @elseif(!$fee_clearance->cleared_at == null && $fee_clearance->is_cleared)
                       <x-icon name="check-circle" class="w-4 h-4 text-green-700"/>
                      
                     @elseif(!$fee_clearance->cleared_at == null && !is_null($fee_clearance->clearer_id) && $fee_clearance->is_cleared == false)
                        <x-icon name="exclamation" class="w-4 h-4 text-red-700"/>
                     @else        
                        <button onclick="window.livewire.emitTo('fees.clear-student','updateFeesClearanceState','{{$fee_clearance->slug}}')" 
                                class="text-sm py-1 px-2 rounded-lg bg-indigo-500 text-white hover:text-indigo-500 hover:bg-white hover:border-1 hover:border-indigo-500">
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
            </div>
           {{--  <div class="mb-6 p-6 sm:px-20 bg-white border-b border-gray-200 shadow-lg"> --}}
                <div class="my -2">
            @foreach($fees_clearances as $fee_clearance)
                @livewire('comment.get-comments',['fileableId'=>$fee_clearance->id,'fileableType' =>'App\Models\Fee','isFromStudent'=>false]) 
            @endforeach
                </div>
            {{-- </div> --}}
       {{--  @can('sendProof', $fees_clearances[0]) --}} {{-- not able to view results unless admin --}}
            <div class="mb-6 p-6 sm:px-20 bg-white border-b border-gray-200 shadow-lg">           
                @livewire('comment.comment-upload',['fileableId'=>$fee_clearance->id,'fileableType' =>'App\Models\Fee','isFromStudent'=>false,])            
            </div>
       {{--  @endcan --}}
        </div>

        
    </div>
</x-app-layout>
</div>