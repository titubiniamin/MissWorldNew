<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\UserController;
use App\Models\MwStep;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

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

Route::view('/', 'welcome');

Auth::routes();
/////////////////////////////////////////////////////////////////////////////////////////
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
/////////////////////////User/////////////////////////////////////
/// /////////////////////////////////////////////////////////////////
    Route::middleware('auth')->group(function () {
    Route::get('/home', [UserController::class, 'index'])->name('home');
    Route::post('user/logout', [UserController::class, 'logout'])->name('user.logout');
    Route::post('/applicant/register', [UserController::class, 'updateRegister'])->name('applicant.register');
    Route::get('get-district/{id}', [UserController::class, 'getDistrict'])->name('get.district');
    Route::get('get-upazillas/{id}', [UserController::class, 'getUpazillas'])->name('get.upzilla');
});
//////////////////////Facebook//////////////////////////////////////////////
    Route::get('auth/facebook', [SocialController::class, 'facebookRedirect']);
    Route::get('auth/facebook/callback', [SocialController::class, 'loginWithFacebook']);
    /////////////////////Admin///////////////////////////////
/////////////////////////////////////////////////////////
    Route::group(['prefix' => 'admin'], function () {
    Route::group(['middleware' => 'admin.guest'], function () {
        Route::get('/login', [AdminController::class,'viewAdminLogin'])->name('admin.login');
        Route::post('/login', [AdminController::class, 'authenticate'])->name('admin.auth');
        Route::get('/send/auth/request',[AdminController::class,'adminAuthRequest'])->name('admin.send.auth.request');
        Route::post('/send/auth/request',[AdminController::class,'postAdminAuthRequest'])->name('post.admin.auth.request');
        });
    Route::group(['middleware' => 'admin.auth'], function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/logout', [AdminController::class, 'logout'])->name('admin.logout');
        Route::view('/auction', 'admin.auction')->name('auction.entry');
        Route::post('/auction/store', [AdminController::class, 'auctionStore'])->name('auction.store');
        Route::get('step-change/{id}',[AdminController::class, 'stepChange']);
    });
});
Route::get('admin/getData', [AdminController::class, 'getData'])->name('admin.getData');
Route::get('admin/dashboard2view', [AdminController::class, 'dashboard2view'])->name('admin.dashboard2view');

Route::get('test',function (Request $request){
//    $now=now();
//    echo strtotime($now);
//dd(tempnam(sys_get_temp_dir(),'testtes'));
    $filename = 'temp-image.jpg';
    $tempImage = tempnam(sys_get_temp_dir(), $filename);
    dd($tempImage);
    copy('https://i0.wp.com/www.techjunkie.com/wp-content/uploads/2020/08/How-to-Copy-and-Get-a-Link-to-Any-Online-Image-Embedded-in-a-Website.jpg?resize=660%2C430&ssl=1', $tempImage);

    return response()->download($tempImage, $filename);
//    print_r($interval->y);
//    print($interval->format('%Y years %d days'));
//    echo $diff->y;
})->name('test');

Route::get('test2',[AdminController::class,'test2'])->name('test2');

Route::get('search',[AdminController::class,'dashboardData'])->name('search');
//Route::resource('product',\App\Http\Controllers\ProductController::class);

//Route::view('admin/login','admin.login')->name('admin.login');
//Route::post('admin/login',[AdminController::class,'login'])->name('admin.auth');
