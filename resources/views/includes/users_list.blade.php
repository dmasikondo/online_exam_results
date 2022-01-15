<!-- .Users Table --> 
      @if($users->count()>0)  
              <h2 class="my-4"> {{$users->links()}}</h2>         	
              <table class="w-full">
                <thead>
                  <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b">
                    <th class="px-4 py-3">Name</th>
                    <th class="px-4 py-3">Email</th>
                    <th class="px-4 py-3">Role</th>
                    <th class="px-4 py-3">Dept</th>
                    <th class="px-4 py-3">Status</th>
                  </tr>
                </thead>
                <tbody class="bg-white divide-y dark:divide-gray-700 dark:bg-gray-800">
               @foreach($users as $user)
                  <tr class="bg-gray-50">
                    <td class="px-4 py-3">
                      <div class="flex items-center text-sm">
                        <div class="relative hidden w-8 h-8 mr-3 rounded-full md:block bg-gray-800 border-1">
                        
                          <div class="absolute inset-0 rounded-full shadow-inner" aria-hidden="true">
                              <img class="rounded-full w-8" src="{{$user->profile_photo_url }}" />
                          </div>
                        </div>
                        <div>
                        <a href="/users/{{$user->slug}}" class="text-blue-400 hover:text-gray-400">
                          <p class="font-semibold">
                            {{$user['second_name']}} {{$user->first_name}} 
                       @cannot('updateSelf',$user, Auth::user())
                          (Me)
                       @endcannot
                          </p>
                          <p class="text-xs text-gray-600 dark:text-gray-400">Created 3 days ago</p>
                        </a>

                        </div>
                      </div>
                    </td>
                    <td class="px-4 py-3 text-sm">
                      {{$user->email}}
                    </td>
                    <td class="px-4 py-3 text-sm">
                      @foreach($user->roles as $role)
                        <x-link href="/users?role={{$role->name}}" class="text-blue-400">{{$role->name}}</x-link>                      
                      @endforeach
                      @if($user->isStudent()) 
                       <x-link href="/users-students">Student</x-link>
                      @endif

                  @can('update',$user, Auth::user())
                      <span class="px-2 py-1 font-semibold leading-tight text-indigo-700 rounded-full cursor-pointer hover:bg-indigo-100" 
                      onclick="window.livewire.emitTo('users.manage-roles','editUserRole','{{$user->slug}}')">
                        <x-icon name="edit" class="inline w-4 h-4"/>
                      </span>  
                  @endcan                    
                    </td>
                    <td class="px-4 py-3 text-sm">
                      @foreach($user->staff as $staff)
                          {{$staff->department->name}}
                      @endforeach                    
                    </td>                    
                    <td class="px-4 py-3 text-xs">
     {{-- Display user status--}}
             
                    @include('includes.user_status') 
                  @can('updateSelf',$user, Auth::user())
                      <button onclick="window.livewire.emitTo('users.suspend-user','suspendUserAccount','{{$user->slug}}')" 
                        class="text-sm mx-2 py-1 px-2 rounded-lg bg-indigo-500 text-white hover:text-indigo-500 hover:bg-white hover:border-1 hover:border-indigo-500">
                        <small>{{$user->is_suspended? 'Unsuspend User': 'Suspend User'}}</small>
                     </button> 
                  @endcan                                     
            

       {{-- ./ Display user status--}}              
                      
                      <p class="text-xs text-gray-600 dark:text-gray-400">
                      	{{-- {{!is_null($student->user->fees[0]->cleared_at)? $student->user->fees[0]->cleared_at->diffForHumans():''}} --}}
                      </p>
                    </td>
                   
                  </tr>
                @endforeach              
                </tbody>
              </table>

              <h2 class="my-4"> {{$users->links()}}</h2> 
        @else
            <h2 class="my-4 px-4 font-semibold text-xl text-center text-gray-400  bg-white inline-block self-center leading-loose rounded-lg">
              There are no requested registered users yet
            </h2>
        @endif