<template>
    <div>
        <div class="userFrom">
            <el-input placeholder="用户名" v-model="formData.username"></el-input>
            <el-input placeholder="密码" v-model="formData.password"></el-input>
            <el-button type="primary" size="small" @click="addUser">创建</el-button>
        </div>
            <el-table
                :data="data"
                style="width: 95%; margin:auto"
            >
                <div>
                <el-table-column
                label="用户名"
                >
                <template slot-scope="scope">
                    <span style="margin-left: 10px">{{ scope.row.name }}</span>
                </template>
                </el-table-column>
                </div>
                 <el-table-column
                label="密码"
                >
                <template slot-scope="scope">
                    <span style="margin-left: 10px">{{ scope.row.password }}</span>
                </template>
                </el-table-column>
                <el-table-column
                label="用户类型"
                >
                <template slot-scope="scope">
                    <span v-if="scope.row.type === 'admin'">管理员</span>
                    <span v-else>用户</span>
                </template>
                </el-table-column>
                 <el-table-column
                label="用户头像"
                >
                <template slot-scope="scope">
                    <Portrait :url="scope.row.url" />
                </template>
                </el-table-column>
                <el-table-column
                label="操作"
                width="180">
                <template slot-scope="scope">
                    <el-button
                    size="mini"
                    type="danger"
                    @click="del(scope.row.id)"
                    :disabled="scope.row.type === 'admin'"
                    >删除</el-button>
                </template>
                </el-table-column>
            </el-table>
    </div>
</template>
<script>
import Portrait from "@/components/PortraitTemplate"
import axios from 'axios'
import qs from "qs"
export default {
    data(){
        return {
            select : "user",
            img : "",
            formData: {
                username: "",
                password: ""
            },
            data: []
        }
    },
    methods: {
        addUser(){
            if(!this.formData.username || !this.formData.password){
                this.$message.error('用户名和密码不能为空!');
                return;
            }
            var data = qs.stringify({
                name : this.formData.username,
                password : this.formData.password,
            })
            axios({
                method : "post",
                url : `${this.$store.state.server}/main/articleAdmin/addUser.php`,
                data
            }).then(data => {
                data.data ? this.$message.success("添加成功") : 
                    this.$message.error('用户名已存在!');
                this.update();
                this.clearForm();
            })
        },
        clearForm(){
            this.formData.username = ""
            this.formData.password = ""
        },
        update(){
            this.$store.state.contentMask = true
            axios({
                method : "post",
                url : `${this.$store.state.server}/main/articleAdmin/getUserMessage.php`,
            }).then(data => {
                this.data = data.data;
            }).then(() => {
                for(let i = 0; i < this.data.length; i++){
                    var data = qs.stringify({
                        userId : this.data[i].id
                    });
                    this.$store.state.getUserImg(data,url => {
                        this.$set(this.data[i],'url',url)
                    })
                }
                this.$store.state.contentMask = false
            })
        },
        del(id){
            if(!confirm("是否确认删除?"))return;
            var data = qs.stringify({
                id : id
            });
            axios({
                method : "post",
                url : `${this.$store.state.server}/main/articleAdmin/delUser.php`,
                data
            }).then(() => {
                this.$message.success("删除成功")
                this.update()
            })
        }
    },
    components: {
        Portrait
    },
    props: {
        logout : Function
    },
    created(){
        this.update();
        this.clearForm();
    }
}
</script>
<style scoped>
    .userFrom{
        display: flex;
        max-width: 500px;
        margin: 5px 0;
        flex-wrap: wrap;
    }
    .userFrom > *{
        flex-grow: 1;
        margin: 5px;
        flex-basis: 100px;
    }
</style>