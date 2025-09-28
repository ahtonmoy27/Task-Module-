

    <script>
         'use strict';
        function loadProductCategories() {
            loadingInTable(".indexListWrapper tbody", {
                colSpan: 5,
                prop: false,
            });

            let callParams = {};
            callParams.url = "{{ route('product-sub-categories.index') }}" + (gFilterObj ? '?' + $.param(gFilterObj) : '');
            callParams.type = "GET";
            callParams.dataType = "JSON";

            ajaxCall(callParams, function(response) {
                resetLoading('.indexListWrapper tbody')
                $('.indexListWrapper tbody').html(response.data);

            });
        }
        loadProductCategories();
       

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

            loadProductCategories();
        });

        // // submit the add and edit item form
        $(document).on('click', '.itemAddBtn', function(e) {
            e.preventDefault();
            
            resetFormErrors('form#itemAddForm');
            loading('.itemAddBtn', 'Saving...');

            var callParams = {};
            callParams.type = "POST";
            callParams.url = $("form#itemAddForm").attr("action");
            callParams.data = new FormData($('.itemAddForm')[0]);
            callParams.processData = false;
            callParams.contentType = false;

            ajaxCall(callParams, function(result) {
                console.log(result);

                resetLoading('.itemAddBtn', 'Save');
                resetForm('.itemAddForm');
                toast(result.message);

                loadProductCategories();
                $('#offcanvasAddItemSideBar').offcanvas('hide');

            }, function(err, type, httpStatus) {
                showFormError(err, '.itemAddForm');
                resetLoading('.itemAddBtn', 'Save');
            });

            return false;

        });

        // // when click on add button
        $('body').on('click', '.addItemSideBarBtn', function() {
            $('#offcanvasAddItemSideBar .offcanvas-title').text("{{ 'Add New Product Category' }}");
            resetFormErrors('form#itemAddForm');
            resetForm('form#itemAddForm');
            showElement('.password_wrapper');
            $('form#offcanvasAddItemSideBar input:hidden[name=_method]').val('POST');
            $('form#offcanvasAddItemSideBar').attr('action', "{{ route('product-sub-categories.store') }}");
            resetLoading(".itemAddBtn", "Add Product Category");
        })

        // when click on edit button
        $('body').on('click', '.editItem', function() {
            let itemId = parseInt($(this).data("id")) ?? 0;

            let actionUrl = "{{ route('product-sub-categories.edit', ['id' => ':id']) }}".replace(':id', itemId);



            $('#offcanvasAddItemSideBar .offcanvas-title').text('Update Product Category');
            $('#offcanvasAddItemSideBar').offcanvas('show');

            resetLoading(".itemAddBtn", "Edit Product Category");

            resetForm('form#itemAddForm');
            resetFormErrors('form#itemAddForm');
            hideElement('.password_wrapper');

            $('form#itemAddForm').attr('action', "{{ route('product-sub-categories.update', ['id' => ':id']) }}".replace(':id',
                itemId));

            let callParams = {};

            callParams.type = "GET";
            callParams.url = "{{ route('product-sub-categories.edit', ['id' => ':id']) }}".replace(':id', itemId);
            callParams.data = "";

            ajaxCall(callParams, function(result) {
               
                if (result.data) {
                    let item = result.data;
                    console.log(item);
                    $('#offcanvasAddItemSideBar #id').val(item.id);
                    $('#offcanvasAddItemSideBar #name').val(item.name);
                    $('#offcanvasAddItemSideBar #product_category_id').val(item.product_category_id);

                    if (parseInt(item.is_active) == 1) {
                        $('#offcanvasAddItemSideBar #active').prop('checked', true);
                    } else {
                        $('#offcanvasAddItemSideBar #inactive').prop('checked', true);
                    }

                    
                }
            }, function(err, type, httpStatus) {

            });

        });

        $(document).on('click', '.deleteItem', function(e) {
            e.preventDefault();
            console.log("dl");
            let itemId = parseInt($(this).data("id")) ?? 0;
            console.log(itemId);

            let callParams = {};
            callParams.url = "{{ route('product-sub-categories.delete', ['id' => ':id']) }}".replace(':id', itemId);
            console.log(callParams);
            callParams.type = "POST";
            callParams.data = "";

            ajaxCall(callParams, function(result) {
                console.log(result);
                toast(result.message);
                loadProductCategories();

            }, function(err, type, httpStatus) {

            });

        })
    </script>
