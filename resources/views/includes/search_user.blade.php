<div class="w-7/10 mx-auto shadow-md rounded-md p-4 bg-white">
      <div class="flex justify-end mb-3 text-indigo-600 gap-1">
{{-- records per page --}}
        <form action="/users" method="get">
          <span class="text-xs text-indigo-600">No. of recods per page</span>
          <x-form.select  id="perPage" name="perPage" placeholder="Records Per Page" title="Records per page" 
            class="h-6 text-xs p-1 border-1 focus:border-1" onchange="this.form.submit()">
            <option value="" class="hover:bg-indigo-100">20</option>          
            <option value="10" {{request('perPage')== 10? 'selected':''}} >10</option>
            <option value="20" {{request('perPage')== 20? 'selected':''}} >20</option>
            <option value="50" {{request('perPage')== 50? 'selected':''}} >50</option>
            <option value="80" {{request('perPage')== 80? 'selected':''}} >80</option>
            <option value="100" {{request('perPage')== 100? 'selected':''}}>100</option>          
          </x-form.select>          
        </form>
{{-- ./records per page --}}        
        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mt-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
        </svg>
        <span class="text-xs text-indigo-600 mt-2">Search for the user using different criteria</span>
      </div>
    <form action="/users">
      <div class="flex gap-2 flex-col lg:flex-row center space-y-4">
        <div class="relative flex-1 mt-4">          
          <x-form.select  id="role" name="role" placeholder="Select a User Role" title="Role">
            <option value="" class="hover:bg-indigo-100">All: Roles</option>
          @foreach($roles as $role)
            <option value="{{$role->name}}" {{request('role')== $role->name? 'selected':''}} >{{$role->name}}</option>
          @endforeach
          </x-form.select>
          <x-form.label for="role">User Role</x-form.label>
          
        </div>
     
        <div class="relative flex-1">
          <x-form.input id="email" name="email" type="email"  placeholder="email" value="{{request('email')}}"/>
          <x-form.label for="email">Email</x-form.label>
          <div class="absolute right-0 top-0 mt-2 mr-2">
            <x-icon name="mail-open" class="h-6 w-6 text-indigo-600 hidden md:block" stroke-width="1"/>            
          </div>
        </div>
        <div class="relative flex-1">
          <x-form.input id="surname" name="surname" type="text" placeholder="Surname" value="{{request('surname')}}"/>
          <x-form.label for="surname">Surname</x-form.label> 
          <div class="absolute right-0 top-0 mt-2 mr-2">
            <x-icon name="users" class="h-6 w-6 text-indigo-600 hidden md:block" stroke-width="1"/>
          </div>
        </div>        
        <div class="relative flex-1">
          <x-form.input id="first_name" value="{{request('first_name')}}" name="first_name" type="text" placeholder="First Name"/>
          <x-form.label for="first_name">First Name</x-form.label> 
          <div class="absolute right-0 top-0 mt-2 mr-2">
            <x-icon name="user" class="h-6 w-6 text-indigo-600 hidden md:block" stroke-width="1"/>
          </div>
        </div>

      </div>
      <div class="flex justify-center mt-6">
        <button class="bg-white text-indigo-400  font-extrabold text-lg rounded-full px-6 py-3 hover:bg-indigo-100 ">Search</button>
      </div>
    </form>

  </div>