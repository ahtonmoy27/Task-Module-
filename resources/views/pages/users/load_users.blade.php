@if ($users)
    @foreach ($users as $user)
        <tr>
            <td class="text-center">{{ $loop->iteration }}</td>
            <td class="">{{ $user->name }}</td>
            <td class="">{{ $user->email }}</td>
            <td class="">{{ $user->created_at }}</td>
            <td class="">
                <a href="#" class="editUser btn btn-primary" data-id="{{ $user->id }}" data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasAddUserSideBar">Edit User</a>
                <a href="#" class="deleteUser btn btn-danger" data-id="{{ $user->id }}">Delete User</a>
            </td>
        </tr>
     
    @endforeach
@else
    <tr>
        <td colspan="5">No User Found</td>
    </tr>
@endif
