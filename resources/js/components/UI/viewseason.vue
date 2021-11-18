<template>
  <div>
      <v-container class="my-5">
          <v-layout row v-for="data in datas" :key='data.id'>
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
          <v-layout row>
               <v-flex xs12 md12 class="my-5">
                     <v-dialog
                            v-model="dialog"
                            max-width="300px"
                            >
                            <template v-slot:activator={on}>
                                <v-btn text v-on="on">
                                    <v-icon>add</v-icon>
                                    <span>Add Season</span>
                                </v-btn>
                            </template>
                              <v-card>
                        <v-card-title class="justify-center">
                            <h4>Adding Season</h4>
                        </v-card-title><hr>
                        <v-card-text>
                            <v-layout row>
                                 <v-flex x12 md12>
                                   <v-text-field
                                   label="Add Season"
                                   outlined
                                   v-model="season"
                                   >

                                   </v-text-field>
                                 </v-flex>
                            </v-layout>
                        </v-card-text>
                        <v-card-actions>
                             <v-btn @click="addseason">
                                 <v-icon>add</v-icon>
                                 <span>Add Season</span>
                             </v-btn>
                        </v-card-actions>
                    </v-card>
                    </v-dialog>
                </v-flex>
                <v-flex xs12 md6 class="my-5">
                   <v-layout row>
                          <v-flex xs12 md12>
                                  <v-list>
                        <v-list-item v-for="ss in seasons" :key='ss.id'>
                            <v-list-item-action>
                                <v-icon>theaters</v-icon>
                            </v-list-item-action>
                            <v-list-item-content>
                                <v-list-item-title>
                                    <v-btn text :to="`/animeframe/myprojects/viewseason/${mid}/viewepisode/${ss.id}`">
                                        {{ss.season}}
                                    </v-btn>
                                </v-list-item-title>
                            </v-list-item-content>
                        </v-list-item>
                    </v-list>
                          </v-flex>
                   </v-layout>
                </v-flex>
          </v-layout>
          <v-layout row class="mt-5">
              <v-flex xs12 md12 class="text-left">
                <v-btn class="red white--text" style="text-decoration:none;" to="/animeframe/myprojects">Back</v-btn>
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
        dialog:false,
        datas:[],
        season:'',
        seasons:[],
        mid:this.$route.params.id,
    }
},
methods:{
    async getdata()
    {
        var id=this.$route.params.id;
      await axios.get('/animeframe/getdata/'+id)
      .then((resp)=>{
          this.datas=resp.data;
          console.warn(resp.data)
      })
    },
    async addseason()
    {
        var id=this.$route.params.id;
              var formdata=new FormData();
      formdata.append('season',this.season);
        await axios.post('/animeframe/addseason/'+id,formdata)
        .then((resp)=>{
            this.getseason();
            this.dialog=false;
            const Toast = Swal.mixin({
  toast: true,
  position: 'top-right',
  iconColor: 'white',
  customClass: {
    popup: 'colored-toast'
  },
  showConfirmButton: false,
  timer: 1500,
  timerProgressBar: true
})
  Toast.fire({
  icon: 'success',
  title: 'Success'
})
        })
    },
    async getseason()
    {
        var id=this.$route.params.id;
        await axios.get('/animeframe/getseason/'+id)
        .then((resp)=>{
            this.seasons=resp.data;
        })
    }
},
mounted()
{
    this.getdata();
    this.getseason();
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