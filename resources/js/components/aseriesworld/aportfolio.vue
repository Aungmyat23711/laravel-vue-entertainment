<template>
  <div class="pframe">
    <div class="pitem ma-6">
        <v-card style="border-radius:20px;">
            <v-card-title class="justify-center">
                   <span class="headline grey--text">My Portfolio</span>
               </v-card-title>
           <v-card-text>
                <v-container>
                    <v-row>
                        <v-col cols="12" md="12" class="text-center">
                            <v-responsive>
                                <v-avatar size="150">
                                    <img src="/anime/black.ico" alt="">
                                </v-avatar>
                            </v-responsive>
                            <span class="title">Aung Myint Myat</span><br>
                            <span class="title">Laravel and Vue Js Developer</span>
                        </v-col>
                    </v-row>
                    <v-row class="ml-5">
                        <v-col cols="12" md="6">
                               <h4><v-icon size="35" style="color: rgb(22, 145, 22);">code</v-icon> Front End</h4>
                               <h5>Html, Css, Javascript, Vuejs, Vuex</h5>
                        </v-col>
                        <v-divider horizontal ></v-divider>
                        <v-col cols="12" md="6">
                               <h4><v-icon size="35" style="color: rgb(22, 145, 22);">source</v-icon> Back End</h4>
                               <h5>Laravel</h5>
                        </v-col>
                        </v-row>

                        <v-row class="mt-6 ml-5">
                        <v-col cols="12" md="6">
                                <h4><v-icon size="35" style="color: rgb(22, 145, 22);">insert_chart</v-icon> Database</h4>
                               <h5>Mysql Database</h5>
                        </v-col>
                        <v-col cols="12" md="6">
                               <h4><v-icon size="35" style="color: rgb(22, 145, 22);">architecture</v-icon> UI Design</h4>
                               <h5>Bootstrap, Vuetify</h5>
                        </v-col>
                    </v-row>
                </v-container>
           </v-card-text>
        </v-card>
    </div>
  </div>
</template>

<script>
export default {

}
</script>

<style lang="scss" scoped>
.pframe{
  width: 100%;
  height: 100%;
  background: url('/anime/portfolio.jpg');
  background-size: 100% 100%;
  justify-content: center;
  
  display: flex;
}
.pitem{
width: 500px;
height: auto;
}
h4{
    color: rgb(22, 145, 22);
}

</style>