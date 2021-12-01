<template>
  <div>
      <v-container class="mt-5">
          <v-layout row>
              <v-flex xs-12 offset-md3 md6>
       <v-card>
      <v-card-title class="justify-center">
        <h4 class="subheading">Admin Login</h4>
      </v-card-title>
      <v-card-text>
        
          <v-form>
            <v-layout row>
              <v-flex xs12 md6 offset-md3>
                <v-text-field
                  label="Email"
                  :rules="emailRules"
                  outlined
                  v-model="acceptemail"
                >
                </v-text-field>
              </v-flex>
              <v-flex xs12 md6 offset-md3>
                <v-text-field
                  label="Password"
                  :rules="passwordRules"
                  outlined
                  v-model="acceptpassword"
                  :type="hide ? 'text':'password'"
                  :append-icon="hide? 'mdi-eye':'mdi-eye-off'"
                  @click:append="hide=!hide"
                  @keyup.enter="login"
                >
                </v-text-field>
              </v-flex>
              <v-flex xs12 md6 offset-md3>
                       <span class="red--text subheading">{{message}}</span>
              </v-flex>
            </v-layout>
          </v-form>
        
      </v-card-text>
      <v-card-actions class="justify-center">
          <v-btn dark class="grey" @click="login">
             <span>Login</span>
          </v-btn>
      </v-card-actions>
    </v-card>
              </v-flex>
          </v-layout>
    
      </v-container>
   
  </div>
</template>

<script>
import { email } from 'vee-validate/dist/rules';
import {mapGetters} from 'vuex'
import axios from 'axios'
export default {
    data()
    {
        return{
            hide:false,
            emailRules: [
                v => !!v || 'E-mail is required',
                v => /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/.test(v) || 'E-mail must be valid',
            ],
            passwordRules:[
                v=>!!v || 'Password is required'
            ],
            acceptemail:'',
            acceptpassword:'',
            message:'',
        }   
    },
    computed:{
        ...mapGetters(['adminInfo'])
    },
    methods:{
        async login($event)
        {
            $event.preventDefault();
            await axios.post('/animeframe/login/accept',{
                email:this.acceptemail,
                password:this.acceptpassword,
            })
            .then((resp)=>{
                
                
                if(resp.data.message)
                {
                  this.message=resp.data.message;
                }else{
                  this.$store.dispatch('setadmin',resp.data)
                  this.$router.push('/')
                }
            })
        }
    },
};
</script>

<style>
</style>