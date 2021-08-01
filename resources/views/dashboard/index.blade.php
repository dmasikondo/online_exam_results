<div>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }} 
        </h2>
    </x-slot> 

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                <div>
                    <x-jet-application-logo class="block h-12 w-auto" />
                </div>

                <div class="mt-8 text-2xl">
                    Welcome to Harare Polytechnic's Hexco Examination Results!
                </div>

                <div class="mt-6 text-gray-500">
                    You must be fully paid up to Harare Polytechnic (with $0 balance or $-) in your college account to be able to view your current Hexco results.
                </div>
            </div>  

            <div class="bg-gray-200 bg-opacity-25">
                <div class="p-6">
                    <div class="flex items-center">
                        <x-icon name="academic-cap" class="h-14 w-14 text-gray-200"/>
                    </div>
                    
                    <section name="exam_results" class="ml-12 shadow">
                        <div class="mt-2 text-sm text-gray-500">
                        @if($exam_results->count()>0)
                            <div class="text-center border-b">
                                <h2 class="border-b">MINISTRY OF HIGHER AND TERTIARY EDUCATION, SCIENCE AND TECHNOLOGY DEVELOPMENT</h2>
                                <p>HIGHER EDUCATION EXAMINATIONS COUNCIL</p>
                                <p>(HEXCO)</p>
                                <p>INDIVIDUAL STATEMENT OF RESULTS</p>
                            </div>
                            <div class="my-2 w-1/2">
                                <p class="flex justify-between"><span>CANDIDATE NUMBER</span><span>:{{$exam_results[0]->candidate_number}}</span></p>
                                <p class="flex justify-between"><span>COMMENT</span><span>:{{$exam_results[0]->comment}}</span></p>
                                <p class="flex justify-between"><span>SURNAME</span><span>:{{$exam_results[0]->surname}}</span></p>
                                <p class="flex justify-between"><span>FIRST NAMES</span><span>:{{$exam_results[0]->names}}</span></p>
                                <p class="flex justify-between"><span>INSTITUTION NAME</span><span>:Harare Polytechnic</span></p>
                                <p class="flex justify-between"><span>COURSE LEVEL</span><span></span></p>
                                <p class="flex justify-between"><span>COURSE TITLE</span><span>:{{$exam_results[0]->discipline}}</span></p>
                            </div>
                            <div class="bg-orange grid grid-cols-4 ">
                                <div>PAPER No.</div>
                                <div>APPROVED SUBJECT TITLES</div>
                                <div>GRADE</div>
                                <div>Date</div>
                            @foreach($exam_results as $exam_result)
                                <div>{{$exam_result->subject_code}}</div>
                                <div>{{$exam_result->subject}}</div>
                                <div>{{$exam_result->grade}}</div>
                                <div>{{$exam_result->session}}</div>
                                
                            @endforeach                                
                            </div>


                        @else
                        <p>hapana chakaipa</p>
                        @endif
                        </div>
                </section>
                    



                </div>                     
        </div>
    </div>        
</x-app-layout>  
</div>