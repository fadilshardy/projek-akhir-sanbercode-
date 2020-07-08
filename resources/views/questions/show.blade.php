@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Pertanyaan #{{$question->user->name}}</div>

                <div class="card-body">
                    <h1>{{$question->title}}</h1>
                    <p>{{$question->content}}</p>
                    
                </div>
            </div>
            @foreach ($answer as $jawaban)
                        
                    
            <div class="card mt-2 ">
                <div class="card-header bg-success">Jawaban #{{$jawaban->user->name}} 

                
                    @if ($jawaban->user_id==Auth::user()->id)
                    <a href="/jawaban/{{$jawaban->id}}/edit" class="btn btn-sm btn-warning">Edit</a>
                    <form action="/jawaban/{{$jawaban->id}}" method="POST" style="display:inline">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="question_id" value="{{$question->id}}">
                    <button class="btn btn-danger btn-sm">
                        Delete
                    </button>
                </form>
                                    
                @endif
            </div>

                <div class="card-body">
                    {{$jawaban->content}}
                    
                </div>
            </div>
            @endforeach
            <div class="card-body">
            <form action="/jawaban" method="POST">
                    @csrf
                    <input type="hidden" name="question_id" value="{{$question->id}}">
                    <div class="form-group">
                        <label for="content">Jawaban</label>
                        <textarea name="content" class="form-control" id="content" cols="5" rows="5"></textarea>
                    </div>

                    <button type="submit" class="btn btn-secondary mt-2">Submit</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection