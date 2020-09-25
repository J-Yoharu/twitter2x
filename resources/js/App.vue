<template>
    <div class="row bg-light">
        <div class="col-md-3 d-flex justify-content-end p-0">
            <Navbar/>
        </div>
        <div class="col">
            <keep-alive>
                <router-view></router-view>
            </keep-alive>
        </div>
        <div class="col-4">
            <!-- What's Happening -->
            O que estas acontecendo? 
        </div>   
    </div>
</template>

<script>
import Vue from 'vue'
Vue.prototype.$currentUser = currentUser
import Navbar from './components/Navbar'
export default {
    components:{
        Navbar
    }
}
</script>

<style>

</style>