<template>

    <header class="w-100 bg-light">
        <div class="header container">
            <router-link :to="{name: 'home'}" class="header-logo">
                <img :src="'/images/logo.png'" class="img-fluid logo-res" alt="logo">
                Bookmark
            </router-link>
            <a href="javascript:void(0)" class="btn-controller" @click="headerController">
                <i class="bi bi-justify-right"></i>
            </a>
            <div class="header-menu" :class="{active: isActiveHeaderController}">
                <a href="javascript:void(0)" class="close-btn-controller" @click="remove">
                    <i class="bi bi-x-lg"></i>
                </a>
                <router-link :to="{name: 'home'}" class="menu-link" @click="remove">Home</router-link>
                <router-link :to="{name: 'about'}" class="menu-link" @click="remove">About</router-link>
                <router-link :to="{name: 'contact'}" class="menu-link" @click="remove">Contact</router-link>
                <router-link :to="{name: 'blog'}" class="menu-link" @click="remove">Blog</router-link>
                <a href="/user" class="menu-link" @click="remove">Login</a>
            </div>
        </div>
    </header>

</template>

<script>

export default {

    data(){

        return{
            isActiveHeaderController: false,
        }

    },

    mounted() {



    },

    methods: {

        headerController(){
            this.isActiveHeaderController = !this.isActiveHeaderController;
        },

        remove(){
            this.isActiveHeaderController = false;
        }

    }

}

</script>
