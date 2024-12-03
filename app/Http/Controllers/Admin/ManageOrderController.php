<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;

class ManageOrderController extends Controller
{
    public function PendingOrder(){
        $allData = Order::where('status','Pending')->orderBy('id','desc')->get();
        return view('admin.backend.order.pending_order',compact('allData'));
    }
    //End Method 
    public function ConfirmOrder(){
        $allData = Order::where('status','confirm')->orderBy('id','desc')->get();
        return view('admin.backend.order.confirm_order',compact('allData'));
    }
    //End Method 
    public function ProcessingOrder(){
        $allData = Order::where('status','processing')->orderBy('id','desc')->get();
        return view('admin.backend.order.processing_order',compact('allData'));
    }
    //End Method 
    public function DeliverdOrder(){
        $allData = Order::where('status','deliverd')->orderBy('id','desc')->get();
        return view('admin.backend.order.deliverd_order',compact('allData'));
    }
    //End Method 

    public function AdminOrderDetails($id){
        $order = Order::with('user')->where('id',$id)->first();
        $orderItem = OrderItem::with('product')->where('order_id',$id)->orderBy('id','desc')->get();
        $totalPrice = 0;
        foreach($orderItem as $item){
            $totalPrice += $item->price * $item->qty;
        }
        return view('admin.backend.order.admin_order_details',compact('order','orderItem','totalPrice'));
    } //End Method 
}
