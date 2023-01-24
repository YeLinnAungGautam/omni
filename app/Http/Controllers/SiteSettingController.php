<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SiteSetting;

class SiteSettingController extends Controller
{
    //
    public function upload(Request $request)
    {
        $data = $request->validate([
            'logo' => 'required|image:jpeg,png,jpg,gif,svg|max:2048',
            'sample' => 'required|image:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $input = $request->all();

        if($logo_image = $request->file('logo'))
        {
            $destinationPath = 'storage/site_setting';
            $imageone = "logo". "." . $logo_image->getClientOriginalExtension();
            $logo_image->move($destinationPath, $imageone);
            $input['logo'] = "$imageone";
        }
        if($sample_image = $request->file('sample'))
        {
            $destinationPath = 'storage/site_setting';
            $imagetwo = "sample" . "." . $sample_image->getClientOriginalExtension();
            $sample_image->move($destinationPath, $imagetwo);
            $input['sample'] = "$imagetwo";
        }
        
        SiteSetting::create($input);
        return response()->json([
            'status' => 'success',
            'message' => "I am okay "
        ], 201);
    }

}
