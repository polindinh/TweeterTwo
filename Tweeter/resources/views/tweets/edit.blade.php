@extends ('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @include('layouts.leftbar')

        <div class="col-md-6 d-flex">
            <div class="card flex-fill">
                <div class="card-header"><strong>Edit Tweet</strong></div>
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
                            @if ($tweets-> user_id !== Auth::user()->id)
                            <div class="row justify-content-center">
                                <p>You can only edit your own tweets</p>
                            </div>
                            @else
                            {{-- <p>{{$tweets-> content}}</p> --}}
                            <div class="form-group shadow-textarea">
                                <form action="/editTweet/{{$tweets->id}}" method="post">
                                    @csrf
                                    <input type="hidden" name="user_id" value= {{Auth::user()->id}}>
                                    <textarea class="form-control z-depth-1 border border-primary"  rows="4" cols="93" type="text" name="content">{{$tweets-> content}}</textarea>
                                    <input class="btn btn-primary rounded-pill" type="submit" name="submit" value="Update" style="margin: 15px 0; float:right">
                                </form>
                            </div>
                            @if($errors->any())
                                <div>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li style="color:red">{{$error}}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            @php
                                $likeCount = count(\App\Tweet::find($tweets->id)->like);
                                $dislikeCount = count(\App\Tweet::find($tweets->id)->dislike);

                            @endphp
                            @include('navbarsUser')
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
                            @endif


                        </div>

                    </div>
                </div>
            </div>
        @include('layouts.rightbar')

    </div>
</div>

@endsection
