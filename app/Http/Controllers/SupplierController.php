<?php

namespace App\Http\Controllers;

use App\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index(){

        return view('supplier.Index', ['suppliers' => Supplier::all()]);
        
    }

    public function store(Request $request){


       
         
        Supplier::create([
            'name'  =>  $request->name,
            'phone' =>  $request->phone,
            'address'  =>   $request->address
          
        ]);

        return redirect(route('supplier.index'));
    }

    public function delete(Request $request){

        Supplier::find($request->id)->delete();
        return redirect(route('supplier.index'));
    }

   

    public function edit(Supplier $supplier)
    {
        return view('supplier.Edit', compact('supplier'));
    }

    public function update(Request $request)
    {

        

        Supplier::find($request->id)
            ->update([
                'name'  =>  $request->name,
                'phone' =>  $request->phone,
                'address'  =>   $request->address
                //'cover' =>  @$fname ? $fname : $request->curimage
            ]);
        
        return redirect()->route('supplier.index');
    }
}
