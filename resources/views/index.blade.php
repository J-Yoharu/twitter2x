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
              <div class="d-flex text-white border p-2 mb-5" style="min-height:6rem">
                <div class="col col-sm-auto p-0 m-0 pr-2 d-flex justify-content-center align-items-top">
                    <img src={{session('user')->image}} class="rounded-circle" style="max-width:4rem;min-width:4rem;max-height:4rem;min-height:4rem" alt="profile photo">
                </div>
                <div class="col">
                  <div class="row  w-75">
                    <textarea class="w-100" id="post" style="white-space:pre-wrap;outline:none;border:none;resize:none" placeholder="Whats happening?"></textarea>
                  </div>
                  <div class="row d-flex justify-content-end w-75">
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

@push('scripts')
    <script>
        var currentUser = {!!session('user')!!};
        var posts = {!!$posts!!};

        var textarea = document.querySelector('textarea');
        textarea.addEventListener('keydown', autosize);

        function autosize(){
          var el = this;
          setTimeout(function(){
            el.style.cssText = 'height:auto;';
            el.style.cssText = 'height:' + el.scrollHeight + 'px;white-space:pre-wrap;outline:none;border:none;resize:none';
          },0);
        }
        posts.forEach((post)=>{
          renderPost(post);
        });

        async function createPost(){
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
      async function like(evt){
        postId = evt.currentTarget.id;
          await axios.post(`http://twitter2x.test/likes`,{
                user_id:currentUser.id,
                post_id:postId,
              }).then((resp)=>{
                console.log("deu like");
              });
      }


    </script>
@endpush

@push('styles')
<style>
  .fa-comment,.fa-thumbs-up{
    -webkit-text-stroke:1px black;
    color:white;
  }
</style>
@endpush