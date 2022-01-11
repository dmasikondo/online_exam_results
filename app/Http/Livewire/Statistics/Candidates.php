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

    public $active_users;
    public $usersWithUnverifiedEmail;
    public $inactive_users;
    public $suspended_users;
    public $itunit_users;
    public $accounts_users;
    public $admin_office_users;
    public $warden_users;
    public $manager_users;
    public $library_users;
    public $hod_users;

   

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

        $this->active_users = User::where('must_reset',false)->where('is_suspended',false)->whereNotNull('email_verified_at')->count();
         $this->usersWithUnverifiedEmail=User::whereNull('email_verified_at')->count();
         $this->inactive_users = User::where('must_reset')->count();
         $this->suspended_users = User::where('must_reset')->count();
         $this->itunit_users =User::whereHas('roles', fn($query)=>$query->where('name','superadmin'))->count();
         $this->accounts_users =User::whereHas('roles', fn($query)=>$query->where('name','accounts'))->count();
         $this->exams_users =User::whereHas('roles', fn($query)=>$query->where('name','exams'))->count();
         $this->library_users =User::whereHas('roles', fn($query)=>$query->where('name','library'))->count();
         $this->manager_users =User::whereHas('roles', fn($query)=>$query->where('name','manager'))->count();
         $this->hod_users =User::whereHas('roles', fn($query)=>$query->where('name','hod'))->count();
         $this->warden_users =User::whereHas('roles', fn($query)=>$query->where('name','warden'))->count();
         $this->admin_office_users =User::whereHas('roles', fn($query)=>$query->where('name','admin_office'))->count();

        $intakes = Intake::latest()->get();
        return view('livewire.statistics.candidates',compact('intakes'));
    }
}
