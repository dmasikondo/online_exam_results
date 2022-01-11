<div class="{{-- absolute w-full --}} flex justify-center bg-gray-200  {{-- h-screen --}} items-center my-4">
    
  <div class="rounded-xl bg-white w-full px-6 overflow-x-auto{{-- md:w-2/3 --}} {{-- lg:w-1/3 --}}"
        x-data="{ isUploading: false, progress: 0 }"
        x-on:livewire-upload-start="isUploading = true"
        x-on:livewire-upload-finish="isUploading = false"        
        x-on:livewire-upload-error="isUploading = false"
        x-on:livewire-upload-progress="progress = $event.detail.progress"
  >
    <div class="px-5 py-3 flex items-center justify-between text-blue-400 border-b">
      {{-- <i class="fas fa-times text-xl"></i> --}}

      <p class="inline hover:bg-blue-100 px-4 py-3 rounded-full font-bold">
        Upload a .csv file with results to the database <small>(size must be less than 2MB)</small>
       {{--  @php phpinfo() @endphp --}}
      </p>
    </div>
    <div class="px-5 py-3">
        <p>Important! The .csv file must have column headings in the order of:</p>
        <table class="table-auto my-4">
          <thead>
            <tr class="text-xs font-semibold tracking-wide text-left text-gray-500 uppercase border-b">
              <th class="border-r-1">discipline</th>
              <th class="border-r-1">course code</th>
              <th class="border-r-1">candidate number</th>
              <th class="border-r-1">surname</th>
              <th class="border-r-1">first names</th>
              <th class="border-r-1">subject code</th>
              <th class="border-r-1">subject</th>
              <th class="border-r-1">grade</th>
              <th class="border-r-1">session</th>
              <th class="border-r-1">course comment</th>
              <th class="border-r-1">intake_id</th>
            </tr>
          </thead>
        </table>

        <p>
            The last uploaded exam results are of Intake <b>{{$intake->id}}</b> for the session <b>{{$intake->label}}</b> last updated 
            <small>{{$intake->updated_at->diffForHumans()}}</small>
        </p>

    </div>

  <div class="py-6" >
    <x-session-message/> 
    <x-session-warning/> 

  </div>
 <form wire:submit.prevent="uploadFile" enctype="multipart/form-data">
    <div class="flex p-4 ">
      <div>
        <img class="rounded-full w-8" src="{{Auth::user()->profile_photo_url }}" />
      </div>
    </div>
        <div class="flex items-center text-blue-400 justify-between py-6 px-4 border-t">  
            <form wire:submit.prevent="uploadFile" enctype="multipart/form-data">
                <div x-data="{fileSelected: true}" x-on:livewire-upload-finish="fileSelected = true" class="border-b-4 pb-4 space-y-4">

                    <input id="upload{{ $iteration }}"  type="file" wire:model.defer="file" accept=".csv, text/csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel" wire:click="clearErrors"
                    class="text-xs" required />  
                     <p wire:loading.remove>
                        @error('file')
                            <span class="text-red-500 text-sm italic">{{ $message }}</span>
                        @enderror
                     </p>
                   <div x-show="isUploading" style="display: none;">
                        <progress max="100" x-bind:value="progress"></progress>
                    </div>             
                </div> 

                <button type="submit" class="inline px-4 py-3 rounded-full font-bold text-white bg-blue-300 hover:bg-blue-100 hover:text-blue-900 cursor-pointer" >
                   Upload File
                  
                </button>
                <div>
                    <span wire:loading>
                        Processing ...
                </span>
                </div>
            </form>                 
        </div> 




      </div>
    </div>      
  </form>
</div>
</div>