<?php

namespace App\Http\Controllers\customer;

use App\Models\Customer;
use Illuminate\Http\Request;
use App\Models\CustomTeeDesign;
use App\Http\Controllers\Controller;
use App\Models\PlainTeeTypeColor;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class CustomTeeDesignController extends Controller
{

    public function chkExstCusTeeDesign(Request $request)
    {
        $customTee =  $request->customTee;
        $response = CustomTeeDesign::where('name', $customTee['name'])->where('pt_type_color_id', $customTee['ptTypeColorID'])->where('cus_id', $customTee['cusID'])->exists();
        return response($response, 201);
    }

    public function saveDesign(Request $request)
    {
        $customTee =  $request->customTee;

        $customTeeName = $customTee['cusID'] . '-' . $customTee['name'];
        $pathPrefix = public_path('customTee/');
        $front_jpg_name = $customTeeName . "-" . $customTee['ptTypeColorID'] . "-" . "front-" . "preset" . ".jpg";
        $frontPath = $pathPrefix . '/' . $front_jpg_name;
        $back_jpg_name = $customTeeName . "-" . $customTee['ptTypeColorID'] . "-" . "back-" . "preset" . ".jpg";
        $backPath = $pathPrefix . '/' . $back_jpg_name;

        if (!File::exists($pathPrefix)) {
            File::makeDirectory($pathPrefix, 0777, true, true);
        }

        Image::make(file_get_contents($customTee['frontDesignImg']))->save($frontPath);
        Image::make(file_get_contents($customTee['backDesignImg']))->save($backPath);



        $record = CustomTeeDesign::updateOrCreate(
            [
                'name' => $customTee['name'],
                'pt_type_color_id' => $customTee['ptTypeColorID'],
                'cus_id' => $customTee['cusID']
            ],
            [
                'front_design_img' => $front_jpg_name,
                'back_design_img' => $back_jpg_name,
                'front_design_json' => json_encode($customTee['frontDesignJson']),
                'back_design_json' => json_encode($customTee['backDesignJson']),
            ]
        );
        $response = [];
        if ($record) {
            $response = [
                'isValid' => true
            ];
        } else {
            $response = [
                'isValid' => false
            ];
        }

        return response($response, 201);
    }

    public function getPresetDesign(Request $request)
    {
        $cusID = $request->cusID;
        $response = CustomTeeDesign::join('plain_tee_type_colors', 'plain_tee_type_colors.pt_type_color_id', '=', 'custom_tee_designs.pt_type_color_id')
            ->where('custom_tee_designs.cus_id', '=', $cusID)
            ->join('types', 'types.type_id', '=', 'plain_tee_type_colors.type_id')
            ->join('colors', 'colors.color_id', '=', 'plain_tee_type_colors.color_id')
            ->select(
                'custom_tee_designs.*',
                'plain_tee_type_colors.plain_tee_img',
                'plain_tee_type_colors.color_id',
                'plain_tee_type_colors.type_id',
                'types.name as type_name',
                'types.material',
                'types.description',
                'types.detail',
                'types.price',
                'colors.color_name',
                'colors.color_code'
            )
            ->get();

        return response($response, 201);
    }

    public function getOnePresetDesign($id){
        $response = CustomTeeDesign::join('plain_tee_type_colors', 'plain_tee_type_colors.pt_type_color_id', '=', 'custom_tee_designs.pt_type_color_id')
        ->where('custom_tee_designs.c_tee_design_id', '=', $id)
        ->join('types', 'types.type_id', '=', 'plain_tee_type_colors.type_id')
        ->join('colors', 'colors.color_id', '=', 'plain_tee_type_colors.color_id')
        ->select(
            'custom_tee_designs.*',
            'plain_tee_type_colors.plain_tee_img',
            'plain_tee_type_colors.color_id',
            'plain_tee_type_colors.type_id',
            'types.name as type_name',
            'types.material',
            'types.description',
            'types.detail',
            'types.price',
            'colors.color_name',
            'colors.color_code'
        )
        ->get();
        return response($response, 201);
    }

    public function deletePresetDesign(Request $request)
    {
        $customTee_id = $request->customTee_id;
        $front_img = $request->front_img;
        $back_img = $request->back_img;
        $frontPath = public_path('customTee/' . $front_img);
        $backPath = public_path('customTee/' . $back_img);
        $frontWebPath = public_path('images/' . $front_img);
        $backWebPath = public_path('images/' . $back_img);

        $result = CustomTeeDesign::where('c_tee_design_id', $customTee_id)->delete();
        File::delete($frontPath, $backPath);
        File::delete($frontWebPath, $backWebPath);

        $response = [];
        if ($result) {
            $response = [
                'isValid' => true
            ];
        } else {
            $response = [
                'isValid' => false
            ];
        }

        return response($response, 201);
    }

    public function loadPresetDesign(Request $request)
    {
        $presetCustomTeeID = $request->presetCustomTeeID;
        $response = CustomTeeDesign::join('plain_tee_type_colors', 'plain_tee_type_colors.pt_type_color_id', '=', 'custom_tee_designs.pt_type_color_id')
            ->where('custom_tee_designs.c_tee_design_id', '=', $presetCustomTeeID)
            ->join('types', 'types.type_id', '=', 'plain_tee_type_colors.type_id')
            ->join('colors', 'colors.color_id', '=', 'plain_tee_type_colors.color_id')
            ->select(
                'custom_tee_designs.*',
                'plain_tee_type_colors.plain_tee_img',
                'plain_tee_type_colors.plain_tee_img',
                'plain_tee_type_colors.color_id',
                'plain_tee_type_colors.type_id',
                'types.name as type_name',
                'types.material',
                'types.description',
                'types.detail',
                'types.price',
                'colors.color_name',
                'colors.color_code'
            )
            ->get();

        return response($response, 201);
    }
}
