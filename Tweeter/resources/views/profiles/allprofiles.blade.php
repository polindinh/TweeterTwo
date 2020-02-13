@extends ('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Profile</div>
                    <div class="card-body">
                        @include('flashMessage')
                        @isset($profiles)
                                @if ( Auth::user()->id == $profiles->user_id )
                                        <div>
                                            <img class="profileImage" src="{{asset('/storage/'.$profiles->profile_pic)}}" style="border-radius:50%" alt="Image">
                                            <br>
                                            <br>
                                            <h2>{{$profiles->name}}</h2>
                                            {{$profiles->gender}} <br>
                                            {{$profiles->id}} <br>

                                            {{$profiles->date_of_birth}}<br>
                                            {{$profiles->quote}}<br>
                                            <p>Member since: {{$profiles->created_at}}</p>
                                        </div>
                                        <div>
                                            <ul class="nav">
                                                <li class="nav-item">
                                                    <a class="nav-link" href="/following">
                                                        <span> </span> Following ()
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="/follower">
                                                        <span > </span> Follower ()
                                                    </a>
                                                </li>
                                            </ul>

                                        </div>
                                        <form action="/updateProfileForm/{{$profiles->id}}" method="POST">
                                            @csrf
                                            <input type="hidden" name="user_id" value={{Auth::user()->id}} class="btn btn-bg btn-primary">
                                            <input type="hidden" name="id" value={{$profiles->id}} class="btn btn-bg btn-primary">
                                            <input type="submit" value="Edit Profile"  class="btn btn-bg btn-primary">
                                            <input type="submit" value="Delete Profile"  class="btn btn-bg btn-primary">

                                        </form>
                                    @else
                                        <div>
                                            <img class="profileImage" src="{{asset('/storage/'.$profiles->profile_pic)}}" style="border-radius:50%" alt="Image">
                                            <br>
                                            <br>
                                            <h2>{{$profiles->name}}</h2>
                                            {{-- {{$profiles->id}} <br> --}}
                                            {{$profiles->gender}} <br>
                                            {{$profiles->date_of_birth}}<br>
                                            {{$profiles->quote}}<br>
                                            <p>Member since: {{$profiles->created_at}}</p>
                                            <ul class="nav">
                                                <li class="nav-item">
                                                    <a class="nav-link" href="/like">
                                                        <span > </span> Following ()
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="/dislike">
                                                        <span > </span> Follower ()
                                                    </a>
                                                </li>
                                            </ul>

                                        </div>
                                    @endif
                        @endisset
                        @empty($profiles)
                        <p>This user has not set up a profile yet!</p>
                        @endempty

                        <hr>
                        <h3>Recent Tweets </h3>
                        @if (count($tweets)>0)
                                @foreach ($tweets as $tweet)
                                    @php
                                        $likeCount = count(\App\Tweet::find($tweet->id)->like);
                                        // $dislikeCount = count(\App\Tweet::find($tweet->id)->dislike);

                                    @endphp
                                    @if ($tweet-> user_id == Auth::user()->id)
                                    <a href="/profile/{{$tweet->user->id}}"><p><strong>{{$tweet-> user->name}}</strong></p></a>
                                    <p>{{substr($tweet-> content,0,150)}}</p>
                                        <p><i>Posted on: {{$tweet-> created_at}}</i></p>
                                        <p><i>Updated on: {{$tweet-> updated_at}}</i></p>

                                        @include('navbarUser')
                                        <br>
                                        <hr>
                                    @else
                                        <a href="/profile/{{$tweet->user->id}}"><p><strong>{{$tweet-> user->name}}</strong></p></a>
                                        <p>{{substr($tweet-> content,0,150)}}</p>
                                        <p><i>Posted on: {{$tweet-> created_at}}</i></p>
                                        <p><i>Updated on: {{$tweet-> updated_at}}</i></p>

                                        @include('navbarGuest')
                                        <hr>
                                    @endif
                                @endforeach
                            @else
                                <p>No tweet found!</p>
                            @endif




                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection




