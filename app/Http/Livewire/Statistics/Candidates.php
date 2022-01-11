<?php

namespace App\Http\Livewire\Statistics;

use Livewire\Component;
use App\Models\Result;
use App\Models\User;
use App\Models\ClearedStudent;
use App\Models\Fee;
use App\Models\Intake;

class Candidates extends Component
{
    public $departments;
    public $studentsRegisteredOnSystem;
    public $offLineClearedStudents;
    public $onLineClearedStudents;
    public $totalCandidates;
    public $staffUsers;

    public function render()
    {
        $intake = Intake::latest()->first()->id;
        $label = request('intake');
        if (isset(request()->intake)){
            $intake = Intake::where('label',$label)->firstOrFail()->id;
        }
        
        //hexco disciplinces
        $this->departments = Result::select('discipline')->distinct('discipline')->where('intake_id',$intake)->count();
        
        //students who managed a successful log in                
        $this->studentsRegisteredOnSystem=User::whereHas('results', fn ($query) =>
                $query->where('intake_id', $intake))->count(); 

        //students cleared by Accounts using Excel generated sheet forwarded to IT Unit      
        $this->offLineClearedStudents =ClearedStudent::where('intake_id',$intake)->count();

        //number of students cleared via the system
        $this->onLineClearedStudents =Fee::whereNotNull('cleared_at')
                                        ->where('intake_id',$intake)
                                        ->count();
        //number of candidates as per the uploaded hexco results                                        
        $this->totalCandidates = \DB::table('results')->where('intake_id','=',$intake)->distinct('candidate_number')->count();
        $this->staffUsers = User::has('staff')->count();

        $intakes = Intake::latest()->get();
        return view('livewire.statistics.candidates',compact('intakes'));
    }
}
