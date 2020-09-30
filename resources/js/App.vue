<template>
    <div class="row bg-light m-0">
        <div class="col-md-3 d-flex justify-content-end p-0">
            <Navbar/>
        </div>
        <div class="col m-0">
            <keep-alive>
                <router-view></router-view>
            </keep-alive>
        </div>
        <div class="col-5 m-0">
            <router-view name='screen2'></router-view>
        </div>   
    </div>
</template>

<script>
import Vue from 'vue'
// var currentUser from appVue.blade.php
Vue.prototype.$currentUser = currentUser;
import Navbar from './components/Navbar'
export default {
    components:{
        Navbar
    }
}
</script>

<style>

</style>