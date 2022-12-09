<?php

namespace App\Http\Controllers;

use App\Models\Competition;
use Illuminate\Http\Request;
use App\Repositories\CompetitionRepositoryInterface;
use App\Repositories\StaffRepositoryInterface;

class CompetitionController extends Controller
{
    // Make Repository Easy for CRUD of Staff
    private $competitionRepository;
    private $staffRepository;

    public function __construct(CompetitionRepositoryInterface $competitionRepository, StaffRepositoryInterface $staffRepository)
    {
        $this->competitionRepository = $competitionRepository;
        $this->staffRepository = $staffRepository;
    }

    public function competitionList(Request $request){
        // Display all competition to the list
        $competitionList = $this->competitionRepository->getAllCompetition();
        $staffID = $request->session()->get('StaffID');
        $staffInfo = $this->staffRepository->getById($staffID);
        return view('admin.competitionList', ['competitionList'=>$competitionList], ['staffInfo'=>$staffInfo]);
    }

    public function competitionSearch(Request $request){
        $topicSearch = $request->input('searchCompetition');
        $competitionList = $this->competitionRepository->searchByTopic($topicSearch);
        $staffID = $request->session()->get('StaffID');
        $staffInfo = $this->staffRepository->getById($staffID);
        return view('admin.competitionList', ['competitionList'=>$competitionList], ['staffInfo'=>$staffInfo]);
    }

    public function competitionAddPage(Request $request){
        $staffID = $request->session()->get('StaffID');
        $staffInfo = $this->staffRepository->getById($staffID);
        return view('admin.competitionAdd', ['staffInfo'=>$staffInfo]);
    }

    public function competitionAddSubmit(Request $request){
        // Check user want add or cancel
        $addCancel = $request->input('addCancel');
        if (!strcmp($addCancel, "Add")){
            // Add - add data to database
            // Validate null input
            $request->validate([
                "topic" => "required",
                "description" => "required",
                "rules" => "required",
                "start_date_time" => "required",
                "end_date_time" => "required"
            ]);

            // Get input data
            $topic = $request->input('topic');
            $description = $request->input('description');
            $rules = $request->input('rules');
            $start_date_time = $request->input('start_date_time');
            $end_date_time = $request->input('end_date_time');
            $staff_id = $request->input('staff_id');

            // Add data to database
            $data = ["topic"=>$topic, "description"=>$description, "rules"=>$rules,
            "start_date_time"=>$start_date_time, "end_date_time"=>$end_date_time, "staff_id"=>$staff_id];
            $this->competitionRepository->create($data);

            // Redirect to competition list
            echo "<script>alert('Add successfully!')</script>";
            $competitionList = $this->competitionRepository->getAllCompetition();
            $staffID = $request->session()->get('StaffID');
            $staffInfo = $this->staffRepository->getById($staffID);
            return view('admin.competitionList', ['competitionList'=>$competitionList], ['staffInfo'=>$staffInfo]);

        }else{
            // Cancel - redirect to competition list
            $competitionList = $this->competitionRepository->getAllCompetition();
            $staffID = $request->session()->get('StaffID');
            $staffInfo = $this->staffRepository->getById($staffID);
            return view('admin.competitionList', ['competitionList'=>$competitionList], ['staffInfo'=>$staffInfo]);
        }
    }

    public function competitionDetail(Request $request, $competition_id){
        // Pass competition ID and get all information about specific competition
        $competitionDetail = $this->competitionRepository->getById($competition_id);
        $staffName = $this->competitionRepository->getStaffName($competitionDetail->staff_id);
        $staffID = $request->session()->get('StaffID');
        $staffInfo = $this->staffRepository->getById($staffID);
        return view('admin.competitionDetail', ['competitionDetail'=>$competitionDetail, 'staffName'=>$staffName], ['staffInfo'=>$staffInfo]);
    }

    public function competitionFunction(Request $request){
        // Check user want view participant, announce winner, update, delete or cancel
        $competitionFunction = $request->input('competitionFunction');
        $competition_id = $request->input('competition_id');
        if (!strcmp($competitionFunction, "View Participant")){
            $participantList = $this->competitionRepository->getAllParticipant($competition_id);
            $staffID = $request->session()->get('StaffID');
            $staffInfo = $this->staffRepository->getById($staffID);
            return view('admin.competitionParticipantList', ['participantList'=>$participantList], ['staffInfo'=>$staffInfo]);
        }else if(!strcmp($competitionFunction, "Announce Winner")){
            $competitionDetail = $this->competitionRepository->getById($competition_id);
            $competitionUpdate = $this->competitionRepository->getAllParticipant($competition_id);
            $staffID = $request->session()->get('StaffID');
            $staffInfo = $this->staffRepository->getById($staffID);
            return view('admin.competitionAnnounceWinner', ['competitionDetail'=>$competitionDetail ,'competitionUpdate'=>$competitionUpdate], ['staffInfo'=>$staffInfo]);
        }else if(!strcmp($competitionFunction, "Update")){
            // Update - redirect to update form
            $competitionUpdate = $this->competitionRepository->getById($competition_id);
            $staffID = $request->session()->get('StaffID');
            $staffInfo = $this->staffRepository->getById($staffID);
            return view('admin.competitionUpdate', ['competitionUpdate'=>$competitionUpdate], ['staffInfo'=>$staffInfo]);
        }else if(!strcmp($competitionFunction, "Delete")){
            // Delete - delete the data
            // Delete from database
            $this->competitionRepository->deleteCompetition($competition_id);

            // Redrect back to competition list
            echo "<script>alert('Delete successfully!')</script>";
            $competitionList = $this->competitionRepository->getAllCompetition();
            $staffID = $request->session()->get('StaffID');
            $staffInfo = $this->staffRepository->getById($staffID);
            return view('admin.competitionList', ['competitionList'=>$competitionList], ['staffInfo'=>$staffInfo]);
        }else{
            // Cancel - redirect to competition list
            $competitionList = $this->competitionRepository->getAllCompetition();
            $staffID = $request->session()->get('StaffID');
            $staffInfo = $this->staffRepository->getById($staffID);
            return view('admin.competitionList', ['competitionList'=>$competitionList], ['staffInfo'=>$staffInfo]);
        }
    }

    public function competitionDetailUpdate(Request $request){
        // Check user want update or cancel
        $updateCancel = $request->input('updateCancel');
        // Get competition id
        $competition_id = $request->input('competition_id');
        if(!strcmp($updateCancel, "Update")){
            // Update - update to database
            // Validate null input
            $request->validate([
                "description" => "required",
                "rules" => "required",
                "end_date_time" => "required",
            ]);

            // Get input data
            $description = $request->input('description');
            $rules = $request->input('rules');
            $end_date_time = $request->input('end_date_time');

            // Update to database
            $this->competitionRepository->updateCompetition($competition_id, $description, $rules, $end_date_time);

            // Redirect back to the competition detail page
            echo "<script>alert('Update successfully!')</script>";
            $competitionDetail = $this->competitionRepository->getById($competition_id);
            $staffName = $this->competitionRepository->getStaffName($competitionDetail->staff_id);
            $staffID = $request->session()->get('StaffID');
            $staffInfo = $this->staffRepository->getById($staffID);
            return view('admin.competitionDetail', ['competitionDetail'=>$competitionDetail, 'staffName'=>$staffName], ['staffInfo'=>$staffInfo]);
        }else{
            // Cancel - redirect to competition detail page
            $competitionDetail = $this->competitionRepository->getById($competition_id);
            $staffName = $this->competitionRepository->getStaffName($competitionDetail->staff_id);
            $staffID = $request->session()->get('StaffID');
            $staffInfo = $this->staffRepository->getById($staffID);
            return view('admin.competitionDetail', ['competitionDetail'=>$competitionDetail, 'staffName'=>$staffName], ['staffInfo'=>$staffInfo]);
        }
    }

    public function competitionAnnounceWinner(Request $request){
        // Check user want update or cancel
        $selectWinnerCancel = $request->input('selectWinnerCancel');
        // Get competition id
        $competition_id = $request->input('competition_id');
        if(!strcmp($selectWinnerCancel, "Select As Winner")){
            // Update - update to database
            // Validate null input
            $request->validate([
                "cus_id" => "required",
            ]);

            // Get input data
            $cus_id = $request->input('cus_id');

            // Update to database
            $customerDetail = $this->competitionRepository->getCusName($cus_id);
            $this->competitionRepository->updateWinner($competition_id, $customerDetail->name);

            // Redirect back to the competition detail page
            echo "<script>alert('Update successfully!')</script>";
            $competitionDetail = $this->competitionRepository->getById($competition_id);
            $staffName = $this->competitionRepository->getStaffName($competitionDetail->staff_id);
            $staffID = $request->session()->get('StaffID');
            $staffInfo = $this->staffRepository->getById($staffID);
            return view('admin.competitionDetail', ['competitionDetail'=>$competitionDetail, 'staffName'=>$staffName], ['staffInfo'=>$staffInfo]);
        }else{
            // Cancel - redirect to competition detail page
            $competitionDetail = $this->competitionRepository->getById($competition_id);
            $staffName = $this->competitionRepository->getStaffName($competitionDetail->staff_id);
            $staffID = $request->session()->get('StaffID');
            $staffInfo = $this->staffRepository->getById($staffID);
            return view('admin.competitionDetail', ['competitionDetail'=>$competitionDetail, 'staffName'=>$staffName], ['staffInfo'=>$staffInfo]);
        }
    }

    public function participantFunction(Request $request){
        $competition_id = $request->input('competition_id');
        $competitionDetail = $this->competitionRepository->getById($competition_id);
        $staffName = $this->competitionRepository->getStaffName($competitionDetail->staff_id);
        $staffID = $request->session()->get('StaffID');
        $staffInfo = $this->staffRepository->getById($staffID);
        return view('admin.competitionDetail', ['competitionDetail'=>$competitionDetail, 'staffName'=>$staffName], ['staffInfo'=>$staffInfo]);
    }

    public function participantSearch(Request $request){
        $nameSearch = $request->input('searchParticipant');
        $participantList = $this->competitionRepository->searchByCusName($nameSearch);
        $staffID = $request->session()->get('StaffID');
        $staffInfo = $this->staffRepository->getById($staffID);
        return view('admin.competitionParticipantList', ['participantList'=>$participantList], ['staffInfo'=>$staffInfo]);
    }

}
