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
        return PublishedDesignReport::all();
    }

    public function searchByName($name){
        return DB::select("SELECT * FROM published_designs WHERE name LIKE '%$name%'");
    }

    public function getById($id){
        return DB::table('published_designs')
        ->select('published_designs.*')
        ->where('published_designs.p_design_id', $id)
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

}

?>