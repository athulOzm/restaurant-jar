<?php

namespace App\Http\Controllers;

use App\Product;
use App\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function vat(){

        return view('setting.vat', ['settings' => Setting::first()]);
    }


    public function vatupdate(Request $request){

        $vat = Setting::find(1)->vat;

        Product::where('vat', $vat)->update(['vat' => $request->vat]);

        Setting::find(1)
            ->update([
                'vat'   =>  $request->vat
            ]);

        return redirect()->route('settings.vat');
    }
}
