const state={
    type:null
}
export default({
    state,
    getters:{
      animetype:(state)=>{
          return state.type
      }
    },
    mutations:{
     getType(state,type)
     {
         state.type=type
     }
    },
    actions:{
     setType(context,type)
     {
         context.commit('getType',type)
     }
    }
})