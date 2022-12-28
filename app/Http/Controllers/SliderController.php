<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\Store;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class SliderController extends Controller
{

    function __construct()
    {
         // $this->middleware('permission:slider-list|slider-create|slider-edit|slider-delete', ['only' => ['index','store']]);
         $this->middleware('permission:slider-list', ['only' => ['index']]);
         $this->middleware('permission:slider-create', ['only' => ['create','store']]);
         $this->middleware('permission:slider-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:slider-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slider = Slider::with('Store')->get();
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
            'store_id' => 'required'
        ]);
        $store_id = Store::find($request->store_id);
        if($store_id){
            $file= $request->file('image');
            $filename= time().$file->getClientOriginalName();
            // $filename= $date.$file->getClientOriginalName();
            $file-> move(public_path('storage/slider_image'), $filename);
            $slider = Slider::create([
                'name' => $data['name'],
                'image' => $filename,
                'store_id' => $store_id->id
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
        else{
            $file= $request->file('image');
            $filename= time().$file->getClientOriginalName();
            $file-> move(public_path('storage/slider_image'), $filename);
            $slider = Slider::create([
                'name' => $data['name'],
                'image' => $filename,
                'store_id' => null
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $slider = Slider::with('Store')->find($id);
        if($slider){
            return response()->json([
                'status' => 'success',
                'data' =>  $slider
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
        // return $id;
        // $data = $request->validate([
        //     'slider_name' => 'required|string',
        //     'image' => 'nullable|image:jpeg,png,jpg,gif,svg|max:2048',
        //     'store_id' => 'required'
        // ]);
        $slider_find_to_update = Slider::find($id);
        $storeid_to_update = Store::find($request->store_id);
        // dd($storeid_to_update);
        if($slider_find_to_update && $storeid_to_update){
            if($request->hasFile('image') != null){
                $file= $request->file('image');
                $filename= time().$file->getClientOriginalName();
                $file-> move(public_path('storage/slider_image'), $filename);
                if(File::exists(public_path('storage/slider_image/'.$slider_find_to_update->image))){
                    File::delete(public_path('storage/slider_image/'.$slider_find_to_update->image));
                    $slider_find_to_update->update([
                        'name' => $request->slider_name ?? $slider_find_to_update->name,
                        'image' => $filename,
                        'store_id' =>$request->store_id ?? $slider_find_to_update->store_id
                    ]);
                    return response()->json([
                        'status' => 'success',
                        'message' =>  "Successfully Updated"
                    ], 201);
                }
                else{
                    $slider_find_to_update->update([
                        'name' => $request->slider_name ?? $slider_find_to_update->name,
                        'image' => $filename ?? $slider_find_to_update->image,
                        'store_id' => $request->store_id ?? $slider_find_to_update->store_id
                    ]);
                    return response()->json([
                        'status' => 'success',
                        'message' =>  "Successfully Updated"
                    ], 201);
                }
            }
            else{
                $slider_find_to_update->update([
                    'name' => $request->slider_name ?? $slider_find_to_update->name,
                    'store_id' => $request->store_id ?? $slider_find_to_update->store_id
                ]);
                return response()->json([
                    'status' => 'success',
                    'message' =>  "Successfully Updated"
                ], 201);
            }
        }
        else{
            if($request->hasFile('image') != null){
                $file= $request->file('image');
                $filename= time().$file->getClientOriginalName();
                $file-> move(public_path('storage/slider_image'), $filename);
                if(File::exists(public_path('storage/slider_image/'.$slider_find_to_update->image))){
                    File::delete(public_path('storage/slider_image/'.$slider_find_to_update->image));
                    $slider_find_to_update->update([
                        'name' => $request->slider_name ?? $slider_find_to_update->name,
                        'image' => $filename,
                        'store_id' => null
                    ]);
                    return response()->json([
                        'status' => 'success',
                        'message' =>  "Successfully Updated"
                    ], 201);
                }
                else{
                    $slider_find_to_update->update([
                        'name' => $request->slider_name ?? $slider_find_to_update->name,
                        'image' => $filename ?? $slider_find_to_update->image,
                        'store_id' => null
                    ]);
                    return response()->json([
                        'status' => 'success',
                        'message' =>  "Successfully Updated"
                    ], 201);
                }
            }
            else{
                $slider_find_to_update->update([
                    'name' => $request->slider_name ?? $slider_find_to_update->name,
                    'store_id' => null
                ]);
                return response()->json([
                    'status' => 'success',
                    'message' =>  "Successfully Updated"
                ], 201);
            }
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
