@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="{{ URL::previous() }}" class="btn btn-secondary btn-sm mb-3"><i class="fa fa-arrow-left
                "></i> Kembali</a>
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-sm-12 col-md-6">
                            Pertanyaan oleh #
                            {{$question->user->name}}
                        </div>
                        <div class="col-sm-12 col-md-6 mt-2 text-sm-right">
                            @foreach ($question->tag as
                            $tag_question)
                            <button class="btn btn-info btn-sm">#{{$tag_question->tag_name}}</button>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <h1>{{$question->title}} </h1>
                    <small>{{$question->created_at}}</small>
                    <hr>
                    <p>{!!$question->content!!}</p>
                </div>
            </div>
            <div class="card mt-3">
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
            </div>
            <hr class="my-2">
            @foreach ($answer as $jawaban)
            @include('answers.index')
            @endforeach
            @auth
            @include('answers.create')
            @endauth
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
@endpush