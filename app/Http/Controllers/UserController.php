<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Auth;
use App\Models\Role;
use App\Models\Department;
use App\Models\User;
use Illuminate\Validation\Rule;
use Auth;
//use Auth;

class UserController extends Controller
{
    /**
     * Show the form for registering users
     */
    public function create()
    {
        $roles =Role::orderBy('name')->get();
        $departments =Department::orderBy('name')->get();
        return view('users.create', compact('roles','departments'));
    }

    /**
     * Store the newly created user in storage
     */

    public function store()
    {
        $this->validate(request(), [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'role' => ['required', 'string', 'max:255'],
            'department' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        $slug = request()->surname.uniqid(); 
        $user= User::create([
            'slug' =>$slug,
            'second_name' =>request()->last_name,
            'first_name' =>request()->first_name,
            'email' => request()->email,
            'must_reset'=>true,
            'password' => Hash::make(request()->password),
        ]);
        $user->staff()->create(['user_id'=>$user->id,'department_id'=>request()->department]); 
        $user->roles()->sync(request()->role); 
        session()->flash('message',"User was successfully registered"); 
         return redirect('/users/registration') ;    

    }

    /**
     * Show the form for activating a user account
     */

    public function activate()
    {

       // dd(auth()->user());
        //dd($email);
        //Auth::logout();
       // request()->session()->invalidate();

        //request()->session()->regenerateToken(); 
        //request()->session()->flush();         
        $slug= request()->ikokokwacho;
    //  request()->session()->flush(); 
    // request()->session()->invalidate();
        Auth::guard('web')->logout();
    //request()->session()->regenerateToken();
        return view('users.activate',compact('slug'));
    }

    /**
     * update (activate) the user account in database
     */
    public function activation()
    {

        $this->validate(request(), [
        'first_name' => ['required', 'string', 'max:255','exists:users,first_name'],
        'second_name' => ['required', 'string', 'max:255', Rule::exists('users')
                ->where('first_name',request()->first_name)
                ->where('slug',request()->checkit)],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::where('slug',request()->checkit);
        $user->update(['must_reset' =>0,'password'=>Hash::make(request('password'))]);
        session()->flash('message',"Your account was successfully activated. You can now login using your new password"); 
         return redirect('/login') ;      

    }


}
