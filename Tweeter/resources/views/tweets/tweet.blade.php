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
                                        @php
                                            $likeCount = count(\App\Tweet::find($tweets->id)->like);
                                            $dislikeCount = count(\App\Tweet::find($tweets->id)->dislike);

                                        @endphp
                                        @include('navbarsUser')

                                    @else
                                        <p><strong>{{$tweets-> user->name}}</strong></p>
                                        <p>{{$tweets-> content}}</p>
                                        <p><i>Posted on: {{$tweets-> created_at}}</i></p>
                                        @php
                                            $likeCount = count(\App\Tweet::find($tweets->id)->like);
                                            $dislikeCount = count(\App\Tweet::find($tweets->id)->dislike);

                                        @endphp
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
