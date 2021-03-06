<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;
use App\Models\Department;
use App\Models\User;
use Illuminate\Validation\Rule;
//use Auth;

class UserController extends Controller
{
    /**
     * show all the users
     */
    public function index()
    {
        $this->authorize('view', User::class);

        //check for requested number of pages to be displayed
        if(request()->perPage && intval(request()->perPage) > 0){
            $numberOfRecordsPerPage = request()->perPage;
        }  
        else{
            $numberOfRecordsPerPage = 20;
        }   
        $roles = Role::orderBy('name')->get();         
        $users = User::filters(request(['role','surname','first_name','email']))
         ->with('roles','staff.department')
         ->paginate($numberOfRecordsPerPage)->withQueryString();
        //dd($users);
        return view('users.index', compact('roles','users'));
    }

    /**
     * show the specified user
     */
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }    
    /**
     * Show the form for registering users
     * To IT mgr & IT Unit 
     */
    public function create()
    {
        //dd(Auth::user()->belongsTodepartmentOf('IT Unit'));
        if((Auth::user()->hasRole('hod') && Auth::user()->belongsTodepartmentOf('IT Unit')) || Auth::user()->hasRole('superadmin'))
        {
            $roles =Role::orderBy('name')->get();
            $departments =Department::orderBy('name')->get();
            return view('users.create', compact('roles','departments'));            
            
        }  
        else{
            abort(403, 'It seems you are not authorised to view this page!');
        }      

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
       
        Auth::guard('web')->logout();            
        $slug= request()->ikokokwacho;
        
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
                ->where('slug',request()->checkit),
            ],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);

        $user = User::where('slug',request()->checkit)->firstOrFail();
        /**
         * if account is already active, do not activate
         */
        if(!$user->must_reset)
        {
           session()->flash('warning',"This account is already active. You can log in using your last successful password"); 
             return redirect('/login') ;                 
        }
        $user->update(['must_reset' =>0,'password'=>Hash::make(request('password'))]);
        session()->flash('message',"Your account was successfully activated. You can now login using your new password"); 
         return redirect('/login') ;      

    }

    /**
     * redirect if the account has been suspended
     */
    public function redirectIfSuspended()
    {
        Auth::guard('web')->logout();  
        session()->flash('warning',"This account is suspended. Please contact your administrator"); 
        return view('/login'); 
    } 

    /**
     * show users who are students
     */
    public function userStudents()
    {
        $this->authorize('view', User::class);
        $roles = Role::orderBy('name')->get();         
        $users = User::has('results')
         ->with('roles','staff.department')
         ->paginate(10)->withQueryString(); 
         return view('users.index', compact('roles','users'));       
    }   


}
