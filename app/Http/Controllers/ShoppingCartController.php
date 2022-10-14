<?php

namespace App\Http\Controllers;

use App\Repositories\CartRepository;
use Illuminate\Http\Request;

class ShoppingCartController extends Controller
{
    public function index()
    {

        $cartContent = (new CartRepository())->content();

        return inertia('Cart/ShoppingCart');

    }
}
