<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Manufacturer;
use App\Models\Product;
use App\Models\Subcategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function __invoke()
    {
        if (Auth::check()){
            $cartItemCount = Cart::where('user_id', Auth::id())->count();
            session()->put('cart_item_count', $cartItemCount);
        }

        $data = [];

        $data['products'] = Product::with(['subcategory', 'manufacturer'])
            ->where('quantity', '>', 0)
            ->inRandomOrder()
            ->limit(6)
            ->get();
        $data['kreon'] = Product::with(['subcategory', 'manufacturer'])->find(13);
        $data['enterozherminka'] = Product::with(['subcategory', 'manufacturer'])->find(12);
        $data['drOrganic'] = Product::with(['subcategory', 'manufacturer'])->find(14);
        $data['nutrilon'] = Product::with(['subcategory', 'manufacturer'])->find(17);
        $data['ivatherm'] = Product::with(['subcategory', 'manufacturer'])->find(18);

        return view('main.index', compact('data'));
    }
}
