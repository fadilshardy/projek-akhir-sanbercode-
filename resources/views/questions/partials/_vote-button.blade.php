<div class="col-sm-2 summary d-flex align-items-center justify-content-end text-right">
    <div class="row">
        <div class="col-sm mr-1">
            <form action="/pertanyaan/{{$item->id}}/{{$item->vote_status() ? 'unvote/upvote' : 'upvote'}}"
                method="POST">
                @csrf
                <button class="btn btn-lg btn-vote {{$item->vote_status() ? 'bg-success' : ''}}">
                    <h5>{{$item->upvote_count()}}</h5>
                    <p><i class="fa fa-arrow-up"></i></p>
                </button>
            </form>
        </div>

        <div class="col-sm">
            <form action="/pertanyaan/{{$item->id}}/{{$item->vote_status() === 0 ? 'unvote/downvote ' : 'downvote'}}"
                method="POST">
                @csrf
                <button class="btn btn-lg btn-vote {{$item->vote_status() === 0 ? 'bg-danger' : ''}}">
                    <h5>{{$item->downvote_count()}}</h5>
                    <p><i class="fa fa-arrow-down"></i></p>
                </button>
            </form>
        </div>
    </div>
</div>