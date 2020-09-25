<template>
    <div class="d-flex border rounded p-2 bg-white" style="width:100%">
        <div class="col col-sm-auto p-0 m-0 pr-2 d-flex justify-content-center align-items-top"> 
            <img :src="this.$currentUser.image" class="rounded-circle" style="max-width:3rem;min-width:3rem;max-height:3rem;min-height:3rem"  alt="profile photo">
        </div>
        <div class="col">
            <div class="row">
                <strong>jonathas ae</strong>
            </div>
            <div class="row" style="max-width:28rem">
                <p class="text-justify" id="postText" style="word-wrap: break-word;word-break: break-all;">Um novo post uma história </p> 
            </div>
        </div>
            <!-- <PostAdmin/> -->
    </div>
</template>

<script>
// import PostAdmin from './PostAdmin'
export default {
    props:['post'],
    components:{
        // PostAdmin
    }
}
</script>

<style>

</style>