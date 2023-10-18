<template>

    <div class="container-fluid">
        <div class="h3 text-center py-3 bg-white shadow rounded-top-4">
            Dashboard
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-6 pb-5">

                    <!-- card content start -->
                    <div class="card-content shadow">

                        <!-- card header start -->
                        <div class="card-header border-bottom between">
                            <div class="me-3 card-title">
                                Login History
                            </div>
                            <router-link class="btn btn-dark py-0 px-3 icon-bottom rounded-0" :to="{name: 'loginHistory'}">
                                view more
                            </router-link>
                        </div>
                        <!-- card header end -->

                        <!-- card body start -->
                        <div class="card-body">

                            <!-- loading start -->
                            <div v-if="loading === true">
                                <h6 class="card-text placeholder-glow">
                                <span class="p-2">
                                    <span class="placeholder col-12 py-3 mb-3"></span>
                                </span>
                                    <span class="p-2">
                                    <span class="placeholder col-10 py-3 mb-3"></span>
                                </span>
                                    <span class="p-2">
                                    <span class="placeholder col-7 py-3 mb-3"></span>
                                </span>
                                </h6>
                            </div>
                            <!-- loading end -->

                            <!-- page no data found start -->
                            <div class="page-no-data-found" v-if="tableData.length === 0 && loading === false">
                                <div class="w-100">
                                    <div class="mb-3">
                                        <i class="bi bi-exclamation-circle fs-1"></i>
                                    </div>
                                    <div class="mb-3">No Data Founded</div>
                                    <span>Create New Bookmark to click "Add"</span>
                                </div>
                            </div>
                            <!-- page no data found end -->

                            <div v-if="tableData.length > 0 && loading === false">

                                <!-- card topic start -->
                                <div class="row card-topic">
                                    <div class="col-12 col-sm-6 d-none d-sm-block">
                                        Ip Address
                                    </div>
                                    <div class="col-12 col-sm-6 d-none d-sm-block">
                                        Access Time
                                    </div>
                                </div>
                                <!-- card topic end -->

                                <!-- card list start -->
                                <div class="row card-list" v-for="(each) in tableData">
                                    <div class="col-12 col-sm-6">
                                        <div class="marge-title py-3">
                                            IP Address
                                        </div>
                                        {{each.ip_address}}
                                    </div>
                                    <div class="col-12 col-sm-6">
                                        <div class="marge-title py-3">
                                            Access Time
                                        </div>
                                        {{each.created_at_formatted}}
                                    </div>
                                </div>
                                <!-- card list end -->

                            </div>
                        </div>
                        <!-- card body end -->

                    </div>
                    <!-- card content end -->

            </div>

            <div class="col-lg-6 pb-5">

                    <!-- card content start -->
                    <div class="card-content shadow">
                        <div class="card-header border-bottom between">
                            <div class="me-3 col-md-6">
                                <div class="me-3 card-title">
                                    Latest Bookmark
                                </div>
                            </div>
                            <router-link :to="{name: 'bookmark'}" class="btn btn-dark py-0 px-3 icon-bottom rounded-0">
                                view more
                            </router-link>
                        </div>
                        <div class="card-body">

                            <!-- page loading start -->
                            <div v-if="bookmarkLoading === true">
                                <h6 class="card-text placeholder-glow">
                                <span class="p-2">
                                    <span class="placeholder col-12 py-3 mb-3"></span>
                                </span>
                                    <span class="p-2">
                                    <span class="placeholder col-10 py-3 mb-3"></span>
                                </span>
                                    <span class="p-2">
                                    <span class="placeholder col-7 py-3 mb-3"></span>
                                </span>
                                </h6>
                            </div>
                            <!-- page loading end -->

                            <!-- no data start -->
                            <div class="page-no-data-found" v-if="latestBookmarkTableData.length === 0 && bookmarkLoading === false">
                                <div class="w-100">
                                    <div class="mb-3">
                                        <i class="bi bi-exclamation-circle fs-1"></i>
                                    </div>
                                    <div class="mb-3">No Data Founded</div>
                                </div>
                            </div>
                            <!-- no data end -->

                            <div v-if="latestBookmarkTableData.length > 0 && bookmarkLoading === false">

                                <!-- card topic start -->
                                <div class="row card-topic">
                                    <div class="col-12 col-sm-6 d-none d-sm-block">
                                        Name
                                    </div>
                                    <div class="col-12 col-sm-6 d-none d-sm-block">
                                        Url
                                    </div>
                                </div>
                                <!-- card topic end -->

                                <!-- card list start -->
                                <div class="row card-list" v-for="(each) in latestBookmarkTableData">
                                    <div class="col-12 col-sm-6 text-truncate">
                                        <div class="marge-title py-3">
                                            Name
                                        </div>
                                        {{each.bookmark_name}}
                                    </div>
                                    <div class="col-12 col-sm-6 text-truncate">
                                        <div class="marge-title py-3">
                                            Url
                                        </div>
                                        <a :href="each.bookmark_url" target="_blank" class="text-dark text-decoration-none"> {{each.bookmark_url}} </a>
                                    </div>
                                </div>
                                <!-- card list end -->


                            </div>
                        </div>
                        <!-- card body end -->

                    </div>
                    <!-- card content end -->

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
                loading: false,
                bookmarkLoading: false,
                latestBookmarkTableData: [],
                bookmarkFormData: {
                    limit: 10,
                    page: 1
                },
                tableData: [],
                formData: {
                    limit: 10,
                    page: 1
                },
            }
        },

        mounted() {
            this.list();
            this.bookmarkList();
        },

        methods: {

            list() {
                this.loading = true;
                apiService.POST(apiRoutes.profile_userLog, this.formData, (res) => {
                    this.loading = false;
                    this.selected = [];
                    if (res.status === 200) {
                        this.tableData = res.data.data;
                    }
                });
            },

            bookmarkList() {
                this.bookmarkLoading = true;
                apiService.POST(apiRoutes.bookmarkList, this.bookmarkFormData, (res) => {
                    this.bookmarkLoading = false;
                    if (res.status === 200) {
                        this.latestBookmarkTableData = res.data.data;
                    }
                });
            },

        }

    }

</script>
