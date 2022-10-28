<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\AboutUs;

class AboutUsController extends Controller
{
    public function store(Request $request)
    { 
        $data = $request->validate([
            'description' => 'required|string',
        ]);
        $aboutus = AboutUs::create([
            'description' => $data['description'],
        ]);
        return response()->json([
            'status' => 'success',
            'data' =>  $aboutus,
        ], 201);
    }

    public function index()
    {
        $aboutus = AboutUs::all();
        return $aboutus;
    }

    public function show($id)
    {
        $aboutus = AboutUs::find($id);
        if($aboutus){
            return response()->json([
                'status' => 'success',
                'data' =>  $aboutus    
            ], 201); 
        }
        else{
            return response()->json([
                'status' => 'fail',
                'message' =>  "Not Found"   
            ], 404); 
        }
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'description' => 'required|string',
        ]);
        $aboutus_find_to_update = AboutUs::find($id);
        if($aboutus_find_to_update){
            $aboutus_find_to_update->update([
                'description' => $data['description'],
            ]);
            return response()->json([
                'status' => 'success',
                'message' =>  "Successfully Updated"   
            ], 201);
        }
        else{
            return response()->json([
                'status' => 'fail',
                'message' =>  "Not Found"   
            ], 404);
        }
    }
    
    public function delete($id){
        $success = AboutUs::find($id);
        if($success){
            $success->delete();
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
