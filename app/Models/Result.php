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
        elseif($code =='5' || $dcode == '6')
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
        return $this->belongsTo(User::class);
    }

}

