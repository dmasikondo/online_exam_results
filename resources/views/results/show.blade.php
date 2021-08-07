<div>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }} 
        </h2>
    </x-slot> 

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-indigo-200 shadow-inner">
            <div class="mb-6 p-6 sm:px-20 bg-white border-b border-gray-200 shadow-lg">
                <div>
                    <x-jet-application-logo class="block h-12 w-auto" />
                </div>

                <div class="mt-8 text-2xl">
                    Welcome to Harare Polytechnic's Hexco Examination Results!
                </div>

                <div class="mt-6 text-gray-500">
                    You must be fully paid up to Harare Polytechnic (with $0 balance or <span class="text-red-700">$-</span>) in your college account to be able to view your current Hexco results.
                </div>
            </div>

            <div class="my-24 p-6 sm:px-20 bg-white">
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
                      
                     @if($fee_clearance->cleared_at == null && $fee_clearance->is_cleared == false)
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
                      </span>
                      <p class="text-xs text-gray-600 dark:text-gray-400">
                        {{!is_null($fee_clearance->cleared_at)? $fee_clearance->cleared_at->diffForHumans():''}}
                      </p>
                    </td>
                    <td class="px-4 py-3 text-sm">
                      <p class="font-semibold">
                        {{!is_null($fee_clearance->clearer_id)? 'Accounts Department':''}}
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
        </div>
        <div class="mb-6 p-6 sm:px-20 bg-white border-b border-gray-200 shadow-lg">
            <div class="my">
            @livewire('comment.get-comments',['fileableId'=>$fee_clearance->id,'fileableType' =>'App\Models\Fee',])  
            </div>
            @livewire('comment.comment-upload',['fileableId'=>$fee_clearance->id,'fileableType' =>'App\Models\Fee',]) 
        </div>
        
    </div>
</x-app-layout>
</div>