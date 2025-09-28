<div class="offcanvas offcanvas-end" id="offcanvasAddItemSideBar" data-bs-backdrop="static" tabindex="-1">
    <form action="{{ route('product-sub-categories.store') }}" method="POST" name="itemAddForm" id="itemAddForm" class="itemAddForm" enctype="multipart/form-data">
        @csrf
        @method("POST")
        <input type="hidden" name="id" id="id" value="">

        <!-- Header -->
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title">Add New Product Category</h5>
            <span class="tt-close-btn" data-bs-dismiss="offcanvas">
                <i data-feather="x"></i>
            </span>
        </div>

        <!-- Body -->
        <div class="offcanvas-body overflow-auto" style="max-height: calc(100vh - 130px);">
            
            <!-- Name -->
            <div class="mb-3 row">
                <label for="name" class="col-sm-2 col-form-label">
                    Name <span class="text-danger">*</span>
                </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name">
                </div>
            </div>

            {{-- Product Category  --}}
             <div class="mb-3 row">
                <label for="product_category_id" class="col-sm-2 col-form-label">Product category <span class="text-danger">*</span></label>
                <div class="col-sm-10">
                    <select class="form-select" id="product_category_id" name="product_category_id">
                        <option value="" selected disabled>Select Product</option>
                        @foreach($productCategory as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
      
            <!-- Status -->
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">
                    Status <span class="text-danger">*</span>
                </label>
                <div class="col-sm-10 d-flex align-items-center gap-3">
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="is_active" id="active" value="1">
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
        <div class="offcanvas-footer border-top">
            <div class="d-flex w-100">
                <!-- Add Item Button -->
                <button type="submit" class="btn btn-sm btn-primary text-white itemAddBtn">
                    Add Product Category
                </button>

                <!-- Cancel Button -->
                <button type="button" class="btn btn-sm btn-danger ms-auto" data-bs-dismiss="offcanvas">
                    Cancel
                </button>
            </div>
        </div>
    </form>
</div>
