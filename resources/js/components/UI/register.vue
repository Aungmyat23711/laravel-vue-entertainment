<template>
  <div>
      <div class="text-center mt-5">
                  <v-form ref="form" lazy-validation>
                      <v-container>
                          <v-snackbar v-model="snackbar" :timeout="4000" top>
                              <v-card class="green">
                                  <span>You have registered!</span>
                              <v-btn @click="snackbar=false" text>
                                  OK
                              </v-btn>
                              </v-card>
                          </v-snackbar>
                          <v-card style="border-radius:10px;">
                              <v-card-title class="grey white--text justify-center" >
                                 <h5 class="subheading">Admin Registeration</h5>
                              </v-card-title>
                              <v-card-text>
                                  <v-layout row>
                              <v-flex xs8 md4 offset-md4 offset-xs2>
                                  <v-text-field
                                  label="Name"
                                  v-model="membername"
                                  :rules="nameRules"
                                  prepend-icon="border_color"
                                  outlined
                                  class="mt-6"
                                  >
                                  </v-text-field>
                              </v-flex>
                               <v-flex xs8 md4 offset-md4 offset-xs2>
                
                                     <v-file-input
                                  label="Avatar"
                                  outlined
                                  prepend-icon="person_pin"
                                  v-model="memberavatar"
                                  @change="showimg"
                                  >

                                  </v-file-input>
                                  <span class="red--text">{{inputerror}}</span>
                                  <v-responsive class="text-center">
                                            <img src="#" alt="" id="img" style="max-height:150px;max-width:250px;">
                                  </v-responsive>
                                
                              </v-flex>
                              <v-flex xs8 md4 offset-md4 offset-xs2>
                                  <v-text-field
                                  label="Password"
                                  v-model="memberpassword"
                                  :rules="passwordRules"
                                  prepend-icon="password"
                                  outlined
                                  class="mt-6"
                                  :type="show1? 'text':'password'"
                                  :append-icon="show1? 'mdi-eye':'mdi-eye-off'"
                                  @click:append="show1=!show1"
                                  >
                                  </v-text-field>
                              </v-flex>
                               <v-flex xs8 md4 offset-md4 offset-xs2>
                                  <v-text-field
                                  label="Confirm Password"
                                  v-model="membercpassword"
                                  :rules="cpasswordRules"
                                  prepend-icon="password"
                                  outlined
                                  class="mt-6"
                                  :type="show2? 'text':'password'"
                                  :append-icon="show2? 'mdi-eye':'mdi-eye-off'"
                                  @click:append="show2=!show2"
                                  >
                                  </v-text-field>
                              </v-flex>
                              <v-flex xs8 md4 offset-md4 offset-xs2>
                                  <v-text-field
                                  label="Email"
                                  v-model="memberemail"
                                  :rules="emailRules"
                                  prepend-icon="contact_mail"
                                  outlined
                                  class="mt-6"
                                  >
                                  </v-text-field>
                              </v-flex>
                              <v-flex xs8 md4 offset-md4 offset-xs2>
                                 <v-textarea
                                 v-model="memberRole"
                                 prepend-icon="work"
                                 label="Role"
                                 outlined
                                 :rules="roleRules"
                                 >

                                 </v-textarea>
                              </v-flex>
                              <v-flex xs8 md4 offset-md4 offset-xs2>
                                <span>Already have account?</span>
                                <v-btn
                                small
                                text
                                >
                                 Login
                                </v-btn>
                              </v-flex>
                          </v-layout>
                              </v-card-text>
                              <v-card-actions class="justify-center">
                                  <v-btn
                                  text
                                  @click="reset"
                                  >
                                      Reset
                                  </v-btn>
                                  <v-btn
                                  text
                                  @click="register"
                                  >
                                       Register
                                  </v-btn>
                                  
                              </v-card-actions>
                          </v-card>
                      </v-container>
                  </v-form>
      </div>
  </div>
</template>

<script>
import axios from 'axios'
import { required, digits, email, max, regex } from 'vee-validate/dist/rules'
  import { extend, ValidationObserver, ValidationProvider, setInteractionMode } from 'vee-validate'
  extend('required',{
      ...required,
      message:'{_field_} must not be empty'
  })
export default {
    components:{
        ValidationProvider
    },
data()
{
    return{
        show1:false,
        show2:false,
        membername:'',
        memberpassword:'',
        membercpassword:'',
        memberemail:'',
        memberavatar:[],
        memberRole:'',
        inputerror:'',
        snackbar:false,

        nameRules:[
           v=>!!v || 'Name is required',
        ],
        passwordRules:[
            v=>!!v || 'Password is required',
            
        ],
         cpasswordRules:[
            v=>!!v || 'Password is required',
            
            v=>v===this.memberpassword || 'This password confirm does not match'
        ],
        emailRules:[
            v=>!!v || 'Email is required',
             v => !v || /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/.test(v) || 'E-mail must be valid'
        ],
        roleRules:[
            v=>!!v || 'Role is required',
        ]
    }
},
methods:{
    async register()
    {
        if(this.$refs.form.validate())
        {
            var formdata=new FormData();
            formdata.append('membername',this.membername)
            formdata.append('memberpassword',this.memberpassword)
            formdata.append('memberemail',this.memberemail)
            formdata.append('memberavatar',this.memberavatar)
            formdata.append('memberRole',this.memberRole)
          await axios.post('/animeframe/register/add',formdata)
          .then((resp)=>{
           this.snackbar=true;
           
          })  
          .catch((error)=>{
           this.inputerror=error.response.data.errors.memberavatar[0];
          })
        }
    },
    reset()
    {
        this.$refs.form.reset();
        
    },
    showimg()
    {
       this.inputerror="";
       var input=this.memberavatar;
       var reader=new FileReader();
       if(input==null)
       {
           img.src="";
       }
       else
       {
        
       reader.onload=()=>{
           var result=reader.result;
           var img=document.getElementById('img');
           img.src=result;
       }
       reader.readAsDataURL(input)
       }
    }
}
}
</script>

<style>

</style>