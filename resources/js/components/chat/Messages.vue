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

      <div class="w-100 d-flex align-items-center p-3 mt-auto rounded" style="background-color:#1da1f2"> 
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
      userReceived:''
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
          this.userReceived = this.messages.find((message) =>{
                return message.userId != this.$currentUser.id
          });

        })
        this.scrollBottom();
    },
    scrollBottom(){
      setTimeout(()=>{
      let scrollChat = document.getElementById("messageContainer")
      scrollChat.scrollTo(0,scrollChat.clientHeight+scrollChat.scrollHeight+1000)
      },200)
    },
    renderMessage(data){

          let message

          if(data.user_id == this.userReceived.userId){
              message = {
                id: data.id,
                userId: data.user_id,
                userName: this.userReceived.userName,
                userImage: this.userReceived.userImage,
                message: data.message
              }
          }
          else{
            message = {
                  id: data.id,
                  userId: data.user_id,
                  userName: this.$currentUser.name,
                  userImage: this.$currentUser.image,
                  message: data.message
                }
          }
          this.messages.push(message)
        }
  },
  watch:{
    chatId(){
      this.loader=null
      this.messages= []
      console.log("watch chat id")
      this.chatId != null ? this.getMessages():false;
    }
  },mounted(){
    let channelMessage = pusher.subscribe('Messages');
    channelMessage.bind('sendMessage',(data)=>{
        console.log(data);
        this.renderMessage(data.message);
        this.scrollBottom();
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