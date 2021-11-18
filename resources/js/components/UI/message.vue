<template>
  <div>
     <ul class="list-group">
       <li class="list-group-item mt-4" :class="className"><slot></slot></li>
       <div align='right'>
         <span class="badge badge-success">{{admin}}</span>
       </div>
     </ul>
    
  </div>
</template>

<script>
export default {
props:['color','subcolor','user'],
data()
{
  return{
    admin:this.user
  }
},
computed:{
    className()
    {
        return "list-group-item-"+this.color
    },
}
}
</script>

<style>

</style>