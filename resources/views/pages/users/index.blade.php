@extends('layouts.main')

@section('page_title')
    @include('pages.users.header')
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
                                <div class="col-auto flex-grow-1">
                                    <div class="tt-search-box w-auto">
                                        <div class="input-group">
                                            <span class="position-absolute top-50 start-0 translate-middle-y ms-2"> <i
                                                    data-feather="search" class="icon-16"></i></span>
                                            <input class="form-control rounded-start form-control-sm" id="f_email"
                                                name="f_email" type="text" placeholder="Email">
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="col-auto">
                                <div class="input-group">
                                    <select class="form-select form-select-sm">
                                        <option selected="">Status</option>
                                        <option>Published</option>
                                        <option>Hidden</option>
                                    </select>
                                </div>
                            </div> --}}
                                <div class="col-auto">
                                    <button type="button" class="btn btn-sm btn-dark btn-sm" id="searchBtn">
                                        <i data-feather="search" class="icon-14"></i>
                                        Search
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="card-body table-responsive usersListWrapper">
                            <table class="table table-bordered tt-footable table-sm" data-use-parent-width="true">
                                <thead>
                                    <tr>
                                        <th data-breakpoints="xs" data-type="number" class="text-center">S/L</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th data-breakpoints="xs">Created</th>
                                        <th data-breakpoints="xs sm md" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                        @if ($users->hasPages())
                            <tr>
                                <td colspan="5">
                                    {!! $users->links('pagination::bootstrap-4') !!}
                                </td>
                            </tr>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- offcanvas right start-->
    <!-- Offcanvas -->
    @include('pages.users.add_user_sidebar')
    <!-- offcanvas right end-->
@endsection

@push('js')
    <script>
        function loadUsers() {
            loadingInTable(".usersListWrapper tbody", {
                colSpan: 5,
                prop: false,
            });

            let callParams = {};
            callParams.url = "{{ route('users.index') }}" + (gFilterObj ? '?' + $.param(gFilterObj) : '');
            callParams.type = "GET";
            callParams.dataType = "JSON";

            ajaxCall(callParams, function(response) {
                resetLoading('.usersListWrapper tbody')
                $('.usersListWrapper tbody').html(response.data);

            });
        }

        loadUsers();

        // search
        $('body').on('click', '#searchBtn', function(e) {
            e.preventDefault();
            loadingInTable("tbody", {
                colSpan: 5,
                prop: false,
            });

            gFilterObj.name = $('#f_name').val();
            gFilterObj.email = $('#f_email').val();

            if (gFilterObj.hasOwnProperty('page')) {
                delete gFilterObj.page;
            }

            loadUsers();
        });

        // submit the add and edit user form
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

                loadUsers();
                $('#offcanvasAddUserSideBar').offcanvas('hide');

            }, function(err, type, httpStatus) {
                showFormError(err, '.userAddForm');
                resetLoading('.userAddBtn', 'Save');
            });

            return false;

        });

        // when click on add button
        $('body').on('click', '.addUserSideBarBtn', function() {
            $('#offcanvasAddUserSideBar .offcanvas-title').text("{{ 'Add New User' }}");
            resetFormErrors('form#userAddForm');
            resetForm('form#userAddForm');
            showElement('.password_wrapper');
            $('form#offcanvasAddUserSideBar input:hidden[name=_method]').val('POST');
            $('form#offcanvasAddUserSideBar').attr('action', "{{ route('users.store') }}");
            resetLoading(".userAddBtn", "Add User");
        })

        // when click on edit button
        $('body').on('click', '.editUser', function() {
            let userId = parseInt($(this).data("id")) ?? 0;

            let actionUrl = "{{ route('users.edit', ['id' => ':id']) }}".replace(':id', userId);
            // let updateUrl = "{{ route('users.update', ['id' => ':id']) }}".replace(':id', userId);


            $('#offcanvasAddUserSideBar .offcanvas-title').text('Update User');
            $('#offcanvasAddUserSideBar').offcanvas('show');

            resetLoading(".userAddBtn", "Edit User");

            resetForm('form#userAddForm');
            resetFormErrors('form#userAddForm');
            hideElement('.password_wrapper');

            $('form#userAddForm').attr('action', "{{ route('users.update', ['id' => ':id']) }}".replace(':id',
                userId));

            let callParams = {};

            callParams.type = "GET";
            callParams.url = "{{ route('users.edit', ['id' => ':id']) }}".replace(':id', userId);
            callParams.data = "";
            // loadingInContent('#loader', 'loading...');
            // hideElement('.offcanvas-body');
            ajaxCall(callParams, function(result) {
                console.log(result);

                // resetLoading('#loader', '');
                // showElement('.offcanvas-body');
                if (result.data) {
                    let user = result.data;
                    // $('#offcanvasAddUserSideBar input[name="_method"]').val("PUT");
                    $('#offcanvasAddUserSideBar #id').val(user.id);
                    $('#offcanvasAddUserSideBar #name').val(user.name);
                    $('#offcanvasAddUserSideBar #email').val(user.email);
                }
            }, function(err, type, httpStatus) {

            });

        });

        // Handle pagination links (AJAX)
        $('body').on('click', '.pagination a', function(e) {
            e.preventDefault();
            let url = $(this).attr('href');
            let callParams = {};
            callParams.url = url;
            callParams.type = "GET";
            callParams.dataType = "JSON";
            ajaxCall(callParams, function(response) {
                $('.usersListWrapper tbody').html(response.data);
            });
        });

        $(document).on('click', '.deleteUser', function(e) {
            e.preventDefault();
            // console.log("dl");
            let userId = parseInt($(this).data("id")) ?? 0;
            console.log(userId);

            let callParams = {};
            callParams.url = "{{ route('users.delete', ['id' => ':id']) }}".replace(':id', userId);
            console.log(callParams);
            callParams.type = "POST";
            callParams.data = "";

            ajaxCall(callParams, function(result) {
                console.log(result);
                toast(result.message);
                loadUsers();

            }, function(err, type, httpStatus) {

            });

        })
    </script>
@endpush
