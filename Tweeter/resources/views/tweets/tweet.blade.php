@extends ('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Tweet View</div>
                    <div class="card-body">
                        <div>
                                {{-- @foreach ($tweets as $tweet) --}}
                                    @if ($tweets-> user_id == Auth::user()->id)
                                        <p><strong>{{$tweets-> user->name}}</strong></p>
                                        <p>{{$tweets-> content}}</p>
                                        {{-- <p>{{$tweet-> user_id}}</p> --}}
                                        <p><i>Posted on : {{$tweets-> created_at}}</i></p>
                                        @include('navbarsUser')

                                    @else
                                        <p><strong>{{$tweets-> user->name}}</strong></p>
                                        <p>{{$tweets-> content}}</p>
                                        <p><i>Posted on: {{$tweets-> created_at}}</i></p>
                                        @include('navbarsGuest')
                                        <hr>

                                    @endif
                                {{-- @endforeach --}}


                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
