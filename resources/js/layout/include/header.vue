<template>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container">

            <!-- home route start -->
            <router-link class="navbar-brand" :to="{name: 'home'}">
                <img :src="'/images/logo.png'" class="img-fluid me-2" alt="logo">
                Bookmark
            </router-link>
            <!-- home route end -->

            <!-- header collapse start -->
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- header collapse end -->

            <!-- collapse nav-item start -->
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">

                    <!-- home route start -->
                    <li class="nav-item">
                        <router-link class="nav-link" :to="{name: 'home'}" :active-class="'active'">
                            Home
                        </router-link>
                    </li>
                    <!-- home route end -->

                    <!-- login route start -->
                    <li class="nav-item" v-if="profile_data === null">
                        <router-link class="nav-link" :to="{name: 'login'}" :active-class="'active'">
                            Login
                        </router-link>
                    </li>
                    <!-- login route end -->

                    <!-- login route start -->
                    <li class="nav-item" v-if="profile_data !== null">
                        <router-link class="nav-link" :to="{name: 'dashboard'}" :active-class="'active'">
                            Dashboard
                        </router-link>
                    </li>
                    <!-- login route end -->

                    <!-- login route start -->
                    <li class="nav-item" v-if="profile_data !== null">
                        <router-link class="nav-link" :to="{name: 'bookmark'}" :active-class="'active'">
                            Bookmark
                        </router-link>
                    </li>
                    <!-- login route end -->

                    <li class="nav-item dropdown" v-if="profile_data !== null">

                        <!-- profile dropdown-menu start -->
                        <a class="nav-link dropdown-toggle" href="javascript:void(0)" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Profile
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">

                            <!-- logout action start -->
                            <li>
                                <a class="dropdown-item" href="javascript:void(0)" @click="logout">
                                    Logout
                                </a>
                            </li>
                            <!-- logout action end -->

                        </ul>
                        <!-- profile dropdown-menu end -->

                    </li>

                </ul>
            </div>
            <!-- collapse nav-item end -->

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
