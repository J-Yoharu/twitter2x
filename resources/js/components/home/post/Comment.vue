<template>
    <div class="d-flex border rounded p-2 bg-white mt-2" style="width:100%">
        <div class="col col-sm-auto p-0 m-0 pr-2 d-flex justify-content-center align-items-top"> 
            <img :src="comment.user.image" class="rounded-circle" style="max-width:3rem;min-width:3rem;max-height:3rem;min-height:3rem"  alt="profile photo">
        </div>
        <div class="col">
            <div class="row">
                <strong>{{comment.user.name}}</strong>
            </div>
            <div class="row" style="max-width:28rem">
                <p class="text-justify" style="word-wrap: break-word;word-break: break-all;">
                    {{comment.comment}}
                </p> 
            </div>
        </div>
        <div v-if="this.comment.comment != 'COMENTÁRIO INDISPONÍVEL' ">
            <CommentAdmin v-if="this.$currentUser.id == comment.user.id" :comment="comment"/>
        </div>
    </div>
</template>

<script>
import CommentAdmin from './CommentAdmin'
export default {
    props:['post','comment'],
    components:{
        CommentAdmin
    }
}
</script>

<style>

</style>