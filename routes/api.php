<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\PercentageController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\StoreController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//Category 
Route::post('/category/create',[CategoryController::class,'store']);
Route::get('/category/list',[CategoryController::class,'index']);
Route::get('/category/show/{id}',[CategoryController::class,'show']);
Route::put('/category/update/{id}',[CategoryController::class,'update']);
Route::delete('/category/delete/{id}',[CategoryController::class,'destroy']);

// SubCategory 
Route::post('/subcategory/create',[SubCategoryController::class,'store']);
Route::get('/subcategory/list',[SubCategoryController::class,'index']);
Route::get('/subcategory/show/{id}',[SubCategoryController::class,'show']);
Route::put('/subcategory/update/{id}',[SubCategoryController::class,'update']);
Route::delete('/subcategory/delete/{id}',[SubCategoryController::class,'destroy']);

//Percentage
Route::post('/percentage/create',[PercentageController::class,'store']);
Route::put('/percentage/update/{id}',[PercentageController::class,'update']);

//Store
Route::post('/store/create',[StoreController::class,'store']);
Route::get('/store/list',[StoreController::class,'index']);
Route::put('/store/update/{id}',[StoreController::class,'update']);
Route::get('/store/show/{id}',[StoreController::class,'show']);
Route::get('/store/showwithproduct/{id}',[StoreController::class,'showproduct']);
Route::delete('/store/delete/{id}',[StoreController::class,'destroy']);

//Slider 
Route::post('/slider/create',[SliderController::class,'store']);
Route::get('/slider/list',[SliderController::class,'index']);
Route::put('/slider/update/{id}',[SliderController::class,'update']);
Route::get('slider/show/{id}',[SliderController::class,'show']);
Route::delete('/slider/delete/{id}',[SliderController::class,'destroy']);

//Product 
Route::post('/product/create',[ProductController::class,'store']);
Route::get('/product/list',[ProductController::class,'index']);
Route::get('/product/show/{id}',[ProductController::class,'show']);
Route::put('/product/update/{id}',[ProductController::class,'update']);
Route::delete('/product/delete/{id}',[ProductController::class,'destroy']);


