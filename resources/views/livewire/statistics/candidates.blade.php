<div class="h-full mt-14 mb-10">
     <!-- Statistics Cards -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 p-4 gap-4">
      <div class="bg-blue-500 shadow-lg rounded-md flex items-center justify-between p-3 border-b-4 border-blue-600  text-white font-medium group">
        <div class="flex justify-center items-center w-14 h-14 bg-white rounded-full transition-all duration-300 transform group-hover:rotate-12">
          <x-icon name="user-group" class="w-8 h-8 stroke-current text-blue-800 transform transition-transform duration-500 ease-in-out" stroke-width="2"/>
        </div>
        <div class="text-right">
          <p class="text-2xl">{{$totalCandidates}}</p>
          <p>Candidature</p>
        </div>
      </div>
      <div class="bg-blue-500 shadow-lg rounded-md flex items-center justify-between p-3 border-b-4 border-blue-600  text-white font-medium group">
        <div class="flex justify-center items-center w-14 h-14 bg-white rounded-full transition-all duration-300 transform group-hover:rotate-12">
          <x-icon name="status-offline" class="w-8 h-8 stroke-current text-blue-800 transform transition-transform duration-500 ease-in-out" stroke-width="2"/>        
      </div>
        <div class="text-right">
          <p class="text-2xl">{{$offLineClearedStudents}}</p>
          <p>Accounts: Offline Cleared</p>
        </div>
      </div>
      <div class="bg-blue-500 shadow-lg rounded-md flex items-center justify-between p-3 border-b-4 border-blue-600 text-white font-medium group">
        <div class="flex justify-center items-center w-14 h-14 bg-white rounded-full transition-all duration-300 transform group-hover:rotate-12">
          <x-icon name="status-online" class="w-8 h-8 stroke-current text-blue-800 transform transition-transform duration-500 ease-in-out" stroke-width="2"/> 
        </div>
        <div class="text-right">
          <p class="text-2xl">{{$onLineClearedStudents}}</p>
          <p>Accounts: Online Processed Requests</p>
        </div>
      </div>
      <div class="bg-blue-500 shadow-lg rounded-md flex items-center justify-between p-3 border-b-4 border-blue-600 text-white font-medium group">
        <div class="flex justify-center items-center w-14 h-14 bg-white rounded-full transition-all duration-300 transform group-hover:rotate-12">
          <x-icon name="users" class="w-8 h-8 stroke-current text-blue-800 transform transition-transform duration-500 ease-in-out" stroke-width="2"/> 
        </div>
        <div class="text-right">
          <p class="text-2xl">{{$studentsRegisteredOnSystem}}</p>
          <p>Students Registered on the System</p>
        </div>
      </div>
@if(Auth::user()->hasRole('exams') || Auth::user()->hasRole('manager') || (Auth::user()->hasRole('hod') && Auth::user()->belongsTodepartmentOf('IT Unit')) || Auth::user()->hasRole('superadmin'))      
      <div class="bg-blue-500 shadow-lg rounded-md flex items-center justify-between p-3 border-b-4 border-blue-600 text-white font-medium group">
        <div class="flex justify-center items-center w-14 h-14 bg-white rounded-full transition-all duration-300 transform group-hover:rotate-12">
          <x-icon name="collection" class="w-8 h-8 stroke-current text-blue-800 transform transition-transform duration-500 ease-in-out" stroke-width="2"/> 
        </div>
        <div class="text-right">
          <p class="text-2xl">{{$departments}}</p>
          <p>Hexco Disciplines</p>
        </div>
      </div>
@endif 

@if(Auth::user()->hasRole('hod') && Auth::user()->belongsTodepartmentOf('IT Unit') || Auth::user()->hasRole('superadmin')) 
      <div class="bg-blue-500 shadow-lg rounded-md flex items-center justify-between p-3 border-b-4 border-blue-600 text-white font-medium group">
        <div class="flex justify-center items-center w-14 h-14 bg-white rounded-full transition-all duration-300 transform group-hover:rotate-12">
          <x-icon name="identification" class="w-8 h-8 stroke-current text-blue-800 transform transition-transform duration-500 ease-in-out" stroke-width="2"/> 
        </div>
        <div class="text-right">
          <p class="text-2xl">{{$staffUsers}}</p>
          <p>Members of Staff Users</p>
        </div>
      </div> 
@endif

    </div>
</div>
