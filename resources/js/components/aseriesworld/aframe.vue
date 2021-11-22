<template>
  <div>
     <v-app>
       <header>
             <nav>
               <v-app-bar dark app flat>
                   <v-app-bar-nav-icon dark @click="drawer=!drawer"></v-app-bar-nav-icon>
                   <v-toolbar-title>
                      <span class="font-effect-outline text-uppercase " style="font-size:25px;">
                            A_Series
                       </span>
                       <span class="font-effect-fire-animation orange--text font-weight-bold" style="font-size:25px;">
                             World
                       </span>
                   </v-toolbar-title>
                   <v-spacer></v-spacer>
                   <v-btn text class="white--text" to="/aframe/register" style="text-decoration:none;">
                     <span>Register</span>
                     <v-icon>how_to_reg</v-icon>
                   </v-btn>
                   <v-btn text class="white--text" to="/aframe/login" style="text-decoration:none;">
                      <span>Login</span>
                      <v-icon>login</v-icon>
                   </v-btn>
                   <v-btn text class="white--text">
                      <span>Logout</span>
                      <v-icon>logout</v-icon>
                   </v-btn>
               </v-app-bar>
              <v-navigation-drawer app v-model="drawer" dark>
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
         
               <router-view></router-view>
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
                  This is footer
              </v-col>
            </v-row>
       </v-footer>
     </v-app>
  </div>
</template>

<script>
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
}
}
</script>

<style>
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
</style>