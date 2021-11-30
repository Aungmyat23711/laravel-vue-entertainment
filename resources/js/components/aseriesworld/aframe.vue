<template>
  <div>
     <v-app>
       <header>
             <nav>
               <v-app-bar dark app flat>
                   <v-app-bar-nav-icon dark @click="drawer=!drawer"></v-app-bar-nav-icon>
                   <v-toolbar-title>
                      <span class="font-effect-outline text-uppercase size25">
                            A_Series
                       </span>
                       <span class="font-effect-fire-animation orange--text font-weight-bold size25">
                             World
                       </span>
                   </v-toolbar-title>
                   <v-spacer></v-spacer>
                  <div v-if="!frameuser">
                     <v-btn text class="white--text" to="/aframe/register" style="text-decoration:none;">
                     <span>Register</span>
                     <v-icon>how_to_reg</v-icon>
                   </v-btn>
                   <v-btn text class="white--text" to="/aframe/login" style="text-decoration:none;">
                      <span>Login</span>
                      <v-icon>login</v-icon>
                   </v-btn>
                  </div>
                   <div v-if="frameuser">
                     <v-btn text class="white--text" @click="logout">
                      <span>Logout</span>
                      <v-icon>logout</v-icon>
                   </v-btn>
                   </div>
               </v-app-bar>
              <v-navigation-drawer app v-model="drawer" dark>
                 <v-layout column align-center class="mt-5" v-if="frameuser">
                           <v-avatar size="100">
                           <img :src="`/anime/${frameuser.useravatar}`" alt="">
                           </v-avatar>
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
              <v-btn text class="ml-4 white--text">Home</v-btn>
              <v-btn text class="ml-4 white--text">Contact us</v-btn>
              <v-btn text class="ml-4 white--text">About us</v-btn>
              <v-btn text class="ml-4 white--text">Team</v-btn>
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
  font-size:25px;
}
@media only screen and (max-width:600px){
  .size25{
    font-size: 20px;
  }
}
</style>