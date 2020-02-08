@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <img class="profileImage" src="storage/profile_images/{{$user->profile_pic}}" alt="Image">
            @if(Session::has('success'))
                        <div class="alert alert-success">
                            {{Session::get('success')}}
                        </div>
                    @endif
            <br><br>
            <h2>{{$user->name}}</h2>
            <form enctype="multipart/form-data" action="/profile" method="POST">
                @csrf
                <label>Update Profile Image</label> <br>
                <input type="hidden" name="id" value="{{$user->id}}"><br><br>
                <input type="file" value="profile_pic"><br><br>
                <input type="submit" class="btn btn-bg btn-primary">
            </form>
        </div>
    </div>
</div>
@endsection
