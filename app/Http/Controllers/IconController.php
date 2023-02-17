<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Icon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class IconController extends Controller
{
    //
    public function store(Request $request)
    {
        // $data = $request->validate([
        //     'mobile_login_icon' => 'required|image:jpeg,png,jpg,gif,svg|max:2048',
        //     'web_login_icon' => 'required|image:jpeg,png,jpg,gif,svg|max:2048',
        //     'mobile_loading_icon' => 'required|image:jpeg,png,jpg,gif,svg|max:2048',
        //     'web_register_icon' => 'required|image:jpeg,png,jpg,gif,svg|max:2048',
        //     'web_icon' => 'required|image:jpeg,png,jpg,gif,svg|max:2048',
        //     'web_tab_icon' => 'required|image:jpeg,png,jpg,gif,svg|max:2048'
        // ]);
        $file= $request->file('mobile_login_icon');
        $filename= date('YmdHi') .$file->getClientOriginalExtension();
        $file-> move(public_path('storage/icons'), $filename);

        $web_loginicon = $request->file('web_login_icon');
        $webloginicon = date('YmdHi') .$file->getClientOriginalExtension();
        $web_loginicon->move(public_path('storage/icons', $webloginicon));

        $mobile_loadingicon = $request->file('mobile_loading_icon');
        $mobileloadingicon = date('YmdHi') .$file->getClientOriginalExtension();
        $mobile_loadingicon->move(public_path('storage/icons', $mobileloadingicon));

        $web_registericon = $request->file('web_register_icon');
        $webregistericon = date('YmdHi') .$file->getClientOriginalExtension();
        $web_registericon->move(public_path('storage/icons', $webregistericon));

        $web_icon = $request->file('web_icon');
        $webicon = date('YmdHi') .$file->getClientOriginalExtension();
        $web_icon->move(public_path('storage/icons', $webicon));

        $web_tab_icon = $request->file('web_tab_icon');
        $webtabicon = date('YmdHi').$file->getClientOriginalExtension();
        $web_tab_icon->move(public_path('storage/icons', $webtabicon));

        $icons = Icon::create([
            'mobile_login_icon' => $filename,
            'web_login_icon' => $webloginicon,
            'mobile_loading_icon' => $mobileloadingicon,
            'web_register_icon' => $webregistericon,
            'web_icon' => $webicon,
            'web_tab_icon' => $webtabicon,
        ]);
         $icons = Icon::latest()->first()->web_icon;
            return response()->json([
                'status' => 'success',
                'message' => 'successfully saved',
                // 'data' => $icons,
                'image-url' => Storage::url("icons/".$icons)
                //if get the error of not found for image url,
                //please run the "php artisan storage:link" command.
            ], 201);
    }
    public function update(Request $request,$id)
    {
        $icon_update = Icon::find($id);
        if($icon_update){
            if($request->hasFile('mobile_login_icon') != null)
            {
                $file= $request->file('mobile_login_icon');
                $filename= 'mobile_login_icon.' .$file->getClientOriginalExtension();
                $file-> move(public_path('storage/icons'), $filename);
                if(File::exists(public_path('storage/icons'.$icon_update->mobile_login_icon)))
                {
                    File::delete(public_path('storage/icons'.$icon_update->mobile_login_icon));
                    $icon_update->update([
                     'mobile_login_icon' => $filename
                    ]);
                    return response()->json([
                        'status' => 'success',
                        'message' =>  "Successfully Updated"    
                    ], 201);
                 }
            }
            else
            {
                $store_update->update([
                    'mobile_login_icon' => $filename
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
    
}
