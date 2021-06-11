<?php

namespace App\Http\Controllers;

use App\MemberRenewal;
use App\User;

use Carbon\Carbon;
use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade as PDF;

class MemberRenewalController extends Controller
{

    public function index(){

       

        User::where('type', 3)
            ->whereDate('renewal_at', '<', '2021-04-31')
            ->update(['status' => false]);
 

        if(isset($_GET['payment_type'])){

            $members =  User::where('type', 3)
                ->whereDate('renewal_at', '<', '2021-04-31')
                ->where('payment_type_id', $_GET['payment_type'])
                ->get();
            $pt = $_GET['payment_type'];
        } else {

            $members =  User::where('type', 3)
                ->whereDate('renewal_at', '<', '2021-04-31')
                ->get();
            $pt = 0;

        }


        return view('member.Renewal', ['members' => $members, 'pt' => $pt]);
    }


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

    public function downloadId(User $user){

        $customPaper = array(0,0,345.00,225.0);

       // \QrCode::format('png')->size(200)->generate($user->memberid, storage_path('app/public/cover/'.$user->memberid.'.png'));

         $pdf = PDF::loadView('pdf.Memberid', compact('user'))->setPaper($customPaper, 'landscape');
         return $pdf->download($user->memberid.'.pdf');
        //return view('pdf.Memberid', compact('user'));
        
    }

    
   
 
}
