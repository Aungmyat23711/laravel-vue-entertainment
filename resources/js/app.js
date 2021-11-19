/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');
window.Vue = require('vue').default;
window.Swal=Swal

 import VueRouter from 'vue-router';
 import Swal from 'sweetalert2'
import Vue from 'vue';
import VueSession from 'vue-session'
import store from './vuex'

import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'
import Vuetify from '../plugins/vuetify'
import VueProgressBar from 'vue-progressbar'
Vue.use(BootstrapVue)
Vue.use(IconsPlugin)
Vue.use(VueProgressBar, options)
const options = {
  color: '#bffaf3',
  failedColor: '#874b4b',
  thickness: '5px',
  transition: {
    speed: '0.2s',
    opacity: '0.6s',
    termination: 300
  },
  autoRevert: true,
  location: 'left',
  inverse: false
}

export const eventBus = new Vue();
Vue.use(VueSession)
 Vue.use(VueRouter)
//
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))


//for myecommerce

Vue.component('pagination',require('laravel-vue-pagination'));
Vue.component('myanmarexchange-component',require('./components/UI/myanmarexchangeComponent').default);
Vue.component('animeframe-component',require('./components/UI/animeframe').default);
Vue.component('message-component',require('./components/UI/message').default);
//for aseries world
Vue.component('aseriesworld-component',require('./components/aseriesworld/aframe').default);
//for import myecommerce

//for import anime
import Myprojects from './components/UI/myprojects'
import Animehome from './components/UI/home'
import Team from './components/UI/team'
import Register from './components/UI/register'
import axios  from 'axios';
import Teamlogin from './components/UI/login'
import Viewseason from './components/UI/viewseason'
import Viewepisode from './components/UI/viewepisode'
import Privateroom from './components/UI/privateroom'
import Adminchatting from './components/UI/chatting'
import Aframehome from './components/aseriesworld/aframehome'
import Aframeinfo from './components/aseriesworld/aframeinfo'
import { mapGetters } from 'vuex';



/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */
const routes=[

  // {
  //   name:'ecommerceuregister',
  //   path:'/ecommerce/user/register',
  //   component:Euregister,
  //   beforeEnter:(to,from,next)=>{
  //     if(store.state.euser){
  //       next('/ecommerce/user/home')
  //     }else{
  //       next()
  //     }
  //    }
  // },
  // {
  //   name:'ecommercelogin',
  //   path:'/ecommerce/user/login',
  //   component:Eulogin,
  //   beforeEnter:(to,from,next)=>{
  //    if(store.state.euser){
  //      next('/ecommerce/user/home')
  //    }else{
  //      next()
  //    }
  //   }
  // },
  //for anime
  {
    name:'myprojects',
    path:'/animeframe/myprojects',
    component:Myprojects,
  },
  {
    name:'home',
    path:'/',
    component:Animehome
  },
  {
    name:'team',
    path:'/animeframe/team',
    component:Team,
  },
  {
    name:'register',
    path:'/animeframe/register',
    component:Register,
  },
  {
    name:'teamlogin',
    path:'/animeframe/login',
    component:Teamlogin,
  },
  {
    name:'viewseason',
    path:'/animeframe/myprojects/viewseason/:id',
    component:Viewseason,
    props:true,
  },
  {
    name:'viewepisode',
    path:'/animeframe/myprojects/viewseason/:mid/viewepisode/:sid',
    component:Viewepisode,
    props:true,
  },
  {
    name:'privateroom',
    path:'/animeframe/privatechat',
    component:Privateroom,
    props:true,
  },
  {
    name:'adminchatting',
    path:'/animeframe/admin/chatting',
    component:Adminchatting,
    props:true,
  },
  //for aframe
  {
    name:'aframehome',
    path:'/aframe/home',
    component:Aframehome
  },
  {
    name:'aframeinfo',
    path:'/aframe/info/:id',
    component:Aframeinfo,
    props:true,
  }

]
const router=new VueRouter({
  mode:'history',
  routes
  
})
const app = new Vue({
    el: '#entertainment',
    vuetify:Vuetify,
    router,
    VueSession,
    store,
    // created()
    // {
     
    // },
    // data:{
    //   chat:{
    //     message:[],
    //     user:[],
    //     color:[],
    //     typing:''
    //   },
    // message:'',
    // },
    // methods:{
    //  send()
    //  {
    //    if(this.message.length!=0)
    //    {
    //      this.chat.message.push(this.message)
    //      this.chat.user.push('you')
    //      this.chat.color.push('success')
    //      axios.post('/animeframe/chatpage/send',{
    //        message:this.message,
    //        user:this.adminInfo,
    //        userId:this.adminInfo.room_id
    //      })
    //      .then((resp)=>{
    //        this.message=""
    //      })
    //    }
    //  }
    // },
    // mounted()
    // {
    //   Echo.channel('chatting.1')
    //   .listen('ChatEvent',(e)=>{
    //     console.warn(e)
    //     alert('Hello')
    //   //  this.chat.message.push(e.message)
    //   //  this.chat.user.push(e.user.name)
    //   //  this.chat.color.push('warning')
    //   })
     
    // }
    
    // computed:{
    //   ...mapGetters(['adminInfo'])
    // },
    
});


