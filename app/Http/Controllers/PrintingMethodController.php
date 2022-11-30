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

    public function printingMethodDetail($printingMethodID){
        echo "<script>alert('$printingMethodID')</script>";
        return view('admin.printingMethodDetail');
    }

}
