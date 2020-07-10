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
                        <div class="card-header">
                            <div class="row">
                                <div class="col-sm-12 col-md-6 my-1">
                                    <h4 class="mb-0">Kumpulan Pertanyaan</h4>
                                </div>

                                <div class="col-sm-12 col-md-6 my-1">
                                    <p class="d-inline-block mb-0">
                                        Ingin membuat pertanyaan baru?
                                    </p>
                                    @auth
                                    <a href="/pertanyaan/create" class="btn btn-sm btn-success ml-lg-2">
                                        <i class="fa fa-edit"></i> Create
                                    </a>
                                    @endauth
                                    @guest
                                    <a href="/login" class="btn btn-sm btn-success ml-lg-2">
                                        <i class="fa fa-login"></i> Login
                                    </a>
                                    @endguest
                                </div>
                            </div>
                        </div>

                        <div class="card-body">
                            @foreach ($questions as $key => $item)
                            {{-- start of 1 question  --}}
                            <div id="question" href="" class="col-sm-12 row">
                                <div class="col-sm-12 col-md-9">
                                    <h5 class="card-subtitle">
                                        <a href="/pertanyaan/{{$item->id}}">{{$item->title}}</a>
                                    </h5><br>
                                    <p class="card-text font-weight-light text-muted">
                                        Pembuat: {{$item->user->name}}
                                        
                                    </p>

                                    <div class="tags">
                                        @foreach ($item->tag as $tag_question)
                                        <a href="/tag/{{$tag_question->id}}" class="btn btn-info btn-sm my-1">
                                        #{{$tag_question->tag_name}}
                                        </a>
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
                    <div class="card sticky">
                        <div class="card-header">Explore by Tags</div>
                        <div class="card-body">
                            @foreach ($tag as $taging)
                            <a href="/tag/{{$taging->id}}" class="btn btn-sm border mt-1">                          
                        <i class="fa fa-hashtag" aria-hidden="true"></i> {{$taging->tag_name}}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection