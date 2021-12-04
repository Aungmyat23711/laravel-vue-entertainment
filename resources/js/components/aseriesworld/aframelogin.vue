<template>
  <div class="frame">
      <div class="item" data-aos="fade-right" data-aos-delay="50" data-aos-duration="2000">
           <v-container>
               <v-row>
                   <v-col cols="12" md="12" sm="12">
                       <v-card class="glass">
                           <v-card-title class="justify-center">
                               <span class="subheading black--text">Login</span>
                           </v-card-title>
                           <v-card-text>
                             <form action="" @keyup.enter="alogin">
                                 <div class="form-group">
                                     <label for="email">Email</label>
                                     <input type="email" class="form-control color" v-model="email" @keydown="emailerror=''">
                                     <span class="text-danger">{{emailerror}}</span>
                                 </div>
                                  <div class="form-group">
                                     <label for="email">Password</label>
                                     <input type="password" class="form-control color" v-model="password" @keydown="passworderror=''">
                                     <span class="text-danger">{{passworderror}}</span>
                                 </div>
                             </form>
                           </v-card-text>
                           <v-card-actions class="justify-center">
                               <v-row>
                                   <v-col cols="12" md="6" sm="6" offset-md="3" offset-sm="3" class="text-center">
                                      <v-btn class="glassbtn" 
                               :loading='loading4' 
                               @click="alogin">Login</v-btn>
                                   </v-col>
                                    <v-col cols="12" md="6" sm="6" offset-md="3" offset-sm="3" class="text-center">
                                      <span>If you don't have account,<v-btn text to="/aframe/register">Sign up</v-btn>for free!</span>
                                   </v-col>
                               </v-row>
                               
                              
                           </v-card-actions>
                       </v-card>
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
    email:'',
    password:'',
    loading4:false,
    passworderror:'',
    emailerror:'',
    notmatch:''
    }
},
methods:{
    async alogin()
    {
        this.loading4=true
        var formdata=new FormData()
        formdata.append('email',this.email);
        formdata.append('password',this.password);
        await axios.post('/aframe/login/matchuser',formdata)
        .then((resp)=>{
           if(this.emailerror!="")
           {
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
           }
        this.loading4=false;
        this.password=null;
        this.email="";
        if(resp.data.message)
        {
            this.emailerror=resp.data.message;
            this.loading4=false;
        }else
        {
            this.$store.dispatch('setuser',resp.data)
            this.$router.push('/aframe/home')
        }
        
        })
        .catch((error)=>{
            this.passworderror=error.response.data.errors.password[0];
            this.emailerror=error.response.data.errors.email[0];
            this.loading4=false;
        })
    }
}
}
</script>

<style lang="scss" scoped>

.frame{
    width: 100%;
    height: 100%;
    display: flex;
    justify-content: center;
    align-items: center;
     background:url('/anime/wall2.jpg');
    background-size: 100% 100%;
    background-repeat: no-repeat;
    background-attachment: fixed;
}
.item{
    width:35%;
    height: auto;
   
}
.glass{
    background: rgba(255, 255, 255, 0.52);
border-radius: 16px;
box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
backdrop-filter: blur(6.4px);
-webkit-backdrop-filter: blur(6.4px);
border: 1px solid rgba(255, 255, 255, 0.3);
}
.glassbtn{
    background: rgba(255, 255, 255, 0.52);
box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
backdrop-filter: blur(6.4px);
-webkit-backdrop-filter: blur(6.4px);
border: 1px solid rgba(255, 255, 255, 0.3);
}
.color{
    color: rgb(74, 144, 248);
    background: rgba(255, 255, 255, 0);
border-radius: 2px;
box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
backdrop-filter: blur(6.6px);
-webkit-backdrop-filter: blur(6.6px);
border: 1px solid rgba(255, 255, 255, 0.3);
}
label{
    color: rgb(27, 25, 25);
    font-size: 18px;
}
@media only screen and (max-width:600px){
    .item{
        width: 100%;
    }
}

</style>