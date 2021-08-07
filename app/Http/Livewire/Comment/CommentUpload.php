<?php

namespace App\Http\Livewire\Comment;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\File;
use Auth;

class CommentUpload extends Component
{
    use WithFileUploads;

    public $fileName;
    public $fileableType;
    public $fileableId;
    public $comment;
    public $url;
    /*public $title;*/
    public $reply_id;
    public $iteration=1;
    public $randomu =1;
    public $files;
    //public $files =[];

    protected function resetForm()
    {
        $this->reset('fileName');
    }
    public function clearErrors()
    {
        $this->resetValidation();
    }
    public function uploadFile()
    {
       
       $morphTo = $this->fileableType::findOrFail($this->fileableId);
        
        $validateData =$this->validate([
            'fileName'=>'nullable|mimes:jpg,gif,jpeg,png,pdf|max:2048',
            'comment'=>'required_without:fileName',
            ],
                [
                    'fileName.required_without:comment' => 'You can not send a blank message',
                ],
                [
                    'fileName.mimes:pdf,jpg,gif,jpeg,png' => 'The file must be 
                    in the format: pdf, jpg, gif, jpeg, png',
                ], 
                [
                    'fileName.max' => 'The selected file size must not exceed 2 MB',
                ],     
                [
                    'comment.required_without:fileName' => 'You can not submit an empty message',
                ], 
           

        );
        /**
         * store file
         */
        if(!empty($this->fileName)){            
            $url = $this->fileName->store('uploaded-files','public');
        }
        else{
            $url = '';
        }
            $morphTo->files()->create(['url' =>$url, 'body' =>$this->comment,'user_id' => Auth::user()->id]);
            $this->fileName = null;
            $this->comment = null;
            //$this->iteration++;
            $this->randomu++;
            session()->flash('message', 'Your message was successfully sent.');  
    }
/*    public function showFiles()
    {
        /**
         * find the model that is associated with the file (file)
         */
       /* $morphTo = $this->fileableType::findOrFail($this->fileableId);
        $files = $morphTo->files()->latest()->get();
        return $files;*/

   // }*/

    // public function deleteFile($id)
    // {
    //     $file =file::findOrFail($id);
    //     unlink('storage/'.$file->url);
    //     $file->delete();    
    //     session()->flash('message', 'The file was successfully deleted.');  
    // }
    public function mount($fileableId, $fileableType)
    {
        $this->fileableId = $fileableId;
        $this->fileableType = $fileableType;
    }
    public function render()
    {
      //  $this->files = $this->showFiles();
        return view('livewire.comment.comment-upload');
    }
}
