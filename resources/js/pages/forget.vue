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

                    <!-- forget form start -->
                    <form @submit.prevent="forget" class="px-5 py-4 border shadow rounded-5 bg-white" v-if="forgetType === 1">
                        <div class="row">

                            <!-- Logo and title start -->
                            <div class="form-group col-md-12 text-center">
                                <div class="h1 mb-3 fw-bold">Bookmark</div>
                                <div class="h3 fw-bold mb-3">Forget password</div>
                            </div>
                            <!-- Logo and title end -->

                            <!-- email start -->
                            <div class="form-group col-md-12">
                                <label for="email" class="form-label">Email</label>
                                <input id="email" type="email" name="email" class="form-control" v-model="forgetParam.email" autocomplete="off">
                                <div class="error-text" v-if="error != null && error.email !== undefined" v-text="error.email[0]"></div>
                            </div>
                            <!-- email end -->

                            <!-- button start -->
                            <div class="form-group">
                                <div class="row align-items-center">
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-dark btn-size-theme px-5" v-if="forgotLoading === false">
                                            Send Code
                                        </button>
                                        <button type="button" class="btn btn-dark btn-size-theme px-5" v-if="forgotLoading === true">
                                            Loading...
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- button end -->

                            <!-- login route start -->
                            <div class="form-group">
                                <div class="d-flex justify-content-start">
                                    Remember account password
                                    <router-link :to="{name: 'login'}" class="text-decoration-none text-primary ms-3"> Login </router-link>
                                </div>
                            </div>
                            <!-- login route end -->

                        </div>
                    </form>
                    <!-- forget form start -->

                    <!-- reset form start -->
                    <form @submit.prevent="reset" class="px-5 py-4 border shadow rounded-5 bg-white" v-if="forgetType === 2">
                        <div class="row">

                            <!-- Logo and title start -->
                            <div class="form-group col-md-12 text-center">
                                <div class="h1 mb-3 fw-bold">Bookmark</div>
                                <div class="h3 fw-bold mb-3">Forget account password</div>
                            </div>
                            <!-- Logo and title end -->

                            <!-- email start -->
                            <div class="form-group col-md-12">
                                <label for="email" class="form-label">Email</label>
                                <input id="email" type="text" name="email" class="form-control" disabled v-model="resetParam.email" autocomplete="off">
                                <div class="error-text" v-if="error != null && error.email !== undefined" v-text="error.email[0]"></div>
                            </div>
                            <!-- email end -->

                            <!-- send code start -->
                            <div class="form-group col-md-12">
                                <label for="code" class="form-label">Code</label>
                                <input id="code" type="text" name="code" class="form-control" v-model="resetParam.code" autocomplete="off">
                                <div class="error-text" v-if="error != null && error.code !== undefined" v-text="error.code[0]"></div>
                            </div>
                            <!-- send code end -->

                            <!-- new password start -->
                            <div class="form-group col-md-12">
                                <label for="password" class="form-label">New password</label>
                                <input id="password" type="password" name="password" class="form-control" v-model="resetParam.password" autocomplete="off">
                                <div class="error-text" v-if="error != null && error.password !== undefined" v-text="error.password[0]"></div>
                            </div>
                            <!-- new password end -->

                            <!-- repeat new password start -->
                            <div class="form-group col-md-12">
                                <label for="password_confirmation" class="form-label">Confirm password</label>
                                <input id="password_confirmation" type="password" name="confirm_password" class="form-control" v-model="resetParam.password_confirmation" autocomplete="off">
                                <div class="error-text" v-if="error != null && error.password_confirmation !== undefined" v-text="error.password_confirmation[0]"></div>
                            </div>
                            <!-- repeat new password end -->

                            <!-- button start -->
                            <div class="form-group">
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-dark btn-size-theme px-5" v-if="resetLoading === false">
                                            Reset
                                        </button>
                                        <button type="button" class="btn btn-dark btn-size-theme px-5" v-if="resetLoading === true">
                                            Loading...
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <!-- button end -->

                        </div>
                    </form>
                    <!-- reset form end -->

                    <!-- login route start -->
                    <div class="w-100 h-100 d-flex justify-content-center align-items-center" v-if="forgetType === 3">
                        <div class="text-center py-5 w-100 rounded-3 shadow">
                            <div class="mb-4 fw-bold">
                                Successfully reset your account
                            </div>
                            <router-link :to="{name: 'login'}" class="text-decoration-none text-primary">
                                Login
                            </router-link>
                        </div>
                    </div>
                    <!-- login route end -->

                </div>
                <!-- authentication form end -->

            </div>
        </div>
    </div>

</template>

<script>
    import apiService from "../services/apiServices.js";
    import apiRoutes from "../services/apiRoutes.js";
    export default {
        data(){
            return{
                resetLoading: false,
                resetParam: {
                    email: '',
                    code: '',
                    password: '',
                    password_confirmation: ''
                },
                forgetType: 1,
                error: null,
                forgotLoading: false,
                forgetParam: {
                    email: ''
                },
            }
        },
        mounted() {},
        created() {
            if(this.UserInfo != null){
                this.$router.push({name: 'dashboard'});
            }
        },
        methods: {
            forget() {
                this.forgotLoading = true;
                this.error = null;
                apiService.POST(apiRoutes.forget, this.forgetParam, (res) => {
                    this.forgotLoading = false
                    if (res.status === 200) {
                        this.forgetType = 2;
                        this.resetParam.email = this.forgetParam.email;
                        this.$toast.success('The verification code has been sent to your email.', {
                            position: "top-right"
                        });
                    } else {
                        this.error = res.error;
                    }
                })
            },
            reset() {
                this.resetLoading = true;
                this.error = null;
                apiService.POST(apiRoutes.reset, this.resetParam, (res) => {
                    this.resetLoading = false;
                    if (res.status === 200) {
                        this.$toast.success('Password has been reset successfully.', {
                            position: "top-right"
                        });
                        this.forgetType = 3;
                    } else {
                        this.error = res.error;
                    }
                })
            },
        }
    }
</script>
