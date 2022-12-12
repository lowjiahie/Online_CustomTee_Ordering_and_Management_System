<?php

namespace App\Http\Controllers;

use App\Models\PrintingMethod;
use Illuminate\Http\Request;
use App\Repositories\PrintingMethodRepositoryInterface;
use App\Repositories\StaffRepositoryInterface;

class PrintingMethodController extends Controller
{

    // Make Repository Easy for CRUD of Staff
    private $printingMethodRepository;
    private $staffRepository;

    public function __construct(PrintingMethodRepositoryInterface $printingMethodRepository, StaffRepositoryInterface $staffRepository)
    {
        $this->printingMethodRepository = $printingMethodRepository;
        $this->staffRepository = $staffRepository;
    }

    public function printingMethodList(Request $request){
        // Display all printing method to the list
        $printingMethodList = $this->printingMethodRepository->getAll();
        $staffID = $request->session()->get('StaffID');
        $staffInfo = $this->staffRepository->getById($staffID);
        return view('admin.printingMethod', ['printingMethodList'=>$printingMethodList], ['staffInfo'=>$staffInfo]);
    }

    public function printingMethodSearch(Request $request){
        $nameSearch = $request->input('searchPrintingMethod');
        $printingMethodList = $this->printingMethodRepository->searchByName($nameSearch);
        $staffID = $request->session()->get('StaffID');
        $staffInfo = $this->staffRepository->getById($staffID);
        return view('admin.printingMethod', ['printingMethodList'=>$printingMethodList], ['staffInfo'=>$staffInfo]);
    }

    public function printingMethodAddPage(Request $request){
        $staffID = $request->session()->get('StaffID');
        $staffInfo = $this->staffRepository->getById($staffID);
        return view('admin.printingMethodAdd', ['staffInfo'=>$staffInfo]);
    }

    public function printingMethodAddData(Request $request){
        // Check user want add or cancel
        $addCancel = $request->input('addCancel');
        if (!strcmp($addCancel, "Add")){
            // Add - add data to database
            // Validate null input
            $request->validate([
                "name" => "required",
                "price" => "required",
                "minimum_order" => "required",
                "status" => "required",
            ]);

            // Get input data
            $name = $request->input('name');
            $price = $request->input('price');
            $minimum_order = $request->input('minimum_order');
            $status = $request->input('status');

            $allPrintingMethod = $this->printingMethodRepository->getAll();

            foreach($allPrintingMethod as $printingMethod){
                if($printingMethod->name == $name){
                    echo "<script>alert('Printing method name existed!')</script>";
                    $staffID = $request->session()->get('StaffID');
                    $staffInfo = $this->staffRepository->getById($staffID);
                    return view('admin.printingMethodAdd', ['staffInfo'=>$staffInfo]);
                }
            }
            if($price > 0){
                if($minimum_order > 0){
                    // Add data to database
                    $data = ["name"=>$name, "price"=>$price, "minimum_order"=>$minimum_order, "status"=>$status];
                    $this->printingMethodRepository->create($data);

                    // Redirect to printing method list
                    echo "<script>alert('Add successfully!')</script>";
                    $printingMethodList = $this->printingMethodRepository->getAll();
                    $staffID = $request->session()->get('StaffID');
                    $staffInfo = $this->staffRepository->getById($staffID);
                    return view('admin.printingMethod', ['printingMethodList'=>$printingMethodList], ['staffInfo'=>$staffInfo]);
                }
                else{
                    echo "<script>alert('Minimum order must be greater than 0!')</script>";
                    $staffID = $request->session()->get('StaffID');
                    $staffInfo = $this->staffRepository->getById($staffID);
                    return view('admin.printingMethodAdd', ['staffInfo'=>$staffInfo]);
                }
            }else{
                echo "<script>alert('Price must be greater than 0!')</script>";
                $staffID = $request->session()->get('StaffID');
                $staffInfo = $this->staffRepository->getById($staffID);
                return view('admin.printingMethodAdd', ['staffInfo'=>$staffInfo]);
            }
        }else{
            // Cancel - redirect to printing method list
            $printingMethodList = $this->printingMethodRepository->getAll();
            $staffID = $request->session()->get('StaffID');
            $staffInfo = $this->staffRepository->getById($staffID);
            return view('admin.printingMethod', ['printingMethodList'=>$printingMethodList], ['staffInfo'=>$staffInfo]);
        }

    }

    public function printingMethodDetail(Request $request, $printingMethodID){
        // Pass printing method ID and get all information about specific printing method
        $printingMethodDetail = $this->printingMethodRepository->getById($printingMethodID);
        $staffID = $request->session()->get('StaffID');
        $staffInfo = $this->staffRepository->getById($staffID);
        return view('admin.printingMethodDetail', ['printingMethodDetail'=>$printingMethodDetail], ['staffInfo'=>$staffInfo]);
    }

    public function printingMethodFunction(Request $request){
        // Check user want update, delete or cancel
        $updateDeleteCancel = $request->input('updateDeleteCancel');
        $p_method_id = $request->input('printingMethodID');
        if(!strcmp($updateDeleteCancel, "Update")){
            // Update - redirect to update form
            $printingMethodUpdate = $this->printingMethodRepository->getById($p_method_id);
            $staffID = $request->session()->get('StaffID');
            $staffInfo = $this->staffRepository->getById($staffID);
            return view('admin.printingMethodUpdate', ['printingMethodUpdate'=>$printingMethodUpdate], ['staffInfo'=>$staffInfo]);
        }else if(!strcmp($updateDeleteCancel, "Delete")){
            // Delete - delete the data
            // Delete from database
            $this->printingMethodRepository->deleteById($p_method_id);

            // Redrect back to printing method list
            echo "<script>alert('Delete successfully!')</script>";
            $printingMethodList = $this->printingMethodRepository->getAll();
            $staffID = $request->session()->get('StaffID');
            $staffInfo = $this->staffRepository->getById($staffID);
            return view('admin.printingMethod', ['printingMethodList'=>$printingMethodList], ['staffInfo'=>$staffInfo]);
        }else{
            // Cancel - redirect to printing method list
            $printingMethodList = $this->printingMethodRepository->getAll();
            $staffID = $request->session()->get('StaffID');
            $staffInfo = $this->staffRepository->getById($staffID);
            return view('admin.printingMethod', ['printingMethodList'=>$printingMethodList], ['staffInfo'=>$staffInfo]);
        }
    }

    public function printingMethodDetailUpdate(Request $request){
        // Check user want update or cancel
        $updateCancel = $request->input('updateCancel');
        // Get printing method id
        $p_method_id = $request->input('p_method_id');
        if(!strcmp($updateCancel, "Update")){
            // Update - update to database
            // Validate null input
            $request->validate([
                "price" => "required",
                "minimum_order" => "required",
                "status" => "required",
            ]);

            // Get input data
            $price = $request->input('price');
            $minimum_order = $request->input('minimum_order');
            $status = $request->input('status');

            if($price > 0){
                if($minimum_order > 0){
                    // Update to database
                    $this->printingMethodRepository->update($p_method_id, $price, $minimum_order, $status);

                    // Redirect back to the printing method detail page
                    echo "<script>alert('Update successfully!')</script>";
                    $printingMethodDetail = $this->printingMethodRepository->getById($p_method_id);
                    $staffID = $request->session()->get('StaffID');
                    $staffInfo = $this->staffRepository->getById($staffID);
                    return view('admin.printingMethodDetail', ['printingMethodDetail'=>$printingMethodDetail], ['staffInfo'=>$staffInfo]);
                }else{
                    echo "<script>alert('Minimum order must be greater than 0!')</script>";
                    $printingMethodUpdate = $this->printingMethodRepository->getById($p_method_id);
                    $staffID = $request->session()->get('StaffID');
                    $staffInfo = $this->staffRepository->getById($staffID);
                    return view('admin.printingMethodUpdate', ['printingMethodUpdate'=>$printingMethodUpdate], ['staffInfo'=>$staffInfo]);
                }
            }else{
                echo "<script>alert('Price must be greater than 0!')</script>";
                $printingMethodUpdate = $this->printingMethodRepository->getById($p_method_id);
                $staffID = $request->session()->get('StaffID');
                $staffInfo = $this->staffRepository->getById($staffID);
                return view('admin.printingMethodUpdate', ['printingMethodUpdate'=>$printingMethodUpdate], ['staffInfo'=>$staffInfo]);
            }
        }else{
            // Cancel - redirect to printing method detail page
            $printingMethodDetail = $this->printingMethodRepository->getById($p_method_id);
            $staffID = $request->session()->get('StaffID');
            $staffInfo = $this->staffRepository->getById($staffID);
            return view('admin.printingMethodDetail', ['printingMethodDetail'=>$printingMethodDetail], ['staffInfo'=>$staffInfo]);
        }
    }

}
