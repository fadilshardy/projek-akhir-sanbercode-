<li>
    <form action="/jawaban/{{$jawaban->id}}/{{$jawaban->vote_status() ? 'unvote/upvote' : 'upvote'}}" method="POST">
        @csrf
        <i class="fa fa-caret-up mr-1 question-title" aria-hidden="true"></i>
        <button class="question-title border-0 {{$jawaban->vote_status() ? 'bg-success' : ''}}">
            
            Upvote
            ({{$jawaban->upvote_count()}})
        </button>
    </form>
</li>
<li>
    <form action="/jawaban/{{$jawaban->id}}/{{$jawaban->vote_status() === 0 ? 'unvote/downvote ' : 'downvote'}}"
        method="POST">
        @csrf
        <i class="fa fa-caret-down red-gradient" aria-hidden="true"></i>
        <button class="red-gradient border-0 {{$jawaban->vote_status() === 0 ? 'bg-danger' : ''}}">
            Downvote
            {{$jawaban->downvote_count()}}
            
        </button>
    </form>
</li>