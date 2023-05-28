<!doctype html>
<html>
<head>
    <title>Fast News</title>
<link rel="stylesheet" href="/app.css">
</head>
<body>

@foreach($posts as $post)
    <article
    @if($loop->odd)
        style="background-color: #9ca3af"
    @endif
    >      <a href="$post"> {!!$post->title!!} </a>
       <p> {!!$post->body!!}</p>
    </article>
@endforeach

</body>
</html>
