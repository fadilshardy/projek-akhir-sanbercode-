<div class="col-sm-2 summary d-flex align-items-center justify-content-end text-right">
    <div class="row">
        <div class="col-sm mr-1">
            @auth
            <form action="/pertanyaan/{{$item->id}}/{{$item->vote_status() ? 'unvote/upvote' : 'upvote'}}"
                method="POST">
                @csrf
                @endauth
                <button class="btn btn-lg btn-vote {{$item->vote_status() ? 'bg-success' : ''}}"
                    @guest onclick="alert('Login terlebih dahulu!')" @endguest
                    >
                    <h5>{{$item->upvote_count()}}</h5>
                    <p><i class="fa fa-arrow-up"></i></p>
                </button>
                @auth
            </form>
            @endauth

        </div>

        <div class="col-sm">
            @auth
            <form action="/pertanyaan/{{$item->id}}/{{$item->vote_status() === 0 ? 'unvote/downvote ' : 'downvote'}}"
                method="POST">
                @csrf
                @endauth
                <button class="btn btn-lg btn-vote {{$item->vote_status() === 0 ? 'bg-danger' : ''}}" @guest onclick="alert('Login terlebih dahulu!')" @endguest>
                    <h5>{{$item->downvote_count()}}</h5>
                    <p><i class="fa fa-arrow-down"></i></p>
                </button>
                @auth
            </form>
            @endauth
        </div>
    </div>
</div>