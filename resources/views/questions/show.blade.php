@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Pertanyaan oleh #{{$question->user->name}} @foreach ($question->tag as
                    $tag_question)
                    <button class="btn btn-info btn-sm float-right mr-1">#{{$tag_question->tag_name}}</button>
                    @endforeach</div>
                <div class="card-body">
                    <h1>{{$question->title}} </h1>
                    <p>{{$question->content}}</p>
                    <small>{{$question->created_at}}</small>
                </div>
            </div>
            <div class="card mt-4">
                <div class="card-header">
                    Komentar:
                </div>

                <div class="card-body">
                    <p class='mt-2'>
                        @foreach ($commentq as $comment)
                        @include('questions.comment.show')
                        @endforeach

                    </p>
                    <form action="/komentar_pertanyaan" method="post">
                        @csrf
                        <input type="hidden" name="question_id" value="{{$question->id}}">
                        <input type="text" class="form-control form-control-sm" name="content"
                            placeholder="Tekan tombol Enter untuk memberi komentar...">
                    </form>
                </div>
            </div>

            <hr class="my-2">
            @foreach ($answer as $jawaban)
            @include('answers.index')
            @endforeach
            @include('answers.create')
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