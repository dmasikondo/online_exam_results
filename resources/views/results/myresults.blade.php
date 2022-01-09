<div>
  <style>
  @media print
  {
    .no-print{
      display: none;
    }
  }


</style>
    <x-app-layout>
        <div class="no-print">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-indigo-200 leading-tight">
                {{ __('Dashboard') }} 
            </h2>
        </x-slot>
        </div>
 

       <div class="py-3">
            <div class="max-w-7xl rounded-lg mt-4 mb-16">
                @livewire('result.check-result')
            </div>
            <div class="max-w-7xl rounded-lg">

            <div class="p-6 sm:px-20 bg-white border-b border-gray-200 shadow-lg no-print">
                <div>
                    <x-jet-application-logo class="block h-12 w-auto" />
                    <x-session-message/>
                </div>
        
                <div class="mt-8 space-y-4">
                    <h2 class="font-semibold text-4xl text-gray-300 tracking-wide">Hie {{ Auth::user()->first_name }} !</h2>
                    
                    <p class="font-thin text-lg">
                      @can('view',$exam_results[0])
                        You may want to view your 
                     @endcan 
                    @cannot('view',$exam_results[0])
                        To view your Harare Polytechnic's Hexco Examination Results ... 
                    @endcannot                                       
                    </p> 
                </div>

                <div class="mt-4 text-gray-500">
                      @can('view',$exam_results[0])
                        Fees Clearance Status ...
                     @endcan 
                     @cannot('view',$exam_results[0])                  
                    You must be fully paid up to Harare Polytechnic (with $0 balance or <span class="text-red-700">$-</span>) in your college account and be cleared by the accounts department.
                    @endcannot
                </div>
                <div class="my-2 py-12">
                  <a href="/results/clearance/{{Auth::user()->slug}}">
                    <button  class="float-right p-2 rounded-lg bg-indigo-500 text-white hover:text-indigo-500 hover:bg-white hover:border-4 hover:border-indigo-500" >
                      @can('view',$exam_results[0])
                        Fees Clearance Status 
                     @endcan                       
                      @cannot('view',$exam_results[0]) 
                        Send Proof of Payment
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="inline h-6 w-6">
                          <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM6.293 6.707a1 1 0 010-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 01-1.414 1.414L11 5.414V13a1 1 0 11-2 0V5.414L7.707 6.707a1 1 0 01-1.414 0z" clip-rule="evenodd"/>
                        </svg>
                      @endcannot
                    </button>  
                  </a>                  

                </div>

            </div>  

            <div class="bg-gray-200 bg-opacity-25">
                <div class="p-6 relative">
                    <div class="flex items-center">
                        <x-icon name="academic-cap" class="h-14 w-14 text-gray-200"/>
                    </div>

                    <section name="exam_results" class="ml-12 p-2 shadow">
                        <div class="mt-2 text-sm text-gray-500">


                        @if($exam_results->count()>0)
                          @can('view',$exam_results[0])
                    {{-- watermark --}}
  {{-- <div id="background">
  <p id="bg-text">Background</p>
  </div> --}}
                       <article class="exam_results">
                            <div class="text-center border-b">
                                <h2 class="border-b text-lg font-thin">MINISTRY OF HIGHER AND TERTIARY EDUCATION, SCIENCE, INNOVATION AND TECHNOLOGY DEVELOPMENT</h2>
                                <p class="text-xl font-extrabold">HIGHER EDUCATION EXAMINATIONS COUNCIL</p>
                                <p class="text-xl font-extrabold">(HEXCO)</p>
                                <p class="text-xl font-extrabold">INDIVIDUAL STATEMENT OF RESULTS</p>
                                <p class="no-print"> 
                                  <button class="cursor-pointer p-2" onclick="window.print()">
                                    <x-icon="document-download" class="h-8 w-8 text-red-900" stroke-width="2"/>
                                      download
                                  </button>
                                </p>    
                            </div>
                            <div class="my-4 py-2 w-1/2">
                                <p class="flex justify-between sm:space-x-6"><span class="font-bold">CANDIDATE NUMBER</span><span>:{{$exam_results[0]->candidate_number}}</span></p>
                                <p class="flex justify-between sm:space-x-6"><span class="font-bold">COMMENT</span><span>:{{$exam_results[0]->comment}}</span></p>
                                <p class="flex justify-between"><span class="font-bold">SURNAME</span><span>:{{$exam_results[0]->surname}}</span></p>
                                <p class="flex justify-between"><span class="font-bold">FIRST NAMES</span><span>:{{$exam_results[0]->names}}</span></p>
                                <p class="flex justify-between"><span class="font-bold">INSTITUTION NAME</span><span>:Harare Polytechnic</span></p>
                                <p class="flex justify-between"><span class="font-bold">COURSE LEVEL</span><span>{{$exam_results[0]->course_code}}</span></p>
                                <p class="flex justify-between"><span class="font-bold">COURSE TITLE</span><span class="text-red-700">:{{$exam_results[0]->discipline}}</span></p>
                            </div>
                        
              <table class="w-full">
                <thead>

                  <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b">

                    <th class="px-4 py-3">PAPER No.</th>
                    <th class="px-4 py-3">APPROVED SUBJECT TITLES </th>
                    <th class="px-4 py-3">GRADE</th>
                    <th class="px-4 py-3">Date</th>
                  </tr>
                </thead>

                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
              
               @foreach($exam_results as $exam_result)   
                  <tr class="bg-gray-100  text-gray-700">
{{--         <div class="text-gray-50 container__watermark text-4xl space-y-2 opacity-25" style=" transform: rotate(-45deg); position:absolute; width: 100%; margin: 0 auto; opacity: 0.25;">
            <p>Not for Official Use Not for Official Use</p>
        </div> --}}                     
                    <td class="px-4 py-3">
                      <div class="flex items-center text-sm">
                        <div>
                          <p class="font-semibold">{{$exam_result->subject_code}}</p>
                        </div>
                      </div>
                    </td>
                    <td class="px-4 py-3 text-sm">{{$exam_result->subject}}</td>
                    <td class="px-4 py-3 text-sm">{{$exam_result->grade}}</td>
                    <td class="px-4 py-3 text-sm">{{$exam_result->session}} </td>
                 </tr>
                @endforeach              
                </tbody>
              </table>

              @endcan

                        @else
                        <p>There is no record of results. You may need to contact exams</p>

                       </article>                     
                        @endif
                        </div>
                </section>
                </div>                                     
            </div>
        </div>        
    </x-app-layout> 
</div>