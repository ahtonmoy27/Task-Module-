<div class="offcanvas offcanvas-end" id="offcanvasAddUserSideBar" data-bs-backdrop="static" tabindex="-1">
    <form action="{{ route('products.store') }}" method="POST" name="userAddForm" id="userAddForm" class="userAddForm" enctype="multipart/form-data">
        @csrf
        @method("POST")
        <input type="hidden" name="id" id="id" value="">

        <!-- Header -->
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title">Add New Product</h5>
            <span class="tt-close-btn" data-bs-dismiss="offcanvas">
                <i data-feather="x"></i>
            </span>
        </div>
        <!-- Body -->
        <div class="offcanvas-body overflow-auto" style="max-height: calc(100vh - 130px);">

            {{-- Product Category --}}
            <div class="mb-3 row">
                <label for="product_category_id" class="col-sm-2 col-form-label">Product category</label>
                <div class="col-sm-10">
                    <select class="form-select" id="product_category_id" name="product_category_id">
                        <option value="" selected disabled>Select Product</option>
                        @foreach($productCategory as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            {{-- Product Sub Category --}}
            <div class="mb-3 row">
                <label for="product_sub_category_id" class="col-sm-2 col-form-label">Product Sub category</label>
                <div class="col-sm-10">
                    <select class="form-select" id="product_sub_category_id" name="product_sub_category_id">
                        <option value="" selected disabled>Select Product</option>
                        @foreach($productSubCategory as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Product Name -->
            <div class="mb-3 row">
                <label for="name" class="col-sm-2 col-form-label">Product Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" placeholder="Enter Product Name">
                </div>
            </div>
          <!-- Product Picture -->
            <div class="mb-4">
                <label for="image" class="form-label">Product Picture</label>
                <input class="form-control" type="file" name="image" id="image">
            </div>
            <!-- Description -->
            <div class="mb-3 row">
                <label for="description" class="col-sm-2 col-form-label">Product Description</label>
                <div class="col-sm-10">
                    <textarea class="form-control" id="description" name="description" rows="4" placeholder="Enter Description"></textarea>
                </div>
            </div>
          <!-- Old Price -->
             <div class="mb-3 row">
                <label for="old_price" class="col-sm-2 col-form-label">Old Price</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="old_price" name="old_price" placeholder="Enter Old Price">
                </div>
            </div>
          <!-- New Price -->
             <div class="mb-3 row">
                <label for="new_price" class="col-sm-2 col-form-label">New Price </label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="new_price" name="new_price" placeholder="Enter New Price">
                </div>
            </div>
            <!-- Status -->
            <div class="mb-3 row">
                <label class="col-sm-2 col-form-label">Status</label>
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
                <!-- Add Button -->
                <button type="submit" class="btn btn-sm text-white userAddBtn" style="background-color: rgb(51, 28, 231);">
                    Add Product
                </button>
                <!-- Cancel Button -->
                <button type="button" class="btn btn-sm btn-danger ms-auto" data-bs-dismiss="offcanvas">Cancel</button>
            </div>
        </div>
    </form>
</div>
