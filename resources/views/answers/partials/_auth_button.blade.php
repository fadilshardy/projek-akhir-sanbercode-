<li class="form-dropdown">
    <span class="{{$jawaban->is_right_answer ? 'question-title ' : 'd-none'}}"><i class="fa fa-check-circle"></i> Marked
        as right answer<br></span>
    <i class="{{$jawaban->is_right_answer ? 'd-none' : 'fa fa-question-circle'}}" aria-hidden="true"></i>
    <form class="{{$jawaban->is_right_answer ? '' : 'd-inline-block'}}  text-center"
        action="/jawaban/{{$jawaban->id}}/right" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="question_id" value="{{$question->id}}">
        <input type="hidden" name="is_right_answer" value="{{$jawaban->is_right_answer ? 0 : 1}}">
        <button
            class="mt-1 {{$jawaban->is_right_answer ? 'btn btn-sm btn-warning btn-block' : 'button-less form-success'}}">
            <i class="{{$jawaban->is_right_answer ? 'fa fa-question-circle' : 'd-none'}}"></i>
            {{$jawaban->is_right_answer ? 'Not the right answer?' : 'Mark as Right Answer?'}}
        </button>
    </form>
</li>