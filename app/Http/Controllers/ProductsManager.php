<?php

namespace App\Http\Controllers;

use App\Models\Products;
use Illuminate\Http\Request;

class ProductsManager extends Controller
{
    function index()
    {
        $products = Products::paginate(8);
        return view('products', compact('products'));
    }

    function details($slug)
    {
        $products = Products::where('slug', $slug)->first();
        return view('details', compact('products'));
    }
}
