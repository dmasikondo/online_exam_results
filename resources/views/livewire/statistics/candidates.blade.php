<div class="h-full mt-14 mb-10">     
      <!-- Stats Filters -->
      <div class="relative lg:flex lg:inline-flex items-center bg-gradient-to-br from-yellow-50 via-white to-indigo-50 border border-1 border-black mt-8">
          <x-articles.dropdown> 
               <x-slot name="title">
                  @if(isset(request()->intake))
                      {{request()->intake}}
                  @else
                      Current
                  @endif
               </x-slot>
              <x-articles.dropdown-item  href="/statistics">Current</x-articles.dropdown-item>
            @foreach($intakes as $intake)
              <x-articles.dropdown-item  href="/statistics?intake={{$intake->label}}">
                  {{$intake->label}}
              </x-articles.dropdown-item> 
            @endforeach                                 
          </x-articles.dropdown>   
      </div>
      <!-- Stats Filters -->

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 p-4 gap-4">
<!-- Statistics Cards -->
        <x-statistics-card>
            <x-slot name="symbol">user-group</x-slot>
            <x-slot name="number">{{$totalCandidates}}</x-slot>
            <x-slot name="title">Candidature</x-slot>
        </x-statistics-card>       

        <x-statistics-card>
            <x-slot name="symbol">status-offline</x-slot>
            <x-slot name="number">{{$offLineClearedStudents}}</x-slot>
            <x-slot name="title">Accounts: Offline Cleared</x-slot>
        </x-statistics-card>

        <x-statistics-card>
            <x-slot name="symbol">status-online</x-slot>
            <x-slot name="number">{{$onLineClearedStudents}}</x-slot>
            <x-slot name="title">Accounts: Online Processed Requests</x-slot>
        </x-statistics-card>        

        <x-statistics-card>
            <x-slot name="symbol">users</x-slot>
            <x-slot name="number">{{$studentsRegisteredOnSystem}}</x-slot>
            <x-slot name="title">Students Registered on the System</x-slot>
        </x-statistics-card> 

@if(Auth::user()->hasRole('exams') || Auth::user()->hasRole('manager') || (Auth::user()->hasRole('hod') && Auth::user()->belongsTodepartmentOf('IT Unit')) || Auth::user()->hasRole('superadmin')) 
        <x-statistics-card>
            <x-slot name="symbol">collection</x-slot>
            <x-slot name="number">{{$departments}}</x-slot>
            <x-slot name="title">Hexco Disciplines</x-slot>
        </x-statistics-card>      
@endif 

@if(Auth::user()->hasRole('hod') && Auth::user()->belongsTodepartmentOf('IT Unit') || Auth::user()->hasRole('superadmin'))
        <x-statistics-card>
            <x-slot name="symbol">identification</x-slot>
            <x-slot name="number">{{$staffUsers}}</x-slot>
            <x-slot name="title">Members of Staff Users</x-slot>
        </x-statistics-card> 
        <x-statistics-card>
            <x-slot name="symbol">emoji-happy</x-slot>
            <x-slot name="number">{{$active_users}}</x-slot>
            <x-slot name="title">Active Users</x-slot>
        </x-statistics-card>  
        <x-statistics-card>
            <x-slot name="symbol">mail-open</x-slot>
            <x-slot name="number">{{$usersWithUnverifiedEmail}}</x-slot>
            <x-slot name="title">Users with unverified email</x-slot>
        </x-statistics-card>
        <x-statistics-card>
            <x-slot name="symbol">emoji-sad</x-slot>
            <x-slot name="number">{{$inactive_users}}</x-slot>
            <x-slot name="title">Inactive Users</x-slot>
        </x-statistics-card>
        <x-statistics-card>
            <x-slot name="symbol">lock-closed</x-slot>
            <x-slot name="number">{{$active_users}}</x-slot>
            <x-slot name="title">Suspended Users</x-slot>
        </x-statistics-card>  
        <x-statistics-card>
            <x-slot name="symbol">users</x-slot>
            <x-slot name="number">{{$itunit_users}}</x-slot>
            <x-slot name="title">IT Unit</x-slot>
        </x-statistics-card> 
        <x-statistics-card>
            <x-slot name="symbol">users</x-slot>
            <x-slot name="number">{{$accounts_users}}</x-slot>
            <x-slot name="title">Accounts Dept</x-slot>
        </x-statistics-card>  
        <x-statistics-card>
            <x-slot name="symbol">users</x-slot>
            <x-slot name="number">{{$admin_office_users}}</x-slot>
            <x-slot name="title">Admin Office</x-slot>
        </x-statistics-card>  
        <x-statistics-card>
            <x-slot name="symbol">users</x-slot>
            <x-slot name="number">{{$warden_users}}</x-slot>
            <x-slot name="title">Wardens</x-slot>
        </x-statistics-card>  
        <x-statistics-card>
            <x-slot name="symbol">users</x-slot>
            <x-slot name="number">{{$library_users}}</x-slot>
            <x-slot name="title">Library</x-slot>
        </x-statistics-card> 
        <x-statistics-card>
            <x-slot name="symbol">users</x-slot>
            <x-slot name="number">{{$hod_users}}</x-slot>
            <x-slot name="title">HODs</x-slot>
        </x-statistics-card> 
        <x-statistics-card>
            <x-slot name="symbol">users</x-slot>
            <x-slot name="number">{{$manager_users}}</x-slot>
            <x-slot name="title">Principal's office</x-slot>
        </x-statistics-card>                                                           
@endif

    </div>
</div>
   
