@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in!
                    <br>
                    <br>
                    <a href="/forum" class="btn btn-sm btn-info">Go to forum</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
{{-- 
@push('scripts')
    <script>
        setTimeout(function(){ {{ route('forum')}} }); }, 1500);
    </script>
@endpush --}}
