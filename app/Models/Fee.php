<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fee extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $casts =[
        'cleared_at'=>'datetime',
    ];

    public function intake()
    {
        return $this->belongsTo(Intake::class);
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'clearer_id');
    } 

    public function user()
    {
        return $this->belongsto(User::class);
    } 

    public function result()   
    {
        return hasMany(Result::class);
    }

     public function files()
     {
      return $this->morphMany(File::class, 'fileable');
     }    
}
