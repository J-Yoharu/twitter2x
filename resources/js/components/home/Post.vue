<template>
    <div>
        <div :id="`post${post.id}`" class="d-flex border rounded p-2 mt-4  bg-white" style="min-height:5rem">
            <div class="col col-sm-auto p-0 m-0 pr-2 d-flex justify-content-center align-items-top"> 
                <img :src="post.user.image" class="rounded-circle" style="max-width:3rem;min-width:3rem;max-height:3rem;min-height:3rem"  alt="profile photo">
            </div>
            <div class="col">
                <div class="row">
                    <strong>{{post.user.name}}</strong>
                </div>
                <div class="row" style="max-width:28rem">
                    <p class="text-justify" style="word-wrap: break-word;word-break: break-all;">
                        {{post.post}}
                    </p> 
                </div>
                <div class="row d-flex">
        
                    <div class="mr-5" @click="likeOrDeslike">

                        <i class="fa fa-2x fa-thumbs-up" 
                            :class="postLiked != undefined ? 'text-primary':''"> 
                        </i> 
                        <span> {{post.likes.length}} </span>
                    </div>
        
                    <div class="react d-flex justify-content-center align-items-center rounded" @click="loadComments()" data-toggle="collapse" :data-target="`#collapseComment${post.id}`">
                        <i class="fa fa-2x fa-comment text-white mr-2"></i> 
                        <span> {{ post.comments }} </span>
                    </div>
        
                </div>
                <div class="row collapse mt-4" :id="`collapseComment${post.id}`">
                    <MakeComment :postId="post.id"/>

                    <Loader v-if="post.comments > 0" :text="'Carregando comentários'" :id="`loaderComment${post.id}`" :dismiss="comments"/>
                    <div class="text-center w-100 mt-2" v-if="post.comments == 0">Seja o primeiro a comentar neste post!</div>        
                    <Comment v-else v-for="(comment,index) in comments" :key="index" :comment="comment"/>
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
    props:['post','postLiked'],
    components:{
        PostAdmin,
        MakeComment,
        Comment,
    },
    data(){
        return{
            comments:[]
        }
    },
    methods:{
        likeOrDeslike($event){
            let like = $($event.target);
            like.toggleClass("text-primary")
            like.hasClass("text-primary") ? this.like():this.deslike()
        },
        
        async like(){
            await axios.post(`http://twitter2x.test/likes`,{
                user_id:this.$currentUser.id,
                post_id:this.post.id,
            }).then(resp =>{
                    console.log("deu like");
                    });
        },
        async deslike(){
            await axios.delete(`http://twitter2x.test/likes/delete`,{
                params:{
                    user_id:this.$currentUser.id,
                    post_id:this.post.id,
                } 
            }).then((resp)=>{
                console.log("retirou like");
                });
        },
        
        loadComments(){
            this.comments = []
            axios(`http://twitter2x.test/comments/${this.post.id}/all`)
                .then((resp)=>{
                    $(`#commentContent${this.post.id}`).removeClass("d-none")
                    this.comments = resp.data;
                })
        },
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