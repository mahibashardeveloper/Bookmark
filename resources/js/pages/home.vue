<template>

    <!-- hero section start -->
    <section class="w-100 bg-white py-5">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-md-6 col-lg-7 py-5">
                    <div class="h1 mb-4 col-lg-9 col-xl-7 fw-bold">
                        No worries about messy Bookmarks
                    </div>
                    <div class="h4 fw-bold mb-4">The world is your bookmark</div>
                    <div class="text-secondary mb-4 col-lg-7">
                        we know you found many sources from the internet & place it on that bunch bookmarks folder on browser, we made AI automation to help you manage.
                    </div>
                    <div class="d-flex align-items-center">
                        <router-link :to="{name: 'login'}" class="btn btn-theme me-2">
                            Join Bookmark
                        </router-link>
                        <a href="javascript:void(0)" class="btn btn-outline-theme">
                            Explore Bookmark
                        </a>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-5 py-5 d-flex justify-content-center">
                    <img :src="'/images/bookmark.png'" class="img-fluid" alt="background-image">
                </div>
            </div>
        </div>
    </section>
    <!-- hero section end -->

    <!-- feature section start -->
    <section class="w-100 bg-white py-5">
        <div class="container">
            <div class="text-center">
                <div class="h1 mb-4 fw-bold">
                    Features
                </div>
            </div>
            <div class="text-secondary d-flex justify-content-center mb-4">
                <div class="col-12 col-sm-10 col-md-8 col-lg-6 text-md-center">
                    Our aim is to make it quick and easy for you to access your favourite websites. Your bookmarks sync between your devices so you can access them on the go.
                </div>
            </div>
            <ul class="nav nav-tabs d-flex justify-content-center" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active" id="simple-bookmark" data-bs-toggle="tab" data-bs-target="#simple-bookmark-pane" type="button" role="tab" aria-controls="simple-bookmark-pane" aria-selected="true">
                        Simple
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="easy-sharing" data-bs-toggle="tab" data-bs-target="#easy-sharing-pane" type="button" role="tab" aria-controls="easy-sharing-pane" aria-selected="false">
                        Sharing
                    </button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="speedy-search" data-bs-toggle="tab" data-bs-target="#speedy-search-pane" type="button" role="tab" aria-controls="speedy-search-pane" aria-selected="false">
                        Searching
                    </button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <!-- tab home content start -->
                <div class="tab-pane fade show active" id="simple-bookmark-pane" role="tabpanel" aria-labelledby="simple-bookmark" tabindex="0">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <div class="col-md-6 py-5">
                                <div class="h1 mb-4 fw-bold">Simple bookmarks.</div>
                                <div class="text-secondary mb-4">
                                    Organize your bookmarks however you like. Our simple drag-and-drop interface gives you complete control over how you manage your favourite sites.
                                </div>
                                <a href="javascript:void(0)" class="btn btn-theme">
                                    More Info.
                                </a>
                            </div>
                            <div class="col-md-6 py-5">
                                <img :src="'/images/website-building.png'" class="img-fluid" alt="beach day">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- tab home content end -->

                <!-- tab profile content start -->
                <div class="tab-pane fade" id="easy-sharing-pane" role="tabpanel" aria-labelledby="easy-sharing" tabindex="0">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <div class="col-md-6 py-5">
                                <img :src="'/images/easy-sharing.svg'" class="img-fluid" alt="beach day">
                            </div>
                            <div class="col-md-6 py-5">
                                <div class="h1 mb-4 fw-bold">Share your bookmarks</div>
                                <div class="text-secondary mb-4">
                                    Easily share your bookmarks and collections with others. Create a shareable link that you can send at the click of a button.
                                </div>
                                <a href="javascript:void(0)" class="btn btn-theme">
                                    More Info.
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- tab profile content end -->

                <!-- tab contact content start -->
                <div class="tab-pane fade" id="speedy-search-pane" role="tabpanel" aria-labelledby="speedy-search" tabindex="0">
                    <div class="container-fluid">
                        <div class="row align-items-center">
                            <div class="col-md-6 py-5">
                                <div class="h1 mb-4 fw-bold">Intelligent search</div>
                                <div class="text-secondary mb-4">
                                    Our powerful search feature will help you find saved sites in no time at all. No need to trawl through all of your bookmarks.
                                </div>
                                <a href="javascript:void(0)" class="btn btn-theme">
                                    More Info.
                                </a>
                            </div>
                            <div class="col-md-6 py-5">
                                <img :src="'/images/search-intelligence.svg'" class="img-fluid" alt="search-intelligence">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- tab contact content end -->

            </div>
        </div>
    </section>
    <!-- feature section end -->

    <!-- platform group image start -->
    <section class="w-100 bg-white platform py-5">
        <div class="container py-5">
            <div class="h1 fw-bold pb-5 text-center">Download the extension</div>
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 text-center">
                <div class="p-3">
                    <div class="shadow pt-5 pb-4">
                        <div class="h-100">
                            <img :src="'/images/chrome.svg'" class="img-fluid platform-size" alt="famous-icon">
                        </div>
                        <div class="py-3 h5 fw-bold">Add to Chrome</div>
                        <div class="w-100 pb-3">
                            <img :src="'/images/bg-dots.svg'" class="img-fluid w-100" alt="bg-dots">
                        </div>
                        <a href="javascript:void(0)" class="btn btn-theme">
                            Add & Install
                        </a>
                    </div>
                </div>
                <div class="p-3">
                    <div class="shadow pt-5 pb-4">
                        <div class="h-100">
                            <img :src="'/images/firefox.svg'" class="img-fluid platform-size" alt="famous-icon">
                        </div>
                        <div class="py-3 h5 fw-bold">Firefox Extension</div>
                        <div class="w-100 pb-3">
                            <img :src="'/images/bg-dots.svg'" class="img-fluid w-100" alt="bg-dots">
                        </div>
                        <a href="javascript:void(0)" class="btn btn-theme">
                            Add & Install
                        </a>
                    </div>
                </div>
                <div class="p-3">
                    <div class="shadow pt-5 pb-4">
                        <div class="h-100">
                            <img :src="'/images/edge.svg'" class="img-fluid platform-size" alt="famous-icon">
                        </div>
                        <div class="py-3 h5 fw-bold">Edge Extension</div>
                        <div class="w-100 pb-3">
                            <img :src="'/images/bg-dots.svg'" class="img-fluid w-100" alt="bg-dots">
                        </div>
                        <a href="javascript:void(0)" class="btn btn-theme">
                            Add & Install
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- platform group image end -->

    <!-- Frequently Asked Questions start -->
    <section class="w-100 bg-white py-5">
        <div class="container">
            <div class="mb-4 text-center h1">
                Frequently Asked Questions
            </div>
            <div class="d-flex justify-content-center">
                <div class="col-12 col-sm-10 col-md-8 col-lg-6 text-md-center mb-4">
                    Here are some of our FAQs. If you have any other questions you’d like answered please feel free to email us.
                </div>
            </div>

            <div class="d-flex justify-content-center">
                <div class="col-12 col-sm-10 col-md-8 col-lg-6">
                    <div class="accordion" id="accordionExample">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button fw-bold shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    What is the purpose of a bookmark?
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Bookmarks are used to save web pages or other files for future reference. They can be used to organize your favorite websites, articles, or other resources.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button fw-bold shadow-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                    What are some different types of bookmarks?
                                </button>
                            </h2>
                            <div id="collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    There are many different types of bookmarks, including:

                                    <div class="mb-3">
                                        Digital bookmarks: <br><br> These are bookmarks that are saved in your web browser or on a cloud storage service.
                                    </div>
                                    <div class="mb-3">
                                        Physical bookmarks: <br><br> These are physical objects that you can use to mark your place in a book or other printed material.
                                    </div>
                                    <div class="mb-3">
                                        Social bookmarks: <br><br> These are bookmarks that are shared with others online.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button fw-bold shadow-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                    What are some creative ways to make a bookmark?
                                </button>
                            </h2>
                            <div id="collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    There are many creative ways to make a bookmark, such as:

                                    <div class="mb-3">
                                        Using origami: <br><br> You can fold a piece of paper into a bookmark shape.
                                    </div>
                                    <div class="mb-3">
                                        Using recycled materials: <br><br> You can use recycled materials, such as old book pages or magazine clippings, to make a bookmark.
                                    </div>
                                    <div class="mb-3">
                                        Using decorative embellishments: <br><br> You can use decorative embellishments, such as beads, ribbons, or stickers, to decorate a bookmark.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Frequently Asked Questions end -->

    <!-- newsletter start -->
    <section class="w-100 py-5 bg-dark-subtle">
        <div class="container py-5">
            <div class="h4 text-center">
                35,000+ ALREADY JOINED
            </div>
            <div class="h1 py-5 text-center fw-bold">
                Stay up-to-date with what we’re doing
            </div>
            <div class="d-flex justify-content-center">
                <div class="col-12 col-sm-10 col-md-8 col-lg-6">
                    <form class="row">
                        <div class="col-8 pe-0">
                            <input type="text" class="form-control shadow-none border-secondary-subtle h-100" placeholder="Enter Your Email">
                        </div>
                        <button type="button" class="btn btn-outline-theme col-4">Newsletter</button>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- newsletter end -->

</template>

<script>

    export default {

        data() {
            return {

            }
        },

        mounted() {},

        methods: {}

    }

</script>
