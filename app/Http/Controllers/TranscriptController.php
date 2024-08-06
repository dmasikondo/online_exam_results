<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Result;
use App\Models\Intake;

class TranscriptController extends Controller
{
    public function index()
    {
        $departments = Result::select('discipline')->groupBy('discipline')->get();
        $intakes = Intake::latest()->get();
       // $candidates = Result::where()
        $candidate =Result::whereNotNull('intake_id')->distinct('candidate_number')->whereComment('award')
         ->filterz(request(['department','second_name','first_name','candidate','exam_session','level']))
         ->with('intake')
         ->select('candidate_number','surname','names','discipline','comment','course_code','intake_id',)
         ->orderBy('intake_id');
         
       // $awarded = $candidate->paginate(50)->withQueryString();      
         $candidates =$candidate->paginate(10)->withQueryString(); 

        return view('transcript.index',compact('candidates','departments','intakes'));  
    }

    public function show(Result $result)
    {
        $departments = Result::select('discipline')->groupBy('discipline')->get();
        $intakes = Intake::latest()->get();        
        $exam_results = Result::whereComment('award')
                        ->where('candidate_number',$result->candidate_number)
                        ->with('intake')
                        ->get();
        return view('transcript.transcript', compact('exam_results','intakes','departments'));                        
    }

    
}
              