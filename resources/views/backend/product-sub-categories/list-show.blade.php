
   @forelse($product_sub_categories as $sub_category)
        <tr>
            <td class="text-center">{{ $loop->iteration }}</td>
            <td>{{ $sub_category->name }}</td>
            <td>{{ $sub_category->productCategory->name }}</td>
            <td class="text-center">
                @if ($sub_category->is_active)
                    <span class="badge bg-success">Active</span>
                @else
                    <span class="badge bg-danger">Inactive</span>
                @endif
            </td>

            <td class="text-center">
                <!-- Edit Button -->
                <button type="button"
                        class="editItem btn btn-sm btn-primary me-2"
                        title="Edit Product sub_category"
                        data-id="{{ $sub_category->id }}"
                        data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasAddItemSideBar">
                    <i data-feather="edit"></i>
                </button>

                <!-- Delete Button -->
                <button type="button"
                        class="deleteItem btn btn-sm btn-danger"
                        title="Delete Product sub_category"
                        data-id="{{ $sub_category->id }}">
                    <i data-feather="trash-2"></i>
                </button>
            </td>
        </tr>
@empty
    <tr>
        <td colspan="6" class="text-center">No Supplier Found</td>
    </tr>
@endforelse

{{-- Pagination Footer --}}
<tr>
    <td colspan="6" class="text-end">
        {{ $product_sub_categories->links('common.page-info') }}
    </td>
</tr>


<script src="https://unpkg.com/feather-icons"></script>
<script>
  feather.replace();
</script>