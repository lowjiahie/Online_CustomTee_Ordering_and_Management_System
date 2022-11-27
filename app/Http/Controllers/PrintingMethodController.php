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
        $printingMethodList = $this->printingMethodRepository->getAll();
        $staffID = $request->session()->get('StaffID');
        $staffInfo = $this->staffRepository->getById($staffID);
        return view('admin.printingMethod', ['printingMethodList'=>$printingMethodList], ['staffInfo'=>$staffInfo]);
    }

    // public function sorting(Request $request){
    //     $url = $request->url();

    //     $urlArray = explode("/", $url);
    //     $sortingDecision = $urlArray[6];
    //     $sort = $urlArray[7];

    //     // Make title sortable according to the ASC and DESC
    //     if($sortingDecision == 'p_method_id'){
    //         $printingMethodList = $this->printingMethodRepository->getByIdSort($sort);
    //         $staffID = $request->session()->get('StaffID');
    //         $staffInfo = $this->staffRepository->getById($staffID);
    //         return view('admin.printingMethod', ['printingMethodList'=>$printingMethodList], ['staffInfo'=>$staffInfo]);
    //     }else if($sortingDecision == 'name'){
    //         $printingMethodList = $this->printingMethodRepository->getByNameSort($sort);
    //         $staffID = $request->session()->get('StaffID');
    //         $staffInfo = $this->staffRepository->getById($staffID);
    //         return view('admin.printingMethod', ['printingMethodList'=>$printingMethodList], ['staffInfo'=>$staffInfo]);
    //     }else if($sortingDecision == 'price'){
    //         $printingMethodList = $this->printingMethodRepository->getByPriceSort($sort);
    //         $staffID = $request->session()->get('StaffID');
    //         $staffInfo = $this->staffRepository->getById($staffID);
    //         return view('admin.printingMethod', ['printingMethodList'=>$printingMethodList], ['staffInfo'=>$staffInfo]);
    //     }else if($sortingDecision == 'minimum_order'){
    //         $printingMethodList = $this->printingMethodRepository->getByMinimumOrderSort($sort);
    //         $staffID = $request->session()->get('StaffID');
    //         $staffInfo = $this->staffRepository->getById($staffID);
    //         return view('admin.printingMethod', ['printingMethodList'=>$printingMethodList], ['staffInfo'=>$staffInfo]);
    //     }else if($sortingDecision == 'status'){
    //         $printingMethodList = $this->printingMethodRepository->getByPriceSort($sort);
    //         $staffID = $request->session()->get('StaffID');
    //         $staffInfo = $this->staffRepository->getById($staffID);
    //         return view('admin.printingMethod', ['printingMethodList'=>$printingMethodList], ['staffInfo'=>$staffInfo]);
    //     }else{
    //         echo "<script>alert('Error occured, redirecting to view printing method page!')</script>";
    //         $printingMethodList = $this->printingMethodRepository->getAll();
    //         $staffID = $request->session()->get('StaffID');
    //         $staffInfo = $this->staffRepository->getById($staffID);
    //         return view('admin.printingMethod', ['printingMethodList'=>$printingMethodList], ['staffInfo'=>$staffInfo]);
    //     }

    // }

}
