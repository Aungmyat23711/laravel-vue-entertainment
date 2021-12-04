<template>
   <div>
       <v-app id="inspire">
          <nav>
                  <v-app-bar flat app class="rgb(223, 220, 220);">
                  <v-icon size="30" app flat @click="drawer=!drawer" class="mr-5">menu</v-icon>
                  <v-toolbar-title>
                       <span class="text-uppercase grey--text">
                            Admin
                       </span>
                       <span class="font-weight-bold">
                             Panel
                       </span>
                  </v-toolbar-title>
                  <v-spacer></v-spacer>
                  <v-menu offset-y>
                     <template v-slot:activator={on}>
                          <v-btn text v-on="on">
                            <v-icon>view_list</v-icon>
                            <span>Menu</span>
                          </v-btn>
                     </template>
                          <v-list>
                              <v-list-item v-for="list in lists" :key="list.text" :to="list.route">
                                      <v-list-item-content>
                                          <v-list-item-title>
                                              {{list.text}}
                                          </v-list-item-title>
                                      </v-list-item-content>
                              </v-list-item>
                             
                          </v-list>
                     
                  </v-menu>
                  <v-btn v-if="!adminInfo" text class="ml-3" to="/animeframe/register" style="text-decoration:none;">
                   <span>Register</span>
                   <v-icon right >how_to_reg</v-icon>
                  </v-btn>
                  <v-btn v-if="!adminInfo" text class="ml-3" to="/animeframe/login" style="text-decoration:none;">
                      <span>Login</span>
                      <v-icon right>account_circle</v-icon>
                  </v-btn>
                  <v-btn v-if="adminInfo" text class="ml-3" @click="logout" style="text-decoration:none;">
                        <span>Logout</span>
                        <v-icon right>logout</v-icon>
                  </v-btn>
                  </v-app-bar>
             
              <v-navigation-drawer app v-model="drawer" class="cyan">
                  <v-layout column align-center class="mt-5" v-if="adminInfo">
                       <v-avatar size="100"> 
                           <img :src="`/anime/${adminInfo.avatar}`" alt="">
                           </v-avatar>
                       <v-dialog v-model="dialog5">
                               <template v-slot:activator={on}>
                                   <v-btn v-on="on" text>
                                       <v-icon >edit</v-icon>
                                       <span>Edit</span>
                                   </v-btn>
                                   
                       <span class="headline mt-1">{{adminInfo.name}}</span>
                       <span class="subheading">{{adminInfo.role}}</span>
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
                       <Popup/> 
                      
                  </v-layout>
                  <v-layout column align-center class="mt-5" v-if="!adminInfo">
                         <v-avatar size="100">
                            <img src="/images/user.png" alt="">
                         </v-avatar> 
                            <span class="subheading mt-1 text-center">Please, login!</span>
                            <v-btn to="/animeframe/login" text >
                                 Login
                            </v-btn>
                                 
                  </v-layout>
                    <v-list>
                        <v-list-item  :class="`link ${link.icon}`" v-for="link in lists" :key='link.text' :to="link.route">
                            <v-list-item-action>
                                <v-icon class="white--text">{{link.icon}}</v-icon>
                            </v-list-item-action>
                            <v-list-item-content>
                                <v-list-item-title class="white--text">
                                    {{link.text}}
                                </v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>
                         <v-dialog
                         width="510"
                         height="600"
                         v-model="dialog2"
                         >
                           <template v-slot:activator={on}>
                               <v-list-item class='addtype' v-on="on">
                                  <v-list-item-action>
                                       <v-icon class="white--text">add</v-icon>
                                  </v-list-item-action>
                                  <v-list-item-content>
                                      <v-list-item-title class="white--text">
                                          Add Types
                                      </v-list-item-title>
                                  </v-list-item-content>
                              </v-list-item>
                           </template>
                           <v-layout row warp>
                               <v-flex xs12 md12>
                                  <v-form ref="form" lazy-validation class="my-6">
                                        <v-card>
                                       <v-card-title class="justify-center">
                                            <h4>Adding Types</h4>
                                       </v-card-title>
                                       <v-card-text>
                                             <v-text-field 
                                             label="Types"
                                             outlined
                                             v-model="type"
                                             :rules="typeRules"
                                             required
                                             ref="ref"
                                             >

                                             </v-text-field>
                                       </v-card-text>
                                       <v-card-actions class="justify-center">
                                             <v-btn @click="addtype">Add</v-btn>
                                       </v-card-actions>
                                   </v-card>
                                  </v-form>
                               </v-flex>
                           </v-layout>
                       </v-dialog>
                        
                    </v-list>
                    
              </v-navigation-drawer>
          </nav>
          <v-main class="back">
              <router-view></router-view>
          </v-main>
          <v-footer>
            <v-row justify="center" class="my-3">
              <v-btn text class="ml-4 ">Dashboard</v-btn>
              <v-btn text class="ml-4 ">My Project</v-btn>
              <v-btn text class="ml-4 ">Team</v-btn>
              <v-col 
              cols="12"
              class="text-center"
              >
                  <span class="title">ammgyi@gmail.com</span>
              </v-col>
            </v-row>
       </v-footer>
       </v-app>
   </div>
</template>

<script>
import Slick from 'vue-slick'
import Popup from './popup.vue'
import {mapGetters} from 'vuex'
import {eventBus} from './../../app'
export default {
   components:{
       Slick,
       Popup
       },
data()
{
    return{
     typeRules:[
         v=>!!v || 'Type is required'
     ],
     input:'',
     dialog5:false,
    showclose:false,
    dialog2:false,
    type:'',
    slickOptions: {
              infinite: true,
              slidesToShow: 6,
              slidesToScroll: 1,
              accessibility:true,
              arrows:false
            },
            drawer: false,
            lists:[
                {icon:'dashboard',text:'Dashboard',route:'/'},
                {icon:'movie',text:'Myprojects',route:'/animeframe/myprojects'},
            ],
    }
},
methods:{
logout()
{
    this.$store.dispatch('setadmin',null)
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
  async geticon()
  {
    await axios.get('/aframe/admin/getediticon/'+this.adminInfo.id)
    .then((resp)=>{
      this.input=resp.data.avatar;
    })
  },
  async updateicon()
  {
    var formdata=new FormData();
    formdata.append('avatar',this.input);
    formdata.append('_method','PUT');
    await axios.post(`/aframe/admin/updateicon/${this.adminInfo.id}`,formdata)
    .then((resp)=>{
      this.$store.dispatch('setadmin',resp.data)
    })
  },
async addtype()
{
   if(this.$refs.form.validate())
   {
        await axios.post('/animeframe/addtype',{
        type:this.type
    })
    .then((resp)=>{
        eventBus.$emit('clicktype');
        var Toast=Swal.mixin({
            toast:true,
            iconColor:'white',
            customClass:{
                popup:'colored-toast'
            },
            showConfirmButton:false,
            timer:1500,
            timerProgressBar:true
            
        })
        Toast.fire({
            icon:'success',
            title:'Added Type'
        })
    })
   }
}
},
computed:{
    ...mapGetters(['adminInfo'])
},
mounted()
{
    if(this.adminInfo)
    {
        this.geticon();
    }
    
}
}
</script>

<style lang="scss" scoped>
.link.dashboard{
   text-decoration: none;
}
.link.movie{
   text-decoration: none;
}
.link.tag{
   text-decoration: none;
}
.link.contacts{
   text-decoration: none;
}
.link.supervised_user_circle{
    text-decoration:none;
}
.link.chat{
    text-decoration: none;
}
.addtype{
    text-decoration: none;
}
#inspire{
    background: rgb(223, 220, 220);
}
</style>