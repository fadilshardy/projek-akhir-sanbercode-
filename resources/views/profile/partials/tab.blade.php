<ul class="nav nav-tabs mt-3">
    <li class="nav-item">
      <a class="nav-link active text-light-blue" data-toggle="tab" href="#question">Pertanyaan ({{count($user->question)}})</a>
    </li>
    <li class="nav-item">
      <a class="nav-link text-light-blue" data-toggle="tab" href="#answer">Jawaban ({{count($user->answer)}})</a>
    </li>
  </ul>
  
  
  <div class="tab-content border">
    <div class="tab-pane container active" id="question">
      @if (!$user->question->isEmpty())
      @foreach ($user->question as $question)
        <div class="card mt-2 mb-3 shadow-sm">
            <div class="card-header">
           <a class="question-title" href="/pertanyaan/{{$question->id}}">{{$question->title}}</a>
            <br>
          <small class="font-italic text-muted">{{$question->updated_at->diffForHumans()}}</small>
        </div>
            <div class="card-body text-muted">
                
                {!! \Illuminate\Support\Str::limit(strip_tags($question->content), 150, $end='...') !!}...<a class="question-title" href="/pertanyaan/{{$question->id}}">selengkapnya</a> 
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
          
        <div class="card mt-2 mb-3 shadow-sm">
            <div class="card-header">
            <span class="text-light-blue">Menjawab Pertanyaan:</span>  <a class="question-title" href="/pertanyaan/{{$answer->question->id}}">{{$answer->question->title}}</a><br>
          <small class="font-italic text-muted">{{$answer->updated_at->diffForHumans()}}</small>
        </div>
            <div class="card-body text-muted">
                
                {!! \Illuminate\Support\Str::limit(strip_tags($answer->content), 150, $end='...') !!}...<a class="question-title" href="/pertanyaan/{{$answer->question->id}}">selengkapnya</a> 
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
  