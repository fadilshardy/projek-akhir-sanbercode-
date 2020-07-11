<ul class="nav nav-tabs mt-2">
    <li class="nav-item">
      <a class="nav-link active" data-toggle="tab" href="#question">Pertanyaan ({{count($user->question)}})</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#answer">Jawaban ({{count($user->answer)}})</a>
    </li>
  </ul>
  
  
  <div class="tab-content border">
    <div class="tab-pane container active" id="question">
      @if (!$user->question->isEmpty())
      @foreach ($user->question as $question)
          
        <div class="card my-2 shadow-sm">
            <div class="card-header">
           <a href="/pertanyaan/{{$question->id}}">{{$question->title}}</a>
            <br>
          <small class="font-italic text-muted">{{$question->updated_at->diffForHumans()}}</small>
        </div>
            <div class="card-body text-muted">
                
                {!! \Illuminate\Support\Str::limit($question->content, 150, $end='...') !!}. 
        </div>
        </div>
        
        @endforeach
        
      @else
      <div class="alert alert-dark mt-2" role="alert">
        Pengguna belum pernah bertanya.
      </div>
        @endif
      </div>
    <div class="tab-pane container fade" id="answer">
      @if (!$user->answer->isEmpty())
      @foreach ($user->answer as $answer)
          
        <div class="card my-2 shadow-sm">
            <div class="card-header">
           Menjawab Pertanyaan: <a href="/pertanyaan/{{$answer->question->id}}">{{$answer->question->title}}</a><br>
          <small class="font-italic text-muted">{{$answer->updated_at->diffForHumans()}}</small>
        </div>
            <div class="card-body text-muted">
                
                {!! \Illuminate\Support\Str::limit($answer->content, 150, $end='...') !!}. 
        </div>
        </div>
        
        @endforeach
        @else
        <div class="alert alert-dark mt-2" role="alert">
          Pengguna belum pernah menjawab.
        </div>
          @endif
      </div>
  </div>
  