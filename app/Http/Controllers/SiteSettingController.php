<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SiteSetting;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class SiteSettingController extends Controller
{
    //
    public function upload(Request $request)
    {
        // $data = $request->validate([
        //     'mobile_login_icon' => 'required|image:jpeg,png,jpg,gif,svg|max:2048',
        //     'web_login_icon' => 'required|image:jpeg,png,jpg,gif,svg|max:2048',
        // ]);

        $input = $request->all();
        
        if($mobile_login_icon_image = $request->file('mobile_login_icon'))
        {
            $destinationPath = 'storage/site_setting';
            $imageone = "mobile_login_icon". "." . $mobile_login_icon_image->getClientOriginalExtension();
            $mobile_login_icon_image->move($destinationPath, $imageone);
            $input['mobile_login_icon'] = "$imageone";
        }
        if($web_login_icon_image = $request->file('web_login_icon'))
        {
            $destinationPath = 'storage/site_setting';
            $imagetwo = "web_login_icon" . "." . $web_login_icon_image->getClientOriginalExtension();
            $web_login_icon_image->move($destinationPath, $imagetwo);
            $input['web_login_icon'] = "$imagetwo";
        }
        if($mobile_loading_icon_image = $request->file('mobile_loading_icon'))
        {
            $destinationPath = 'storage/site_setting';
            $imagethree = "mobile_loading_icon" . "." . $mobile_loading_icon_image->getClientOriginalExtension();
            $mobile_loading_icon_image->move($destinationPath, $imagethree);
            $input['mobile_loading_icon'] = "$imagethree";
        }
        if($web_register_icon_image = $request->file('web_register_icon'))
        {
            $destinationPath = 'storage/site_setting';
            $imagefour = "web_register_icon" . "." . $web_register_icon_image->getClientOriginalExtension();
            $web_register_icon_image->move($destinationPath, $imagefour);
            $input['web_register_icon'] = "$imagefour";
        }
        if($web_icon_image = $request->file('web_icon'))
        {
            $destinationPath = 'storage/site_setting';
            $imagefive = "web_icon" . "." . $web_icon_image->getClientOriginalExtension();
            $web_icon_image->move($destinationPath, $imagefive);
            $input['web_icon'] = "$imagefive";
        }
        if($web_tab_icon_image = $request->file('web_tab_icon'))
        {
            $destinationPath = 'storage/site_setting';
            $imagesix = "web_tab_icon" . "." . $web_tab_icon_image->getClientOriginalExtension();
            $web_tab_icon_image->move($destinationPath, $imagesix);
            $input['web_tab_icon'] = "$imagesix";
        }
        SiteSetting::create($input);
        return response()->json([
            'status' => 'success',
            'message' => "Icons Are Saved Successfully"
        ]);
    } 
    public function update($id,Request $request)
    {
        $image_find_to_update = SiteSetting::find($id);
        if($image_find_to_update){
            $input = $request->all();
            if($request->File('mobile_login_icon') != null)
            {
                $mobile_login_icon_image = $request->file('mobile_login_icon');
                // File::delete(public_path('storage/site_setting/'.$image_find_to_update->mobile_login_icon));
                $destinationPath = 'storage/site_setting';
                $imageone = "mobile_login_icon". "." . $mobile_login_icon_image->getClientOriginalExtension();
                $mobile_login_icon_image->move($destinationPath, $imageone);
                $input['mobile_login_icon'] = "$imageone"; 
                $image_find_to_update->mobile_login_icon = $imageone;
                $image_find_to_update->save();
                $image_find_to_update->update([
                    'mobile_login_icon' => $imageone
                ]);
               
            }
            if($request->file('web_login_icon') != null) {
                $web_login_icon_image = $request->file('web_login_icon');
                File::delete(public_path('storage/site_setting/'.$image_find_to_update->web_login_icon));
                $destinationPath = 'storage/site_setting';
                $imagetwo = "web_login_icon" . "." . $web_login_icon_image->getClientOriginalExtension();
                $web_login_icon_image->move($destinationPath, $imagetwo);
                $input['web_login_icon'] = "$imagetwo";
                $image_find_to_update->update([
                    'web_login_icon' => $imagetwo
                ]);
            }
            if($request->file('mobile_loading_icon') != null) {
                $mobile_loading_icon_image = $request->file('mobile_loading_icon');
                File::delete(public_path('storage/site_setting/'.$image_find_to_update->mobile_loading_icon));
                $destinationPath = 'storage/site_setting';
                $imagethree = "mobile_loading_icon" . "." . $mobile_loading_icon_image->getClientOriginalExtension();
                $mobile_loading_icon_image->move($destinationPath, $imagethree);
                $input['mobile_loading_icon'] = "$imagethree";
                $image_find_to_update->update([
                    'mobile_loading_icon' => $imagethree
                ]);
            }
            if($request->file('web_register_icon') != null){
                $web_register_icon_image = $request->file('web_register_icon');
                File::delete(public_path('storage/site_setting/'.$image_find_to_update->web_register_icon));
                $destinationPath = 'storage/site_setting';
                $imagefour = "web_register_icon" . "." . $web_register_icon_image->getClientOriginalExtension();
                $web_register_icon_image->move($destinationPath, $imagefour);
                $input['web_register_icon'] = "$imagefour";
                $image_find_to_update->update([
                    'web_register_icon' => $imagefour
                ]);
            }
            if($request->file('web_icon') != null){
                $web_icon_image = $request->file('web_icon');
                File::delete(public_path('storage/site_setting/'.$image_find_to_update->web_icon));
                $destinationPath = 'storage/site_setting';
                $imagefive = "web_icon" . "." . $web_icon_image->getClientOriginalExtension();
                $web_icon_image->move($destinationPath, $imagefive);
                $input['web_icon'] = "$imagefive";
                $image_find_to_update->update([
                    'web_icon' => $imagefive
                ]);
            }
            if($request->file('web_tab_icon') != null){
                $web_tab_icon_image = $request->file('web_tab_icon');
                File::delete(public_path('storage/site_setting/'.$image_find_to_update->web_tab_icon));
                $destinationPath = 'storage/site_setting';
                $imagesix = "web_tab_icon" . "." . $web_tab_icon_image->getClientOriginalExtension();
                $web_tab_icon_image->move($destinationPath, $imagesix);
                $input['web_tab_icon'] = "$imagesix";
                $image_find_to_update->update([
                    'web_tab_icon' => $imagesix
                ]);
            }
            
            $image_find_to_update->facebook_url= $request->facebook_url ?? $image_find_to_update->facebook_url;
            
            
            $image_find_to_update->instagram_url= $request->instagram_url ?? $image_find_to_update->instagram_url;
            
            $image_find_to_update->youtube_url= $request->youtube_url ?? $image_find_to_update->youtube_url;
            
            $image_find_to_update->phonenumber= $request->phonenumber ?? $image_find_to_update->phonenumber;
            
            $image_find_to_update->linkedin_url= $request->linkedin_url ?? $image_find_to_update->linkedin_url;
            
            $image_find_to_update->address= $request->address ?? $image_find_to_update->address;
            
            $image_find_to_update->short_description= $request->short_description ?? $image_find_to_update->short_description;
            
            
            $image_find_to_update->email= $request->email ?? $image_find_to_update->email;
            
            $image_find_to_update->save();
            
            $image_find_to_update->update([
                'facebook_url' => $request->facebook_url ?? $image_find_to_update->facebook_url,
                'instagram_url' => $request->instagram_url ?? $image_find_to_update->instagram_url,
                'youtube_url' => $request->youtube_url ?? $image_find_to_update->youtube_url,
                'linkedin_url' => $request->linkedin_url ?? $image_find_to_update->linkedin_url,
                'phonenumber' => $request->phonenumber ?? $image_find_to_update->phonenumber,
                'address' => $request->address ?? $image_find_to_update->address,
                'short_description' => $request->short_description ?? $image_find_to_update->short_description,
                'email' => $request->email ?? $image_find_to_update->email
            ]);
            return response()->json([
                'status' => 'success',
                'message' => "Icons Are Saved Successfully"
            ], 201);
        }
        else{
            return response()->json([
                'status' => 'success',
                'message' => "error"
            ], 403);
        }
    }
    public function list(){
        $sitesetting = SiteSetting::all();
       return $sitesetting;
    }
}
