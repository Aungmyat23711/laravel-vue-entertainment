<template>
  <div>
    <vue-progress-bar></vue-progress-bar>
    <v-container fluid  v-if="this.objnull==false">
           <v-card>
    <v-tabs
      dark
      background-color="black darken-3"
      show-arrows
    >
      <v-tabs-slider color="teal lighten-3"></v-tabs-slider>
       <v-tab @click="getdata">
           Latest 
       </v-tab>
      <v-tab
        v-for="tab in tabs"
        :key="tab.id"
        @click="getdatabytype(tab.type_name)"
      >
       {{tab.type_name}}
      </v-tab>
    </v-tabs>
  </v-card>
  <v-row>
    <v-col cols="4" md="8" class="mt-6">
       <h4 class="subheading orange--text">{{type}}</h4>
    </v-col>
    <v-col cols="8" md="4" class="text-right mt-2">
          <v-text-field
          label="Search"
          prepend-icon="search"
          v-model="search"
          dark
          clearable
          @keyup.enter="getsearchdata"
          >
          </v-text-field>
    </v-col>
  </v-row>
    </v-container>
    <div v-if="issearch==false">
          <v-container fluid  v-if="this.objnull==false">
    <!-- <v-layout column>
     <h4 class="subheading orange--text">{{type}}</h4>
    </v-layout> -->
      <v-row v-if="notavaliable==false">
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
      <v-row v-if="notavaliable==false">
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
      <v-row v-if="notavaliable==true">
        <v-col cols="12" md="6" offset-md="3">
            <div class="nal text-center" >
                <h4>This type is not avaliable.</h4>
            </div>
        </v-col>
      </v-row>
  </v-container>  
    </div>
    <div v-if="issearch==true">
          <v-container fluid  v-if="this.objnull==false">
      <v-row v-if="notavaliable==false">
          <v-col cols="6" sm="4" md="2" v-for="tab in searchdata.data" :key="tab.id" class="flexcard" height="100%">
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
      <v-row v-if="notavaliable==false">
        <v-col cols="12" md="12">
           <div>
              <pagination
            :data="searchdata"
            @pagination-change-page="getsearchdata"
            >
            </pagination>
           </div>
        </v-col>
      </v-row>
      <v-row v-if="notavaliable==true">
        <v-col cols="12" md="6" offset-md="3">
            <div class="nal text-center" >
                <h4>This type is not avaliable.</h4>
            </div>
        </v-col>
      </v-row>
  </v-container>
  <v-container v-if="searchisnull==true">
     <v-row>
         <v-col cols="12" md="6" offset-md="3">
           <div class="nal" align="center">
                <h3 class="headline font-effect-fire-animation">Search Something</h3>
                <v-btn class="sand orange--text" @click="getdata">Go Back</v-btn>
           </div>
         </v-col>
       </v-row>
  </v-container>
  <v-container v-if="searchdatanull==true">
     <v-row>
         <v-col cols="12" md="6" offset-md="3">
           <div class="nal" align="center">
                <h3 class="headline font-effect-fire-animation">Not Found</h3>
                <v-btn class="sand orange--text" @click="getdata">Go Back</v-btn>
           </div>
         </v-col>
       </v-row>
  </v-container>
    </div>

  <v-container v-if="this.objnull==true" style="margin-top:150px;">
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
import {mapGetters} from 'vuex'
export default {
data()
{
    return {
        datas:{},
        effect:'',
        tabs:[],
        type:'',
        notavaliable:false,
        objnull:false,
        search:'',
        issearch:false,
        searchdata:{},
        searchisnull:false,
        searchdatanull:false
    }
},
methods:{
   async getdata(page=1)
    {
      this.$Progress.start();
      this.issearch=false;
      this.searchisnull=false; 
      this.searchdatanull=false;   
      if(JSON.stringify(this.datas)==='{}')
      {
        this.objnull=true;
      }else
      {
        this.objnull=false;
      }
      
      await axios.get(`/aframe/getdata?page=${page}`)
      .then((resp)=>{
        this.search=""  
          this.datas=resp.data;
          this.objnull=false;
          this.type=this.search;
          this.notavaliable=false;  
          this.$Progress.finish();
      })
      
    },
    async getsearchdata(page=1)
    {
      this.$Progress.start();
      this.objnull=true;
      this.issearch=true;
      this.searchdatanull=false;
      this.searchisnull=false;
      await axios.get(`/aframe/getsearchdata?page=${page} & search=${this.search}`)
      .then((resp)=>{
       this.searchdata=resp.data
       this.type=this.search;
       if(resp.data.data.length===0)
       {
         this.searchdatanull=true
       }
       else{
         this.searchdatanull=false;
       }
       if(this.search==null || this.search=="")
       {
         this.type="please write something to search";
         this.searchisnull=true;
       }
       this.searchisnull=false;
       this.objnull=false;
       this.$Progress.finish();
      })
    },
    active(tab)
    {
      this.effect=tab.name
    },
    goinfo(id)
    {
       this.$router.push('/aframe/info/'+id)
    },
    async getType()
    {
      await axios.get('/aframe/getType')
      .then((resp)=>{
        this.tabs=resp.data;
      })
    },
    async getdatabytype(name)
    {
      await axios.get('/aframe/getdatabytype/'+name)
      .then((resp)=>{
        this.search=""
        this.type=name;
        this.issearch=false;
        this.datas=resp.data;
        this.searchdatanull=false;   
        if(resp.data.from==null)
       {
          this.notavaliable=true;
       }else{
         this.notavaliable=false;
       }
      })
    }
},
mounted()
{
    this.getType();
     this.getdata();
},
computed:{
  ...mapGetters(['animetype'])
}
}
</script>

<style >

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
.nal{
  border: 1px solid orange;
  border-radius: 20px;
  padding: 50px;
  background: orange;
}
</style>