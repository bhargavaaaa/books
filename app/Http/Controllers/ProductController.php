<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index(){
        $products = Product::with(['category','board','publication'])->where('is_active',1)->get();
        // dd($products);
        return view('front.shop-list',compact('products'));
    }

    public function product_detail($id){
        $id = decrypt($id);
        $product = Product::with(['category','board','publication'])->find($id);
        $relatedProducts = Product::with(['category','board','publication'])->where('id','!=',$product->id)
        ->whereHas('category',function($q) use($product){
            $q->where('category_id',$product->category[0]->id);
        })
        ->where('is_active',1)->get();

        return view('front.product-details',compact('product','relatedProducts'));
    }
}
