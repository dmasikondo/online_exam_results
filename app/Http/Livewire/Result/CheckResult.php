<?php

namespace App\Http\Livewire\Result;

use Livewire\Component;
use App\Models\Intake;

class CheckResult extends Component
{
    public $intakes;

    public function render()
    {
        $this->intakes = Intake::orderBy('id')->get();
        //dd($this->intakes);
        return view('livewire.result.check-result');
    }
}
