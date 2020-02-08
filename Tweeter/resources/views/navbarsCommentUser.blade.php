<ul class="nav">

    {{-- <li class="nav-item">
        <a class="nav-link" href="/view/{{$comment->id}}">
            <span class="fa fa-eye"> VIEW</span>
        </a>
    </li> --}}
    {{-- <li class="nav-item">
        <a class="nav-link" href="/comment/{{$comment->id}}">
            <span class="fas fa-comment"> COMMENT</span>
        </a>
    </li> --}}
    <li class="nav-item">
        <a class="nav-link" href="/like/{{$comments->id}}">
            <span class="fas fa-heart"> Like ()</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/dislike/{{$comments->id}}">
            <span class="fas fa-thumbs-down"> Dislike ()</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/viewComment/{{$comments->id}}">
            <span class="fas fa-edit"> UPDATE</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/deleteComment/{{$comments->id}}">
            <span class="fas fa-trash-alt"> DELETE</span>
        </a>
    </li>

</ul>
