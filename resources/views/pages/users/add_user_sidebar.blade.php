<div class="offcanvas offcanvas-end" id="offcanvasAddUserSideBar" data-bs-backdrop="static" tabindex="-1">
    <form action="{{ route('users.store') }}" method="POST" name="userAddForm" id="userAddForm" class="userAddForm" enctype="multipart/form-data">
        @csrf
        @method("POST")
        <input type="hidden" name="id" id="id" value="">
        <div class="offcanvas-header border-bottom">
            <h5 class="offcanvas-title">Add New User</h5>
            <span class="tt-close-btn" data-bs-dismiss="offcanvas">
            <i data-feather="x"></i>
        </span>
        </div>
        <div class="offcanvas-body overflow-auto" style="max-height: calc(100vh - 130px);">

            <!-- Text input -->
            <div class="mb-4">
                <label for="name" class="form-label">User Name</label>
                <input class="form-control" type="text" name="name" id="name" value="" placeholder="Enter user name">
            </div>
            <div class="mb-4">
                <label for="email" class="form-label">User Email</label>
                <input class="form-control" type="email" name="email" id="email" value="" placeholder="Enter user email">
            </div>
            <div class="mb-4 password_wrapper">
                <label for="password" class="form-label">User Password</label>
                <input class="form-control" type="password" name="password" id="password" value="" placeholder="*********">
            </div>
            <div class="mb-4 ">
                <label for="image" class="form-label">User Profile Picture</label>
                <input class="form-control" type="file" name="image" id="image" value="" placeholder="insert your image">
            </div>

        </div>
        <div class="offcanvas-footer border-top">
            <div class="d-flex gap-3">
                <button type="button" class="btn btn-sm btn-primary userAddBtn">Add User</button>
            </div>
        </div>
    </form>
</div>