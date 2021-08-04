<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class FeesClearanceController extends Controller
{
    /**
     * Show all students with hexco exam results who have registered online
     */
    public function index()
    {
        $students=User::whereHas('results')->with('fees','results','fees.approver')->get();
        return view('dashboard.clearance.fees.index',compact('students'));
    }
    
    
    
}
