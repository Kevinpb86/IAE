<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AdminProduct; // Use AdminProduct model

class HomeController extends Controller
{
    /**
     * Display the home page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = AdminProduct::all(); // Fetch all products from admin database
        return view('welcome', compact('products'));
    }
}