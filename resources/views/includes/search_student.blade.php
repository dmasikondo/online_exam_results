<div class="w-7/10 mx-auto shadow-md rounded-md p-4 bg-white">
      <div class="flex justify-end mb-3 text-indigo-600 gap-1">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
        </svg>
        <span class="text-xs text-indigo-600">Search for the student using different criteria</span>
      </div>
    <form action="/dashboard/fees-clearances">
      <div class="flex gap-2 flex-col md:flex-row center">
        <div class="relative flex-1">
          <select  id="department" name="department" type="text" class="peer h-12 w-full border border-1.5 rounded-md border-gray-300 text-gray-900 placeholder-transparent focus:outline-none focus:border-indigo-600 focus:border-2 p-3" placeholder="Select a Department"/>
          {{-- <div class="max-h-12 overflow-auto" > --}}
            <option value="" class="hover:bg-indigo-100">All: arranged By Hexco Disciplines</option>
          @foreach($departments as $department)
            <option value="{{$department->discipline}}">{{$department->discipline}}</option>
          @endforeach
         {{--  </div> --}}

          </select>
          <label for="department" class="absolute left-2 px-1 -top-2.5 bg-white text-indigo-600 text-sm transition-all peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-900 peer-placeholder-shown:top-2 peer-focus:-top-2.5 peer-focus:text-indigo-600 peer-focus:text-sm">Department</label>
          
         {{--  <div class="absolute right-0 top-0 mt-2 mr-2">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M6 18L18 6M6 6l12 12" />
            </svg>
          </div> --}}
        </div>
       {{--  <div class="relative self-center">
          <svg xmlns="http://www.w3.org/2000/svg" class="mt-2 h-6 w-6 text-indigo-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
          </svg>
        </div> --}}
        <div class="relative flex-1">
          <input id="name" name="name" type="text" class="peer h-10 w-full border border-1.5 rounded-md border-gray-300 text-gray-900 placeholder-transparent focus:outline-none focus:border-indigo-600 focus:border-2 p-3" placeholder="Student Name" value="{{request('name')}}" />
          <label for="name" class="absolute left-2 px-1 -top-2.5 bg-white text-indigo-600 text-sm transition-all peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-900 peer-placeholder-shown:top-2 peer-focus:-top-2.5 peer-focus:text-indigo-600 peer-focus:text-sm">Student's Name</label>
          <div class="absolute right-0 top-0 mt-2 mr-2">
            <x-icon name="user" class="h-6 w-6 text-indigo-600 hidden md:block" stroke-width="1"/>
          </div>
        </div>
        <div class="relative flex-1">
          <input id="national_id" value="{{request('nat_id')}}" name="nat_id" type="text" class="peer h-10 w-full border border-1.5 rounded-md border-gray-300 text-gray-900 placeholder-transparent focus:outline-none focus:border-indigo-600 focus:border-2 py-4 px-8" 
            placeholder="National ID" 
            pattern="([0-9]{2}-[0-9]{5,7}[a-zA-Z]{1}[0-9]{2})" title="National ID must be of the format 99-999999Y99"
          />
          <label for="national_id" class="absolute left-2 px-1 -top-2.5 bg-white text-indigo-600 text-sm transition-all peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-900 peer-placeholder-shown:top-2 peer-focus:-top-2.5 peer-focus:text-indigo-600 peer-focus:text-sm">National ID No.</label>
          <div class="absolute right-0 top-0 mt-2 mr-2">
            <x-icon name="identification" class="h-6 w-6 text-indigo-600 hidden md:block" stroke-width="1"/>
          </div>
        </div>
   {{--      <div class="relative flex-1">
          <input id="candidate_no" name="cand_no" type="text" class="peer h-10 w-full border border-1.5 rounded-md border-gray-300 text-gray-900 placeholder-transparent focus:outline-none focus:border-indigo-600 focus:border-2 p-3" placeholder="Candidate No." />
          <label for="candidate_no" class="absolute left-2 px-1 -top-2.5 bg-white text-indigo-600 text-sm transition-all peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-900 peer-placeholder-shown:top-2 peer-focus:-top-2.5 peer-focus:text-indigo-600 peer-focus:text-sm">Candidate No.</label>
          <div class="absolute right-0 top-0 mt-2 mr-2">
            <x-icon name="user-circle" class="h-6 w-6 text-indigo-600" stroke-width="1"/>
          </div>
        </div> --}}
      </div>
      <div class="flex justify-center mt-6">
        <button class="bg-white text-blue-400  font-extrabold text-lg rounded-full px-6 py-3 hover:bg-indigo-100 ">Search</button>
      </div>
    </form>

  </div>