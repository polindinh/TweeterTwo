@extends('layouts.app')

@php
    function checkFollowing($userToCheck, $follows) {
        foreach ($follows as $follow) {
            if($follow->followed == $userToCheck) {
                return true;
            }
        }
        return false;
    }
@endphp

@section('content')
    @foreach ($users as $user)
        <p>{{$user->name}}</p>
        @if (checkFollowing($user->name, $follows))
            <p>Already Following!</p>
        @else
            <form action="/Profiles" method="post">
                @csrf
                <input type="submit" value="Follow">
            </form>
        @endif
    @endforeach
@endsection
