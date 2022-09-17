<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slider = Slider::all();
        return $slider;
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
            'image' => 'required|image:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $file= $request->file('image');
        $filename= date('YmdHi').$file->getClientOriginalName();
        $file-> move(public_path('storage/slider_image'), $filename);
        $slider = Slider::create([
            'name' => $data['name'],
            'image' => $filename,
        ]);
        $slider_image_name = Slider::latest()->first()->image;
        return response()->json([
            'status' => 'success',
            'data' =>  $slider,
            'image-url' => Storage::url("slider_image/".$slider_image_name)
            //if get the error of not found for image url,
            //please run the "php artisan storage:link" command.
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        // return $id;
        $data = $request->validate([
            'slider_name' => 'required|string',
            'image' => 'nullable|image:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        $slider_find_to_update = Slider::find($id);
        if($slider_find_to_update){
            if($request->hasFile('image') != null){
                $file= $request->file('image');
                $filename= date('YmdHi').$file->getClientOriginalName();
                $file-> move(public_path('storage/slider_image'), $filename);
                if(File::exists(public_path('storage/slider_image/'.$slider_find_to_update->image))){
                    File::delete(public_path('storage/slider_image/'.$slider_find_to_update->image));
                    $slider_find_to_update->update([
                        'name' => $data['slider_name'],
                        'image' => $filename
                    ]);
                    return response()->json([
                        'status' => 'success',
                        'message' =>  "Successfully Updated"    
                    ], 201);
                }
                else{   
                    $slider_find_to_update->update([
                        'name' => $data['slider_name'],
                        'image' => $filename
                    ]);
                    return response()->json([
                        'status' => 'success',
                        'message' =>  "Successfully Updated"    
                    ], 201);
                }   
            }
            else{
                $slider_find_to_update->update([
                    'name' => $data['slider_name'],
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slider = Slider::find($id);
        if($slider){
            $filename = $slider->image;
            $slider->delete();
            File::delete(public_path('storage/slider_image/'.$filename));
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
