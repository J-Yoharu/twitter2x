<template>
  <div>
      <!-- Message -->
      <div class="row mt-3">
        <div class="col-md-auto d-flex align-items-center">
          <h5>Messages {{this.chatId}}</h5>
        </div>
        <div class="col d-flex justify-content-end align-items-center">
          <span class="fa fa-envelope text-primary" data-toggle="modal" data-target="#exampleModalCenter" style="font-size:1.5rem;"></span>
        </div>
      </div>

      <hr class="mt-2"/>
      <!-- Search -->
      <div class="row">
        <div class="col">
          <label class="sr-only" for="inlineFormInputGroupUsername">Username</label>
          <div class="input-group">
            <div class="input-group-prepend">
              <div class="input-group-text rounded-pill"><span class="fa fa-search"></span></div>
            </div>
            <input type="text" class="form-control rounded-pill" placeholder="Procure por pessoas ou grupos">
          </div>
        </div>
      </div>

      <hr/>
      
      <Loader v-if="loader == null" :text="'Carregando suas conversas...'"/>
      
      <div v-else-if="chats.length == 0">Você ainda não iniciou um chat com ninguém :/</div>


      <chat v-else v-for="(chat, index) in chats" @sendChatId="chatId = $event" :key="index" :chatData="chat"/>

    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLongTitle">New Message</h5> 
            <button type="button" class="bg-primary close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>

          <div class="modal-body">
            <profile v-for="(prof, index) in profiles" :key="index" :profileData="prof" />
          </div>


          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import chat from '../components/chat/chat'
import profile from '../components/chat/profile'
import Loader from '../components/Loader'
export default {
  props:['dataUser'],
  components:{
    chat,
    profile
  },
  data(){
    return{
      chatId:'',
      chats:[],
      profiles:'',
      loader:null,
    }
  },
  methods:{
 
  },
  async mounted(){
    let chat = await axios(`http://twitter2x.test/chats/user/${this.$currentUser.id}`)
    let profiles = await axios (`http://twitter2x.test/follows/${this.$currentUser.id}`)
    this.profiles = profiles.data.follows 
    this.loader='ok'
    chat = chat.data.chats



    this.chats = chat.map((chat)=>{
      
      if(chat.username1 != this.$currentUser.username){
        return {
          id:chat.id,
          name: chat.name1,
          username: chat.username1,
          image: chat.image1,
        }
      }
      return {
          id:chat.id,
          name: chat.name2,
          username: chat.username2,
          chat_id: chat.chat_id,
          image: chat.image2,
        }
    })
  },
  watch:{
    chatId(depois,antes){
      console.log(antes)
      console.log(depois)
      this.$emit('chatId',this.chatId)
    }
  }
}
</script>

<style>

</style>
