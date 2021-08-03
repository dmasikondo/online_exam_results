<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
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

    public function results()
    {
        return $this->hasMany(Result::class, 'users_id');
    }


    public function fees()
    {
        return $this->hasMany(Fee::class);
    }

    // public function person()
    // {
    //     if(Auth::user()->id ==$this->id)
    //     {
    //         return 'Me';
    //     }
    //     else{
    //         return $this->second_name. ' '.$this->first_name;
    //     }
    // }

}
