<template>
  <div class="col col-sm-auto">
        <div class="row d-flex">
            <ul class="list-group collapse position-absolute" style="right:2rem;top:0" :id="`menuPost${post.id}`">

                <button class="list-group-item list-group-item-action list-group-item-primary d-flex p-2 font-size" 
                    type="button" data-toggle="modal" :data-target="`#modalEdit${post.id}`">
                    <i class="fa fa-edit mr-2"></i> 
                    <span>Editar</span> 
                </button>

                <button class="list-group-item list-group-item-action list-group-item-danger d-flex p-2" 
                    type="button" data-toggle="modal" :data-target="`#modalDelete${post.id}`">
                    <i class="fa fa-trash mr-2"></i> 
                    <span>Excluir</span>
                </button>

            </ul>
            <div>
                <button class="btn btn-sm rounded-circle border"  data-toggle="collapse" :data-target="`#menuPost${post.id}`">
                    <i class="fa fa-caret-down"></i>
                </button>            
            </div>
        </div>
        <div class="modal fade" :id="`modalDelete${post.id}`"  role="dialog">
            <div class="modal-dialog modal-dialog-centered modal-sm rounded" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-center">Aviso</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center pb-0">
                        <p>Você está prestes a excluir seu post, se tiver certeza do que está fazendo, clique em confirmar, caso ao contrário, feche esse aviso</p>
                    </div>
                    <div class="modal-footer border-0 m-0 pt-0">
                        <button type="button" class="btn btn-danger" data-dismiss="modal" @click="deletePost">Deletar o post</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Sair</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" :id="`modalEdit${post.id}`"  role="dialog">
            <div class="modal-dialog modal-dialog-centered rounded" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title m-0 p-0">Editar o twitte</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body text-center">
                        <div class="d-flex bg-white" style="min-height:6rem">
                            <div class="col col-sm-auto p-0 m-0 pr-2 d-flex justify-content-center align-items-top">
                                <img :src="this.$currentUser.image" class="rounded-circle" style="max-width:3rem;min-width:3rem;max-height:3rem;min-height:3rem" alt="profile photo">
                            </div>
                            <div class="col">
                                <div class="row">
                                    <textarea class="w-100 border" 
                                        :value="post.post"
                                        :id="`textEdit${post.id}`"
                                        rows="5" style="white-space:pre-wrap;outline:none;border:none;resize:none">
                                    </textarea>
                                </div>
                                <div class="row d-flex mt-2 justify-content-end">
                                    <button type="button" class="btn btn-primary" data-dismiss="modal" @click="edit">Editar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props:['post'],
    data(){
        return{
            
        }
    },
    methods:{
        async deletePost(){
            await axios.delete(`http://twitter2x.test/posts/${this.post.id}/delete`).then(()=>{
                console.log("deletado com sucesso")
            })

        },
        async edit(){
            let postEdit = $(`#textEdit${this.post.id}`).val()
            await axios.put(`http://twitter2x.test/posts/${this.post.id}/edit`,{
                post:postEdit,
            }).then(()=>{
                console.log("editado com sucesso")
            })
        }
    }
}
</script>

<style>

</style>