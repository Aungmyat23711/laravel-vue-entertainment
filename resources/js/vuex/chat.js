import createPersistedState from 'vuex-persistedstate'

const state={
    admin:null
}

export default({
    state,
    getters:{
     adminInfo:(state)=>
     {
         return state.admin
     }
    },
    mutations:{
    setTeam(state,admin)
    {
        state.admin=admin
    }
    },
    actions:{
    setadmin(context,admin)
    {
        context.commit('setTeam',admin)
    }
    }
    

})