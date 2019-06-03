<template>
    <p class="areaTitle">{{ title }}</p>    
</template>
<script>
export default {
    props : {
        title : String
    }
}
</script>
<style>
    .areaTitle{
        color: #8a9aa9;
        text-align: center;
        margin: 10px auto;
        font-size: 20px;
    }
</style>
