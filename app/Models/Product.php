<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;
    public $guarded = false;

    public function manufacturer()
    {
        return $this->belongsTo(Manufacturer::class, 'manufacturer_id');
    }

    public function subcategory()
    {
        return $this->belongsTo(Subcategory::class, 'subcategory_id');
    }

    /**
     * Получить всех пользователей, добавивших этот продукт в корзину.
     */
    public function users()
    {
        return $this->belongsToMany(User::class, 'carts')->withTimestamps();
    }
    /**
     * Получить все заказы, добавивших этот продукт в заказ.
     */
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_products')->withTimestamps();
    }
}
