<div class="{{-- absolute w-full --}} flex justify-center bg-gray-200 {{-- h-screen --}} items-center">
    
  <div class="rounded-xl bg-white w-full overflow-x-auto{{-- md:w-2/3 --}} {{-- lg:w-1/3 --}}"
        x-data="{ isUploading: false, progress: 0 }"
        x-on:livewire-upload-start="isUploading = true"
        x-on:livewire-upload-finish="isUploading = false"        
        x-on:livewire-upload-error="isUploading = false"
        x-on:livewire-upload-progress="progress = $event.detail.progress"
  >
    <div class="px-5 py-3 flex items-center justify-between text-blue-400 border-b">
      {{-- <i class="fas fa-times text-xl"></i> --}}

      <p class="inline hover:bg-indigo-100 px-4 py-3 rounded-full font-bold">
          @if($isFromStudent)
            Send Payment Proof
          @else
            You may message the student if necessary
          @endif
      </p>
    </div>
    <div class="my-1">
      <x-session-message/>
    </div>

 <form wire:submit.prevent="uploadFile" enctype="multipart/form-data">
    <div class="flex p-4 ">
      <div>
        <img class="rounded-full w-8" src="{{Auth::user()->profile_photo_url }}" />
      </div>
     
      <div class="ml-3 flex flex-col w-full">
        <textarea placeholder="You may leave this section blank" class="w-full text-xl resize-none outline-none h-32" wire:model.defer="comment"></textarea>
         <p wire:loading.remove>
            @error('comment')
                <span class="text-red-500 text-sm italic">{{ $message }}</span>
            @enderror
         </p>
        <div class="text-indigo-400 -ml-4">
          <p class="inline hover:bg-indigo-100 px-4 py-3 rounded-full"><i class="fas fa-globe"></i> In pdf or picture format</p>
        </div>
      </div>
    </div>

    <div class="flex items-center text-indigo-400 justify-between py-6 px-4 border-t">
      <div class="flex text-2xl pl-12">
        <div class="flex items-center justify-center p-3 hover:bg-indigo-100 rounded-full cursor-pointer">
          <i class="fas fa-image"></i>
        </div>

        <div class="flex items-center justify-center p-3 hover:bg-indigo-100 rounded-full cursor-pointer">
          <i class="fas fa-poll-h"></i>
        </div>

        <div class="flex items-center justify-center p-3 hover:bg-indigo-100 rounded-full cursor-pointer">
          <i class="fas fa-smile"></i>
        </div>

        <div class="flex items-center justify-center p-3 hover:bg-indigo-100 rounded-full cursor-pointer">

          <i class="fas fa-calendar-alt"></i>
        </div>
    </div>
        {{-- file input and submit --}}
        <div x-data="{fileSelected: true}" x-on:livewire-upload-finish="fileSelected = true" class="border-b-4 pb-4 space-y-4">

            <input id="upload{{ $iteration }}"  type="file" wire:model.defer="fileName" accept="image/*,.pdf" wire:click="clearErrors" {{-- id="{{$randomu}}{{$ayd}} --}}
            class="text-xs"/>  
             <p wire:loading.remove>
                @error('fileName')
                    <span class="text-red-500 text-sm italic">{{ $message }}</span>
                @enderror
             </p>
           <div x-show="isUploading" style="display: none;">
                <progress max="100" x-bind:value="progress"></progress>
            </div>             
        </div>  

      <div>
        <button type="submit" class="inline px-4 py-3 rounded-full font-bold text-white bg-indigo-300 hover:bg-gray-200 cursor-pointer" wire:click="uploadFile">
          @if($isFromStudent)
            Send Payment Proof
          @else
            Send message
          @endif
        </button>
        <div>
            <span wire:loading wire:target="uploadFile">
                Processing ...
            </span>
        </div>

      </div>
    </div>
</form>
  </div>

</div>
