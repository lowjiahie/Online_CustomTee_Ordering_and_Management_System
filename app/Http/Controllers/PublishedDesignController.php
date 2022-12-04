<?php

namespace App\Http\Controllers;

use App\Models\PublishedDesign;
use Illuminate\Http\Request;
use App\Repositories\DesignRepositoryInterface;
use App\Repositories\StaffRepositoryInterface;

class PublishedDesignController extends Controller
{

    // Make Repository Easy for CRUD of Staff
    private $designRepository;
    private $staffRepository;

    public function __construct(DesignRepositoryInterface $designRepository, StaffRepositoryInterface $staffRepository)
    {
        $this->designRepository = $designRepository;
        $this->staffRepository = $staffRepository;
    }

    public function designList(Request $request){
        // Display all printing method to the list
        $designList = $this->designRepository->getAllDesign();
        $staffID = $request->session()->get('StaffID');
        $staffInfo = $this->staffRepository->getById($staffID);
        return view('admin.designList', ['designList'=>$designList], ['staffInfo'=>$staffInfo]);
    }

    public function designSearch(Request $request){
        $nameSearch = $request->input('searchDesign');
        $designList = $this->designRepository->searchByName($nameSearch);
        $staffID = $request->session()->get('StaffID');
        $staffInfo = $this->staffRepository->getById($staffID);
        return view('admin.designList', ['designList'=>$designList], ['staffInfo'=>$staffInfo]);
    }

    public function designDetail(Request $request, $designID){
        // Pass design ID and get all information about specific printing method
        $designDetail = $this->designRepository->getById($designID);
        $cusInfo = $this->designRepository->getCusName($designDetail->cus_id);
        $staffID = $request->session()->get('StaffID');
        $staffInfo = $this->staffRepository->getById($staffID);
        return view('admin.designDetail', ['designDetail'=>$designDetail, 'cusInfo'=>$cusInfo], ['staffInfo'=>$staffInfo]);
    }

    public function designFunction(Request $request){
        // Check user want update status or cancel
        $updateCancel = $request->input('updateCancel');
        $p_design_id = $request->input('designID');
        if(!strcmp($updateCancel, "Update Status")){
            // Update - redirect to update form
            $designUpdate = $this->designRepository->getById($p_design_id);
            $cusInfo = $this->designRepository->getCusName($designUpdate->cus_id);
            $staffID = $request->session()->get('StaffID');
            $staffInfo = $this->staffRepository->getById($staffID);
            return view('admin.designUpdate', ['designUpdate'=>$designUpdate, 'cusInfo'=>$cusInfo], ['staffInfo'=>$staffInfo]);
        }else{
            // Cancel - redirect to printing method list
            $designList = $this->designRepository->getAllDesign();
            $staffID = $request->session()->get('StaffID');
            $staffInfo = $this->staffRepository->getById($staffID);
            return view('admin.designList', ['designList'=>$designList], ['staffInfo'=>$staffInfo]);
        }
    }

    public function designDetailUpdate(Request $request){
        // Check user want update or cancel
        $updateCancel = $request->input('updateCancel');
        // Get printing method id
        $p_design_id = $request->input('p_design_id');
        if(!strcmp($updateCancel, "Update")){
            // Update - update to database
            // Validate null input
            $request->validate([
                "status" => "required",
            ]);

            // Get input data
            $status = $request->input('status');
            $reason_banned_denied = $request->input('reason_banned_denied');

            echo "$reason_banned_denied";

            if ($status == "Banned" && $reason_banned_denied == null){
                // Tell user if status banned cannot leave reason null and refresh the page
                echo "<script>alert('If status banned, reason must be filled in!')</script>";
                $designUpdate = $this->designRepository->getById($p_design_id);
                $cusInfo = $this->designRepository->getCusName($designUpdate->cus_id);
                $staffID = $request->session()->get('StaffID');
                $staffInfo = $this->staffRepository->getById($staffID);
                return view('admin.designUpdate', ['designUpdate'=>$designUpdate, 'cusInfo'=>$cusInfo], ['staffInfo'=>$staffInfo]);
            }

            // Update to database
            $this->designRepository->updateStatus($p_design_id, $status, $reason_banned_denied);

            // Redirect back to the design detail page
            echo "<script>alert('Update successfully!')</script>";
            $designDetail = $this->designRepository->getById($p_design_id);
            $cusInfo = $this->designRepository->getCusName($designDetail->cus_id);
            $staffID = $request->session()->get('StaffID');
            $staffInfo = $this->staffRepository->getById($staffID);
            return view('admin.designDetail', ['designDetail'=>$designDetail, 'cusInfo'=>$cusInfo], ['staffInfo'=>$staffInfo]);
        }else{
            // Cancel - redirect to printing method detail page
            $designDetail = $this->designRepository->getById($p_design_id);
            $cusInfo = $this->designRepository->getCusName($designDetail->cus_id);
            $staffID = $request->session()->get('StaffID');
            $staffInfo = $this->staffRepository->getById($staffID);
            return view('admin.designDetail', ['designDetail'=>$designDetail, 'cusInfo'=>$cusInfo], ['staffInfo'=>$staffInfo]);
        }
    }

}
