<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class CartController extends Controller
{
    public function index()
    {
        $product_habis = [];
        $product_tersedia = [];
        $carts = Cart::where('user_id', auth()->id())->get();
        foreach ($carts as $cart) {
            $product = Product::find($cart->product_id);
            if ($product->status == 'tersedia') {
                $product_tersedia[] = [
                    'cart_id' => $cart->id,
                    'product_id' => $product->id,
                    'name' => $product->name,
                    'qty' => $cart->qty,
                    'price' => $product->price,
                    'photo' => $product->photo,
                    'merchant_id' => $product->merchant_id,

                ];
            } else {
                $product_habis[] = [
                    'cart_id' => $cart->id,
                    'product_id' => $product->id,
                    'name' => $product->name,
                    'qty' => $cart->qty,
                    'price' => $product->price,
                    'photo' => $product->photo,
                    'merchant_id' => $product->merchant_id,
                ];
            }
        }
        return view('User.Pages.cart', [
            'product_habis' => $product_habis,
            'product_tersedia' => $product_tersedia
        ]);
    }

    public function addToCart()
    {

        $cart = Cart::where('user_id', auth()->id())
            ->where('product_id', request('product_cart'))
            ->first();

        if ($cart) {
            $cart->update([
                'qty' => $cart->qty + request('qty_cart')
            ]);

            Alert::success('User', 'Produk telah ditambahkan ke Keranjang');
            return back();
        }

        Cart::create([
            'user_id' => auth()->id(),
            'product_id' => request('product_cart'),
            'qty' => request('qty_cart')
        ]);

        Alert::success('User', 'Produk telah ditambahkan ke Keranjang');
        return back();
    }

    public function removeFromCart()
    {
        $id = request('cart_id');
        Cart::destroy($id);
        Alert::success('User', 'Produk telah dihapus dari Keranjang');
        return back();
    }

    public function updateCartQty()
    {
        $cart = Cart::where('id', request('cart-id'))->first();
        $cart->update([
            'qty' => request('qty')
        ]);

        return back();
    }
}
