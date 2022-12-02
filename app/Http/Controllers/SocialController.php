<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Social;

class SocialController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'facebook' => 'required|string',
            'instagram' => 'required|string',
            'youtube' => 'required|string',
            'linkedin' => 'required|string',
        ]);
        $social = Social::create([
            'facebook' => $data['facebook'],
            'instagram' => $data['instagram'],
            'youtube' => $data['youtube'],
            'linkedin' => $data['linkedin']
        ]);
        return response()->json([
            'status' => 'success',
            'data' =>  $social,
        ], 201);
    } 
    
    public function index()
    {
        $social = Social::all();
        return $social;
    }

    public function show($id)
    {
        $social = Social::find($id);
        if($social){
            return response()->json([
                'status' => 'success',
                'data' =>  $social    
            ], 201); 
        }
        else{
            return response()->json([
                'status' => 'fail',
                'message' =>  "Not Found"   
            ], 404); 
        }
    }

    public function update(Request $request,$id)
    {
        $social = Social::find($id);
        if($social){
           $social->update([
            'facebook'  => $request->facebook ?? $social->facebook,
            'instagram' => $request->instagram ?? $social->instagram,
            'youtube'   => $request->youtube ?? $social->youtube,
            'linkedin'  => $request->linkedin ?? $social->linkedin,
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

    public function destroy($id)
    {
        $social = Social::find($id);
        if($social){
            $social->delete();
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
