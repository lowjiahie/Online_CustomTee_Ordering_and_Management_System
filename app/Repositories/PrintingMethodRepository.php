<?php
namespace App\Repositories;
use App\Models\PrintingMethod;
use Illuminate\Support\Facades\DB;

class PrintingMethodRepository implements PrintingMethodRepositoryInterface {

    public function getAll(){
        return PrintingMethod::all();
    }

    public function getById($id){
        return DB::table('printing_methods')
        ->select("printing_methods.*")
        ->where("printing_methods.p_method_id", $id)
        ->first();
    }

    public function searchByName($name){
        return DB::select("SELECT * FROM printing_methods WHERE name LIKE '%$name%'");
    }

    public function getByIdSort($sort){
        if ($sort == 'ASC'){
            $sort == 'DESC';
            return DB::table('printing_methods')
            ->select("printing_methods.*")
            ->orderBy('p_method_id', 'ASC')
            ->get();
        }
        else{
            $sort == 'ASC';
            return DB::table('printing_methods')
            ->select("printing_methods.*")
            ->orderBy('p_method_id', 'DESC')
            ->get();
        }
    }

    public function getByNameSort($sort){
        return DB::table('printing_methods')
        ->select("printing_methods.*")
        ->orderBy('name', $sort)
        ->get();
    }

    public function getByPriceSort($sort){
        return DB::table('printing_methods')
        ->select("printing_methods.*")
        ->orderBy('price', $sort)
        ->get();
    }

    public function getByMinimumOrderSort($sort){
        return DB::table('printing_methods')
        ->select("printing_methods.*")
        ->orderBy('minimum_order', $sort)
        ->get();
    }

    public function getByStatusSort($sort){
        return DB::table('printing_methods')
        ->select("printing_methods.*")
        ->orderBy('status', $sort)
        ->get();
    }

    public function create($contain){
        return PrintingMethod::create($contain);
    }

    public function update($id, $name, $price, $minimumOrder, $status){
        return DB::update("UPDATE printing_methods SET name='$name', price='$price', minimum_order='$minimumOrder', status='$status' WHERE p_method_id='$id'");
    }

    public function deleteById($id){
        return DB::delete("DELETE FROM printing_methods WHERE p_method_id='$id'");
    }
}

?>
