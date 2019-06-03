<template>
    <el-form ref="form" :model="formData" label-width="80px" size="mini">
        <el-form-item label="文章标题">
            <el-input v-model="formData.title"></el-input>
        </el-form-item>
        <el-form-item label="文章类型">
            <el-select v-model="formData.type_id" placeholder="请选择文章类型" style="float:left">
            <el-option v-for="type in types" :label="type.name" :value="type.id" :key="type.id"></el-option>
            </el-select>
        </el-form-item>
        <el-form-item label="文章内容">
            <el-input type="textarea" v-model="formData.content"></el-input>
        </el-form-item>
        <el-form-item size="large">
            <el-button type="primary" @click="submit">立即添加</el-button>
        </el-form-item>
    </el-form>
</template>
<script>
import axios from "axios"
import qs from "qs"
export default {
    data(){
        return {
            formData : {
                title : "",
                type_id : "",
                content : ""
            },
            types : []
        }
    },
    methods: {
        submit(){
            var fd = this.formData;
            if(fd.title === "" || fd.type_id === "" || fd.content === ""){
                this.$message.error("有未填字段");
                return;
            }else{    
                var data = qs.stringify({
                    title: fd.title,
                    type_id: fd.type_id,
                    content: fd.content
                });
                axios({
                    method: "post",
                    url: `${this.$store.state.server}/main/addArticle.php`,
                    data
                }).then(data => {
                    data.data ? 
                    this.$message.success("添加成功") : 
                    this.$message.error("添加失败,请重试!");
                    this.clearFormData();
                })
            }
        },
        clearFormData(){
            this.formData.title = "";
            this.formData.type_id = "";
            this.formData.content = "";
        }
    },
    created(){
        this.$store.state.contentMask = true

        axios({
            method: "post",
            url: `${this.$store.state.server}/main/getClassname.php`
        }).then(data => {
            this.types = data.data
            this.$store.state.contentMask = false
        })
    }
}
</script>
<style>
    textarea{
        height: 200px;
    }
</style>
