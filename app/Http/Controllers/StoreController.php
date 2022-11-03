<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\Slider;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class StoreController extends Controller
{ 
    public function index()
    {
        $store = Store::with('Slider')->get();
        return $store;
    }
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'image' => 'required|image:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $file= $request->file('image');
        $filename= date('YmdHi').$file->getClientOriginalName();
        $file-> move(public_path('storage/store_image'), $filename);
        $store = Store::create([
            'brand_name' => $data['name'],
            'image' => $filename,
            'unique_id' => $this->UniqueId()
        ]);
        $store_image_name = Store::latest()->first()->image;
        if($store){
            return response()->json([
                'status' => 'success',
                'data' =>  $store,
                'image-url' => Storage::url("store_image/".$store_image_name)   
            ], 201);
        } 
    }
    public function update($id,Request $request){
        // $data = $request->validate([
        //     'name' => 'required',
        //     'image' => 'nullable|image:jpeg,png,jpg,gif,svg|max:2048'
        // ]);
        $store_update = Store::find($id);
        if($store_update){
            if($request->hasFile('image') != null){
                $file= $request->file('image');
                $filename= date('YmdHi').$file->getClientOriginalName();
                $file-> move(public_path('storage/store_image'), $filename);
                if(File::exists(public_path('storage/store_image/'.$store_update->image))){
                   File::delete(public_path('storage/store_image/'.$store_update->image));
                   $store_update->update([
                    'brand_name' => $request->store_name ?? $store_update->brand_name,
                    'image' => $filename
                ]);
                return response()->json([
                    'status' => 'success',
                    'message' =>  "Successfully Updated"    
                ], 201);
                }
                else{
                    $store_update->update([
                        'brand_name' => $request->store_name ?? $store_update->brand_name,
                        'image' => $filename
                    ]);
                    return response()->json([
                        'status' => 'success',
                        'message' =>  "Successfully Updated"    
                    ], 201);
                }
            }
            else{
                $store_update->update([
                    'brand_name' => $request->store_name ?? $store_update->brand_name,
                ]);
                return response()->json([
                    'status' => 'success',
                    'message' =>  "Successfully Updated"    
                ], 201);
            }
        }
        else{
            return response()->json([
                'status' => 'fail',
                'message' =>  "Not Found"    
            ], 404);  
        }
    }
    public function show($uniqueid)
    {
        // $sub_category = SubCategory::with('Category')->find($id);
        // $store = Store::find($uniqueid);
        $store = Store::where(['unique_id' => $uniqueid])->first();
        if($store){
            return response()->json([
                'status' => 'success',
                'data' =>  $store    
            ], 201); 
        }
        else{
            return response()->json([
                'status' => 'fail',
                'message' =>  "Not Found"   
            ], 404); 
        }
    }
    public function showproduct($id)
    {
        $store_product_slider = Store::with('Product','Slider')->find($id);
        if($store_product_slider){
            return response()->json([
                'status' => 'success',
                'data' =>  $store_product_slider    
            ], 201); 
        }
        else{
            return response()->json([
                'status' => 'fail',
                'message' =>  "Not Found"   
            ], 404); 
        }
    }
    public function destroy($id)
    {
        $success = Store::find($id);
        if($success){
            $filename = $success->image;
            $success->delete();
            File::delete(public_path('storage/store_image/'.$filename));
            return response()->json([
                'status' => 'success',
                'message' =>  "Successfully Deleted"   
            ], 201);
        }
        else{
            return response()->json([
                'status' => 'fail',
                'message' =>  "Not Found"   
            ], 404); 
        }
    }
    private function UniqueId()
    {
        $characters = 'lmnopqr1234stuvw56789xyz';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < 5; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
            $finalvouchernumber = 'ZTrade-store'.$randomString;
        }
        return $finalvouchernumber;
    }
}
