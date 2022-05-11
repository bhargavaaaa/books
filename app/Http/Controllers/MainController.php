<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\HomeBanner;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function home()
    {
        $banners = HomeBanner::active()->get();
        $categories = Category::with('product')->active()->limit(3)->orderBy('created_at','desc')->get();
        // dd($categories);
        return view('welcome',compact('banners','categories'));
    }
}
