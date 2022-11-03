<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class BannerController extends Controller
{
    
    public function index()
    {
        $banner = Banner::all();
        return $banner;
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'image' => 'required|image:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $file= $request->file('image');
        $filename= date('YmdHi').$file->getClientOriginalName();
        $file-> move(public_path('storage/banner_image'), $filename);
        $banner = Banner::create([
            'name' => $data['name'],
            'image' => $filename,
        ]);
        $banner_image_name = Banner::latest()->first()->image;
        if($banner){
            return response()->json([
                'status' => 'success',
                'data' =>  $banner,
                'image-url' => Storage::url("banner_image/".$banner_image_name)   
            ], 201);
        }
    }

    public function update($id,Request $request)
    {
        // $data = $request->validate([
        //     'name' => 'required',
        //     'image' => 'nullable|image:jpeg,png,jpg,gif,svg|max:2048'
        // ]);
        $banner_update = Banner::find($id);
        if($banner_update){
            if($request->hasFile('image') != null){
                $file= $request->file('image');
                $filename= date('YmdHi').$file->getClientOriginalName();
                $file-> move(public_path('storage/banner_image'), $filename);
                if(File::exists(public_path('storage/banner_image/'.$banner_update->image))){
                   File::delete(public_path('storage/banner_image/'.$banner_update->image));
                   $banner_update->update([
                    'brand_name' => $request->name ?? $banner_update->name,
                    'image' => $filename
                ]);
                return response()->json([
                    'status' => 'success',
                    'message' =>  "Successfully Updated"    
                ], 201);
                }
                else{
                    $banner_update->update([
                        'brand_name' => $request->name ?? $banner_update->name,
                        'image' => $filename ?? $banner_update->image
                    ]);
                    return response()->json([
                        'status' => 'success',
                        'message' =>  "Successfully Updated"    
                    ], 201);
                }
            }
            else{
                $banner_update->update([
                    'brand_name' => $request->name ?? $banner_update->name,
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
        $banner = Banner::find($id);
        if($banner){
            return response()->json([
                'status' => 'success',
                'data' =>  $banner  
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
        $success = Banner::find($id);
        if($success){
            $filename = $success->image;
            $success->delete();
            File::delete(public_path('storage/banner_image/'.$filename));
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
