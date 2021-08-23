<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Result;

class CandidateController extends Controller
{
    public function index()
    {
        $departments = Result::select('discipline')->groupBy('discipline')->get();
        
         // $students=Result::filter(
         //    request(['department','name','candidate_number']))
         //     ->with('user','user.fees','user.fees.approver')->groupBy('candidate_number')->paginate(30)->withQueryString();
         //$students=Result::select(['candidate_number', 'names', 'surname','discipline'])->distinct()
        $students =Result::where('intake_id','=',1)->distinct('candidate_number')
         ->filter(request(['department','name','candidate_number']))
         ->with('user','user.fees','user.fees.approver')
         ->paginate(50)->withQueryString(); 
         //dd($students);            
            return view('candidates.index',compact('students','departments'));        
    }

}
//$this->totalCandidates = \DB::table('results')->where('intake_id','=',1)->distinct('candidate_number')->count();