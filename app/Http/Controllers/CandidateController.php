<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Result;
use App\Models\Intake;

class CandidateController extends Controller
{
    public function index()
    {
        $departments = Result::select('discipline')->groupBy('discipline')->get();
        $intakes = Intake::latest()->get();
         // $students=Result::filter(
         //    request(['department','name','candidate_number']))
         //     ->with('user','user.fees','user.fees.approver')->groupBy('candidate_number')->paginate(30)->withQueryString();
         //$students=Result::select(['candidate_number', 'names', 'surname','discipline'])->distinct()
        //$candidates =Result::where('intake_id','=',1)->distinct('candidate_number')
        $candidates =Result::whereNotNull('intake_id')->distinct('candidate_number')
         ->filterz(request(['department','second_name','first_name','candidate','exam_session','comment','level']))
         ->with('user','user.fees','user.fees.approver')
         ->select('candidate_number','surname','names','discipline','comment','course_code')
         ->orderBy('intake_id')         
         ->paginate(50)->withQueryString(); 
        return view('candidates.index',compact('candidates','departments','intakes'));        
    }

    public function show(Result $result)
    {
        //$candidate = Result::where('candidate_number',Auth::user()->id)->latest()->first(); 
        $departments = Result::select('discipline')->groupBy('discipline')->get();
        $intakes = Intake::latest()->get(); 
        $result = Result::where('candidate_number',$result->candidate_number)->latest()->first();     
        $exam_results = Result::where('candidate_number',$result->candidate_number)
                                ->where('intake_id',$result->intake_id)
                                ->get();
        return view('candidates.show', compact('exam_results','intakes','departments'));             
    }

}
//$this->totalCandidates = \DB::table('results')->where('intake_id','=',1)->distinct('candidate_number')->count();