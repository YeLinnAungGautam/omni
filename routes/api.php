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
use App\Http\Controllers\BannerController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PrivacyPolicyController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TermandConditionController;
use App\Http\Controllers\SocialController;
use App\Http\Controllers\IconController;
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


});
    //Category Protected Route
    Route::get('/ztrade/index',[HomeController::class,'index']);
    Route::post('/category/create',[CategoryController::class,'store']);
    Route::post('/category/update/{id}',[CategoryController::class,'update']);
    Route::delete('/category/delete/{id}',[CategoryController::class,'destroy']);

    //SubCategory Protected Route
    Route::post('/subcategory/create',[SubCategoryController::class,'store']);
    Route::post('/subcategory/update/{id}',[SubCategoryController::class,'update']);
    Route::delete('/subcategory/delete/{id}',[SubCategoryController::class,'destroy']);

    //Percentage Protected Route
    Route::post('/percentage/create',[PercentageController::class,'store']);
    Route::post('/percentage/update/{id}',[PercentageController::class,'update']);
    Route::get('/percentage/show/{id}',[PercentageController::class,'show']);

    //Store Protected Route
    Route::post('/store/create',[StoreController::class,'store']);
    Route::post('/store/update/{id}',[StoreController::class,'update']);
    Route::delete('/store/delete/{id}',[StoreController::class,'destroy']);

    //Slider Protected Route
    Route::post('/slider/create',[SliderController::class,'store']);
    Route::post('/slider/update/{id}',[SliderController::class,'update']);
    Route::delete('/slider/delete/{id}',[SliderController::class,'destroy']);

    //Banner Protected Route
    Route::post('/banner/create',[BannerController::class,'store']);
    Route::post('/banner/update/{id}',[BannerController::class,'update']);
    Route::delete('/banner/delete/{id}',[BannerController::class,'destroy']);


    //Product Protected Route
    Route::post('/product/create',[ProductController::class,'store']);
    Route::post('/product/update/{id}',[ProductController::class,'update']);
    Route::delete('/product/imagedelete/{id}',[ProductController::class,'destroyImage']);
    Route::delete('/product/delete/{id}',[ProductController::class,'destroy']);

    //Privacy Policy Protected Route
    Route::post('/privacypolicy/create',[PrivacyPolicyController::class,'store']);
    Route::post('/privacypolicy/update/{id}',[PrivacyPolicyController::class,'update']);
    Route::delete('/privacypolicy/delete/{id}',[PrivacyPolicyController::class,'delete']);

    //TermandCondition Protected Route
    Route::post('/termandcondition/create',[TermandConditionController::class,'store']);
    Route::post('/termandcondition/update/{id}',[TermandConditionController::class,'update']);
    Route::delete('/termandcondition/delete/{id}',[TermandConditionController::class,'delete']);

    //AboutUs Protected Route
    Route::post('/aboutus/create',[AboutUsController::class,'store']);
    Route::post('/aboutus/update/{id}',[AboutUsController::class,'update']);
    Route::delete('/aboutus/delete/{id}',[AboutUsController::class,'delete']);

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

    //Banner
    Route::get('/banner/list',[BannerController::class,'index']);
    Route::get('banner/show/{id}',[BannerController::class,'show']);

    //Product
    Route::get('/product/list',[ProductController::class,'index']);
    Route::get('/product/show/{id}',[ProductController::class,'show']);

    //USer
    Route::get('/user/show/{id}',[RegisterController::class,'show']);
    Route::post('/user/update/{id}',[RegisterController::class,'update']);

    //About Us
    Route::get('/aboutus/list',[AboutUsController::class,'index']);
    Route::get('/aboutus/show/{id}',[AboutUsController::class,'show']);

    //Privacy Policy
    Route::get('/privacypolicy/list',[PrivacyPolicyController::class,'index']);
    Route::get('/privacypolicy/show/{id}',[PrivacyPolicyController::class,'show']);

    //TermandCondition
    Route::get('/termandcondition/list',[TermandConditionController::class,'index']);
    Route::get('/termandcondition/show/{id}',[TermandConditionController::class,'show']);

    //New Arrival
    Route::get('/newarrival',[ProductController::class,'newarrival']);

    //Most Popular
    Route::get('/mostpopular',[ProductController::class,'mostpopular']);

    //Top Selling
    Route::get('/topselling',[ProductController::class,'topselling']);
