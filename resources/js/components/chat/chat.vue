<template>
    <div>
        <div class="d-flex align-items-start justify-content-start mt-3" style="cursor:pointer" @click="sendChatId">
            
            <!-- Image -->
           
            <div class="col-md-auto p-0 m-0 mr-1">
                <img :src="chatData.image" style="border-radius:50rem; max-width:55px; min-width:55px; min-height:55px; max-height:55px;" alt="profile photo">
            </div>

            <!-- Info -->
            <div class="col p-0">
                <div class="row">
                    <div class="col-md-auto p-0 ml-3">
                        <span style="font-weight:bold; font-size:0.9rem">
                            {{chatData.name}}
                        </span>
                    </div>

                    <div class="row">
                        <div class="col">
                            <div class="span ml-1">
                                @{{chatData.username}}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="text-muted">
                            {{chatData.lastMessage}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr class="m-1">
    </div>   
</template>

<script>
export default {
    props:['chatData'],
    data(){
        return{

        }
    },
    methods:{
        sendChatId(){
            console.log("chamou o metodo")
            this.$emit('sendChatId',this.chatData.id)
        }
  },
}
</script>

<style>

</style>