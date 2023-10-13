<template>

    <Header/>

    <router-view/>

    <Footer/>

</template>

<script>

    import Header from "./include/header.vue";

    export default {

        components:{
            Header
        },

        data() {
            return {

            }
        },

        mounted() {

        },

        methods: {

        }

    }

</script>
