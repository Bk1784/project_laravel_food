<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\City;
use App\Models\Client;
use App\Models\Menu;
use App\Models\Product;
use Illuminate\Http\Request;

class ManageController extends Controller
{
    public function AdminAllProduct(){ 
        $product = Product::orderBy('id','desc')->get();
        return view('admin.backend.product.all_product', compact('product'));
    } 

    public function AdminAddProduct(){ 
        $category = Category::latest()->get();
        $city = City::latest()->get();
        $menu = Menu::latest()->get();
        $client = Client::latest()->get();
        return view('admin.backend.product.add_product', compact('category','city','menu','client'));
    } 
}
