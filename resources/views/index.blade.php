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
            <div class="col-md-6 p-0">

              {{-- tweet --}}
              <div class="d-flex border rounded bg-white mt-2 p-3 mb-5" style="min-height:6rem">
                <div class="col col-sm-auto p-0 m-0 pr-2 d-flex justify-content-center align-items-top">
                    <img src={{session('user')->image}} class="rounded-circle" style="max-width:3rem;min-width:3rem;max-height:3rem;min-height:3rem" alt="profile photo">
                </div>
                <div class="col">
                  <div class="row  w-100 border">
                    <textarea class="w-100" rows="5" id="post" style="white-space:pre-wrap;outline:none;border:none;resize:none" placeholder="Whats happening?"></textarea>
                  </div>
                  <div class="row d-flex mt-2 justify-content-end w-100">
  
                    <button class="btn btn-primary" onclick="createPost()">Tweet</button>
                  </div>
                </div>
              </div>

              {{-- posts --}}
              <div id="postContainer">
                  
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
<x-post/>
<x-comment/>
@push('scripts')
    <script>
      var currentUser = {!!session('user')!!};
      var posts = {!!$posts!!};
      var postsLiked = {!!$postsLiked!!}
      
      var currentPostId = '';
      var currentCommentId = '';
      var textarea = document.querySelector('textarea');

      textarea.addEventListener('keydown', autosize);
        
      posts.forEach((post)=>{
        renderPost(post);
      });

      function autosize(){
        var el = this;
        setTimeout(function(){
          el.style.cssText = 'height:auto;';
          el.style.cssText = 'height:' + el.scrollHeight + 'px;white-space:pre-wrap;outline:none;border:none;resize:none';
        },0);
      }

      async function createPost(id){
        let postText = document.getElementById("post").value;
        await axios.post(`http://twitter2x.test/posts`,{
          post:postText,
          user_id:currentUser.id,
          image_post:null,
        })
        .then((resp)=>{
          document.querySelector("textarea").value="";            
          });
        
      }
              
      async function edit(event){
        console.log();;
        let button = jQuery(event);
        let postText = $("#postText"+currentPostId);

        console.log(button.toggleClass('list-group-item-primary'));
        console.log(button.toggleClass('list-group-item-success'));

        if(button.hasClass('list-group-item-success')){
          postText.attr("contenteditable","true");
          postText.focus();
          button.contents("span").text("Salvar");
        }
        else if(button.hasClass('list-group-item-primary')){
          await axios.put(`http://twitter2x.test/posts/${currentPostId}/edit`,{
                post:postText.text(),
              }).then((resp)=>{
                button.contents("span").text("Editar");
                postText.attr("contenteditable","false");

              });

        }
        
        postText = document.getElementById("postText"+currentPostId);

        
      }

      async function deletePost(){
        await axios.delete(`http://twitter2x.test/posts/${currentPostId}/delete`).then((resp)=>{
        });
      }

      async function likeorDeslike(){
        $("#likeIcon"+currentPostId).toggleClass('text-primary');
        
        if($("#likeIcon"+currentPostId).hasClass('text-primary')){
          await axios.post(`http://twitter2x.test/likes`,{
                user_id:currentUser.id,
                post_id:currentPostId,
              }).then((resp)=>{
                console.log("deu like");
              });
              return true;
        }
        console.log(currentUser.id,currentPostId);
        await axios.delete(`http://twitter2x.test/likes/delete`,{
            params:{
                  user_id:currentUser.id,
                  post_id:currentPostId,
                } 
        }).then((resp)=>{
          console.log("retirou like");
        });
        return false;
      }

      async function createComments(){
        commentText=document.getElementById("commentText"+currentPostId).value;
        await axios.post(`http://twitter2x.test/comments`,{
          comment:commentText,
          user_id:currentUser.id,
          post_id:currentPostId,
        }).then((resp)=>{
          document.getElementById("commentText"+currentPostId).value="";
        });
      }

      async function loadComments(evt){
        await axios.get(`http://twitter2x.test/comments/${currentPostId}/all`).then((resp)=>{
          document.getElementById(`commentContainer${currentPostId}`).innerHTML="";
          resp.data.forEach((comment)=>{
            renderComment(comment);
          });
        });
      }

      async function deleteComment(){
        await axios.put(`http://twitter2x.test/comments/${currentCommentId}/edit`,{
          comment:'COMENTÁRIO INDISPONÍVEL',
        }).then((resp)=>{
        });
      }

      async function editComment(event){

        let button = jQuery(event);
        let commentText = $("#commentText"+currentCommentId);

        button.toggleClass('list-group-item-primary');
        button.toggleClass('list-group-item-success');

        if(button.hasClass('list-group-item-success')){
          commentText.attr("contenteditable","true");
          commentText.focus();
          button.contents("span").text("Salvar");
        }

        else if(button.hasClass('list-group-item-primary')){
          await axios.put(`http://twitter2x.test/comments/${currentCommentId}/edit`,{
                comment:commentText.text(),
              }).then((resp)=>{
                commentText.attr("contenteditable","false");
                button.contents("span").text("Editar");

              });
        }
      }
    </script>
@endpush

@push('styles')
<style>
  .fa-comment,.fa-thumbs-up{
    -webkit-text-stroke:1px black;
    color:white;
  }
  .fa{
    cursor:pointer;
  }
</style>
@endpush