<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class StudentController extends Controller
{
    public function index()
    {
        $students=User::whereHas('results')->with('fees','results','fees.approver')->get();
        
        return view('students.index',compact('students'));
    }
}
