<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    public $guarded = false;
    const ROLE_ADMIN = 0;
    const ROLE_BUYER = 1;

    /**
     * Получить все продукты, добавленные в корзину этим пользователем.
     */
    public function cartProducts()
    {
        return $this->belongsToMany(Product::class, 'carts')->withTimestamps();
    }

    public function orders()
    {
        return $this->hasMany(Order::class)->orderBy('date', 'desc');
    }

//    public function products()
//    {
//        return $this->belongsToMany(Cart::class, 'user_products', 'user_id', 'product_id');
//        //попробуй также єто чат гпт сделал, не тесстил
//        //return $this->belongsToMany(Product::class, 'user_products', 'user_id', 'product_id');
//    }

    public static function getRoles ()
    {
        return [
          self::ROLE_ADMIN => "Адмін",
          self::ROLE_BUYER => "Покупець",
        ];
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'surname',
        'dateOfBirth',
        'phone',
        'email',
        'city',
        'region',
        'postNumber',
        'address',
        'password',
        'role',
    ];

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
}
