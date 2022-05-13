<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Symfony\Component\CssSelector\Node\FunctionNode;

class ProductController extends Controller
{

    public function index()
    {
        $products = Product::with(['category', 'board', 'publication'])->where('is_active', 1)->orderBy('id','desc')->latest()->take(2)->get();
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

    public function load_products(Request $request){
        $page = $request->page;
        $sort_select = $request->sort_select;

        if(isset($request->last_id) && $request->last_id != null){
            $last_id = json_decode($request->last_id);
        }else{
            $last_id = Product::latest()->take(1)->pluck('id');
            $last_id[0] = ($last_id[0] + 1);
        }
        $prev = $last_id;

        if(isset($page) && isset($sort_select)){
            if($sort_select == "default" ){
                $products = Product::with(['category', 'board', 'publication'])->whereNotIn('id',$last_id)->where('is_active', 1)->orderBy('id','desc')->latest()->take(2)->get();
                $productCount = Product::where('is_active', 1)->count();

            }else if($sort_select == "sort_A-Z"){

                $products = Product::with(['category', 'board', 'publication'])->whereNotIn('id',$last_id)->where('is_active', 1)->orderBy('product_name','asc')->latest()->take(2)->get();
                $productCount = Product::where('is_active', 1)->where('id','<',$last_id)->orderBy('product_name','asc')->count();

            }else if($sort_select == "sort_Z-A"){

                $products = Product::with(['category', 'board', 'publication'])->where('id','<',$last_id)->where('is_active', 1)->orderBy('product_name','desc')->latest()->take(2)->get();
                $productCount = Product::where('is_active', 1)->where('id','<',$last_id)->orderBy('product_name','desc')->count();

            }else if($sort_select == "sort_Low-High"){

                $products = Product::with(['category', 'board', 'publication'])->where('id','<',$last_id)->where('is_active', 1)
                ->orderBy('sale_price','asc')->latest()->take(2)->get();
                $productCount = Product::where('is_active', 1)->where('id','<',$last_id)->orderBy('sale_price','asc')->count();

            }else if($sort_select == "sort_High-Low"){

                $products = Product::with(['category', 'board', 'publication'])->where('id','<',$last_id)->where('is_active', 1)
                ->orderBy('sale_price','desc')->latest()->take(2)->get();
                $productCount = Product::where('is_active', 1)->where('id','<',$last_id)->orderBy('sale_price','desc')->count();

            }
            // array_push($prev,$products->pluck('id'))
            // dd($prev);
        }

        return view('front.load_products',compact('products','productCount','page','sort_select'));
    }
}
