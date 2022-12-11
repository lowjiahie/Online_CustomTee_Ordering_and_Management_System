<?php

namespace App\Http\Controllers\customer;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PublishedDesign;
use App\Http\Controllers\Controller;
use App\Models\OrderedCustomTee;
use App\Models\PublishedDesignReport;
use App\Models\SavedPurchasedDesign;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;

class PublishedDesignController extends Controller
{
    public function publishDesign(Request $request)
    {
        $request->validate([
            'publishedDesignForm.name' => 'required|max:20',
            'publishedDesignForm.description' => 'required|max:100',
        ]);

        $publishedDesignForm = $request->publishedDesignForm;
        $frontUniqid = Str::random(9);
        $backUniqid = Str::random(9);
        $newFrontImgName = $publishedDesignForm['cusID'] . "-" . $publishedDesignForm['name'] . "-front-published-" . $frontUniqid . ".jpg";
        $newBackImgName = $publishedDesignForm['cusID'] . "-" . $publishedDesignForm['name'] . "-back-published-" . $backUniqid . ".jpg";;

        //copy image to published design file
        File::copy(public_path('customTee/' . $publishedDesignForm['frontDesignImg']), public_path('publishedDesign/' . $newFrontImgName));
        File::copy(public_path('customTee/' . $publishedDesignForm['backDesignImg']), public_path('publishedDesign/' . $newBackImgName));

        $record = PublishedDesign::create([
            'name' => $publishedDesignForm['name'],
            'description' => $publishedDesignForm['description'],
            'price' => $publishedDesignForm['price'],
            'status' => $publishedDesignForm['status'],
            'type' => $publishedDesignForm['type'],
            'front_design_img' => $newFrontImgName,
            'back_design_img' => $newBackImgName,
            'front_design_json' => $publishedDesignForm['frontDesignJson'],
            'back_design_json' => $publishedDesignForm['backDesignJson'],
            'cus_id' => $publishedDesignForm['cusID'],
        ]);

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

    public function getPublishDesignWithStatus(Request $request)
    {
        $status = strtolower($request->status);
        $cusID = $request->cusID;

        $response = PublishedDesign::all()->where('status', $status)->where('cus_id', $cusID);

        return response($response, 201);
    }


    public function getPublishedDesignsOnSelling(Request $request)
    {
        $cusID = $request->cusID;
        $response = PublishedDesign::join('customers', 'customers.cus_id', '=', 'published_designs.cus_id')
            ->where('published_designs.status', "published")
            ->where('published_designs.type', "sell")
            ->select(
                'published_designs.*',
                'customers.name as cus_name',
            )->get();

        if ($response) {
            for ($i = 0; $i < count($response); $i++) {
                $response[$i]->setAttribute('has_this_design', $this->checkExistSavedOrPurchasedDesign($response[$i]->p_design_id, $cusID));
            }
        }

        return response($response, 201);
    }

    public function getPublishedDesignsOnSharing(Request $request)
    {
        $cusID = $request->cusID;
        $response = PublishedDesign::join('customers', 'customers.cus_id', '=', 'published_designs.cus_id')
            ->where('published_designs.status', "published")
            ->where('published_designs.type', "share")
            ->select(
                'published_designs.*',
                'customers.name as cus_name',
            )->get();

        if ($response) {
            for ($i = 0; $i < count($response); $i++) {
                $response[$i]->setAttribute('has_this_design', $this->checkExistSavedOrPurchasedDesign($response[$i]->p_design_id, $cusID));
            }
        }

        return response($response, 201);
    }


    public function reportPublishedDesign(Request $request)
    {
        $request->validate([
            'reportForm.title' => 'required|max:30',
            'reportForm.description' => 'required|max:100',
        ]);

        $reportForm = $request->reportForm;

        $record = PublishedDesignReport::create([
            'title' => $reportForm['title'],
            'description' => $reportForm['description'],
            'cus_id' => $reportForm['cusID'],
            'p_design_id' => $reportForm['pDesignID'],
        ]);

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

    public function saveToMyDesign(Request $request)
    {
        $pDesignID = $request->pDesignID;
        $cusID = $request->cusID;
        $savedDateTime = Carbon::now()->toDateTimeString();

        $record = SavedPurchasedDesign::create([
            'p_design_id' => $pDesignID,
            'cus_id' => $cusID,
            'sp_date_time' => $savedDateTime
        ]);

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

    public function getSavedPurchasedDesigns(Request $request)
    {
        $cusID = $request->cusID;

        $response = SavedPurchasedDesign::join('published_designs', 'published_designs.p_design_id', '=', 'saved_purchased_designs.p_design_id')
            ->join('customers', 'customers.cus_id', '=', 'published_designs.cus_id')
            ->where('saved_purchased_designs.cus_id', '=', $cusID)
            ->where('published_designs.status', '=', 'published')
            ->orWhere('published_designs.status', '=', 'banned')
            ->select(
                'saved_purchased_designs.*',
                'published_designs.name',
                'published_designs.description',
                'published_designs.price',
                'published_designs.status',
                'published_designs.reason_banned_denied',
                'published_designs.type',
                'published_designs.front_design_img',
                'published_designs.back_design_img',
                'published_designs.cus_id as seller_id',
                'customers.name as cus_name'
            )->get();


        return response($response, 201);
    }

    public function checkExistSavedOrPurchasedDesign($pDesignID, $cusID)
    {
        return SavedPurchasedDesign::where('p_design_id', $pDesignID)->where('cus_id', $cusID)->exists();
    }


}
