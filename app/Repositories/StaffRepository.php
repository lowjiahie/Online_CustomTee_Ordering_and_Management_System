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

    public function updateProfile($id, $name, $gender, $date_of_birth, $phone_no){
        return DB::update("UPDATE staff SET name='$name', gender='$gender', date_of_birth='$date_of_birth', phone_no='$phone_no' WHERE staff_id='$id'");
    }

    public function changePassword($id, $password){
        return DB::update("UPDATE staff SET password='$password' WHERE staff_id='$id'");
    }

    public function deleteById($id){
        return DB::delete("DELETE staff WHERE id=$id");
    }


    public function dashboardCurrentBannedDesign(){
        return DB::select("SELECT COUNT(status) AS bannedDesignCount FROM published_designs WHERE status='banned'");
    }

    public function dashboardCurrentCompetition(){
        return DB::select("SELECT COUNT(end_date_time) AS competitionCount FROM competitions WHERE end_date_time>=now()");
    }

    public function dashboardCurrentOrder(){
        return DB::select("SELECT COUNT(status) AS orderCount FROM orders WHERE status='pending'");
    }

    public function dashboardCurrentDelivery(){
        return DB::select("SELECT COUNT(status) AS deliveryCount FROM delivery_details WHERE status='pending'");
    }

    public function dashboardOrderList(){
        return DB::select("SELECT O.order_id, C.name, O.totalPrice, O.order_date, O.status
        FROM orders AS O, customers AS C WHERE O.cus_id=C.cus_id AND O.status='pending'
        ORDER BY O.order_date DESC LIMIT 10");
    }

    public function forgotPasswordAdd($email, $token){
        return DB::table('password_resets')->insert([
            'email' => $email,
            'token' => $token
        ]);
    }

    public function getPasswordRecoveryEmail($email){
        return DB::table('password_resets')
        ->select("password_resets.*")
        ->where("password_resets.email", $email)
        ->first();
    }

    public function forgotPasswordDelete(){
        return DB::select("DELETE FROM password_resets");
    }

    public function updateByEmail($email, $password){
        return DB::update("UPDATE staff SET password='$password' WHERE email='$email'");
    }

}

?>
