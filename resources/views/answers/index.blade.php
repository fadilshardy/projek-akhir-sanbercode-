<div class="card mt-2 ">
    <div class="card-header {{$jawaban->is_right_answer ? 'bg-success text-light' : ''}}">
        <div class="row">
            <div class="col-sm-6 my-1">
                <a class=" {{$jawaban->is_right_answer ? 'question-correct' : 'question-title'}}" href="/profile/{{$jawaban->user->id}}"
                    class="{{$jawaban->is_right_answer ? 'text-light' : ''}}">{{$jawaban->user->name}}</a><br>
                <span style="font-size: 12px" class="{{$jawaban->is_right_answer ? 'question-correct' : 'text-secondary'}}">
                    @if ($jawaban->created_at==$jawaban->updated_at)
                    Posted {{$jawaban->created_at->diffForHumans()}}
                    @else
                    Updated {{$jawaban->updated_at->diffForHumans()}}
                    @endif</span>
            </div>

            <div class="col-sm-6 my-auto text-sm-right">
                <div class="dropdown">
                    <button class="btn btn-primary {{$jawaban->is_right_answer ? 'question-correct' : ''}} dropdown-toggle " type="button" data-toggle="dropdown"><i
                            class="fa fa-cog"></i>
                        <span class="caret"></span></button>
                    <ul class="dropdown-menu px-2">
                        <li><a href="#"><i class="fa fa-pencil"></i> Edit</a></li>
                        @if ($jawaban->is_author())
                        <li><a href="#" class="question-title"><i class="fa fa-caret-up mr-1" aria-hidden="true"></i> Upvote
                                ({{$jawaban->upvote_count()}})</a></li>
                        <li><a href="#" class="red-gradient"><i class="fa fa-caret-down mr-1" aria-hidden="true"></i> Downvote
                                ({{$jawaban->downvote_count()}})</a></li>
                        @else
                        <li>
                            {{-- @auth
                                <form class="d-inline-block"
                                action="/jawaban/{{$jawaban->id}}/{{$jawaban->vote_status() ? 'unvote/upvote' : 'upvote'}}"
                            method="POST">
                            @csrf
                            @endauth
                            <button class="btn btn-sm btn-vote {{$jawaban->vote_status() ? 'bg-success' : ''}}" @guest
                                onclick="alert('Login terlebih dahulu!')" @endguest>
                                <i class="fa fa-caret-up" aria-hidden="true"></i> Upvote ({{$jawaban->upvote_count()}})
                            </button>
                            @auth
                            </form> --}}
                        </li>
                        @endif
                        <hr class="my-1">
                        @auth
                        @if ($question->user_id==Auth::user()->id)
                            <li class="form-dropdown"> 
                                <span class="{{$jawaban->is_right_answer ? 'question-title ' : 'd-none'}}"><i class="fa fa-check-circle"></i> Marked as right answer<br></span>
                                <i class="{{$jawaban->is_right_answer ? 'd-none' : 'fa fa-question-circle'}}" aria-hidden="true"></i>
                                <form class="{{$jawaban->is_right_answer ? '' : 'd-inline-block'}}  text-center" action="/jawaban/{{$jawaban->id}}/right" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="question_id" value="{{$question->id}}">
                                    <input type="hidden" name="is_right_answer" value="{{$jawaban->is_right_answer ? 0 : 1}}">
                                    <button class="mt-1 {{$jawaban->is_right_answer ? 'btn btn-sm btn-warning btn-block' : 'button-less form-success'}}">
                                        <i class="{{$jawaban->is_right_answer ? 'fa fa-question-circle' : 'd-none'}}"></i>
                                        {{$jawaban->is_right_answer ? 'Not the right answer?' : 'Mark as Right Answer?'}}
                                    </button>
                                </form>
                            </li>
                        @endif
                        @endauth
                        @if ($jawaban->is_author())
                        <form class="" action="/jawaban/{{$jawaban->id}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="question_id" value="{{$question->id}}">
                            <button class="btn btn-danger btn-sm btn-block mt-1">
                                <i class="fa fa-trash"></i>&nbsp; Delete Answer
                            </button>
                        </form>
                        @endif
                    </ul>
                </div>
            </div>

            {{-- <div class="col-sm-12 col-lg-8 my-auto text-lg-right">
                @if($jawaban->is_author() )
                <button class="btn btn-sm btn-vote {{$jawaban->vote_status() ? 'bg-success' : ''}}">
            {{$jawaban->upvote_count()}}
            <i class="fa fa-caret-up" aria-hidden="true"></i>
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
                    <i class="fa fa-caret-up" aria-hidden="true"></i>
                </button>
                @auth</form>
            @endauth
            @endif

            @if($jawaban->is_author() )
            <button class="btn btn-sm btn-vote {{$jawaban->vote_status() === 0 ? 'bg-danger' : ''}}">
                {{$jawaban->downvote_count()}}
                <i class="fa fa-caret-down" aria-hidden="true"></i>
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
                    <i class="fa fa-caret-down" aria-hidden="true"></i>
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
            <a href="/profile/{{$komentar->user->id}}"><span
                    class="badge badge-dark">{{$komentar->user->name}}</span></a> : {{$komentar->content}}
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
                        <input type="text" required class="form-control input-sm" placeholder="Tambahkan komentar ..."
                            name="content">
                        <button class="btn btn-light btn-sm ml-2" type="submit"><i class="fa fa-share fa-rotate-180"
                                aria-hidden="true"></i> Enter</button>
                    </div>
                </div>
            </div>

        </form>
    </p>
</div>
</div>
