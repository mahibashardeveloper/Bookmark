<template>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container">
            <router-link class="navbar-brand" :to="{name: 'home'}">
                <img :src="'/images/logo.png'" class="img-fluid logo-res" alt="logo">
                Bookmark
            </router-link>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{name: 'home'}">
                            Home
                        </router-link>
                    </li>
                    <li class="nav-item" v-if="profile_data === null">
                        <router-link class="nav-link" :to="{name: 'login'}">
                            Login
                        </router-link>
                    </li>
                    <li class="nav-item dropdown" v-if="profile_data !== null">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Profile
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <router-link class="dropdown-item" :to="{name: 'dashboard'}">
                                    Dashboard
                                </router-link>
                            </li>
                            <li>
                                <router-link class="dropdown-item" :to="{name: 'bookmark'}">
                                    Bookmark
                                </router-link>
                            </li>
                            <li>
                                <a class="dropdown-item" href="javascript:void(0)" @click="logout">
                                    Logout
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

</template>

<script>

import ApiServices from "../../services/apiServices.js";
import ApiRoutes from "../../services/apiRoutes.js";

export default {

    data(){

        return{
            profile_data: null,
            isActiveHeaderController: false,
            core:window.core
        }

    },

    mounted() {

        if(this.core.UserInfo != null){
            this.getProfile();
        }

    },

    methods: {

        getProfile() {
            this.profileDataLoading = true;
            ApiServices.GET(ApiRoutes.profile_details, (res) => {
                this.profileDataLoading = false;
                if (res.status === 200) {
                    this.profile_data = res.data;
                }
            })
        },

        logout() {
            this.logoutLoading = true;
            ApiServices.GET(ApiRoutes.profile_logout, (res) => {
                this.logoutLoading = false;
                if (res.status === 200) {
                    window.location.reload();
                }
            })
        },

    }

}

</script>
