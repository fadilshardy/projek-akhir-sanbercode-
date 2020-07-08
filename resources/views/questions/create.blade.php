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
                            <label for="title">isi title</label>
                            <input type="text" class="form-control" name="title" placeholder="Isi title">
                        </div>

                        <div class="form-group">
                            <label for="content">Isi</label>
                            <textarea name="content" class="form-control" id="content" cols="30" rows="10"></textarea>
                        </div>

                        <button type="submit" class="btn btn-secondary mt-2">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection