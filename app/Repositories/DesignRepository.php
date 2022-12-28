<?php
namespace App\Repositories;
use App\Models\PublishedDesign;
use App\Models\PublishedDesignReport;
use Illuminate\Support\Facades\DB;

class DesignRepository implements DesignRepositoryInterface {

    public function getAllDesign(){
        return PublishedDesign::all();
    }

    public function getAllReport(){
        return DB::select("SELECT * FROM published_designs AS PD, published_design_reports AS PDR, customers AS C
        WHERE PD.p_design_id=PDR.p_design_id AND PDR.cus_id = C.cus_id");
    }

    public function searchByName($name){
        return DB::select("SELECT * FROM published_designs WHERE name LIKE '%$name%'");
    }

    public function searchByTitle($title){
        return DB::select("SELECT * FROM published_design_reports WHERE title LIKE '%$title%'");
    }

    public function getById($id){
        return DB::table('published_designs')
        ->select('published_designs.*')
        ->where('published_designs.p_design_id', $id)
        ->first();
    }

    public function getByReportId($id){
        return DB::table('published_design_reports')
        ->select('published_design_reports.*')
        ->where('published_design_reports.p_design_report_id', $id)
        ->first();
    }

    public function getCusName($id){
        return DB::table('customers')
        ->select('customers.*')
        ->where('customers.cus_id', $id)
        ->first();
    }

    public function updateStatus($id, $status, $reason_banned_denied){
        return DB::update("UPDATE published_designs SET status='$status', reason_banned_denied='$reason_banned_denied' WHERE p_design_id='$id'");
    }

    public function deleteReport($id){
        return DB::delete("DELETE FROM published_design_reports WHERE p_design_id='$id'");
    }

}

?>
