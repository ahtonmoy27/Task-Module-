<?php

namespace App\Http\Controllers\Backend;

use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Services\ProductCategoryService;
use App\Http\Requests\ProductCategory\CreateProductCategoryRequest;

class ProductCategoryController extends Controller
{
    use ApiResponseTrait;
    protected $productCategoryService = null;

    public function __construct()
    {
        $this->productCategoryService = new ProductCategoryService();
    }
    public function index(Request $request)
    {
        $data = $this->productCategoryService->getAll(request());

        if ($request->ajax()) {
            return $this->sendResponse(
                appStatic()::SUCCESS,
                'Successfully loaded the Product Categories.',
                view('backend.product-categories.list-show', ['product_categories' => $data])->render()
            );
        }
        return view('backend.product-categories.index');
    }

    public function store(CreateProductCategoryRequest $request)
    {
        $data = $request->getData();
        $result = $this->productCategoryService->store($data);

        return $this->sendResponse(
            appStatic()::SUCCESS,
            'Successfully added the product category.',
            $result
        );
    }

    public function storeMultiple(Request $request)
    {
        $categories = $request->input('categories', []);

        $saved = [];
        foreach ($categories as $categoryData) {
            $saved[] = $this->productCategoryService->store($categoryData);
        }

        return $this->sendResponse(
            appStatic()::SUCCESS,
            'Successfully added all product categories.',
            $saved
        );
    }



    function edit(Request $request, $id)
    {
        if ($request->ajax()) {
            $data = $this->productCategoryService->findById($id);
            return $this->sendResponse(
                appStatic()::SUCCESS,
                'Successfully loaded the product category.',
                $data
            );
        }
    }

    public function update(CreateProductCategoryRequest $request, $id)
    {
        $data = $request->getData($id);
        $category = $this->productCategoryService->findById($id);
        $result = $this->productCategoryService->update($data, $id);

        return $this->sendResponse(
            appStatic()::SUCCESS,
            'Successfully updated the product category.',
            $data
        );
    }

    public function delete($id)
    {
        $data = $this->productCategoryService->getById($id);

        $result =  $this->productCategoryService->delete($id);
        return $this->sendResponse(
            appStatic()::SUCCESS,
            'Successfully Deleted the Product Category',
            $result
        );
    }
}
