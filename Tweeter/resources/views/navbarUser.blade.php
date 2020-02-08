<ul class="nav">

    <li class="nav-item">
        <a class="nav-link" href="/view/{{$tweet->id}}">
            <span class="fa fa-eye"> VIEW</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/comment/{{$tweet->id}}">
            <span class="fas fa-comment"> COMMENT</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/like/{{$tweet->id}}">
            <span class="fas fa-heart"> Like ({{$likeCount}})</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/dislike/{{$tweet->id}}">
            <span class="fas fa-thumbs-down"> Dislike ()</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/edit/{{$tweet->id}}">
            <span class="fas fa-edit"> EDIT</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/delete/{{$tweet->id}}">
            <span class="fas fa-trash-alt"> DELETE</span>
        </a>
    </li>

</ul>

