<template>
    <router-view/>
</template>
<script>
import { defineComponent } from 'vue'
export default defineComponent({
    name:'App',
    watch: {
        $route: {
            immediate: true,
            handler(to, from) {
                document.title = to.meta.title || 'ProActive';
            }
        },
    }
})
</script>
<style lang="scss">
@import "../../scss/admin/style";
</style>
