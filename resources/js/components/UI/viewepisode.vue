<template>
  <div>
      <v-container class="mt-5">
                    <v-layout row wrap v-for="data in datas" :key='data.id'>
               <v-flex xs12 md6 class="text-center">
                  <v-responsive>
                      <img :src="`/anime/${data.photo}`" alt="" style="max-height:300px;max-width:200px;">
                  </v-responsive>
               </v-flex>
               <v-flex xs12 md6 class="left mt-5">
                  <h5 class="subheading">{{data.name}}</h5>
                  <h5 class="subheading">{{data.tag}}</h5>
                  <h5 class="subheading">{{data.date}}</h5>
               </v-flex>
               <v-flex xs12 md12 class="text-left mt-5">
                   <h5 class="headline">PLOT</h5>
                   <h6 class="subheading">{{data.story}}</h6>
               </v-flex>
          </v-layout><br><hr>
      </v-container>
      <v-container>
           <v-layout row wrap >
              <v-flex xs6 offset-xs3 md3 class="ml-5">
                 <v-text-field outlined v-model="episode" label="Episode">
                 </v-text-field>       
              </v-flex>
              <v-flex xs6 offset-xs3 md3 class="ml-5">
                     <v-text-field outlined v-model="name" label="Ep Name">
                 </v-text-field> 
              </v-flex>
              <v-flex xs6 offset-xs3 md3 class="ml-5">
                     <v-text-field outlined v-model="link" label="Link">
                 </v-text-field> 
              </v-flex>
              
                    <v-btn class="info white--text ml-6 mt-4" @click="addepisode">  
                        <span>Add</span>
                        <v-icon>add</v-icon>
                    </v-btn> 
                     <v-btn style="text-decoration:none;" class="red white--text ml-6 mt-4" :to="`/animeframe/myprojects/viewseason/${mid}`">Back</v-btn>
              
          </v-layout>
          <v-layout row wrap>
               <v-flex xs4 md2 v-for="ep in episodes" :key="ep.id" class="my-2">
                    <v-btn text to="#" class="primary--text">
                        <span>{{ep.episode}} . {{ep.ep_name}}</span>
                    </v-btn>
               </v-flex>
          </v-layout>
      </v-container>
  </div>
</template>

<script>
export default {
data()
{
    return{
    datas:[],
    mid:this.$route.params.mid,
    sid:this.$route.params.sid,
    seasons:[],
    name:'',
    episode:'',
    link:'',
    episodes:[],
    }
},
methods:{
     async getdata()
    {
      await axios.get('/animeframe/getdata/'+this.mid)
      .then((resp)=>{
          this.datas=resp.data;
          
      })
    },
     async geteachseason()
    {
        await axios.get('/animeframe/geteachseason/'+this.sid)
        .then((resp)=>{
            this.seasons=resp.data[0];
        })
    },
    async addepisode()
    {
        var formdata=new FormData();
        formdata.append('episode',this.episode)
        formdata.append('link',this.link)
        formdata.append('ep_name',this.name)
        formdata.append('anime_id',this.mid)
        formdata.append('season_id',this.sid)
        await axios.post('/animeframe/addepisode',formdata)
        .then((resp)=>{
            this.episode="";
            this.link="",
            this.name="",
            this.getepisode()
            const Toast=Swal.mixin({
                toast:true,
                position:'top-right',
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
                title:'Success'
            })
        })
    },
    async getepisode()
    {
        await axios.get(`/animeframe/getepisode/${this.sid}`)
        .then((resp)=>{
         this.episodes=resp.data;
        })
    }
},
mounted()
{
    this.getdata();
    this.geteachseason();
    this.getepisode();
}
}
</script>

<style lang="scss" scoped>
@media only screen and (max-width:600px)
{
    .left{
        text-align: center;
    }
}
</style>