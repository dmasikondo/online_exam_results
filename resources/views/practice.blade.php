<x-app-layout>
	<div>
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
	</div>
</x-app-layout>