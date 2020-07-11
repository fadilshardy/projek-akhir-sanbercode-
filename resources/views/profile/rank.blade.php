@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Ranking Anggota</div>
                <div class="card-body justify-content-center">
                    
                    <table class="table table-striped">
                        <thead>
                          <tr>
                            <th scope="col">#Rank</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Pertanyaan</th>
                            <th scope="col">Jawaban</th>
                            <th scope="col">Poin</th>
                            <th scope="col">...</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach ($user as $key => $pengguna)
                          <tr>
                          <th scope="row">{{$key+1}}</th>
                          <td>{{$pengguna->name}}</td>
                            <td>{{count($pengguna->question)}}</td>
                            <td>{{count($pengguna->answer)}}</td>
                            <td>{{$pengguna->point}}</td>
                            <td><a href="/profile/{{$pengguna->id}}" class="btn btn-sm btn-primary">Detail</a></td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                </div>
            </div>
            </div>
    </div>
</div>


@endsection