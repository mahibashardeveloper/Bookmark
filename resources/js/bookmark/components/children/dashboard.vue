<template>

    

</template>

<script>

    import apiService from "../../services/apiServices.js";

    import apiRoutes from "../../services/apiRoutes.js";

    export default {

        data() {
            return {
                profile_data: '',
                profileDataLoading: false,
                updateProfileLoading: false,
                error: null,
                edit: false,
                editParam: {
                    full_name: '',
                    email: '',
                },
                passwordParam: {
                    password: '',
                    password_confirmation: ''
                },
            }
        },

        mounted() {
            this.getProfile();
        },

        methods: {

            getProfile() {
                this.profileDataLoading = true;
                apiService.GET(apiRoutes.profile_details, (res) => {
                    this.profileDataLoading = false;
                    if (res.status === 200) {
                        this.profile_data = res.data;
                    }
                })
            },

        }

    }

</script>
