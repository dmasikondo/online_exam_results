<?php

namespace App\Http\Livewire\Comment;

use Livewire\Component;

class GetComments extends Component
{
    protected $listeners = ['updateComments' => 'render'];
    public $fileableType;
    public $fileableId; 
    public $comments; 
    public $isFromStudent;  
    
    public function mount($fileableId, $fileableType, $isFromStudent)
    {
        $this->fileableId = $fileableId;
        $this->fileableType = $fileableType;
        $this->isFromStudent = $isFromStudent;
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
