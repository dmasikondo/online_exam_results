<div>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-indigo-200 leading-tight">
            {{ __('My fees clearance status') }} 
        </h2>
    </x-slot> 

    <div class="py-12">
        <div class="max-w-7xl {{-- mx-auto --}} sm:px-6 lg:px-8 bg-indigo-200 shadow-inner">
            <div class="mb-6 p-6 sm:px-20 bg-white border-b border-gray-200 shadow-lg rounded-lg">
                <div>
                    <x-jet-application-logo class="block h-12 w-auto" />
                </div>

                <div class="mt-8 text-2xl text-gray-300">
                    Welcome to Harare Polytechnic's Hexco Examination Results!
                </div>

            {{-- @foreach($fees_clearances as $fees_clearance) --}}
                <div class="mt-6 text-gray-500">
                   @can('sendProof', $fees_clearances->last()) 
                    You are not currently cleared by the accounts department to view your Harare Polytechnic's {{$fees_clearances->last()->intake->label}}. You may need to upload proof of fees payment.
                   @endcan 
                   @cannot('sendProof', $fees_clearances->last())
                    You have been cleared by the accounts department and you are able to view your Harare Polytechnic's {{$fees_clearances->last()->intake->label}}.
                   @endcannot

                </div>
           {{--  @endforeach --}}
            </div>

            <div class="my-24 p-6 sm:px-20 bg-white rounded-lg">
              <table class="w-full">
                <thead>
                  <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b">
                    <th class="px-4 py-3">Student</th>
                    <th class="px-4 py-3">Discipline</th>
                    <th class="px-4 py-3">Status</th>
                    <th class="px-4 py-3">Processed by</th>
                    <th class="px-4 py-3">Date</th>
                    <th class="px-4 py-3">Session</th>
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
                        {{-- {{!is_null($fee_clearance->clearer_id)? 'Accounts Department':''}} --}}
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
                  </tr>
                @endforeach              
                </tbody>
              </table>
            </div>
            <div class="{{-- mb-6 p-6 sm:px-20 bg-white border-b border-gray-200 shadow-lg --}}">
                <div class="my -2">
                @livewire('comment.get-comments',['fileableId'=>$fee_clearance->id,'fileableType' =>'App\Models\Fee','isFromStudent'=>true])  
                </div>
            </div>
        @can('sendProof', $fees_clearances[0]) {{-- not able to view results unless admin --}}
            <div class="mb-6 p-6 sm:px-20 bg-white border-b border-gray-200 shadow-lg">           
                @livewire('comment.comment-upload',['fileableId'=>$fee_clearance->id,'fileableType' =>'App\Models\Fee','isFromStudent'=>true, 'possibleNewProofOfPayment'=>true,])            
            </div>
        @endcan
        </div>

        
    </div>
</x-app-layout>
</div>


