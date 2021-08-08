<div>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight" {{-- style="border-bottom-left-radius: 50% 20%; border-bottom-right-radius: 50% 20%;" --}}>
            {{ Auth::user()->second_name }} 
            {{ Auth::user()->first_name }}
        </h2>
    </x-slot>    

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 sm:px-20 bg-white border-b border-gray-200 shadow-lg">
                <div>
                    <x-jet-application-logo class="block h-12 w-auto" />
                </div>
        
                <div class="mt-8 space-y-4">
                    <h2 class="font-semibold text-4xl tracking-wide">Hie {{ Auth::user()->first_name }} !</h2>
                    
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
                <div class="p-6">
                    <div class="flex items-center">
                        <x-icon name="academic-cap" class="h-14 w-14 text-gray-200"/>
                    </div>
                  
                    <section name="exam_results" class="ml-12 p-2 shadow">
                        <div class="mt-2 text-sm text-gray-500">

                        @if($exam_results->count()>0)
                          @can('view',$exam_results[0])
                            <div class="text-center border-b">
                                <h2 class="border-b text-lg font-thin">MINISTRY OF HIGHER AND TERTIARY EDUCATION, SCIENCE AND TECHNOLOGY DEVELOPMENT</h2>
                                <p class="text-xl font-extrabold">HIGHER EDUCATION EXAMINATIONS COUNCIL</p>
                                <p class="text-xl font-extrabold">(HEXCO)</p>
                                <p class="text-xl font-extrabold">INDIVIDUAL STATEMENT OF RESULTS</p>
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

                            <div class="grid md:grid-cols-4 gap-2 my-4">
                                <div class="font-extrabold">PAPER No. </div>
                                <div class="font-extrabold">APPROVED SUBJECT TITLES </div>
                                <div class="font-extrabold">GRADE </div>
                                <div class="font-extrabold">Date </div>
                            @endcan
                           @foreach($exam_results as $exam_result)

                            @can('view', $exam_result)                           
                                <div>{{$exam_result->subject_code}} </div>
                                <div>{{$exam_result->subject}} </div>
                                <div>{{$exam_result->grade}} </div>
                                <div>{{$exam_result->session}} </div>                              
                           {{--  @else
                              <div>             
                                <p>You must first be cleared of any fees arrears with accounts department to see your April 2021 Results</p>
              
            
                              </div> --}}
                            @endcan  
                            @endforeach                                              
                            </div>                         

                        @else
                        <p>There is no record of results. You may need to contact exams</p>
                        @endif
                        </div>
                </section>
                </div>                     
        </div>
    </div>        
</x-app-layout>  
</div>