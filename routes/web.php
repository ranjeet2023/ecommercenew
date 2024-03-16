<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashBoardController;
use Illuminate\Http\Request;
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

Route::get('/', function () {
    return view('welcome');
});
Route::group(['prefix'=> 'admin'], function(){
    Route::group(['middleware'=> 'admin.guest'],function () {
        Route::get('/login',[AdminLoginController::class,'index'])->name('admin.login');
    });
    Route::group(['middleware'=> 'admin.auth'],function () {
        Route::post('admin-login',[AdminLoginController::class,'login']);
        Route::get('dashboard',[DashBoardController::class,'index']);
        Route::get('logout',[AdminLoginController::class,'logout']);
        //category Routes 
        Route::get('category',[CategoryController::class,'create']);
        Route::post('create-category',[CategoryController::class,'store']);
        Route::post('/getSlug',function(Request $request){
            $slug ='';
            if(!empty($request->name)){
                $slug = Str::slug($request->name);
            }
            return response()->json(
                [
                'status'=>true ,
                'slug' => $slug
               ]);
        });
        Route::get('getCategory',[CategoryController::class,'index']);
        Route::get('search-category',[CategoryController::class,'index']);

    });
}); 

