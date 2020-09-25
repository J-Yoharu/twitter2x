<template> 
    <div>
        <MakePost :user="user"/>
        <!-- loader -->
        <div class="d-flex justify-content-center mt-4 w-100" id="loader"><div class="loader"></div></div>
        
        <div id="postsContent" class="d-none">
            <div class="text-center mt-5 bg-danger" v-if="posts.length == 0">Não tem post :(</div>

            <Post v-else v-for="(post,index) in posts" :key="index" :post="post"/>
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
            // currentUser = var vinda do appVue.blade.php
            user:currentUser,
        }
    },
    methods:{
        async getPosts(){
            let request = await axios("http://twitter2x.test/posts").then((resp)=>{
                $("#loader").remove()
                $("#postsContent").removeClass("d-none")
                return resp
            });
            this.posts = request.data;
        },
    },
    mounted(){
        this.getPosts();
    }
}
</script>

<style>

</style>