<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Storage;

class User extends Authenticatable /*implements MustVerifyEmail*/
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded =[];
    // protected $fillable = [
    //     'email',
    //     'password',
    //     'national_id',
    //     'second_name',
    //     'first_name',
    //     'student_number',
    //     'phone_number',
    //     'slug',
    // ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];
    /**
     * Get the default profile photo URL if no profile photo has been uploaded.
     * Otherwise return 
     *
     */
    public function getProfilePhotoUrlAttribute()
    {
        $name = $this->first_name.' '.$this->second_name;       
        if(isset($this->profile_photo_path)){
            return Storage::disk($this->profilePhotoDisk())->url($this->profile_photo_path);
        }
        return 'https://ui-avatars.com/api/?name='.urlencode($name).'&color=7F9CF5&background=EBF4FF';
    }

    public function results()
    {
        return $this->hasMany(Result::class, 'users_id');
    }


    public function fees()
    {
        return $this->hasMany(Fee::class);
    }

    public function students()
    {
        return $this->hasMany(Student::class);
    }

   public function staff()
    {
        return $this->hasMany(Staff::class,'user_id');
    }    

    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();    
    }
 

    /**
     * Assign user a role
     */

    public function assignRole($role)
    {
       // $check_if_role_exists = Role::where('name',$role)->get();
            

        return $this->roles()->save(Role::firstOrCreate(['name' =>$role]));
    } 

    /**
      * Check if the user has role of 
    */ 
    public function hasRole($role)
    {
        return  (bool) $this->roles()->where('name',$role)->count();
    }  

    // sentence-capitalise 
     public function getSecondNameAttribute($desc)
     {
         return ucwords($desc);
     }   

     public function getFirstNameAttribute($desc)
     {
         return ucwords($desc);
     } 
     public function getSexAttribute($desc)
     {
         return ucwords($desc);
     } 

     /**
      * Check if the user has results that have been cleared offline 
      * (accounts department sends an excel sheet of cleared user to ITU)
      */

     public function isClearedOffline()
     {
        $cleared_national_id = ClearedStudent::where('national_id_name','LIKE',$this->national_id.'%')->get();
        if($cleared_national_id->count()>0) {
            return true;
        }
        else{
            return false;
        }        
     }

     public function isStudent()
     {
        return (bool) $this->results()->where('users_id', $this->id)->count();
     }

     /**
      * check if user belongs to a given department
      */

     public function belongsTodepartmentOf($dept)
     {
        $department = Department::where('name',$dept)->first();
        //dd($department->id);
        return (bool)($this->staff()->where('user_id', $this->id)->where('department_id',$department->id)->count());
     }


    public function scopeFilter($query, array $filters)
    {

            $query->when($filters['department'] ?? false, fn($query, $department) =>
            $query->whereHas('results', fn ($query) =>
                $query->where('discipline', $department)
                )
            );
            $query->when($filters['clearance_status'] ?? false, fn($query, $clearance_status) =>
                $query->has('results')
          //  if($clearance_status =='cleared'){
                ->whereDoesntHave('fees',function($q){
                $q->where('is_cleared',1);
                })                
           // }
/*            elseif($clearance_status =='pending'){
                ->whereHas('fees',function($q){
                $q->where('is_cleared',false)
                ->whereNull('cleared_at');
                })
            }
            elseif($clearance_status =='declined'){
                ->whereHas('fees',function($q){
                $q->where('is_cleared',false)
                ->whereNotNull('cleared_at');
                })
            } 
            else{
                ->whereDoesntHave('fees',function($query){
                            $query->where('is_cleared',1);
                         })                
            } */          
            );            
            $query->when($filters['second_name'] ?? false, fn($query, $second_name) =>
            $query->has('results') 
                ->where('second_name', 'like', '%' . $second_name . '%')
             //   ->orWhere('first_name', 'like', '%' . $name . '%')
                
            );
            $query->when($filters['first_name'] ?? false, fn($query, $first_name) =>
            $query->has('results')
                ->where('first_name', 'like', '%' . $first_name . '%')
             //   ->orWhere('first_name', 'like', '%' . $name . '%')
                
            );            
            $query->when($filters['nat_id'] ?? false, fn($query, $nat_id) =>
            $query->has('results')
                ->where('national_id', 'like', '%' . $nat_id . '%')
               
            );  

/*         $students=User::has('results')->filter(
            request(['department','name','nat_id']))->whereDoesntHave('fees',function($query){
            $query->where('is_cleared',1);
         })  */                    
                       
    }

    public function scopeFilters($query, array $filters)
    {
            //filter by user's role
            $query->when($filters['role'] ?? false, fn($query, $role) =>
                $query->whereHas('roles', fn ($query) =>
                $query->where('name', $role)
                )
            );  

            //filter by user's surname          
            $query->when($filters['surname'] ?? false, fn($query, $surname) =>
                $query->where('second_name', 'like', '%' . $surname . '%')                
            );

            // filter by user's first name
            $query->when($filters['first_name'] ?? false, fn($query, $first_name) =>
                $query->where('first_name', 'like', '%' . $first_name . '%')                
            ); 

            // filter by user's email
            $query->when($filters['email'] ?? false, fn($query, $email) =>
                $query->where('email', 'like', '%' . $email . '%')                
            );                                           
                       
    }    

   
}
