<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-indigo-200 leading-tight">
            {{ $user->first_name }} {{ $user->surname }} 
        </h2>
    </x-slot>
    @livewire('users.suspend-user')
    @livewire('users.manage-roles')
    <div class="mt-4 mx-4">
      <div class="max-w-7xl overflow-hidden rounded-lg shadow-xs px-4">
            <x-session-warning/>
            <x-session-message/>
          <div class="flex flex-wrap justify-center">
            <div class="w-full lg:w-3/12 px-4 lg:order-2 flex justify-center">
              <div class="relative">
                <img alt="..." src="https://demos.creative-tim.com/notus-js/assets/img/team-2-800x800.jpg" class="shadow-xl rounded-full h-auto align-middle border-none absolute -m-16 -ml-20 lg:-ml-16 max-w-150-px">
              </div>
            </div>
            <div class="w-full lg:w-4/12 px-4 lg:order-3 lg:text-right lg:self-center">
              <div class="py-6 px-3 mt-32 sm:mt-0">
        @can('update',$user, Auth::user())
                <button onclick="window.livewire.emitTo('users.suspend-user','suspendUserAccount','{{$user->slug}}')"
                  class="bg-indigo-600 uppercase text-white font-bold hover:shadow-md hover:bg-indigo-200 shadow text-xs px-4 py-2 rounded outline-none focus:outline-none sm:mr-2 mb-1 ease-linear transition-all duration-150" type="button">
                  {{$user->is_suspended? 'Unsuspend': 'Suspend'}}
                </button>
         @endcan       
              </div>
            </div>
        
            <div class="w-full lg:w-4/12 px-4 lg:order-1">
              <div class="flex justify-center py-4 lg:pt-4 pt-8">
                <div class="mr-4 p-3 text-center">
                  <span class="text-xl font-bold block uppercase tracking-wide text-blueGray-600">{{-- {{$user->articles->count()}} --}}</span>
                  <span class="text-sm text-blueGray-400">{{-- Articles --}}</span>
                </div>
              </div>
            </div>
          </div>
          <div class="text-center mt-12">
            <h3 class="text-4xl font-semibold leading-normal mb-2 text-blueGray-700 mb-2">
              {{$user->first_name}} {{$user->second_name}}
            </h3>
            <div class="text-sm leading-normal mt-0 mb-2 text-gray-400 font-bold uppercase">
              <x-icon name="mail-open" class="h-6 w-6"/>
              {{$user->email}}, 
            @if(!is_null($user->email_verified_at))
              Verified
              <x-icon name="check-circle" class="inline w-4 h-4 text-indigo-700"/>
            @else
              Not Verified
              <x-icon name="exclamation" class="inline w-4 h-4 text-red-700" />           
            @endif
            </div>
            <div class="mb-2 text-gray-400 mt-10">
              <x-icon name="clock" class="h-6 w-6 inline"/>
              Account Created - {{$user->created_at->diffForHumans()}}
            </div>
            <div class="mb-2 text-blueGray-600">
              <i class="fas fa-university mr-2 text-lg text-blueGray-400"></i>
                @if($user->isStudent()) 
                 Student |
                @endif              
              @foreach($user->roles as $role)
                {{$role->name}} |
              @endforeach

              @foreach($user->staff as $staff)
                  {{$staff->department->name}} Dept
              @endforeach               
            </div>
          </div>
          <div class="mt-10 py-10 border-t border-blueGray-200 text-center">
            <div class="flex flex-wrap justify-center">
              <div class="w-full lg:w-9/12 px-4">
                <p class="mb-4 text-lg leading-relaxed text-blueGray-700">
                  Here you can change the user's assigned roles. The Exams can view all exam results. The accounts can approve payment status of students but can not view the exam results whilst the Superadmin can manage the user accounts. The Hod who belongs to the department of IT Unit has all the rights on the system.
                </p>
                <p>User Status: 
                  @include('includes.user_status')  
                </p>
              @can('update',$user, Auth::user())
                <p class="mt-4">
                  <button onclick="window.livewire.emitTo('users.manage-roles','editUserRole','{{$user->slug}}')" class="font-normal text-indigo-500">Assign Roles</button>
                </p>
              @endcan
                
              </div>
            </div>
          </div>                               
        
     </div> 
    </div>   
</x-app-layout>