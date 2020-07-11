@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-12 col-md-8">
            <div class="card">
                <div class="card-header">My Profile</div>
                <div class="card-body">
                    <form action="{{route('profile.store')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="title">Nama Lengkap</label>
                            <input required type="text" class="form-control" name="full_name" placeholder="Nama Lengkap Anda">
                        </div>

                        <div class="form-group">
                            <label for="content">Alamat</label>
                            <textarea required name="address" class="form-control" id="content" cols="30" rows="10"></textarea>
                        </div>
                        <button type="submit" class="btn btn-success mt-2">Submit</button>
                    </form>
                </div>
            </div>
            </div>
    </div>
</div>


@endsection