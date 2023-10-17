<template>

    <div class="authentication">
        <div class="container">
            <div class="row justify-content-around align-items-center vh-100">

                <!-- authentication background image start -->
                <div class="col-12 col-md-6 d-none d-lg-block">
                    <img :src="'/images/authentication.png'" class="img-fluid rounded-5" alt="authentication background image">
                </div>
                <!-- authentication background image end -->

                <!-- authentication form start -->
                <div class="col-12 col-md-9 col-lg-6">

                    <!-- registration form start -->
                    <form @submit.prevent="register" class="px-5 py-4 border shadow rounded-5 bg-white">
                        <div class="row">

                            <!-- Logo and title start -->
                            <div class="form-group col-md-12 text-center">
                                <div class="h1 mb-3 fw-bold">Bookmark</div>
                                <div class="h3 fw-bold mb-3">Create a new account</div>
                            </div>
                            <!-- Logo and title end -->

                            <!-- full name start -->
                            <div class="form-group col-md-12">
                                <label for="full_name" class="form-label">Full Name</label>
                                <input id="full_name" type="text" name="full_name" class="form-control" autocomplete="off" v-model="registerParam.full_name">
                                <div class="error-text" v-if="error != null && error.full_name !== undefined" v-text="error.full_name[0]"></div>
                            </div>
                            <!-- full name end -->

                            <!-- email start -->
                            <div class="form-group col-md-12">
                                <label for="email" class="form-label">Email</label>
                                <input id="email" type="email" name="email" class="form-control" autocomplete="off" v-model="registerParam.email">
                                <div class="error-text" v-if="error != null && error.email !== undefined" v-text="error.email[0]"></div>
                            </div>
                            <!-- email end -->

                            <!-- new password start -->
                            <div class="form-group col-md-6">
                                <label for="password" class="form-label">Password</label>
                                <input id="password" type="password" name="password" class="form-control" autocomplete="off" v-model="registerParam.password">
                                <div class="error-text" v-if="error != null && error.password !== undefined" v-text="error.password[0]"></div>
                            </div>
                            <!-- new password end -->

                            <!-- repeat mew password start -->
                            <div class="form-group col-md-6">
                                <label for="confirm_password" class="form-label">Confirm Password</label>
                                <input id="confirm_password" type="password" name="confirm_password" class="form-control" autocomplete="off" v-model="registerParam.password_confirmation">
                                <div class="error-text" v-if="error != null && error.password_confirmation !== undefined" v-text="error.password_confirmation[0]"></div>
                            </div>
                            <!-- repeat new password end -->

                            <!-- button start -->
                            <div class="form-group">
                                <button type="submit" class="btn btn-dark btn-size-theme px-5" v-if="createLoading === false">Registration</button>
                                <button type="button" class="btn btn-dark btn-size-theme px-5" v-if="createLoading === true">Loading...</button>
                            </div>
                            <!-- button end -->

                            <!-- login route start -->
                            <div class="form-group">
                                <div class="d-flex justify-content-start">
                                    I already have an account
                                    <router-link :to="{name: 'login'}" class="text-decoration-none text-primary ms-3"> Login </router-link>
                                </div>
                            </div>
                            <!-- login route end -->

                        </div>
                    </form>
                    <!-- registration form end -->

                </div>
            </div>
        </div>
    </div>

</template>

<script>
    import apiService from "../services/apiServices.js";
    import apiRoutes from "../services/apiRoutes.js";
    export default {
        data() {
            return {
                createLoading: false,
                registerParam: {
                    company_name: '',
                    full_name: '',
                    email: '',
                    password: '',
                    password_confirmation: '',
                },
                error: null,
            }
        },
        mounted() {},
        created() {
            if(this.UserInfo != null){
                this.$router.push({name: 'dashboard'});
            }
        },
        methods: {
            register(){
                this.createLoading = true;
                apiService.POST(apiRoutes.register, this.registerParam, (res) => {
                    this.createLoading = false;
                    if(res.status === 200){
                        window.location.reload();
                    }else{
                        this.error = res.errors;
                    }
                });
            }
        }
    }
</script>
