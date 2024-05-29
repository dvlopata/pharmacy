<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Manufacturer\StoreRequest;
use App\Http\Requests\Admin\Manufacturer\UpdateRequest;
use App\Models\Manufacturer;
use App\Models\Product;


class ManufacturerController extends Controller
{
    public function index()
    {
        $manufacturers = Manufacturer::all();
        return view('admin.manufacturer.index', compact('manufacturers'));
    }

    public function edit(Manufacturer $manufacturer)
    {
        return view('admin.manufacturer.edit', compact('manufacturer'));
    }

    public function create()
    {
        return view('admin.manufacturer.create');
    }

    public function show(Manufacturer $manufacturer)
    {
        return view('admin.manufacturer.show', compact('manufacturer'));
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        Manufacturer::firstOrCreate($data);
        return redirect() -> route('admin.manufacturer.index');
    }

    public function update(UpdateRequest $request, Manufacturer $manufacturer)
    {
        $data = $request->validated();
        $manufacturer->update($data);
        return view('admin.manufacturer.show', compact('manufacturer'));
    }

    public function delete(Manufacturer $manufacturer)
    {
        Product::where('manufacturer_id', $manufacturer->id)->delete();

        $manufacturer->delete();
    }
}
