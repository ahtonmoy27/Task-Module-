@extends('layouts.main')

@section('page_title')
    @include('pages.products.header')
@endsection


@section('content')
    <section class="mb-4">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header border-0 bg-transparent pb-0">
                            <div class="row g-3">
                                <div class="col-auto flex-grow-1">
                                    <div class="tt-search-box w-auto">
                                        <div class="input-group">
                                            <span class="position-absolute top-50 start-0 translate-middle-y ms-2"> <i
                                                    data-feather="search" class="icon-16"></i></span>
                                            <input class="form-control rounded-start form-control-sm" id="f_name"
                                                name="f_name" type="text" placeholder="Name...">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <button type="button" class="btn btn-sm btn-dark btn-sm" id="searchBtn">
                                        <i data-feather="search" class="icon-14"></i>
                                        Search
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="card-body table-responsive productsListWrapper">
                            <table class="table table-bordered tt-footable table-sm" data-use-parent-width="true">
                                <thead>
                                    <tr>
                                        <th data-breakpoints="xs" data-type="number" class="text-center">S/L</th>
                                        <th class="text-center">Name</th>
                                        <th class="text-center">Description</th>
                                        <th class="text-center">Image</th>
                                        <th class="text-center">Old price</th>
                                        <th class="text-center">New price </th>

                                        <th class="text-center" data-breakpoints="xs">Status</th>
                                        <th class="text-center" data-breakpoints="xs sm md">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- offcanvas right start-->
    <!-- Offcanvas -->
    @include('pages.products.add_product_sidebar')
    <!-- offcanvas right end-->
@endsection

@push('js')
    <script>
        function loadProducts() {
            loadingInTable(".productsListWrapper tbody", {
                colSpan: 5,
                prop: false,
            });

            let callParams = {};
            callParams.url = "{{ route('products.index') }}" + (gFilterObj ? '?' + $.param(gFilterObj) : '');
            callParams.type = "GET";
            callParams.dataType = "JSON";

            ajaxCall(callParams, function(response) {
                resetLoading('.productsListWrapper tbody')
                $('.productsListWrapper tbody').html(response.data);

            });
        }

        loadProducts();

        // search
        $('body').on('click', '#searchBtn', function(e) {
            e.preventDefault();
            loadingInTable("tbody", {
                colSpan: 5,
                prop: false,
            });

            gFilterObj.name = $('#f_name').val();

            if (gFilterObj.hasOwnProperty('page')) {
                delete gFilterObj.page;
            }

            loadProducts();
        });

        // // // submit the add and edit user form
        $(document).on('click', '.userAddBtn', function(e) {
            e.preventDefault();
            
            resetFormErrors('form#userAddForm');
            loading('.userAddBtn', 'Saving...');

            var callParams = {};
            callParams.type = "POST";
            callParams.url = $("form#userAddForm").attr("action");
            callParams.data = new FormData($('.userAddForm')[0]);
            callParams.processData = false;
            callParams.contentType = false;

            ajaxCall(callParams, function(result) {
                console.log(result);

                resetLoading('.userAddBtn', 'Save');
                resetForm('.userAddForm');
                toast(result.message);

                loadProducts();
                $('#offcanvasAddUserSideBar').offcanvas('hide');

            }, function(err, type, httpStatus) {
                showFormError(err, '.userAddForm');
                resetLoading('.userAddBtn', 'Save');
            });

            return false;

        });

        // when click on add button
        $('body').on('click', '.addUserSideBarBtn', function() {
            $('#offcanvasAddUserSideBar .offcanvas-title').text("{{ 'Add New Product' }}");
            resetFormErrors('form#userAddForm');
            resetForm('form#userAddForm');
            showElement('.password_wrapper');
            $('form#offcanvasAddUserSideBar input:hidden[name=_method]').val('POST');
            $('form#offcanvasAddUserSideBar').attr('action', "{{ route('products.store') }}");
            resetLoading(".userAddBtn", "Add Product");
        })

        // when click on edit button
        $('body').on('click', '.editUser', function() {
            let userId = parseInt($(this).data("id")) ?? 0;

            let actionUrl = "{{ route('products.edit', ['id' => ':id']) }}".replace(':id', userId);



            $('#offcanvasAddUserSideBar .offcanvas-title').text('Update Product');
            $('#offcanvasAddUserSideBar').offcanvas('show');

            resetLoading(".userAddBtn", "Edit Product");

            resetForm('form#userAddForm');
            resetFormErrors('form#userAddForm');
            hideElement('.password_wrapper');

            $('form#userAddForm').attr('action', "{{ route('products.update', ['id' => ':id']) }}".replace(':id',
                userId));

            let callParams = {};

            callParams.type = "GET";
            callParams.url = "{{ route('products.edit', ['id' => ':id']) }}".replace(':id', userId);
            callParams.data = "";
            ajaxCall(callParams, function(result) {
               

                if (result.data) {
                    let user = result.data;
                    console.log(user);
                    $('#offcanvasAddUserSideBar #id').val(user.id);

                    $('#offcanvasAddUserSideBar #product_category_id').val(user.product_category_id);
                    $('#offcanvasAddUserSideBar #product_sub_category_id').val(user.product_sub_category_id);
                    $('#offcanvasAddUserSideBar #name').val(user.name);
                    $('#offcanvasAddUserSideBar #description').val(user.description);
                    $('#offcanvasAddUserSideBar #old_price').val(user.old_price);
                    $('#offcanvasAddUserSideBar #new_price').val(user.new_price);
                       if (user.image) {
                        $('#offcanvasAddUserSideBar #image').attr('src', '/img/products/' + user.image).show();
                    }
                    if (parseInt(user.is_active) == 1) {
                        $('#offcanvasAddUserSideBar #active').prop('checked', true);
                    } else {
                        $('#offcanvasAddUserSideBar #inactive').prop('checked', true);
                    }

                    
                }
            }, function(err, type, httpStatus) {

            });

        });


        $(document).on('click', '.deleteUser', function(e) {
            e.preventDefault();
            console.log("dl");
            let userId = parseInt($(this).data("id")) ?? 0;
            console.log(userId);

            let callParams = {};
            callParams.url = "{{ route('products.delete', ['id' => ':id']) }}".replace(':id', userId);
            console.log(callParams);
            callParams.type = "POST";
            callParams.data = "";

            ajaxCall(callParams, function(result) {
                console.log(result);
                toast(result.message);
                loadProducts();

            }, function(err, type, httpStatus) {

            });

        })
    </script>
@endpush
