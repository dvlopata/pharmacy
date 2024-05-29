<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Order\AddWayBillRequest;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return view('admin.order.index', compact('orders'));
    }

    public function filter(Request $request)
    {
        $status = $request->input('status');

        $ordersDB = Order::query();

        if ($status) {
            if ($status == "Всі замовлення")
                return $this->index();
            $ordersDB->where('status', $status);
        }

        $orders = $ordersDB->get();

        return view('admin.order.index', compact('orders', 'status'));
    }

    public function show(Order $order)
    {
        return view('admin.order.show', compact('order'));
    }

    public function acceptOrder(Order $order)
    {
        $order->status = "Комплектується";
        $order->save();
        return redirect()->route('admin.order.show', compact('order'));
    }

    public function cancelOrder(Order $order)
    {
        $order->status = "Скасовано";
        $order->save();
        return redirect()->route('admin.order.show', compact('order'));
    }

    public function addWayBill(AddWayBillRequest $request, Order $order)
    {
        $order->waybill = $request->waybill;
        $order->status = "Відправлено";
        $order->save();
        return redirect()->route('admin.order.show', compact('order'));
    }

    public function edit(Order $order)
    {
        return view('admin.order.edit', compact('order'));
    }

    public function update()
    {
        return redirect()->route('admin.order.index');
    }

    public function delete(Order $order)
    {
        $order->delete();
        return redirect()->route('admin.order.index');
    }
}
