<template>
  <div>
     <v-container my-5>
          <v-layout row>
          <v-flex xs12 sm6 md4 lg3 v-for="team in teams" :key="team.name">
              <v-card flat class="text-center ma-3">
                  <v-responsive class="pt-4">
                      <v-avatar size="100">
                          <img :src="`/anime/${team.avatar}`" alt="">
                      </v-avatar>
                  </v-responsive>
                  <v-card-text>
                    <div class="headline">{{team.name}}</div>
                    <div class="subheading">{{team.role}}</div>
                  </v-card-text>
                  <v-card-actions>
                     <v-btn text @click="addprivate">
                          <v-icon>message</v-icon>
                          <span>private</span>
                     </v-btn>
                  </v-card-actions>
              </v-card>
          </v-flex>
      </v-layout>
     </v-container>
  </div>
</template>

<script>
import axios from 'axios'
import { mapGetters } from 'vuex'

export default {
data()
{
    return{
        teams:[]
    }
},
methods:{
  async getTeam()
    {
        await axios.get('/animeframe/teamlist')
        .then((resp)=>{
            this.teams=resp.data;
        }) 
    },
    async addprivate()
    {
        var host_id=this.adminInfo.id;
        await axios.post('/animeframe/teamlist/addprivate',{
            room_id:host_id,
        })
        .then((resp)=>{
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
                title:'Added To Private'
            })
        })
    }
},
mounted()
{
    this.getTeam();
},
computed:{
    ...mapGetters(['adminInfo'])
}
}
</script>

<style>

</style>