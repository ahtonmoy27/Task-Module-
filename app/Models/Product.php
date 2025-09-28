<?php

namespace App\Models;


use App\Models\ProductCategory;
use Laravel\Sanctum\HasApiTokens;
use App\Models\ProductSubCategory;
use App\Traits\CreatedByUpdatedByIdTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Product extends Authenticatable
{
    use HasApiTokens, HasFactory, CreatedByUpdatedByIdTrait;

    protected $fillable = [
        'product_category_id',
        'product_sub_category_id',
        'name',
        'slug',
        'description',
        'old_price',
        'new_price',
        'image',
        'is_active',
        'created_by_id',
        'updated_by_id',
    ];
     public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id', 'id');
    }
     public function productSubCategory()
    {
        return $this->belongsTo(ProductSubCategory::class, 'product_sub_category_id', 'id');
    }
public function scopeSearch($query)
{
    $request = request();

    if ($request->has('product_category_id') && $request->product_category_id) {
        $query->where('product_category_id', $request->product_category_id);
    }
    if ($request->has('product_sub_category_id') && $request->product_sub_category_id) {
        $query->where('product_sub_category_id', $request->product_sub_category_id);
    }
    if ($request->has("name")) {
        $query->where('name', 'like', '%' . $request->name . '%');
    }
    return $query;
}
}
