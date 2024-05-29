<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        session()->forget('search_value');

        $data = [];

        $data['products'] = Product::with(['subcategory', 'manufacturer'])->where('quantity', '>', 0)->get();
        $data['categories'] = Category::all();
        $data['subcategories'] = Subcategory::all();

        return view('main.product.index', compact('data'));
    }

    public function showSubCategory(Subcategory $subcategory)
    {
        $data = [];
        $data['products'] = $subcategory->products;
        $data['categories'] = Category::all();
        $data['subCategoryShow'] = $subcategory;
        $data['subcategories'] = Subcategory::all();

        return view('main.product.index', compact('data'));
    }

    public function searchByName(Request $request)
    {
        $value = $request->value;

        $data = [];
        $data['products'] = Product::whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($value) . '%'])->with(['subcategory', 'manufacturer'])->get();
        $data['categories'] = Category::all();
        $data['subcategories'] = Subcategory::all();

        session()->put('search_value', $value);

        return view('main.product.index', compact('data'));
    }

    public function store(Request $request)
    {
        $data = $request;
        $product = Product::findOrFail($data['product_id']);
        if (Auth::check()) {
            $user_id = Auth::id();

            $existingCartItem = Cart::where(['user_id' => $user_id, 'product_id' => $product->id])->first();

            if ($existingCartItem) {
                $existingCartItem->quantity++;
                $existingCartItem->price = $product->price * $existingCartItem->quantity;
                $existingCartItem->save();
            } else {
                Cart::create([
                    "user_id" => $user_id,
                    "product_id" => $product->id,
                    "price" => $product->price,
                ]);
            }
            $cartItemCount = Cart::where('user_id', $user_id)->count();

            session()->put('cart_item_count', $cartItemCount);
        }
        else {
            $cart = session()->get('cart', []);
            $existingCartItem = null;

            foreach ($cart as $key => $item) {
                if ($item['product_id'] == $product->id) {
                    $existingCartItem = $key;
                    break;
                }
            }

            if ($existingCartItem !== null) {
                $cart[$existingCartItem]['quantity']++;
                $cart[$existingCartItem]['price'] = $product->price * $cart[$existingCartItem]['quantity'];
            } else {
                $cart[] = [
                    'product_id' => $product->id,
                    'product' => $product,
                    'quantity' => 1,
                    'price' => $product->price,
                ];
            }

            session()->put('cart', $cart);
            $cartItemCount = count($cart);
            session()->put('cart_item_count', $cartItemCount);
        }

        $searchValue = session()->get('search_value', null);
        if ($searchValue) {
            $data = [];
            $data['products'] = Product::whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($searchValue) . '%'])->get();
            $data['categories'] = Category::all();
            $data['subcategories'] = Subcategory::all();

            session()->put('success', 'Товар було успішно додано в корзину!');
            return view('main.product.index', compact('data'));
        }
        return redirect()->back()->with('success', 'Товар було успішно додано в корзину!');
    }
}
