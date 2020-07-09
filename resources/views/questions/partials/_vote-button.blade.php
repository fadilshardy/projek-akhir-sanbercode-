<div class="col-sm-2 summary d-flex align-items-center justify-content-end">
    <div class="col-sm" style="margin-left: -10px">
        @if ($item->vote_status())
        <form action="/pertanyaan/{{$item->id}}/unvote/upvote" method="POST">
            @csrf
            <button class="btn btn-lg btn-vote bg-success">
                <h5>{{$item->upvote_count()}}</h5>
                <p>up</p>
            </button>
        </form>
        @else
        <form action="/pertanyaan/{{$item->id}}/upvote" method="POST">
            @csrf
            <button class="btn btn-lg btn-vote ">
                <h5>{{$item->upvote_count()}}</h5>
                <p>up</p>
            </button>
        </form>
        @endif
    </div>

    <div class="col-sm" style="margin-left: 10px">
        @if ($item->vote_status() === 0)
        <form action="/pertanyaan/{{$item->id}}/unvote/downvote" method="POST">
            @csrf
            <button class="btn btn-lg btn-vote bg-danger">
                <h5>{{$item->downvote_count()}}</h5>
                <p>up</p>
            </button>
        </form>
        @else
        <form action="/pertanyaan/{{$item->id}}/downvote" method="POST">
            @csrf
            <button class="btn btn-lg btn-vote">
                <h5>{{$item->downvote_count()}}</h5>
                <p>down</p>
            </button>
        </form>
        @endif
    </div>
</div>