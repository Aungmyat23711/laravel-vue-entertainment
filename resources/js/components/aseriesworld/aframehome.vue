<template>
  <div>
      <v-card>
    <v-tabs
      dark
      background-color="black darken-3"
      show-arrows
    >
      <v-tabs-slider color="teal lighten-3"></v-tabs-slider>
       <v-tab>
           all 
       </v-tab>
      <v-tab
        v-for="tab in tabs"
        :key="tab.id"
      >
       {{tab.tab}}
      </v-tab>
    </v-tabs>
  </v-card>
  <v-container fluid>
      <v-row >
          <v-col cols="6" sm="4" md="2" v-for="tab in datas.data" :key="tab.id" class="flexcard" height="100%">
               <v-card dark >
                  <v-responsive class="text-center pt-3 hoverimg" @click="goinfo(tab.id)">
                      <img :src="`/anime/${tab.photo}`" class="image" alt="" style="height:260px;width:210px;">
                      <div class="icon">
                         <v-icon size="50" class="font-effect-fire-animation orange--text">play_circle</v-icon>
                      </div>
                  </v-responsive>
                  <v-divider></v-divider>
                   <v-card-text style="height:90px;">
                       <h5 @click="goinfo(tab.id)" :class="{'font-effect-fire-animation': effect===tab.name}" style="cursor:pointer;" @mouseout="effect=''" @mouseover="active(tab)">{{tab.name}}</h5>
                   </v-card-text>
               </v-card>
          </v-col>
      </v-row>
      <v-row>
        <v-col cols="12" md="12">
           <div>
              <pagination
            :data="datas"
            @pagination-change-page="getdata"
            >
            </pagination>
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
        datas:{},
        effect:'',
        tabs:[]
    }
},
methods:{
   async getdata(page=1)
    {
      await axios.get(`/aframe/getdata?page=${page}`)
      .then((resp)=>{
          this.datas=resp.data;
      })
    },
    active(tab)
    {
      this.effect=tab.name
    },
    goinfo(id)
    {
       this.$router.push('/aframe/info/'+id)
    }
},
mounted()
{
    this.getdata();
}
}
</script>

<style>
.flexcard {
  display: flex;
  flex-direction: column;
}
.hoverimg:hover .image{
    opacity: 0.3;
    cursor: pointer;
}
.hoverimg:hover .icon{
    opacity: 1;
}
.icon{
    position: absolute;
    top: 45%;
    opacity:0;
    left: 40%;
    transition: 0.5s ease;
    text-align: center;
    color: red;
    cursor: pointer;
}
ul.pagination{
  padding-left: 50px;
}
.page-item{
  padding:10px;
}
</style>