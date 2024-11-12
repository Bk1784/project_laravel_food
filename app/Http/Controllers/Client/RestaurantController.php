<?php
namespace App\Http\Controllers\Client;
use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\Models\Category;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver; 
use App\Models\Menu;
class RestaurantController extends Controller
{
    public function AllMenu(){
        $menu = Menu::latest()->get();
        return view('client.backend.menu.all_menu', compact('menu'));
    } 
    public function AddMenu(){

        return view('client.backend.menu.add_menu');
    }
    // End Method 
    public function StoreMenu(Request $request){
        if($request->file('image')){
            $image = $request->file('image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()).'.'. $image->getClientOriginalExtension();
            $img = $manager->read($image);
            $img->resize(300,300)->save(public_path('upload/menu/'.$name_gen));
            $save_url = 'upload/menu/'.$name_gen;

            Menu::create([
                'menu_name' => $request->menu_name,
                'image' => $save_url,
            ]);
        }
        $notification = array(
            'message' => 'Menu Inserted succesfully',
            'alert-type' => 'success'
        );
    return redirect()->route('all.menu')->with($notification);
    }

    public function EditMenu($id){
        $menu = Menu::find($id);
        return view('client.backend.menu.edit_menu', compact('menu'));
    }

    public function UpdateMenu(Request $request){
        $menu_id = $request->id;
        if($request->file('image')){
            $image = $request->file('image');
            $manager = new ImageManager(new Driver());
            $name_gen = hexdec(uniqid()).'.'. $image->getClientOriginalExtension();
            $img = $manager->read($image);
            $img->resize(300,300)->save(public_path('upload/menu/'.$name_gen));
            $save_url = 'upload/menu/'.$name_gen;

            Menu::find($menu_id)->update([
                'menu_name' => $request->menu_name,
                'image' => $save_url,
            ]);

            $notification = array(
                'message' => 'Category Updated succesfully',
                'alert-type' => 'success'
            );
        return redirect()->route('all.menu')->with($notification);
        }else{

            Menu::find($menu_id)->update([
                'menu_name' => $request->menu_name,
                
            ]);

            $notification = array(
                'message' => 'Menu Updated succesfully',
                'alert-type' => 'success'
            );
        return redirect()->route('all.menu')->with($notification);
        }
    }
    public function DeleteMenu($id){
        $item = Menu::find($id);
        $img = $item->image;
        unlink($img);

        $item = Menu::find($id)->delete();

        $notification = array(
            'message' => 'Menu Deleted succesfully',
            'alert-type' => 'success'
        );
    return redirect()->back()->with($notification);
    }

    public function AllProduct(){
        $product = Product::latest()->get();
        return view('client.backend.product.all_product', compact('product'));
    } 
}