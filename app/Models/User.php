<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Laravel\Sanctum\HasApiTokens;
use App\Models\Scopes\ProductScope;
use Illuminate\Notifications\Notifiable;
use App\Traits\CreatedByUpdatedByIdTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasApiTokens,HasFactory, Notifiable,CreatedByUpdatedByIdTrait;
    use SoftDeletes;
   
    protected $fillable = [
        'name',
        'email',
        'image',
        'password',
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

    // protected static function boot()
    // {
    //     parent::boot();
    //    static::saving(function ($user) {
    //     $user->updated_by_id = auth()->id();; 
    //    });
    // }
    
    public function scopeSearch($query)
    {
        $request = request();

        // Search name
        if ($request->has("name")) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
        
        // search Email
        if ($request->has("email")) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        return $query;
    }
    
 ///////   protected $appends = ['fullid'];

    public function getfuncAttribute() {
        return $this->name.''.$this->id;
    }

    public function setfuncAttribute($value){
       $this->attributes['name'] = strtolower($value);
      $this->save();
    }
   
    protected function casts(): array
    {
        return [
            'settings' => 'array',
        ];
    }
    
    public function posts(){
        return $this->hasMany(Post::class,'user_id','id');
    }
    

}
