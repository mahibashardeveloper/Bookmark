<template>

    <!-- hero section start -->
    <section class="vh-100 d-flex justify-content-center align-items-center hero-section" style="background-image: url('/images/background-image.svg')">
        <div class="py-3 text-center">
            <div class="h1 pb-5 fw-bold">Your bookmarks always available.</div>
            <div class="h3">Simple. Individual. Private. Fast.</div>
            <div class="pt-5">
                <router-link :to="{name: 'login'}" class="btn btn-dark mx-1 py-2 px-5 my-2">
                    Join Bookmark
                </router-link>
                <a href="javascript:void(0)" class="btn btn-warning mx-1 py-2 px-5 my-2">
                    About Bookmark
                </a>
            </div>
        </div>
    </section>
    <!-- hero section end -->

    <!-- title section start -->
    <section class="w-100 bg-white py-5">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-md-6 py-5">
                    <div class="h1 mb-4 fw-bold">Private bookmarks.</div>
                    <div class="text-secondary">
                        With bookmarks, you can store your favorite links online in private collections.
                        All your bookmarks are kept confidential and are only visible to you.
                    </div>

                </div>
                <div class="col-md-6 py-5">
                    <img :src="'/images/beachDay.png'" class="img-fluid" alt="beach day">
                </div>
            </div>
        </div>
    </section>
    <!-- title section end -->

    <!-- title section start -->
    <section class="w-100 bg-light py-5">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-md-6 py-5">
                    <img :src="'/images/website-building.png'" class="img-fluid" alt="beach day">
                </div>
                <div class="col-md-6 py-5">
                    <div class="h1 mb-4 fw-bold">Customizable design.</div>
                    <div class="text-secondary">
                        Customize Bookmark to your needs. A background color Change and many other customizations are waiting for you.
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- title section end -->

    <!-- platform group image start -->
    <section class="w-100 bg-white platform py-5">
        <div class="container py-5">
            <div class="h1 fw-bold pb-5 text-center">Booky is available on many platforms.</div>
            <div class="row align-items-center">
                <div class="col-md-7">
                    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 text-center">
                        <div class="p-3">
                            <a href="javascript:void(0)" class="h-100">
                                <img :src="'/images/chrome.svg'" class="img-fluid platform-size" alt="famous-icon">
                            </a>
                            <div class="pt-3 h5 fw-bold">Chrome Extension</div>
                        </div>
                        <div class="p-3">
                            <a href="javascript:void(0)" class="h-100">
                                <img :src="'/images/firefox.svg'" class="img-fluid platform-size" alt="famous-icon">
                            </a>
                            <div class="pt-3 h5 fw-bold">Firefox Extension</div>
                        </div>
                        <div class="p-3">
                            <a href="javascript:void(0)" class="h-100">
                                <img :src="'/images/edge.svg'" class="img-fluid platform-size" alt="famous-icon">
                            </a>
                            <div class="pt-3 h5 fw-bold">Edge Extension</div>
                        </div>
                        <div class="p-3">
                            <a href="javascript:void(0)" class="h-100">
                                <img :src="'/images/android.svg'" class="img-fluid platform-size" alt="famous-icon">
                            </a>
                            <div class="pt-3 h5 fw-bold">Android web app</div>
                        </div>
                        <div class="p-3">
                            <a href="javascript:void(0)" class="h-100">
                                <img :src="'/images/finder.svg'" class="img-fluid platform-size" alt="famous-icon">
                            </a>
                            <div class="pt-3 h5 fw-bold">Macos</div>
                        </div>
                        <div class="p-3">
                            <a href="javascript:void(0)" class="h-100">
                                <img :src="'/images/windows.svg'" class="img-fluid platform-size" alt="famous-icon">
                            </a>
                            <div class="pt-3 h5 fw-bold">Macos</div>
                        </div>
                    </div>
                </div>
                <div class="col-md-5">
                    <img :src="'/images/browsers.png'" class="img-fluid" alt="browsers">
                </div>
            </div>
        </div>
    </section>
    <!-- platform group image end -->

    <!-- title section start -->
    <section class="bg-light w-100 py-5">
        <div class="container py-5">
            <div class="row align-items-center">
                <div class="col-md-6 py-5">
                    <div class="h1 mb-4 fw-bold">
                        Simple and accessible.
                    </div>
                    <div class="text-secondary">
                        We take great pride in providing you with an accessible site that's both fast and easy to use. Organize your bookmarks in collections and categories.
                    </div>
                </div>
                <div class="col-md-6 py-5">
                    <img :src="'/images/speed.svg'" class="img-fluid" alt="speed">
                </div>
            </div>
        </div>
    </section>
    <!-- title section end -->

    <!-- owl carousel - user section section start -->
    <section class="bg-white w-100 user-section py-5">
        <div class="container py-5">
            <div class="py-3 h1 text-center fw-bold">
                In the words of our users
            </div>
            <div class="user-feedback owl-carousel owl-theme">
                <div class="item">
                    <div class="p-3">
                        <div class="bg-light d-flex align-items-center justify-content-start p-3">
                            <div class="col-3">
                                <img :src="'/images/avatar.png'" class="img-fluid" alt="avatar">
                            </div>
                            <div class="user-text py-3 col-9">
                                <div class="fw-bold mb-2">Hyun-Kyung Yi</div>
                                <div class="text-secondary">
                                    A simple, lightweight, yet powerful application
                                    to store my bookmarks in the cloud.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="p-3">
                        <div class="bg-light d-flex align-items-center justify-content-start p-3">
                            <div class="col-3">
                                <img :src="'/images/avatar.png'" class="img-fluid" alt="avatar">
                            </div>
                            <div class="user-text py-3 col-9">
                                <div class="fw-bold mb-2">David Lafond</div>
                                <div class="text-secondary">
                                    My portal to the web. I tried many bookmark
                                    manager, and this is the best one.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="p-3">
                        <div class="bg-light d-flex align-items-center justify-content-start p-3">
                            <div class="col-2">
                                <img :src="'/images/avatar.png'" class="img-fluid" alt="avatar">
                            </div>
                            <div class="user-text py-3 col-10">
                                <div class="fw-bold mb-2">Anonymous</div>
                                <div class="text-secondary">
                                    I love the sleek and simple design! The focus
                                    lies on what's important: managing bookmarks.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- owl carousel - user section section end -->

</template>

<script>

    export default {

        data() {
            return {

            }
        },

        mounted() {

            $('.user-feedback').owlCarousel({
                loop: true,
                margin:10,
                nav: false,
                dots: false,
                autoplay: true,
                responsive:{
                    0:{
                        items:1
                    },
                    600:{
                        items:2
                    },
                    1000:{
                        items:3
                    }
                }
            })

        },

        methods: {



        }

    }

</script>
