<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Fee;
use App\Models\Result;
use App\Models\ClearedStudent;
use Illuminate\Validation\Rule;

class ExamResultController extends Controller
{
    /**
     * retrieve student's hexco examination results
     */
    public function myresults()
    {        
        $exam_results = Auth::user()->results()->get();
        if($exam_results->count()<1)
        {
            abort(403, 'Are you a student? It seems you are not authorised to view this page');
        }
        //$this->authorize('view', $exam_results[0]);
        return view('results.myresults', compact('exam_results'));
    }

    public function myexamResults()
    {
        //validate, check if there are results with the given candidate number matching first name and surname
       
        $this->validate(request(), [
            'candidate_number' => ['required', 'string', 'max:255', Rule::exists('results')
                ->where('names',Auth::user()->first_name)
                ->where('surname',Auth::user()->second_name)],
            'exam_session' => ['required'],
        ]);

        //check if the results exist
        $exam_outcome = Result::where('candidate_number',request()->candidate_number)
                                ->where('names',Auth::user()->first_name)
                                ->where('surname',Auth::user()->second_name)
                                ->where('intake_id',request()->exam_session);

        //if the results where not yet assigned to the user then do so
        if($exam_outcome->whereNull('users_id')->count()>0)
        {
            foreach($exam_outcome->whereNull('users_id')->get() as $exam_result){
                $exam_result->update(['users_id'=>Auth::user()->id]);
            }
          
        }
        $exam_results = Result::where('candidate_number',request()->candidate_number)
                                ->where('names',Auth::user()->first_name)
                                ->where('surname',Auth::user()->second_name)
                                ->where('intake_id',request()->exam_session)
                                ->get();
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
        $fees_clearances =$user->fees()->with('intake','user')->get();
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

    /**
     * Check exan results
     */

    /**
     * show form to upload csv file to mysql database
     */

    public function uploadCsv()
    {
        return view ('results.uploadcsv');
    }
}
