<div class="col-sm-3">
    <div class="card">
        <div class="text-light-blue card-header">Explore by Tags</div>
        <div class="card-body">
            @foreach ($tag as $taging)
            <a href="/tag/{{$taging->id}}" class="btn btn-sm border mt-1">                          
        <i class="fa fa-hashtag" aria-hidden="true"></i> {{$taging->tag_name}}</a>
            @endforeach
        </div>
    </div>
    <div class="card mt-2">
        <div class="text-light-blue card-header">Top 5 Most Active User</div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
                @foreach ($user as $key => $pengguna)
                    
            <li class="list-group-item">{{$key+1}}</i> {{$pengguna->name}} ({{$pengguna->point}}) <i class="fa {{($key+1==1)?'fa-star':''}}" aria-hidden="true"></i></li>

                
                @endforeach
            </ul>
        </div>
    </div>
</div>