<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Intake extends Model
{
    use HasFactory;

    protected $guarded =[];
    // sentence-capitalise 
     public function getTitleAttribute($desc)
     {
         return ucwords($desc);
     }    
     public function getLabelAttribute($desc)
     {
         return ucwords($desc);
     }         
}
