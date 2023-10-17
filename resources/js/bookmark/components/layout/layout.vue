<template>

    <div class="customize" :class="{active: isActiveCustomizeTab}">
        <div class="gear-top">
            <a href="javascript:void(0)" class="gear-controller" @click="customizeTab">
                <i class="bi bi-gear-fill"></i>
            </a>
        </div>
        <div class="fw-bold pt-2 pb-2">Customize Color</div>
        <div class="customize-resource">
            <span data-color="#DC354533" style="background-color: #DC354533;" class="btn-circle" @click="remove"></span>
            <span data-color="#0D6EFD33" style="background-color: #0D6EFD33;" class="btn-circle" @click="remove"></span>
            <span data-color="#6C757D33" style="background-color: #6C757D33;" class="btn-circle" @click="remove"></span>
            <span data-color="#19875433" style="background-color: #19875433;" class="btn-circle" @click="remove"></span>
            <span data-color="#0DCAF033" style="background-color: #0DCAF033;" class="btn-circle" @click="remove"></span>
        </div>
    </div>

    <div class="user-wrapper">
        <div class="user-sidebar" :class="{active: isUserSidebarActive}">
            <div class="user-sidebar-header">
                <router-link :to="{name: 'dashboard'}" class="user-title" @click="remove">
                    Bookmark
                </router-link>
                <a href="javascript:void(0)" class="user-close" @click="remove">
                    <i class="bi bi-x-lg"></i>
                </a>
            </div>
            <div class="user-sidebar-body">
                <router-link :to="{name: 'dashboard'}" class="user-sidebar-body-link">
                    Dashboard
                </router-link>
                <router-link :to="{name: 'bookmark'}" class="user-sidebar-body-link" @click="remove">
                    Bookmark
                </router-link>
            </div>
            <a href="javascript:void(0)" class="user-sidebar-footer" @click="logout">
                <span v-if="logoutLoading === false">
                    Logout
                </span>
                <span v-if="logoutLoading === true">
                    Loading...
                </span>
            </a>
        </div>
        <div class="user-content">
            <div class="user-content-header">
                <a href="javascript:void(0)" class="user-content-header-controller" @click="userSideBarController">
                    <i class="bi bi-justify-left"></i>
                </a>
                <div class="user-info">
                    <a href="javascript:void(0)" class="text-decoration-none text-white" @click="userDropdownController">
                        {{profile_data.full_name}}
                    </a>
                    <div class="user-dropdown-menu" :class="{active: isUserDropdownActive}">
                        <router-link :to="{name: 'profile'}" class="user-menu-link">
                            Profile
                        </router-link>
                        <a href="javascript:void(0)" class="user-menu-link" @click="logout">
                            Logout
                        </a>
                    </div>
                </div>
            </div>
            <div class="user-content-body">
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
                isUserSidebarActive: false,
                profile_data: '',
                logoutLoading: false,
                isActiveCustomizeTab: false,
                isUserDropdownActive: false,
            }
        },

        mounted() {

            function setThemeColor(color) {
                document.querySelector(':root').style.setProperty('--main-color', color);
            }

            function handleButtonClick(event) {
                let dataColor = event.target.getAttribute('data-color');
                setThemeColor(dataColor);
                localStorage.setItem('selectedColor', dataColor);
            }
            let themeButtons = document.querySelectorAll('.btn-circle');
            themeButtons.forEach(color => {
                color.addEventListener('click', handleButtonClick);
            });
            const storedColor = localStorage.getItem('selectedColor');
            if (storedColor) {
                setThemeColor(storedColor);
            }

            this.getProfile();
        },

        methods: {
            customizeTab(){
                this.isActiveCustomizeTab = !this.isActiveCustomizeTab;
            },

            userSideBarController(){
                this.isUserSidebarActive = !this.isUserSidebarActive;
            },

            userDropdownController(){
                this.isUserDropdownActive = !this.isUserDropdownActive;
            },

            remove(){
                this.isUserSidebarActive = false;
                this.isActiveCustomizeTab = false;
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
