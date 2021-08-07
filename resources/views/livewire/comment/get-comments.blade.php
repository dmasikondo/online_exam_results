<div>
    
@foreach($comments as $comment) 
    <div class="grid grid-cols-12 gap-4">
        <div class="col-span-2">
            <img class="rounded-full w-8" src="{{$comment->user->profile_photo_url }}" />
        </div>    
        <div class="border-4 border-indigo-200 p-4 w-full">
            <div class="my-2">
                <span class ="text-gray-700">{{$comment->user->second_name}} {{$comment->user->first_name}}</span>
                <span class="text-xs text-gray-400">posted 2 minutes ago</span>
            </div>
            <div>
                {{$comment->body}}
            @if($comment->url !='')
                <img src="/storage/{{$comment->url}}" alt="some files" class="w-16 hover:w-32 cursor-pointer">
            @endif
            </div>
        </div>
    </div>  
@endforeach    
</div>
