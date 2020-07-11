@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="text-light-blue card-header">Edit Jawaban</div>

                <div class="card-body">
                    <form action="{{route('jawaban.update', $answer->id)}}" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="question_id" value="{{$answer->question_id}}">
                        <div class="form-group">
                            <label for="content">Jawaban</label>
                            <textarea name="content" class="form-control" id="content" cols="30"
                                rows="10">{{$answer->content}}</textarea>
                        </div>

                        <button type="submit" class="btn btn-success mt-2">Submit</button>
                    </form>
                </div>
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
    CKEDITOR.instances.editor1.document.getBody().getText();

</script>
@endpush