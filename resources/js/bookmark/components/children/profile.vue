<template>
    <div class="admin-full-content">

        <div class="profile-card col-md-5 border">
            <div class="profile-card-header">
                <a href="javascript:void(0)" class="edit-profile" @click="openEditProfileModal">
                    <i class="bi bi-pencil-square"></i>
                </a>
                <a href="javascript:void(0)" class="edit-profile ms-3" @click="openEditPasswordModal">
                    <i class="bi bi-shield"></i>
                </a>
            </div>
            <div class="profile-card-body">
                <div class="d-flex justify-content-center">
                    <div class="mb-3">
                        <img class="img-fluid profile-avatar" v-if="!profile_data.avatar" :src="'https://ui-avatars.com/api/?name='+profile_data.first_name" alt="profile-dummy">
                        <img class="img-fluid profile-avatar" v-else :src="profile_data.media && profile_data.media.full_file_path" alt="profile">
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

    <!-- edit profile modal start -->
    <div class="modal fade" id="editProfileModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-3">
                <div class="modal-header border-0">
                    <h1 class="modal-title fw-bold fs-5" id="exampleModalLabel">
                        Edit Profile
                    </h1>
                    <button type="button" class="btn-close" @click="closeEditProfileModal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <div class="d-flex justify-content-center align-items-center">
                            <label for="file-upload">
                                <input type="file" class="d-none" id="file-upload" @change="attachFile($event)">
                                <div v-if="editParam.avatar === null" class="modal-avatar cursor-pointer">
                                    <div class="text-center">
                                        <div class="mb-2">
                                            <i class="bi bi-card-image"></i>
                                        </div>
                                        Upload Image
                                    </div>
                                </div>
                                <img class="img-fluid modal-avatar" v-if="editParam.avatar !== null" :src="editParam.avatarFilePath" alt="profile">
                            </label>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="company_name" class="form-label">
                            Company Name
                        </label>
                        <input type="text" id="company_name" name="company_name" class="form-control" v-model="editParam.company_name">
                        <div class="error-text" v-if="error != null && error.company_name !== undefined" v-text="error.company_name[0]"></div>
                    </div>
                    <div class="mb-3">
                        <label for="first_name" class="form-label">
                            Full Name
                        </label>
                        <input type="text" id="first_name" name="full_name" class="form-control" v-model="editParam.full_name">
                        <div class="error-text" v-if="error != null && error.full_name !== undefined" v-text="error.full_name[0]"></div>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">
                            Email
                        </label>
                        <input type="email" id="email" name="email" class="form-control" v-model="editParam.email">
                        <div class="error-text" v-if="error != null && error.email !== undefined" v-text="error.email[0]"></div>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-dark" @click="closeEditProfileModal"> Close </button>
                    <button type="button" class="btn btn-secondary" @click="updateProfile">
                        <span v-if="updateProfileLoading === false">Edit</span>
                        <span v-if="updateProfileLoading === true">Loading...</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- edit profile modal end -->

    <!-- change password modal start -->
    <div class="modal fade" id="editPasswordModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content p-3">
                <div class="modal-header border-0">
                    <h1 class="modal-title fw-bold fs-5" id="exampleModalLabel">
                        Edit Password
                    </h1>
                    <button type="button" class="btn-close" @click="closeEditPasswordModal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="password" class="form-label">
                            New Password
                        </label>
                        <input type="password" id="password" name="password" class="form-control" v-model="passwordParam.password">
                        <div class="error-text" v-if="error != null && error.password !== undefined" v-text="error.password[0]"></div>
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">
                            Confirm Password
                        </label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" v-model="passwordParam.password_confirmation">
                        <div class="error-text" v-if="error != null && error.password_confirmation !== undefined" v-text="error.password_confirmation[0]"></div>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" @click="closeEditPasswordModal">
                        Close
                    </button>
                    <button type="submit" class="btn btn-dark" @click="updatePassword">
                        <span v-if="updateProfileLoading === false"> Edit </span>
                        <span v-if="updateProfileLoading === true"> Loading... </span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- change password modal end -->

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
            editParam: { company_name: '', full_name: '', email: '', avatar: '' },
            passwordParam: { password: '', password_confirmation: '' },
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
            apiService.UPLOAD(apiRoutes.media, formData, (res) => {
                event.target.value = '';
                if (res.status === 200) {
                    this.editParam.avatarFilePath = res.data.full_file_path
                    this.editParam.avatar = res.data.id
                }
            })
        },

        openEditProfileModal() {
            const modal = new bootstrap.Modal("#editProfileModal", {keyboard: false, backdrop: 'static'});
            modal.show();
            this.edit = true;
            this.editParam = JSON.parse(JSON.stringify(this.profile_data));
            this.editParam.avatarFilePath = this.editParam.media != null ? this.editParam.media.full_file_path : null
        },

        closeEditProfileModal() {
            this.edit = false;
            this.error = null;
            let myModalEl = document.getElementById('editProfileModal');
            let modal = bootstrap.Modal.getInstance(myModalEl);
            modal.hide();
        },

        openEditPasswordModal() {
            const modal = new bootstrap.Modal("#editPasswordModal", {keyboard: false, backdrop: 'static'});
            modal.show();
            this.edit = true;
            this.editParam = JSON.parse(JSON.stringify(this.profile_data));
        },

        closeEditPasswordModal() {
            this.edit = false;
            this.passwordParam = {password: "", password_confirmation: ""};
            this.error = null;
            let myModalEl = document.getElementById('editPasswordModal');
            let modal = bootstrap.Modal.getInstance(myModalEl);
            modal.hide();
        },

        getProfile() {
            this.profileDataLoading = true;
            apiService.GET(apiRoutes.profile_details, (res) => {
                this.profileDataLoading = false;
                if (res.status === 200) {
                    this.profile_data = res.data;
                }
            })
        },

        updateProfile() {
            this.updateProfileLoading = true;
            this.error = null;
            apiService.POST(apiRoutes.profile_update, this.editParam, (res) => {
                this.updateProfileLoading = false;
                if (res.status === 200) {
                    this.getProfile();
                    this.edit = false;
                    this.$toast.success('Your Profile has been updated successfully.', { position: "top-right" });
                    this.closeEditProfileModal();
                    window.location.reload();
                } else {
                    this.error = res.errors;
                }
            })
        },

        updatePassword() {
            this.updateProfileLoading = true;
            this.error = null;
            apiService.POST(apiRoutes.profile_password, this.passwordParam, (res) => {
                this.updateProfileLoading = false;
                if (res.status === 200) {
                    this.getProfile();
                    this.edit = false;
                    this.$toast.success('Your password has been updated successfully.', { position: "top-right" });
                    this.closeEditPasswordModal();
                } else {
                    this.error = res.errors;
                }
            })
        },
    }

}

</script>
