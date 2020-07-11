<div class="col-sm-12 col-md-3 summary">
    <div class="row">
        <div class="col-sm-6 text-md-right my-1">
            @if($item->is_author())
            <button class="btn btn-md btn-vote {{$item->vote_status() ? 'bg-success' : ''}}" @guest
                onclick="alert('Login terlebih dahulu!')" @endguest>
                <h5>{{$item->upvote_count()}}</h5>
                {{-- <div class="mt-2 arrow-up"></div> --}}
                <i class="fa fa-caret-up" aria-hidden="true"></i>
            </button>
            @else
            @auth
            <form action="/pertanyaan/{{$item->id}}/{{$item->vote_status() ? 'unvote/upvote' : 'upvote'}}"
                method="POST">
                @csrf
                @endauth
                <button class="btn btn-md btn-vote {{$item->vote_status() ? 'bg-success' : ''}}" @guest
                    onclick="alert('Login terlebih dahulu!')" @endguest>
                    <h5>{{$item->upvote_count()}}</h5>
                    <i class="fa fa-caret-up" aria-hidden="true"></i>
                </button>
                @auth
            </form>
            @endauth
            @endif
        </div>

        <div class="col-sm-6 text-lg-left my-1">
            @if($item->is_author() || Auth::guest())
            <button class="btn btn-md btn-vote {{$item->vote_status() === 0 ? 'bg-danger' : ''}}">
                <h5>{{$item->downvote_count()}}</h5>
                <i class="fa fa-caret-down" aria-hidden="true"></i>
            </button>
            @else
            @auth
            <form action="/pertanyaan/{{$item->id}}/{{$item->vote_status() === 0 ? 'unvote/downvote ' : 'downvote'}}"
                method="POST">
                @csrf
                @endauth
                <button class="btn btn-md btn-vote {{$item->vote_status() === 0 ? 'bg-danger' : ''}}">
                    <h5>{{$item->downvote_count()}}</h5>
                    <i class="fa fa-caret-down" aria-hidden="true"></i>
                </button>
                @auth
            </form>
            @endauth
            @endif
        </div>

        <div class="col-sm-12 text-center">
            <button class="btn btn-sm btn-success btn-block mt-1">Total answers: {{$item->answers_count}}</button>

        </div>
    </div>
</div>