@extends ('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Tweet View</div>
                    <div class="card-body">
                        <div>
                            @php
                            function checkLike($tweetToCheck, $users){
                                foreach ($users as $user) {
                                if($user->tweet_id == $tweetToCheck) {
                                return true;
                                }
                            }
                                return false;
                            }
                            @endphp
                                {{-- @foreach ($tweets as $tweet) --}}
                                    @if ($tweets-> user_id == Auth::user()->id)
                                        <a href="/profile/{{$tweets->user->id}}"><p><strong>{{$tweets-> user->name}}</strong></p></a>

                                        {{-- <p><strong>{{$tweets-> user->name}}</strong></p> --}}
                                        <p>{{$tweets-> content}}</p>
                                        {{-- <p>{{$tweet-> user_id}}</p> --}}
                                        <p class = "time"><i>Posted: {{$tweets-> created_at->diffForHumans()}}</i></p>
                                        <p class = "time"><i>Updated: {{$tweets-> updated_at->diffForHumans()}}</i></p>
                                        @php
                                            $likeCount = count(\App\Tweet::find($tweets->id)->like);
                                            // $dislikeCount = count(\App\Tweet::find($tweets->id)->dislike);

                                        @endphp
                                        @include('navbarsUser')
                                        <br>

                                        @if (checkLike($tweets->id, Auth::user()->like))
                                                {{-- <p>Already Following</p> --}}
                                            <form action="/unlike/{{$tweets->id}}" method="post">
                                                @csrf
                                            <input type="hidden" name="user_id" value = "{{$tweets->user_id}}">
                                                <input class="btn btn-warning rounded-pill" type="submit" value="Unlike">
                                            </form>
                                            @else
                                                <form action="/like/{{$tweets->id}}" method="post">
                                                    @csrf
                                                    <input class="btn btn-success rounded-pill"type="submit" value="Like">
                                                    <input type="hidden" name="user_id" value = "{{$tweets->user_id}}">

                                                </form>
                                            @endif

                                    @else
                                    <a href="/profile/{{$tweets->user->id}}"><p><strong>{{$tweets-> user->name}}</strong></p></a>

                                        {{-- <p><strong>{{$tweets-> user->name}}</strong></p> --}}
                                        <p>{{$tweets-> content}}</p>
                                        <p class = "time"><i>Posted: {{$tweets-> created_at->diffForHumans()}}</i></p>
                                        <p class = "time"><i>Updated: {{$tweets-> updated_at->diffForHumans()}}</i></p>                                        @php
                                            $likeCount = count(\App\Tweet::find($tweets->id)->like);
                                            $dislikeCount = count(\App\Tweet::find($tweets->id)->dislike);

                                        @endphp
                                        @include('navbarsGuest')
                                        <br>

                                        @if (checkLike($tweets->id, Auth::user()->like))
                                                {{-- <p>Already Following</p> --}}
                                            <form action="/unlike/{{$tweets->id}}" method="post">
                                                @csrf
                                            <input type="hidden" name="user_id" value = "{{$tweets->user_id}}">
                                                <input class="btn btn-warning rounded-pill" type="submit" value="Unlike">
                                            </form>
                                            @else
                                                <form action="/like/{{$tweets->id}}" method="post">
                                                    @csrf
                                                    <input class="btn btn-success rounded-pill"type="submit" value="Like">
                                                    <input type="hidden" name="user_id" value = "{{$tweets->user_id}}">

                                                </form>
                                            @endif
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
