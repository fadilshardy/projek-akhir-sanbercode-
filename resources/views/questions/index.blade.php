@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="pt-1 mx-3">
                <div class="my-2 text-center">
                    <a href="/pertanyaan/create" class="btn btn-secondary btn-sm">
                        Buat pertanyaan baru</a>
                </div>

                <div class="card">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th style="width: 10px">#</th>
                                <th>Judul</th>
                                <th>Deskripsi</th>
                                <th style="width: 200px">Detail</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($questions as $key => $item)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$item->title}}</td>
                                <td>{{$item->content}}</td>
                                <td class="text-white text-center">
                                    <a href="/questions/{{$item->id}}" class="btn btn-success  btn-sm">view</a>
                                    <a href="/questions/{{$item->id}}/edit" class="btn btn-info btn-sm">Edit</a>
                                    <form action="/questions/{{$item->id}}" method="POST" style="display:inline">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">
                                            Delete
                                        </button>
                                    </form>

                                </td>

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