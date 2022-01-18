<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Database\Eloquent\Builder;
use App\Models\User;
use App\Models\Result;
use App\Models\ClearedStudent;
use App\Models\Intake;
use Auth;

class FeesClearanceController extends Controller
{
    /**
     * Show all students with hexco exam results who have registered online
     * or appear in the search criteria (filter)
     */
    public function index()
    {
        if(!Auth::user()->hasRole('accounts'))
        {
            abort(403, 'It seems you are not authorised to view this page. Please contact ITUnit');
        }
        $intakes = Intake::latest()->get();
        //dd($intakes);
        $departments = Result::select('discipline')->groupBy('discipline')->get();        
         $students=User::has('results')->filter(
            request(['department','second_name','first_name','nat_id','clearance_status','exam_session']))
            ->with('fees','results','fees.approver')->orderBy('second_name')->paginate(20)->withQueryString(); 
/*         $students=User::has('results')->whereDoesntHave('fees',function($query){
            $query->where('is_cleared',1);
         })->with('fees','results','fees.approver')->orderBy('second_name')->paginate(20)->withQueryString() ;  */                             

        return view('dashboard.clearance.fees.index',compact('students','departments','intakes'));
    }

    public function show (User $user)
    {
        if(!Auth::user()->hasRole('accounts'))
        {
            abort(403, 'It seems you are not authorised to view this page. Please contact ITUnit');
        }        
        /**
         * This gives information on student's online clearance status
         */
        $fees_clearances =$user->fees()->with('intake')->get();
        /**
         * Check if student was cleared offline (excel list of cleared students from accounts dept to ITU updated to database)
         */
        $cleared_national_id = ClearedStudent::where('national_id_name','LIKE',$user->national_id.'%')->latest();
        if($cleared_national_id->count()>0) {
            $offline_cleared = true;
        }
        else{
            $offline_cleared = false;
        }
        return view('dashboard.clearance.fees.show',compact('fees_clearances', 'offline_cleared','user'));
    }
}
