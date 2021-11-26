<?php

namespace App\Http\Controllers;

use App\PurchaseStock;
use Illuminate\Http\Request;

class PurchaseStockController extends Controller
{
    public function index(){

        return view('material.stock.Index', ['stocks' => PurchaseStock::with('product')->get()]);
    }
}
