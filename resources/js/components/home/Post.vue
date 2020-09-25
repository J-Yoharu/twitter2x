<template>
    <div>
        <div :id="`post${post.id}`" @mousedown="teste" class="d-flex border rounded p-2 mt-4  bg-white" style="min-height:5rem">
            <div class="col col-sm-auto p-0 m-0 pr-2 d-flex justify-content-center align-items-top"> 
                <img :src="this.$currentUser.image" class="rounded-circle" style="max-width:3rem;min-width:3rem;max-height:3rem;min-height:3rem"  alt="profile photo">
            </div>
            <div class="col">
                <div class="row">
                    <strong>{{post.user.name}}</strong>
                </div>
                <div class="row" style="max-width:28rem">
                    <p class="text-justify" id="postText" style="word-wrap: break-word;word-break: break-all;">
                        {{post.post}}
                    </p> 
                </div>
                <div class="row d-flex">
        
                    <div class="mr-5" @click="likeOrDeslike">
                        <i id="likeIcon" class="fa fa-2x fa-thumbs-up"> </i> 
                        <span id="likeCount"> {{post.likes.length}} </span>
                    </div>
        
                    <div class="react d-flex justify-content-center align-items-center rounded" @click="loadComments()" data-toggle="collapse" :data-target="`#collapseComment${post.id}`">
                        <i class="fa fa-2x fa-comment text-white mr-2"></i> 
                        <span id="commentCount"> {{ post.comments }} </span>
                    </div>
        
                </div>
                <div class="row collapse mt-4" :id="`collapseComment${post.id}`">
                    <MakeComment/>
                    <Comment/>
                </div>
            </div>
            
            <PostAdmin v-if="this.$currentUser.id == post.user.id" :post="post"/>
        </div>
    </div>
</template>

<script>
import PostAdmin from './post/PostAdmin'
import MakeComment from './post/MakeComment'
import Comment from './post/Comment'
export default {
    props:['post'],
    components:{
        PostAdmin,
        MakeComment,
        Comment,
    },
    methods:{
        likeOrDeslike(){
            console.log("likou ou n")
        },
        loadComments(){
            console.log("carregou os comentários")
        },
        teste(){
            console.log("teste")
        }
    },
}
</script>

<style>
  .fa-comment,.fa-thumbs-up{
    -webkit-text-stroke:1px black;
    color:white;
  }
  .fa{
    cursor:pointer;
  }
</style>