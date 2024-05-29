<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Pharmacy;
use App\Models\Product;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class PharmacyController extends Controller
{
    public function __invoke()
    {
        $pharmacies = Pharmacy::all();

        return view('main.pharmacy.index', compact('pharmacies'));
    }
}
