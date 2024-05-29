<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Http\Requests\Main\Order\StoreRequest;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\Subcategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;


class OrderController extends Controller
{
    public function create(Request $request)
    {
        $totalPrice = $request->totalPrice;
        return view('main.order.create', compact('totalPrice'));
    }

    public function store(StoreRequest $request)
    {
        if (Auth::check()) {
            $user_id = Auth::id();

            $cartItems = Cart::where('user_id', $user_id)->get();

            foreach ($cartItems as $cartItem) {
                $product = Product::find($cartItem->product_id);

                if ($product && $product->quantity >= $cartItem->quantity) {
                    $product->quantity -= $cartItem->quantity;
                    $product->save();
                } else {
                    session()->put('danger', 'Недостатня кількість товару для замовлення.');
                    return view('main.cart.index', compact('cartItems'));
                }
            }

            $name = $request->input('name');
            $surname = $request->input('surname');
            $phone = $request->input('phone');
            $email = $request->input('email');
            $address = $request->input('address');
            $city = $request->input('city');
            $region = $request->input('region');
            $postNumber = $request->input('postNumber');

            DB::table('users')->where('id', $user_id)->update([
                'name' => $name,
                'surname' => $surname,
                'phone' => $phone,
                'email' => $email,
                'address' => $address,
                'city' => $city,
                'region' => $region,
                'postNumber' => $postNumber
            ]);

            $order_id = DB::table('orders')->insertGetId([
                'date' => Date::now(),
                'sum' => $request->input('totalPrice'),
                'status' => "Сформовано покупцем",
                'user_id' => $user_id
            ]);

            foreach ($cartItems as $cartItem) {
                DB::table('order_products')->insert([
                    'order_id' => $order_id,
                    'product_id' => $cartItem->product_id,
                    'quantity' => $cartItem->quantity,
                    'price' => $cartItem->price/$cartItem->quantity,
                    'name' => $cartItem->product->name,
                ]);
            }
        } else {
            $cartItems = session()->get('cart', []);

            foreach ($cartItems as $cartItem) {
                $product = Product::find($cartItem['product_id']);

                if ($product && $product->quantity >= $cartItem['quantity']) {
                    $product->quantity -= $cartItem['quantity'];
                    $product->save();
                } else {
                    session()->put('danger', 'Недостатня кількість товару для замовлення.');
                    return view('main.cart.index', compact('cartItems'));
                }
            }

            $name = $request->input('name');
            $surname = $request->input('surname');
            $dateOfBirth = date('d.m.Y');
            $phone = $request->input('phone');
            $email = $request->input('email');
            $address = $request->input('address');
            $city = $request->input('city');
            $region = $request->input('region');
            $postNumber = $request->input('postNumber');
            $password = Hash::make('autocreated');
            $role = User::ROLE_BUYER;

            $user_id = DB::table('users')->insertGetId([
                'name' => $name,
                'surname' => $surname,
                'dateOfBirth' => $dateOfBirth,
                'phone' => $phone,
                'email' => $email,
                'address' => $address,
                'password' => $password,
                'role' => $role,
                'city' => $city,
                'region' => $region,
                'postNumber' => $postNumber
            ]);

            $order_id = DB::table('orders')->insertGetId([
                'date' => Date::now(),
                'sum' => $request->input('totalPrice'),
                'status' => "Сформовано покупцем",
                'user_id' => $user_id
            ]);

            foreach ($cartItems as $cartItem) {
                DB::table('order_products')->insert([
                    'order_id' => $order_id,
                    'product_id' => $cartItem['product_id'],
                    'quantity' => $cartItem['quantity'],
                    'price' => $cartItem['price']/$cartItem['quantity'],
                    'name' => $cartItem['product']->name
                ]);
            }
        }

        Cart::where('user_id', $user_id)->delete();
        session()->forget('cart');
        session()->forget('cart_item_count');

        return redirect()->route('main.order.success');
    }

    public function success()
    {
        return view('main.order.success');
    }
}
