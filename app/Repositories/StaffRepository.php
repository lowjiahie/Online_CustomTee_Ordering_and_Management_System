<?php
namespace App\Repositories;
use App\Models\Staff;
use Illuminate\Support\Facades\DB;

class StaffRepository implements StaffRepositoryInterface {

    public function getAll(){
        return Staff::all();
    }

    public function getById($id){
        return DB::table('staff')
        ->select("staff.*")
        ->where("staff.staff_id", $id)
        ->first();
    }

    public function getByEmail($email){
        return DB::table('staff')
        ->select("staff.*")
        ->where("staff.email", $email)
        ->first();
    }

    public function create($contain){
        return Staff::create($contain);
    }

    public function updateProfile($id, $name, $email){
        return DB::update("UPDATE staff SET name='$name', email='$email' WHERE staff_id='$id'");
    }

    public function changePassword($id, $password){
        return DB::update("UPDATE staff SET password='$password' WHERE staff_id='$id'");
    }

    public function deleteById($id){
        return DB::delete("DELETE staff WHERE id=$id");
    }





}

?>
