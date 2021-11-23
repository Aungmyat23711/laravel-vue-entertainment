import { is } from '@babel/types';
import Vue from 'vue';
import Vuex from 'vuex';
import Ecommerce from './vuex/ecommerce'
import Chat from './vuex/chat'
import Aframe from './vuex/aframe'
import Type from './vuex/type'
import createPersistedState from 'vuex-persistedstate'

Vue.use(Vuex)

const store=new Vuex.Store({
   modules:{
       Ecommerce,
       Chat,
       Aframe,
       Type
   },
   plugins:[
    createPersistedState({
        key:'setteam',
        paths:['Chat.admin'],
        storage:{
           getItem:(key)=>localStorage.getItem(key),
           setItem:(key,value)=>localStorage.setItem(key,value),
           removeItem:(key)=>localStorage.removeItem(key)
        }
        
    }),
    createPersistedState({
        key:['user-data','search-data'],
        paths:['user','search'],
        storage:{
            getItem:(key)=>localStorage.getItem(key),
            setItem:(key,value)=>localStorage.setItem(key,value),
            removeItem:(key)=>localStorage.removeItem(key)
        }
    }),
    createPersistedState({
        key:'ecouser',
        path:['euser'],
        storage:{
            getItem:(key)=>localStorage.getItem(key),
            setItem:(key,value)=>localStorage.setItem(key,value),
            removeItem:(key)=>localStorage.removeItem(key)
        }
    }),
    createPersistedState({
        key:'searchproduct',
        path:['usersearch'],
        storage:{
            getItem:(key)=>localStorage.getItem(key),
            setItem:(key,value)=>localStorage.setItem(key,value),
            removeItem:(key)=>localStorage.removeItem(key)
        }
    }),
    createPersistedState({
        key:'aframeuser',
        path:['Aframe.frameuser'],
        storage:{
            getItem:(key)=>localStorage.getItem(key),
            setItem:(key,value)=>localStorage.setItem(key,value),
            removeItem:(key)=>localStorage.removeItem(key)
        }
        
    }),
    createPersistedState({
        key:'atype',
        path:['Type.type'],
        storage:{
            getItem:(key)=>localStorage.getItem(key),
            setItem:(key,value)=>localStorage.setItem(key,value),
            removeItem:(key)=>localStorage.removeItem(key)
        }
    })
]
})
export default store;