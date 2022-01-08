<?php

namespace App\Http\Livewire\Result;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Result;
use Auth;

class UploadCsv extends Component
{

    use WithFileUploads;

    public $file;
    public $iteration=1;
    public $status;
    public $currentUrl;
    public $uploadedCsv;
    public $originalFilename;

    protected function resetForm()
    {
        $this->reset('file');
    }
    public function clearErrors()
    {
        $this->resetValidation();
    } 

    /**
     * when th upload File button is clicked
     * validate and insert into the database the contents
     * Important, the file fields must be in the order of  
     * discipline course_code candidate_number surname names subject_code subject grade session comment intake_id
     *
     */
    public function uploadFile()
    {  
        $validateData =$this->validate([ 
            'file'=>'required|max:2048|mimetypes:text/csv,text/plain,application/csv,text/comma-separated-values,text/anytext,application/octet-stream,application/txt',
        ],
        ['file.mimetypes' => 'Ensure you are uploading a csv file'],
        
    );

        $this->uploadedCsv = $this->file->store('uploaded-files','public');
        //($this->file->getClientOriginalName());

        $this->importToMysql();
        session()->flash('message',$this->status);
        return redirect($this->currentUrl);        

    }


    /**
     * insert to mysql database, the .csv file
     */

    private function importToMysql()
    {    
        // Allowed mime types
        $csvMimes = array('text/x-comma-separated-values', 'text/comma-separated-values', 'application/octet-stream', 'application/vnd.ms-excel', 'application/x-csv', 'text/x-csv', 'text/csv', 'application/csv', 'application/excel', 'application/vnd.msexcel', 'text/plain', 'csv','txt','xlsx');

        // Validate whether selected file is a CSV file
        if(!in_array($this->file->getClientOriginalExtension(), $csvMimes)){
            session()->flash('warning','Ensure you are uploading a proper csv file');
            return redirect($this->currentUrl); 
        }        

         // Open uploaded CSV file with read-only mode
        $csvFile = fopen('storage/'.$this->uploadedCsv, 'r');
        
        // Skip the first line
        fgetcsv($csvFile);
        
        // Parse data from CSV file line by line
        while(($line = fgetcsv($csvFile)) !== FALSE){
            // Get row data
            $discipline   = $line[0];
            $course_code  = $line[1];
            $candidate_number  = $line[2];
            $surname = $line[3];
            $names = $line[4];
            $subject_code = $line[5];
            $subject = $line[6];
            $grade = $line[7];
            $session = $line[8];
            $comment = $line[9];
            $intake_id = $line[10];                

            // Insert member data in the database
            Result::create([
                'discipline'=>$discipline,
                'course_code'=>$course_code,
                'candidate_number'=>$candidate_number,
                'surname'=>$surname,
                'names'=>$names,
                'subject_code'=> $subject_code,
                'subject'=>$subject,
                'grade'=>$grade,
                'session'=>$session,
                'comment'=>$comment,
                'intake_id'=>$intake_id
            ]);
            
        }
        
        // Close opened CSV file
        fclose($csvFile);

        //delete the uploaded file CSV from storage
        unlink('storage/'.$this->uploadedCsv);
        $this->status = 'The file was successfully uploaded to the database';
            
    }


    public function mount()
    {
        $this->currentUrl = url()->current();
    } 

    public function render()
    {
        return view('livewire.result.upload-csv');
    }
}
