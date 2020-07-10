{{-- <footer class="blockquote-footer mb-2">{{$comment->user->name}}:<br>&nbsp;&nbsp;&nbsp;&nbsp;
    <cite title="Source Title">{{$comment->content}}</cite></footer> --}}
        <button type="button" class="btn btn-sm btn-light ml-3">
            <span class="badge badge-dark">{{$comment->user->name}}</span> : {{$comment->content}}
      </button><br>