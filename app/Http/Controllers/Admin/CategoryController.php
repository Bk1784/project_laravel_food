<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Mail\Websitemail;
use App\Models\Category;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class CategoryController extends Controller
{
    public function AllCategory(){
        $category = Category::latest()->get();
        return view('admin.backend.category.all_category', compact('category'));
    }

    public function AddCategory(){
        return view('admin.backend.category.add_category');
    }

    public function StoreCategory(Request $request){
        if($request->file('image')){
            $image = $request->file('image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()).'.'. $image->getClientOriginalExtension();
            $img = $manager->read($image);
            $img->resize(300,300)->save(public_path('upload/category/'.$name_gen));
            $save_url = 'upload/category/'.$name_gen;

            Category::create([
                'category_name' => $request->category_name,
                'image' => $save_url,
            ]);
        }
        $notification = array(
            'message' => 'Category Inserted succesfully',
            'alert-type' => 'success'
        );
    return redirect()->route('all.category')->with($notification);
    }

    public function EditCategory($id){
        $category = Category::find($id);
        return view('admin.backend.category.edit_category', compact('category'));
    }

    public function UpdateCategory(Request $request){
        $cat_id = $request->id;
        if($request->file('image')){
            $image = $request->file('image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()).'.'. $image->getClientOriginalExtension();
            $img = $manager->read($image);
            $img->resize(300,300)->save(public_path('upload/category/'.$name_gen));
            $save_url = 'upload/category/'.$name_gen;

            Category::find($cat_id)->update([
                'category_name' => $request->category_name,
                'image' => $save_url,
            ]);

            $notification = array(
                'message' => 'Category Updated succesfully',
                'alert-type' => 'success'
            );
        return redirect()->route('all.category')->with($notification);
        }else{

            Category::find($cat_id)->update([
                'category_name' => $request->category_name,
                
            ]);

            $notification = array(
                'message' => 'Category Updated succesfully',
                'alert-type' => 'success'
            );
        return redirect()->route('all.category')->with($notification);

        }
        
    }


}
