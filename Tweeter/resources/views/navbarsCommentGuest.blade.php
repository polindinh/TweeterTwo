<ul class="nav">

    <li class="nav-item">
        <a class="nav-link" href="/view/{{$comment->id}}">
            <span class="fa fa-eye"> </span> VIEW
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/comment/{{$comment->id}}">
            <span class="fas fa-comment"> </span> COMMENT
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/like/{{$comment->id}}">
            <span class="fas fa-heart"> </span> Like ({{$likeCount}})
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/dislike/{{$comment->id}}">
            <span class="fas fa-thumbs-down"> </span> Dislike ()
        </a>
    </li>

</ul>
