<?php

namespace App\Http\Livewire\Statistics;

use Livewire\Component;
use App\Models\Result;
use App\Models\User;
use App\Models\ClearedStudent;

class Candidates extends Component
{
    public $departments;
    public $studentsRegisteredOnSystem;
    public $offLineClearedStudents;
    public $onlineClearedStudents;
    public $totalCandidates;

    public function render()
    {
        $this->departments = Result::select('discipline')->groupBy('discipline')->count();
        $this->studentsRegisteredOnSystem=User::has('results')->count();
        $this->offLineClearedStudents =ClearedStudent::count();
        $this->totalCandidates = Result::all()->groupBy('intake_id','candidate_number');

        return view('livewire.statistics.candidates');
    }
}
