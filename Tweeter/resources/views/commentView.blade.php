@extends ('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        @include('layouts.leftbar')

        <div class="col-md-6">
            <div class="card">
                <div class="card-header"><strong>Edit Comment</strong></div>
                    <div class="card-body">
                        <div>
                            @if ($comments-> user_id !== Auth::user()->id)
                            <div class="row justify-content-center">
                                <p>You can only edit your own tweets</p>
                            </div>
                            @else
                            {{-- <p>{{$tweets-> content}}</p> --}}
                            <div class="form-group shadow-textarea">
                                <form action="/editComment/{{$comments->id}}" method="post">
                                    @csrf
                                    <input type="hidden" name="user_id" value= {{Auth::user()->id}}>
                                    <input type="hidden" name="id" value= {{$comments->id}}>
                                    <textarea class="form-control z-depth-1"  rows="4" cols="93" type="text" name="content">{{$comments-> content}}</textarea>
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
                            @include('navbarsCommentUser')
                            @endif


                        </div>

                    </div>
                </div>
            </div>
        @include('layouts.rightbar')

    </div>
</div>

@endsection
