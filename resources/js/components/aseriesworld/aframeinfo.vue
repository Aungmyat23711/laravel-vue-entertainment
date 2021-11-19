<template>
  <div style="padding-bottom:150px;">
      <v-container fluid class="ma-5" v-for="info in eachinfo" :key="info.id">
            <v-row>
                <v-col cols="12" md="4" class="text-center">
                   <img :src="`/anime/${info.photo}`" alt="" style="width:250px;height:300px;">
                </v-col>
                <v-divider vertical></v-divider>
                <v-col cols="12" md="8" class="font-effect-outline">
                    <div class="headline">Name</div>
                    <div class="title">{{info.name}}</div><hr>
                    <div class="headline">Season</div>
                    <div class="title">{{info.total_episode}}</div><hr>
                    <div class="headline">Genre</div>
                    <div class="title">
                     <v-btn text class="my-4" dark>{{info.type1}}</v-btn>
                     <v-btn text class="my-4" dark>{{info.type2}}</v-btn>       
                     <v-btn text class="my-4" dark>{{info.type3}}</v-btn>   
                     <v-btn text class="my-4" dark>{{info.type4}}</v-btn>   
                     <v-btn text class="my-4" dark>{{info.type5}}</v-btn>   
                    </div>
                </v-col>
            </v-row>
            <v-divider></v-divider>
            <v-row>
                <v-col md="12">
                    <div class="headline font-effect-distressed">Plot</div>
                     <div class="title font-effect-distressed">
                         {{info.story}}
                     </div>
                </v-col>
            </v-row>
            <v-divider></v-divider>
      </v-container>
      <v-container fluid>
           <v-row>
               <v-col cols="12" md="6">
                      <v-expansion-panels>
                <v-expansion-panel v-for="season in eachseasons" :key="season.id" class="blue lighten">
                    <v-expansion-panel-header @click="calldata(season.id)" class="white--text">
                        {{season.season}}
                    </v-expansion-panel-header>
                    <v-expansion-panel-content>
                      <v-list class="blue lighten">
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
                                     <span class="font-effect-fire-animation" to="#" style="cursor:pointer;">{{ss.link}}</span>
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
</template>

<script>
export default {
data()
{
    return {
      id:this.$route.params.id,
      eachinfo:[],
      eachseasons:[],
      idseasons:[]
    }
},
methods:{
 async geteachinfo()
 {
     await axios.get('/aframe/info/geteachinfo/'+this.id)
     .then((resp)=>{
         this.eachinfo=resp.data;
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

</style>