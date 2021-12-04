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
    <v-container my-5 v-if="adminInfo" fluid>
      <v-card>
        <v-card-title>
          Table Lists
          <v-spacer></v-spacer>
          <v-text-field
            v-model="search"
            append-icon="mdi-magnify"
            label="Search"
            single-line
            hide-details
          ></v-text-field>
        </v-card-title>
        <v-data-table
          :page.sync="page"
          :headers="headers"
          :items="allproducts"
          :search="search"
          :items-per-page="itemsPerPage"
          hide-default-footer
        >
          <template v-slot:top>
            <v-dialog v-model="dialog" max-width="700px">
              <v-card>
                <v-card-title>
                  <span class="text-h5">Form</span>
                </v-card-title>

                <v-card-text>
                  <v-container>
                    <v-row>
                      <v-col cols="12" xs="12" md="6">
                        <v-text-field
                          label="Name"
                          v-model="editName"
                          prepend-icon="mdi-pencil"
                        >
                        </v-text-field>
                      </v-col>
                      <v-col cols="12" xs="12" md="6">
                        <v-text-field
                          label="Tag"
                          v-model="editTag"
                          prepend-icon="tag"
                        >
                        </v-text-field>
                      </v-col>
                    </v-row>
                    <v-row>
                      <v-col cols="12" xs="12" md="6">
                        <v-text-field
                          label="Due Date"
                          v-model="editDate"
                          prepend-icon="calendar"
                        >
                        </v-text-field>
                      </v-col>
                      <v-col cols="12" xs="12" md="6">
                        <v-text-field
                          label="Total"
                          v-model="editTotal"
                          prepend-icon="subject"
                        >
                        </v-text-field>
                      </v-col>
                    </v-row>
                    <v-row>
                      <v-col cols="12" xs="12" md="6">
                        <v-text-field
                          label="Total_Episode"
                          v-model="editTepisode"
                          prepend-icon="view_list"
                        >
                        </v-text-field>
                      </v-col>
                    </v-row>
                    <v-row>
                      <v-col cols="12" xs="6" md="4">
                        <select name="type" v-model="editType1" class="form-control">
                          <option v-for="type in types" :key="type.id" :value="type.type_name">{{type.type_name}}</option>
                        </select>
                      </v-col>
                      <v-col cols="12" xs="6" md="4">
                        <select name="type" v-model="editType2" class="form-control">
                          <option v-for="type in types" :key="type.id" :value="type.type_name">{{type.type_name}}</option>
                        </select>
                      </v-col>
                      <v-col cols="12" xs="6" md="4">
                        <select name="type" v-model="editType3" class="form-control">
                          <option v-for="type in types" :key="type.id" :value="type.type_name">{{type.type_name}}</option>
                        </select>
                      </v-col>
                      <v-col cols="12" xs="6" md="4">
                        <select name="type" v-model="editType4" class="form-control">
                          <option v-for="type in types" :key="type.id" :value="type.type_name">{{type.type_name}}</option>
                        </select>
                      </v-col>
                      <v-col cols="12" xs="6" md="4">
                        <select name="type" v-model="editType5" class="form-control">
                          <option v-for="type in types" :key="type.id" :value="type.type_name">{{type.type_name}}</option>
                        </select>
                      </v-col>
                    </v-row>
                    <v-row>
                      <v-col cols="12" xs="12" md="12">
                        <v-file-input
                          v-model="newfile"
                          @change="submitPhoto"
                          
                          label="Photo"
                          prepend-icon="camera"
                        >
                        </v-file-input>
                        <span class="red--text">{{error}}</span>
                        <v-responsive class="text-center">
                          <img
                            :src="`/anime/${editPhoto}`"
                            alt=""
                            id="img"
                            style="max-height: 250px"
                          />
                        </v-responsive>
                      </v-col>
                    </v-row>
                    <v-row>
                      <v-col cols="12" xs="12" md="12">
                        <v-textarea
                          label="Story"
                          v-model="editStory"
                          prepend-icon="auto_stories"
                        >
                        </v-textarea>
                      </v-col>
                    </v-row>
                  </v-container>
                </v-card-text>

                <v-card-actions>
                  <v-spacer></v-spacer>
                  <v-btn color="blue darken-1" text @click="dialog = false">
                    Cancel
                  </v-btn>
                  <v-btn color="blue darken-1" text @click="save"> Save </v-btn>
                </v-card-actions>
              </v-card>
            </v-dialog>
          </template>
          <template v-slot:[`item.actions`]="{ item }">
            <v-icon small class="mr-2" @click="editItem(item)">
              mdi-pencil
            </v-icon>
            <v-icon small @click="deleteItem(item)"> mdi-delete </v-icon>
          </template>
        </v-data-table>
        <v-pagination
          v-model="page"
          class="my-4"
          :length="length"
        ></v-pagination>
      </v-card>
    </v-container>
  </div>
</template>

<script>
import axios from "axios";
import { eventBus } from "../../app";
import { mapGetters } from "vuex";
export default {
  methods: {
    async getdata(page) {
      await axios.get(`/getdata?page=${page}`).then((resp) => {

        this.page = resp.data.current_page;
        this.itemsPerPage = resp.data.per_page;
        this.length = resp.data.last_page;
        this.allproducts = resp.data.data;
      });
    },
    editItem(item) {
      this.dialog = true;
      this.editName = item.name;
      this.editTag = item.tag;
      this.editDate = item.date;
      this.editTotal = item.total;
      this.editTepisode = item.total_episode;
      this.editStory = item.story;
      this.editPhoto = item.photo;
      this.editType1=item.type1;
      this.editType2=item.type2;
      this.editType3=item.type3;
      this.editType4=item.type4;
      this.editType5=item.type5;
      this.id=item.id;
    },
    async deleteItem(item) {
      var formdata = new FormData();
      formdata.append("_method", "DELETE");
      Swal.fire({
        title: "Do you want to save the changes?",
        showDenyButton: true,
        showCancelButton: true,
        confirmButtonText: "Yes",
        denyButtonText: "No",

        customClass: {
          actions: "my-actions",
          cancelButton: "order-1 right-gap",
          confirmButton: "order-2",
          denyButton: "order-3",
        },
      }).then((result) => {
        if (result.isConfirmed) {
          axios.post(`/deleteitem/${item.id}`, formdata).then((resp) => {
            this.getdata();
            Swal.fire("Deleted!", "", "error");
          });
        } else if (result.isDenied) {
          Swal.fire("Changes are not saved", "", "info");
        }
      });
    },
    async save() {
      var formdata = new FormData();
      formdata.append("name", this.editName);
      formdata.append("tag", this.editTag);
      formdata.append("date", this.editDate);
      formdata.append("total", this.editTotal);
      formdata.append("tepisode", this.editTepisode);
      formdata.append("story", this.editStory);
      formdata.append("photo", this.newfile);
      formdata.append("type1",this.editType1)
      formdata.append("type2",this.editType2)
      formdata.append("type3",this.editType3)
      formdata.append("type4",this.editType4)
      formdata.append("type5",this.editType5)
      formdata.append("_method","PUT");
      this.snackbar = true;
      this.dialog = false;
      await axios.post(`/animeframe/editdata/${this.id}`,formdata)
      .then((resp)=>{
        this.getdata();
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
        title: 'Edited'
      })
         })
        .catch((error)=>{
          // this.error=error.response.data.errors.photo;
         })
    },
    submitPhoto() {
      var input = this.newfile;
      var reader = new FileReader();
      reader.onload = () => {
        var result = reader.result;
        var img = document.getElementById("img");
        img.src = result;
      };
      if (this.newfile == null) {
        img.src = "";
      } else {
        reader.readAsDataURL(input);
      }
    },
      async getType()
    {
      await axios.get('/animeframe/getType')
      .then((resp)=>{
          this.types=resp.data;
      })
    },
  },
  data() {
    return {
      suredelete: false,
      page: null,
      itemsPerPage: null,
      search: "",
      length: null,
      dialog: false,
      editName: "",
      editTag: "",
      editDate: "",
      editTotal: "",
      editTepisode: "",
      editStory: "",
      editPhoto: "",
      editType1:"",
      editType2:"",
      editType3:"",
      editType4:"",
      editType5:"",
      newfile: [],
      snackmessage: "",
      snackbar: false,
      error:'',
      types:[],
      id:'',
      headers: [
        {
          text: "Name",
          align: "start",
          value: "name",
        },
        { text: "Photo", value: "photo" },
        { text: "Tag", value: "tag" },
        { text: "Total", value: "total" },
        { text: "Date", value: "date" },
        { text: "T_Episodes", value: "total_episode" },
        { text: "Actions", value: "actions", sortable: false },
      ],
      allproducts: [],
    };
  },
  watch: {
    page(newval, oldval) {
      this.getdata(newval);
    },
  },
  computed: {
    ...mapGetters(["adminInfo"]),
  },
  created() {
    this.getdata();
    eventBus.$on("pushdata", () => {
      this.getdata();
    });
    eventBus.$on("clicktype",()=>{
      this.getType();
      this.getdata();
    })
    this.getType();

  },
};
</script>

<style lang="scss" scoped>
.id.Naruto {
  border-left: 4px solid yellow;
}
.id.Jujutsu {
  border-left: 4px solid purple;
}
.id.Blackclover {
  border-left: 4px solid black;
}
.id.Onepiece {
  border-left: 4px solid red;
}
.id.Tokyo.Revenger {
  border-left: 4px solid orange;
}
</style>