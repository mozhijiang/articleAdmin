<template>
    <div class="template">
        <div  @click="detail = true">     
            <h3 class="title"> {{ title }} <span class='type'>{{ type }}</span></h3>
            <div class="content"> {{ content }} </div>
            <div class="footer"><p class="date">{{ date }}</p></div>   
        </div>
        <template>
            <el-dialog
                :title="title"
                :visible.sync="detail"
                width="80%">
                <span class="dialog-content content">{{ content }}</span>
                <span slot="footer" class="dialog-footer">
                    <el-button type="primary" @click="next">前往查看</el-button>
                    <el-button type="danger" @click="del">删除</el-button>
                </span>
            </el-dialog>
        </template>
    </div>
</template>
<script>
import axios from "axios"
import qs from "qs"
export default {
    props : {
        title : String,
        content : String,
        type : String,
        date : String,
        id : String
    },
    data(){
        return{
            detail : false
        }
    },
    methods : {
        next(){
            this.$router.push({
                path : "article-detail",
                query : {
                    id : this.id
                }
            })
        },
        del(){
            if(confirm("删除后将无法恢复,确认删除吗?")){
                var data = qs.stringify({
                    id : this.id
                })
                var url = `${this.$store.state.server}/main/article/delArticle.php`
                axios({
                    method : "post",
                    url,
                    data
                }).then(() => {
                    this.$emit("update")
                })
            }
        }
    }
}
</script>
<style scoped>
    .template{
        line-height: 1em;
        border-top: 5px solid #ddd;
        text-align: left;
    }
    .template:hover{
        cursor: pointer;
    }
    .title{
        padding: 5px;
    }
    .content{
        max-height: 3em;
        padding: 0 5px;
        word-break: break-all;
        text-overflow: ellipsis;
        overflow: hidden;
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
    }
    .dialog-content{
        max-height: 5em;
        -webkit-line-clamp: 5;
        font-size: 16px;
    }
    .type , .date{
        float: right;
        color: #71777c;
        font-size: 16px;
    }
    .footer{
        height: 1em;
    }
</style>
