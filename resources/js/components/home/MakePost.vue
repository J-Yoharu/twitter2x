<template>
    <div class="d-flex border rounded bg-white mt-2 p-3 " style="min-height:6rem">
        <div class="col col-sm-auto p-0 m-0 pr-2 d-flex justify-content-center align-items-top">
            <img :src="this.$currentUser.image" class="rounded-circle" style="max-width:3rem;min-width:3rem;max-height:3rem;min-height:3rem" alt="profile photo">
        </div>
        <div class="col">
            <div class="row  w-100 border">
            <textarea class="w-100 textarea" v-model="postText" rows="5" style="white-space:pre-wrap;outline:none;border:none;resize:none" placeholder="Whats happening?"></textarea>
            </div>
            <div class="row d-flex mt-2 justify-content-end w-100">

            <button class="btn btn-primary" @click="createPost">Tweet</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data(){
        return{
            postText: '',
        }
    },
    methods:{
        async createPost(){
            await axios.post(`http://twitter2x.test/posts`,{
                post:this.postText,
                user_id:this.$currentUser.id,
                image_post:null,
            }).then((resp)=>{
                this.postText=''
            })
        },
    },
    created(){

    }
}
</script>

<style>

</style>