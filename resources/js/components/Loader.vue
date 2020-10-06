<template>
    <div class="mt-4 w-100 ml-0 mr-0 p-4">
        <div class="row p-0 m-0 d-flex justify-content-center">
            {{text}}
        </div>
        <div class="row p-0 m-0 d-flex justify-content-center">
            <div class="loader"></div>
        </div>
    </div>
</template>

<script>
export default {
    props:['text','dismiss'],
    watch:{
        dismiss(before,after){
            console.log(before.length)
            before.length > 0 ? this.$el.style="display:none":this.$el.style="display:block" 
        }
    }
}
</script>

<style>

</style>