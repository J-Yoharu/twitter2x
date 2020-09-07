    <script>
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
                
                            <div class="mr-5" id="like${post.id}">
                                <i class="fa fa-2x fa-thumbs-up text-white"> </i> 
                                <span id="likeCount${post.id}">${post.likes=="" ? "0":post.likes}</span>
                            </div>
                
                            <div class="react d-flex justify-content-center align-items-center rounded" data-toggle="collapse" data-target="#collapseComment${post.id}">
                                <i class="fa fa-2x fa-comment text-white mr-2"></i> 
                                <span> ${post.comments==null ? "0":post.comments} </span>
                            </div>
                
                        </div>
                        <div class="row collapse mt-0" id="collapseComment${post.id}">
                            <div class="card card-body">    
                              <div class="d-flex text-white border p-2 mb-5 bg-primary" style="min-height:4rem">
                                <div class="col col-sm-auto p-0 m-0 pr-2 d-flex justify-content-center align-items-top">
                                    <img src=${currentUser.image} class="rounded-circle" style="max-width:2rem;min-width:2rem;max-height:2rem;min-height:2rem" alt="profile photo">
                                </div>
                                <div class="col d-flex justify-content-start align-items-end">
                                    <textarea class="w-100" style="white-space:pre-wrap;outline:none;border:none;resize:none" id="text${post.id}" placeholder="Whats happening?"></textarea>
                                    <button class="btn btn-primary" onclick="createPost()">Comentar</button>     
                                </div>
                                </div>
                                <div class="col" id="commentContainer">
                                  <p>AQUI TEM OS COMMENTS</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    ${currentUser.id == post.user.id? adminTemplate:"</div>"}
                `;

          
              var div = document.createElement("div");
              div.innerHTML=postTemplate;
              document.getElementById("postContainer").prepend(div);

              // Adicionando os listeners;
              likeButton = document.getElementById("like"+post.id);
              likeButton.id = post.id;
              likeButton.addEventListener("click",like);
              // --------------------------------------------------
              document.getElementById("text"+post.id).addEventListener('keydown', autosize);

      }
    </script>
