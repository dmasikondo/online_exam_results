<?php

namespace App\Http\Livewire\Statistics;

use Livewire\Component;
use App\Models\Result;
use App\Models\User;
use App\Models\ClearedStudent;
use App\Models\Fee;

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
        $this->departments = Result::select('discipline')->distinct('discipline')->count();
        $this->studentsRegisteredOnSystem=User::has('results')->count();
        $this->offLineClearedStudents =ClearedStudent::count();
        $this->onLineClearedStudents =Fee::whereNotNull('cleared_at')->count();
        $this->totalCandidates = \DB::table('results')->where('intake_id','=',1)->distinct('candidate_number')->count();
        $this->staffUsers = User::has('staff')->count();

        return view('livewire.statistics.candidates');
    }
}
