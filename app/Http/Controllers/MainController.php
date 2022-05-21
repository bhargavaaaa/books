<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\HomeBanner;
use App\Models\Product;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function home()
    {
        $banners = HomeBanner::active()->get();
        $categories = Category::with('product')->active()->limit(3)->orderBy('created_at', 'desc')->get();
        // dd($categories);
        return view('welcome', compact('banners', 'categories'));
    }

    public function wishlist()
    {
        if (session()->has('my_wishlist')) {
            $wishlists = session('my_wishlist');
        } else {
            $wishlists = array();
        }
        $products = Product::whereIn('id', $wishlists)->get();
        return view('front.wishlist', compact('products'));
    }

    public function cart()
    {
        if (session()->has('my_cart')) {
            $carts = session('my_cart');
        } else {
            $carts = array();
        }
        $products = Product::whereIn('id', $carts)->get();
        return view('front.cart', compact('products'));
    }

    public function update_cart(Request $request)
    {
        $product_id = $request->product_id;
        $cart_qty = $request->cart_qty;

        $qty = array();
        if ($request->session()->has('my_cart')) {
            $my_cart = session()->get('my_cart');

            if (isset($product_id) && isset($product_id)) {
                for ($i=0; $i < count($product_id); $i++) {
                    $qty[$product_id[$i]] = $cart_qty[$i];
                }
                $request->session()->put('my_cart', $product_id);
                $request->session()->put('cart_qty', $qty);
            }
        }

        $carts = session('my_cart');
        $products = Product::whereIn('id', $carts)->get();

        return view('front.cart-table', compact('products'));
    }

    public function addWishlist(Request $request)
    {
        $res[0] = false;

        // $request->session()->forget('my_wishlist');
        if ($request->session()->has('my_wishlist')) {
            $my_wishlist = session()->get('my_wishlist');
        } else {
            $my_wishlist = array();
        }

        if (isset($my_wishlist) && in_array($request->product_id, $my_wishlist)) {
        } else {
            array_push($my_wishlist, $request->product_id);
            $request->session()->put('my_wishlist', $my_wishlist);
            $res[0] = true;
        }
        return response()->json($res);
    }

    public function removeWishlist(Request $request)
    {
        $res[0] = false;
        if ($request->session()->has('my_wishlist')) {
            $my_wishlist = session()->get('my_wishlist');
            if (isset($my_wishlist) && in_array($request->product_id, $my_wishlist)) {

                $remove_key = array_keys($my_wishlist, $request->product_id)[0];
                array_forget($my_wishlist, $remove_key);
                $new = array_values($my_wishlist);

                $request->session()->put('my_wishlist', $new);
                $res[0] = true;
            }
        }
        if (isset($request->wishlist_page) && $request->wishlist_page != null) {
            $wishlists = array();
            if (session()->has('my_wishlist')) {
                $wishlists = session('my_wishlist');
            }

            $products = Product::whereIn('id', $wishlists)->get();
            return view('front.wishlist-table', compact('products'));
        }
        return response()->json($res);
    }

    public function addToCart(Request $request)
    {
        $res[0] = false;

        // $request->session()->forget('my_wishlist');
        if ($request->session()->has('my_cart')) {
            $my_cart = session()->get('my_cart');
        } else {
            $my_cart = array();
        }

        if (isset($my_cart) && in_array($request->product_id, $my_cart)) {
        } else {
            array_push($my_cart, $request->product_id);
            $request->session()->put('my_cart', $my_cart);
            $res[0] = true;
        }
        // return response()->json($res);
        return view('front.layouts.partials.header');
    }

    public function removeToCart(Request $request)
    {
        $res[0] = false;
        if ($request->session()->has('my_cart')) {
            $my_cart = session()->get('my_cart');
            if (isset($my_cart) && in_array($request->product_id, $my_cart)) {

                $remove_key = array_keys($my_cart, $request->product_id)[0];
                if(session()->has('cart_qty')){
                    if(array_get(session('cart_qty'), $request->product_id) != null){
                        $cart_qty = session('cart_qty');
                        array_forget($cart_qty, $request->product_id);
                    }
                }
                array_forget($my_cart, $remove_key);
                $new = array_values($my_cart);

                $request->session()->put('my_cart', $new);
                $res[0] = true;
            }
        }

        if(isset($request->cart_product) && $request->cart_product != null){
            $carts = session('my_cart');
            $products = Product::whereIn('id', $carts)->get();
            
            return view('front.cart-table', compact('products'));
        }
        // return response()->json($res);
        return view('front.layouts.partials.header');
    }
}
