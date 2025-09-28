@forelse($products as $product)
    <tr>
        <td class="text-center">{{ $loop->iteration }}</td>
        <td>{{ $product->name }}</td>
        <td>{{ $product->description }}</td>

        <td>
            @if(!empty($product->image))
                <img src="{{ asset('img/products/' . $product->image) }}" 
                class="img-thumbnail shadow-sm"
                style="width: 80px; height: 80px; object-fit: cover;" 
                alt="Product Image">
          @endif

        </td>

        <td>{{ $product->old_price }}</td>
        <td>{{ $product->new_price }}</td>

        <td class="text-center">
            @if ($product->is_active)
                <span class="badge bg-success">Active</span>
            @else
                <span class="badge bg-danger">Inactive</span>
            @endif
        </td>

        <td class="text-center">
            <!-- Edit Button -->
            <button type="button"
                    class="editUser btn btn-sm btn-primary me-2"
                    title="Edit Product"
                    data-id="{{ $product->id }}"
                    data-bs-toggle="offcanvas"
                    data-bs-target="#offcanvasAddUserSideBar">
                <i data-feather="edit"></i>
            </button>
            <!-- Delete Button -->
            <button type="button"
                    class="deleteUser btn btn-sm btn-danger"
                    title="Delete Product"
                    data-id="{{ $product->id }}">
                <i data-feather="trash-2"></i>
            </button>
        </td>
    </tr>
@empty
    <tr>
        <td colspan="7" class="text-center">No Product Found</td>
    </tr>
@endforelse

{{-- Pagination Footer --}}
<tr>
    <td colspan="7" class="text-end">
        {{ $products->links('common.page-info') }}
    </td>
</tr>

<script src="https://unpkg.com/feather-icons"></script>
<script>
    feather.replace();
</script>