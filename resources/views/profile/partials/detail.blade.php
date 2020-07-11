<img src="{{asset('/img/avatar.jpg')}}" alt="Avatar" class="img-thumbnail rounded float-left">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Nama Panggilan: {{$user->name}}</li>
                        @if ($user->profile)
                        <li class="list-group-item">Nama Lengkap: {{$user->profile->full_name}}</li>
                        <li class="list-group-item">Alamat: {{$user->profile->address}}</li>
                        @else
                        <li class="list-group-item">Nama Lengkap: -</li>
                        <li class="list-group-item">Alamat: -</li>
                    @endif
                        <li class="list-group-item">Email: {{$user->email}}</li>
                        <li class="list-group-item">Total Point: {{$user->point}}</li>
                        <li class="list-group-item">Total Pertanyaan: {{count($user->question)}}</li>
                        <li class="list-group-item">Total Jawaban: {{count($user->answer)}}</li>
                    </ul>