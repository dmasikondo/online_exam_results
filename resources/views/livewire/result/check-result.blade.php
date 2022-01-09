<div class="w-7/10 mx-auto shadow-md rounded-md p-4 bg-white no-print">
      <div class="flex justify-end mb-3 text-indigo-600 gap-1">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
        </svg>
        <span class="text-xs text-indigo-600">Search your exam results based on exam session and Candidate No. used</span>
      </div>
       <form method="post" action="/my-results">
         @csrf
      <div class="flex gap-2 flex-col lg:flex-row center space-y-4">
        
        <div class="relative flex-1 mt-4">          
          <x-form.select  id="exam_session" name="exam_session" placeholder="Select Exam Session" title="Exam Session">
            <option value="" class="hover:bg-indigo-100">Exam Session</option>
          @foreach($intakes as $intake)
            <option value="{{$intake->id}}"{{ (collect(old('intake'))->contains($intake->id)) ? 'selected':'' }}>{{$intake->label}}</option>
          @endforeach
          </x-form.select>
          <x-form.label for="exam_session">Exam Session</x-form.label> 
            <p>
                @error('exam_session')
                    <span class="text-red-500 text-sm italic">{{ $message }}</span>
                @enderror                            
            </p>                    
        </div>
     
       

        <div class="relative flex-1">
          <x-form.input id="candidate_number" value="{{old('candidate_number')}}" name="candidate_number" type="text" placeholder="Candidate No. used"
          />
          <x-form.label for="candidate_number">Candidate No. used</x-form.label> 
          <div class="absolute right-0 top-0 mt-2 mr-2">
            <x-icon name="user" class="h-6 w-6 text-indigo-600 hidden md:block" stroke-width="1"/>
          </div>
            <p>
                @error('candidate_number')
                    <span class="text-red-500 text-sm italic">{{ $message }}</span>
                @enderror                            
            </p>          
        </div>

      </div>
      <div class="flex justify-center mt-6">
        <button class="bg-white text-indigo-400  font-extrabold text-lg rounded-full px-6 py-3 hover:bg-indigo-100 ">Search</button>
      </div>
    </form>

  </div>


                          