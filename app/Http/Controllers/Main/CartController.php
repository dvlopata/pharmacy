<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class CartController extends Controller
{
    public function index()
    {
        if (Auth::check()){
            $user_id = Auth::id();
            $cartItems = Cart::where('user_id', $user_id)->get();
        }
        else{
            $cartItems = session()->get('cart', []);
        }

        return view('main.cart.index', compact('cartItems'));
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

    public function updateElCart(Request $request)
    {
        if (Auth::check()) {
            $cart = Cart::where('id', $request->cart_id)->first();
            if ($cart) {
                $cart->quantity = $request->quantity;
                $cart->price = $cart->quantity * $cart->product->price;
                $cart->save();

                $subtotal = $cart->price;
                $totalPrice = Cart::where('user_id', Auth::id())->sum(DB::raw('price'));

                return response()->json([
                    'success' => true,
                    'subtotal' => round($subtotal, 2),
                    'totalPrice' => round($totalPrice, 2)
                ]);
            } else {
                return response()->json(['success' => false, 'message' => 'Виникла помилка'], 404);
            }
        } else {
            $cart = session()->get('cart', []);
            $existingCartItemKey = null;
            foreach ($cart as $key => $item) {
                if ($key == $request->cart_id) {
                    $existingCartItemKey = $key;
                    break;
                }
            }
            if ($cart && $existingCartItemKey !== null) {
                $product = Product::findOrFail($cart[$existingCartItemKey]['product_id']);
                $cart[$existingCartItemKey]['quantity'] = $request->quantity;
                $cart[$existingCartItemKey]['price'] = $cart[$existingCartItemKey]['quantity'] * $product->price;

                session()->put('cart', $cart);

                $subtotal = $cart[$existingCartItemKey]['price'];
                $totalPrice = array_sum(array_column($cart, 'price'));

                // Возвращаем успешный ответ с обновленными данными
                return response()->json([
                    'success' => true,
                    'subtotal' => round($subtotal, 2),
                    'totalPrice' => round($totalPrice, 2)
                ]);
            } else {
                return response()->json(['success' => false, 'message' => 'Виникла помилка'], 404);
            }
        }
    }
    public function deleteElFromCart(Request $request)
    {
        $cartId = $request->cartId;
        if (Auth::check()) {
            $cartItem = Cart::where('id', $cartId)->where('user_id', Auth::id())->first();
            if ($cartItem) {
                $cartItem->delete();
                $cartItemCount = Cart::where('user_id', Auth::id())->count();
                $totalPrice = Cart::where('user_id', Auth::id())->sum(DB::raw('price'));
                session()->put('cart_item_count', $cartItemCount);
                return response()->json([
                    'success' => true,
                    'totalPrice' => round($totalPrice, 2),
                    'cartItemCount' => $cartItemCount
                ]);
            }
        } else {
            $cart = session()->get('cart', []);
            if (isset($cart[$cartId])) {
                unset($cart[$cartId]);
            }
            session()->put('cart', $cart);
            $cartItemCount = count($cart);
            session()->put('cart_item_count', $cartItemCount);
            $totalPrice = array_sum(array_column($cart, 'price'));
            return response()->json([
                'success' => true,
                'totalPrice' => round($totalPrice, 2),
                'cartItemCount' => $cartItemCount
            ]);
        }

        return response()->json(['success' => false, 'message' => 'Виникла помилка'], 404);
    }
}
