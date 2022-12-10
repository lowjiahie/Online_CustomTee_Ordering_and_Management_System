<?php
namespace App\Repositories;
use App\Models\Competition;
use App\Models\Participant;
use Illuminate\Support\Facades\DB;

class CompetitionRepository implements CompetitionRepositoryInterface {

    public function getAllCompetition(){
        return Competition::all();
    }

    public function getAllParticipant($id){
        return DB::select("SELECT * FROM participants AS P, customers AS C
        WHERE P.cus_id=C.cus_id AND competition_id='$id'");
    }

    public function searchByTopic($topic){
        return DB::select("SELECT * FROM competitions WHERE topic LIKE '%$topic%'");
    }

    public function searchByCusName($cusName){
        return DB::select("SELECT * FROM participants AS P, customers AS C
        WHERE P.cus_id=C.cus_id AND C.name LIKE '%$cusName%'");
    }

    public function getById($id){
        return DB::table('competitions')
        ->select('competitions.*')
        ->where('competitions.competition_id', $id)
        ->first();
    }

    public function getStaffName($id){
        return DB::table('staff')
        ->select('staff.*')
        ->where('staff.staff_id', $id)
        ->first();
    }

    public function getCusName($id){
        return DB::table('customers')
        ->select('customers.*')
        ->where('customers.cus_id', $id)
        ->first();
    }

    public function create($contain){
        return Competition::create($contain);
    }

    public function updateCompetition($id, $description, $rules, $end_date_time){
        return DB::update("UPDATE competitions SET description='$description', rules='$rules', end_date_time='$end_date_time'
        WHERE competition_id='$id'");
    }

    public function updateWinner($id, $cus_name){
        return DB::update("UPDATE competitions SET winner='$cus_name' WHERE competition_id='$id'");
    }

    public function deleteCompetition($id){
        return DB::delete("DELETE FROM competitions WHERE competition_id='$id'");
    }

}

?>
