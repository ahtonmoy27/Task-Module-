<?php

namespace App\Services;

use App\Models\ProductSubCategory;

class ProductSubCategoryService
{
    public function getAll($isPaginate = true)
    {
        $query = ProductSubCategory::query()
            ->orderBy('id', 'desc')
            ->search();

        return $isPaginate ? $query->paginate(maxPaginateNo()) : $query->get();
    }


    public function store(array $payloads)
    {
        return ProductSubCategory::query()->create($payloads);
    }
    public function delete($id)
    {
        return ProductSubCategory::query()->where('id', $id)->delete();
    }
    public function findById($id)
    {
        return ProductSubCategory::query()->findOrFail($id);
    }
    public function update($data, $id)
    {
        return ProductSubCategory::query()->findOrFail($id)->update($data);
    }
    public function getById($id)
    {
        return ProductSubCategory::query()->findOrFail($id);
    }
}
