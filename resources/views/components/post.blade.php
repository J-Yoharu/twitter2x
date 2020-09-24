    <script>
        function renderPost(post){
            console.log(post.user_id)
            let checkLike=false;

            postsLiked.forEach(element => {
                if(element.post_id == post.id){
                    checkLike=true;
                    return true;
                }
            });

        var adminTemplate=`
              <div class="col col-sm-auto">
                      <div class="row d-flex">
                          <ul class="list-group collapse position-absolute" style="right:2rem;top:0" id="menuCollapse${post.id}">
              
                              <button class="list-group-item list-group-item-action list-group-item-primary d-flex p-2 font-size" onclick="edit(this)">
                                  <i class="fa fa-edit mr-2"></i> 
                                  <span>Editar</span> 
                              </button>
              
                              <button class="list-group-item list-group-item-action list-group-item-danger d-flex p-2" onclick="deletePost()">
                                  <i class="fa fa-trash mr-2"></i> 
                                  <span>Excluir</span>
                              </button>
              
                          </ul>
                          <div>
                              <button class="btn btn-sm rounded-circle border"  data-toggle="collapse" data-target="#menuCollapse${post.id}">
                                  <i class="fa fa-caret-down"></i>
                              </button>            
                          </div>
                      </div>
                  </div>
                </div>
              `
              var postTemplate= `
                <div class="d-flex border rounded p-2 mt-4  bg-white" style="min-height:5rem">
                    <div class="col col-sm-auto p-0 m-0 pr-2 d-flex justify-content-center align-items-top"> 
                        <img src="${post.user.image}" class="rounded-circle" style="max-width:3rem;min-width:3rem;max-height:3rem;min-height:3rem"  alt="profile photo">
                    </div>
                    <div class="col">
                        <div class="row">
                            <strong>${post.user.name}</strong>
                        </div>
                        <div class="row">
                            <p class="text-justify" id="postText${post.id}" style="width:90%">${post.post}</p> 
                        </div>
                        <div class="row d-flex">
                
                            <div class="mr-5" onclick="likeorDeslike()">
                                <i id="likeIcon${post.id}" class="fa fa-2x fa-thumbs-up ${checkLike ? "text-primary":"text-white"}"> </i> 
                                <span id="likeCount${post.id}">${post.likes=="" ? "0":post.likes}</span>
                            </div>
                
                            <div class="react d-flex justify-content-center align-items-center rounded" onclick="loadComments()" data-toggle="collapse" data-target="#collapseComment${post.id}">
                                <i class="fa fa-2x fa-comment text-white mr-2"></i> 
                                <span id="commentCount${post.id}"> ${post.comments==null ? "0":post.comments} </span>
                            </div>
                
                        </div>
                        <div class="row collapse mt-4" id="collapseComment${post.id}">
                            <div class="card card-body p-1">    
                              <div class="d-flex border m-0 p-2 mb-1 bg-light" style="min-height:4rem">
                                <div class="col col-sm-auto p-0 m-0 pr-2 d-flex justify-content-center align-items-top">
                                    <img src=${currentUser.image} class="rounded-circle" style="max-width:2rem;min-width:2rem;max-height:2rem;min-height:2rem" alt="profile photo">
                                </div>
                                <div class="col d-flex justify-content-start align-items-end">
                                    <textarea class="w-100" style="white-space:pre-wrap;outline:none;border:none;resize:none" id="commentText${post.id}" placeholder="Olá?"></textarea>
                                    <button onclick="createComments()" class="btn btn-primary ml-2">Comentar</button>     
                                </div>
                                </div>
                                <div class="col bg-light" id="commentContainer${post.id}">

                                </div>
                            </div>
                        </div>
                    </div>
                    ${currentUser.id == post.user_id? adminTemplate:"</div>"}
                `;
                
              let div = document.createElement("div");
              div.id=post.id;

              div.addEventListener("mousedown",function(){currentPostId=this.id});
              div.innerHTML=postTemplate;
              document.getElementById("postContainer").prepend(div);

              // Adicionando os listeners;
              // --------------------------------------------------
              document.getElementById("commentText"+post.id).addEventListener('keydown', autosize);

      }
    </script>
