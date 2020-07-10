@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <h1 class="title my-3">
                Selamat datang di forum Laravel!
            </h1>
            <hr>

            <div class="row">
                <div class="col-sm-9">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div>
                                <h4 class="mb-0">Kumpulan Pertanyaan</h4>
                            </div>

                            <div>
                                <p class="d-inline-block mb-0">
                                    Ingin membuat pertanyaan baru?
                                </p>
                                @auth
                                <a href="/pertanyaan/create" class="btn btn-sm btn-success ml-2">
                                    <i class="fa fa-edit"></i> Create
                                </a>
                                @endauth
                                @guest
                                <a href="/login" class="btn btn-sm btn-success ml-2">
                                    <i class="fa fa-login"></i> Login
                                </a>
                                @endguest
                            </div>
                        </div>

                        <div class="card-body">
                            @foreach ($questions as $key => $item)
                            {{-- start of 1 question  --}}
                            <div id="question" href="" class="col-sm-12 row">
                                <div class="col-sm-9">
                                    <h5 class="card-subtitle">
                                        <a href="/pertanyaan/{{$item->id}}">{{$item->title}}</a>
                                    </h5><br>
                                    <p class="card-text font-weight-light text-muted">Pembuat: {{$item->user->name}}</p>
                                    <div class="tags">
                                        @foreach ($item->tag as $tag_question)
                                        <button class="btn btn-info btn-sm">#{{$tag_question->tag_name}}</button>
                                        @endforeach
                                    </div>
                                </div>
                                @include('questions.partials._vote-button')
                            </div>
                            <hr>
                            @endforeach
                            {{-- end of 1 question --}}
                        </div>
                    </div>
                </div>

                <div class="col-sm-3">
                    <div class="card">
                        <div class="card-header">Explore by Tags</div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><i class="fa fa-star" aria-hidden="true"></i> Node.JS</li>
                            <li class="list-group-item"><i class="fa fa-star" aria-hidden="true"></i> HTML</li>
                            <li class="list-group-item"><i class="fa fa-star" aria-hidden="true"></i> CSS</li>
                            <li class="list-group-item"><i class="fa fa-star" aria-hidden="true"></i> PHP</li>
                            <li class="list-group-item"><i class="fa fa-star" aria-hidden="true"></i> JavaScript</li>
                        </ul>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection