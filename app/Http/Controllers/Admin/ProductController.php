<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Product\StoreRequest;
use App\Http\Requests\Admin\Product\UpdateRequest;
use App\Models\Cart;
use App\Models\Manufacturer;
use App\Models\Product;
use App\Models\Subcategory;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;


class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.product.index', compact('products'));
    }

    public function edit(Product $product)
    {
        $subcategories = Subcategory::all();
        $manufacturers = Manufacturer::all();
        return view('admin.product.edit', compact('product', 'subcategories', 'manufacturers'));
    }

    public function create()
    {
        $subcategories = Subcategory::all();
        $manufacturers = Manufacturer::all();
        return view('admin.product.create', compact('subcategories'), compact('manufacturers'));
    }

    public function show(Product $product)
    {
        return view('admin.product.show', compact('product'));
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        try{
            Db::beginTransaction();
            $data['image'] = Storage::disk('public')->put('/images', $data['image']);
            Product::firstOrCreate($data);
            Db::commit();
        } catch (Exception $exception) {
            Db::rollBack();
            abort(500);
        }

        return redirect() -> route('admin.product.index');
    }

    public function update(UpdateRequest $request, Product $product)
    {
        $data = $request->validated();
        try{
            Db::beginTransaction();
            if(array_key_exists('image',$data)){
                $data['image'] = Storage::disk('public')->put('/images', $data['image']);
            }
            $product->update($data);
            Db::commit();
        } catch (Exception $exception) {
            Db::rollBack();
            abort(500);
        }

        $subcategories = Subcategory::all();
        $manufacturers = Manufacturer::all();
        return view('admin.product.show', compact('product', 'subcategories', 'manufacturers'));
    }

    public function delete(Product $product)
    {
        Cart::where('product_id', $product->id)->delete();
        $product->delete();
        return redirect()->route('admin.product.index');
    }
}
