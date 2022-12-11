<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use App\Models\PlainTeeSize;
use App\Models\PlainTeeTypeColor;
use Illuminate\Http\Request;

class PlainTeeTypeColorController extends Controller
{
    public function getPlainTeeTypeColor(){
        $response = PlainTeeTypeColor::join('types', 'types.type_id', '=', 'plain_tee_type_colors.type_id')
        ->join('colors', 'colors.color_id', '=', 'plain_tee_type_colors.color_id')
        ->select(
            'plain_tee_type_colors.pt_type_color_id',
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
        )->get();

        return response($response, 201);
    }

    public function checkStock(Request $request){
        $sizeID = $request->sizeID;
        $orderQty = $request->orderQty;

        $plainTeeSize = PlainTeeSize::where('plain_tee_size_id',$sizeID)->first();

        $response = [];

        if ((int)$plainTeeSize->stocks > (int)$orderQty ) {
            $response = [
                'isValid' => true,
                'sizeName' => $plainTeeSize->size_name,
                'currentStocks'=> $plainTeeSize->stocks
            ];
        } else {
            $response = [
                'isValid' => false,
                'sizeName' => $plainTeeSize->size_name,
                'currentStocks'=> $plainTeeSize->stocks
            ];
        }

        return response($response, 201);
    }

    public function getAvailableSize($id){
        $response = PlainTeeSize::where('pt_type_color_id',$id)->get();
        
        return response($response, 201);
    }
}
