<template>
  <div>
      <div class="text-center mt-5">
           <v-dialog v-model="dialog" width="600">
               <template v-slot:activator={on}>
                    <v-btn v-on="on" color="blue" dark>
                        Add Items
                    </v-btn>
               </template>
               <v-card>
                   <v-card-title class="headline grey lighten-2" primary-title>
                           Add a new project
                   </v-card-title>
                   <v-card-text>
                      
                       <v-form
                       lazy-validation 
                       class="px-3" ref="form">
                          <v-container>
                              <v-layout row>
                                    <v-flex xs12 md6 class="pa-3">
                                        
                                         <v-text-field 
                                         prepend-icon="description"
                                         label="Name" 
                                         v-model="name"
                                         :rules="inputRules"
                                         required
                                         >
                                        </v-text-field>
                                    </v-flex>
                                    <v-flex xs12 md6 class="pa-3">
                                         <v-text-field 
                                         prepend-icon="tag"
                                         label="Tag" 
                                         v-model="tag"
                                         :rules="tagRules"
                                         required
                                         >
                                        </v-text-field>
                                    </v-flex>
                              </v-layout>
                               <v-layout row>
                                    <v-flex xs12 md6 class="pa-3">
                                         <v-menu>
                                             <template v-slot:activator={on}>
                                                 <v-text-field 
                                                 :value="formattedDate" 
                                                 label="Due date" 
                                                 prepend-icon="mdi-pencil" 
                                                 v-on="on"
                                                 required
                                                 :rules="dateRules"
                                                 >
                                                 </v-text-field>   
                                             </template> 
                                             <v-date-picker v-model="due"></v-date-picker>
                                         </v-menu>
                                    </v-flex>
                                    <v-flex xs12 md6 class="pa-3">
                                         <v-text-field 
                                         v-model="total"
                                         prepend-icon="subject"
                                         label="Total"
                                         required
                                         :rules="totalRules"
                                         >
                                        </v-text-field>
                                    </v-flex>
                              </v-layout>
                              <v-layout row>
                                    <v-flex xs12 md6 class="pa-3">
                                        <v-text-field
                                        v-model="tepisode"
                                        prepend-icon="view_list"
                                        label="Total_Episode"
                                        required
                                        :rules="tepisodeRules"
                                        >

                                        </v-text-field>
                                    </v-flex>
                              </v-layout>
                              <v-layout row>
                                   <v-flex xs6 md4 class="pa-3">
                                       <label for="type1">Type 1</label>
                                        <select name="type" class="form-control" v-model="type1">
                                            <option v-for="tpe in types" :key="tpe.id" :value="tpe.type_name">{{tpe.type_name}}</option>
                                        </select>
                                    </v-flex>
                                     <v-flex xs6 md4 class="pa-3">
                                         <label for="type2">Type 2</label>
                                        <select name="type" class="form-control" v-model="type2">
                                            <option  v-for="tpe in types" :key="tpe.id" :value="tpe.type_name">{{tpe.type_name}}</option>
                                        </select>
                                    </v-flex>
                                     <v-flex xs6 md4 class="pa-3">
                                         <label for="type3">Type 3</label>
                                        <select name="type" class="form-control" v-model="type3">
                                            <option v-for="tpe in types" :key="tpe.id" :value="tpe.type_name">{{tpe.type_name}}</option>
                                        </select>
                                    </v-flex>
                                     <v-flex xs6 md4 class="pa-3">
                                         <label for="type4">Type 4</label>
                                        <select name="type" class="form-control" v-model="type4">
                                            <option  v-for="tpe in types" :key="tpe.id" :value="tpe.type_name">{{tpe.type_name}}</option>
                                        </select>
                                    </v-flex>
                                     <v-flex xs6 md4 class="pa-3">
                                         <label for="type5">Type 5</label>
                                        <select name="type" class="form-control" v-model="type5">
                                            <option v-for="tpe in types" :key="tpe.id" :value="tpe.type_name">{{tpe.type_name}}</option>
                                        </select>
                                    </v-flex>
                              </v-layout>
                              <v-layout row>
                                    <v-flex xs12 md12 class="pa-3">
                                      

                                        <v-file-input
                                        v-model="files"
                                        v-on:change="fileinput" 
                                        prepend-icon="image"
                                        label="Photo" 
                                        truncate-length="50"
                                        ></v-file-input>
                                        <span class="red--text">{{inputerror}}</span>
                                       
                                        <v-responsive class="text-center">
                                            <img src="#" alt="" id="img" style="max-height:200px;max-width:250px;">
                                        </v-responsive>
                                    </v-flex>
                                    <v-flex xs12 md12 class="pa-3">
                                       <v-textarea 
                                       label="story"
                                       prepend-icon="auto_stories"
                                       v-model="story"
                                       :rules="storyRules"
                                       required
                                       ></v-textarea>
                                    </v-flex>
                              </v-layout>
                              <v-layout row>
                                   <v-btn 
                                   type="submit" 
                                   @click="reset"
                                   class="mr-4"
                                   text
                                   >
                                       <span>Reset_Form</span>
                                   </v-btn>
                                   <v-btn 
                                   type="submit" 
                                   @click="createdata"
                                   :loading="loading"
                                   class="mr-4"
                                   text
                                   >
                                       <span>Save</span>
                                   </v-btn>
                              </v-layout>
                          </v-container>
                       </v-form>
                       
                   </v-card-text>
               </v-card>
           </v-dialog>
      </div>
  </div>
</template>

<script>
import moment from 'moment'
import axios from 'axios'
import {eventBus} from '../../app'
import { mapGetters } from 'vuex'
export default {
data()
{
    return {
        name:'',
        dialog:false,
        tag:'',
        due:'',
        story:'',
        total:'',
        tepisode:'',
        loading:false,
        valid:false,
        files:[],
        types:[],
        type1:'',
        type2:'',
        type3:'',
        type4:'',
        type5:'',
        inputerror:'',
        inputRules:[
            v=>!!v || 'Name is required'
        ],
        tagRules:[
            v=>!!v || 'Tag is required'
        ],
        dateRules:[
            v=>!!v || 'Date is required'
        ],
        totalRules:[
            v=>!!v || 'Total is required'
        ],
        tepisodeRules:[
            v=>!!v || 'Total_Episode is required'
        ],
        storyRules:[
            v=>!!v || 'Story is required'
        ],

    }
},
methods:{
    async getType()
    {
      await axios.get('/animeframe/getType')
      .then((resp)=>{
          this.types=resp.data;
      })
    },
      fileinput()
      {
         var input=this.files
         var reader=new FileReader();
         if(input==null)
         {
             img.src=""
         }else
         {
             reader.onload=()=>{
             var result=reader.result
             var img=document.getElementById('img');
             img.src=result
         }
         reader.readAsDataURL(input)
         } 
      },
      async createdata(e)
      {
          e.preventDefault();
          this.loading=true;
         if(this.$refs.form.validate())
         {
          var formdata=new FormData();
          formdata.append('admin_id',this.adminInfo.id)
          formdata.append('name',this.name)
          formdata.append('tag',this.tag)
          formdata.append('total',this.total)
          formdata.append('photo',this.files)
          formdata.append('date',this.formattedDate)
          formdata.append('tepisode',this.tepisode)
          formdata.append('story',this.story)
          formdata.append('type1',this.type1)
          formdata.append('type2',this.type2)
          formdata.append('type3',this.type3)
          formdata.append('type4',this.type4)
          formdata.append('type5',this.type5)
              await axios.post('/createdata/',formdata)
          .then((resp)=>{
              this.due="",
              this.type1="",
              this.type2="",
              this.type3="",
              this.type4="",
              this.type5="",
              this.loading=false;
              eventBus.$emit('pushdata');
              this.dialog=false;
              this.$refs.form.reset();
              this.inputerror="";
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
          .catch((error)=>{
              this.loading=false;
              this.inputerror=error.response.data.errors.photo[0];
          })
         
         }else{
             this.loading=false;
         }
      },
      reset(e)
      {
          e.preventDefault()
          this.$refs.form.reset()
      },
      resetValidation(e)
      {
          e.preventDefault()
          this.$refs.form.resetValidation()
      }
},
computed:{ 
    formattedDate()
    {
        return this.due ? moment(this.due).format('dddd, MMMM Do YYYY') : ''
    },
    ...mapGetters(['adminInfo'])
},
mounted()
{
    this.getType();
}
}
</script>

<style>
.colored-toast.swal2-icon-success {
  background-color: #a5dc86 !important;
}
</style>