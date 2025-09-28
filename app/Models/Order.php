<?php

namespace App\Models;



use Laravel\Sanctum\HasApiTokens;
use App\Traits\CreatedByUpdatedByIdTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
   
    protected $fillable = [
        'product_id',
        'order_no',
        'paid',
        'total_amount',
        'order_date',
        'supplier_id',
        'description',
        'is_delivered',
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
    
    // public function scopeSearch($query)
    // {
    //     $request = request();

    //     // Search product
    //     if ($request->has("product_id")) {
    //         $query->where('product_id', 'like', '%' . $request->product_id . '%');
    //     }
    //     return $query;
    // }

     public function scopeSearch($query)
    {
        $request = request();

        if ($request->has("supplier_id") && $request->supplier_id) {
            $query->where('supplier_id', $request->supplier_id);
        }
        if ($request->has("start_date") && $request->start_date) {
            $query->whereDate('order_date', '>=', $request->start_date);
        }
        if ($request->has("end_date") && $request->end_date) {
            $query->whereDate('order_date', '<=', $request->end_date);
        }
        // ...existing code...
        return $query;
    }
}
