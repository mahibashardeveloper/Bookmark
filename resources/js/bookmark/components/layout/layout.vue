<template>

    <div class="admin-wrapper">
        <div class="admin-sidebar" :class="{active: isAdminSidebarActive}">
            <div class="admin-sidebar-header">
                <router-link :to="{name: 'dashboard'}" class="admin-title" @click="remove">
                    Bookmark
                </router-link>
                <a href="javascript:void(0)" class="admin-close" @click="remove">
                    <i class="bi bi-x-lg"></i>
                </a>
            </div>
            <div class="admin-sidebar-body">
                <router-link :to="{name: 'profile'}" class="admin-sidebar-body-link" @click="remove">
                    <span class="text-capitalize d-flex align-items-center">
                        <span class="me-2">Profile</span> <span class="badge bg-dark">{{profile_data.full_name}}</span>
                    </span>
                </router-link>
                <router-link :to="{name: 'dashboard'}" class="admin-sidebar-body-link">
                    Dashboard
                </router-link>
                <router-link :to="{name: 'bookmark'}" class="admin-sidebar-body-link" @click="remove">
                    Bookmark
                </router-link>
            </div>
            <a href="javascript:void(0)" class="admin-sidebar-footer" @click="logout">
                <span v-if="logoutLoading === false">
                    Logout
                </span>
                <span v-if="logoutLoading === true">
                    Loading...
                </span>
            </a>
        </div>
        <div class="admin-content">
            <div class="admin-content-header">
                <a href="javascript:void(0)" class="admin-content-header-controller" @click="adminSideBarController">
                    <i class="bi bi-justify-left"></i>
                </a>
            </div>
            <div class="admin-content-body">
                <router-view/>
            </div>
        </div>
    </div>
</template>

<script>

    import apiRoutes from "../../services/apiRoutes.js";
    import apiService from "../../services/apiServices.js";

    export default {

        data() {
            return {
                isAdminSidebarActive: false,
                profile_data: '',
                logoutLoading: false,
            }
        },

        mounted() {
            this.getProfile();
        },

        methods: {
            adminSideBarController(){
                this.isAdminSidebarActive = !this.isAdminSidebarActive;
            },

            remove(){
                this.isAdminSidebarActive = false;
            },

            getProfile(){
                apiService.GET(apiRoutes.profile_details, (res) =>{
                    this.profile_data = res.data;
                });
            },

            logout(){
                apiService.GET(apiRoutes.profile_logout, (res) =>{
                    if(res.status === 200){
                        window.location.reload()
                    }
                });
            }
        }

    }

</script>
