<div>
    
@foreach($comments as $comment) 
{{-- <div class=" flex justify-center items-center">
  <div class="animate-spin rounded-full h-32 w-32 border-t-2 border-b-2 border-purple-500"></div>
</div> spin animation--}}
    <div class="grid grid-cols-8 gap-2 my-2">
        <div class="col-span-1">
            <img class="rounded-full w-8" src="{{$comment->user->profile_photo_url}}" />
        </div>    
        <div class="col-start-2 col-span-6 border border-indigo-200 p-4 rounded-lg">
            <div class="my-2">
                <span class ="text-gray-700">
                @if($isFromStudent && Auth::user()->id !=$comment->user->id) {{-- if is user and not own comment --}}
                    Accounts Department
                @else
                    {{$comment->user->second_name}} {{$comment->user->first_name}}
                @endif
                </span>
                <span class="text-xs text-gray-400">posted {{$comment->created_at->diffForHumans()}}</span>
            </div>
            <div>
                {{$comment->body}}

            @if($comment->url !='')
                 @if($comment->isImage()) 
                    <a href="/storage/{{$comment->url}}" target="_blank">
                        <img src="/storage/{{$comment->url}}" alt="image files" class="w-16 hover:w-32 cursor-pointer">
                    </a> 
                @else
                    <a href="/storage/{{$comment->url}}" target="_blank">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-24 text-indigo-500  hover:text-white hover:bg-indigo-500 hover:border-4">
                          <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0112 2.586L15.414 6A2 2 0 0116 7.414V16a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm2 6a1 1 0 011-1h6a1 1 0 110 2H7a1 1 0 01-1-1zm1 3a1 1 0 100 2h6a1 1 0 100-2H7z" clip-rule="evenodd"/>
                        </svg>
                    </a>
                        <p>Pdf document</p>                        
                @endif               
            @endif
            </div>
        </div>
    </div>  
@endforeach    
</div>
