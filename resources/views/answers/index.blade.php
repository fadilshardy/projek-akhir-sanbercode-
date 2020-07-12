<div class="card mt-2 shadow-sm">
    <div class="card-header {{$jawaban->is_right_answer ? 'bg-light text-light border-success' : ''}}">
        <div class="row">
            <div class="col-sm-6 my-1">
                <a class=" {{$jawaban->is_right_answer ? 'question-correct' : 'question-title'}}"
                    href="/profile/{{$jawaban->user->id}}"
                    class="{{$jawaban->is_right_answer ? 'text-light' : ''}}">{{$jawaban->user->name}}</a> <span class="{{$jawaban->is_right_answer ? 'question-title ' : 'd-none'}}"><i class="fa fa-check-circle"></i> </span><br>
                <span style="font-size: 12px"
                    class="{{$jawaban->is_right_answer ? 'question-correct' : 'text-secondary'}}">
                    @if ($jawaban->created_at==$jawaban->updated_at)
                    Dibuat {{$jawaban->created_at->diffForHumans()}}
                    @else
                    Diubah {{$jawaban->updated_at->diffForHumans()}}
                    @endif</span>
            </div>

            <div class="col-sm-6 my-auto text-sm-right">
                {{-- @if ($jawaban->user_id==Auth::user()->id)
                        @include('answers.partials._vote_button')
                @else
                        @include('answers.partials._vote_form')
                @endif --}}
                @auth
                
                <div class="dropdown">
                    @if ($jawaban->is_author()||$question->user_id==Auth::user()->id)
                    <button
                        class="btn btn-primary {{$jawaban->is_right_answer ? 'question-correct' : ''}} dropdown-toggle btn-xs"
                        type="button" data-toggle="dropdown"><i class="fa fa-cog"></i>
                        <span class="caret"></span>
                    </button>
                    @endif
                    <ul class="dropdown-menu px-2">
                        
                        
                        @if ($question->user_id==Auth::user()->id)
                        @include('answers.partials._auth_button')
                        @endif
                        <hr class="my-1">
                        
                        @if ($jawaban->is_author())
                        <form class="" action="/jawaban/{{$jawaban->id}}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="hidden" name="question_id" value="{{$question->id}}">
                            <button class="btn btn-danger btn-sm btn-block mt-1">
                                <i class="fa fa-trash"></i>&nbsp; Hapus
                            </button>
                        </form>
                        <li><a class="btn btn-secondary btn-sm btn-block mt-1 text-white"
                                href="/jawaban/{{$jawaban->id}}/edit"><i class="fa fa-pencil"></i> Edit</a></li>
                        @endif
                    </ul>
                </div>
                
                @endauth
            </div>

        </div>
    </div>

    <div class="card-body">
        {!!$jawaban->content!!}
        <hr>
        <p >
            @if ($jawaban->comment->isEmpty())
            <small><em>Belum terdapat komentar</em></small>
            @else
            <small class="font-weight-bold">Komentar ({{count($jawaban->comment)}}):</small> <br>
            @endif
            @foreach ($jawaban->comment as $komentar)


            <button type="button" class="btn btn-sm btn-light shadow-sm mb-2 d-inline-block">
                <a href="/profile/{{$komentar->user->id}}"><span
                        class="badge badge-dark">{{$komentar->user->name}}</span></a> : {{$komentar->content}}
            </button>
            <small class="font-italic text-muted ">{{$komentar->updated_at->diffForHumans()}}</small>
            @if ($komentar->user_id==Auth::user()->id)
            <form action="/jawaban/{{$komentar->id}}/delete_comment/" method="POST">
                @csrf
                @method('DELETE')
                <input type="hidden" name="question_id" value="{{$question->id}}">
                <button class="btn btn-xs btn-danger " >Delete</button>
            </form>
            @endif
            
            <br>

            @endforeach
            @auth
            <form action="/komentar_jawaban" method="post">
                @csrf
                <input type="hidden" name="answer_id" value="
             {{$jawaban->id}} ">
                <div class="row mt-2">
                    <div class="col-sm-12 comment px-0">
                        <div class="input-group input-group-sm ml-2">
                            <input type="text" required class="form-control input-sm"
                                placeholder="Tambahkan komentar ..." name="content">
                            <button class="btn btn-light btn-sm ml-2" type="submit"><i class="fa fa-share fa-rotate-180"
                                    aria-hidden="true"></i> Enter</button>
                        </div>
                    </div>
                </div>

            </form>
            @endauth
        </p>
    </div>
    <div class="card-footer ">
        @auth
        @if ($jawaban->user_id==Auth::user()->id)
                    <div class="answer-public">
                        @include('answers.partials._vote_button')
                    </div>
                @else
                <div class="answer-public">
                    @include('answers.partials._vote_form')
                </div>
                @endif
        @endauth
        @guest
        <div class="answer-public">
            @include('answers.partials._vote_button')
        </div>
        @endguest
      </div>
</div>

@if (session('error'))
@push('scripts')
<script>
    Swal.fire({
        text: '{{ session('error') }}',
        icon: 'error',
        confirmButtonText: 'close'
    });
</script>
@endpush
@endif