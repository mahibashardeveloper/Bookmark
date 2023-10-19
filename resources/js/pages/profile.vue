<template>

    <div class="container-fluid profile">
        <div class="row">
            <div class="col-md-4 h-100">

                <div class="shadow bg-white h-100 rounded-4">

                    <!-- profile card start -->
                    <div class="profile-card">

                        <!-- profile card body start -->
                        <div class="profile-card-body">
                            <div class="d-flex justify-content-center">
                                <div class="mb-3">
                                    <img class="img-fluid profile-avatar" v-if="!profile_data.avatar" :src="'https://ui-avatars.com/api/?name='+profile_data.full_name" alt="profile-dummy">
                                    <img class="img-fluid profile-avatar" v-else :src="profile_data.media && profile_data.media.full_file_path" alt="profile">
                                </div>
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
                        <!-- profile card body end -->

                    </div>
                    <!-- profile card end -->

                </div>

            </div>
            <div class="col-md-8 h-100">

                <div class="d-flex align-items-center bg-white w-100 shadow p-3 mb-3 rounded-4">

                    <a href="javascript:void(0)" class="btn btn-theme" @click="openEditPasswordModal">
                        Change Password
                    </a>

                    <a href="javascript:void(0)" class="btn btn-theme ms-3" @click="openEditProfileModal">
                        Edit Profile
                    </a>

                </div>

                <div class="profile-card w-100 bg-white rounded-4">

                    <div v-if="tab === 2">

                        <div class="h4 fw-bold mb-4">Edit Profile</div>

                        <form @submit.prevent="updateProfile">

                            <!-- upload image start -->
                            <div class="mb-3 profile-card-body d-flex justify-content-center">
                                <img class="img-fluid profile-avatar overflow-hidden" v-if="editParam.avatar !== null" :src="editParam.avatarFilePath" alt="profile">
                            </div>
                            <div class="text-center">
                                <label for="file-upload" class="btn btn-outline-theme mb-3">
                                     <i class="bi bi-repeat"></i> Change Image
                                    <input type="file" class="d-none" id="file-upload" @change="attachFile($event)">
                                </label>
                            </div>
                            <!-- upload image end -->

                            <!-- full name start -->
                            <div class="mb-3">
                                <label for="first_name" class="form-label">
                                    Full Name
                                </label>
                                <input type="text" id="first_name" name="full_name" class="form-control" v-model="editParam.full_name">
                                <div class="error-text" v-if="error != null && error.full_name !== undefined" v-text="error.full_name[0]"></div>
                            </div>
                            <!-- full name end -->

                            <!-- email start -->
                            <div class="mb-3">
                                <label for="email" class="form-label">
                                    Email
                                </label>
                                <input type="email" id="email" name="email" class="form-control" v-model="editParam.email">
                                <div class="error-text" v-if="error != null && error.email !== undefined" v-text="error.email[0]"></div>
                            </div>
                            <!-- email end -->

                            <!-- buttons start -->
                            <button type="submit" class="btn btn-dark px-5 btn-size-theme">
                                <span v-if="updateProfileLoading === false"> Update </span>
                                <span v-if="updateProfileLoading === true"> Loading... </span>
                            </button>
                            <!-- buttons end -->

                        </form>

                    </div>

                    <div v-if="tab === 1">

                        <div class="h4 fw-bold mb-4">Change Password</div>

                        <form @submit.prevent="updatePassword">

                            <!-- new password start -->
                            <div class="mb-3">
                                <label for="password" class="form-label">
                                    New Password
                                </label>
                                <input type="password" id="password" name="password" class="form-control shadow-none" v-model="passwordParam.password">
                                <div class="error-text" v-if="error != null && error.password !== undefined" v-text="error.password[0]"></div>
                            </div>
                            <!-- new password end -->

                            <!-- confirm password start -->
                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">
                                    Confirm Password
                                </label>
                                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control shadow-none" v-model="passwordParam.password_confirmation">
                                <div class="error-text" v-if="error != null && error.password_confirmation !== undefined" v-text="error.password_confirmation[0]"></div>
                            </div>
                            <!-- confirm password end -->

                            <div class="mb-3">

                                <!-- buttons start -->
                                <button type="submit" class="btn btn-dark px-5 btn-size-theme">
                                    <span v-if="updateProfileLoading === false"> Update </span>
                                    <span v-if="updateProfileLoading === true"> Loading... </span>
                                </button>
                                <!-- buttons end -->

                            </div>

                        </form>

                    </div>

                </div>

            </div>
        </div>
    </div>

</template>

<script>

import apiServices from "../services/apiServices.js";
import apiRoutes from "../services/apiRoutes.js";

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
                avatar: ''
            },
            passwordParam: {
                password: '',
                password_confirmation: ''
            },
            tab: 1,
        }
    },

    mounted() {
        this.getProfile()
    },

    methods: {
        attachFile(event) {
            let file = event.target.files[0];
            let formData = new FormData();
            formData.append("file", file)
            formData.append("media_type", 1);
            apiServices.UPLOAD(apiRoutes.media, formData, (res) => {
                event.target.value = '';
                if (res.status === 200) {
                    this.editParam.avatarFilePath = res.data.full_file_path
                    this.editParam.avatar = res.data.id
                }
            })
        },

        openEditProfileModal() {
            this.tab = 2;
            this.edit = true;
            this.editParam = JSON.parse(JSON.stringify(this.profile_data));
            this.editParam.avatarFilePath = this.editParam.media != null ? this.editParam.media.full_file_path : null
        },

        openEditPasswordModal() {
            this.tab = 1;
            this.edit = true;
            this.editParam = JSON.parse(JSON.stringify(this.profile_data));
        },

        getProfile() {
            this.profileDataLoading = true;
            apiServices.GET(apiRoutes.profile_details, (res) => {
                this.profileDataLoading = false;
                if (res.status === 200) {
                    this.profile_data = res.data;
                }
            })
        },

        updateProfile() {
            this.updateProfileLoading = true;
            this.error = null;
            apiServices.POST(apiRoutes.profile_update, this.editParam, (res) => {
                this.updateProfileLoading = false;
                if (res.status === 200) {
                    this.getProfile();
                    this.edit = false;
                    this.$toast.success('Your Profile has been updated successfully.', { position: "top-right" });
                    window.location.reload();
                } else {
                    this.error = res.errors;
                }
            })
        },

        updatePassword() {
            this.updateProfileLoading = true;
            this.error = null;
            apiServices.POST(apiRoutes.profile_password, this.passwordParam, (res) => {
                this.updateProfileLoading = false;
                if (res.status === 200) {
                    this.getProfile();
                    this.edit = false;
                    this.$toast.success('Your password has been updated successfully.', { position: "top-right" });
                    this.passwordParam = {password: '', password_confirmation: ''};
                } else {
                    this.error = res.errors;
                }
            })
        },
    }

}

</script>
