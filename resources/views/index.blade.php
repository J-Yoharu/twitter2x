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
                    <textarea class="w-100" style="white-space:pre-wrap;outline:none;border:none;resize:none" placeholder="Whats happening?"></textarea>
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
          let postText = document.querySelector("textarea").value;
          console.log(postText);
          let request = await axios.post(`http://twitter2x.test/posts`,{
            post:postText,
            user_id:currentUser.id,
            image_post:null,
          })
          .then((resp)=>{
            document.querySelector("textarea").value="";            
            });
          
        }
      function like(){
        console.log("teste");
      }

      function renderPost(post){
        var adminTemplate=`
              <div class="col col-sm-auto">
                      <div class="row d-flex">
                          <ul class="list-group collapse position-absolute" style="right:2rem;top:0" id="menuCollapse${post.id}">
              
                              <button class="list-group-item list-group-item-action list-group-item-primary d-flex p-2 font-size">
                                  <i class="fa fa-edit mr-2"></i> 
                                  <span>Editar</span> 
                              </button>
              
                              <button class="list-group-item list-group-item-action list-group-item-danger d-flex p-2">
                                  <i class="fa fa-trash mr-2"></i> 
                                  <span>Excluir</span>
                              </button>
              
                          </ul>
                          <div>
                              <button class="btn btn-sm rounded-circle border"  data-toggle="collapse" data-target="#menuCollapse${post.id}">
                                  <i class="fa fa-ellipsis-h"></i>
                              </button>            
                          </div>
                      </div>
                  </div>
                </div>
              `
              var postTemplate= `
                <div class="d-flex border p-2 mt-4" style="min-height:5rem">
                    <div class="col col-sm-auto p-0 m-0 pr-2 d-flex justify-content-center align-items-top"> 
                        <img src="${post.user.image}" class="rounded-circle" style="max-width:4rem;min-width:4rem;max-height:4rem;min-height:4rem"  alt="profile photo">
                    </div>
                    <div class="col">
                        <div class="row">
                            <strong>${post.user.name}</strong>
                        </div>
                        <div class="row">
                            <p class="text-justify" style="width:90%">${post.post}</p> 
                        </div>
                        <div class="row d-flex">
                
                            <div class="mr-5">
                                <i class="fa fa-2x fa-thumbs-up text-white" id="like${post.id}"> </i> 
                                <span id="likeCount${post.id}">${post.likes}</span>
                            </div>
                
                            <div class="react d-flex justify-content-center align-items-center rounded" data-toggle="collapse" data-target="#collapseComment${post.id}">
                                <i class="fa fa-2x fa-comment text-white mr-2"></i> 
                                <span> ${post.comments} </span>
                            </div>
                
                        </div>
                        <div class="row collapse mt-0" id="collapseComment${post.id}">
                            <div class="card card-body">
                                {{-- Aqui vai os comentários --}}
                            </div>
                        </div>
                    </div>
                    ${currentUser.id == post.user.id? adminTemplate:"</div>"}
                `;

          
              var div = document.createElement("div");
              div.innerHTML=postTemplate;
              document.getElementById("postContainer").prepend(div);
              // Adicionando os listeners;
              document.getElementById("like"+post.id).addEventListener("click",like);
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