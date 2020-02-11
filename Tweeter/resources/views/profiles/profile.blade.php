@extends ('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Profile</div>
                    <div class="card-body">
                        @include('flashMessage')
                        @if (count($profiles)>0)

                            @foreach ($profiles as $profile)

                                @if ($profile->user_id == Auth::user()->id)
                                        <div>
                                            <img class="profileImage" src="{{asset('/storage/'.$profile->profile_pic)}}" style="border-radius:50%" alt="Image">
                                            <br>
                                            <br>
                                            <h2>{{$profile->name}}</h2>
                                            {{$profile->gender}} <br>
                                            {{$profile->date_of_birth}}<br>
                                            {{$profile->quote}}<br>
                                            <p>Member since: {{$profile->created_at}}</p>
                                        </div>
                                        <div>
                                            <ul class="nav">
                                                <li class="nav-item">
                                                    <a class="nav-link" href="/following">
                                                        <span class="fas fa-heart"> </span> Following ()
                                                    </a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" href="/follower">
                                                        <span class="fas fa-thumbs-down"> </span> Follower ()
                                                    </a>
                                                </li>
                                            </ul>

                                        </div>
                                        <form action="/updateProfile/{id}" method="POST">
                                            @csrf
                                            <input type="submit" value="Edit Profile"class="btn btn-bg btn-primary">
                                            <input type="submit" value="Delete Profile"class="btn btn-bg btn-primary">

                                        </form>
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
                        @else
                        <p>Oops! Looks like your profile is not set up yet. Please fill out the details below</p>
                        <div>
                            <div class="card-body">
                                <form method="POST" action="/addProfile/{{Auth::user()->id}}" enctype="multipart/form-data">
                                    @csrf

                                    <div class="form-group row">
                                        <label for="date_of_birth" class="col-md-4 col-form-label text-md-right">{{ __('Date of Birth') }}</label>

                                        <div class="col-md-6">
                                            <input id="date_of_birth" type="text" class="form-control @error('date_of_birth') is-invalid @enderror" name="date_of_birth" value="{{ old('date_of_birth') }}" required autocomplete="date_of_birth" autofocus placeholder="YYYY-MM-DD">

                                            @error('date_of_birth')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="gender" class="col-md-4 col-form-label text-md-right">{{ __('Gender') }}</label>

                                        <div class="col-md-6">
                                            <input id="gender" type="gender" class="form-control @error('gender') is-invalid @enderror" name="gender" value="{{ old('gender') }}" required autocomplete="gender" placeholder="Male/Female/Other">

                                            @error('gender')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="quote" class="col-md-4 col-form-label text-md-right">{{ __('An Inspiring Quote') }}</label>

                                        <div class="col-md-6">
                                            <input id="quote" type="quote" class="form-control @error('quote') is-invalid @enderror" name="quote" required autocomplete="quote" placeholder="Do one thing every day that scares you.">

                                            @error('quote')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="form-group row">
                                        <label for="profile_pic" class="col-md-4 col-form-label text-md-right">{{ __('Profile Image') }}</label>

                                        <div class="col-md-6">
                                            <input id="profile_pic" type="file" class="form-control" name="profile_pic" required autocomplete="profile_pic">
                                        </div>
                                    </div>

                                    <div class="form-group row mb-0">
                                        <div class="col-md-6 offset-md-4">
                                            <button type="submit" class="btn btn-primary">
                                                {{ __('Create Profile') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        @endif


                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection




