<template>

    <div class="h1 text-center py-5">
        Bookmark
        <div class="d-flex justify-content-center">
            <div class="col-7 col-lg-4">
                <hr>
            </div>
        </div>
    </div>

    <div class="pb-5">
        <div class="container-fluid">
            <div class="d-flex flex-wrap justify-content-between px-4">
                <div class="col-12 col-md-9 col-lg-6 mt-4">
                    <div class="position-relative">
                        <input type="text" placeholder="Search Here" class="form-control py-2 ps-5 shadow-none border-secondary-subtle" v-model="formData.q" @keyup="SearchData">
                        <div class="position-absolute translate-middle-y top-50 start-0 ps-3">
                            <i class="bi bi-search"></i>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 text-end mt-4">
                    <a href="javascript:void(0)" class="btn btn-dark px-4 py-2" @click="manageModal(1, null)">
                        <i class="bi bi-star-fill me-2"></i> Add
                    </a>
                </div>
            </div>
        </div>

        <div class="container-fluid mt-4">
            <div class="px-4">

                <!-- card content start -->
                <div class="card-content">

                    <!-- card header start -->
                    <div class="card-header border-bottom">
                        <div class="me-3 h4">
                            <i class="bi bi-cloud-fill me-2"></i>
                            All Bookmark
                        </div>
                        <span class="d-flex align-items-center" v-if="tableData.length > 0 && loading === false && selected.length > 0">
                            <a href="javascript:void(0)" class="select-icon" @click="deleteModal(1)">
                                <i class="bi bi-trash2"></i>
                            </a>
                            <a href="javascript:void(0)" class="ms-2 select-icon" v-if="selected.length === 1" @click="openEditModal">
                                <i class="bi bi-pencil-square"></i>
                            </a>
                        </span>
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
                                <div class="col-12 col-sm-4 d-none d-sm-block">
                                    <div class="d-flex align-items-center">
                                        <input type="checkbox" class="form-check-input me-3 d-none d-sm-block" :checked="tableData.length > 0 && tableData.length === selected.length" @change="toggleCheckAll($event)">
                                        Name
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4 d-none d-sm-block">
                                    Url
                                </div>
                            </div>
                            <!-- card topic end -->

                            <!-- card list start -->
                            <div class="row card-list" v-for="(each) in tableData">
                                <div class="col-12 col-sm-4 text-truncate">
                                    <div class="marge-title py-3">
                                        Name
                                    </div>
                                    <div class="d-flex align-items-center">
                                        <input type="checkbox" class="form-check-input me-3 d-none d-sm-block" :checked="CheckIfChecked(each.id)" @change="toggleCheck($event,each.id)">
                                        {{each.bookmark_name}}
                                    </div>
                                </div>
                                <div class="col-12 col-sm-4 text-truncate">
                                    <div class="marge-title py-3">
                                        Url
                                    </div>
                                    <a :href="each.bookmark_url" target="_blank" class="text-dark text-decoration-none"> {{each.bookmark_url}} </a>
                                </div>
                                <div class="col-12 col-sm-4 text-sm-end mt-3 mt-sm-0">
                                    <a href="javascript:void(0)" class="text-decoration-none text-secondary me-3" @click="manageModal(1, each.id)">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>
                                    <a href="javascript:void(0)" class="text-decoration-none text-danger" @click="deleteModal(1, each.id)">
                                        <i class="bi bi-trash2"></i>
                                    </a>
                                </div>
                            </div>
                            <!-- card list end -->

                        </div>
                    </div>
                    <!-- card body section end -->

                    <!-- card footer start -->
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
                    <!-- card footer end -->

                </div>
                <!-- card content end -->

            </div>
        </div>
    </div>

    <!-- manage modal start -->
    <div class="modal fade" id="manageModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form @submit.prevent="manageBookmark">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">
                            <span v-if="bookmarkParam.id === ''"> Create </span>
                            <span v-if="bookmarkParam.id !== ''"> Edit </span>
                            Bookmark
                        </h1>
                        <button type="button" class="btn-close" @click="manageModal(2,'')"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="bookmark_name" class="form-label">Bookmark Name</label>
                            <input type="text" name="bookmark_name" class="form-control border-secondary-subtle" v-model="bookmarkParam.bookmark_name" autocomplete="off">
                            <div class="error-text" v-if="error != null && error.bookmark_name !== undefined" v-text="error.bookmark_name[0]"></div>
                        </div>
                        <div class="mb-3">
                            <label for="bookmark_url" class="form-label">Bookmark Url</label>
                            <input type="url" name="bookmark_url" class="form-control border-secondary-subtle" v-model="bookmarkParam.bookmark_url" autocomplete="off">
                            <div class="error-text" v-if="error != null && error.bookmark_url !== undefined" v-text="error.bookmark_url[0]"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="manageModal(2,'')">
                            Cancel
                        </button>
                        <button type="submit" class="btn btn-dark">
                            <span v-if="createLoading === false">
                                <span v-if="bookmarkParam.id === ''">
                                    Save
                                </span>
                                <span v-if="bookmarkParam.id !== ''">
                                    Update
                                </span>
                            </span>
                            <span v-if="createLoading === true">
                                Loading...
                            </span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- manage modal end -->

    <!-- delete modal start -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header border-bottom-0">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Bookmark</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="h4 fw-bold text-center">
                        Are you sure?
                    </div>
                </div>
                <div class="modal-footer border-top-0 d-flex justify-content-around align-items-center">
                    <button type="button" class="col-5 btn btn-secondary" @click="deleteModal(2,'')">Cancel</button>
                    <button type="button" class="col-5 btn btn-danger" @click="deleteBookmark">
                        <span v-if="deleteLoading === false">
                            Confirm
                        </span>
                        <span v-if="deleteLoading === true">
                            Loading...
                        </span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- delete modal end -->

</template>

<script>
    import apiService from "../services/apiServices.js";
    import apiRoutes from "../services/apiRoutes.js";
    export default {

        data() {

            return {
                loading: false,
                createLoading: false,
                deleteLoading: false,
                bookmark: [],
                bookmarkParam: {
                    bookmark_name: '',
                    bookmark_url: '',
                },
                deleteParam: {
                    ids: []
                },
                tableData: [],
                formData: {
                    date: 'all',
                    limit: 10,
                    page: 1
                },
                total_pages: 0,
                current_page: 0,
                buttons: [],
                searchTimeout: null,
                error: null,
                responseData: null,
                total_data: 0,
                selected: [],
            }

        },

        mounted() {
            this.list();
        },

        methods: {

            toggleCheckAll(e) {
                if (e.target.checked) {
                    this.tableData.forEach((v) => {
                        this.selected.push(v.id);
                    });
                } else {
                    this.selected = [];
                }
            },

            toggleCheck(e, id) {
                if (e.target.checked) {
                    this.selected.push(id);
                } else {
                    let index = this.selected.indexOf(id);
                    this.selected.splice(index, 1);
                }
            },

            CheckIfChecked(id) {
                return this.selected.map(function (id) {
                    return id
                }).indexOf(id) > -1;
            },

            openEditModal() {
                this.getSingle();
                const myModal = new bootstrap.Modal("#manageModal", {keyboard: false, backdrop: 'static'});
                myModal.show();
            },

            deleteBookmark() {
                this.deleteLoading = true;
                this.selected.forEach((v) => {
                    this.deleteParam.ids.push(v);
                })
                apiService.POST(apiRoutes.bookmarkDelete, this.deleteParam, (res) => {
                    this.deleteLoading = false;
                    if (res.status === 200) {
                        this.$toast.success(res.msg, {position: "bottom-right"});
                        this.deleteModal(2, '')
                        this.list();
                        this.selected = [];
                    } else {
                        this.error = res.errors;
                    }
                })
            },

            deleteModal(type, id) {
                if (type === 1) {
                    this.deleteParam.ids.push(id)
                    const myModal = new bootstrap.Modal("#deleteModal", {keyboard: false, backdrop: 'static'});
                    myModal.show();
                } else {
                    this.selected = [];
                    this.bookmarkParam = { id: '', bookmark_name: '', bookmark_url: '' };
                    this.current_page = 1;
                    let myModalEl = document.getElementById('deleteModal');
                    let modal = bootstrap.Modal.getInstance(myModalEl)
                    modal.hide();
                }
            },

            manageModal(type, data = null) {
                this.error = null;
                this.bookmarkParam = { id: '', bookmark_name: '', bookmark_url: '' };
                if (type === 1) {
                    this.getBookmark();
                    if (data !== null) {
                        this.getSingle(data);
                    }
                    const myModal = new bootstrap.Modal("#manageModal");
                    myModal.show();
                } else {
                    this.selected = [];
                    this.bookmarkParam = { id: '', bookmark_name: '', bookmark_url: '' };
                    this.current_page = 1;
                    const myModal = document.querySelector("#manageModal");
                    const modal = bootstrap.Modal.getInstance(myModal);
                    modal.hide();
                }
            },

            getBookmark() {
                apiService.POST(apiRoutes.bookmarkList, '', (res) => {
                    if (res.status === 200) {
                        this.bookmark = res.data.data
                    }
                })
            },

            manageBookmark() {
                if (this.bookmarkParam.id) {
                    this.edit();
                } else {
                    this.create();
                }
            },

            getSingle(id = null) {
                let param = { id: '' }
                if (id != null) { param.id = id } else { param.id = this.selected[0] }
                apiService.POST(apiRoutes.bookmarkSingle, param, (res) => {
                    if (res.status === 200) {
                        this.bookmarkParam = res.data;
                    } else {
                        this.error = res.errors;
                    }
                });
            },

            create() {
                this.createLoading = true;
                this.error = null;
                apiService.POST(apiRoutes.bookmarkCreate, this.bookmarkParam, (res) => {
                    this.createLoading = false;
                    if (res.status === 200) {
                        this.$toast.success(res.msg, {position: "bottom-right"});
                        this.manageModal(2, null);
                        this.list();
                        this.selected = [];
                    } else {
                        this.error = res.errors;
                    }
                });
            },

            edit() {
                this.createLoading = true;
                this.error = null;
                apiService.POST(apiRoutes.bookmarkUpdate, this.bookmarkParam, (res) => {
                    this.createLoading = false;
                    if (res.status === 200) {
                        this.getBookmark();
                        this.$toast.success(res.msg, {position: "bottom-right"});
                        this.manageModal(2, null);
                        this.list();
                        this.selected = [];
                    } else {
                        this.error = res.errors;
                    }
                });
            },

            list() {
                this.loading = true;
                this.formData.page = this.current_page;
                apiService.POST(apiRoutes.bookmarkList, this.formData, (res) => {
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

            SearchData() {
                clearTimeout(this.searchTimeout);
                this.searchTimeout = setTimeout(() => {
                    this.list();
                }, 500);
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
