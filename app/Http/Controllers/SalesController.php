<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function dashboard(){
        $products = Product::with('categories')
        ->latest()
        ->get();
    return view('pos.dashboard', compact('products'));
    }

    public function index(){
        return view('inventory.sale.list');
    }


}
