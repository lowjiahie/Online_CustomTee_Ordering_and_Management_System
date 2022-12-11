<?php

namespace App\Http\Controllers\Customer;

use App\Models\Competition;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Repositories\CompetitionRepositoryInterface;

class CompetitionController extends Controller
{
    // Make Repository Easy for CRUD of Staff
    private $competitionRepository;
    private $staffRepository;

    public function __construct(CompetitionRepositoryInterface $competitionRepository)
    {
        $this->competitionRepository = $competitionRepository;
    }

    public function competitionList(Request $request){
        // Display all competition to the list
        $competitionList = $this->competitionRepository->getAllCompetition();

        $cusID = $request->cusID;
        // $response = CustomTeeDesign::join('plain_tee_type_colors', 'plain_tee_type_colors.pt_type_color_id', '=', 'custom_tee_designs.pt_type_color_id')
        //     ->where('custom_tee_designs.cus_id', '=', $cusID)
        //     ->join('types', 'types.type_id', '=', 'plain_tee_type_colors.type_id')
        //     ->join('colors', 'colors.color_id', '=', 'plain_tee_type_colors.color_id')
        //     ->select(
        //         'custom_tee_designs.*',
        //         'plain_tee_type_colors.plain_tee_img',
        //         'plain_tee_type_colors.color_id',
        //         'plain_tee_type_colors.type_id',
        //         'types.name as type_name',
        //         'types.material',
        //         'types.description',
        //         'types.detail',
        //         'types.price',
        //         'colors.color_name',
        //         'colors.color_code'
        //     )
        //     ->get();

        return response($competitionList, 201);
    }


}
