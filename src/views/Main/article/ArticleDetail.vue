<template>
    <div>
        <h1>{{ data.title }}</h1>
        <div>
            {{ data.content }}
        </div>
        <AreaTitle title="评论" />
        <CommentAdd @submit="submit" />

        <div v-if="comments.length">
            <Commemt v-for="comment in comments" :data="comment" :key="comment.id"/>
        </div>
        <div v-else>
            <h3>暂时没有评论</h3>
        </div>
    </div>
</template>
<script>
import axios from "axios"
import qs from "qs"
import CommentAdd from "@/components/CommentAdd"
import Commemt from "@/components/CommentTemplate"
import AreaTitle from "@/components/AreaTitle"
export default {
    data(){
        return {
            data : {},
            comments : [],
           user_id : ""
        }
    },
    methods: {
        submit(content){
            var data = qs.stringify({
                article_id : this.data.id,
                text : content,
                user_id : this.user_id
            })
            axios({
                method: "post",
                 url: `${this.$store.state.server}/main/article/comments/addComments.php`,
                 data
            }).then((data) => {
                if(data.data)this.$message.success("添加成功,请等待审核!");
                else this.$message.error("添加失败,请重试!");
                this.updateComments(
                    qs.stringify({
                        id : this.$route.query.id
                    })
                );
            })
        },
        updateComments(data){
            axios({
                method: "post",
                url: `${this.$store.state.server}/main/article/comments/getComments.php`,
                data
            }).then(data => {
                this.comments = data.data
            })
        }
    },
    created(){
        if(!this.$route.query.id){
            this.$route.push("/")
        }else{
            var data = qs.stringify({
                    id : this.$route.query.id
            });
            axios({
                method: "post",
                url: `${this.$store.state.server}/main/article/getArticleDetail.php`,
                data
            }).then(data => {
                this.data = data.data,
                this.user_id = this.$store.state.userId
            }).then(() => {
                this.updateComments(data);
            })
        }
    },
    components : {
        CommentAdd,
        Commemt,
        AreaTitle
    }
}
</script>
<style scoped>
    div{
        line-height: 1.2em;
        text-align: left;
    }
    div > div{
        word-wrap: break-word; 
    }
    .hr{
        margin: 10px 0;
    }
</style>

