<template>

    <div class="authentication">
        <div class="container">
            <div class="row justify-content-center align-items-center vh-100">

                <!-- authentication background image start -->
                <div class="col-12 col-md-6 d-none d-lg-block">
                    <img :src="'/images/authentication.png'" class="img-fluid rounded-5" alt="authentication background image">
                </div>
                <!-- authentication background image end -->

                <!-- authentication form start -->
                <div class="col-12 col-md-9 col-lg-6">

                    <!-- login form start -->
                    <form @submit.prevent="login" class="px-5 py-4 border shadow rounded-5 bg-white">
                        <div class="row">

                            <!-- Logo and title start -->
                            <div class="form-group col-md-12 text-center">
                                <div class="h1 mb-3 fw-bold">Bookmark</div>
                                <div class="h3 fw-bold mb-3">Welcome to your account</div>
                            </div>
                            <!-- Logo and title end -->

                            <!-- credential error message start -->
                            <div class="alert alert-danger mb-3 text-center" v-if="error !== null && error.error !== undefined" v-text="error.error"></div>
                            <!-- credential error message end -->

                            <!-- email start -->
                            <div class="form-group col-md-12">
                                <label for="email" class="form-label">Email</label>
                                <input id="email" type="email" name="email" class="form-control" autocomplete="off" v-model="loginParam.email">
                                <div class="error-text" v-if="error != null && error.email !== undefined" v-text="error.email[0]"></div>
                            </div>
                            <!-- email end -->

                            <!-- password start -->
                            <div class="form-group col-md-12">
                                <label for="password" class="form-label">Password</label>
                                <input id="password" type="password" name="password" class="form-control" autocomplete="off" v-model="loginParam.password">
                                <div class="error-text" v-if="error != null && error.password !== undefined" v-text="error.password[0]"></div>
                            </div>
                            <!-- email end -->

                            <!-- button start -->
                            <div class="form-group">
                                <div class="row align-items-center">
                                    <div class="col-lg-6">
                                        <button type="submit" class="btn btn-dark btn-size-theme px-5" v-if="accessLoading === false">Login</button>
                                        <button type="button" class="btn btn-dark btn-size-theme px-5" v-if="accessLoading === true">Loading...</button>
                                    </div>
                                    <div class="col-lg-6 text-lg-end py-4">
                                        <router-link :to="{name: 'forget'}" class="text-decoration-none text-danger">Forget Password</router-link>
                                    </div>
                                </div>
                            </div>
                            <!-- button end -->

                            <!-- register route link start -->
                            <div class="form-group">
                                <div class="d-flex justify-content-start">
                                    I don't have an account
                                    <router-link :to="{name: 'register'}" class="text-decoration-none text-primary ms-3"> Registration </router-link>
                                </div>
                            </div>
                            <!-- register route link end -->

                        </div>
                    </form>
                    <!-- login form end -->

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
        data() {
            return {
                UserInfo: window.core.UserInfo,
                accessLoading: false,
                loginParam: {
                    email: '',
                    password: '',
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
            login(){
                this.accessLoading = true;
                apiService.POST(apiRoutes.login, this.loginParam, (res) =>{
                    this.accessLoading = false;
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
