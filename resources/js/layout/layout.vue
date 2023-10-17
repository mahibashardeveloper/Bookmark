<template>

    <Header/>

    <router-view/>

    <Footer/>

</template>

<script>

    import Header from "./include/header.vue";
    import Footer from "./include/Footer.vue";

    export default {

        components:{
            Header,Footer
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
