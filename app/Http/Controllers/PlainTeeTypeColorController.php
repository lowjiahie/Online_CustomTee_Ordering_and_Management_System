<?php

namespace App\Http\Controllers;

use App\Models\PlainTeeTypeColor;
use Illuminate\Http\Request;
use App\Repositories\PlainTeeRepositoryInterface;
use App\Repositories\StaffRepositoryInterface;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

use function PHPSTORM_META\type;

class PlainTeeTypeColorController extends Controller
{
    // Make Repository Easy for CRUD of Staff
    private $plainTeeRepository;
    private $staffRepository;

    public function __construct(PlainTeeRepositoryInterface $plainTeeRepository, StaffRepositoryInterface $staffRepository)
    {
        $this->plainTeeRepository = $plainTeeRepository;
        $this->staffRepository = $staffRepository;
    }

    public function colorList(Request $request){
        // Display all color to the list
        $colorList = $this->plainTeeRepository->getAllColor();
        $staffID = $request->session()->get('StaffID');
        $staffInfo = $this->staffRepository->getById($staffID);
        return view('admin.plainTeeColorList', ['colorList'=>$colorList], ['staffInfo'=>$staffInfo]);
    }

    public function colorSearch(Request $request){
        $colorSearch = $request->input('searchColor');
        $colorList = $this->plainTeeRepository->searchByColor($colorSearch);
        $staffID = $request->session()->get('StaffID');
        $staffInfo = $this->staffRepository->getById($staffID);
        return view('admin.plainTeeColorList', ['colorList'=>$colorList], ['staffInfo'=>$staffInfo]);
    }

    public function addColor(Request $request){
        // Display add color form
        $staffID = $request->session()->get('StaffID');
        $staffInfo = $this->staffRepository->getById($staffID);
        return view('admin.plainTeeAddColor', ['staffInfo'=>$staffInfo]);
    }

    public function addColorSubmit(Request $request){
        // Check whether user want add or cancel
        $addCancel = $request->input('addCancel');
        if (!strcmp($addCancel, "Add Color")) {
            $request->validate([
                "color_name" => "required",
                "color_code" => "required"
            ]);

            // get input value
            $color_name = $request->input('color_name');
            $color_code = $request->input('color_code');

            // Add data to database
            $data = ["color_name"=>$color_name, "color_code"=>$color_code];
            $this->plainTeeRepository->createColor($data);

            // Redirect to printing method list
            echo "<script>alert('Color add successfully!')</script>";
            $colorList = $this->plainTeeRepository->getAllColor();
            $staffID = $request->session()->get('StaffID');
            $staffInfo = $this->staffRepository->getById($staffID);
            return view('admin.plainTeeColorList', ['colorList'=>$colorList], ['staffInfo'=>$staffInfo]);
        }else{
            // Redirect user to color list
            $colorList = $this->plainTeeRepository->getAllColor();
            $staffID = $request->session()->get('StaffID');
            $staffInfo = $this->staffRepository->getById($staffID);
            return view('admin.plainTeeColorList', ['colorList'=>$colorList], ['staffInfo'=>$staffInfo]);
        }
    }

    public function colorDetail(Request $request, $colorID){
        // Pass color ID and get all information about specific design
        $colorDetail = $this->plainTeeRepository->getByColorId($colorID);
        $staffID = $request->session()->get('StaffID');
        $staffInfo = $this->staffRepository->getById($staffID);
        return view('admin.plainTeeColorDetail', ['colorDetail'=>$colorDetail], ['staffInfo'=>$staffInfo]);
    }

    public function colorFunction(Request $request){
        // Check user want update, delete or cancel
        $updateDeleteCancel = $request->input('updateDeleteCancel');
        $color_id = $request->input('color_id');
        if(!strcmp($updateDeleteCancel, "Update")){
            // Update - redirect to update form
            $colorUpdate = $this->plainTeeRepository->getByColorId($color_id);
            $staffID = $request->session()->get('StaffID');
            $staffInfo = $this->staffRepository->getById($staffID);
            return view('admin.plainTeeColorUpdate', ['colorUpdate'=>$colorUpdate], ['staffInfo'=>$staffInfo]);
        }else if(!strcmp($updateDeleteCancel, "Delete")){
            // Delete from database
            $this->plainTeeRepository->deleteColor($color_id);

            // Redrect back to color list
            echo "<script>alert('Delete successfully!')</script>";
            $colorList = $this->plainTeeRepository->getAllColor();
            $staffID = $request->session()->get('StaffID');
            $staffInfo = $this->staffRepository->getById($staffID);
            return view('admin.plainTeeColorList', ['colorList'=>$colorList], ['staffInfo'=>$staffInfo]);
        }else{
            // Cancel - redirect to color list
            $colorList = $this->plainTeeRepository->getAllColor();
            $staffID = $request->session()->get('StaffID');
            $staffInfo = $this->staffRepository->getById($staffID);
            return view('admin.plainTeeColorList', ['colorList'=>$colorList], ['staffInfo'=>$staffInfo]);
        }
    }

    public function colorDetailUpdate(Request $request){
        // Check user want update or cancel
        $updateCancel = $request->input('updateCancel');
        // Get printing method id
        $color_id = $request->input('color_id');
        if(!strcmp($updateCancel, "Update")){
            // Update - update to database
            // Validate null input
            $request->validate([
                "color_name" => "required",
                "color_code" => "required"
            ]);

            // Get input data
            $color_name = $request->input('color_name');
            $color_code = $request->input('color_code');

            // Update to database
            $this->plainTeeRepository->updateColor($color_id, $color_name, $color_code);

            // Redirect back to the color detail page
            echo "<script>alert('Update successfully!')</script>";
            $colorDetail = $this->plainTeeRepository->getByColorId($color_id);
            $staffID = $request->session()->get('StaffID');
            $staffInfo = $this->staffRepository->getById($staffID);
            return view('admin.plainTeeColorDetail', ['colorDetail'=>$colorDetail], ['staffInfo'=>$staffInfo]);
        }else{
            // Cancel - redirect to color detail page
            $colorDetail = $this->plainTeeRepository->getByColorId($color_id);
            $staffID = $request->session()->get('StaffID');
            $staffInfo = $this->staffRepository->getById($staffID);
            return view('admin.plainTeeColorDetail', ['colorDetail'=>$colorDetail], ['staffInfo'=>$staffInfo]);
        }
    }

    public function typeList(Request $request){
        // Display all type to the list
        $typeList = $this->plainTeeRepository->getAllType();
        $staffID = $request->session()->get('StaffID');
        $staffInfo = $this->staffRepository->getById($staffID);
        return view('admin.plainTeeTypeList', ['typeList'=>$typeList], ['staffInfo'=>$staffInfo]);
    }

    public function typeSearch(Request $request){
        $typeSearch = $request->input('searchType');
        $typeList = $this->plainTeeRepository->searchByType($typeSearch);
        $staffID = $request->session()->get('StaffID');
        $staffInfo = $this->staffRepository->getById($staffID);
        return view('admin.plainTeeTypeList', ['typeList'=>$typeList], ['staffInfo'=>$staffInfo]);
    }

    public function addType(Request $request){
        // Display add color form
        $staffID = $request->session()->get('StaffID');
        $staffInfo = $this->staffRepository->getById($staffID);
        return view('admin.plainTeeAddType', ['staffInfo'=>$staffInfo]);
    }

    public function addTypeSubmit(Request $request){
        // Check whether user want add or cancel
        $addCancel = $request->input('addCancel');
        if (!strcmp($addCancel, "Add Type")) {
            $request->validate([
                "name" => "required",
                "material" => "required",
                "description" => "required",
                "detail" => "required",
                "price" => "required"
            ]);

            // Get input value
            $name = $request->input('name');
            $material = $request->input('material');
            $description = $request->input('description');
            $detail = $request->input('detail');
            $price = $request->input('price');

            // Add data to database
            $data = ["name"=>$name, "material"=>$material, "description"=>$description, "detail"=>$detail, "price"=>$price];
            $this->plainTeeRepository->createType($data);

            // Redirect to printing method list
            echo "<script>alert('Type add successfully!')</script>";
            $typeList = $this->plainTeeRepository->getAllType();
            $staffID = $request->session()->get('StaffID');
            $staffInfo = $this->staffRepository->getById($staffID);
            return view('admin.plainTeeTypeList', ['typeList'=>$typeList], ['staffInfo'=>$staffInfo]);
        }else{
            // Redirect user to type list
            $typeList = $this->plainTeeRepository->getAllType();
            $staffID = $request->session()->get('StaffID');
            $staffInfo = $this->staffRepository->getById($staffID);
            return view('admin.plainTeeTypeList', ['typeList'=>$typeList], ['staffInfo'=>$staffInfo]);
        }
    }

    public function typeDetail(Request $request, $typeID){
        // Pass type ID and get all information about specific design
        $typeDetail = $this->plainTeeRepository->getByTypeId($typeID);
        $staffID = $request->session()->get('StaffID');
        $staffInfo = $this->staffRepository->getById($staffID);
        return view('admin.plainTeeTypeDetail', ['typeDetail'=>$typeDetail], ['staffInfo'=>$staffInfo]);
    }

    public function typeFunction(Request $request){
        // Check user want update, delete or cancel
        $updateDeleteCancel = $request->input('updateDeleteCancel');
        $type_id = $request->input('type_id');
        if(!strcmp($updateDeleteCancel, "Update")){
            // Update - redirect to update form
            $typeUpdate = $this->plainTeeRepository->getByTypeId($type_id);
            $staffID = $request->session()->get('StaffID');
            $staffInfo = $this->staffRepository->getById($staffID);
            return view('admin.plainTeeTypeUpdate', ['typeUpdate'=>$typeUpdate], ['staffInfo'=>$staffInfo]);
        }else if(!strcmp($updateDeleteCancel, "Delete")){
            // Delete from database
            $this->plainTeeRepository->deleteType($type_id);

            // Redrect back to color list
            echo "<script>alert('Delete successfully!')</script>";
            $typeList = $this->plainTeeRepository->getAllType();
            $staffID = $request->session()->get('StaffID');
            $staffInfo = $this->staffRepository->getById($staffID);
            return view('admin.plainTeeTypeList', ['typeList'=>$typeList], ['staffInfo'=>$staffInfo]);
        }else{
            // Cancel - redirect to color list
            $typeList = $this->plainTeeRepository->getAllType();
            $staffID = $request->session()->get('StaffID');
            $staffInfo = $this->staffRepository->getById($staffID);
            return view('admin.plainTeeTypeList', ['typeList'=>$typeList], ['staffInfo'=>$staffInfo]);
        }
    }

    public function typeDetailUpdate(Request $request){
        // Check user want update or cancel
        $updateCancel = $request->input('updateCancel');
        // Get printing method id
        $type_id = $request->input('type_id');
        if(!strcmp($updateCancel, "Update")){
            // Update - update to database
            // Validate null input
            $request->validate([
                "name" => "required",
                "material" => "required",
                "description" => "required",
                "detail" => "required",
                "price" => "required"
            ]);

            // Get input value
            $name = $request->input('name');
            $material = $request->input('material');
            $description = $request->input('description');
            $detail = $request->input('detail');
            $price = $request->input('price');

            // Update to database
            $this->plainTeeRepository->updateType($type_id, $name, $material, $description, $detail, $price);

            // Redirect back to the color detail page
            echo "<script>alert('Update successfully!')</script>";
            $typeDetail = $this->plainTeeRepository->getByTypeId($type_id);
            $staffID = $request->session()->get('StaffID');
            $staffInfo = $this->staffRepository->getById($staffID);
            return view('admin.plainTeeTypeDetail', ['typeDetail'=>$typeDetail], ['staffInfo'=>$staffInfo]);
        }else{
            // Cancel - redirect to color detail page
            $typeDetail = $this->plainTeeRepository->getByTypeId($type_id);
            $staffID = $request->session()->get('StaffID');
            $staffInfo = $this->staffRepository->getById($staffID);
            return view('admin.plainTeeTypeDetail', ['typeDetail'=>$typeDetail], ['staffInfo'=>$staffInfo]);
        }
    }

    public function typeColorList(Request $request){
        // Display all type color to the list
        $typeColorList = $this->plainTeeRepository->listForTypeColor();
        $staffID = $request->session()->get('StaffID');
        $staffInfo = $this->staffRepository->getById($staffID);
        return view('admin.plainTeeTypeColorList', ['typeColorList'=>$typeColorList], ['staffInfo'=>$staffInfo]);
    }

    public function typeColorSearch(Request $request){
        $sizeSearch = $request->input('searchSize');
        $sizeList = $this->plainTeeRepository->searchBySize($sizeSearch);
        $staffID = $request->session()->get('StaffID');
        $staffInfo = $this->staffRepository->getById($staffID);
        return view('admin.plainTeeTypeColorList', ['sizeList'=>$sizeList], ['staffInfo'=>$staffInfo]);
    }

    public function addTypeColor(Request $request){
        // Display add type color form
        $allType = $this->plainTeeRepository->getAllType();
        $allColor = $this->plainTeeRepository->getAllColor();
        $staffID = $request->session()->get('StaffID');
        $staffInfo = $this->staffRepository->getById($staffID);
        return view('admin.plainTeeAddTypeColor', ['allColor'=>$allColor, 'allType'=>$allType], ['staffInfo'=>$staffInfo]);
    }

    public function addTypeColorSubmit(Request $request){
        // Check whether user want add or cancel
        $addCancel = $request->input('addCancel');
        if (!strcmp($addCancel, "Add Type Color")) {
            $request->validate([
                "plain_tee_img" => "required",
                "color_id" => "required",
                "type_id" => "required"
            ]);

            // Get input value
            $path = $request->file('plain_tee_img');
            $plain_tee_img = $path->getClientOriginalName();

            //Stored to public file/plainTee
            $path->move(public_path('plainTee/'), $plain_tee_img);

            $color_id = $request->input('color_id');
            $type_id = $request->input('type_id');

            // Add data to database
            $data = ["plain_tee_img"=>$plain_tee_img, "color_id"=>$color_id, "type_id"=>$type_id];
            $this->plainTeeRepository->createTypeColor($data);

            // Redirect to printing method list
            echo "<script>alert('Plain tee add successfully!')</script>";
            $typeColorList = $this->plainTeeRepository->listForTypeColor();
            $staffID = $request->session()->get('StaffID');
            $staffInfo = $this->staffRepository->getById($staffID);
            return view('admin.plainTeeTypeColorList', ['typeColorList'=>$typeColorList], ['staffInfo'=>$staffInfo]);
        }else{
            // Redirect user to type color list
            $typeColorList = $this->plainTeeRepository->listForTypeColor();
            $staffID = $request->session()->get('StaffID');
            $staffInfo = $this->staffRepository->getById($staffID);
            return view('admin.plainTeeTypeColorList', ['typeColorList'=>$typeColorList], ['staffInfo'=>$staffInfo]);
        }
    }

    public function typeColorDetail(Request $request, $pt_type_color_id){
        // Pass typeColor ID and get all information
        $typeColorDetail = $this->plainTeeRepository->getFullDetailByTypeColor($pt_type_color_id);
        $staffID = $request->session()->get('StaffID');
        $staffInfo = $this->staffRepository->getById($staffID);
        return view('admin.plainTeeTypeColorDetail', ['typeColorDetail'=>$typeColorDetail], ['staffInfo'=>$staffInfo]);
    }

    public function typeColorFunction(Request $request){
        // Check user want update, delete or cancel
        $updateDeleteCancel = $request->input('updateDeleteCancel');
        $pt_type_color_id = $request->input('pt_type_color_id');
        if(!strcmp($updateDeleteCancel, "Update")){
            // Update - redirect to update form
            $typeColorUpdate = $this->plainTeeRepository->getByTypeColorId($pt_type_color_id);
            $allType = $this->plainTeeRepository->getAllType();
            $allColor = $this->plainTeeRepository->getAllColor();
            $staffID = $request->session()->get('StaffID');
            $staffInfo = $this->staffRepository->getById($staffID);
            return view('admin.plainTeeTypeColorUpdate', ['typeColorUpdate'=>$typeColorUpdate, 'allColor'=>$allColor, 'allType'=>$allType], ['staffInfo'=>$staffInfo]);
        }else if(!strcmp($updateDeleteCancel, "Delete")){
            // Delete from database
            $this->plainTeeRepository->deleteTypeColor($pt_type_color_id);

            $oldImgPath = $request->input('deleteImg');
            unlink(public_path("plainTee/$oldImgPath"));

            // Redrect back to color list
            echo "<script>alert('Delete successfully!')</script>";
            $typeColorList = $this->plainTeeRepository->listForTypeColor();
            $staffID = $request->session()->get('StaffID');
            $staffInfo = $this->staffRepository->getById($staffID);
            return view('admin.plainTeeTypeColorList', ['typeColorList'=>$typeColorList], ['staffInfo'=>$staffInfo]);
        }else{
            // Cancel - redirect to color list
            $typeColorList = $this->plainTeeRepository->listForTypeColor();
            $staffID = $request->session()->get('StaffID');
            $staffInfo = $this->staffRepository->getById($staffID);
            return view('admin.plainTeeTypeColorList', ['typeColorList'=>$typeColorList], ['staffInfo'=>$staffInfo]);
        }
    }

    public function typeColorDetailUpdate(Request $request){
        // Check user want update or cancel
        $updateCancel = $request->input('updateCancel');
        // Get printing method id
        $pt_type_color_id = $request->input('pt_type_color_id');
        if(!strcmp($updateCancel, "Update")){
            // Update - update to database
            // Validate null input
            $request->validate([
                "plain_tee_img" => "required",
                "color_id" => "required",
                "type_id" => "required"
            ]);

            // Get input value
            $path = $request->file('plain_tee_img');
            $plain_tee_img = $path->getClientOriginalName();


            //Stored to public file/plainTee
            $oldImgPath = $request->input('deleteImg');
            unlink(public_path("plainTee/$oldImgPath"));
            $path->move(public_path('plainTee/'), $plain_tee_img);
            $color_id = $request->input('color_id');
            $type_id = $request->input('type_id');
            $pt_type_color_id = $request->input('pt_type_color_id');

            // Update to database
            $this->plainTeeRepository->updateTypeColor($pt_type_color_id, $plain_tee_img, $color_id, $type_id);

            // Redirect back to the color detail page
            echo "<script>alert('Update successfully!')</script>";
            $typeColorDetail = $this->plainTeeRepository->getFullDetailByTypeColor($pt_type_color_id);
            $staffID = $request->session()->get('StaffID');
            $staffInfo = $this->staffRepository->getById($staffID);
            return view('admin.plainTeeTypeColorDetail', ['typeColorDetail'=>$typeColorDetail], ['staffInfo'=>$staffInfo]);
        }else{
            // Cancel - redirect to color detail page
            $typeColorDetail = $this->plainTeeRepository->getFullDetailByTypeColor($pt_type_color_id);
            $staffID = $request->session()->get('StaffID');
            $staffInfo = $this->staffRepository->getById($staffID);
            return view('admin.plainTeeTypeColorDetail', ['typeColorDetail'=>$typeColorDetail], ['staffInfo'=>$staffInfo]);
        }
    }

    public function plainTeeList(Request $request){
        // Display all plain tee to the list
        $sizeList = $this->plainTeeRepository->listForPlainTee();
        $staffID = $request->session()->get('StaffID');
        $staffInfo = $this->staffRepository->getById($staffID);
        return view('admin.plainTeeList', ['sizeList'=>$sizeList], ['staffInfo'=>$staffInfo]);
    }

    public function sizeSearch(Request $request){
        $sizeSearch = $request->input('searchSize');
        $sizeList = $this->plainTeeRepository->searchBySize($sizeSearch);
        $staffID = $request->session()->get('StaffID');
        $staffInfo = $this->staffRepository->getById($staffID);
        return view('admin.plainTeeList', ['sizeList'=>$sizeList], ['staffInfo'=>$staffInfo]);
    }

    public function addShirt(Request $request){
        // Display add shirt form
        $allTypeColor = $this->plainTeeRepository->listForTypeColor();
        $staffID = $request->session()->get('StaffID');
        $staffInfo = $this->staffRepository->getById($staffID);
        return view('admin.plainTeeAddShirt', ['allTypeColor'=>$allTypeColor], ['staffInfo'=>$staffInfo]);
    }

    public function addShirtSubmit(Request $request){
        // Check whether user want add or cancel
        $addCancel = $request->input('addCancel');
        if (!strcmp($addCancel, "Add Shirt")) {
            $request->validate([
                "stocks" => "required",
                "size_name" => "required",
                "pt_type_color_id" => "required"
            ]);

            // Get input value
            $stocks = $request->input('stocks');
            $size_name = $request->input('size_name');
            $pt_type_color_id = $request->input('pt_type_color_id');

            // Add data to database
            $data = ["stocks"=>$stocks, "size_name"=>$size_name, "pt_type_color_id"=>$pt_type_color_id];
            $this->plainTeeRepository->createSize($data);

            // Redirect to printing method list
            echo "<script>alert('Plain tee add successfully!')</script>";
            $sizeList = $this->plainTeeRepository->listForPlainTee();
            $staffID = $request->session()->get('StaffID');
            $staffInfo = $this->staffRepository->getById($staffID);
            return view('admin.plainTeeList', ['sizeList'=>$sizeList], ['staffInfo'=>$staffInfo]);
        }else{
            // Redirect user to type list
            $sizeList = $this->plainTeeRepository->listForPlainTee();
            $staffID = $request->session()->get('StaffID');
            $staffInfo = $this->staffRepository->getById($staffID);
            return view('admin.plainTeeList', ['sizeList'=>$sizeList], ['staffInfo'=>$staffInfo]);
        }
    }

    public function plainTeeDetail(Request $request, $plain_tee_size_id){
        // Pass size ID and get all information about specific design
        $plainTeeDetail = $this->plainTeeRepository->getFullDetailBySizeId($plain_tee_size_id);
        $staffID = $request->session()->get('StaffID');
        $staffInfo = $this->staffRepository->getById($staffID);
        return view('admin.plainTeeDetail', ['plainTeeDetail'=>$plainTeeDetail], ['staffInfo'=>$staffInfo]);
    }

    public function plainTeeFunction(Request $request){
        // Check user want update, delete or cancel
        $updateDeleteCancel = $request->input('updateDeleteCancel');
        $plain_tee_size_id = $request->input('plain_tee_size_id');
        if(!strcmp($updateDeleteCancel, "Update")){
            // Update - redirect to update form
            $plainTeeUpdate = $this->plainTeeRepository->getBySizeId($plain_tee_size_id);
            $allTypeColor = $this->plainTeeRepository->listForTypeColor();
            $staffID = $request->session()->get('StaffID');
            $staffInfo = $this->staffRepository->getById($staffID);
            return view('admin.plainTeeUpdateShirt', ['plainTeeUpdate'=>$plainTeeUpdate, "allTypeColor"=>$allTypeColor], ['staffInfo'=>$staffInfo]);
        }else if(!strcmp($updateDeleteCancel, "Delete")){
            // Delete from database
            $this->plainTeeRepository->deleteSize($plain_tee_size_id);

            // Redrect back to color list
            echo "<script>alert('Delete successfully!')</script>";
            $sizeList = $this->plainTeeRepository->listForPlainTee();
            $staffID = $request->session()->get('StaffID');
            $staffInfo = $this->staffRepository->getById($staffID);
            return view('admin.plainTeeList', ['sizeList'=>$sizeList], ['staffInfo'=>$staffInfo]);
        }else{
            // Cancel - redirect to color list
            $sizeList = $this->plainTeeRepository->listForPlainTee();
            $staffID = $request->session()->get('StaffID');
            $staffInfo = $this->staffRepository->getById($staffID);
            return view('admin.plainTeeList', ['sizeList'=>$sizeList], ['staffInfo'=>$staffInfo]);
        }
    }

    public function plainTeeDetailUpdate(Request $request){
        // Check user want update or cancel
        $updateCancel = $request->input('updateCancel');
        // Get printing method id
        $plain_tee_size_id = $request->input('plain_tee_size_id');
        if(!strcmp($updateCancel, "Update")){
            // Update - update to database
            // Validate null input
            $request->validate([
                "stocks" => "required",
                "size_name" => "required",
                "pt_type_color_id" => "required"
            ]);

            // Get input value
            $stocks = $request->input('stocks');
            $size_name = $request->input('size_name');
            $pt_type_color_id = $request->input('pt_type_color_id');

            // Update to database
            $this->plainTeeRepository->updateSize($plain_tee_size_id, $stocks, $size_name, $pt_type_color_id);

            // Redirect back to the color detail page
            echo "<script>alert('Update successfully!')</script>";
            $plainTeeDetail = $this->plainTeeRepository->getFullDetailBySizeId($plain_tee_size_id);
            $staffID = $request->session()->get('StaffID');
            $staffInfo = $this->staffRepository->getById($staffID);
            return view('admin.plainTeeDetail', ['plainTeeDetail'=>$plainTeeDetail], ['staffInfo'=>$staffInfo]);
        }else{
            // Cancel - redirect to color detail page
            $plainTeeDetail = $this->plainTeeRepository->getFullDetailBySizeId($plain_tee_size_id);
            $staffID = $request->session()->get('StaffID');
            $staffInfo = $this->staffRepository->getById($staffID);
            return view('admin.plainTeeDetail', ['plainTeeDetail'=>$plainTeeDetail], ['staffInfo'=>$staffInfo]);
        }
    }

}
