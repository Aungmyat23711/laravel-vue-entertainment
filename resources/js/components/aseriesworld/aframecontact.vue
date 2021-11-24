<template>
<div class="frame1">
    <div class="item1 mt-6 mr-8">
       <v-container fluid>
           <v-row>
               <v-col cols="12" class="text-center">
                   <h2 class="white--text" style="font-weight:bolder;">Contact Us</h2>
                   <span class="subheading white--text" style="font-weight:bolder;">If you have a questions, you can contact and feedback us anytime.</span>
               </v-col>
           </v-row>
           <v-row>
               <v-col cols="12" md="6" sm="6">
                    <v-row>
                        <v-col cols="4" md="4" sm="4" class="text-right">
                            <v-avatar class="white" size="55">
                                <v-icon size="30px" color="orange">place</v-icon>
                            </v-avatar>
                        </v-col>
                         <v-col cols="8" md="8" sm="8">
                             <span class="headline blue--text" style="font-weight:bolder;">Address</span><br>
                             <span class="subheading orange--text" style="font-weight:bolder;">North Okkalapa, Thumatetar 23<sup>th</sup> street.</span>
                        </v-col>
                    </v-row>
                   
                     <v-row>
                       <v-col cols="4" md="4" sm="4" class="text-right">
                            <v-avatar class="white" size="55">
                                <v-icon size="30px" color="orange">phone</v-icon>
                            </v-avatar>
                        </v-col>
                         <v-col cols="8" md="8" sm="8">
                            <span class="headline blue--text" style="font-weight:bolder;">Phone</span><br>
                            <span class="subheading orange--text" style="font-weight:bolder;">09254973900</span>
                        </v-col>
                    </v-row>
                    
                     <v-row>
                        <v-col cols="4" md="4" sm="4" class="text-right">
                            <v-avatar class="white" size="55">
                                <v-icon size="30px" color="orange">email</v-icon>
                            </v-avatar>
                        </v-col>
                         <v-col cols="8" md="8" sm="8">
                            <span class="headline blue--text" style="font-weight:bolder;">Email</span><br>
                            <span class="subheading orange--text" style="font-weight:bolder;">ammgyi@gmail.com</span>
                        </v-col>
                    </v-row>
               </v-col>
               <v-col cols="12" md="6" sm="6">
                     <v-row>
                         <v-col cols="12" md="6" offset-md="3" sm="6" offset-sm="3">
                              <v-card>
                          <v-card-title>
                              Feedback Us
                          </v-card-title>
                          <v-card-text>
                              <v-form ref="form">
                                    <v-text-field
                                    label="Full Name"
                                    v-model="fname"
                                    :rules="fnameRules"
                                    required
                                    >
                                    </v-text-field>
                                     <v-text-field
                                    label="Email"
                                    v-model="email"
                                    :rules="emailRules"
                                    required
                                    >
                                     </v-text-field>
                                    <v-textarea
                                   solo
                                   rows="2"
                                   name="input-7-4"
                                   label="Message"
                                   v-model="message"
                                   :rules="messageRules"
                                  ></v-textarea>
                              </v-form>
                          </v-card-text>
                          <v-card-actions>
                              <v-btn class="primary ml-2" @click="sendfeedback">Send</v-btn>
                          </v-card-actions>
                      </v-card>
                         </v-col>
                     </v-row>
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
        fname:'',
        email:'',
        message:'',
        fnameRules:[
            v=>!!v || 'Full Name field is required'
        ],
        emailRules:[
            v=>!!v || 'Email field is required'
        ],
        messageRules:[
            v=>!!v || 'Please, write something'
        ]
    }
},
methods:{
    async sendfeedback()
    {
        if(this.$refs.form.validate())
        {
            var formdata=new FormData();
        formdata.append('fname',this.fname);
        formdata.append('email',this.email);
        formdata.append('message',this.message);
        await axios.post('/aframe/contact/addfeedback',formdata)
        .then((resp)=>{
            this.$refs.form.reset();
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
  title: 'Thanks for feedback'
})
        })
        }
    }
}
}
</script>

<style lang="scss" scoped>
  .frame1{
       display: flex;
    justify-content: flex-start;
    align-items: flex-start;
    width: 100%;
    height: 100%;
    background: linear-gradient(rgba(58, 58, 58, 0.5), rgba(78, 78, 78, 0.5)), url('/anime/wall3.jpg');
    background-size: 100% 100%;
    background-repeat: no-repeat;
    background-attachment: fixed;
    
  }
  .item1{
    opacity: 1.5;
    margin-left: 40px;
    height: auto;
    width: 100%;
}
</style>
  