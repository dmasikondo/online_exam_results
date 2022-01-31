<div>
    <x-app-layout>
        <div class="no-print">
            <x-slot name="header">
                <h2 class="font-semibold text-xl text-indigo-200 leading-tight">
                    {{ __('Candidate\'s results') }} 
                </h2>
            </x-slot>        
        </div>
        <div class="max-w-7xl rounded-lg mt-4 mb-16">
             @include('includes.search_candidate')
            <div class="bg-gray-200 bg-opacity-25">
                <div class="p-6 relative">
                    <div class="flex items-center">
                        <x-icon name="academic-cap" class="h-14 w-14 text-gray-200"/>
                    </div>

                    <section name="exam_results" class="ml-12 p-2 shadow">
                        <div class="mt-2 text-sm text-gray-500">
                    @if($exam_results->count()>0)
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

              {{-- @endcan --}}

                        @else
                        <p>There is no record of results for this candidate</p>

                       </article>                     
                        @endif
                        </div>
                </section>
                </div>                                     
            </div>             
        </div>
       
    </x-app-layout>
</div>