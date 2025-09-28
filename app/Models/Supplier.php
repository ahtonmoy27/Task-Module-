<?php

namespace App\Models;


use Laravel\Sanctum\HasApiTokens;
use App\Traits\CreatedByUpdatedByIdTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Supplier extends Authenticatable
{
    use HasApiTokens,HasFactory,CreatedByUpdatedByIdTrait;
   
    protected $fillable = [
       'name',
       'email',
       'mobile_no',
       'address',
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
     public function purchases(){
        return $this->hasMany(Purchase::class,'supplier_id','id');
      }
      public function orders(){
        return $this->hasMany(Order::class,'supplier_id','id');
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
