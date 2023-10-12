<template>

    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container">
            <a class="navbar-brand" href="javascript:void(0)">
                <img :src="'/images/logo.png'" class="img-fluid me-3" alt="logo">
                RainDrop.io
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0)">
                            Download
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0)">
                            About
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0)">
                            Pricing
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="javascript:void(0)">
                            Blog
                        </a>
                    </li>
                    <li class="nav-item">
                        <a  href="/user/view" class="nav-link" >
                            Login
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <router-view/>



</template>

<script>

    import apiRoutes from "../../services/apiRoutes.js";
    import apiService from "../../services/apiServices.js";

    export default {

        data() {
            return {

            }
        },

        mounted() {

        },

        methods: {

        }

    }

</script>
