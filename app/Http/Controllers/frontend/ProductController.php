<?php

namespace App\Http\Controllers\frontend;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {

        return view('product._form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:product',
        ]);

        $product = Product::create([
            'name' => $request->name
        ]);

        dd($product);
    }
}
