<template>

    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-lg-6">
                <div class="px-4">
                    <div class="card-content">
                        <div class="card-header border-bottom">
                            <div class="me-3 h4">
                                User Access time
                            </div>
                        </div>
                        <div class="card-body">

                            <!-- page loading start -->
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
                            <!-- page loading end -->

                            <!-- no data start -->
                            <div class="page-no-data-found" v-if="tableData.length === 0 && loading === false">
                                <div class="w-100">
                                    <div class="mb-3">
                                        <i class="bi bi-exclamation-circle fs-1"></i>
                                    </div>
                                    <div class="mb-3">No Data Founded</div>
                                    <span>Create New Bookmark to click "Add"</span>
                                </div>
                            </div>
                            <!-- no data end -->

                            <div v-if="tableData.length > 0 && loading === false">
                                <div class="row card-topic">
                                    <div class="col-12 col-sm-6 d-none d-sm-block">
                                        Ip Address
                                    </div>
                                    <div class="col-12 col-sm-6 d-none d-sm-block">
                                        Access Time
                                    </div>
                                </div>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="px-4">
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
                                <div class="row card-topic">
                                    <div class="col-12 col-sm-6 d-none d-sm-block">
                                        Name
                                    </div>
                                    <div class="col-12 col-sm-6 d-none d-sm-block">
                                        Url
                                    </div>
                                </div>
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
                            </div>
                        </div>
                    </div>
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
                bookmark_total_pages: 0,
                bookmark_current_page: 0,
                bookmark_buttons: [],
                tableData: [],
                formData: {
                    limit: 30,
                    page: 1
                },
                total_pages: 0,
                current_page: 0,
                buttons: [],
                searchTimeout: null,
                error: null,
                responseData: null,
                total_data: 0,
                bookmark_total_data: 0,
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
                        this.total_data = res.data.total;
                        this.total_pages = res.data.total < res.data.per_page ? 1 : Math.ceil((res.data.total / res.data.per_page));
                        this.current_page = res.data.current_page;
                        this.buttons = [...Array(this.total_pages).keys()].map((i) => i + 1);
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
                        this.bookmark_total_data = res.data.total;
                    }
                });
            },

            PrevPage() {
                if (this.current_page > 1) {
                    this.current_page = this.current_page - 1;
                    this.list()
                }
            },

            NextPage() {
                if (this.current_page < this.total_pages) {
                    this.current_page = this.current_page + 1;
                    this.list()
                }
            },

            pageChange(page) {
                this.current_page = page;
                this.list();
            },

        }

    }

</script>
