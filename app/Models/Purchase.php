<?php

namespace App\Models;



use Laravel\Sanctum\HasApiTokens;
use App\Traits\CreatedByUpdatedByIdTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Purchase extends Authenticatable
{
    use HasApiTokens,HasFactory,CreatedByUpdatedByIdTrait;
   
    protected $fillable = [
        'product_id',
        'quantity',
        'price',
        'purchase_date',
        'supplier_id',
        'description',
        'is_active',
       'created_by_id',
       'updated_by_id',
    ];
    //   public $folderPath = "img/users";
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id', 'id');
    }
    
    public function scopeSearch($query)
    {
        $request = request();

        // Search product
        // if ($request->has("product_id")) {
        //     $query->where('product_id', 'like', '%' . $request->product_id . '%');
        // }

         // Search by product name (new)
    if ($request->has("product_id") && $request->product_id) {
        $query->whereHas('product', function($q) use ($request) {
            $q->where('name', 'like', '%' . $request->product_id . '%');
        });
    }
        return $query;
    }
}
