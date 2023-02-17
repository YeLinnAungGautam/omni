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
use App\Http\Controllers\UserController;
use App\Http\Controllers\NonAuthController;
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

// Route::group(['middleware' => ['auth:sanctum']], function(){
//   Route::post('/slider/create',[SliderController::class,'store']);
//   Route::get('/slider/list',[SliderController::class,'index']);
// });
 Route::get('/search/relatedproducts/{name}',[NonAuthController::class,'relatedProducts']);
  Route::get('/wishlist/data/{id}',[NonAuthController::class,'getUserWishList']);
    Route::get('/search/suggestions',[NonAuthController::class,'searchSuggestions']);
   
    Route::get('/slider/list',[NonAuthController::class,'sliderList']);
    //Category Protected Route
    Route::get('/ztrade/index/product',[HomeController::class,'product']);
    Route::get('/ztrade/index',[HomeController::class,'index']);
    Route::get('/roleandpermission/lists',[RoleController::class,'index']);
    Route::post('/addroleandpermision/',[RoleController::class,'store']);
    Route::get('/permission/lists',[RoleController::class,'index']);
    Route::get('/staffs',[UserController::class,'index']);
    Route::post('/adduser',[UserController::class,'store']);

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
    Route::post('/user/login',[RegisterController::class,'userlogin']);

    //Category

    Route::get('/category/list',[NonAuthController::class,'categoryList']);
    Route::get('/category/list/pgtest/{categoryId}',[NonAuthController::class,'categoryListShowTest']);
    Route::get('/category/list/user/{userid}',[NonAuthController::class,'categoryUserList']);
    Route::get('/category/show/{id}',[NonAuthController::class,'categoryListShow']);

    // SubCategory
    Route::get('/subcategory/list',[NonAuthController::class,'subCategoryList']);
    Route::get('/subcategory/show/{id}',[NonAuthController::class,'subCategoryShow']);

    //Store
    Route::get('/store/list',[NonAuthController::class,'brandList']);
    Route::get('/store/show/{uniqueid}',[NonAuthController::class,'brandShow']);
    Route::get('/store/showwithproduct/{id}',[NonAuthController::class,'showBrandWithProduct']);

    //Slider
    // Route::get('/slider/list',[SliderController::class,'index']);
    Route::get('slider/show/{id}',[SliderController::class,'show']);

    //Banner
    Route::get('/banner/list',[BannerController::class,'index']);
    Route::get('banner/show/{id}',[BannerController::class,'show']);

    //Product
    Route::get('/product/list',[NonAuthController::class,'productList']);
     Route::get('/product/subcategory/list/pgtest/{categoryId}',[NonAuthController::class,'productSubListTest']);
    Route::get('/product/list/pgtest/{categoryId}',[NonAuthController::class,'productListTest']);
    Route::get('/product/show/{id}',[NonAuthController::class,'productShow']);

    //USer
    Route::get('/user/show/{id}',[RegisterController::class,'show']);

    //About Us
    Route::get('/aboutus/list',[NonAuthController::class,'aboutus']);
    Route::get('/aboutus/show/{id}',[AboutUsController::class,'show']);

    //Privacy Policy
    Route::get('/privacypolicy/list',[NonAuthController::class,'privacypolicy']);
    Route::get('/privacypolicy/show/{id}',[PrivacyPolicyController::class,'show']);

    //TermandCondition
    Route::get('/termandcondition/list',[NonAuthController::class,'termsandconditions']);
    Route::get('/termandcondition/show/{id}',[TermandConditionController::class,'show']);

    //New Arrival
    Route::get('/newarrival',[ProductController::class,'newarrival']);

    //Most Popular
    Route::get('/mostpopular',[ProductController::class,'mostpopular']);

    //Top Selling
    Route::get('/topselling',[ProductController::class,'topselling']);
