<template>

    <Header/>

    <div class="portal-background" style="background-image: url('/images/inside-background.webp')">
        <div class="container py-5">
            <router-view/>
        </div>
    </div>

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
                UserInfo: window.core.UserInfo
            }
        },

        mounted() {

        },
        created() {
            if(this.UserInfo == null){
                this.$router.push({name: 'login'});
            }
        },

        methods: {

        }

    }

</script>
