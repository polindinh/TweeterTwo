<ul class="nav">

    <li class="nav-item">
        <a class="nav-link" href="/view/{{$tweets->id}}">
            <span class="fa fa-eye"> VIEW</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/comment/{{$tweets->id}}">
            <span class="fas fa-comment"> COMMENT</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/like/{{$tweets->id}}">
            <span class="fas fa-heart"> Like ({{$likeCount}})</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/dislike/{{$tweets->id}}">
            <span class="fas fa-thumbs-down"> Dislike ()</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/edit/{{$tweets->id}}">
            <span class="fas fa-edit"> EDIT</span>
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/delete/{{$tweets->id}}">
            <span class="fas fa-trash-alt"> DELETE</span>
        </a>
    </li>

</ul>
