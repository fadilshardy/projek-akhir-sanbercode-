@extends('layouts.app')

@section('content')
@if (session('status'))
<div class="alert alert-success">
    {{ session('status') }}
</div>
@endif

<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-12 col-md-8">
            <div class="card">
                <div class="text-light-blue card-header">My Profile</div>
                <div class="card-body justify-content-center">
                    @if ($user->profile)
                    @include('profile.partials.detail')
                    @include('profile.partials.tab')
                    <p><a href="/profile/{{Auth::user()->id}}/edit" class="btn btn-primary mt-2 float-right">Edit Profile</a>
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