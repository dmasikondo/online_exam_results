<x-app-layout>
{{-- 	<div>
<div class="w-full flex justify-center bg-gray-200 h-screen items-center">
  <div class="rounded-xl bg-white w-full md:w-2/3 lg:w-1/3">
    <div class="px-5 py-3 flex items-center justify-between text-blue-400 border-b">
      <i class="fas fa-times text-xl"></i>

      <p class="inline hover:bg-indigo-100 px-4 py-3 rounded-full font-bold cursor-pointer">Send Proof of Payment</p>
    </div>

    <div class="flex p-4">
      <div>
        <img class="rounded-full w-14" src="https://pbs.twimg.com/profile_images/1367267802940375042/H4JDd6aC_400x400.jpg" />
      </div>

      <div class="ml-3 flex flex-col w-full">
        <textarea placeholder="You may leave this section blank" class="w-full text-xl resize-none outline-none h-32"></textarea>

        <div class="cursor-pointer text-indigo-400 -ml-4">
          <p class="inline hover:bg-indigo-100 px-4 py-3 rounded-full"><i class="fas fa-globe"></i> In pdf or picture format</p>
        </div>
      </div>
    </div>

    <div class="flex items-center text-indigo-400 justify-between py-6 px-4 border-t">
      <div class="flex text-2xl pl-12">
        <div class="flex items-center justify-center p-3 hover:bg-indigo-100 rounded-full cursor-pointer">
          <i class="fas fa-image"></i>
        </div>

        <div class="flex items-center justify-center p-3 hover:bg-indigo-100 rounded-full cursor-pointer">
          <i class="fas fa-poll-h"></i>
        </div>

        <div class="flex items-center justify-center p-3 hover:bg-indigo-100 rounded-full cursor-pointer">
          <i class="fas fa-smile"></i>
        </div>

        <div class="flex items-center justify-center p-3 hover:bg-indigo-100 rounded-full cursor-pointer">
          <i class="fas fa-calendar-alt"></i>
        </div>
      </div>

      <div>

        <p class="inline px-4 py-3 rounded-full font-bold text-white bg-indigo-300 cursor-pointer">Tweet</p>
      </div>
    </div>
  </div>
</div>
	</div> --}}


<div class="w-7/10 mx-auto shadow-md rounded-md p-4 bg-white">
  <div class="flex gap-2 flex-col md:flex-row center">
        <div class="relative flex-1 sticky top-0">
          <input id="name" name="name" type="text" class="peer h-10 w-full border border-1.5 rounded-md border-gray-300 text-gray-900 placeholder-transparent focus:outline-none focus:border-indigo-600 focus:border-2 p-3" placeholder="Student Name" value="" />
          <label for="name" class="absolute left-2 px-1 -top-2.5 bg-white text-indigo-600 text-sm transition-all peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-900 peer-placeholder-shown:top-2 peer-focus:-top-2.5 peer-focus:text-indigo-600 peer-focus:text-sm">Student's Name</label>
          <div class="absolute right-0 top-0 mt-2 mr-2">
            <x-icon name="user" class="h-6 w-6 text-indigo-600" stroke-width="1"/>
          </div>
        </div>
        <div class="relative flex-1">
          <input id="national_id" value="" name="nat_id" type="text" class="peer h-10 w-full border border-1.5 rounded-md border-gray-300 text-gray-900 placeholder-transparent focus:outline-none focus:border-indigo-600 focus:border-2 py-4 px-8" 
            placeholder="National ID" 
            pattern="{{-- ([0-9]{2}-[0-9]{5,7}[a-zA-Z]{1}[0-9]{2}) --}}" title="National ID must be of the format 99-999999Y99"
          />
          <label for="national_id" class="absolute left-2 px-1 -top-2.5 bg-white text-indigo-600 text-sm transition-all peer-placeholder-shown:text-base peer-placeholder-shown:text-gray-900 peer-placeholder-shown:top-2 peer-focus:-top-2.5 peer-focus:text-indigo-600 peer-focus:text-sm">National ID No.</label>
          <div class="absolute right-0 top-0 mt-2 mr-2">
            <x-icon name="identification" class="h-6 w-6 text-indigo-600" stroke-width="1"/>
          </div>
        </div>
  
</div>  
</x-app-layout>