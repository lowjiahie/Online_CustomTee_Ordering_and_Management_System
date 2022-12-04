<?php
namespace App\Repositories;

interface DesignRepositoryInterface {

    public function getAllDesign();

    public function getAllReport();

    public function searchByName($name);

    public function getById($id);

    public function getCusName($id);

    public function updateStatus($id, $status, $reason_banned_design);
}

?>
