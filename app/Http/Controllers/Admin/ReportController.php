<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Auth;
use DateTime;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function AdminAllReports(){
        return view('admin.backend.report.all_report');
    }

    public function AdminSearchByDate(Request $request){
        $date = new DateTime($request->date);
        $formatDate = $date->format('d F Y');

        $orderDate = Order::where('order_date',$formatDate)->latest()->get();
        return view('admin.backend.report.search_by_date',compact('orderDate','formatDate'));
    }
      // End Method 

      public function AdminSearchByMonth(Request $request){
        $month = $request->month;
        $years = $request->year_name;
        $orderMonth = Order::where('order_month',$month)->where('order_year',$years)->latest()->get();
        return view('admin.backend.report.search_by_month',compact('orderMonth','month','years'));
    }
     // End Method 

     public function AdminSearchByYear(Request $request){ 
        $years = $request->year;
        $orderYear = Order::where('order_year',$years)->latest()->get();
        return view('admin.backend.report.search_by_year',compact('orderYear','years'));
    }
     // End Method 

     ////////////// FOR Client Report all Method /////////

     public function ClientAllReports(){
        return view('client.backend.report.all_report');
    }
    // End Method 

    public function ClientSearchByDate(Request $request){
        $date = new DateTime($request->date);
        $formatDate = $date->format('d F Y');
        $cid = Auth::guard('client')->id();
        $orders = Order::where('order_date',$formatDate)
        ->whereHas('OrderItems', function ($query) use ($cid){
            $query->where('client_id',$cid);
        })
        ->latest()
        ->get();
        $orderItemGroupData = OrderItem::with(['order','product'])
        ->whereIn('order_id',$orders->pluck('id'))
        ->where('client_id',$cid)
        ->orderBy('order_id','desc')
        ->get()
        ->groupBy('order_id');
        return view('client.backend.report.search_by_date',compact('orderItemGroupData','formatDate'));
    }
      // End Method 
}
