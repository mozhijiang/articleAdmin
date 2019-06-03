<template>
    <form>
        <div class="commentTemplate">
            <Portrait :url="userImg" style="float:left;"/>
            <div class="input" style="margin-left:5px">
                <el-input class="input"
                    placeholder="30字以内"
                    v-model="content"
                />
            </div>
        </div>
        <el-button 
            class="submit" 
            type="primary"
            @click="submit"
        >添加评论</el-button>
    </form>
</template>
<script>
import Portrait from "@/components/PortraitTemplate"
import qs from "qs"
export default {
    data(){
        return {
            content : "",
            userImg : ""
        }
    },
    methods: {
        submit(){
            if(this.content === ""){
                this.$message.error("内容不能为空!");
                return;
            }
            this.$emit("submit",this.content)
            this.content = ""
        }
    },
    components: {
        Portrait
    },
    created(){  
        const data = qs.stringify({
            userId : this.$store.state.userId
            
        })
        this.$store.state.getUserImg(data,img => {
            this.userImg = img
        })
    }
}
</script>
<style scoped>
    form > *{
        padding: 10px 0;
    }
    .submit{
        width: 100%;
    }
    .commentTemplate{
        display: flex;
        height: 50px;
        padding: 0;
        margin: 5px 0;
    }
    .input{
        flex-grow: 1;
    }
    .el-input{
        padding: 5px 0;
    }
</style>