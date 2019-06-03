<template>
    <div>
         <div class="search">
            <el-input v-model="keyword" placeholder="评论内容"></el-input>
            <el-select v-model="select">
                <el-option label="未审核" value="0"></el-option>
                <el-option label="已审核" value="1"></el-option>
                <el-option label="全部" value=""></el-option>
            </el-select>
            <el-button type="primary" @click="search">搜索</el-button>
        </div>
        <hr color="#ddd">
        <div>
            <template v-if="data.length">
                <el-table
                    :data="data"
                    style="width: 95%; margin:auto">
                    <el-table-column
                    label="日期"
                    width="150px"
                    >
                    <template slot-scope="scope">
                        <span style="margin-left: 10px">{{ scope.row.date }}</span>
                    </template>
                    </el-table-column>
                    <el-table-column
                    label="用户名"
                    >
                    <template slot-scope="scope">
                        <span style="margin-left: 10px">{{ scope.row.user_name }}</span>
                    </template>
                    </el-table-column>
                    <el-table-column
                    label="文章标题"
                    >
                    <template slot-scope="scope">
                        <span style="margin-left: 10px">{{ scope.row.article_title }}</span>
                    </template>
                    </el-table-column>
                    <el-table-column
                    label="评论内容"
                    >
                    <template slot-scope="scope">
                        <span style="margin-left: 10px">{{ scope.row.text }}</span>
                    </template>
                    </el-table-column>
                    <el-table-column
                    label="状态"
                    >
                    <template slot-scope="scope">
                        <span style="margin-left: 10px">
                            <template v-if="scope.row.state">
                                已审核
                            </template>
                            <template v-else>
                                未审核
                            </template>
                        </span>
                    </template>
                    </el-table-column>
                    <el-table-column 
                    label="操作"
                    width="180">
                    <template slot-scope="scope">
                            <el-button
                            size="mini"
                            type="primary"
                            :disabled="scope.row.state"
                            @click="pass(scope.row.id)">通过审核</el-button>
                            <el-button
                            size="mini"
                            type="danger"
                            @click="del(scope.row.id)">删除</el-button>
                    </template>
                    </el-table-column>
                </el-table>
            </template>
            <template v-else>
                <h3>暂时没有评论</h3>
            </template>
        </div>
    </div>
</template>
<style>
    .search{
        display: flex;
    }
    hr{
        height: 5px;
    }
    .handle{
        display: flex;
    }
    .handle > * {
        flex-grow: 1;
    }
</style>
<script>
import axios from "axios"
import qs from "qs"

export default {
    data(){
        return{
            keyword : "",
            select : "",
            data : []
        }
    },
    methods: {
        search(){
            this.$store.state.contentMask = true
            const data = qs.stringify({
                keyword : this.keyword,
                select : this.select
            })
            const url = `${this.$store.state.server}/main/articleAdmin/getComments.php`
            axios({
                method: "post",
                url,
                data
            }).then(data => {
                this.data = data.data
                this.$store.state.contentMask = false
            })            
        },
        pass(id){
            const data = qs.stringify({
                id : id
            })
            const url = `${this.$store.state.server}/main/articleAdmin/passComment.php`
            this.handle(data,url,() => {
                this.$message.success("操作成功");
                this.search();
            })
        },
        del(id){
            const data = qs.stringify({
                id : id
            })
            const url = `${this.$store.state.server}/main/articleAdmin/delComment.php`
            this.handle(data,url,() => {
                this.$message.success("操作成功");
                this.search();
            })
        },
        handle(data,url,callback){
            axios({
                method: "post",
                url,
                data
            }).then(data => {
                callback(data)
            }) 
        }
    },
    created(){
        this.search();
    }
}
</script>
