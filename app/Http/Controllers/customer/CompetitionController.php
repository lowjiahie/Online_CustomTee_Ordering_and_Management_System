<?php

namespace App\Http\Controllers\customer;

use App\Models\Competition;
use App\Models\Participant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class CompetitionController extends Controller
{

    public function getCurrentCompetition(Request $request){

        $cusID = $request->cusID;

        $response = DB::select("SELECT * FROM competitions C
        WHERE C.end_date_time >= now()");

        return response($response, 201);
    }

    public function getMyCompetitionDesign(Request $request){
        $cusID = $request->cusID;

        $response = DB::select("SELECT * FROM competitions AS C, participants AS P
        WHERE C.competition_id=P.competition_id AND P.cus_id='$cusID' AND P.status='participated'");

        return response($response, 201);

    }

    public function getCompetitionList(){
        $response = Competition::all();
        return response($response, 201);
    }

    public function submitCompetition(Request $request){

        $competitionForm = $request->competitionForm;

        $pathPrefix = public_path('competition/');
        $front_jpg_name = $competitionForm['front_design_img'];
        $frontPath = $pathPrefix . '/' . $front_jpg_name;
        $back_jpg_name = $competitionForm['back_design_img'];
        $backPath = $pathPrefix . '/' . $back_jpg_name;
        if (!File::exists($pathPrefix)) {
            File::makeDirectory($pathPrefix, 0777, true, true);
        }

        Image::make(file_get_contents($competitionForm['frontDesignImg']))->save($frontPath);
        Image::make(file_get_contents($competitionForm['backDesignImg']))->save($backPath);

        $result = Participant::create([
            'competition_id'=>$competitionForm['competition_id'],
            'cus_id'=>$competitionForm['cus_id'],
            'status'=>'participated',
            'front_design_img'=>$competitionForm['front_design_img'],
            'back_design_img'=>$competitionForm['back_design_img'],
        ]);

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

    public function withdrawCompetition(Request $request){
        $cus_id = $request->cusID;
        $competition_id = $request->competitionID;

        $checkCondition = DB::select("SELECT * FROM competitions WHERE competition_id='$competition_id'");

        foreach($checkCondition as $check){
            if($check->end_date_time >= now()){
                $result = DB::update("UPDATE participants SET status='withdraw'
                WHERE cus_id='$cus_id' AND competition_id='$competition_id'");
            }else{
                $result = "";
            }
        }
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

}
