@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row justify-content-center">
      @include('layouts.leftbar')

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <strong>Following and Followers Users</strong>
                </div>
                <div class="card-body">
                    @include('flashMessage')

                </div>

            </div>

        </div>



        @include('layouts.rightbar')
    </div>
</div>

@endsection






