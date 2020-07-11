<div class="col-sm-3">
    <div class="card">
        <div class="text-light-blue card-header">Cari Berdasarkan Tag</div>
        <div class="card-body">
            @foreach ($tag as $taging)
            <a href="/tag/{{$taging->id}}" class="btn btn-sm border mt-1">                          
        <i class="fa fa-hashtag" aria-hidden="true"></i> {{$taging->tag_name}}</a>
            @endforeach
        </div>
    </div>
    <div class="card mt-2">
        <div class="text-light-blue card-header">Anggota Paling Aktif</div>
        <div class="card-body">
            <ul class="list-group list-group-flush ">
                @foreach ($user as $key => $pengguna)
                    
            <li class="list-group-item border-bottom px-1 mb-1 d-flex justify-content-between align-items-center card-text"><a class=" question-title" href="profile/{{$pengguna->id}}">{{$key+1}}.</i> {{$pengguna->name}} </a></i> 
                <span class="badge badge-{{($pengguna->point>=0)?'success':'danger'}} badge-pill">{{$pengguna->point}}</span></li>

                
                @endforeach
            </ul>
            <a href="/rank" class="btn btn-sm btn-light shadow-sm border mt-1">See more...</a>
        </div>
    </div>
</div>