<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Pharmacy\StoreRequest;
use App\Http\Requests\Admin\Pharmacy\UpdateRequest;
use App\Models\Pharmacy;

class PharmacyController extends Controller
{
    public function index()
    {
        $pharmacies = Pharmacy::all();
        return view('admin.pharmacy.index', compact('pharmacies'));
    }

    public function edit(Pharmacy $pharmacy)
    {
        return view('admin.pharmacy.edit', compact('pharmacy'));
    }

    public function create()
    {
        return view('admin.pharmacy.create');
    }

    public function show(Pharmacy $pharmacy)
    {
        return view('admin.pharmacy.show', compact('pharmacy'));
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        Pharmacy::firstOrCreate($data);
        return redirect() -> route('admin.pharmacy.index');
    }

    public function update(UpdateRequest $request, Pharmacy $pharmacy)
    {
        $data = $request->validated();
        $pharmacy->update($data);
        return view('admin.pharmacy.show', compact('pharmacy'));
    }

    public function delete(Pharmacy $pharmacy)
    {
        $pharmacy->delete();
        return redirect() -> route('admin.pharmacy.index');
    }
}
