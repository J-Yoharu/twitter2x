import Vue from 'vue'
import Router from 'vue-router'
import home from './views/Home'
import chat from './views/Chat'
import propaganda from './components/Propaganda'
import messages from './components/chat/Messages.vue'
Vue.use(Router)

const router = new Router({
    mode:'hash',
    routes: [{
        path:'/',
        redirect:'/home',
    },{
        path:'/home',
        components:{
            default:home,
            screen2:propaganda
        }
    },{
        path:'/messages',
        components:{
            default:chat,
            screen2:messages
        }
    }]
})
router.beforeEach((to, from, next) => {
// console.log(this.$currentUser);
next()
})

export default router