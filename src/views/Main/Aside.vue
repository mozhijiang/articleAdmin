<template>
    <el-menu 
      :default-active="index"
      class="el-menu-vertical-demo"
      :collapse="isCollapse"
      :router="true"
      background-color="#242f42"
      text-color="#fff"
      style="border:none"
    >
      <el-menu-item index="article-list">
          <i class="el-icon-document"></i>
          <span>文章列表</span>
      </el-menu-item>
      <el-menu-item index="article-add">
        <i class="el-icon-circle-plus-outline"></i>
        <span>文章添加</span>
      </el-menu-item>
      <el-submenu index="article" :disabled="isUser" >
        <template slot="title">
          <i class="el-icon-setting"></i>
          <span>后台管理</span>
        </template>
        <el-menu-item-group>
          <MenuItem v-for="item in articleAdmin" 
          :item="item"
          :key="item.index" />
        </el-menu-item-group>
      </el-submenu>
    </el-menu>
</template>
<script>
import MenuItem from "../../components/MenuItem"
export default {
    props : {
        isCollapse : Boolean
    },
    data(){
        return{
            index :"article-list",
            isUser : this.$store.state.userType === "user",
            articleAdmin : [
              {index : "article-type" , text : "文章类型"},
              {index : "comment-admin" ,text : "评论管理"},
              {index : "user-admin" , text : "用户管理"}
            ]
        }
    },
    components : {
      MenuItem
    }
}
</script>
<style>
  .el-menu-vertical-demo:not(.el-menu--collapse) {
    width: 160px;
  }
</style>


