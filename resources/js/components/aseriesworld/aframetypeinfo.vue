<template>
<div>
     <div v-if="frameuser">
      
 <v-container fluid class="ma-5" v-for="info in typeinfo" :key="info.id">
     <v-row>
               <v-col cols="4" md="8">
                     <v-btn dark text :to="`/aframe/home/${type}/${id}`">Back</v-btn>
               </v-col>
                <v-col cols="8" md="4" class="text-right pr-12">
               <v-btn dark to="/aframe/home" style="text-decoration:none;">Home</v-btn>
               </v-col>
     </v-row>
            <v-row>
                <v-col cols="12" md="4" class="text-center">
                   <img :src="`/anime/${info.photo}`" alt="" style="width:250px;height:300px;">
                </v-col>
                <v-divider vertical></v-divider>
                <v-col cols="12" md="8" class="font-effect-outline">
                    <div class="headline orange--text">Name</div>
                    <div class="title">{{info.name}}</div><hr>
                    <div class="headline orange--text">Season</div>
                    <div class="title">{{info.total_episode}}</div><hr>
                    <div class="headline orange--text">Genre</div>
                    <div class="title">
                     <v-btn text class="my-4" :disabled="info.type1===null" dark @click="sendtype(info.type1)">{{info.type1}}</v-btn>
                     <v-btn text class="my-4" :disabled="info.type2===null" dark @click="sendtype(info.type2)">{{info.type2}}</v-btn>       
                     <v-btn text class="my-4" :disabled="info.type3===null" dark @click="sendtype(info.type3)">{{info.type3}}</v-btn>   
                     <v-btn text class="my-4" :disabled="info.type4===null" dark @click="sendtype(info.type4)">{{info.type4}}</v-btn>   
                     <v-btn text class="my-4" :disabled="info.type5===null" dark @click="sendtype(info.type5)">{{info.type5}}</v-btn>   
                    </div>
                </v-col>
            </v-row>
            <v-divider></v-divider>
            <v-row>
                <v-col md="12">
                    <div class="headline font-effect-outline orange--text">Plot</div>
                     <div class="title font-effect-outline white--text">
                         {{info.story}}
                     </div>
                </v-col>
            </v-row>
            <v-divider></v-divider>
      </v-container>
      <v-container fluid class="ma-5">
           <v-row>
               <v-col cols="10" md="6">
                      <v-expansion-panels>
                <v-expansion-panel v-for="season in eachseasons" :key="season.id" class="orange darken">
                    <v-expansion-panel-header @click="calldata(season.id)" class="white--text">
                        {{season.season}}
                    </v-expansion-panel-header>
                    <v-expansion-panel-content>
                      <v-list class="orange darken">
                          <v-list-item v-for="ss in idseasons" :key="ss.id">
                              <v-list-item-action  class=" white--text">
                                     {{ss.episode}}
                              </v-list-item-action>
                              <v-list-item-content>
                                  <v-list-item-title  class=" white--text">
                                     {{ss.ep_name}}
                                  </v-list-item-title>
                              </v-list-item-content>
                              <v-list-item-content>
                                  <v-list-item-title  class=" white--text">
                                     <span class="blue--text" to="#" style="cursor:pointer;">{{ss.link}}</span>
                                  </v-list-item-title>
                              </v-list-item-content>
                          </v-list-item>
                      </v-list>
                    </v-expansion-panel-content>
                </v-expansion-panel>
            </v-expansion-panels>
               </v-col>
           </v-row>
      </v-container>
      <v-container class='mt5' fluid>
        <v-row>
            <v-col cols="12" md="6" offset-md="3">
              <h2 class="white--text">Message Box</h2>
            </v-col>
        </v-row>
            <v-row>
              <v-col cols="12" md="6" offset-md="3">
                 <v-form>
                   <v-textarea
                   solo
                   v-model="message"
                   placeholder="write some text"
                   @keyup.enter="send"
                   >

                   </v-textarea>
                   <v-btn small @click="delsession">Delete Session</v-btn>
                 </v-form>
              </v-col>
            </v-row>
            <v-row>
              <v-col cols="12" md="6" offset-md="3">
                  <v-list style="border-radius:10px;" 
                  dark
                  class="overflow-y-auto"
                  max-height="400"
                   id="bottom"
                  >
                    <v-list-item v-for="chatting,index in chat.message" :key="chatting.index">
                      <v-list-item-action>
                        <v-avatar class="mb-6" size="60">
                         <img :src="`/anime/${chat.icon[index]}`" alt="" >
                        </v-avatar>
                      </v-list-item-action>
                      <v-list-item-content >
                        <v-list-item-title class='pa-5' :class="chat.className[index]" style="border-radius:10px;">
                            <span style="font-size:18px;" class="white--text">{{chatting}}</span>
                        </v-list-item-title> 
                         <v-list-item-title class="mt-2">
                          <small class="badge float-right" :class="chat.badge[index]">{{chat.user[index]}}</small>
                          <small class="badge float-left" :class="chat.badge[index]">{{chat.time[index]}}</small>
                         </v-list-item-title>   
                      </v-list-item-content>
                    </v-list-item>
                  </v-list>
              </v-col>
            </v-row>
      </v-container>
     
       <v-container v-if="this.notready==true" style="margin-top:50px;">
       <v-row>
         <v-col cols="12" md="6" offset-md="3">
           <div class="nal" align="center">
                <h3 class="headline font-effect-fire-animation">Loading</h3>
                <div class="spinner-grow text-primary" role="status">
  <span class="sr-only">Loading...</span>
</div>
<div class="spinner-grow text-secondary" role="status">
  <span class="sr-only">Loading...</span>
</div>
<div class="spinner-grow text-success" role="status">
  <span class="sr-only">Loading...</span>
</div>
<div class="spinner-grow text-danger" role="status">
  <span class="sr-only">Loading...</span>
</div>   
           </div>
         </v-col>
       </v-row>
  </v-container>
  </div>
    <div v-if="!frameuser">
      <div class="frame">
          <div class="item">
              <v-card class="orange">
                <v-card-title class="justify-center">
                  <span class="headline white--text">Please login to continue!</span>
                </v-card-title>
                <v-card-text class="justify-center text-center">
                  <v-btn to="/aframe/login" class="orange white--text" style="text-decoration:none;">Login</v-btn>
                </v-card-text>
              </v-card>
          </div>
      </div>
    </div>   
</div>
 
</template>

<script>
import { mapGetters } from 'vuex';
export default {
data()
{
    return {
        notready:false,
        id:this.$route.params.id,
        typeinfo:[],
        type:this.$route.params.type,
        eachseasons:[],
        idseasons:[],
         message:'',
      time:'',
      chat:{
        className:[],
        badge:[],
        message:[],
        user:[],
        icon:[],
        time:[]
      },
      scrollInvoked: 0,

    }
},
methods:{
    async getinfotype()
 {
     
         this.notready=true;
     await axios.get('/aframe/info/geteachinfo/'+this.id)
     .then((resp)=>{
         this.typeinfo=resp.data;
         this.notready=false;
     })
 },
  async getseasoninfo()
 {
     await axios.get('/aframe/info/getseasoninfo/'+this.id)
     .then((resp)=>{
      this.eachseasons=resp.data;
     })
 },
  async calldata(id)
 {
     this.idseasons="";
     await axios.get('/aframe/info/getseasonbyid/'+id)
     .then((resp)=>{
      this.idseasons=resp.data;
         
     })
 },
 sendtype(type)
 {
     this.$router.push(`/aframe/home/${type}/${this.id}`)
 },
 async send()
 {
    if(this.message.length!=0)
    {
      this.chat.className.push('primary')
      this.chat.badge.push('badge-primary')
      this.chat.message.push(this.message)
      this.chat.icon.push(this.frameuser.useravatar)
      this.chat.user.push('you')
      this.chat.time.push(this.time)
      await axios.post('/aframe/send',{
        message:this.message,
        main_id:this.id,
        user:this.frameuser,
        chat:this.chat,
        time:this.time,
      })
      .then((resp)=>{
        this.message="" 
        window.scrollTo(0,document.body.scrollHeight);
        const theElement = document.getElementById('bottom');
        const scrollToBottom = (node) => {
	       node.scrollTop = node.scrollHeight;
         }
         scrollToBottom(theElement);
        
      })
    }
 },
 async getOldMessage()
 {
   await axios.get('/getOldMessage/'+this.id)
   .then((resp)=>{
     console.warn(resp.data);
     if(resp.data != '')
     this.chat=resp.data;
   })
 },
 async delsession()
 {
  var formdata=new FormData();
  formdata.append('_method',"DELETE");
  await axios.post('/delsession/'+this.id,formdata)
  .then((resp)=>{
     const Toast = Swal.mixin({
  toast: true,
  position: 'top-right',
  iconColor: 'yellow',
  customClass: {
    popup: 'colored-toast'
  },
  showConfirmButton: false,
  timer: 2300,
  timerProgressBar: true
})
  Toast.fire({
  icon: 'info',
  title: 'Your history is clear!Please refresh to apply',
   color:'red'
})
  })
 },
  phpecho()
 {
    
   Echo.channel(`chat.${this.id}`)
   .listen('ChatEvent',(e)=>{
     this.chat.user.push(e.user.first_name)
     this.chat.className.push('orange')
     this.chat.badge.push('badge-info')
     this.chat.message.push(e.message)
     this.chat.icon.push(e.user.useravatar)
     this.chat.time.push(e.time)
       axios.post(`/saveToSession/${this.id}`,{
                    chat : this.chat
                })
                      .then(response => {
                          window.scrollTo(0,document.body.scrollHeight);
        const theElement = document.getElementById('bottom');
        const scrollToBottom = (node) => {
	       node.scrollTop = node.scrollHeight;
         }
         scrollToBottom(theElement);
                      })
                      .catch(error => {
                        console.log(error);
                      });
   })
    
 },
 getTime()
   {
     var data=new Date();
     this.time=data.getHours()+':'+data.getMinutes()+':'+data.getSeconds();
     
   }
},
mounted()
{
    this.getTime();
    this.getinfotype();
    this.getseasoninfo();
    this.phpecho();
    this.getOldMessage();
},
computed:{
    ...mapGetters(['frameuser'])
}
}
</script>

<style>

</style>