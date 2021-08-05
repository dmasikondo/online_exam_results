<div>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Register a user') }} 
        </h2>
    </x-slot> 

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-indigo-200 shadow-inner">
            <div class="mb-6 p-6 sm:px-20 bg-white border-b border-gray-200 shadow-lg">
                <div>
                    <div class="w-full lg:w-7/12 bg-white p-5 rounded-lg lg:rounded-l-none">
                        <x-session-message/>
                        <h3 class="pt-4 text-2xl text-center">Create a Member of Staff's  User Account!</h3>
                        <form action="/users/registration" method="post" class="px-8 pt-6 pb-8 mb-4 bg-white rounded">
                            @csrf
                            <div class="mb-4 md:flex md:justify-between">
                                <div class="mb-4 md:mr-2 md:mb-0">
                                    <label class="block mb-2 text-sm font-bold text-gray-700" for="firstName">
                                        First Name
                                    </label>
                                    <input name="first_name" class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline @error('first_name') border-red-500 @enderror" id="firstName" type="text" placeholder="First Name " value="{{old('first_name')}}">
                                    @error('first_name')<p class="text-xs italic text-red-500">{{$message}}</p>@enderror
                                </div>
                                <div class="md:ml-2 ">
                                    <label class="block mb-2 text-sm font-bold text-gray-700" for="lastName">
                                        Last Name
                                    </label>
                                    <input name="last_name" class="w-full px-3 py-2 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline @error('last_name') border-red-500 @enderror" id="lastName" type="text" placeholder="Last Name" value="{{old('last_name')}}">
                                    @error('last_name')<p class="text-xs italic text-red-500">{{$message}}</p>@enderror
                                </div>
                            </div>
                            <div class="mb-4">
                                <label class="block mb-2 text-sm font-bold text-gray-700" for="email">
                                    Email
                                </label>
                                <input name="email" class="w-8/12 px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline @error('email') border-red-500 @enderror" id="email" type="email" placeholder="Email" value="{{old('email')}}">
                                @error('email')<p class="text-xs italic text-red-500">{{$message}}</p>@enderror
                            </div>
                            <div class="mb-4 md:flex md:justify-between">
                                <div class="mb-4 md:mr-2 md:mb-0">
                                    <label class="block mb-2 text-sm font-bold text-gray-700" for="password">
                                        Password
                                    </label>
                                    <input name="password" class="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border @error('password') border-red-500 @enderror rounded shadow appearance-none focus:outline-none focus:shadow-outline" id="password" type="password" placeholder="******************">
                                    @error('password')<p class="text-xs italic text-red-500">{{$message}}</p>@enderror
                                </div>
                                <div class="md:ml-2">
                                    <label class="block mb-2 text-sm font-bold text-gray-700" for="password_confirmation">
                                        Confirm Password
                                    </label>
                                    <input name="password_confirmation" class="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline" id="" type="password" placeholder="******************">
                                </div>
                            </div>

                            <div class="mb-4 md:flex md:justify-between">
                                <div class="mb-4 md:mr-2 md:mb-0">
                                    <label class="block mb-2 text-sm font-bold text-gray-700" for="role">
                                        User Role
                                    </label>
                                    <select class="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline @error('role') border-red-500 @enderror" id="role" name="role">
                                        <option value="">Select User Role</option>
                                        @foreach($roles as $role)
                                            <option value="{{$role->id}}">{{$role->name}}</option>
                                        @endforeach                                        
                                    </select>
                                    @error('role')<p class="text-xs italic text-red-500">{{$message}}</p>@enderror
                                </div>  
                                <div class="md:ml-2">
                                    <label class="block mb-2 text-sm font-bold text-gray-700" for="role">
                                        User's Department
                                    </label>                                    
                                    <select class="w-full px-3 py-2 mb-3 text-sm leading-tight text-gray-700 border rounded shadow appearance-none focus:outline-none focus:shadow-outline @error('department') border-red-500 @enderror" id="department" name="department">
                                        <option value="">Select User's Department</option>
                                    @foreach($departments as $department)
                                        <option value="{{$department->id}}">{{$department->name}}</option>
                                    @endforeach
                                    </select>
                                    @error('department')<p class="text-xs italic text-red-500">{{$message}}</p>@enderror
                                </div>                                                               
                            </div>
                            
                            <div class="mb-6 text-center">
                                <button class="w-full px-4 py-2 font-bold text-white bg-indigo-500 rounded-full hover:bg-indigo-700 focus:outline-none focus:shadow-outline" type="submit">
                                    Register User Account
                                </button>
                            </div>
                            <hr class="mb-6 border-t">
{{--                             <div class="text-center">
                                <a class="inline-block text-sm text-indigo-500 align-baseline hover:text-indigo-800" href="#">
                                    Forgot Password?
                                </a>
                            </div>
                            <div class="text-center">
                                <a class="inline-block text-sm text-indigo-500 align-baseline hover:text-indigo-800" href="./index.html">
                                    Already have an account? Login!
                                </a>
                            </div> --}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
</div>