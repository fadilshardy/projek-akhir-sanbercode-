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
                    <h4 class="mb-0">Kumpulan pertanyaan</h4>
                  </div>

                  <div>
                    <p class="d-inline-block mb-0">
                      Ingin membuat pertanyaan baru? 
                    </p>
                    <a href="" class="btn btn-sm btn-success ml-2">
                      <i class="fa fa-edit"></i> Create
                    </a>
                  </div>
                </div>

                <div class="card-body">
                  {{-- start of 1 question  --}}
                  <div id="question" href="" class="col-sm-12 row">
                    <div class="col-sm-10">
                      <h5 class="card-subtitle">Judul artikelnya uhuy</h5><br>
                      <p class="card-text">pembuat</p>
                      <div class="tags">
                        <button class="btn btn-sm btn-info">tag1</button>
                        <button class="btn btn-sm btn-info">tag2</button>
                        <button class="btn btn-sm btn-info">tag3</button>
                      </div>
                    </div>
                    <div class="col-sm-2 summary d-flex align-items-center justify-content-end">
                        <div class="col-sm">
                          <div class="card  text-center">
                            <h5>0</h5>
                            <p>vote</p>
                          </div>
                        </div>
                        <div class="col-sm">
                          <div class="card  text-center">
                            <h5>0</h5>
                            <p>answer</p>
                          </div>
                        </div>
                    </div>
                  </div>
                  <hr>
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