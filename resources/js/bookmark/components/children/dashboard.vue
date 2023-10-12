<template>

    <div class="container-fluid">
        <div class="d-flex flex-wrap justify-content-between px-4">
            <div class="col-12 col-md-9 col-lg-6">
                <div class="position-relative">
                    <input type="text" placeholder="Search Here" class="form-control py-2 ps-5 shadow-none border-secondary-subtle" required>
                    <div class="position-absolute translate-middle-y top-50 start-0 ps-3">
                        <i class="bi bi-search"></i>
                    </div>
                </div>
            </div>
            <div class="col-md-3 text-end">
                <div class="dropdown">
                    <button class="btn btn-dark px-3" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-star-fill me-2"></i> Add
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li>
                            <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#modalBookmarkUrl">
                                Bookmark Url
                            </a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#modalBookmarkFile">
                                Bookmark File
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid px-4">
        <div class="row px-4">
            <div class="col-md-12 p-3 border-bottom">
                <i class="bi bi-cloud-fill me-2"></i> All Bookmark
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalBookmarkUrl" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Bookmark</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="bookmark_url" class="form-label">Bookmark Url</label>
                        <input id="bookmark_url" type="url" name="bookmark_url" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="bookmark_file" class="form-label">Bookmark File</label>
                        <label for="update_file" id="bookmark_file" class="w-100 btn btn-outline-dark">
                            <input id="update_file" type="file" name="bookmark_file" class="d-none" required>
                            <i class="bi bi-file-arrow-up me-3"></i> File Upload
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalBookmarkFile" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Bookmark</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="bookmark_url" class="form-label">Bookmark Url</label>
                        <input id="bookmark_url" type="url" name="bookmark_url" class="form-control" required>
                    </div>
                    <div class="mb-3">
                        <label for="bookmark_file" class="form-label">Bookmark File</label>
                        <label for="update_file" id="bookmark_file" class="w-100 btn btn-outline-dark">
                            <input id="update_file" type="file" name="bookmark_file" class="d-none" required>
                            <i class="bi bi-file-arrow-up me-3"></i> File Upload
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Save</button>
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
