<template>
    <div class="admin-full-content">

        <div class="profile-card col-md-5 border">
            <div class="profile-card-header">
                <a href="javascript:void(0)" class="edit-profile">
                    <i class="bi bi-pencil-square"></i>
                </a>
            </div>
            <div class="profile-card-body">
                <div class="d-flex justify-content-center">
                    <div class="profile-avatar mb-3">
                        <div v-if="profile_data.media === null">
                            <img :src="'/images/avatar.png'" class="img-fluid" alt="avatar">
                        </div>
                        <div v-if="profile_data.media !== null">
<!--                            <img :src="profile_data.media.full_file_path" alt="avatar">-->
                        </div>
                    </div>
                </div>
                <div class="mb-3 fw-bold">
                    Company Name
                </div>
                <div class="mb-3">
                    {{profile_data.company_name}}
                </div>
                <div class="mb-3 fw-bold">
                    Full Name
                </div>
                <div class="mb-3">
                    {{profile_data.full_name}}
                </div>
                <div class="mb-3 fw-bold">
                    Email
                </div>
                <div class="mb-3">
                    {{profile_data.email}}
                </div>
            </div>
        </div>

    </div>
</template>

<script>

import apiService from "../../services/apiServices.js";
import apiRoutes from "../../services/apiRoutes.js";

export default {

    data() {
        return {
            profile_data: '',
        }
    },

    mounted() {
        this.getProfile()
    },

    methods: {
        getProfile(){
            apiService.GET(apiRoutes.profile_details, (res) =>{
                this.profile_data = res.data;
            });
        },
    }

}

</script>
