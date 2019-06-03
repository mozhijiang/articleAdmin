import Vue from 'vue'
import Vuex from 'vuex'
import axios from "axios"
Vue.use(Vuex)

export default new Vuex.Store({
  state: {
      server : '/api/public/server',
      userId : undefined,
      contentMask : false,
      userType : undefined,
      getUserImg(data,callback){
        axios({
          method : "post",
          url : `${this.server}/main/getUserImg.php`,
          data,
          responseType : "blob"
        }).then(response => {
          callback(URL.createObjectURL(response.data))
        })
      },
      getUserName(data,callback){
        axios({
          method : "post",
          url : `${this.server}/main/getUserName.php`,
          data,
        }).then(response => {
          callback(response.data)
        })
      }
  },
  mutations: {

  },
  actions: {

  }
})