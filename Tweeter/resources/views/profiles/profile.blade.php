@extends ('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Profile</div>
                    <div class="card-body">
                        @include('flashMessage')
                        @foreach ($profiles as $profile)
                            @if ($profile->user_id == Auth::user()->id)
                                <div>
                                    <img class="profileImage" src="/storage/profile_images/{{$profile->profile_pic}}" style="border-radius:50%" alt="Image">
                                    <br>
                                    <br>
                                    <h2>{{$profile->name}}</h2>
                                    <form enctype="multipart/form-data" action="/profile" method="POST">
                                        @csrf
                                        <label>Update Profile Image</label> <br>
                                        {{-- <input type="hidden" name="id" value="{{$user->id}}"><br><br> --}}
                                        <input type="file" value="profile_pic"><br><br>
                                        <input type="submit" class="btn btn-bg btn-primary">
                                    </form>
                                    <ul class="nav">
                                        <li class="nav-item">
                                            <a class="nav-link" href="/like">
                                                <span class="fas fa-heart"> </span> Following ()
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="/dislike">
                                                <span class="fas fa-thumbs-down"> </span> Follower ()
                                            </a>
                                        </li>
                                    </ul>

                                </div>
                            @else
                                <div>
                                    <img class="profileImage" src="/storage/profile_images/{{$profile->profile_pic}}" style="border-radius:50%" alt="Image">
                                    <br>
                                    <br>
                                    <h2>{{$profile->name}}</h2>
                                    <ul class="nav">
                                        <li class="nav-item">
                                            <a class="nav-link" href="/like">
                                                <span class="fas fa-heart"> </span> Following ()
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="/dislike">
                                                <span class="fas fa-thumbs-down"> </span> Follower ()
                                            </a>
                                        </li>
                                    </ul>

                                </div>
                            @endif
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection




