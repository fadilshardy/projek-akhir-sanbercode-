<button type="button" class="btn btn-sm btn-light shadow-sm mb-2 ">
    <a href="/profile/{{$comment->user->id}}"><span class="badge badge-dark">{{$comment->user->name}}</span></a> :
    {{$comment->content}}
</button>&nbsp;
<small class="font-italic d-inline-block text-muted">{{$comment->updated_at->diffForHumans()}}</small>
@auth
@if ($comment->user_id==Auth::user()->id)&nbsp;
<form class="d-inline-block" action="/pertanyaan/{{$comment->id}}/delete_comment" method="POST">
    @csrf
    @method('DELETE')
    <input type="hidden" name="question_id" value="{{$question->id}}">
    <button class="btn btn-xs btn-danger " >Delete</button>
</form>
@endif
@endauth
<br>