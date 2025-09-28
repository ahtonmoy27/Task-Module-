<?php

namespace App\Http\Controllers\Fronted;

use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Traits\ApiResponseTrait;
use App\Traits\ImageUploadTrait;
use App\Http\Controllers\Controller;
use App\Services\ProductCategoryService;
use App\Services\ProductSubCategoryService;

class HomeController extends Controller
{
    use ApiResponseTrait,ImageUploadTrait;
    protected $productService = null;
    protected $productCategoryService = null;
    protected $productSubCategoryService = null;

    public function __construct()
    {
        $this->productService = new ProductService();
        $this->productCategoryService =  new ProductCategoryService();
        $this->productSubCategoryService =  new ProductSubCategoryService();
    }
    public function index(Request $request)
    {
        $products = $this->productService->getAllProducts(request());
        $productCategory = $this->productCategoryService->getAll(request());
        $productSubCategory = $this->productSubCategoryService->getAll(request());

        if ($request->ajax()) {
            return $this->sendResponse(
                appStatic()::SUCCESS,
                'Successfully loaded the Product.',
                view('frontend.home.load_products', ['products' => $products])->render()
            );
        }
        return view('frontend.home.index', compact('productCategory', 'productSubCategory'));
    }

}
