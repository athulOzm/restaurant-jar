<?php

namespace App\Http\Controllers;

use App\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function index(\App\Branch $branch){

        return view('branch.Index', ['branches' => $branch::all()]);
        
    }

    public function store(Request $request){


        if($request->hasfile('cover')):

            $fname = Str::slug($request->name, '-').rand(100,999).'.'.$request->file('cover')->extension();
            $img = Image::make($request->cover->path());
            $img->resize(100, 100)->save(storage_path('app/public/cover').'/'.$fname);
        endif;

         
        Branch::create([
            'name'  =>  $request->name,
            'code' =>  $request->code,
           // 'order'  =>   $request->order,
          //  'cover' =>  @$fname ? $fname : null
        ]);

        return redirect(route('branch.index'));
    }

    public function delete(Request $request){

        Branch::find($request->id)->delete();
        return redirect(route('branch.index'));
    }

   

    public function edit(Branch $branch)
    {
        return view('branch.Edit', compact('branch'));
    }

    public function update(Request $request)
    {

        if($request->hasfile('cover')):

            $fname = Str::slug($request->name, '-').rand(100,999).'.'.$request->file('cover')->extension();
            $img = Image::make($request->cover->path());
            $img->resize(100, 100)->save(storage_path('app/public/cover').'/'.$fname);
        endif;

        Branch::find($request->id)
            ->update([
                'name'  =>  $request->name,
                'code' =>  $request->code,
               // 'order'  =>   $request->order,
                //'cover' =>  @$fname ? $fname : $request->curimage
            ]);
        
        return redirect()->route('branch.index');
    }

    public function getSubbranch(Branch $branch){

        return response($branch->childs, 201);
    }
}
