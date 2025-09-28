<?php

namespace App\Services;

use App\Models\Product;

class ProductService
{

      public function getAllProducts($isPaginate = true)
    {
        $query = Product::query()
            ->orderBy('id', 'desc')
            ->search();

        return $isPaginate ? $query->paginate(maxPaginateNo()) : $query->get();
    }

    public function deleteProduct($id)
    {
        return Product::query()->where('id', $id)->delete();
    }

    public function findById($id)
    {
        return Product::query()->findOrFail($id);
    }

    public function updateProduct($data, $id)
    {
        return Product::query()->findOrFail($id)->update($data);
    }

      public function getProductById($id){
        return Product::query()->findOrFail($id);
    }

}