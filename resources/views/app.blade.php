<!doctype html>
<html lang="en">
  <head>
    <title>Twitter</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    @stack('styles')
  </head>
  <body class="bg-light text-dark">
      @yield('content')
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.20.0/axios.min.js"></script>
    @stack('scripts')
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
  <script>
  
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher('1274225ed523873978b3', {
      cluster: 'mt1'
    });
    
// atualizando os posts
    var channelPost = pusher.subscribe('createPost');
    channelPost.bind('App\\Events\\Post\\UserCreatedPost', function(data) {
      renderPost(data.post); 
      posts.push(data.post); 
    });

    var channelDelete = pusher.subscribe('deletePost');
    channelDelete.bind('App\\Events\\Post\\UserDeletePost', function(data) {
      console.log(data)
        document.getElementById(data.post.id).remove();
    });

    var channelEdit = pusher.subscribe('editPost');
    channelEdit.bind('App\\Events\\Post\\UserEditPost', function(data) {
      console.log(data)
      $("#postText"+currentPostId).text(data.post.post);
    });

    
// atualizando os likes
    var channelLike = pusher.subscribe('like');
    channelLike.bind('App\\Events\\Like\\LikedPost', function(data) {
      let postId = data.like.post_id;
      let like = document.getElementById("likeCount"+postId);
      let likeIcon = document.getElementById("likeIcon"+postId);
      let qtdLike = parseInt(like.innerText);
      qtdLike+=1;
      like.innerText=qtdLike;
    });

    channelLike.bind('App\\Events\\Like\\DeslikePost', function(data) {
      let postId = data.like.post_id;
      let like = document.getElementById("likeCount"+postId);
      let likeIcon = document.getElementById("likeIcon"+postId);
      let qtdLike = parseInt(like.innerText);
      qtdLike-=1;
      like.innerText=qtdLike;
    });

    var channelPost = pusher.subscribe('comment');
    channelPost.bind('App\\Events\\Comment\\UserCommentPost', function(data) {
      let postId = data.comment.post_id;
      let comment = document.getElementById("commentCount"+postId);
      let qtdComment = parseInt(comment.innerText);
      qtdComment+=1;
      comment.innerText= qtdComment;

      qtdInContainer = document.getElementById("commentContainer"+postId).children.length;
      if(qtdInContainer>=0){
        renderComment(data.comment);
      }
    });

    var channelDelete = pusher.subscribe('deleteorEditComment');
    channelDelete.bind('App\\Events\\Comment\\UserDeleteorEditComment', function(data) {
      let adminTemplate = document.getElementById("adminComment"+data.comment.id);
      document.getElementById("commentText"+data.comment.id).innerHTML = data.comment.comment;
      data.comment.comment == "COMENTÁRIO INDISPONÍVEL" ? adminTemplate.remove():false
    });
  </script>

  </body>
</html>