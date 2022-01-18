<div class="w-7/10 mx-auto shadow-md rounded-md p-4 bg-white">
  {{-- exam session filter --}}
      <form action="/dashboard/fees-clearances">
      <div class="flex justify-end mb-3 text-indigo-600 gap-1">
          <span class="text-xs text-indigo-600">Filter Students by Exam Session</span>
          <x-form.select  id="exam_session" name="exam_session" placeholder="Exam Session" title="Exam Session" 
            class="h-6 text-xs p-1 border-1 focus:border-1" onchange="this.form.submit()">
            <option value="" class="hover:bg-indigo-100">All Sessions</option>  
          @foreach($intakes as $intake)        
            <option value="{{$intake->id}}" {{request('exam_session')== $intake->id? 'selected':''}} >{{$intake->label}}</option> 
          @endforeach       
          </x-form.select>          
        {{-- </form> --}}
{{-- ./exam session filter --}}         
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mt-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
        </svg>
        <span class="text-xs text-indigo-600 mt-2">Search for the student using different criteria</span>
      </div>
    
      <div class="flex gap-2 flex-col md:flex-row center">
        <div class="relative flex-1">
          <x-form.select  id="department" name="department" placeholder="Select a Department" title="Role">
            <option value="" class="hover:bg-indigo-100">All: arranged By Hexco Disciplines</option>
          @foreach($departments as $department)
            <option value="{{$department->discipline}}"  >{{$department->discipline}}</option>
          @endforeach
          </x-form.select>
          <x-form.label for="department">Department</x-form.label>
        </div>

        <div class="relative flex-1">
          <x-form.input id="second_name" name="second_name" type="text"  placeholder="Student Surname" value="{{request('second_name')}}"/>
          <x-form.label for="second_name">Student's Surname</x-form.label>
          <div class="absolute right-0 top-0 mt-2 mr-2">
            <x-icon name="users" class="h-6 w-6 text-indigo-600 hidden md:block" stroke-width="1"/>            
          </div>
        </div>

        <div class="relative flex-1">
          <x-form.input id="first_name" name="first_name" type="text"  placeholder="Student Surname" value="{{request('first_name')}}"/>
          <x-form.label for="first_name">Student's First Name(s)</x-form.label>
          <div class="absolute right-0 top-0 mt-2 mr-2">
            <x-icon name="user" class="h-6 w-6 text-indigo-600 hidden md:block" stroke-width="1"/>            
          </div>
        </div> 
      </div>

      <div class="flex gap-2 flex-col md:flex-row center mt-4">       

        <div class="relative flex-1">
          <x-form.input id="national_id" name="nat_id" type="text"  placeholder="National ID" 
            value="{{request('nat_id')}}"
            pattern="([0-9]{2}-[0-9]{5,7}[a-zA-Z]{1}[0-9]{2})"
            title="National ID must be of the format 99-999999Y99"
          />
          <x-form.label for="national_id">National ID No.</x-form.label>
          <div class="absolute right-0 top-0 mt-2 mr-2">
            <x-icon name="identification" class="h-6 w-6 text-indigo-600 hidden md:block" stroke-width="1"/>            
          </div>
        </div>

        <div class="relative flex-1">
          <x-form.select  id="clearance_status" name="clearance_status" placeholder="Select a Department" title="Role">
            <option value="" class="hover:bg-indigo-100">All: criteria</option>
            <option value="cleared" class="hover:bg-indigo-100">Cleared</option>
            <option value="pending" class="hover:bg-indigo-100">Pending</option>
            <option value="declined" class="hover:bg-indigo-100">Declined</option>
            <option value="not_cleared" class="hover:bg-indigo-100">Not Cleared</option>
          </x-form.select>
          <x-form.label for="clearance_status">Clearance Status</x-form.label>
        </div>        
      </div>
      <div class="flex justify-center mt-6">
        <button type="submit" class="bg-indigo-300 text-white  font-extrabold text-lg rounded-full px-6 py-3 hover:bg-indigo-100 hover:text-indigo-900 cursor-pointer">
          Search
      </button>
      </div>
    </form>

  </div>

