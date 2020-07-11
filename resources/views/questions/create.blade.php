@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Buat Pertanyaan Baru</div>

                <div class="card-body">
                    <form action="{{route('pertanyaan.store')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="title">Judul</label>
                            <input required type="text" class="form-control" name="title" placeholder="Isi title">
                        </div>

                        <div class="form-group">
                            <label for="content">Isi</label>
                            <textarea required name="content" class="form-control" id="content" cols="30"
                                rows="10"></textarea>
                        </div>

                        <div class="form-group">
                            <label for="title">Tag</label>
                            <input required type="text" class="form-control" name="tags"
                                placeholder="tags pisahkan dengan koma">
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