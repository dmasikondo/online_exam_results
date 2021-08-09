<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use Illuminate\Database\Eloquent\Builder;
use App\Models\User;
use App\Models\Result;
use App\Models\ClearedStudent;

class FeesClearanceController extends Controller
{
    /**
     * Show all students with hexco exam results who have registered online
     */
    public function index()
    {
        $departments = Result::select('discipline')->groupBy('discipline')->get();
       // dd($departments);
       // dd(request('department'));
   /*     if(!is_null(request()->department)){
            $students=User::whereHas('results', function($query){
                 return $query->where('discipline',request('department'));
            })->with('fees','results','fees.approver')->paginate(1)->withQueryString();
            //dd($students);
            return view('dashboard.clearance.fees.index',compact('students','departments'));
        }
       $students=User::whereHas('results')->with('fees','results','fees.approver')->paginate(3);*/
        
                 $students=User::has('results')->filter(
                        request(['department','name','nat_id'])
                    )->with('fees','results','fees.approver')->paginate(10)->withQueryString() ; 
                   // dd($students); 

        return view('dashboard.clearance.fees.index',compact('students','departments'));
    } 
}
// // Retrieve posts with at least one comment containing words like foo%...
// $posts = App\Post::whereHas('comments', function (Builder $query) {
// $query->where('content', 'like', 'foo%');
// })->get();

       /* $commit = $this->member->committees()->with(['term','designations' => function($query){
        return $query->where('member_id',$this->member->id);
        }])->with('term')->get()->groupBy(function($query){
            return $query->title;
        });*/