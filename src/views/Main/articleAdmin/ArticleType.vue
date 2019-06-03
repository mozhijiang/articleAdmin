<template>
    <div>
        <div id="article-type-header">
            <el-form :inline="true" class="demo-form-inline">
                <el-form-item>
                    <el-input placeholder="类名" v-model="className"></el-input>
                </el-form-item>
                <el-form-item>
                    <el-button type="primary" @click="handleAdd">新增</el-button>
                </el-form-item>
            </el-form>
        </div>
        <div id="article-type-body">
            <el-table
                :data="pageData"
                style="width: 100%;margin-bottom: 20px;"
                row-key="id"
                >
                <el-table-column
                prop="name"
                label="类名"
                width="100">
                </el-table-column>
                <el-table-column
                prop="count"
                label="文章数"
                width="100">
                </el-table-column>
                <el-table-column
                prop="browse"
                label="浏览数"
                width="100">
                </el-table-column>
                <el-table-column 
                label="操作">
                <template slot-scope="scope">
                    <el-button
                    size="mini"
                    type="danger"
                    @click="handleDelete(scope.row.id)">删除</el-button>
                </template>
                </el-table-column>
            </el-table>
        </div>
        <div id="article-type-footer">
            <el-pagination
                background
                layout="prev, pager, next"
                :total="data.length"
                :page-size="pageSize"
                @current-change="currentChange">
            </el-pagination>
        </div>
    </div>
</template>
<style scoped>
    .el-form-item{
        margin-bottom: 10px;
        line-height: 0;
        float: left;
    }
    #article-type-header{
        height: 50px;
    }
    #article-type-header,#article-type-body,#article-type-footer{
        line-height: 0;
    }
</style>
<script>
import axios from "axios"
import qs from "qs"
export default {
    data(){
        return {
            className : "",
            data : [],
            pageSize : 6,
            currentPage : 1,
            pageData : []
        }
    },
    methods: {
        handleAdd(){
            if(this.className === ""){
                this.$message.error('类名不能为空!');
            }else{
                this.$store.state.contentMask = true;
                var data = qs.stringify({
                    className : this.className
                })
                axios({
                    method : "post",
                    url : `${this.$store.state.server}/main/articleAdmin/addClass.php`,
                    data
                }).then(data => {
                    this.className = "";
                    this.$store.state.contentMask = false;
                    if(data.data){
                        this.updata(() => {
                            this.$message.success("添加成功");
                        })
                    }else{
                        this.$message.error("添加失败,请重试!");
                    }
                })
            }
        },
        handleDelete(id){
            this.$store.state.contentMask = true
            const data = qs.stringify({
                id : id
            })
            axios({
                method : "post",
                url : `${this.$store.state.server}/main/articleAdmin/delClass.php`,
                data
            }).then(() => {
                this.$message.success("删除成功!");
                this.$store.state.contentMask = false
                this.updata();
                
            })
        },
        currentChange(index){
            this.currentPage = index
            this.updataPageData();
        },
        updataPageData(){
            var _cp = this.currentPage;
            var _ps = this.pageSize;
            this.pageData = this.data.slice((_cp - 1) * _ps , _cp * _ps);
            if(this.pageData.length === 0)this.currentChange(--this.currentPage);
        },
        updata(callback){
            axios({
                method : "post",
                url : `${this.$store.state.server}/main/articleAdmin/getClassData.php`
            }).then(data => {
                this.data = data.data;
                this.updataPageData();
                if(callback)callback();
            })
        }
    },
    created: function(){
        this.$store.state.contentMask = true;
        this.updata(() => {
            this.$store.state.contentMask = false;
        });
    }
}
</script>