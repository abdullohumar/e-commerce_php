<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OrdersManager extends Controller
{
    function showCheckout()
    {
        return view('checkout');
    }
    function processCheckout(Request $request)
    {
        $request->validate([
           'address' => 'required',
           'phone' => 'required',
           'pincode' => 'required'
        ]);
        $cartItems = DB::table('cart')
            ->join('products', 'cart.product_id', '=', 'products.id')
            ->select('cart.product_id', DB::raw('count(*) as quantity'), 'products.price')
            ->where('cart.user_id', Auth::user()->id)
            ->groupBy('cart.product_id', 'products.price')
            ->get();

        if ($cartItems->isEmpty()) {
            return redirect(route('cart.show'))->with('fail', 'Cart is empty');
        }

        $productIds = [];
        $quantities = [];
        $totalPrice = 0;
        foreach ($cartItems as $item) {
            $productIds[] = $item->product_id;
            $quantities[] = $item->quantity;
            $totalPrice += $item->price * $item->quantity;
        }

        $orders = new Orders();
        $orders->user_id = Auth::user()->id;
        $orders->address = $request->address;
        $orders->phone = $request->phone;
        $orders->pincode = $request->pincode;
        $orders->product_id = json_encode($productIds);
        $orders->total_price = $totalPrice;
        $orders->quantity = json_encode($quantities);
        if ($orders->save()) {
            DB::table('cart')->where('user_id', Auth::user()->id)->delete();
            return redirect(route('cart.show'))->with('success', 'Order placed successfully');
        }
        return redirect(route('cart.show'))->with('error', 'Something went wrong');
    }
}
