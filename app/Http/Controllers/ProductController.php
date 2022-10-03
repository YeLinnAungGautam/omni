<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Percentages;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Store;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'price' => 'required|string',
            'item_description' => 'required|string',
            'thumbnails' => 'required',
            'category_id' => 'required',
            'percentage_id' => 'required',
            // 'item_id' => 'required',
            'store_id' => 'nullable'
        ]);
        $category_id = Category::find($request->category_id);
        // $store_id = Store::find($request->store_id);
        $percentage_id = Percentages::find($request->percentage_id);
        if($category_id && $percentage_id){
            $product = Product::create([
                'name' => $data['name'],
                'price' => $data['price'],
                'item_description' => $data['item_description'],
                'category_id' => $data['category_id'],
                'percentage_id' => $data['percentage_id'],
                'item_id' => $this->Itemid(),
                'store_id' => $data['store_id'],
            ]);
            $store_multiple_image = array();
            $product_id = Product::latest()->first()->id;
            if($request->hasFile('thumbnails')){
                foreach($request->file('thumbnails') as $file){
                    $image_name = md5(rand(1000, 10000));
                    $ext = strtolower($file->getClientOriginalExtension());
                    $image_full_name = $image_name.'.'.$ext;
                    $file->move(public_path('storage/product_image'), $image_full_name);
                    $store_multiple_image[] = $image_full_name;
                }
                if($product_id){
                    foreach($store_multiple_image as $value) {
                        $image = ProductImage::create([
                            'thumbnails' => json_encode($value),
                            'product_id' => $product_id
                        ]); 
                      }
                      $image_to_get = ProductImage::where('product_id',$product_id)->get(['thumbnails']);
                    //   $thumbnails_length = count($image_to_get);
                    // foreach($image_to_get as $value) {
                    //     $result[$value['thumbnails']] = $value['name'];
                    //     //  $result = [$value['thumbnails']];
                    // }
                      return response()->json([
                        'status' => 'success',
                        'data' =>  $product,
                        'image' => $image_to_get
                    ], 201);
                }
                else{
                    return response()->json([
                        'status' => 'fail',
                        'message' =>  "Not Found"    
                    ], 404); 
                }
            }
            else{
                return response()->json([
                    'status' => 'fail',
                    'message' =>  "Not Found"    
                ], 404); 
            }
        }
        else{
            return response()->json([
                'status' => 'Fail',
                'message' =>  "Not Found"    
            ], 404); 
        }
    }
    private function Itemid()
    {
        $characters = 'abcdef12345ghijklm67890';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 5; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
            $finalvouchernumber = 'ZT'.$randomString;
        }
        return $finalvouchernumber;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::with('Category','Percentage','Store','ProductImage')->find($id);
        if($product){
            return response()->json([
                'status' => 'success',
                'data' =>  $product    
            ], 201); 
        }
        else{
            return response()->json([
                'status' => 'fail',
                'message' =>  "Not Found"   
            ], 404); 
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
