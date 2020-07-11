@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-12 col-md-8">
            <div class="card ">
                {{-- <div class="card-header">Komentar</div> --}}

                <div class="card-body">
                    <form action="/komentar_pertanyaan" method="POST">
                        @csrf
                        <input type="hidden" name="question_id" value="{{$question_id}}">
                        <div class="form-group">
                            <label for="content">Komentar</label>
                            <input type="text" required name="content" class="form-control">
                        </div>

                        <button type="submit" class="btn btn-success mt-2">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection