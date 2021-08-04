<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Modal extends Component
{

    public $show = false;

    protected $listeners = ['show','updateFeesClearanceState'];

    public function show()
    {
        $this->show = true;
        $this->resetForm();
        $this->resetValidation();
    }

    public function hide()
    {
        $this->show = false;
    }
}
