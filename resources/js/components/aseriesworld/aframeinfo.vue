<template>
  <div style="padding-bottom:150px;">
      <div  v-if="this.notready==false">
 <v-container fluid class="ma-5" v-for="info in eachinfo" :key="info.id">
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
                     <v-btn text class="my-4" dark @click="sendtype(info.type1)">{{info.type1}}</v-btn>
                     <v-btn text class="my-4" dark @click="sendtype(info.type2)">{{info.type2}}</v-btn>       
                     <v-btn text class="my-4" dark @click="sendtype(info.type3)">{{info.type3}}</v-btn>   
                     <v-btn text class="my-4" dark @click="sendtype(info.type4)">{{info.type4}}</v-btn>   
                     <v-btn text class="my-4" dark @click="sendtype(info.type5)">{{info.type5}}</v-btn>   
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
           <v-row>
               <v-col cols="12" md="6">
                     <v-btn to="/aframe/home">Back</v-btn>
               </v-col>
           </v-row>
      </v-container>
      </div>
     
       <v-container v-if="this.notready==true" style="margin-top:150px;">
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
</template>

<script>
import {eventBus} from './../../app'
export default {
data()
{
    return {
      id:this.$route.params.id,
      eachinfo:[],
      eachseasons:[],
      idseasons:[],
      notready:false
    }
},
methods:{
 async geteachinfo()
 {
     if(this.eachinfo.length===0){
         this.notready=true;
     }
     await axios.get('/aframe/info/geteachinfo/'+this.id)
     .then((resp)=>{
         this.eachinfo=resp.data;
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
 async sendtype(type)
 {
     this.$router.push(`/aframe/home/${type}/${this.id}`)
 }
},
mounted()
{
    this.geteachinfo();
    this.getseasoninfo();
    this.calldata();
}
}
</script>

<style>
.nal{
  border: 1px solid orange;
  border-radius: 20px;
  padding: 50px;
  background: orange;
}
</style>