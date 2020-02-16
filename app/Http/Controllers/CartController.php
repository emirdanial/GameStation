<?php

namespace App\Http\Controllers;

use App\Product;
use Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
    	$items = Cart::content();
    	//dd($items);
    	return view('cart', compact('items'));
    }

    public function store(Request $request)
    {
    	$product = Product::find($request->p_id);

    	$imgPath = asset('/storage/'.$product['image']);

    	Cart::add($product['id'], $product['title'], 1, $product['price'], ['platform' => $product['platform'], 'img' => $imgPath ]);

    	$count = Cart::content()->count();

    	return $count;
    }
}
