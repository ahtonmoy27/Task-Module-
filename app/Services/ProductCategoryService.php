<?php

namespace App\Services;

use App\Models\ProductCategory;

class ProductCategoryService
{
    public function getAll($isPaginate = true)
    {
        $query = ProductCategory::query()
            ->orderBy('id', 'desc')
            ->search();

        return $isPaginate ? $query->paginate(maxPaginateNo()) : $query->get();
    }


    public function store(array $payloads)
    {
        return ProductCategory::query()->create($payloads);
    }
    public function delete($id)
    {
        return ProductCategory::query()->where('id', $id)->delete();
    }
    public function findById($id)
    {
        return ProductCategory::query()->findOrFail($id);
    }
    // public function update($data, $id)
    // {
    //     return ProductCategory::query()->findOrFail($id)->update($data);
    // }

     public function update($data, $id)
    {
        return ProductCategory::query()->findOrFail($id)->update($data);
    }
    public function getById($id)
    {
        return ProductCategory::query()->findOrFail($id);
    }
}
