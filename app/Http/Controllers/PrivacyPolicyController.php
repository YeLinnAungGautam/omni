<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PrivacyPolicy;

class PrivacyPolicyController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'description' => 'required|string',
        ]);
        $privacy_policy = PrivacyPolicy::create([
            'description' => $data['description'],
        ]);
        return response()->json([
            'status' => 'success',
            'data' =>  $privacy_policy,
        ], 201);
    }
    public function index()
    {
        $privacy_policy = PrivacyPolicy::all()->first();
        return $privacy_policy;
    }
    public function show($id)
    {
        $privacy_policy = PrivacyPolicy::find($id);
        if($privacy_policy){
            return response()->json([
                'status' => 'success',
                'data' =>  $privacy_policy
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
        $privacy_policy_find_to_update = PrivacyPolicy::find($id);
        if($privacy_policy_find_to_update){
            $privacy_policy_find_to_update->update([
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
    public function delete($id)
    {
        $success = PrivacyPolicy::find($id);
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
