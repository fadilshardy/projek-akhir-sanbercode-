@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <a href="/pertanyaan" class="btn btn-secondary btn-sm mb-2"><i class="fa fa-arrow-left
                "></i> Kembali</a>
            <div class="card">
                <div class="card-header">Pertanyaan oleh #
                    {{$question->user->name}} 
                    @foreach ($question->tag as
                    $tag_question)
                    <button class="btn btn-info btn-sm float-right mr-1">#{{$tag_question->tag_name}}</button>
                    @endforeach</div>
                <div class="card-body">
                    <h1>{{$question->title}} </h1>
                    <p>{{$question->content}}</p>
                    <small>{{$question->created_at}}</small>
                </div>
            </div>
            @if (!$commentq->isEmpty())
            <div class="card mt-3">
                <div class="card-header bg-secondary text-white">
                    Komentar:
                </div>

                <div class="card-body">
                    <p class='border'>
                        @foreach ($commentq as $comment)
                        @include('questions.comment.show')
                        @endforeach

                    </p>@auth
                    <form action="/komentar_pertanyaan" method="post">
                        @csrf
                        <input type="hidden" name="question_id" value="{{$question->id}}">
                        <input type="text" class="form-control form-control-sm mt-2" name="content"
                            placeholder="Tekan tombol Enter untuk memberi komentar...">
                    </form>@endauth
                </div>
            </div>            
            <hr class="my-2">
            @endif
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