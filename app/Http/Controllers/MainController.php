<?php

namespace App\Http\Controllers;

use App\Models\HomeBanner;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function home()
    {
        $banners = HomeBanner::active()->get();
        return view('welcome',compact('banners'));
    }
}
