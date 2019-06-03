<template>
    <el-menu-item :index="item.index">
        <i v-if="item.icon" :class="item.icon"></i>
        <span>{{ item.text }}</span>
    </el-menu-item>
</template>
<script>
export default {
    props : {
        item : Object
    }
}
</script>
