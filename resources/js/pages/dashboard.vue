<template>

    <div class="h1 text-center py-5">
        Dashboard
        <div class="d-flex justify-content-center">
            <div class="col-7 col-lg-4">
                <hr>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">

            <div class="col-lg-6 py-5">
                <div class="px-4">

                    <!-- card content start -->
                    <div class="card-content">

                        <!-- card header start -->
                        <div class="card-header border-bottom">
                            <div class="me-3 h4">
                                User Access time
                            </div>
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
            </div>

            <div class="col-lg-6 py-5">
                <div class="px-4">

                    <!-- card content start -->
                    <div class="card-content">
                        <div class="card-header border-bottom">
                            <div class="me-3 col-md-6">
                                <div class="me-3 h4">
                                    Latest Bookmark
                                </div>
                            </div>
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
                                    <span>Create New Bookmark to click "Add"</span>
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
                    limit: 30,
                    page: 1
                },
                tableData: [],
                formData: {
                    limit: 30,
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
                this.formData.page = this.current_page;
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
                this.bookmarkFormData.page = this.bookmark_current_page;
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
