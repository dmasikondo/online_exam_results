<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>

        <x-jet-validation-errors class="mb-4" />


        <form method="POST" action="{{ route('register') }}">
            @csrf

        <div class="flex gap-2 flex-col md:flex-row center">
            <div class="mt-4 relative flex-1">
                <x-form.input id="candidate_number" type="text" name="candidate_number" placeholder="Candidate No." value="{{old('candidate_number')}}" pattern="([0-9]{7}[a-zA-Z]{1}[0-9]{5})" title="Your Candidate No. must be in the format 99-9999999Z99999" autofocus required/> 
                <x-form.label for="candidate_number">Candidate No. <small>e.g 9999999Z99999</small></x-form.label>             
                <div class="absolute right-0 top-0 mt-6 mr-2">
                    <x-icon name="user-circle" class="h-6 w-6 text-indigo-600 " stroke-width="1"/>    
                    <p class="text-red-900 italic text-sm">@error('candidate_number') {{$message}} @enderror</p>                        
                </div>
            </div>
        </div>

        <div class="flex gap-2 flex-col md:flex-row center">            
                <div class="mt-4 relative flex-1">
                    <x-form.input id="surname" type="text" name="surname" placeholder="Surname" value="{{old('surname')}}" required/> 
                    <x-form.label for="surname">Surname</x-form.label>             
                    <div class="absolute right-0 top-0 mt-6 mr-2">
                        <x-icon name="user-group" class="h-6 w-6 text-indigo-600 " stroke-width="1"/>                           
                    </div>
                    <p class="text-red-900 italic text-sm">@error('surname') {{$message}} @enderror</p>                    
                </div>

                <div class="mt-4 relative flex-1">
                    <x-form.input id="names" type="text" name="names" placeholder="Names" value="{{old('names')}}" required/> 
                    <x-form.label for="names">Names</x-form.label>             
                    <div class="absolute right-0 top-0 mt-6 mr-2">
                        <x-icon name="user" class="h-6 w-6 text-indigo-600 " stroke-width="1"/>                           
                    </div>
                    <p class="text-red-900 italic text-sm">@error('names') {{$message}} @enderror</p>                    
                </div> 

                <div class="mt-4 relative flex-1">
                    <x-form.input id="national_id" type="text" name="national_id" placeholder="National ID" value="{{old('national_id')}}" pattern="([0-9]{2}-[0-9]{5,7}[a-zA-Z]{1}[0-9]{2})" title="Your National ID No. must be in the format 99-9999999Z99" required/> 
                    <x-form.label for="national_id">National ID </x-form.label>             
                    <div class="absolute right-0 top-0 mt-6 mr-2">
                        <x-icon name="identification" class="h-6 w-6 text-indigo-600 " stroke-width="1"/>                           
                    </div>
                    <p class="text-red-900 italic text-sm">@error('national_id') {{$message}} @enderror</p>                    
                </div>   
        </div>

        <div class="flex gap-2 flex-col md:flex-row center">            
                <div class="mt-4 relative flex-1">
                    <x-form.input id="email" type="email" name="email" placeholder="Email" value="{{old('email')}}" required/> 
                    <x-form.label for="email">Email</x-form.label>             
                    <div class="absolute right-0 top-0 mt-6 mr-2">
                        <x-icon name="mail-open" class="h-6 w-6 text-indigo-600 " stroke-width="1"/>                           
                    </div>
                    <p class="text-red-900 italic text-sm">@error('email') {{$message}} @enderror</p>                    
                </div>      
        </div>

        <div class="flex gap-2 flex-col md:flex-row center">            
                <div class="mt-4 relative flex-1">
                    <x-form.input id="password" type="password" name="password" placeholder="Password" required/> 
                    <x-form.label for="password">Password</x-form.label>             
                    <div class="absolute right-0 top-0 mt-6 mr-2">
                        <x-icon name="lock-closed" class="h-6 w-6 text-indigo-600 " stroke-width="1"/>                           
                    </div>
                    <p class="text-red-900 italic text-sm">@error('password') {{$message}} @enderror</p>                    
                </div>

                <div class="mt-4 relative flex-1">
                    <x-form.input id="password_confirmation" type="password" name="password_confirmation" class="px-5" placeholder="Confirm Password" required/> 
                    <x-form.label for="password_confirmation">Confirm Password</x-form.label>             
                    <div class="absolute right-0 top-0 mt-6 mr-2">
                        <x-icon name="key" class="h-6 w-6 text-indigo-600 " stroke-width="1"/>                           
                    </div>                 
                </div>  
        </div>      

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-jet-label for="terms">
                        <div class="flex items-center">
                            <x-jet-checkbox name="terms" id="terms"/>

                            <div class="ml-2">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-jet-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-jet-button class="ml-4">
                    {{ __('Register') }}
                </x-jet-button>
                <x-jet-button class="ml-4">
                    <a href="/">
                        <x-icon name="home" class="w-5 h-5"/>
                    </a>
                </x-jet-button>                
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
