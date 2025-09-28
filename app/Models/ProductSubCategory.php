<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSubCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'slug',
        'is_active',
        'product_category_id',
        'created_by_id',
        'updated_by_id'
    ];

     public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class, 'product_category_id', 'id');
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
