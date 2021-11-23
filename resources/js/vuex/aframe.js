const state={
    frameuser:null
}
export default({
    state,
    getters:{
      frameuser:(state)=>
      {
          return state.frameuser
      }
    },
    actions:{
      setuser(context,frameuser)
      {
          context.commit('getuser',frameuser)
      }
    },
    mutations:{
      getuser(state,frameuser)
      {
          state.frameuser=frameuser
      }
    }
})