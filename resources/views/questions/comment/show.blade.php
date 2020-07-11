<button type="button" class="btn btn-sm btn-light ">
    <a href="/profile/{{$comment->user->id}}"><span class="badge badge-dark">{{$comment->user->name}}</span></a> :
    {{$comment->content}}
</button>&nbsp;<small class="font-italic text-muted">{{$comment->updated_at->diffForHumans()}}</small><br>