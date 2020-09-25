<template>
  <div class="col col-sm-auto">
        <div class="row d-flex">
            <ul class="list-group collapse position-absolute" style="right:2rem;top:0" :id="`menuPost${post.id}`">

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
                <button class="btn btn-sm rounded-circle border"  data-toggle="collapse" :data-target="`#menuPost${post.id}`">
                    <i class="fa fa-caret-down"></i>
                </button>            
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props:['post'],
}
</script>

<style>

</style>