<template> 

    <div>

        <MakePost/>
        <!-- loader -->
        <Loader :text="'Carregando posts'" :dismiss="posts"/>
                
        <div id="postsContent" class="d-none bg-light">
            <div class="text-center mt-5 bg-danger" v-if="posts.length == 0">Não tem post :(</div>
            <Post v-else v-for="(post,index) in posts" :key="index" 
                :postLiked="postLiked(post)" :post="post"/>
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
            console.log(this.posts)
        },
        async getLikes(){
            await axios(`http://twitter2x.test/likes/user/${this.$currentUser.id}`).then((resp)=>{
                this.postsLiked = resp.data;
            }); 
        },
        postLiked(post){
            let like = this.postsLiked.some((like)=>{
                return like.post_id == post.id && like.user_id == this.$currentUser.id
            })
            return like
        }
    },
    mounted(){
        this.getLikes();
        this.getPosts();
        
    
// atualizando os posts
    let channelHome = pusher.subscribe('Home');
    channelHome.bind('createPost',(data)=>{
        this.posts.unshift(data.post);
    });

    channelHome.bind('deletePost',(data)=>{
        this.posts = this.posts.filter(post =>{
            return post.id != data.post.id
        })
    });
    channelHome.bind('editPost',(data)=>{
        this.posts.map(post =>{
            post.id == data.post.id ? post.post = data.post.post:false
        })
    });
    channelHome.bind('like',(data)=>{
        // console.log(data);
        // this.postsLiked.unshift(data.like) //adicionar o azulzinho
        // let post = this.posts.filter((post)=>{
        //     return post.id == data.post_id;
        // })
        // this.posts.likes.unshift(data.like)
        // console.log(post)
    });

    }
}
</script>

<style>

</style>