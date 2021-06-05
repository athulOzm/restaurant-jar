<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;

class BarcodeController extends Controller
{
    public function index()
    {
        return view('barcode.index', ['menus' => Product::where('status', 1)->get()]);
    }

    public function code(Request $request)
    {

        
        $menu = Product::where('name', $request->barcode)->get();
        $menus = Product::all();
        return view('barcode.Code', compact('menu', 'menus'));
    }
}
