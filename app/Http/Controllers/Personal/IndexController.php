<?php

namespace App\Http\Controllers\Personal;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class IndexController extends Controller
{
    public function index()
    {
        $orders = Auth::user()->orders()->orderBy('date', 'desc')->get();
        return view('personal.main.index', compact('orders'));
    }

    public function cancelOrder(Order $order)
    {
        $order->status = 'Скасовано покупцем';
        $order->save();

        return redirect()->back()->with('danger', 'Ваше замовлення було скасовано!');
    }
}
