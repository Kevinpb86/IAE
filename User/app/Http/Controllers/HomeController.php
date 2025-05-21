<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class HomeController extends Controller
{
    /**
     * Display the home page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Fetch products for the exclusive collection section
        $products = Product::orderBy('created_at', 'desc')->take(8)->get();
        
        return view('welcome', compact('products'));
    }
}