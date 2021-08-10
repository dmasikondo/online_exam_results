<?php

namespace App\Http\Livewire\Fees;

use Livewire\Component;
use App\Http\Livewire\Modal;
use App\Models\Fee;
use App\Models\User;
use Auth;

class ClearStudent extends Modal
{
    public $fee;
    public $surname;
    public $first_name;
    public $discipline;
    public $status;
    public $created;
    public $noOfFiles;
    public $defaultAccountsPersonnel;
    public function resetForm()
    {
        $this->resetErrorBag();
    }
    public function updateFeesClearanceState($slug)
    {
        $this->show();
        $this->defaultAccountsPersonnel = User::where('email','accounts@hrepoly.ac.zw')->firstOrFail(); //default accounts dept account to be used in messages
        $this->fee =Fee::where('slug',$slug)->with('user','files','user.results')->firstOrFail(); 
        $this->noOfFiles = $this->fee->files()->count();
        $this->created = $this->fee->user->created_at->diffForHumans();
        $this->surname = $this->fee->user->second_name;
        $this->first_name =$this->fee->user->first_name;
        $this->discipline = $this->fee->user->results[0]->discipline;
        if($this->fee->cleared_at == null && $this->fee->is_cleared == false)
        {
            $this->status = 'Pending';
        }
        elseif(!$this->fee->cleared_at == null && $this->fee->is_cleared == false)
        {
            $this->status = 'Declined';
        }
        if(!$this->fee->cleared_at == null & $this->fee->is_cleared)
        {
            $this->status = 'Cleared';
        }       


    }  

    protected function authorisation()
    {

        /**
         * abort if student is already cleared
         */
                
        if($this->fee->is_cleared)

        {            
            session()->flash('warning',"The student: '$this->surname $this->first_name' is already cleared");
            $this->hide();
            return redirect('/dashboard'); 
            //change url to view more mode          

        }
        /**
         *  abort if the processing personnel is to approve own student payment
         */      
         

        if(Auth::user()->id ==$this->fee->user_id)
        {            
            session()->flash('warning',"Failed! You cannot process your own account ");
            $this->hide();
            return redirect('/dashboard/fees-clearances/');  
            //change url to view more mode 
                      
        }

    } 

    public function approveStudent()
    {
        //$this->authorisation();
        /**
         * abort if student is already cleared
         */
                
        if($this->fee->is_cleared)

        {            
            session()->flash('warning',"The student: '$this->surname $this->first_name' is already cleared");
            $this->hide();
            return redirect('/dashboard/fees-clearances/'.$this->fee->user->slug); 
            //change url to view more mode          

        }
        /**
         *  abort if the processing personnel is to approve own student payment
         */      
         

        if(Auth::user()->id ==$this->fee->user_id)
        {            
            session()->flash('warning',"Failed! You cannot process your own account ");
            $this->hide();
            return redirect('/dashboard/fees-clearances/'.$this->fee->user->slug);  
            //change url to view more mode 
                      
        }   
        
        $this->fee->update(['is_cleared'=>true, 'clearer_id'=>Auth::user()->id, 'cleared_at'=>now()]);  
         $this->fee->files()->create(['body' =>'Your account was successfully processed','user_id' => $this->defaultAccountsPersonnel->id]);          
         session()->flash('message',"The student: '$this->surname $this->first_name's account was successfully updated");
        $this->hide(); 
         return redirect('/dashboard/fees-clearances/'.$this->fee->user->slug);        
    }


    public function declineStudent()
    {
        //$this->authorisation();
        /**
         * abort if student is already cleared
         */
                
        if($this->fee->is_cleared)

        {
            
            session()->flash('warning',"The student: '$this->surname $this->first_name' is already cleared");
            $this->hide();
            return redirect('/dashboard/fees-clearances/'.$this->fee->user->slug); 
            //change url to view more mode          

        }

        /**
         *  abort if the processing personnel is to approve own student payment
         */  
        if(Auth::user()->id ==$this->fee->user_id)
        {            
            session()->flash('warning',"Failed! You cannot process your own account ");
            $this->hide();
            return redirect('/dashboard/fees-clearances/'.$this->fee->user->slug);  
            //change url to view more mode 
                      
        }        

         $this->fee->update(['is_cleared'=>false, 'clearer_id'=>Auth::user()->id, 'cleared_at'=>now()]);  
         $this->fee->files()->create(['body' =>'Your account is in arrears, please clear the arrears and upload your proof of payment','user_id' => $this->defaultAccountsPersonnel->id]);     
        session()->flash('message',"The student: '$this->surname $this->first_name's account was successfully updated");
        $this->hide();
        return redirect('/dashboard/fees-clearances/'.$this->fee->user->slug);        
    }    

    public function render()
    {  // $fee = $this->fee->with('user')->firstOrFail();   
        return view('livewire.fees.clear-student');
    }
}
