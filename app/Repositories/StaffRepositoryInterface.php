<?php
namespace App\Repositories;

interface StaffRepositoryInterface {

    public function getAll();

    public function getById($id);

    public function getByEmail($email);

    public function create($contain);

    public function updateProfile($id, $name, $email);

    public function changePassword($id, $password);

    public function deleteById($id);
}

?>
