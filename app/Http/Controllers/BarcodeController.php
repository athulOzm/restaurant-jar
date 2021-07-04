<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class BarcodeController extends Controller
{
    public function index()
    {
        return view('barcode.Index', ['menus' => Product::where('status', 1)->get()]);
    }

    public function code(Request $request)
    {
 

        
        $men = Product::where('name', $request->barcode)->first();
        $menus = Product::all();
        $qty = $request->qty;

        //dd($menu);

        return view('barcode.Code', compact('men', 'menus', 'qty'));
    }
}
