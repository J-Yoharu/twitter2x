<template>
  <div class="col col-sm-auto">
        <div class="row d-flex">
            <ul class="list-group collapse position-absolute" style="right:2rem;top:0" :id="`menuComment${comment.id}`">

                <button class="list-group-item list-group-item-action list-group-item-danger d-flex p-2" data-toggle="modal" 
                    :data-target="`#modalCommentDelete${comment.id}`">
                    <i class="fa fa-trash mr-2"></i> 
                    <span>Excluir</span>
                </button>

            </ul>
            <div>
                <button class="btn btn-sm rounded-circle border"  data-toggle="collapse" :data-target="`#menuComment${comment.id}`">
                    <i class="fa fa-caret-down"></i>
                </button>            
            </div>
        </div>
        <div class="modal fade" :id="`modalCommentDelete${comment.id}`"  role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-sm rounded" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-center">Aviso</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center pb-0">
                        <p>Você está prestes a excluir seu comentário,
                         se tiver certeza do que está fazendo, 
                         clique em confirmar, caso ao contrário, 
                         feche esse aviso</p>
                    </div>
                    <div class="modal-footer border-0 m-0 pt-0">
                        <button type="button" class="btn btn-danger" data-dismiss="modal" @click="deleteComment">Deletar o comentário</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Sair</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props:['comment'],
    methods:{
        async deleteComment(){
             await axios.put(`http://twitter2x.test/comments/${this.comment.id}/edit`,{
                comment:'COMENTÁRIO INDISPONÍVEL',
            }).then((resp)=>{
            });
        }
    }
}
</script>

<style>

</style>