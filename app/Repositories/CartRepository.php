<?php
namespace App\Repositories;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartRepository {
    public function add(Product $product)
    {
        \Cart::session(Auth::user()->id)->add(array(
            'id' =>  $product->id,
            'name' => $product->name,
            'price' => $product->price,
            'quantity' => 1,
            'attributes' => array(
                'image' => $product->image
            ),
            'associatedModel' => $product
        ));

        return $this->count();

    }

    public function destroy(Product $product)
    {
        //
    }

    public function content()
    {

        return \Cart::session(Auth::user()->id)->getContent();

    }

    public function count()
    {
        return $this->content()->sum('quantity');
    }
}
