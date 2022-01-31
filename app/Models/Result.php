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

     /**
      * filters for searching criteria in exams dashboard
      */
    public function scopeFilterz($query, array $filters)
    {
            //filter by user's surname          
            $query->when($filters['second_name'] ?? false, fn($query, $second_name) =>
                $query->where('surname', 'like', '%' . $second_name . '%')                
            );

            // filter by user's first name
            $query->when($filters['first_name'] ?? false, fn($query, $first_name) =>
                $query->where('names', 'like', '%' . $first_name . '%')                
            ); 

            // filter by user's candidate number
            $query->when($filters['candidate'] ?? false, fn($query, $candidate) =>
                $query->where('candidate_number', 'like', '%' . $candidate . '%')                
            ); 
            //filter by examination session
            $query->when($filters['exam_session'] ?? false, fn($query, $exam_session) =>
                $query->where('intake_id', $exam_session)
            );
            //filter by hexco discipline
            $query->when($filters['department'] ?? false, fn($query, $department) =>
                $query->where('discipline', $department)
            ); 
            //filter by hexco level
            $query->when($filters['level'] ?? false, fn($Level, $level) =>
                $Level->when($level=='nc',fn($nc)=>
                   $nc->where('course_code','like','3%')
                        //->orWhere('course_code','like','4%')

                ) 
                ->when($level=='nd',fn($nd)=>
                    $nd->where('course_code','like','5%') /*|| $nd->where('course_code','like','6%')*/
                         /*->orWhere('course_code','like','6%')*/
                ) 
                ->when($level=='hnd',fn($hnd)=>
                    $hnd->where('course_code','like','7%') /*|| $hnd->where('course_code','like','8%')*/
                       //  ->orWhere('course_code','like','8%')
                )                 
            );   
            //filter by overal comment
            $query->when($filters['comment'] ?? false, fn($query, $comment) =>
                $query->when($comment=='absent',fn($query)=>
                    $query->where('comment','absent')
                ) 
                ->when($comment=='award',fn($award)=>
                    $award->where('comment','award')
                ) 
                ->when($comment=='fail',fn($fail)=>
                    $fail->where('comment','fail')
                )  
                ->when($comment=='proceed',fn($proceed)=>
                    $proceed->where('comment','proceed')
                ) 
                ->when($comment=='referred',fn($referred)=>
                    $referred->where('comment','referred')
                )
                ->when($comment=='disqualified',fn($disqualified)=>
                    $disqualified->where('comment','disqualified')
                )                                                                               
            );             
    }        

}

               