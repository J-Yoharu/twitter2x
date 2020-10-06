<template>
<div class="container p-0">
 <div class="row bg-light m-0">
        <div class="col-md-2 d-flex justify-content-end p-0">
            <Navbar/>
        </div>
        <div class="col  m-0">
            <keep-alive>
                <router-view @chatId="chatId=$event"></router-view>
            </keep-alive>
        </div>
        <div class="col-md-5 m-0">
            <keep-alive>
                <router-view :chatId="chatId" name='screen2'></router-view>
            </keep-alive>
        </div>   
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
    },
    data(){
        return {
            chatId:''
        }
    }
}
</script>

<style>

</style>