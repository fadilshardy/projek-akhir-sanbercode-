{{-- <footer class="blockquote-footer mb-2">{{$comment->user->name}}:<br>&nbsp;&nbsp;&nbsp;&nbsp;
    <cite title="Source Title">{{$comment->content}}</cite></footer> --}}
        <button type="button" class="btn btn-sm btn-light">
            <a href="/profile/{{$comment->user->id}}"><span class="badge badge-dark">{{$comment->user->name}}</span></a> : {{$comment->content}}
      </button><br>