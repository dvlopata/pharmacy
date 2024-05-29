<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Manufacturer;
use App\Models\Order;
use App\Models\Pharmacy;
use App\Models\Product;
use App\Models\Subcategory;
use App\Models\User;

class IndexController extends Controller
{
    public function index()
    {
        $data = [];
        $data['orderCount'] = Order::all()->count();
        $data['categoryCount'] = Category::all()->count();
        $data['subcategoryCount'] = Subcategory::all()->count();
        $data['manufacturerCount'] = Manufacturer::all()->count();
        $data['productCount'] = Product::all()->count();
        $data['userCount'] = User::all()->count();
        $data['pharmacyCount'] = Pharmacy::all()->count();
        return view('admin.main.index', compact('data'));
    }
}
