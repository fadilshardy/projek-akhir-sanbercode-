<div class="card mt-2 ">
    <div class="card-header {{$jawaban->is_right_answer ? 'bg-success text-light' : ''}}">
        <div class="row">
            <div class="col-sm-12 col-lg-4 my-1">
                <a class="question-title" href="/profile/{{$jawaban->user->id}}"
                    class="{{$jawaban->is_right_answer ? 'text-light' : ''}}">{{$jawaban->user->name}}</a><br>
                <span style="font-size: 12px" class="text-secondary">
                    @if ($jawaban->created_at==$jawaban->updated_at)
                    Posted {{$jawaban->created_at->diffForHumans()}}
                    @else
                    Updated {{$jawaban->updated_at->diffForHumans()}}
                    @endif</span>
            </div>

            <div class="col-sm-12 col-lg-8 my-auto text-lg-right">
                <div class="dropdown">
                    <button class="btn btn-primary dropdown-toggle " type="button" data-toggle="dropdown"><i
                            class="fa fa-cog"></i>
                        <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                        <li><a href="#"><i class="fa fa-edit"></i> Edit</a></li>
                        <li><a href="#"><i class="fa fa-trash-alt"></i> Hapus</a></li>
                    </ul>
                </div>
            </div>

            {{-- <div class="col-sm-12 col-lg-8 my-auto text-lg-right">
                @if($jawaban->is_author() )
                <button class="btn btn-sm btn-vote {{$jawaban->vote_status() ? 'bg-success' : ''}}">
            {{$jawaban->upvote_count()}}
            <i class="fa fa-arrow-up"></i>
            </button>
            @else
            @auth
            <form class="d-inline-block"
                action="/jawaban/{{$jawaban->id}}/{{$jawaban->vote_status() ? 'unvote/upvote' : 'upvote'}}"
                method="POST">
                @csrf
                @endauth
                <button class="btn btn-sm btn-vote {{$jawaban->vote_status() ? 'bg-success' : ''}}" @guest
                    onclick="alert('Login terlebih dahulu!')" @endguest>
                    {{$jawaban->upvote_count()}}
                    <i class="fa fa-arrow-up"></i>
                </button>
                @auth</form>
            @endauth
            @endif

            @if($jawaban->is_author() )
            <button class="btn btn-sm btn-vote {{$jawaban->vote_status() === 0 ? 'bg-danger' : ''}}">
                {{$jawaban->downvote_count()}}
                <i class="fa fa-arrow-down"></i>
            </button>
            @else
            @auth
            <form class="d-inline-block"
                action="/jawaban/{{$jawaban->id}}/{{$jawaban->vote_status() === 0 ? 'unvote/downvote ' : 'downvote'}}"
                method="POST">
                @csrf
                @endauth
                <button class="btn btn-sm btn-vote {{$jawaban->vote_status() === 0 ? 'bg-danger' : ''}}" @guest
                    onclick="alert('Login terlebih dahulu!')" @endguest>
                    {{$jawaban->downvote_count()}}
                    <i class="fa fa-arrow-down"></i>
                </button>
                @auth
            </form>
            @endauth

            @endif

            @if ($jawaban->is_author())
            <a href="/jawaban/{{$jawaban->id}}/edit" class="btn btn-sm btn-warning">Edit</a>
            <form class="d-inline-block" action="/jawaban/{{$jawaban->id}}" method="POST">
                @csrf
                @method('DELETE')
                <input type="hidden" name="question_id" value="{{$question->id}}">
                <button class="btn btn-danger btn-sm">
                    Delete
                </button>
            </form>
            @endif

            @auth
            @if ($question->user_id==Auth::user()->id)
            <form class="d-inline-block" action="/jawaban/{{$jawaban->id}}/right" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" name="question_id" value="{{$question->id}}">
                <input type="hidden" name="is_right_answer" value="{{$jawaban->is_right_answer ? 0 : 1}}">
                <button class="btn {{$jawaban->is_right_answer ? 'btn-dark' : 'btn-success'}} btn-sm">
                    {{$jawaban->is_right_answer ? 'Not Right Answer?' : 'Mark as Right Answer?'}}
                </button>
            </form>
            @endif
            @endauth
        </div> --}}
    </div>
</div>

<div class="card-body">
    {!!$jawaban->content!!}
    {{-- @auth
    <a href="/komentar_jawaban/create/{{$jawaban->id}}" class="btn btn-sm btn-primary mt-3">Post A Reply</a>
        @endauth --}}
        <hr>
        <p>
            @if ($jawaban->comment->isEmpty())
            <small><em>Belum terdapat komentar</em></small>
            @else
            <small class="font-weight-bold">Komentar ({{count($jawaban->comment)}}):</small> <br>
            @endif
            @foreach ($jawaban->comment as $komentar)


        <button type="button" class="btn btn-sm btn-light">
            <a href="/profile/{{$komentar->user->id}}"><span class="badge badge-dark">{{$komentar->user->name}}</span></a> : {{$komentar->content}}
        </button>
        <small class="font-italic text-muted">{{$komentar->updated_at->diffForHumans()}}</small>
        <br>

        @endforeach
        <form action="/komentar_jawaban" method="post">
            @csrf
            <input type="hidden" name="answer_id" value="
            @auth {{$jawaban->id}} @endauth">
            <div class="row">
                <div class="col-sm-12 comment px-0">
                    <div class="input-group input-group-sm ml-2">
                        <input type="text" required class="form-control input-sm"
                            placeholder="Tambahkan komentar ..." name="content">
                        <button class="btn btn-light btn-sm ml-2" type="submit"><i class="fa fa-share fa-rotate-180" aria-hidden="true"></i> Enter</button>
                    </div>
                </div>
            </div>

        </form>
    </p>
</div>
</div>