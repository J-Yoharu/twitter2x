<script>
    function renderComment(comment){
        console.log(comment.user_id, currentUser.id);
        let adminComment=`
              <div class="col col-sm-auto" id="adminComment${comment.id}">
                      <div class="row d-flex">
                          <ul class="list-group collapse position-absolute" style="right:2rem;top:0" id="menuCollapseComment${comment.id}">
              
                              <button class="list-group-item list-group-item-action list-group-item-primary d-flex p-2 font-size" onclick="editComment(this)">
                                  <i class="fa fa-edit mr-2"></i> 
                                  <span>Editar</span> 
                              </button>
              
                              <button class="list-group-item list-group-item-action list-group-item-danger d-flex p-2" onclick="deleteComment()">
                                  <i class="fa fa-trash mr-2"></i> 
                                  <span>Excluir</span>
                              </button>
              
                          </ul>
                          <div>
                              <button class="btn btn-sm rounded-circle border"  data-toggle="collapse" data-target="#menuCollapseComment${comment.id}">
                                  <i class="fa fa-ellipsis-h"></i>
                              </button>            
                          </div>
                      </div>
                  </div>
                </div>
              `
        var commentTemplate = `
        <div class="d-flex border p-2 mt-4" style="min-height:5rem">
            <div class="col col-sm-auto p-0 m-0 pr-2 d-flex justify-content-center align-items-top"> 
                <img src="${comment.user.image}" class="rounded-circle" style="max-width:2rem;min-width:2rem;max-height:2rem;min-height:2rem"  alt="profile photo">
            </div>
            <div class="col">
                <div class="row">
                    <strong>${comment.user.name}</strong>
                </div>
                <div class="row">
                    <p class="text-justify" id="commentText${comment.id}" style="width:90%">${comment.comment}</p> 
                </div>
            </div>
        ${comment.comment == "COMENTÁRIO INDISPONÍVEL" && comment.user_id == currentUser.id ? "</div>":adminComment}
        `

        var div = document.createElement("div");
        div.id=comment.id
        div.addEventListener("mousedown",function(){
            currentCommentId=this.id.replace("comment","");
        });

        div.innerHTML=commentTemplate;
        document.getElementById(`commentContainer${comment.post_id}`).prepend(div);
    }
</script>