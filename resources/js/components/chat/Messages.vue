<template>
  <div class="bg-danger d-flex align-items-end flex-column" style="height:100vh">
    <div class="w-100" style="overflow-y:scroll">

      <Message v-for="(message,index) in messages" :key="index" :message="message"/>

    </div>

    <div class="bg-primary w-100 d-flex align-items-center p-3 mt-auto" style="min-height:3rem"> 
        <div class="rounded-lg w-100 bg-light p-2 mr-2" style="outline:none;max-height:7rem;overflow-y:scroll" v-bind="message" contenteditable="true"> hegehe</div>
      <i class="fa fa-2x fa-paper-plane" @click="sendMessage"></i>
    </div>

  </div>
</template>

<script>
import Message from './Message'
export default {
  data(){
    return{
      messages:[],
      message:''
    }
  },
  methods:{
    async sendMessage(){
      console.log("enviou hehe");
      console.log(this.message)
      // await axios.post(`http://twitter2x.test/chats`,{
      //     post:this.postText,
      //     user_id:this.$currentUser.id,
      //     image_post:null,
      // }).then((resp)=>{
      //     this.postText=''
      // })
    }
  },
  components:{
    Message,
  },
  async mounted(){
      await axios(`http://twitter2x.test/chats/2/messages`)
        .then(resp =>{
          this.messages = resp.data;
        });
  }
}
</script>

<style>
::-webkit-scrollbar {
  width: 1rem;
}
::-webkit-scrollbar-thumb {
  background: white;
  border:1px solid black;
  border-radius:50px
}
</style>