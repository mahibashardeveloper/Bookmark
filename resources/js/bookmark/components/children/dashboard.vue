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
                <a href="javascript:void(0)" class="btn btn-dark px-4 py-2">
                    <i class="bi bi-star-fill me-2"></i> Add
                </a>
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
