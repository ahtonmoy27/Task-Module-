@extends('layouts.main')

@section('page_title')
    @include('backend.product-categories.header')
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

                        <div class="card-body table-responsive indexListWrapper">
                            <table class="table table-bordered tt-footable table-sm" data-use-parent-width="true">
                                <thead>
                                    <tr>
                                        <th data-breakpoints="xs" data-type="number" class="text-center">S/L</th>
                                        <th class="text-center">Product Category</th>
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
    @include('backend.product-categories.add')
    <!-- offcanvas right end-->
@endsection
@push('js')
    @include('backend.product-categories.js')
@endpush
