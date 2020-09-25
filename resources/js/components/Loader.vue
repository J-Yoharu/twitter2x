<template>
    <div class="mt-4 w-100">
        <div class="row d-flex justify-content-center">
            {{text}}
        </div>
        <div class="row d-flex justify-content-center">
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