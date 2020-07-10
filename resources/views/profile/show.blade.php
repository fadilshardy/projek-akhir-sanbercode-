@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Profile {{$user->name}}</div>
                <div class="card-body justify-content-center">
                    
                    <img src="{{asset('/img/avatar.jpg')}}" alt="Avatar" class="img-thumbnail rounded float-left">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Nama Panggilan: {{$user->name}}</li>
                        @if ($profile)
                        <li class="list-group-item">Nama Lengkap: {{$profile->full_name}}</li>
                        <li class="list-group-item">Alamat: {{$profile->address}}</li>
                        @else
                        <li class="list-group-item">Nama Lengkap: -</li>
                        <li class="list-group-item">Alamat: -</li>
                    @endif
                        <li class="list-group-item">Email: {{$user->email}}</li>
                        <li class="list-group-item">Total Point: {{$user->point}}</li>
                        <li class="list-group-item">Total Pertanyaan: {{$question}}</li>
                        <li class="list-group-item">Total Jawaban: {{$answer}}</li>
                    </ul>
                    
                </div>
            </div>
            </div>
    </div>
</div>


@endsection