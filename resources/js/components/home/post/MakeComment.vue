<template>
<div class="d-flex border rounded bg-white p-3 mb-3 bg-danger" style="width:100%" >
    <div class="col col-sm-auto p-0 m-0 pr-2 d-flex justify-content-center align-items-top">
        <img :src="this.$currentUser.image" class="rounded-circle" style="max-width:3rem;min-width:3rem;max-height:3rem;min-height:3rem" alt="profile photo">
    </div>
    <div class="col">
        <div class="row  w-100 border">
        <textarea class="w-100" rows="3" id="post" style="white-space:pre-wrap;outline:none;border:none;resize:none" placeholder="Whats happening?"></textarea>
        </div>
        <div class="row d-flex mt-2 justify-content-end w-100">

        <button class="btn btn-primary" onclick="createPost()">Comentar</button>
        </div>
    </div>
</div>
</template>

<script>
export default {
}
</script>

<style>

</style>