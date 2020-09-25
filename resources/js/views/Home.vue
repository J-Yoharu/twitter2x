<template> 

    <div>

        <MakePost/>
        <!-- loader -->
        <Loader :text="'Carregando posts'" :dismiss="posts"/>
                
        <div id="postsContent" class="d-none bg-light">
            <div class="text-center mt-5 bg-danger" v-if="posts.length == 0">Não tem post :(</div>
            <Post v-else v-for="(post,index) in posts" :key="index" 
                :postLiked="postLiked(post.id)" :post="post"/>
        </div>

    </div>
</template>

<script>
import MakePost from '../components/home/MakePost'
import Post from '../components/home/Post'
export default {
    components:{
        MakePost,
        Post,
    },
    data(){
        return{
            posts:[],
            postsLiked:[],
        }
    },
    methods:{
        async getPosts(){
            await axios("http://twitter2x.test/posts").then((resp)=>{
                $("#postsContent").removeClass("d-none")
                this.posts = resp.data;
            });
        },
        async getLikes(){
            await axios(`http://twitter2x.test/likes/user/${this.$currentUser.id}`).then((resp)=>{
                this.postsLiked = resp.data;
            }); 
        },
        postLiked(postId){
            return this.postsLiked.find((like)=>{
                return like.post_id == postId
            })
        }
    },
    mounted(){
        this.getLikes();
        this.getPosts();
    }
}
</script>

<style>

</style>