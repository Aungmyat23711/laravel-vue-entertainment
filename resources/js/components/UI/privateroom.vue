<template>
  <div>
    <v-container class="my-5">
      <v-layout row wrap>
        <v-flex xs12 md12>
          <v-card>
            <v-card-title class="justify-center">
              <h4>Private Room Chat</h4>
              <br />
            </v-card-title>
            <v-card-text>
              <v-layout class="text-center">
                <v-flex md12 xs12>
                  <v-dialog v-model="dialog" max-width="300px">
                    <template v-slot:activator="{ on }">
                      <v-btn class="primary" v-on="on">
                        <v-icon>add_circle_outline</v-icon>
                        <span>create room</span>
                      </v-btn>
                    </template>
                    <v-card>
                      <v-card-title class="justify-center">
                        <h4>Creating Private Room</h4>
                      </v-card-title>
                      <v-card-text>
                        <v-text-field
                          label="create_room"
                          outlined
                          v-model="room"
                        >
                        </v-text-field>
                      </v-card-text>
                      <v-card-actions class="justify-center">
                        <v-btn @click="addroom">
                          <span>create</span>
                        </v-btn>
                      </v-card-actions>
                    </v-card>
                  </v-dialog>
                </v-flex>
              </v-layout>
              <v-divider></v-divider>
              <v-layout row wrap>
                <v-flex md6 xs6>
                  <v-layout  wrap>
                    <v-flex md4 xs12 v-for="ro in rooms" :key="ro.id">
                      <v-list>
                        <v-list-item>
                          <v-list-item-content>
                            <v-list-item-title>
                              <v-dialog :v-model="`dialog`+ro.id">
                                <template v-slot:activator="{ on }">
                                  <v-btn
                                    dark
                                    v-on="on"
                                    @click="getroombyid(ro.id)"
                                  >
                                    <span>{{ ro.room }}</span>
                                  </v-btn>
                                </template>
                                <div v-for="rbd in roombd" :key="rbd.id">
                                  <v-layout row wrap>
                                    <v-flex
                                      class="text-center"
                                      xs6
                                      md2
                                      v-for="team in teams"
                                      :key="team.id"
                                    >
                                      <v-card class="ma-3 my-5">
                                        <v-card-title class="justify-center">
                                          <span class="subheading"
                                            >Current Users</span
                                          >
                                        </v-card-title>
                                        <v-responsive class="pt-4">
                                          <v-avatar size="100">
                                            <img
                                              :src="`/anime/${team.avatar}`"
                                              alt=""
                                            />
                                          </v-avatar>
                                        </v-responsive>
                                        <v-card-text>
                                          <div class="headline">
                                            {{ team.name }}
                                          </div>
                                        </v-card-text>
                                        <v-card-actions class="justify-center">
                                            
                                            <v-btn @click="send(team.id,rbd.id)">
                                           <span>Adding To {{ rbd.room }}</span>
                                           <span></span>
                                          </v-btn>
                                            
                                        
                                        </v-card-actions>
                                      </v-card>
                                    </v-flex>
                                  </v-layout>
                                </div>
                              </v-dialog>
                            </v-list-item-title>
                          </v-list-item-content>
                        </v-list-item>
                      </v-list>
                    </v-flex>
                  </v-layout>
                </v-flex>
                <v-divider
                   vertical
                 ></v-divider>
                <v-flex md6 xs6> 
                  <v-layout row wrap>
                         <v-flex xs12 md6 offset-md3 class="mt-5 ml-6">
                               <v-expansion-panels>
                                 <v-expansion-panel v-for="aduser in addusers" :key="aduser.id">
                                   <v-expansion-panel-header @click="clickexp(aduser.id)">
                                      {{aduser.room}}
                                   </v-expansion-panel-header>
                                   <v-expansion-panel-content>
                                     <v-list>
                                       <v-list-item v-for="ruser in roomusers" :key="ruser.id">
                                         <v-list-item-action>
                                            <v-icon>face</v-icon>
                                         </v-list-item-action>
                                         <v-list-item-content>
                                           <v-list-item-title>
                                             {{ruser.name}}
                                           </v-list-item-title>
                                         </v-list-item-content>
                                       </v-list-item>
                                       <v-list-item>
                                         <v-list-item-action>
                                           <v-icon>chat</v-icon>
                                         </v-list-item-action>
                                         <v-list-item-content>
                                           <v-list-item-title>
                                             <v-btn 
                                             :to="`/animeframe/privatechat/`"
                                             text>Chat Now</v-btn>
                                           </v-list-item-title>
                                         </v-list-item-content>
                                       </v-list-item>
                                     </v-list>
                                     
                                   </v-expansion-panel-content>
                                 </v-expansion-panel>
                               </v-expansion-panels>
                         </v-flex>
                  </v-layout>
                 </v-flex>
              </v-layout>
            </v-card-text>
            <v-card-actions>  </v-card-actions>
          </v-card>
        </v-flex>
      </v-layout>
    </v-container>
  </div>
</template>

<script>
import axios from "axios";
import { mapGetters } from "vuex";
import Swal from 'sweetalert2';

export default {
  data() {
    return {
      room: "",
      dialog: false,
      dialog2: false,
      rooms: [],
      teams: [],
      roombd: [],
      addusers:[],
      roomusers:[],
      unique:""

    };
  },
  computed: {
    ...mapGetters(["adminInfo"]),
  },
  methods: {
    async addroom() {
      await axios
        .post("/animeframe/addroom", {
          room: this.room,
          host_id: this.adminInfo.id,
        })
        .then((resp) => {
          this.getroom();
          const Toast = Swal.mixin({
            toast: true,
            position: "top-right",
            iconColor: "white",
            customClass: {
              popup: "colored-toast",
            },
            showConfirmButton: false,
            timer: 1500,
            timerProgressBar: true,
          });
          Toast.fire({
            icon: "success",
            title: "Created A Room!",
          });
        });
    },
    async getroom() {
      await axios
        .get("/animeframe/getroom/" + this.adminInfo.id)
        .then((resp) => {
          this.rooms = resp.data;
        });
    },
    async getTeam() {
      await axios.get("/animeframe/teamchat/"+this.adminInfo.id).then((resp) => {
        this.teams = resp.data[1];
        this.addusers = resp.data[0];
      });
    },
    async getroombyid(id) {
      this.roombd=""
      await axios.get("/animeframe/getroombyid/" + id).then((resp) => {
        this.roombd = resp.data;
      });
    },
    async clickexp(id)
    {
      this.roomusers=""
      await axios.get('/animeframe/getroomuser/'+id)
      .then((resp)=>{
        this.roomusers=resp.data;
      })
    },
    async send(tid,rid)
    {
        await axios.post('/animeframe/senduser',{
            user_id:tid,
            room_id:rid,
            host_id:this.adminInfo.id
        })
        .then((resp)=>{
            const Toast=Swal.mixin({
                toast:true,
                position:"top-right",
                iconColor:"white",
                customClass:{
                    popup:"colored-toast"
                },
                showConfirmButton:false,
                timer:1500,
                timerProgressBar:true,
            });
             Toast.fire({
             icon:"success",
             title:"Added User"
            })
        })
         .catch((error)=>{
           this.unique=error.response.data.errors.user_id;
           const Toast=Swal.mixin({
             toast:true,
             position:'top-right',
             iconColor:'red',
             customClass:{
               popup:'colored-toast'
             },
             timer:1500,
             timerProgressBar:true,
             showConfirmButton:false,
           })
           Toast.fire({
             icon:"error",
             title:"User is already added"
           })
         })
    }
  },
  mounted() {
    this.getroom();
    this.getTeam();
    // this.clickexp()
  },
  // watch: {
  //   rooms(next,prev)
  //   {
  //       if(next!=prev)
  //       {
  //         this.roombd=""
  //       }
  //   }
  // },
};
</script>

<style>
.v-list-item__title a {
  text-decoration: none;
}
</style>