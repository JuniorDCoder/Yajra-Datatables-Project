<?php

use App\DataTables\UsersDataTable;
use App\Helpers\ImageFilter;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ProfileController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Intervention\Image\ImageManagerStatic as Image;
use Intervention\Image\ImageManagerStatic;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('user/{id}/edit', function($id){
    return $id;
})->name('user.edit');

Route::get('/dashboard', function (UsersDataTable $dataTable) {
    return $dataTable->render('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('image', function(){
    $img = ImageManagerStatic::make('car.jpg');
    $img->filter(new ImageFilter(5));
    $img->save('car1.jpg', 100);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/shop', [CartController::class, 'shop'])->name('cart.shop');
Route::get('/cart', [CartController::class, 'cart']);
Route::get('add-to-cart/{product_id}', [CartController::class, 'addToCart'])->name('add-to-cart');

Route::get('qty-increment/{rowId}', [CartController::class, 'qtyIncrement'])->name('qty-incremet');
Route::get('qty-decrement/{rowId}', [CartController::class, 'qtyDecrement'])->name('qty-decrement');
Route::get('remove-product/{rowId}', [CartController::class, 'removeProduct'])->name('remove-product');

Route::get('/create-role', function(){
    // $permission = Permission::create(['name' => 'edit articles']);
    // return $permission;

    $user = auth()->user();
    // $user->assignRole('writer');

    // $user->givePermissionTo('edit articles');
    // $permissionNames = $user->getPermissionNames();
    return $user->roles;
});


require __DIR__.'/auth.php';
