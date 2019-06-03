<template>
    <div>
        <div class="search">
            <el-input v-model="keyword" placeholder="请输入关键字"></el-input>
            <el-button type="primary" @click="update">搜索</el-button>
        </div>
        <div class="content">
            <template v-if="data.length">
                <Article v-for="item in data" 
                    :title="item.title" 
                    :content="item.content"
                    :type="item.type"
                    :date="item.date"
                    :id="item.id"
                    :key="item.id" 
                    @update="update"
                />
            </template>
            <template v-else>
                <h3>暂时没有文章</h3>
            </template>
        </div>
    </div>
</template>
<script>
import Article from "../../components/Article.vue"
import axios from 'axios'
import qs from "qs"
export default {
    components : {
        Article
    },
    data(){
        return {
            data : [],
            keyword : ""
        }
    },
    methods : {
        update(){
            this.$store.state.contentMask = true;
            var data = qs.stringify({
                keyword : this.keyword
            })
            var url = `${this.$store.state.server}/main/article/getArticleData.php`
            axios({
                methods: "post",
                url,
                data
            }).then(data => {
                this.$store.state.contentMask = false
                this.data = data.data
            })
        }
    },
    created(){
        this.update();
    }    
}
</script>
<style>
    .search{
        line-height: 0;
        padding-bottom: 10px;
    }
    .search > div{
        width: 200px;
        float: left;
        padding-right: 5px;
    }
    .search > button{
        display: block;
    }
</style>