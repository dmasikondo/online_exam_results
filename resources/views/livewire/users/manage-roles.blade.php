<div>
    <x-modal wire:model="show">   
        <!-- content -->
      <x-slot name="title">
        Assign new user roles to: {{$surname}}  {{$first_name}}
      </x-slot>
      <div class="m-4 p-4">
         <div class="md:col-span-2 xl:col-span-1">            
            <x-session-warning/>
            <x-session-message/>
            <div class="rounded bg-indigo-500 p-3">
              <div class="flex justify-between py-1 text-white">
                <h3 class="text-sm font-semibold overflow-auto">  {{$surname}}  {{$first_name}}</h3>
                <p class="uppercase text-sm">  {{$email}}</p>
              </div>
              <div class="text-sm text-black dark:text-gray-50 mt-2">
                <div class="bg-white  p-2 rounded mt-1 border-b border-indigo-100 text-lg font-semibold">  
                    @if(count($listUserRoles)>0)
                        @foreach($listUserRoles as $role)
                            {{$role->name}}
                        @endforeach
                    @else
                        {{$surname}}  {{$first_name}} has no Member of Staff Role
                    @endif
                </div>
                <div class="bg-white  p-2 rounded mt-1 border-b border-indigo-100 ">
                  Registered
                  <div class="text-gray-500  mt-2 ml-2 flex justify-between items-start">
                    <span class="text-xs flex items-center">
                      <svg class="h-4 fill-current mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50"><path d="M11 4c-3.855 0-7 3.145-7 7v28c0 3.855 3.145 7 7 7h28c3.855 0 7-3.145 7-7V11c0-3.855-3.145-7-7-7zm0 2h28c2.773 0 5 2.227 5 5v28c0 2.773-2.227 5-5 5H11c-2.773 0-5-2.227-5-5V11c0-2.773 2.227-5 5-5zm25.234 9.832l-13.32 15.723-8.133-7.586-1.363 1.465 9.664 9.015 14.684-17.324z"></path></svg>
                      &nbsp;{{$created}}
                    </span>
                            Status: 
                     @if($status =='suspended and deactivated')
                        <span class="px-2 py-1 font-semibold leading-tight text-yellow-700 bg-yellow-100 rounded-full"> 
                           {{$status}}
                        </span>                         
                     @elseif($status =='deactivated')
                        <span class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full"> 
                            {{$status}}
                        </span>
                     @elseif($status =='suspended')
                        <span class="px-2 py-1 font-semibold leading-tight text-red-700 bg-red-100 rounded-full"> 
                            {{$status}}
                        </span>                        
                     @else
                        <span class="px-2 py-1 font-semibold leading-tight text-green-700 bg-green-100 rounded-full"> 
                            {{$status}}
                        </span>
                     @endif 
                                                  
                  </div>
                </div>
               
              </div>
            </div>
          </div> 
          <div class="flex justify-center pb-3 text-grey-dark my-4">
            <div class="text-center mr-3 border-r mx-8 pr-3">
<div>
    <form wire:submit.prevent="updateUserRoles" class="my-4" >
        <div class="my-4 relative">
            <p class="font-extrabold">Select the user roles</p>
            @foreach($availableUserRoles as $role)
                @if($listUserRoles->count()>0)
                    {{-- <input type="checkbox" wire:model="roles" wire:change="roleSelected" value="{{$role->id}}" {{$listUserRoles[0]['name']==$role->name? "checked='checked'":''}}> --}}

                    <input type="checkbox" wire:model="roles" wire:change="roleSelected" value="{{$role->id}}" {{$listUserRoles[0]['name']==$role->name? 'checked':''}}>  
                    {{-- {{dd($listUserRoles)}} --}}
                    <span class="{{$listUserRoles[0]['name']==$role->name? 'text-green-400':''}}">{{$role->name}}</span> 
                @else
                    <input type="checkbox"  wire:change="roleSelected" wire:model.defer="roles", value="{{$role->id}}"}}>
                    <span>{{$role->name}}</span>           
                @endif 
            @endforeach
        </div>

    {{-- @if($showDepartments) --}}
        <div class="my-4 relative">
            <x-form.select id="department" wire:model="department"  name="department" placeholder="Select the User's Department"> 
                <option value="" class="py-4 border-l-4 border-transparent hover:border-blue-500 "></option>
            @foreach($departments as $department)
                <option value="{{$department->id}}" @if($department->id=='17')selected @endif
                    
                    >
                    {{$department->name}} {{$department->id}}
                {{--     @forelse($staff as $staf) 
                        {{$staf->id}}
                    @empty --}}
                    {{-- @endforelse --}}
                </option>
               {{--  <option value="{{$role->name}}" {{request('role')== $role->name? 'selected':''}} >{{$role->name}}</option> --}}
            @endforeach
            </x-form.select>
            <x-form.label for="department">Select the User's Department</x-form.label>             
            <div class="absolute right-0 top-0 mt-2 mr-2">
                <x-icon name="clipboard-list" class="hidden lg:block h-6 w-6 text-indigo-600" stroke-width="1"/>                      
            </div>
            <p class="text-red-900 italic text-sm">@error('department') {{$message}} @enderror</p>                    
        </div> 
     {{-- @endif        --}}
       
        
        <p>
        <button type="submit" class="inline px-4 py-3 rounded-full font-bold text-white bg-indigo-300 hover:bg-gray-200 cursor-pointer" wire:click="updateUserRoles">  Update User Roles
        </button>   
           
        </p>
    </form>

    </div>                
</div>
</div>
{{--         <div class="flex justify-center pb-3 text-grey-dark my-4">
          <div class="text-center mr-3 border-r mx-8 pr-3">
            <h2></h2>
            <button class="font-semibold text-red-700" @click="show = false">Cancel</button>
                               
          </div>
          <div class="ml-16 text-center">
            <h2></h2>
        @if($showSuspendUserBtn)
            <button class="font-semibold text-green-500" wire:click="suspendUser" wire:loading.remove wire:target="suspendUser">
                Suspend User
            </button>
        @endif
                  <span wire:loading wire:target="suspendUser">
                    Suspending ...
                  </span> 

        @if(!$showSuspendUserBtn)
            <button class="font-semibold text-green-500" wire:click="unsuspendUser" wire:loading.remove wire:target="unsuspendUser">
                Unuspend User
            </button>
        @endif
                  <span wire:loading wire:target="unsuspendUser">
                    Unsuspending ...
                  </span>                              
          </div>
        </div>  --}}       
                                             

      </div>
  </x-modal>
</div>
