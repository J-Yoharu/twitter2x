@extends('app')

@section('content')
<div class="container-fluid" style="font-size:15px">
    <div class="row">
        {{-- menu --}}
        @include('components.menu')

        {{-- conteudo / propaganda--}}
        <div class="col" style="overflow-y:scroll">
         
          {{-- conteudo --}}
          <div class="row" style="min-height:100vh">
            
            {{--twitte / posts --}}
            <div class="col-md-8 p-0 border-left border-right">

              {{-- tweet --}}
              <div style="width:100%" class="content-post">
                <div class="post-img">
                  <img src={{session('user')->image}} alt="profile photo">
                </div>
                <div class="tweet-body">
                  {{-- <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data"> --}}
                      @csrf
                      <input type="hidden" name="user_id" value={{session('user')->id}}>

                      <textarea style="white-space: pre-wrap;" rows="2" id="tweetText" placeholder="Whats happening?" name="post"></textarea> 
                      <hr>
                      <div class="tweet-button">
                        <button class="btn btn-primary" onclick="postStore({{session('user')->id}})">Tweet</button>
                      </div>
                  {{-- </form> --}}
                </div>
              </div>

              {{-- posts --}}
              <div id="post-container">
                @foreach ($posts as $post)
  
                  @include('components.post',[
                    'image' => $post->user->image,
                    'user' => $post->user->name,
                    'hour' => $post->created_at,
                    'text' => $post->post,
                    'likes' => $post->likes,
                    'comments' => $post->comments,
                    'id' => $post->id,
                    'userId' => $post->user->id,
                  ])
                  
                @endforeach
              </div>
              
            </div>

            {{-- propaganda --}}
            <div class="col">
              propaganda
            </div>
          </div>
        </div>
    </div>
</div> 
  @push('styles')
  <style>
    hr{
      /* background-color:white; */
    }
    .content-post{
      display:inline-flex;
      width:100%;
      padding:1rem;
    }
    .tweet-body{
      width:100%;
    }
    .tweet-body textarea{
      width:100%;
      background-color:transparent;
      border:none;
      font-size:20px;
      outline: none;
      overflow-y:hidden;
      resize:none;
    }
    .tweet-button{
      width:100%;
      display:flex;
      justify-content: flex-end;    
    }

  </style>
  @endpush
 
  @push('scripts')
      <script>
        
        var post = {!!$posts!!};
        var user = {!!session('user')!!}
        // textarea listener function
        $("#tweetText").on('keypress',function(e) {
          if(e.which == 13) {
              let currentRow = parseInt(this.getAttribute("rows"));
              this.setAttribute("rows",currentRow+1);
          }
        });

        async function postStore(currentUser){
          let postText = $("#tweetText");

          let postRequest = await axios.post('http://twitter2x.test/posts', {
            post:postText.val(), 
            user_id: currentUser,
            image_post:null
          });
          // Object.defineProperty(post, "push", {
          //   get : function () {console.log("ADICIONOU!!!");}
          // });
          post.push(postRequest.data);
            renderizaPost(postRequest.data);

          // limpando
          postText.val("");
          postText.attr("rows","2");
        }
        
        function renderizaPost(post){
          console.log(post)
          let divRoot = document.createElement("div");
          divRoot.setAttribute("class","post content-post");
          divRoot.setAttribute("id",post.id);
          console.log(post.created_at);
         var postHTML = `
    <div class='post-img'>
        <img src='${user.image}' alt='profile photo'>
    </div>
    <div class='post-body'>
        <div class='d-flex'>
            <span> <strong>${user.name}</strong></span>
                    
            <div class='ml-auto'>
              <button class="btn btn-sm btn-primary" value=false onclick="confirmEdit(this,${post.id})" style="width:30px"><i class="fa fa-edit mr-2"></i></button>
              <button class="btn btn-sm p-1 btn-danger" value=false onclick="confirmRemove(this,${post.id})" style="width:30px"><i class="fa fa-trash"></i></button>
            </div>
        </div>

        <div class='post-content'>
            <p class="outline:none" id="postText${post.id}" contentEditable="false">
                ${post.post}
            </p>
        </div>
        
        <div class='post-react'>
        
            <div class='react mr-5 d-flex justify-content-center align-items-center rounded' onclick='like(${post.id},${user.id})'>
                <i class='fa fa-2x fa-thumbs-up mr-2'> </i> 
                <span> 0 </span>
            </div>

            <div class='react mr-5 d-flex justify-content-center align-items-center rounded' onclick='comment(${post.id},${user.id})'>
                <i class='fa fa-2x fa-comment mr-2'> </i> 
                <span> 0 </span>
            </div>

        </div>
    </div>`
      divRoot.innerHTML=postHTML;
      console.log(divRoot)
      $("#post-container").prepend(divRoot);
        }
      </script>
  @endpush
@endsection

