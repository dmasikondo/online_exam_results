<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    /**
     * check if the member of staff belongs to department of..
     */

    public function departmentOf($dept)
    {
       return (bool) $this->department()->where('name', $dept)->count();
    }
}


