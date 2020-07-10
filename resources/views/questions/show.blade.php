@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-9">
            <a href="{{ URL::previous() }}" class="btn btn-secondary btn-sm mb-3"><i class="fa fa-arrow-left
                "></i> Kembali</a>
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-12 col-md-6 my-auto">
                            Pertanyaan oleh # {{$question->user->name}} <br>
                            @if ($question->is_author())
                            <a href="{{$question->id}}/edit" class="btn btn-xs btn-warning">Edit</a>
                            <button data-toggle="modal" data-target="#myModal" class="btn btn-xs btn-danger">Delete</button>
                            @endif
                        </div>
                        <div class="col-sm-12 col-md-6 my-auto text-sm-right">
                            @foreach ($question->tag as
                            $tag_question)
                            <button class="btn btn-info btn-sm">#{{$tag_question->tag_name}}</button>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    {{-- 
                        komentar 
                    --}}
                    <h1>{{$question->title}} </h1>
                    <small style="border-bottom: 1px solid grey">{{$question->created_at}}</small>
                    <p class="mt-2">{!!$question->content!!}</p>
                    <hr>
                    @if ($commentq->isEmpty())
                    <p class="text-center mb-2">
                        <small><em>Belum terdapat komentar</em></small>
                    </p>
                    @else 
                    <h6 class="mb-2 font-weight-bold">
                        <i class="fa fa-comments" aria-hidden="true"></i> komentar:
                    </h6>
                    @endif
                    <p >
                        @foreach ($commentq as $comment)
                        @include('questions.comment.show')
                        @endforeach

                    </p>
                    @auth
                    <form action="/komentar_pertanyaan" method="post">
                        @csrf
                        <input type="hidden" name="question_id" value="{{$question->id}}">
                        <input type="text" class="form-control form-control-sm mt-2" name="content"
                            placeholder="Tambahkan komentar . . .">
                    </form>
                    @endauth

                    {{-- 
                        jawaban 
                    --}}
                    <hr class="my-2">
                    <hr>
                    <h6 class="my-2 font-weight-bold">
                        <i class="fa fa-reply" aria-hidden="true"></i> <span id="jumlah"></span> jawaban:
                    </h6>
                    @foreach ($answer as $jawaban)
                    @include('answers.index')
                    @endforeach
                    @auth
                    @include('answers.create')
                    @endauth
                </div>
            </div>

            {{-- <div class="card mt-3">
                <div class="card-header bg-secondary text-white">
                    Komentar:
                </div>

                <div class="card-body">
                    @if ($commentq->isEmpty())
                    <p class="text-center mb-2">
                        Belum terdapat komentar
                    </p>
                    @endif
                    <p class='border'>
                        @foreach ($commentq as $comment)
                        @include('questions.comment.show')
                        @endforeach

                    </p>
                    @auth
                    <form action="/komentar_pertanyaan" method="post">
                        @csrf
                        <input type="hidden" name="question_id" value="{{$question->id}}">
                        <input type="text" class="form-control form-control-sm mt-2" name="content"
                            placeholder="Tekan tombol Enter untuk memberi komentar...">
                    </form>
                    @endauth
                </div>
            </div> --}}

            
        </div>
    </div>
</div>

<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
  
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Attention!</h4>
            <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
          <p>Yakin ingin menghapus pertanyaan ini?</p>
        </div>
        <div class="modal-footer">
            <form class="d-inline-block" action="{{$question->id}}/delete" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger">Hapus</button>
            </form>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        </div>
      </div>
  
    </div>
  </div>
@endsection

@push('scripts')
<script src="{{asset('ckeditor/ckeditor.js')}}"></script>
<script>
    var konten = document.getElementById("content");
    CKEDITOR.replace(content, {
        language: 'en-gb'
    });
    CKEDITOR.config.allowedContent = true;
    CKEDITOR.instances.editor1.document.getBody().getText()

</script>
<script>
    const jawab = document.getElementById('jumlah')
</script>
@endpush