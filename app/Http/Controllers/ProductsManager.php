<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    function addToCart($id)
    {
        $cart = new Cart();
        $cart -> user_id = Auth::user()->id;
        $cart -> product_id = $id;
        if ($cart->save()) {
            return redirect()->back()->with('success', 'Product added to cart successfully');
        } 
        return redirect()->back()->with('fail', 'Something went wrong');
    }
}
