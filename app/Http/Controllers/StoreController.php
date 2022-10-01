<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store;
use App\Models\Slider;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class StoreController extends Controller
{ 
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'image' => 'required|image:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $file= $request->file('image');
        $filename= date('YmdHi').$file->getClientOriginalName();
        $file-> move(public_path('storage/store_image'), $filename);
        $store = Store::create([
            'brand_name' => $data['name'],
            'image' => $filename
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
        $data = $request->validate([
            'name' => 'required',
            'image' => 'nullable|image:jpeg,png,jpg,gif,svg|max:2048'
        ]);
        $store_update = Store::find($id);
        if($store_update){
            if($request->hasFile('image') != null){
                $file= $request->file('image');
                $filename= date('YmdHi').$file->getClientOriginalName();
                $file-> move(public_path('storage/store_image'), $filename);
                if(File::exists(public_path('storage/store_image/'.$store_update->image))){
                   File::delete(public_path('storage/store_image/'.$store_update->image));
                   $store_update->update([
                    'brand_name' => $data['name'],
                    'image' => $filename
                ]);
                return response()->json([
                    'status' => 'success',
                    'message' =>  "Successfully Updated"    
                ], 201);
                }
                else{
                    $store_update->update([
                        'brand_name' => $data['name'],
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
                    'brand_name' => $data['name']
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
    public function show($id)
    {
        // $sub_category = SubCategory::with('Category')->find($id);
        $store = Store::with('Slider')->find($id);
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
}
