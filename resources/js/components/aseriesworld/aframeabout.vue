<template>
<div class="frameabout">
    <div class="itemabout">
        <v-row>
            <v-col cols="12" md="6" offset-md="3" class="text-center">
                <h1 class="text-white">About us</h1>
                <v-btn>Learn More</v-btn>
            </v-col>
        </v-row>
    </div>
</div>
</template>

<script>
export default {

}
</script>

<style lang="scss" scoped>
   .frameabout{
       background: url('/anime/wallpng1.png');
       background-size: 100% 90%;
       background-attachment: fixed;
       width: 100%;
       height: 100%;
       background-repeat: no-repeat;
       display: flex;
       justify-content: center;
       align-items: center;
   }
   .itemabout{
       width: 100%;
   }
</style>