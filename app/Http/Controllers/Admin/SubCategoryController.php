<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\SubCategory\StoreRequest;
use App\Http\Requests\Admin\SubCategory\UpdateRequest;
use App\Models\Category;
use App\Models\Subcategory;


class SubCategoryController extends Controller
{
    public function index()
    {
        $subCategories = SubCategory::all();
        return view('admin.subCategory.index', compact('subCategories'));
    }

    public function edit(SubCategory $subCategory)
    {
        $categories = Category::all();
        return view('admin.subCategory.edit', compact('subCategory', 'categories'));
    }
    public function create()
    {
        $categories = Category::all();
        return view('admin.subCategory.create', compact('categories'));
    }

    public function show(SubCategory $subCategory)
    {
        return view('admin.subCategory.show', compact('subCategory'));
    }

    public function store(StoreRequest $request)
    {
        $data = $request->validated();
        SubCategory::firstOrCreate($data);
        return redirect() -> route('admin.subCategory.index');
    }

    public function update(UpdateRequest $request, SubCategory $subCategory)
    {
        $data = $request->validated();
        $subCategory->update($data);
        return view('admin.subCategory.show', compact('subCategory'));
    }
}
