<template>
  <div>
      <v-container fluid class="pa-5">
          <v-row>
              <v-col cols="4" md="8" >
                <v-btn dark text :to="`/aframe/info/${id}`" style="text-decoration:none;">Back</v-btn>
               </v-col>
                <v-col cols="8" md="4" class="text-right">
               <v-btn dark text to="/aframe/home" style="text-decoration:none;">Home</v-btn>
               </v-col>
              <v-col cols="4" md="8">
               <h4 class="subheading orange--text">{{type}}</h4>
               </v-col>
              
          </v-row>
          <v-row>
               <v-col cols="6" sm="4" md="2" v-for="tab in typedatas" :key="tab.id" class="flexcard" height="100%">
               <v-card dark >
                  <v-responsive class="text-center pt-3 hoverimg" @click="goinfo(tab.id)">
                      <img :src="`/anime/${tab.photo}`" class="image" alt="" style="height:260px;width:210px;">
                      <div class="icon">
                         <v-icon size="50" class="font-effect-fire-animation orange--text">play_circle</v-icon>
                      </div>
                  </v-responsive>
                  <v-divider></v-divider>
                   <v-card-text style="height:90px;">
                       <h6 @click="goinfo(tab.id)" :class="{'font-effect-fire-animation': effect===tab.name}" style="cursor:pointer;" @mouseout="effect=''" @mouseover="active(tab)">{{tab.name}}</h6>
                   </v-card-text>
               </v-card>
          </v-col>
          </v-row>
      </v-container>
      <v-container v-if="this.arrnull==true" style="margin-top:50px;">
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
export default {
data()
{
    return {
        id:this.$route.params.id,
        typedatas:[],
        effect:'',
        type:this.$route.params.type,
        arrnull:false,
    }
},
methods:{
    goinfo(id)
    {
        this.$router.push(`/aframe/typeinfo/${this.type}/${id}`);
    },
    active(tab)
    {
        this.effect=tab.name
    },
    async getTypedata()
    {
        this.arrnull=true;
      await axios.get('/aframe/getTypedata/'+this.type)
      .then((resp)=>{
          this.typedatas=resp.data;
          this.arrnull=false;
      })
    },
},
mounted()
{
    this.getTypedata();
}
}
</script>

<style>

</style>