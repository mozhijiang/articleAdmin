<template>
    <div>
        <h3 class="title">个人信息</h3>
        <el-form ref="form" max-width="80px" size="mini" class="form">
            <el-form-item label="用户名" class="box" id="username">
                <el-input v-model="formData.name"></el-input>
            </el-form-item>
            <el-form-item label="密码" class="box" id="password">
                <el-input v-model="formData.password"></el-input>
            </el-form-item>
            <el-form-item>
                <p class="type">用户类型:
                    <span v-if="formData.type === 'admin'">管理员</span>
                    <span v-else>用户</span>
                </p>
            </el-form-item>
            <el-form-item>
                <el-upload
                    class="upload avatar-uploader"
                    action=""
                    :http-request="upload"
                    :show-file-list="false"
                >
                    <img v-if="imageUrl" :src="imageUrl" class="avatar">
                    <i v-else class="el-icon-plus avatar-uploader-icon" style="line-height: 150px"></i>
                </el-upload>
            </el-form-item>
            <el-button type="primary" class="submit" @click="submit">保存修改</el-button>
        </el-form>
    </div>
</template>
<script>
import axios from "axios"
import qs from "qs"
export default {
    data(){
        return {
            formData: {
                name : "",
                password : "",
                type: ""
            },
            imageUrl: "",
            img: ""
        }
    },
    methods: {
        submit(){
            const url = `${this.$store.state.server}/main/updateUserMessage.php`
            var data = new FormData();
            data.append("name",this.formData.name)
            data.append("password",this.formData.password)
            data.append("id",this.$store.state.userId);
            if(this.img)data.append("img",this.img)
            axios.post(url,data).then(data => {
                if(data.data){
                    this.$message.success("修改成功")
                }else{
                    this.$message.error("修改成功")
                }
                this.$router.push("/");
            })
        },
        upload(param){
            var imgType = ["image/jpeg","image/png","image/gif"];
            if(imgType.indexOf(param.file.type) === -1){
                return this.$message.error("格式错误,请上传一张图片!");
            }
            this.img = param.file;
            this.imageUrl = URL.createObjectURL(param.file);
        },
        update(){
            const url = `${this.$store.state.server}/main/getUserMessage.php`
            const data = qs.stringify({
                userId : this.$store.state.userId
            })
            axios({
                method : "post",
                url,
                data
            }).then(data => {
            this.formData = data.data
            }).then(() => {
            this.$store.state.getUserImg(data,(data) => {
                this.imageUrl = data
            })
            })
        }
    },
    created(){
        if(!this.$store.state.userId)return;
        this.update();
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
<style scoped>
    .title{
        margin-top: 10px;
        text-align: center;
        color: #ddd;
    }
    .form{
        display: block;
        max-width: 500px;
        padding: 10px;
        margin: 0 auto;
    }
    .box{
        display: flex;
    }
    .submit{
        width: 100%;
    }
    .el-form-item{
        margin-left: 10px;
    }
    .type{
        color: #606266;
    }
</style>
<style>
    .form > #password > label{
        padding-right: 2em;
    }
    .box > label{
        text-align: left;
    }
    .box > div{
        flex-grow: 1;
    }
    .avatar-uploader .el-upload {
    border: 1px dashed #d9d9d9;
    border-radius: 6px;
    cursor: pointer;
    position: relative;
    overflow: hidden;
  }
  .avatar-uploader .el-upload:hover {
    border-color: #409EFF;
  }
  .avatar-uploader-icon {
    font-size: 28px;
    color: #8c939d;
    width: 150px;
    height: 150px;
    text-align: center;
  }
  .avatar {
    width: 150px;
    height: 150px;
    display: block;
  }
</style>


