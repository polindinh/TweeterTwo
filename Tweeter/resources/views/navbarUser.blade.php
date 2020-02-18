@php
$commentCount = count(\App\Tweet::find($tweet->id)->comment);

// $dislikeCount = count(\App\Tweet::find($tweet->id)->dislike);


@endphp

<ul class="nav">

    <li class="nav-item">
        <a class="nav-link" href="/view/{{$tweet->id}}">
            <span class="fa fa-eye"> </span> VIEW
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/comment/{{$tweet->id}}">
            <span class="fas fa-comment"> </span> COMMENT ({{$commentCount}})
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">
            <span class="fas fa-heart"> </span> Like ({{$likeCount}})
        </a>
    </li>
    {{-- <li class="nav-item">
        <a class="nav-link" href="/dislike/{{$tweet->id}}">
            <span class="fas fa-thumbs-down"> </span> Dislike ({{$dislikeCount}})
        </a>
    </li> --}}
    <li class="nav-item">
        <a class="nav-link" href="/edit/{{$tweet->id}}">
            <span class="fas fa-edit"> </span> EDIT
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/delete/{{$tweet->id}}">
            <span class="fas fa-trash-alt"> </span> DELETE
        </a>
    </li>

</ul>

