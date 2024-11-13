<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function AllCoupon(){
        $coupon = Coupon::latest()->get();
        return view('client.backend.coupon.all_coupon', compact('coupon'));
    }

    public function AddCoupon(){
        return view('client.backend.coupon.add_coupon' );
    } 

    public function StoreCoupon(Request $request){ 
       
        Coupon::create([
                'coupon_name' => strtoupper($request->coupon_name),
                'coupon_desc' => $request->coupon_desc, 
                'discount' => $request->discount,
                'validity' => $request->validity,
                'client_id' => Auth::guard('client')->id(),
                'created_at' => Carbon::now(),
            ]); 
         
        $notification = array(
            'message' => 'Coupon Inserted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.coupon')->with($notification);
                   
    }
    // End Method 
}
