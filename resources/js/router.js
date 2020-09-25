import Vue from 'vue'
import Router from 'vue-router'
import home from './views/Home'
import message from './views/Chat'

Vue.use(Router)

const router = new Router({
    mode:'hash',
    routes: [{
        path:'/',
        redirect:'/home'
    },{
        path:'/home',
        component:home
    },{
        path:'/messages',
        component:message
    }]
})
router.beforeEach((to, from, next) => {
// console.log(this.$currentUser);
next()
})

export default router