<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::with(['category', 'board', 'publication'])->where('is_active', 1)->latest()->take(10)->get();
        $productCount = Product::where('is_active', 1)->count();
        return view('front.products', compact('products', 'productCount'));
    }

    public function product_detail($id)
    {
        $id = decrypt($id);
        $product = Product::with(['category', 'board', 'publication'])->find($id);
        $relatedProducts = Product::with(['category', 'board', 'publication'])->where('id', '!=', $product->id)
            ->whereHas('category', function ($q) use ($product) {
                $q->where('category_id', $product->category[0]->id);
            })
            ->where('is_active', 1)->get();

        return view('front.product-details', compact('product', 'relatedProducts'));
    }

    public function relatedproduct_detail(Request $request)
    {
        $id = $request->id;
        $product = Product::with(['category', 'board', 'publication'])->find($id);

        $categories = [];
        foreach ($product->category as $category) {
            array_push($categories, $category->category_name);
        }
        $categories = implode(',', $categories);
        $publications = [];
        foreach ($product->publication as $publication) {
            array_push($publications, $publication->publication_name);
        }
        $publications = implode(',', $publications);

        $res['product'] = $product;
        $res['categories'] = $categories;
        $res['publications'] = $publications;

        return response()->json($res);
    }
}
