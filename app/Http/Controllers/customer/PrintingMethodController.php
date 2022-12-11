<?php

namespace App\Http\Controllers\customer;

use App\Http\Controllers\Controller;
use App\Models\PrintingMethod;
use Illuminate\Http\Request;

class PrintingMethodController extends Controller
{
    public function getAvailablePrintingMethods()
    {
        $response = PrintingMethod::where('status', 'active')->get();


        return response($response, 201);
    }
}
