<template>
  <div>
     <v-container class="my-5" v-if="!adminInfo">
      <v-layout row>
        <v-flex xs12 md6 offset-md3>
          <v-card>
            <v-card-title class="justify-center">
              <h4>Please Login To Continue</h4>
            </v-card-title>
            <v-card-text class="text-center">
              <v-btn text to="/animeframe/login">Login</v-btn>
              <h5>
                Don't you have a account?
              </h5>
              <v-btn text to="/animeframe/register">Register</v-btn>
            </v-card-text>
          </v-card>
        </v-flex>
      </v-layout>
    </v-container>
    <v-container my-5>
      <v-layout row>
        <v-flex md12>
          <v-expansion-panels>
           <v-expansion-panel v-for="project in projects" :key='project.title'>
              <v-expansion-panel-header>
              {{project.name}}
            </v-expansion-panel-header>
            <v-expansion-panel-content>
              <v-card flat>
                <v-card-text> 
                  <v-layout row>
                       <v-flex xs12 md6>
                           <v-responsive class="text-center">
                             <img :src="`/anime/${project.photo}`" alt="" style="max-height: 300px">
                           </v-responsive><br>
                              <v-btn class="warning white--text" :to="`/animeframe/myprojects/viewseason/${project.id}`">
                                <v-icon>preview</v-icon>
                                <span>View Season</span>
                              </v-btn>
                       </v-flex>
                       <v-flex xs12 md6 class="mt-4">
                           <div class="title">Added Date</div>
                           <div class="subheading">{{project.date}}</div><hr>
                           <div class="title">Name</div>
                           <div class="subheading">{{project.name}}</div><hr>
                           <div class="title">Total Season</div>
                           <div class="subheading">{{project.total}}</div><hr>
                           <div class="title">Total Episode</div>
                           <div class="subheading">{{project.total_episode}}</div><hr>
                           
                       </v-flex>
                       
                  </v-layout>
                </v-card-text>
                <v-card-actions>
                  
                </v-card-actions>
              </v-card>
            </v-expansion-panel-content>
           </v-expansion-panel>
          </v-expansion-panels>
        </v-flex>
      </v-layout>
    </v-container>
  </div>
</template>

<script>
import { mapGetters } from 'vuex';
export default {

  data() {
    return {
      search: "",
      projects:[],
      dialog:false,
      season:'',
      seasons:[]
    };
  },
  methods:{
    async getProject()
    { 

     await axios.get(`/animeframe/getproject/${this.adminInfo.id}`)
     .then((resp)=>{
       this.projects=resp.data;
     })
    },
   
    onScroll () {
        this.scrollInvoked++
      },
  },
  computed:{
    ...mapGetters(['adminInfo'])
  },
  mounted()
  {
    if(this.adminInfo)
    {
      this.getProject();
    }
  
  
  }
};
</script>

<style>
</style>