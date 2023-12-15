<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Database\Console\DumpCommand;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function dashboard(){
    
    return view('pos.dashboard');
    }

    public function index(Request $request){
       
        session([ 'cart' => $request->input('cart')]);
      
       return back();
    }
    public function show(Request $request){
       
       dump(session('cart'));
        //return back();
    }


}
