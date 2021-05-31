<?php

namespace App\Http\Controllers;

use App\MemberRenewal;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class MemberRenewalController extends Controller
{
    public function renewnow(Request $request){

        // User::whereIn('id', $request->id)->update([
        //     'renewal_at' => DB::raw( 'column * 2' ) Carbon::parse($this->renewal_at)->addYear()
        // ]);
        foreach(explode(',', $request->id[0]) as $id) {

            if($user = User::find($id)):
                $d = Carbon::parse($user->renewal_at)->addYear();
                $user->update(['renewal_at' => $d, 'status' => true]);
                $user->renewals()->create([
                    'payment_type_id'   => $request->payment_type
                ]);
            endif;
        }
        return back();  
    }

 
}
