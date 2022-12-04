<?php

namespace App\Http\Controllers\customer;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\CustomTeeDesign;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class CustomTeeDesignController extends Controller
{

    public function chkExstCusTeeDesign(Request $request)
    {
        $customTee =  $request->customTee;
        dd(CustomTeeDesign::where(['name', '=', $customTee['name']], ['pt_type_color_id', '=', $customTee['ptTypeColorID']], ['cus_id', '=', $customTee['cusID']])->exists());
    }

    public function saveDesign(Request $request)
    {
        $customTee =  $request->customTee;
        $customTeeName = $customTee['cusID'] . '-' . $customTee['name'];
        $pathPrefix = public_path('customTee/');
        $front_jpg_name = $customTeeName . "-" . "front-" . ".jpg";
        $frontPath = $pathPrefix . '/' . $front_jpg_name;
        $back_jpg_name = $customTeeName . "-" . "back-" . ".jpg";
        $backPath = $pathPrefix . '/' . $back_jpg_name;
        $cus = Customer::find($customTee['cusID']);

        if (!File::exists($pathPrefix)) {
            File::makeDirectory($pathPrefix, 0777, true, true);
        }

        Image::make(file_get_contents($customTee['frontDesignImg']))->save($frontPath);
        Image::make(file_get_contents($customTee['backDesignImg']))->save($backPath);
        $customTeeExt = CustomTeeDesign::where('name',);

        // CustomTeeDesign::create([
        //     'name'=> $customTee['name'],
        //     'front_design_img'=>$front_jpg_name,
        //     'back_design_img'=>$back_jpg_name,
        //     'front_design_json'=>json_encode($customTee['frontDesignJson']),
        //     'back_design_json'=>json_encode($customTee['backDesignJson']),
        //     'pt_type_color_id'=> $customTee['ptTypeColorID'],
        //     'cus_id'=> $customTee['cusID'],
        // ]);
    }
}
