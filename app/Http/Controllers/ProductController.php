<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Traits\ApiResponseTrait;
use App\Traits\ImageUploadTrait;
use App\Services\ProductCategoryService;
use App\Services\ProductSubCategoryService;
use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;

class ProductController extends Controller
{
    use ApiResponseTrait, ImageUploadTrait;
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
                view('pages.products.load_products', ['products' => $products])->render()
            );
        }
        return view('pages.products.index', compact('productCategory', 'productSubCategory'));
    }

    public function store(CreateProductRequest $request)
    {
        $data = $request->getProductData();

        $filename = null;
        $path = null;

        if ($request->hasFile('image')) {
            $file = $request->file('image'); // single file
            $path = 'img/products/';
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path($path), $filename);
        }

        $data['image'] = $filename;
        //  dd($data);
        $result = Product::query()->create($data);
        return $this->sendResponse(
            appStatic()::SUCCESS,
            'Successfully added the product.',
            $result
        );
    }

    function edit(Request $request, $id)
    {
        if ($request->ajax()) {
            $product = Product::query()->where("id", $id)->first();

            return $this->sendResponse(
                appStatic()::SUCCESS,
                'Successfully loaded the product.',
                $product
            );
        }
    }
    public function update(UpdateProductRequest $request, $id)
    {
        $data = $request->getProductData($id);
        $product = $this->productService->getProductById($id);

        $filename = null;
        $path = 'img/products/';

        if ($request->hasFile('image')) {

            // if (!empty($product['image'])) {
            //     $oldImagePath = public_path($path . $product['image']);
            //     $this->deleteImage($oldImagePath);
            // }

            $file = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path($path), $filename);
        }

        $data['image'] = $filename ?? $product['image'];

        $result = $this->productService->updateProduct($data, $id);

        return $this->sendResponse(
            appStatic()::SUCCESS,
            'Successfully updated the product.',
            $result
        );
    }


    public function show($slug)
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        return view('frontend.home.product_details', compact('product'));
    }
    public function delete($id)
    {
        $product = $this->productService->getProductById($id);
        // dd($product);
        $result =  $this->productService->deleteProduct($id);
        return $this->sendResponse(
            appStatic()::SUCCESS,
            'Successfully Deleted the product',
            $result
        );
    }
}
