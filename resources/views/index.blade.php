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
                    <button class="btn btn-primary" onclick="postStore({{session('user')->id}})">Tweet</button>
                  </div>
                </div>
              </div>

              {{-- posts --}}
              <div id="post-container">
                @foreach ($posts as $post)

                  @include('components.post',[
                    'image' => $post->user->image,
                    'user' => $post->user->name,
                    'userId' => $post->user->id,
                    'hour' => $post->created_at,
                    'text' => $post->post,
                    'likes' => $post->likes,
                    'comments' => $post->comments,
                    'id' => $post->id,
                    'postsLiked' => $postsLiked,
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
  .fa-comment,.fa-thumbs-up{
    -webkit-text-stroke:1px black;
  }
</style>
@endpush
@push('scripts')
    <script>
      responsePosts=[];
        var att = setInterval(()=>{
          checkPostUpdate();
        },4000);
        var user = {!!session('user')!!};
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
        async function checkPostUpdate(){
          await axios.get(`http://twitter2x.test/posts`).then((response)=>{
            
            if(posts.length!=response.data.length){
              console.log("tem atualizações, um post foi criado ou removido");
              qtdUpdate = response.data.length - posts.length;

              if(qtdUpdate<0){
                  let responseIds =[];
                  let postsId=[];

                  response.data.forEach((postsResponse)=> responseIds.push(postsResponse.id));
                  posts.forEach((post)=> postsId.push(post.id));
                  postsId.forEach(id=> {
                    if(!responseIds.includes(id)){
                      console.log("excluindo o post "+id);
                      posts = response.data;
                      document.getElementById('postContainer'+id).remove();
                    } 
                  });
                  
                }else{
                      console.log("criando um novo post!");
                     for (let index = posts.length; index < response.data.length; index++) {
                      createPost(response.data[index],'release');
                      }
                }
            }else{
              console.log(response.data);
              console.log("Não tem atualizações!");
              return false;
            }
          });
          
        }
        async function like(postId,userId){
            var icon = document.getElementById("likeIcon"+postId);
            var likesCurrent = document.getElementById("likesCount"+postId).innerText;

            console.log(userId)
            let request = await axios.get(`http://twitter2x.test/posts/${postId}`);
            console.log(request.data.likes)

            var validation = true;

            request.data.likes.forEach(like => {
              console.log(like.user_id)
                if(like.user_id == userId ){
                    validation=false;
                    return false;
                }
            });
            
            if(validation){
              let request = await axios.post(`http://twitter2x.test/likes`,{
                user_id:userId,
                post_id:postId,
              }).then((resp)=>{
                console.log(resp)
                icon.classList.remove("text-white");
                icon.classList.add("text-primary");
                likesCurrent++;
                document.getElementById("likesCount"+postId).innerText=likesCurrent;  
              });
            }else{

              let req = await axios.delete(`http://twitter2x.test/likes/delete`,{
                params:{
                  user_id:userId,
                  post_id:postId,
                }
              }).then(()=>{
                icon.classList.remove("text-primary");
                icon.classList.add("text-white");
                likesCurrent--;
                document.getElementById("likesCount"+postId).innerText=likesCurrent;
              })

            }
        }

        async function edit(obj,id){
            if(confirm(obj,id,"edit")){
                let request = await axios.put(`http://twitter2x.test/posts/${id}/edit`,{post:postText.innerText})
                    .then(()=>{
                        console.log("sucesso")
                });
            }
        }


        async function remove(obj,id){
            if(confirm(obj,id,"excluir")){

                let request = await axios.delete(`http://twitter2x.test/posts/${id}/delete`)
                    .then(()=>{
                        // document.getElementById('postContainer'+id).remove();
                })
            }
  

        }
        async function postStore(userId){
          let postText = $("textarea").val();
          let request = await axios.post(`http://twitter2x.test/posts`,{
            post:postText,
            user_id:userId,
            image_post:null,
          }).then((resp)=>{
            $("textarea").val('');
            createPost(resp.data,'create');
          });
        }
        function confirm(obj,id,type){
            postText = document.getElementById(`post${id}`);
            
            if(obj.prop==null){
              if(type=="edit"){
                postText.setAttribute("contentEditable","true");
                postText.focus();
              }
                obj.childNodes[2].innerHTML="Confirmar"
                obj.classList.add("bg-success")
                obj.prop=true
                return false
                console.log("focou")
            }
                postText.setAttribute("contentEditable","false");
                type=="edit" ? obj.childNodes[2].innerHTML="Editar":obj.childNodes[2].innerHTML="Excluir"
                obj.classList.remove("bg-success")
                obj.prop=null;
                $('#menuCollapse'+id).collapse('hide');
            return true
            }  
            function createPost(post,from){
              var html = `
                <div class="d-flex border p-2 mt-4" id="postContainer${post.id}" style="min-height:5rem">
                  <div class="col col-sm-auto p-0 m-0 pr-2 d-flex justify-content-center align-items-top" id="image${from != 'create' ? post.user.image:user.image}"> 
                      <img src="${from != 'create' ? post.user.image:user.image}" class="rounded-circle" style="max-width:4rem;min-width:4rem;max-height:4rem;min-height:4rem"  alt="profile photo">
                  </div>
                  
                  <div class="col">
                      <div class="row">
                          <strong id="userName${user.id}">${from != 'create' ? post.user.name:user.name}</strong>
                      </div>
                      <div class="row">
                          <p class="text-justify" id="post${post.id}"  style="width:90%">${post.post}</p> 
                      </div>
                      <div class="row d-flex">

                          <div class="mr-5" onclick="like(${post.id},${from != 'create' ? post.user.id:user.id})">
                              <i class="fa fa-2x fa-thumbs-up text-white" id="likeIcon${post.id}"> </i> <span id="likesCount${post.id}"> 0 </span>
                          </div>

                          <div class="react d-flex justify-content-center align-items-center rounded" data-toggle="collapse" data-target="#collapseComment${post.id}" onclick="comment(${post.id},${from != 'create' ? post.user.id:user.id})">
                              <i class="fa fa-2x fa-comment text-white mr-2"> </i> <span id="commentsCount${post.id}"> 0 </span>
                          </div>

                      </div>
                      <div class="row collapse mt-0" id="collapseComment${post.id}">
                          <div class="card card-body" id="comments${post.id}">
                              
                          </div>
                      </div>
                  </div>
                  `;
                  var fromId = from != 'create' ? post.user.id:user.id;
                  if(user.id == fromId){
                    html+= `<div class="col col-sm-auto">
                      <div class="row d-flex">
                          <ul class="list-group collapse position-absolute" style="right:2rem;top:0" id="menuCollapse${post.id}">
                              <button class="list-group-item list-group-item-action list-group-item-primary d-flex p-2 font-size" onclick="edit(this,${post.id})"><i class="fa fa-edit mr-2"></i> <span>Editar</span> </button>
                              <button class="list-group-item list-group-item-action list-group-item-danger d-flex p-2" onclick="remove(this,${post.id})"><i class="fa fa-trash mr-2"></i> <span>Excluir</span></button>
                          </ul>
                          <div>
                              <button class="btn btn-sm rounded-circle border"  data-toggle="collapse" data-target="#menuCollapse${post.id}"><i class="fa fa-ellipsis-h"></i></button>            
                          </div>
                      </div>
                  </div>
                  <div>
                  `;
                  }else{
                    html+=`</div>`;
                  }
                  
                var divRoot = document.createElement("div");
                divRoot.setAttribute("class","d-flex border p-2 mt-4");
                divRoot.setAttribute("id",`postContainer${post.id}`)
                divRoot.setAttribute("style","min-height:5rem");
                divRoot.innerHTML=html;

                $("#post-container").prepend(html);
                posts.push(post);
            }
        
    </script>
@endpush