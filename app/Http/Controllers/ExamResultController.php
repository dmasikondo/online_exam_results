<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Fee;

class ExamResultController extends Controller
{
    /**
     * retrieve student's hexco examination results
     */
    public function myresults()
    {        
        $exam_results = Auth::user()->results()->get();
        //dd($exam_results);
        return view('results.myresults', compact('exam_results'));
    }

    /**
     * show results clearance status page
     */
    public function show(User $user)
    {
        $fee = $user->fees()->firstOrFail();
        $this->authorize('view',$fee);
        $fees_clearances =$user->fees()->with('intake')->get();
        return view('results.show',compact('fees_clearances'));
    }
}
