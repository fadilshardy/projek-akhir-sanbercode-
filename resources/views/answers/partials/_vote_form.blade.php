<li>
    <form action="/jawaban/{{$jawaban->id}}/{{$jawaban->vote_status() ? 'unvote/upvote' : 'upvote'}}" method="POST">
        @csrf
        <button class="btn btn-sm question-title {{$jawaban->vote_status() ? 'bg-success' : ''}}">
            <i class="fa fa-caret-up mr-1" aria-hidden="true"></i>
            Upvote
            ({{$jawaban->upvote_count()}})
        </button>
    </form>
</li>
<li>
    <form action="/jawaban/{{$jawaban->id}}/{{$jawaban->vote_status() === 0 ? 'unvote/downvote ' : 'downvote'}}"
        method="POST">
        @csrf
        <button class="btn btn-sm red-gradient {{$jawaban->vote_status() === 0 ? 'bg-danger' : ''}}">
            Downvote
            {{$jawaban->downvote_count()}}
            <i class="fa fa-caret-down" aria-hidden="true"></i>
        </button>
    </form>
</li>