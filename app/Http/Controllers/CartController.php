<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;

class CartController extends Controller
{
    public function cart(){
        return view('cart.cart');
    }
    public function shop(){
        $products = Product::all();
        return view('cart.shop', compact('products'));
    }
    public function addToCart($product_id){
        $product = Product::findOrFail($product_id);
        Cart::add(
            [
                'id' => $product->id,
                'name' => $product->name,
                'qty' => 1,
                'price' => $product->price,
                'options' => [
                    'image' => 'https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-shopping-carts/img5.webp'
                ]
            ]
        );

        return redirect()->back()->with('success', 'Product Added To Cart Successfully');
    }
    public function qtyIncrement($id){
        $product = Cart::get($id);
        $update_qty = $product->qty + 1;
        Cart::update($id, $update_qty);

        return redirect()->back()->with('success', 'Product Quantity Incremented Successfully');
    }
    public function qtyDecrement($id){
        $product = Cart::get($id);
        $update_qty = $product->qty - 1;
        if ($update_qty > 0) {
            Cart::update($id, $update_qty);
            return redirect()->back()->with('success', 'Product Quantity Decremented Successfully');
        }
        return redirect()->back()->with('success', 'Product Quantity Decrement Failed');
    }

    public function removeProduct($id){
        Cart::remove($id);
        return redirect()->back()->with('success', 'Product Removed Successfully');
    }
}
