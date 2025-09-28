 {{-- <div class="offcanvas offcanvas-end" id="offcanvasAddItemSideBar" data-bs-backdrop="static" tabindex="-1">
    <form action="{{ route('product-categories.store') }}" method="POST" name="itemAddForm" id="itemAddForm" class="itemAddForm" enctype="multipart/form-data">
        @csrf
        @method("POST")
        <input type="hidden" name="id" id="id" value="">

        <!-- Header -->
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title">Add New Product Category & Tasks</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
        </div>

        <!-- Body -->
        <div class="offcanvas-body overflow-auto" style="max-height: calc(100vh - 130px);">

            <!-- Product Category Name -->
            <div class="mb-3 row">
                <label for="name" class="col-sm-2 col-form-label">
                    Name <span class="text-danger">*</span>
                </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" required>
                </div>
            </div>

            <!-- Status -->
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">
                    Status <span class="text-danger">*</span>
                </label>
                <div class="col-sm-10 d-flex align-items-center gap-3">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="is_active" id="active" value="1" checked>
                        <label class="form-check-label" for="active">Active</label>
                    </div>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="is_active" id="inactive" value="0">
                        <label class="form-check-label" for="inactive">Inactive</label>
                    </div>
                </div>
            </div>

        </div>

        <!-- Footer -->
        <div class="offcanvas-footer border-top p-2">
            <button type="submit" class="btn btn-primary itemAddBtn">Save</button>
            <button type="button" class="btn btn-danger ms-auto" data-bs-dismiss="offcanvas">Cancel</button>
        </div>
    </form>
</div> --}}


<div class="offcanvas offcanvas-end" id="offcanvasAddItemSideBar" data-bs-backdrop="static" tabindex="-1">
    <form action="{{ route('product-categories.store-multiple') }}" method="POST" name="itemAddForm" id="itemAddForm" class="itemAddForm" enctype="multipart/form-data">
        @csrf
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title">Add Multiple Product Categories</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body overflow-auto" style="max-height: calc(100vh - 130px);">
            <div id="category-fields-list">
                <!-- Dynamic fields will be appended here -->
            </div>
            <button type="button" class="btn btn-success btn-sm" id="addCategoryFieldBtn">
                <i data-feather="plus"></i> Add More
            </button>
        </div>
        <div class="offcanvas-footer border-top p-2">
            <button type="submit" class="btn btn-primary itemAddBtn">Save All</button>
            <button type="button" class="btn btn-danger ms-auto" data-bs-dismiss="offcanvas">Cancel</button>
        </div>
    </form>
</div>

<script>
    // Initial field template
    function getCategoryField(index = '') {
        return `
        <div class="category-field mb-3 border p-2 rounded">
            <div class="mb-2">
                <label>Name <span class="text-danger">*</span></label>
                <input type="text" class="form-control" name="categories[${index}][name]" required>
            </div>
            <div class="mb-2">
                <label>Status <span class="text-danger">*</span></label>
                <div>
                    <input type="radio" name="categories[${index}][is_active]" value="1" checked> Active
                    <input type="radio" name="categories[${index}][is_active]" value="0"> Inactive
                </div>
            </div>
            <button type="button" class="btn btn-danger btn-sm removeCategoryFieldBtn">Remove</button>
        </div>
        `;
    }

    let categoryFieldCount = 0;
    function addCategoryField() {
        $('#category-fields-list').append(getCategoryField(categoryFieldCount));
        categoryFieldCount++;
    }

    $(document).ready(function() {
        // Add first field on open
        $('#offcanvasAddItemSideBar').on('show.bs.offcanvas', function () {
            $('#category-fields-list').html('');
            categoryFieldCount = 0;
            addCategoryField();
        });

        // Add more fields
        $('#addCategoryFieldBtn').on('click', function() {
            addCategoryField();
        });

        // Remove field
        $(document).on('click', '.removeCategoryFieldBtn', function() {
            $(this).closest('.category-field').remove();
        });
    });
</script>