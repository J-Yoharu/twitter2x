<template>
  <div style="overflow-x:hidden"> 
    <div v-if="chatId == ''">
      <h3>Você não selecionou nenhuma mensagem</h3>
    </div>
    <div class="bg-white d-flex align-items-end flex-column" style="height:100vh" v-else>
      <div  class="w-100" id="messageContainer" style="overflow-y:scroll">
        <Loader :text="'Carregando mensagens'" v-if="loader == null"/>

        <div v-else-if="messages.length == 0">Sem mensagens neste chat :(</div>

        <Message v-else v-for="(message,index) in messages" :key="index" :message="message"/>

      </div>

      <div class="bg-primary w-100 d-flex align-items-center p-3 mt-auto" style="min-height:3rem"> 
          <div class="rounded-lg w-100 bg-light p-2 mr-2" style="outline:none;max-height:7rem;overflow-y:scroll" id="message" contenteditable="true"></div>
        <i class="fa fa-2x fa-paper-plane" @click="sendMessage"></i>
      </div>
    </div>
 

  </div>
</template>

<script>
import Message from './Message'
import Loader from '../Loader'
export default {
  props:['chatId'],
  components:{
    Message,
  },
  data(){
    return{
      messages:[],
      message:'',
      loader:null,
    }
  },
  methods:{
    async sendMessage(){
      let message = $('#message');
      console.log(message)
      await axios.post(`http://twitter2x.test/chats/${this.chatId}/messages`,{
          message:message.text(),
          user_id:this.$currentUser.id,
      }).then((resp)=>{
          message.text('');
      })
    },

    async getMessages(){
     await axios(`http://twitter2x.test/chats/${this.chatId}/messages`)
        .then(resp =>{
          this.messages = resp.data.messages;
          this.loader = 'ok'
        })
          let scrollChat = document.getElementById("messageContainer")
          scrollChat.scrollTo(0,scrollChat.offsetHeight)
    }
  },
  watch:{
    chatId(){
      this.loader=null
      this.messages= []
      console.log("watch chat id")
      this.chatId != null ? this.getMessages():false;
    }
  },
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