<div class="w-7/10 mx-auto shadow-md rounded-md p-4 bg-white no-print">
  {{-- exam session filter --}}
      <form action="/transcript">
      <div class="flex justify-end mb-3 text-indigo-600 gap-1">
          <span class="text-xs text-indigo-600">Filter Candidates by Exam Session</span>
          <x-form.select  id="exam_session" name="exam_session" placeholder="Exam Session" title="Exam Session" 
            class="h-6 text-xs p-1 border-1 focus:border-1" {{-- onchange="this.form.submit()" --}}>
            <option value="" class="hover:bg-indigo-100">All Sessions</option>  
          @foreach($intakes as $intake)        
            <option value="{{$intake->id}}" {{request('exam_session')== $intake->id? 'selected':''}} >{{$intake->label}}</option> 
          @endforeach       
          </x-form.select>          
        {{-- </form> --}}
{{-- ./exam session filter --}}         
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 " fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
        </svg>
        <span class="text-xs text-indigo-600">Search for the Candidate using different criteria</span>
      </div>
    
      <div class="flex gap-2 flex-col md:flex-row center">
        <div class="relative flex-1">
          <x-form.select  id="department" name="department" placeholder="Select a Discipline" title="Role">
            <option value="" class="hover:bg-indigo-100">All Hexco Disciplines</option>
          @foreach($departments as $department)
            <option value="{{$department->discipline}}" {{request('department')== $department->discipline? 'selected':''}} >{{$department->discipline}}</option>
          @endforeach
          </x-form.select>
          <x-form.label for="department">Hexco Discipline</x-form.label>
        </div>

        <div class="relative flex-1">
          <x-form.input id="candidate" name="candidate" type="text"  placeholder="Candidate Surname"
            placeholder="Candidate Number" 
            pattern="([0-9]{7}[a-zA-Z]{1}[0-9]{5})" 
            title="The Candidate No. must be in the format 9999999X99999" 
            value="{{request('candidate')}}"/>
          <x-form.label for="candidate">Candidate Number</x-form.label>
          <div class="absolute right-0 top-0 mt-2 mr-2">
            <x-icon name="identification" class="h-6 w-6 text-indigo-600 hidden md:block" stroke-width="1"/>            
          </div>
        </div>
 
      </div>

      <div class="flex gap-2 flex-col md:flex-row center mt-4">       
        <div class="relative flex-1">
          <x-form.input id="second_name" name="second_name" type="text"  placeholder="Candidate Surname" value="{{request('second_name')}}"/>
          <x-form.label for="second_name">Candidate's Surname</x-form.label>
          <div class="absolute right-0 top-0 mt-2 mr-2">
            <x-icon name="users" class="h-6 w-6 text-indigo-600 hidden md:block" stroke-width="1"/>            
          </div>
        </div>

        <div class="relative flex-1">
          <x-form.input id="first_name" name="first_name" type="text"  placeholder="Candidate Surname" value="{{request('first_name')}}"/>
          <x-form.label for="first_name">Candidate's First Name(s)</x-form.label>
          <div class="absolute right-0 top-0 mt-2 mr-2">
            <x-icon name="user" class="h-6 w-6 text-indigo-600 hidden md:block" stroke-width="1"/>            
          </div>
        </div>        
      </div>

      <div class="flex gap-2 flex-col md:flex-row center mt-4">       
        <div class="relative flex-1">
          <x-form.select  id="level" name="level" placeholder="Level" title="Level">
            <option value="" class="hover:bg-indigo-100">All Levels</option>        
            <option value="nc" class="hover:bg-indigo-100" {{request('level')== 'nc'? 'selected':''}} disabled>NC</option>        
            <option value="nd" class="hover:bg-indigo-100" {{request('level')== 'nd'? 'selected':''}} disabled>ND</option>        
            <option value="hnd" class="hover:bg-indigo-100" {{request('level')== 'hnd'? 'selected':''}} disabled>HND</option>            
          </x-form.select> 
        </div>

        
      </div>

      <div class="flex justify-center mt-6">
        <button type="submit" class="bg-indigo-300 text-white  font-extrabold text-lg rounded-full px-6 py-3 hover:bg-indigo-100 hover:text-indigo-900 cursor-pointer">
          Search Candidates with Awards
      </button>
      </div>
    </form>

  </div>

