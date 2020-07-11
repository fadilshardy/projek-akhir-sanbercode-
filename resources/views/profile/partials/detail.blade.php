<img src="{{asset('/img/avatar.jpg')}}" alt="Avatar" class="img-thumbnail rounded float-left">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item border-bottom mb-1">Nama Panggilan: {{$user->name}}</li>
                        @if ($user->profile)
                        <li class="list-group-item border-bottom mb-1">Nama Lengkap: {{$user->profile->full_name}}</li>
                        <li class="list-group-item border-bottom mb-1">Alamat: {{$user->profile->address}}</li>
                        @else
                        <li class="list-group-item border-bottom mb-1">Nama Lengkap: -</li>
                        <li class="list-group-item border-bottom mb-1">Alamat: -</li>
                    @endif
                        <li class="list-group-item @guest text-muted @endguest border-bottom mb-1">Email: {{(Auth::user())?$user->email:'Login untuk melihat email.'}}</li>
                        <li class="list-group-item border-bottom mb-1">Total Point: {{$user->point}}</li>
                        {{-- <li class="list-group-item">Total Pertanyaan: {{count($user->question)}}</li>
                        <li class="list-group-item">Total Jawaban: {{count($user->answer)}}</li> --}}
                    </ul>