<template>
  <div>
     <v-app>
       <header>
             <nav>
               <v-app-bar dark app flat>
                  <v-icon size="30" app flat @click="drawer=!drawer" class="mr-5">menu</v-icon>
                   <v-toolbar-title>
                     <div class="pr-8">
                       <span class="font-effect-outline text-uppercase size25">
                            A_Series
                       </span>
                       <span class="font-effect-fire-animation orange--text font-weight-bold size25">
                             World
                       </span>
                     </div>
                   </v-toolbar-title>
                   <v-spacer></v-spacer>
                  <v-row v-if="!frameuser">
                    <v-col md="9" sm="9" cols="6" class="text-right">
                      
                     <v-btn text class="white--text small" to="/aframe/register" style="text-decoration:none;">
                     <span>Register</span>
                     <v-icon>how_to_reg</v-icon>
                   </v-btn>
                    </v-col>
                    <v-col md="3" sm="3" cols="6" class="text-left pr-2">
                   <v-btn text class="white--text small mr-8 pr-4" to="/aframe/login" style="text-decoration:none;">
                      <span>Login</span>
                      <v-icon>login</v-icon>
                   </v-btn>
                  </v-col>
                   
                  </v-row>
                   <div v-if="frameuser">
                     <v-btn text class="white--text" @click="logout">
                      <span>Logout</span>
                      <v-icon>logout</v-icon>
                   </v-btn>
                   </div>
               </v-app-bar>
              <v-navigation-drawer app v-model="drawer" dark>
                 <v-layout column align-center class="mt-5" v-if="frameuser"> 
                   <v-avatar size="100" v-on="on">
                                   <img :src="`/anime/${frameuser.useravatar}`" alt="">
                                    </v-avatar>
                           <v-dialog v-model="dialog">
                               <template v-slot:activator={on}>
                                  <v-btn v-on="on" text>
                                       <v-icon >edit</v-icon>
                                       <span>Edit</span>
                                   </v-btn>
                               </template>
                               <v-container>
                                 <v-row >
                                   <v-col style="background:white;" cols="12" md="6" offset-md="3">
                                          <v-file-input @change="image" v-model="input">
                                          </v-file-input>
                                          <div class="text-center">
                                             <v-avatar size="100">
                                               <img :src="`/anime/${input}`" alt="" id="img">
                                             </v-avatar><br><br>
                                             <v-btn @click="updateicon">Update</v-btn>
                                          </div>
                                   </v-col>
                                 </v-row>
                               </v-container>
                           </v-dialog>
                       <span class="headline mt-1 white--text">{{frameuser.first_name}} {{frameuser.last_name}}</span>
                       <span class="subheading white--text">{{frameuser.email}}</span>
                  </v-layout>
                <v-list>
                  <v-list-item :class="`link ${link.title}`" v-for="link in links" :key="link.id" :to="link.to">
                    <v-list-item-action>
                      <v-icon>{{link.icon}}</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                      <v-list-item-title>{{link.title}}</v-list-item-title>
                    </v-list-item-content>
                  </v-list-item>
                </v-list>
              </v-navigation-drawer>
             </nav>
       </header>
       <v-main dark class="user">
               <router-view ></router-view>
              
       </v-main>
       <v-footer style="background:black;">
            <v-row justify="center" class="black my-3 white--text">
              <v-btn text class="ml-4 white--text" to="/aframe/home">Home</v-btn>
              <v-btn text class="ml-4 white--text" to="/aframe/contact">Contact us</v-btn>
              <v-btn text class="ml-4 white--text" to="/aframe/about">About us</v-btn>
              <v-col 
              cols="12"
              class="text-center"
              >
                 ammgyi@gmail.com
              </v-col>
            </v-row>
       </v-footer>
     </v-app>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'
export default {
data()
{
  return {
    drawer:false,
    dialog:false,
    input:'',
    links:[
      {icon:'home',title:'Home',to:'/aframe/home'},
      {icon:'chat',title:'Contact',to:'/aframe/contact'},
    {icon:'portrait',title:'About',to:'/aframe/about'}
    ]
  }
},
computed:{
  ...mapGetters(['frameuser'])
},
methods:{
  logout()
  {
    this.$store.dispatch('setuser',null);
  },
  async geticon()
  {
    await axios.get('/aframe/getediticon/'+this.frameuser.id)
    .then((resp)=>{
      this.input=resp.data.useravatar;
    })
  },
  image()
  {
    var file=this.input;
     var reader=new FileReader();
     if(file==null)
       {
           img.src="/anime/user.png";
       }
       else
       {
           reader.onload=(e)=>{
              var result=reader.result;
              var img=document.getElementById('img');
              img.src=result;
           }
           reader.readAsDataURL(file)
       }

  },
  async updateicon()
  {
    var formdata=new FormData();
    formdata.append('useravatar',this.input);
    formdata.append('_method','PUT');
    await axios.post(`/aframe/updateicon/${this.frameuser.id}`,formdata)
    .then((resp)=>{
      this.$store.dispatch('setuser',resp.data)
    })
  }
},
mounted()
{
  if(this.frameuser)
  {
    this.geticon();
  }
  
}
}
</script>

<style lang="scss" scoped>
.v-main.user{
      background: rgb(23, 24, 26);
      width: 100%;
}
.link.Home{
  text-decoration: none;
}
.link.Contact{
  text-decoration: none;
}
.link.About{
  text-decoration: none;
}
.frame{
  width: 100%;
  height: 100%;
  display: flex;
  justify-content: center;
  align-items: center;
}
.item{
  width: 500px;
  height: 200px;
  border: 1px solid white;
  border-radius: 10px;
}
.rad{
  border-radius: 10px;
}
.nal{
  height: 200px;
  border-radius: 10px;
}
.size25{
  font-size:21px;
}
@media only screen and (max-width:600px){
  .size25{
    font-size: 15px;
  }
  
}
</style>