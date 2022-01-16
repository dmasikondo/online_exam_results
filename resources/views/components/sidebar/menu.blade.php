  <!-- Sidebar -->
  @auth
      <div class="no-print fixed flex flex-col sm:top-28 left-0 w-12 hover:w-64 md:w-64 bg-gradient-to-br from-yellow-50 via-white to-indigo-50 border border-black border-opacity-5 h-full text-white transition-all duration-300 {{-- border-none --}} z-10  sidebar opacity-75" style="top: 4em;">
        <div class=" {{-- overflow-x-hidden --}} flex flex-col justify-between {{-- flex-grow --}}">
          <ul class="flex flex-col py-4 space-y-1">
            <li class="px-5 hidden md:block">  
              <div class="flex flex-row items-center h-8">
                <div class="text-sm font-light tracking-wide text-gray-400 uppercase">
                    {{Auth::user()->isStudent()? 'Student': Auth::user()->roles->last()->name}}
                </div>

              </div>
            </li>
          <!-- Student -->
          @if(Auth::user()->isStudent())
            <li  class="@if(request()->routeIs('my-results')) bg-indigo-800 border-indigo-500 border-l-4 @endif">
              <x-sidebar.link-item href="/my-results" title="Home">
                <x-slot name='symbol'>
                  home
                </x-slot>
                Home
              </x-sidebar.link-item>
            </li>

            <li  class="@if(request()->routeIs('my-clearance')) bg-indigo-800 border-indigo-500 border-l-4 @endif">
              <x-sidebar.link-item href="/results/clearance/{{Auth::user()->slug}}" title="Fees Clearance">
                <x-slot name='symbol'>
                  currency-dollar
                </x-slot>
                Fees Clearance
              </x-sidebar.link-item>
            </li>           

            <li {{--  class="@if(request()->routeIs('my-clearance')) bg-indigo-800 @endif" --}}>
              <x-sidebar.link-item href="#" title="Exam Queries">
                <x-slot name='symbol'>
                  book-open
                </x-slot>
                Exam Queries
              </x-sidebar.link-item>
            </li>

          @endif            
          <!-- ./Student -->

         {{-- Accounts --}}
          @if((Auth::user()->hasRole('hod') && Auth::user()->belongsTodepartmentOf('accounts')) || Auth::user()->hasRole('accounts')) 
            <li  class="@if(request()->routeIs('fees-clearances') || request()->routeIs('fees-clearance') || request()->routeIs('dashboard')) bg-indigo-800 border-indigo-500 border-l-4 @endif">
              <x-sidebar.link-item href="/dashboard/fees-clearances" title="Fees Clearance">
                <x-slot name='symbol'>
                  home
                </x-slot>
                Home
              </x-sidebar.link-item>
            </li>

          @endif
        {{-- ./Accounts --}}

      {{-- exams --}}
          @if(Auth::user()->hasRole('hod') && Auth::user()->belongsTodepartmentOf('examinations') || Auth::user()->hasRole('exams'))  
            <li  class="@if(request()->routeIs('candidates')) bg-indigo-800 border-indigo-500 border-l-4 @endif">
              <x-sidebar.link-item href="/candidates" title="Home">
                <x-slot name='symbol'>
                  home
                </x-slot>
                Home
              </x-sidebar.link-item>
            </li> 

            <li>
              <x-sidebar.link-item href="#" title="Queries">
                <x-slot name='symbol'>
                  academic-cap
                </x-slot>
                Queries
              </x-sidebar.link-item>
            </li>        
        @endif            
      {{-- ./exams  --}} 

          {{-- ITU --}}

      @if(Auth::user()->hasRole('superadmin') || (Auth::user()->belongsTodepartmentOf('IT Unit') && Auth::user()->hasRole('hod')))
            <li>
              <x-sidebar.link-item href="/users/registration" title="Home">
                <x-slot name='symbol'>
                  home
                </x-slot>
                Home
              </x-sidebar.link-item>
            </li>

            <li  class="@if(request()->routeIs('user-registration')) bg-indigo-800 border-indigo-500 border-l-4 @endif">
              <x-sidebar.link-item href="/users/registration" title="Add User">
                <x-slot name='symbol'>
                  user-add
                </x-slot>
                Add User
              </x-sidebar.link-item>
            </li>

            <li  class="@if(request()->routeIs('users') 
             || request()->routeIs('user') || request()->routeIs('users-students')) bg-indigo-800 border-indigo-500 border-l-4 @endif">
              <x-sidebar.link-item href="/users" title="Show User(s)">
                <x-slot name='symbol'>
                  users
                </x-slot>
                Users
              </x-sidebar.link-item>
            </li>             

            <li  class="{{Request::is('results/upload-csv')? 'bg-indigo-800 border-indigo-500 border-l-4':''}}">
              <x-sidebar.link-item href="/results/upload-csv" title="Upload Exam Results">
                <x-slot name='symbol'>
                  identification
                </x-slot>
                Upload Exam Results
              </x-sidebar.link-item>
            </li> 

            <li >
              <x-sidebar.link-item href="https://github.com/dmasikondo/online_exam_results" target="_blank" title="Documentation">
                <x-slot name='symbol'>
                  book-open
                </x-slot>
                Documentation
              </x-sidebar.link-item>
            </li>            
        @endif
      {{-- ./ITU --}}

      {{-- /principal --}}
      @if(Auth::user()->hasRole('manager') && Auth::user()->belongsTodepartmentOf('principal office') || Auth::user()->hasRole('principal office'))
            <li  class="@if(request()->routeIs('candidates')) bg-indigo-800 border-indigo-500 border-l-4 @endif">
              <x-sidebar.link-item href="/candidates" title="Home">
                <x-slot name='symbol'>
                  home
                </x-slot>
                Home
              </x-sidebar.link-item>
            </li> 
      @endif
       {{--./principal  --}}                   

        {{-- accounts, exams, itu principal --}}
          @if(Auth::user()->hasRole('accounts')||Auth::user()->hasRole('exams')||Auth::user()->hasRole('superadmin') || Auth::user()->belongsTodepartmentOf('IT Unit')) 
            <li  class="@if(request()->routeIs('statistics')) bg-indigo-800 border-indigo-500 border-l-4 @endif">
              <x-sidebar.link-item  href="/statistics"  title="Statistics">
                <x-slot name='symbol'>
                  trending-up
                </x-slot>
                Statistics
              </x-sidebar.link-item> 
            </li>
          @endif 
        {{-- ./accounts, exams, itu principal --}} 

            <li  class="{{Request::is('user/profile')? 'bg-indigo-800 border-indigo-500 border-l-4':''}}" >   
              <x-sidebar.link-item  href="/user/profile" title="My Profile">
                <x-slot name='symbol'>
                  user
                </x-slot>
                My Profile
              </x-sidebar.link-item>  
            </li> 

            <li  {{-- class="@if(request()->routeIs('statistics')) bg-indigo-800 border-indigo-500 border-l-4 @endif" --}} >   
              <x-sidebar.link-item  href="#/notifications"  title="Notifications">
                <x-slot name='symbol'>
                  bell
                </x-slot>
                Notifications
                @if(auth()->user()->unreadNotifications->count()>0) 
                  <span class="{{-- absolute inset-0 block --}}">
                    <div class="inline-flex items-center mr-6 px-1.5 py-0.5 border-2 border-indigo-900 rounded-full text-xs font-semibold  text-indigo-900 bg-indigo-100">
                      {{auth()->user()->unreadNotifications->count()}} 
                    </div>
                  </span>
                @endif
              </x-sidebar.link-item>  
            </li>                      
          </ul>
        </div>
      </div>
@endauth
      <!-- ./Sidebar -->

          