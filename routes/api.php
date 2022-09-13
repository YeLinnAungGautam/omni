<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\PercentageController;
use App\Http\Controllers\CategoryController;
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
