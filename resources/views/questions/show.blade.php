@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Pertanyaan #{{$question->id}}</div>

                <div class="card-body">
                    <h1>{{$question->title}}</h1>
                    <p>{{$question->content}}</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection