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

             
              @include('includes.search_candidate_with_award')              
              <div class="my-2 px-2 no-print">
                {{$candidates->links()}}
              </div>                                
  <!-- .candidates clearance Table --> 
      @if($candidates->count()>0)   
                <div class="no-print">
                    <input type="button" onclick="printableDiv('printableArea')" value="Print Offer Letter(s)!" />

                </div>        
              <table class="w-full no-print">
                <thead>
                  <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b">
                    <th class="px-4 py-3">Candidate</th>                   
                    <th class="px-4 py-3">Level</th>   
                    <th class="px-4 py-3">Discipline</th>                  
                    <th class="px-4 py-3">Comment</th>                    
                    <th class="px-4 py-3">Exam Session</th>
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
                    <td class="px-4 py-3 text-xs">{{$candidate->intake->title}} 
                    {{--     
                    @foreach($candidate->subjectResults() as $exam_results)
                        {{$exam_results->subject}}  --}}
                    {{-- @endforeach --}}
                    </td>
         {{-- $exam_results = Result::where('users_id',$result->users_id)
                                ->where('intake_id',$result->intake_id)
                                ->get();   --}}                
                  </tr> 
                 {{--  @endforeach  --}}        
                </tbody>
              </table>
            <div class="hidden">

                        
                    @include('transcript.transcript2')
                
            </div> 
            @endforeach              

        @else
            <h2 class="my-4 px-4 font-semibold text-xl text-center text-gray-400  bg-white inline-block self-center leading-loose rounded-lg">
              No candidate exists in this section's criteria
            </h2>
        @endif
              <div class="my-2 px-2">
                {{$candidates->links()}}
              </div>
              
            </div> 


 <script>
function printableDiv(printableAreaDivId) {
     var printContents = document.getElementById('printableArea').innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>
</x-app-layout>