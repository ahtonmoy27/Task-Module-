<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Services\ProductCategoryService;
use App\Services\ProductSubCategoryService;
use App\Http\Requests\ProductSubCategory\CreateProductSubCategoryRequest;

class ProductSubCategoryController extends Controller
{
    use ApiResponseTrait;

    protected $productSubCategoryService = null;
    protected $productCategoryService;

    public  function __construct()
    {
        $this->productSubCategoryService = new ProductSubCategoryService();
        $this->productCategoryService = new ProductCategoryService;
    }
    public function index(Request $request)
    {

        $productCategory = $this->productCategoryService->getAll(request());

        $data = $this->productSubCategoryService->getAll(request());
        if ($request->ajax()) {
            return $this->sendResponse(
                appStatic()::SUCCESS,
                'Successfully loaded the Product Categories.',
                view('backend.product-sub-categories.list-show', ['product_sub_categories' => $data])->render()
            );
        }
        return view('backend.product-sub-categories.index', compact('productCategory'));
    }

    public function store(CreateProductSubCategoryRequest $request)
    {
        $data = $request->getData();
        $result = $this->productSubCategoryService->store($data);

        return $this->sendResponse(
            appStatic()::SUCCESS,
            'Successfully added the product category.',
            $result
        );
    }


    function edit(Request $request, $id)
    {
        if ($request->ajax()) {
            $data = $this->productSubCategoryService->findById($id);
            return $this->sendResponse(
                appStatic()::SUCCESS,
                'Successfully loaded the product Sub category.',
                $data
            );
        }
    }

    public function update(CreateProductSubCategoryRequest $request, $id)
    {
        $data = $request->getData($id);
        $category = $this->productSubCategoryService->findById($id);
        $result = $this->productSubCategoryService->update($data, $id);

        return $this->sendResponse(
            appStatic()::SUCCESS,
            'Successfully updated the product sub category.',
            $data
        );
    }

    public function getByCategory(Request $request)
    {
        $categoryId = $request->category_id;
        $subcategories = \App\Models\ProductSubCategory::where('product_category_id', $categoryId)
            ->where('is_active', 1)
            ->get(['id', 'name']);
        return response()->json(['subcategories' => $subcategories]);
    }


    public function delete($id)
    {

        $data = $this->productSubCategoryService->getById($id);
        $result = $this->productSubCategoryService->delete($id);

        return $this->sendResponse(
            appStatic()::SUCCESS,
            'Successfully Deleted the Product Category',
            $result
        );
    }
}
