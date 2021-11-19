<?php

namespace App\Http\Controllers;

use App\Unit;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pos.unit.Index', ['units' => Unit::where('is_active', true)->get()]);
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        // dd($request->chair);
         //dd($this->validateReq($request));
        
        Unit::create($this->validateReq($request));
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Unit $unit)
    {
        $units = Unit::where('is_active', true)->get();
        
        return view('pos.unit.Edit', compact('unit', 'units'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        Unit::find($request->id)
            ->update($this->validateReq($request));
        
        return redirect()->route('pos.unit.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Unit::find($request->id)->update(['is_active' => false]);
        return back();
    }

    public function validateReq($request){

        return $request->validate([
            'unit_name'  =>  'required',
            'unit_code' =>  'required',
            'base_unit' =>  'numeric|nullable',
            'operator' => 'required',
            'operation_value' => 'required'
        ]);
    }
}
