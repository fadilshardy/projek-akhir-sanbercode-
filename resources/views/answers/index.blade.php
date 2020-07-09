<div class="card mt-2 ">
    <div class="card-header {{$jawaban->is_right_answer ? 'bg-success' : ''}}">Jawaban
        #{{$jawaban->user->name}}
        @if ($jawaban->is_author())
        <a href="/jawaban/{{$jawaban->id}}/edit" class="btn btn-sm btn-warning">Edit</a>
        <form action="/jawaban/{{$jawaban->id}}" method="POST" style="display:inline">
            @csrf
            @method('DELETE')
            <input type="hidden" name="question_id" value="{{$question->id}}">
            <button class="btn btn-danger btn-sm">
                Delete
            </button>
        </form>
        @endif
        @if ($question->user_id==Auth::user()->id)
        <form action="/jawaban/{{$jawaban->id}}/right" method="POST" style="display:inline">
            @csrf
            @method('PUT')
            <input type="hidden" name="question_id" value="{{$question->id}}">
            <input type="hidden" name="is_right_answer" value="{{$jawaban->is_right_answer ? 0 : 1}}">
            <button class="btn {{$jawaban->is_right_answer ? 'btn-dark' : 'btn-success'}} btn-sm">
                {{$jawaban->is_right_answer ? 'Not Right Answer?' : 'Mark as Right Answer?'}}
            </button>
        </form>
        @endif
    </div>

    <div class="card-body">
        {!!$jawaban->content!!}
        <footer>{{$jawaban->created_at}}</footer>
    </div>
</div>