<li>
    <form action="/jawaban/{{$jawaban->id}}/{{$jawaban->vote_status() ? 'unvote/upvote' : 'upvote'}}" method="POST">
        @csrf
        <div class="upvote {{$jawaban->vote_status() ? 'voted' : ''}}">
            <div>
                <i class="fa fa-caret-up ml-1 mr-1 question-title" aria-hidden="true"></i>
        <button class="question-title border-0 {{$jawaban->vote_status() ? '' : ''}}">
            
            Upvote
            ({{$jawaban->upvote_count()}})
        </button>
            </div>
        </div>
    </form>
</li>
<li>
    <form action="/jawaban/{{$jawaban->id}}/{{$jawaban->vote_status() === 0 ? 'unvote/downvote ' : 'downvote'}}"
        method="POST">
        @csrf
        <div class="downvote {{$jawaban->vote_status() === 0 ? 'voted' : ''}}" >
            <div>
                <i class="fa fa-caret-down ml-1 red-gradient" aria-hidden="true"></i>
                <button class="red-gradient border-0 {{$jawaban->vote_status() === 0 ? '' : ''}}">
                    Downvote
                    {{$jawaban->downvote_count()}}
                    
                </button>
            </div>
        </div>
    </form>
</li>