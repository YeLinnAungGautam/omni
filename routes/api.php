<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\PercentageController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StoreController;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\RegisterController;
use SebastianBergmann\CodeCoverage\Util\Percentage;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['middleware' => ['auth:sanctum']], function(){

    //Category Protected Route 
    Route::post('/category/create',[CategoryController::class,'store']);
    Route::put('/category/update/{id}',[CategoryController::class,'update']);
    Route::delete('/category/delete/{id}',[CategoryController::class,'destroy']);

    //SubCategory Protected Route 
    Route::post('/subcategory/create',[SubCategoryController::class,'store']);
    Route::put('/subcategory/update/{id}',[SubCategoryController::class,'update']);
    Route::delete('/subcategory/delete/{id}',[SubCategoryController::class,'destroy']);

    //Percentage Protected Route
    Route::post('/percentage/create',[PercentageController::class,'store']);
    Route::put('/percentage/update/{id}',[PercentageController::class,'update']);

    //Store Protected Route
    Route::post('/store/create',[StoreController::class,'store']);
    Route::put('/store/update/{id}',[StoreController::class,'update']);
    Route::delete('/store/delete/{id}',[StoreController::class,'destroy']);

    //Slider Protected Route 
    Route::post('/slider/create',[SliderController::class,'store']);
    Route::put('/slider/update/{id}',[SliderController::class,'update']);
    Route::delete('/slider/delete/{id}',[SliderController::class,'destroy']);

    //Product Protected Route
    Route::post('/product/create',[ProductController::class,'store']);
    Route::put('/product/update/{id}',[ProductController::class,'update']);
    Route::delete('/product/delete/{id}',[ProductController::class,'destroy']);

    //AboutUs Protected Route
    Route::post('/aboutus/create',[AboutUsController::class,'store']);
    Route::put('/aboutus/update/{id}',[AboutUsController::class,'update']);
    Route::delete('/aboutus/delete/{id}',[AboutUsController::class,'delete']);
});

    //Register 
    Route::post('/user/register',[RegisterController::class,'store']);
    Route::post('/login',[RegisterController::class,'login']);

    //Category 
    Route::get('/category/list',[CategoryController::class,'index']);
    Route::get('/category/show/{id}',[CategoryController::class,'show']);

    // SubCategory 
    Route::get('/subcategory/list',[SubCategoryController::class,'index']);
    Route::get('/subcategory/show/{id}',[SubCategoryController::class,'show']);

    //Store
    Route::get('/store/list',[StoreController::class,'index']);
    Route::get('/store/show/{uniqueid}',[StoreController::class,'show']);
    Route::get('/store/showwithproduct/{id}',[StoreController::class,'showproduct']);

    //Slider 
    Route::get('/slider/list',[SliderController::class,'index']);
    Route::get('slider/show/{id}',[SliderController::class,'show']);

    //Product 
    Route::get('/product/list',[ProductController::class,'index']);
    Route::get('/product/show/{id}',[ProductController::class,'show']);

    //About Us 
    Route::get('/aboutus/list',[AboutUsController::class,'index']);
    Route::get('/aboutus/show/{id}',[AboutUsController::class,'show']);



