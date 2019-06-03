<template>
    <div 
    id="main" 
    v-loading="loading" 
    element-loading-background="rgba(0, 0, 0, 0.8)"
    >
        <form id="login" class="demo-input-suffix">
             <h3 class="title">后台管理系统</h3>
             <el-input placeholder="用户名" v-model="username" />
             <el-input placeholder="密码"  v-model="password" type="password" show-password/>
             <el-button type="primary" @click="login">登陆</el-button>
        </form>
    </div>
</template>
<script>
import axios from "axios"
import qs from "qs"
export default {
    data(){
        return {
            username : "root",
            password : "001019",
            loading : false
        }
    },
    methods : {
        login(){
            this.loading = true;
            var user = qs.stringify({
                username : this.username,
                password : this.password
            })
            axios.post(`${this.$store.state.server}/login.php`,user).then((response)=>{
                this.loading = false;

                if(response.data){
                    this.$store.state.userId = response.data.id
                    this.$store.state.userType = response.data.type
                    this.$router.push("/")
                }else{
                    this.$message.error('用户名或密码错误,请重新输入!');
                }
            })
        }
    }
}
</script>
<style>
    #main{
        background-image: url("../assets/iamge/login-bg.jpg");
        background-size: 100%;
    }
    #login{
        width: 300px;
        border: 1px solid #eee;
        border-radius: 5px;
        margin: 200px auto;
        padding: 10px 50px;
    }
    #login > .title{
        text-align: center;
        color: white;
        padding: 10px;
    }
    #login > .el-input{
        padding: 5px;
    }
    #login > .el-button{
        width: 300px;
        margin: 5px;
    }
</style>