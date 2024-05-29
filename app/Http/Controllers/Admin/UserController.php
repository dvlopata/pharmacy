<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\User\StoreRequest;
use App\Http\Requests\Admin\User\UpdateRequest;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.user.index', compact('users'));
    }

    public function edit(User $user)
    {
        $roles = User::getRoles();
        return view('admin.user.edit', compact('user', 'roles'));
    }

    public function create()
    {
        $roles = User::getRoles();
        return view('admin.user.create', compact('roles'));
    }

    public function show(User $user)
    {
        return view('admin.user.show', compact('user'));
    }

    public function store(StoreRequest $request)
    {
        $name = $request->input('name');
        $surname = $request->input('surname');
        $dateOfBirth = $request->input('dateOfBirth');
        $phone = $request->input('phone');
        $email = $request->input('email');
        $address = $request->input('address');
        $city = $request->input('city');
        $region = $request->input('region');
        $postNumber = $request->input('postNumber');
        $password = Hash::make($request->input('password'));
        $role = $request->input('role');

        DB::insert('insert into users(name, surname, dateOfBirth, phone, email, address, password, role, city, region, postNumber)
            VALUES (?,?,?,?,?,?,?,?,?,?,?)', [$name, $surname, $dateOfBirth, $phone, $email, $address, $password, $role, $city, $region, $postNumber]);

        return redirect() -> route('admin.user.index');
    }

    public function update(UpdateRequest $request, User $user)
    {
        $data = $request->validated();
        $user->update($data);
        return view('admin.user.show', compact('user'));
    }

    public function delete(User $user)
    {
        if (Auth::user() != $user){
            $user->delete();
            Cart::where('user_id', $user->id)->delete();

            $orders = Order::where('user_id', $user->id)->get();

            foreach ($orders as $order) {
                $orderId = $order->id;
                OrderProduct::where('order_id', $orderId)->delete();
                $order->delete();
            }
        }
    }
}
