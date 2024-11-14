<?php

use App\Http\Controllers\Admin\ManageController;
use App\Http\Controllers\Client\CouponController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Client\RestaurantController;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [UserController::class, 'Index'])->name('index');

// Route::get('/login', [UserController::class, 'showLoginForm'])->name('login');

Route::get('/dashboard', function () {
    return view('frontend.dashboard.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::post('/profile/store', [UserController::class, 'ProfileStore'])->name('profile.store');
    Route::get('/user/logout', [UserController::class, 'UserLogout'])->name('user.logout');
    Route::get('/change/password', [UserController::class, 'ChangePassword'])->name('change.password');
    Route::post('/user/password/update', [UserController::class, 'UserPasswordUpdate'])->name('user.password.update');
    Route::get('/profile/edit', [UserController::class, 'ProfileEdit'])->name('profile.edit');

   
});

require __DIR__.'/auth.php';

Route::middleware('admin')->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])->name('admin.profile');
    Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])->name('admin.profile.store');
    Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])->name('admin.change.password');
    Route::post('/admin/password/update', [AdminController::class, 'AdminPasswordUpdate'])->name('admin.password.update');
});


Route::get('/admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');
Route::post('/admin/login_submit', [AdminController::class, 'AdminLoginSubmit'])->name('admin.login_submit');
Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');
Route::get('/admin/forget_password', [AdminController::class, 'AdminForgetPassword'])->name('admin.forget_password');

Route::post('/admin/password_submit', [AdminController::class, 'AdminPasswordSubmit'])->name('admin.password_submit');

Route::get('/admin/reset-password/{token}/{email}', [AdminController::class, 'AdminResetPassword']);
Route::post('/admin/reset_password_submit', [AdminController::class, 'AdminResetPasswordSubmit'])->name('admin.reset_password_submit');

/// ALL ROUTE FOR CLIENT 

Route::middleware('client')->group(function () {
    Route::get('/client/dashboard', [ClientController::class, 'ClientDashboard'])->name('client.dashboard');
    Route::get('/client/profile', [ClientController::class, 'ClientProfile'])->name('client.profile');
    Route::post('/client/profile/store', [ClientController::class, 'ClientProfileStore'])->name('client.profile.store');
    Route::get('/client/change/password', [ClientController::class, 'ClientChangePassword'])->name('client.change.password');
    Route::post('/client/password/update', [ClientController::class, 'ClientPasswordUpdate'])->name('client.password.update');
    
});

Route::get('/client/login', [ClientController::class, 'ClientLogin'])->name('client.login');
Route::get('/client/register', [ClientController::class, 'ClientRegister'])->name('client.register');
Route::post('/client/register/submit', [ClientController::class, 'ClientRegisterSubmit'])->name('client.register.submit');
Route::post('/client/login_submit', [ClientController::class, 'ClientLoginSubmit'])->name('client.login_submit');
Route::get('/client/logout', [ClientController::class, 'ClientLogout'])->name('client.logout');


// all admin kategori
Route::middleware('admin')->group(function () {
    Route::controller(CategoryController::class)->group(function(){
        Route::get('/all/category', 'AllCategory')->name('all.category');
        Route::get('/add/category', 'AddCategory')->name('add.category');
        Route::post('/store/category', 'StoreCategory')->name('category.store');
        Route::get('/edit/category/{id}', 'EditCategory')->name('edit.category');
        Route::post('/update/category', 'UpdateCategory')->name('category.update');
        Route::get('/delete/category/{id}', 'DeleteCategory')->name('delete.category');
    }); 
});


Route::middleware('admin')->group(function () {
    Route::controller(CategoryController::class)->group(function(){
        Route::get('/all/city', 'AllCity')->name('all.city');
        Route::get('/add/category', 'AddCategory')->name('add.category');
        Route::post('/store/city', 'StoreCity')->name('city.store');
        Route::get('/edit/city/{id}', 'EditCity');
        Route::post('/update/city', 'UpdateCity')->name('city.update');
        Route::get('/delete/city/{id}', 'DeleteCity')->name('delete.city');
    }); 
    Route::controller(ManageController::class)->group(function(){
        Route::get('/admin/all/product', 'AdminAllProduct')->name('admin.all.product');
        Route::get('/admin/add/product', 'AdminAddProduct')->name('admin.add.product');
        Route::post('/admin/store/product', 'AdminStoreProduct')->name('admin.product.store');
        Route::get('/admin/edit/product/{id}', 'AdminEditProduct')->name('admin.edit.product');
        Route::post('/update/product', 'UpdateProduct')->name('product.update');
        Route::get('/delete/product/{id}', 'DeleteProduct')->name('delete.product');
       
    });

});


    Route::middleware('client')->group(function () {
        Route::controller(RestaurantController::class)->group(function(){
            Route::get('/all/menu', 'AllMenu')->name('all.menu');
            Route::get('/add/menu', 'AddMenu')->name('add.menu');
            Route::post('/store/menu', 'StoreMenu')->name('menu.store');
            Route::get('/edit/menu/{id}', 'EditMenu')->name('edit.menu');
            Route::post('/update/menu', 'UpdateMenu')->name('menu.update');
            Route::get('/delete/menu/{id}', 'DeleteMenu')->name('delete.menu');
        }); 
    });

    Route::middleware('client')->group(function () {
        Route::controller(RestaurantController::class)->group(function(){
            Route::get('/all/menu', 'AllMenu')->name('all.menu');
            Route::get('/add/menu', 'AddMenu')->name('add.menu');
            Route::post('/store/menu', 'StoreMenu')->name('menu.store');
            Route::get('/edit/menu/{id}', 'EditMenu')->name('edit.menu');
            Route::post('/update/menu', 'UpdateMenu')->name('menu.update');
            Route::get('/delete/menu/{id}', 'DeleteMenu')->name('delete.menu');
        }); 

        Route::controller(RestaurantController::class)->group(function(){
            Route::get('/all/product', 'AllProduct')->name('all.product');
            Route::get('/add/product', 'AddProduct')->name('add.product');
            Route::post('/store/product', 'StoreProduct')->name('product.store');
            Route::get('/edit/product/{id}', 'EditProduct')->name('edit.product');
            Route::post('/update/product', 'UpdateProduct')->name('product.update');
            Route::get('/delete/product/{id}', 'DeleteProduct')->name('delete.product');
         
        });

        Route::controller(RestaurantController::class)->group(function(){
            Route::get('/all/gallery', 'AllGallery')->name('all.gallery');
            Route::get('/add/gallery', 'AddGallery')->name('add.gallery');
            Route::post('/store/gallery', 'StoreGallery')->name('gallery.store');
            Route::get('/edit/gallery/{id}', 'EditGallery')->name('edit.gallery');
            Route::post('/update/gallery', 'UpdateGallery')->name('gallery.update');
            Route::get('/delete/gallery/{id}', 'DeleteGallery')->name('delete.gallery');
       
        });

        Route::controller(CouponController::class)->group(function(){
            Route::get('/all/coupon', 'AllCoupon')->name('all.coupon');
            Route::get('/add/coupon', 'AddCoupon')->name('add.coupon');
            Route::post('/store/coupon', 'StoreCoupon')->name('coupon.store');
            Route::get('/edit/coupon/{id}', 'EditCoupon')->name('edit.coupon');
            Route::post('/update/coupon', 'UpdateCoupon')->name('coupon.update');
            Route::get('/delete/coupon/{id}', 'DeleteCoupon')->name('delete.coupon');
            
        });

     
    });

    //that will be for all user
    Route::get('/changeStatus', [RestaurantController::class, 'ChangeStatus']);
    
   
