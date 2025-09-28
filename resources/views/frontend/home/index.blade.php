@extends('layouts.master')

@section('page_title')
       @include('frontend.home.header')
@endsection
@section('content')
<section class="mb-4">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header border-0 bg-transparent pb-0">
                        <div class="row g-3">
                              <div class="col-sm-5">
                                 <select class="form-select" id="product_category_id" name="product_category_id">
                                    <option value="" selected disabled>Select Category</option>
                                    @foreach($productCategory as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            
                              <div class="col-sm-5">
                                    <select class="form-select" id="product_sub_category_id" name="product_sub_category_id">
                                        <option value="" selected disabled>Select Subcategory</option>
                                         @foreach($productSubCategory as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                 </div>
                            {{-- search button click --}}
                            <div class="col-auto">
                                <button type="button" class="btn btn-sm btn-primary btn-sm" id="searchBtn">
                                    <i data-feather="search" class="icon-14"></i>
                                    Search
                                </button>
                            </div>
                        </div>
                    </div>

                    <div class="card-body table-responsive productsListWrapper d-flex flex-wrap ">
                        
                    </div>

                    {{-- page show area  --}}
                    {{-- <div class="card-footer border-0 pt-0 bg-transparent">
                        <div class="d-flex align-items-center justify-content-between">
                            <span>Showing 4 Out of 25</span>
                            <nav>
                                <ul class="pagination">
                                    <li class="page-item">
                                        <a class="page-link" href="#" aria-label="Previous">
                                            <i data-feather="chevron-left"></i>
                                        </a>
                                    </li>
                                    <li class="page-item d-sm-none"><span class="page-link page-link-static">2 / 5</span></li>
                                    <li class="page-item d-none d-sm-block"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item active d-none d-sm-block" aria-current="page"><span class="page-link">2<span
                                    class="visually-hidden">(current)</span></span></li>
                                    <li class="page-item d-none d-sm-block"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item d-none d-sm-block"><a class="page-link" href="#">4</a></li>
                                    <li class="page-item d-none d-sm-block"><a class="page-link" href="#">5</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="#" aria-label="Next">
                                            <i data-feather="chevron-right"></i>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</section>
<!-- offcanvas right start-->
<!-- Offcanvas -->
<!-- offcanvas right end-->
@endsection

@push('js')
 
<script>
       function loadProducts(){
        loadingInTable(".productsListWrapper", {
                    colSpan: 8,
                    prop: false,
        });
            let callParams ={};
            callParams.url = "{{ route('home.index') }}" + (gFilterObj ? '?' + $.param(gFilterObj) : '' );
            callParams.type="GET";
            callParams.dataTye = "JSON";
            // console.log(callParams);
           ajaxCall(callParams,function(response){
               console.log(response);
            resetLoading('.productsListWrapper')
            $('.productsListWrapper').html(response.data);

           });
        
       }

        loadProducts();

      $(document).on('click', '#searchBtn', function(e) {
            e.preventDefault();
            gFilterObj.product_category_id = $('#product_category_id').val();
            gFilterObj.product_sub_category_id = $('#product_sub_category_id').val();
            loadProducts();
        });



    //    $('#product_category_id').on('change', function() {
    //         let categoryId = $(this).val();
    //         $('#product_sub_category_id').html('<option value="" selected disabled>Loading...</option>');
    //         $.ajax({
    //             url: "{{ url('/get-subcategories') }}", // You will create this route
    //             type: "GET",
    //             data: { category_id: categoryId },
    //             success: function(response) {
    //                 let options = '<option value="" selected disabled>Select Subcategory</option>';
    //                 $.each(response.subcategories, function(index, subcat) {
    //                     options += `<option value="${subcat.id}">${subcat.name}</option>`;
    //                 });
    //                 $('#product_sub_category_id').html(options);
    //             }
    //         });
    //     });

  
</script>
@endpush