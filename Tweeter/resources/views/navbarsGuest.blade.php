<ul class="nav">

    <li class="nav-item">
        <a class="nav-link" href="/view/{{$tweets->id}}">
            <span class="fa fa-eye"> </span> VIEW
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="/comment/{{$tweets->id}}">
            <span class="fas fa-comment"> </span> COMMENT
        </a>
    </li>
    <li class="nav-item">
        <a class="nav-link" href="#">
            <span class="fas fa-heart"> </span> Like ({{$likeCount}})
        </a>
    </li>
    {{-- <li class="nav-item">
        <a class="nav-link" href="/dislike/{{$tweets->id}}">
            <span class="fas fa-thumbs-down"> </span> Dislike ({{$dislikeCount}})
        </a>
    </li> --}}

</ul>
