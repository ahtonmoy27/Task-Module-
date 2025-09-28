<?php

namespace App\Models;

use App\Models\ProductSubCategory;

use Illuminate\Database\Eloquent\Model;
use App\Traits\CreatedByUpdatedByIdTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductCategory extends Model
{
    use HasFactory, createdByUpdatedByIdTrait;

    protected $fillable = [
        'name',
        'slug',
        'is_active',
        'created_by_id',
        'updated_by_id'
    ];

      public function productSubCategory(){
        return $this->hasMany(ProductSubCategory::class,'product_category_id','id');
      }

      public function scopeSearch($query)
    {
        $request = request();

        // Search name
        if ($request->has("name")) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
        return $query;
    }
}
