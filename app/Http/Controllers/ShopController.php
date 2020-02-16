<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function index()
    {
    	$products = Product::paginate(9);

    	return view('shop.index', compact('products'));
    }

    public function store(Product $product)
    {
    	dd($product);
    }
}
