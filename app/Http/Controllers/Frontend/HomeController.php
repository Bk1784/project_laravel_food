<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Client;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function RestaurantDetails($id){
        $client = Client::find($id);
        return view('frontend.details_page',compact('client'));
       }
       //End Method 
}
