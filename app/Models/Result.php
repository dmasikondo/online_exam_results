<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;
    protected $guarded =[];

    public function getCourseCodeAttribute($code)
    {
        $code =$code[0];
        if($code =='3' || $code == '4')
        {
            return 'National Certificate';
        }
        elseif($code =='5' || $code == '6')
        {
            return 'National Diploma';
        }
        elseif($code =='7' || $code == '8')
        {
            return 'Higher National Diploma';
        } 

    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['department'] ?? false, fn($query, $department) =>
            $query->where('discipline', $department)
        );
        $query->when($filters['name'] ?? false, fn($query, $name) =>
        $query->where('surname', 'like', '%' . $name . '%')
            ->orWhere('surname', 'like', '%' . $name)
            ->orWhere('surname', 'like',  $name . '%')
            ->orWhere('names', 'like', '%' . $name . '%')
            ->orWhere('names', 'like', $name . '%')
            ->orWhere('names', 'like', '%' . $name)
            
        );
        $query->when($filters['candidate_number'] ?? false, fn($query, $candidate_number) =>
        $query->where('candidate_number', 'like', '%' . $candidate_number . '%')
           
        );            
                       
    } 

    public function isClearedOffline($intake)
    {
        return false;
        $cleared_national_id = ClearedStudent::where('national_id_name','LIKE',$this->user->national_id.'%')
            ->where('intake_id',$intake)
            ->get();
        if($cleared_national_id->count()>0) {
            return true;
        }
        else{
            return false;
        }         
    }

    public function isClearedOnline()
    {
        // if($this->user->fees->is_cleared->count()>0)
        // {
        //     return true;
        // }
        // else{
        //     return false;
        // }
    }

    public function isRegisteredInSystem()
    {
        if($this->user){
            return true;
        } 
        else{
            return false;
        }
    }   

}

