<template>
    <div class="portrait">
    <img :src="url">
    </div>
</template>
<script>
export default {
    props : {
        url : String
    }
}
</script>
<style>
    .portrait{
        width: 50px;
        height: 50px;
        border-radius: 50px;
        overflow: hidden;
        display: inline-block;
    }
    .portrait > img{
        width: 100%;
        height: 100%;
    }
</style>
