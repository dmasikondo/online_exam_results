<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\Result;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        $candidate = Result::where('candidate_number',request('candidate_number'))->first();
        //dd($candidate);
    /**
     * if candidate number exist
     */

 
        Validator::make($input, [
            'surname' => ['required', 'string', 'max:255',                 Rule::exists('results')
                ->where('names',request()->names)
                ->where('candidate_number',request()->candidate_number)],
            'names' => ['required', 'string', 'max:255'],
            'candidate_number' => ['required', 'string', 'max:255','exists:results,candidate_number'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],   
            'national_id' => ['required', 'string', 'max:255', 'unique:users'],                     
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['required', 'accepted'] : '',
        ])->validate();
        $uuid = Str::uuid();
        $slug=$input['surname'].$uuid;
        $uniq_slug = $input['surname'].uniqid();
        $user = User::create([
        //return User::create([
            'second_name' => $input['surname'],
            'first_name' => $input['names'],
            'national_id' => $input['national_id'],
            'slug' => $slug,
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);

        Result::where('candidate_number',request('candidate_number'))->update(['users_id'=>$user->id]);
        $user->fees()->create(['intake_id'=>1,'cleared_at'=>null,'slug'=>$uniq_slug]);
        $user->students()->create(['user_id'=>1]);
        //dd($user);
        return $user;       

    }
}
