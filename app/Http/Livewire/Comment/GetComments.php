<?php

namespace App\Http\Livewire\Comment;

use Livewire\Component;

class GetComments extends Component
{
    public $fileableType;
    public $fileableId; 
    public $comments;   
    
    public function mount($fileableId, $fileableType)
    {
        $this->fileableId = $fileableId;
        $this->fileableType = $fileableType;
    } 
    public function showComments()
    {
        $morphTo = $this->fileableType::findOrFail($this->fileableId);
        $comments = $morphTo->files()->with('user','fee')->latest()->get();
        return $comments;
    }    

    public function render()
    {
        $this->comments = $this->showComments();
        //dd($this->comments);
        return view('livewire.comment.get-comments');
    }
}
