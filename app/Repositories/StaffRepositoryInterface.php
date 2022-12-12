<?php
namespace App\Repositories;

interface StaffRepositoryInterface {

    public function getAll();

    public function getById($id);

    public function getByEmail($email);

    public function create($contain);

    public function updateProfile($id, $name, $gender, $date_of_birth, $phone_no);

    public function changePassword($id, $password);

    public function deleteById($id);

    public function dashboardCurrentBannedDesign();

    public function dashboardCurrentCompetition();

    public function dashboardCurrentOrder();

    public function dashboardCurrentDelivery();

    public function dashboardOrderList();

    public function forgotPasswordAdd($email, $token);

    public function getPasswordRecoveryEmail($email);

    public function forgotPasswordDelete($email);

}

?>
