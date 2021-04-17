<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Menutype;

class MenutypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('menutype.Index', ['menutypes' => MenuType::all()]);
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
        
        Menutype::create($this->validateReq($request));
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
    public function edit(Menutype $menutype)
    {
        return view('menutype.Edit', compact('menutype'));
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

        Menutype::find($request->id)
            ->update($this->validateReq($request));
        
        return redirect()->route('menutype.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Menutype::find($request->id)->delete();
        return back();
    }

    public function validateReq($request){

        return $request->validate([
            'name'  =>  'required',
            'from'  =>  'required',
            'to'  =>  'required'
        ]);
    }
}
