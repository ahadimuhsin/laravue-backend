<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

//route untuk menampilkan halaman awal
// Route::get('/', 'DashboardController@index');



//ROute di dalam sini hanya bisa diakses ketika sudah login
Route::group(['middleware' => ['auth']], function () {
    //route untuk menampilkan halaman awal
    Route::get('/', 'DashboardController@index');
    Route::get('products/{id}/gallery', 'ProductController@gallery')
    ->name('products.gallery');
    Route::resource('products', 'ProductController');
    Route::resource('product-gallery', 'ProductGalleryController');
    // Route::get('products/delete/{id}', 'ProductController@destroy')->name('products.destroy');
    Route::resource('transactions', 'TransactionController');
});
Auth::routes(["register" => false]);
Route::get('logout', 'Auth\LoginController@logout')->name('logout.nih');

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
