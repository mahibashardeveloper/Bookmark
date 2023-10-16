<template>

    <div class="dashboard">

        <div class="container-fluid">
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
                    <div class="card-footer border-top" v-if="tableData.length > 0 && loading === false">

                        <div class="d-flex justify-content-center">
                            <div class="pagination pagination-sm">
                                <div class="page-item" @click="PrevPage">
                                    <a class="page-link" href="javascript:void(0)">
                                        <i class="bi bi-caret-left-fill"></i>
                                    </a>
                                </div>
                                <div v-if="buttons.length <= 6" class="d-flex">
                                    <div v-for="(page) in buttons" class="page-item" :class="{'active': current_page === page}">
                                        <a class="page-link" @click="pageChange(page)" href="javascript:void(0)" v-text="page"></a>
                                    </div>
                                </div>
                                <div v-if="buttons.length > 6" class="d-flex">
                                    <div class="page-item" :class="{'active': current_page === 1}">
                                        <a class="page-link" @click="pageChange(1)" href="javascript:void(0)">1</a>
                                    </div>
                                    <div v-if="current_page > 3" class="page-item">
                                        <a class="page-link" @click="pageChange(current_page - 2)" href="javascript:void(0)">...</a>
                                    </div>
                                    <div v-if="current_page === buttons.length" class="page-item" :class="{'active': current_page === (current_page - 2)}">
                                        <a class="page-link" @click="pageChange(current_page - 2)" href="javascript:void(0)" v-text="current_page - 2"></a>
                                    </div>
                                    <div v-if="current_page > 2" class="page-item" :class="{'active': current_page === (current_page - 1)}">
                                        <a class="page-link" @click="pageChange(current_page - 1)" href="javascript:void(0)" v-text="current_page - 1"></a>
                                    </div>
                                    <div v-if="current_page !== 1 && current_page !== buttons.length" class="page-item active">
                                        <a class="page-link" @click="pageChange(current_page)" href="javascript:void(0)" v-text="current_page"></a>
                                    </div>
                                    <div v-if="current_page < buttons.length - 1" class="page-item" :class="{'active': current_page === (current_page + 1)}">
                                        <a class="page-link" @click="pageChange(current_page + 1)" href="javascript:void(0)" v-text="current_page + 1"></a>
                                    </div>
                                    <div v-if="current_page === 1" class="page-item" :class="{'active': current_page === (current_page + 2)}">
                                        <a class="page-link" @click="pageChange(current_page + 2)" href="javascript:void(0)" v-text="current_page + 2"></a>
                                    </div>
                                    <div v-if="current_page < buttons.length - 2" class="page-item">
                                        <a class="page-link" @click="pageChange(current_page + 2)" href="javascript:void(0)">...</a>
                                    </div>
                                    <div class="page-item" :class="{'active': current_page === (current_page - buttons.length)}">
                                        <a class="page-link" @click="pageChange(buttons.length)" href="javascript:void(0)" v-text="buttons.length"></a>
                                    </div>
                                </div>
                                <div class="page-item" @click="NextPage">
                                    <a class="page-link" href="javascript:void(0)">
                                        <i class="bi bi-caret-right-fill"></i>
                                    </a>
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

    import apiService from "../../services/apiServices.js";

    import apiRoutes from "../../services/apiRoutes.js";

    export default {

        data() {
            return {
                profile_data: '',
                profileDataLoading: false,
                loading: false,
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
            }
        },

        mounted() {
            this.list();
            this.getProfile()
        },

        methods: {

            getProfile() {
                this.profileDataLoading = true;
                apiService.GET(apiRoutes.profile_details, (res) => {
                    this.profileDataLoading = false;
                    if (res.status === 200) {
                        this.profile_data = res.data;
                    }
                })
            },

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
