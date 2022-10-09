<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::inRandomOrder()->take(16)->get();
        //return inertia('products/Index', compact('products'));
        return Inertia::render('Products/Index', ['products' => $products]);
    }
}
