<template>
    <div>
        <div class="comment">
            <Portrait :url="url" />
            <div class="content">
                <span class="username">{{ username }}</span>
                <p class="text">{{ data.text }}</p>
                <span class="date">{{ data.date}}</span>
            </div>
        </div>
        <hr color="#ccc">
    </div>
</template>
<script>
/* eslint-disable */
import Portrait from "@/components/PortraitTemplate"
import qs from "qs"
export default {
    data(){
        return {
            username : "",
            url : ""
        }
    },
    components : {
        Portrait
    },
    props: {
        data : Object
    },
    created(){
        const _this = this;
        const data = qs.stringify({
             userId : this.data.user_id
        })
        this.$store.state.getUserName(data,function(name){
		    _this.username = name;
		    _this.$store.state.getUserImg(data,function(img){
                _this.url = img
            })
        })
    }
}
</script>
<style scoped>
    .comment{
        display: flex;
        margin: 10px 0;
    }
    .content{
        flex-grow: 1;
    }
    .date{
        float: right;
        color: #71777c;
    }
</style>

