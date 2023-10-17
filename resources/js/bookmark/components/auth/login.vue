<template>
    <div class="authentication position-relative">
        <div class="position-absolute start-0 top-0 ps-3 pt-3">
            <a href="/front/home" class="btn-home">
                <i class="bi bi-house-fill"></i>
            </a>
        </div>
        <div class="container-fluid">
            <div class="row justify-content-around align-items-center vh-100">
                <div class="col-12 col-lg-5 py-3 d-none d-lg-block">
                    <img :src="'/images/access_account.png'" class="img-fluid rounded-5" alt="authentication background image">
                </div>
                <div class="col-12 col-sm-10 col-md-8 col-lg-4 my-5">
                    <form @submit.prevent="login" class="px-5 py-4 border shadow rounded-5 bg-white">
                        <div class="row">
                            <div class="form-group col-md-12 text-center">
                                <div class="h1 mb-3 fw-bold">Bookmark</div>
                                <div class="h3 fw-bold mb-3">Welcome to your account</div>
                            </div>
                            <div class="alert alert-danger mb-3 text-center" v-if="error !== null && error.error !== undefined" v-text="error.error"></div>
                            <div class="form-group col-md-12">
                                <label for="email" class="form-label">Email</label>
                                <input id="email" type="email" name="email" class="form-control" autocomplete="off" v-model="loginParam.email">
                                <div class="error-text" v-if="error != null && error.email !== undefined" v-text="error.email[0]"></div>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="password" class="form-label">Password</label>
                                <input id="password" type="password" name="password" class="form-control" autocomplete="off" v-model="loginParam.password">
                                <div class="error-text" v-if="error != null && error.password !== undefined" v-text="error.password[0]"></div>
                            </div>
                            <div class="form-group">
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-dark btn-size-theme px-5" v-if="accessLoading === false">Login</button>
                                        <button type="button" class="btn btn-dark btn-size-theme px-5" v-if="accessLoading === true">Loading...</button>
                                    </div>
                                    <div class="col-md-6 text-end">
                                        <router-link :to="{name: 'forget'}" class="text-decoration-none text-danger">Forget Password ?</router-link>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="d-flex justify-content-start">
                                    I don't have an account
                                    <router-link :to="{name: 'register'}" class="text-decoration-none text-primary ms-3"> Registration </router-link>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

    import apiRoutes from "../../services/apiRoutes.js";

    import apiServices from "../../services/apiServices.js";

    export default {

        data() {
            return {
                accessLoading: false,
                loginParam: {
                    email: '',
                    password: '',
                },
                error: null,
            }
        },

        mounted() {  },

        methods: {

            login(){
                this.accessLoading = true;
                apiServices.POST(apiRoutes.login, this.loginParam, (res) =>{
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
