<template>
    <div class="authentication">
        <div class="container-fluid">
            <div class="row justify-content-around align-items-center vh-100">
                <div class="col-12 col-lg-5 py-3 d-none d-lg-block">
                    <img :src="'/images/authentication.png'" class="img-fluid rounded-5" alt="authentication background image">
                </div>
                <div class="col-12 col-sm-10 col-md-8 col-lg-4 py-3">
                    <form class="px-5 py-4 border shadow rounded-5 bg-white">
                        <div class="row">
                            <div class="form-group col-md-12 text-center">
                                <div class="h1 mb-3 fw-bold">Tracking Master</div>
                                <div class="h3 fw-bold mb-3">Forget account password</div>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="email" class="form-label">Email</label>
                                <input id="email" type="text" name="email" class="form-control" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-dark btn-size-theme px-5">Send Code</button>
                                        <button type="button" class="btn btn-dark d-none btn-size-theme px-5">Loading...</button>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="d-flex justify-content-start">
                                    Remember account password
                                    <router-link :to="{name: 'login'}" class="text-decoration-none text-primary ms-3"> Login </router-link>
                                </div>
                            </div>
                        </div>
                    </form>

                    <form class="px-5 py-4 border shadow rounded-5 bg-white d-none">
                        <div class="row">
                            <div class="form-group col-md-12 text-center">
                                <div class="h1 mb-3 fw-bold">Tracking Master</div>
                                <div class="h3 fw-bold mb-3">Forget account password</div>
                            </div>
                            <div class="form-group col-md-12">
                                <label for="email" class="form-label">Email</label>
                                <input id="email" type="text" name="email" class="form-control" autocomplete="off">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="code" class="form-label">Code</label>
                                <input id="code" type="text" name="code" class="form-control" autocomplete="off">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="password" class="form-label">New password</label>
                                <input id="password" type="password" name="password" class="form-control" autocomplete="off">
                            </div>
                            <div class="form-group col-md-12">
                                <label for="confirm_password" class="form-label">Confirm password</label>
                                <input id="confirm_password" type="password" name="confirm_password" class="form-control" autocomplete="off">
                            </div>
                            <div class="form-group">
                                <div class="row align-items-center">
                                    <div class="col-md-6">
                                        <button type="submit" class="btn btn-dark btn-size-theme px-5">Reset</button>
                                        <button type="button" class="btn btn-dark d-none btn-size-theme px-5">Loading...</button>
                                    </div>
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

export default {

    data() { return {  } },

    mounted() {  },

    methods: {  }

}

</script>
