@extends('layouts.app')

@section('content')
@if (session('status'))
<div class="alert alert-success">
    {{ session('status') }}
</div>
@endif

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">My Profile</div>
                <div class="card-body justify-content-center">
                    @if ($profile)
                    <img src="{{asset('/img/avatar.jpg')}}" alt="Avatar" class="img-thumbnail rounded float-left">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Nama Panggilan: {{Auth::user()->name}}</li>
                        <li class="list-group-item">Nama Lengkap: {{$profile->full_name}}</li>
                        <li class="list-group-item">Alamat: {{$profile->address}}</li>
                        <li class="list-group-item">Email: {{Auth::user()->email}}</li>
                        <li class="list-group-item">Total Point: {{Auth::user()->point}}</li>
                        <li class="list-group-item">Total Pertanyaan: {{$question}}</li>
                        <li class="list-group-item">Total Jawaban: {{$answer}}</li>
                    </ul>
                    <p><a href="/profile/{{Auth::user()->id}}/edit" class="btn btn-primary float-right">Edit Profile</a>
                    </p>
                    @else
                    Profilemu masih kosong, lengkapi profilemu sekarang juga.<br>
                    <a href="/profile/create" class="btn btn-primary">Lengkapi Profile</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>


@endsection