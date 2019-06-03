<template>
    <el-container id="main">
        <el-header id="title">
            <div id="title-container">
              <div id="title-left">
                <i class="el-icon-menu" id="menu" @click="changeCollapse"></i>
                <em>文章管理系统</em>
              </div>
              <div id="title-right">
                <div id="title-user-name"><em>{{ userName }}</em></div>
                <el-dropdown trigger="click">
                  <a
                    id="title-user-img" 
                    class="el-dropdown-link"
                  >
                    <Portrait :url="userImg" />
                    <el-dropdown-menu slot="dropdown">
                      <el-dropdown-item class="clearfix" @click.native="myMessage">
                        我的信息
                      </el-dropdown-item>
                      <el-dropdown-item class="clearfix" @click.native="logout">
                        注销
                      </el-dropdown-item>
                    </el-dropdown-menu>
                  </a>
                </el-dropdown>
              </div>
            </div>
        </el-header>
        <el-container>
            <Aside :isCollapse="isCollapse" />
            <el-main id="content">
              <div 
                id="contentMask"
                v-loading="$store.state.contentMask" 
                element-loading-background="rgba(0, 0, 0, 0.8)"
              >
              <div id="mobileMask" v-if="!isCollapse" @click="changeCollapse"></div>
              <router-view style="padding:10px" :logout="logout">
              </router-view>
              </div>
            </el-main>
        </el-container>
    </el-container>
</template>
<script>
import Aside from "./Main/Aside"
import Portrait from "@/components/PortraitTemplate"
import qs from "qs"
export default {
  data(){
    return {
      isCollapse : true,
      userName : "",
      userImg : "",
    }
  },
  components : {
    Aside,
    Portrait
  },
  methods : {
    changeCollapse(){
      this.isCollapse = !this.isCollapse
    },
    myMessage(){
      this.$router.push("/my-message");
    },
    logout(){
      this.$store.state.userId = undefined
      this.$store.state.userType = undefined
      this.$router.push("/login");
    }
  },
  created(){
    if(!this.$store.state.userId){
      this.$router.push("/login");
      return;
    }
    var data = qs.stringify({
      userId : this.$store.state.userId
    })
    this.$store.state.getUserName(data,(name) => {
		this.userName = name;
		this.$store.state.getUserImg(data,(img) => {
        this.userImg = img
      })
    })
  },
  beforeRouteEnter : (to,from,next) => {
    next((vm) => {
      if(vm.$store.state.userId){
        next();
      }else{
        next("/login");
      }
    })
  }
}
</script>
<style>
  #title{
    padding: 0;
  }
  #title-container{
    width: 100%;
    height: 100%;
  }
  #title-container > div{
    display: inline-block;
  }
  #title-right{
    float: right;
    height: 100%;
  }
  #title-right > .el-dropdown{
    height: 100%;
  }
  #title-right > .el-dropdown :hover{
    cursor: pointer;
  }
  #title-user-img{
    display: inline-block;
    margin: 5px 10px;
  }
  #title-user-name{
    display: inherit;
    float: left;
  }
  #menu{
    padding: 1em;
  }
  #menu:hover{
    cursor: pointer;
    background: #282f50;
  }
  .el-header {
    background-color: #242f42;
    color: white;
    line-height: 60px;
    font-size: 22px;
  }
  .el-aside {
    background-color: #D3DCE6;
    color: #333;
    text-align: center;
    line-height: 300px;
  }
  .el-main {
    background-color: #f0f0f0;
    color: #333;
    text-align: center;
    position: relative;
  }
  @media (max-width:768px){
    #mobileMask{
      background: #000;
      opacity: 0.5;
      position: absolute;
      width: 100%;
      height: 100%;
      left: 0;
      top: 0;
      z-index: 999;
    }
  }
  body > .el-container {
    margin-bottom: 40px;
  }
  #content{
    padding: 0;
    position: relative;
  }
  #contentMask{
    position: relative;
  }
</style>