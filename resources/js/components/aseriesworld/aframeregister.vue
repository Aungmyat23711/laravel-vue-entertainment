<template>
  <div class="rframe">
     <div class="ritem">
        <v-container>
              <v-row>
                <v-col cols="12" md="12" sm="12">
                  <v-form ref="form">
                     <v-card flat class="back">
                      <v-card-title>
                         <span class="text-white">{{currentTitle}}</span>
                         <v-spacer></v-spacer>
                         <v-avatar 
                         size="24"
                         color="primary lighten-2"
                         class="subheading white--text"
                         v-text="step"
                         >
                           
                         </v-avatar>
                      </v-card-title>
                      <v-window v-model="step">
                      <v-window-item :value="1">
                          <v-card-text>
                            <v-text-field
                            prepend-icon="email"
                            dark
                            label="Email" 
                            v-model="email" 
                            required
                            :rules="emailRule">
                            </v-text-field>
                             <v-file-input
                            dark
                            label="Search and download avatar or skip" 
                            v-model="file" 
                            required
                            @change="filechange"
                            >
                            </v-file-input>
                            <v-layout column align-center>
                              <v-avatar size="100">
                              <img src="/anime/user.png" alt="" id="img">
                            </v-avatar>
                            </v-layout>
                          </v-card-text>
                      </v-window-item>
                      <v-window-item :value="2">
                          <v-card-text>
                            <v-text-field
                            label="First Name"
                            v-model="fname"
                            dark
                            :rules="fnameRule"
                            >

                            </v-text-field>
                            <v-text-field
                            label="Last Name"
                            v-model="lname"
                            dark
                            :rules="lnameRule"
                            >

                            </v-text-field>
                            <v-text-field
                            label="Password"
                            :type="ison ? 'text':'password'"
                            dark
                            v-model="password"
                            :rules="passwordRule"
                            required
                            :append-icon="ison ? 'mdi-eye':'mdi-eye-off'"
                            @click:append="ison=!ison"
                            >

                            </v-text-field>
                            <v-text-field
                            label="Confirm Password"
                            :type="ison1 ? 'text':'password'"
                            dark
                            v-model="cpassword"
                            :rules="cpasswordRule"
                            required
                            :append-icon="ison1 ? 'mdi-eye':'mdi-eye-off'"
                            @click:append="ison1=!ison1"
                            >

                            </v-text-field>
                          </v-card-text>
                      </v-window-item> 
                      <v-window-item :value="3">
                      <v-card-text class="text-center">
                        <span class="font-effect-outline text-uppercase " style="font-size:25px;">
                            A_Series
                       </span>
                       <span class="font-effect-fire-animation orange--text font-weight-bold" style="font-size:25px;">
                             World
                       </span><br><br>
                       <span class="text-h6 white--text">Congratulations!</span><br><br>
                       <span class="text-h6 white--text">You have created an account!</span>
                      </v-card-text>
                    </v-window-item>
                    </v-window>
                   
                    <v-divider></v-divider>
                    <v-card-actions>
                      <v-btn
                       @click="step===1 ? gologin():step--"
                       text
                      >{{step===1 ? 'Login':'Back'}}</v-btn>
                      <v-spacer></v-spacer>
                      <v-btn
                      style="text-decoration:none;"
                      :to="step===3? '/aframe/login':null"
                      @click="step===2? register():nextstep()"
                      color="rgb(233, 206, 211)"
                      :loading='loading4'
                      >
                        <span>{{step===3? 'Login':'Next'}}</span>
                      </v-btn>
                    </v-card-actions>
                    </v-card>
                  </v-form>
                   
                </v-col>
              </v-row>
        </v-container>
     </div>
  </div>
</template>

<script>
export default {
data()
{
  return {
    file:[],
    step:1,
    email:'',
    ison:false,
    ison1:false,
    password:'',
    cpassword:'',
    fname:'',
    lname:'',
    loader:null,
    loading4:false,
    emailunique:false,
    passwordRule:[
      v=>!!v || 'Password field is required!',
      v=>v.length >=4 || 'Character must be greater than 4'
    ],
    cpasswordRule:[
      v=>!!v || 'Confirm Password field is required!',
      v=>v===this.password || 'Confirm Password is not match!',
      v=>v.length >=4 || 'Character must be greater than 4'
    ],
    emailRule:[
      v=>!!v || 'Email field is required!',
      v => !v || /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/.test(v) || 'E-mail must be valid'
    ],
    fnameRule:[
      v=>!!v || 'First Name field is required!'
    ],
      lnameRule:[
      v=>!!v || 'Last Name field is required!'
    ]
  }
},
computed:{
  currentTitle()
  {
    switch(this.step)
    {
      case 1:return "Sign up"
      case 2:return "Choose Password"
      default:return "Account Created"
    }
  }
},
methods:{
  filechange()
  {
     var file=this.file;
     var reader=new FileReader();
     if(file==null)
       {
           img.src="/anime/user.png";
       }
       else
       {
           reader.onload=(e)=>{
              var result=reader.result;
              var img=document.getElementById('img');
              img.src=result;
           }
           reader.readAsDataURL(file)
       }

   
  },
  nextstep()
  {
     if(this.$refs.form.validate())
     {
       this.step=this.step+1
     }
    
  },
  gologin(){
  this.$router.push('/aframe/login');
  },
  async register()
  {
   if(this.$refs.form.validate())
   {
      this.loading4=true;
    var formdata=new FormData();
    formdata.append('first_name',this.fname);
    formdata.append('last_name',this.lname);
    formdata.append('password',this.password);
    formdata.append('email',this.email)
    formdata.append('useravatar',this.file)
    await axios.post('/aframe/register/adduser',formdata)
    .then((resp)=>{
      this.loading4=false;
      this.email="";
      this.password="";
      this.cpassword="";
      this.step=this.step+1;
      this.emailunique=false;
    })
    .catch((error)=>{
      if(error.response.data.errors.email)
      {
        this.emailunique=true;
        this.step=this.step-2
      }
    })
   }
  }
},
watch:{
  emailunique(next,pre)
  {
    if(next==true)
    {
      this.loading4=false;
    }   
  }
}
}
</script>

<style lang="scss" scoped>
.rframe{
    display: flex;
    justify-content: flex-start;
    align-items: center;
    width: 100%;
    height: 100%;
    background: url('/anime/wall.jpg');
    background-size: 100% 100%;
    background-repeat: no-repeat;
        background-attachment: fixed;
}
.ritem{
    background: white;
    border: 1px solid white;
    background-image: linear-gradient(black,rgb(107, 177, 243));
    margin-left: 40px;
    width: 40%;
    height: auto;
}
.back{
  background-image: linear-gradient(black,rgb(107, 177, 243));
}
@media only screen and (max-width:600px)
{
  .ritem{
    width:100%;
    margin-right: 40px;
  }
}
</style>