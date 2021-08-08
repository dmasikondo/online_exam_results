<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Fee;
use App\Models\ClearedStudent;

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
        /**
         * This gives information on student's online clearance status
         */
        $fees_clearances =$user->fees()->with('intake')->get();
        /**
         * Check if student was cleared offline (excel list of cleared students updated to database)
         */
        $cleared_national_id = ClearedStudent::where('national_id_name','LIKE',$user->national_id.'%')->get();
        if($cleared_national_id->count()>0) {
            $offline_cleared = true;
        }
        else{
            $offline_cleared = false;
        }
        return view('results.show',compact('fees_clearances', 'offline_cleared'));
    }
}
