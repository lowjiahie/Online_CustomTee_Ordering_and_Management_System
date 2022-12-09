<?php
namespace App\Repositories;

interface CompetitionRepositoryInterface {

    public function getAllCompetition();

    public function getAllParticipant($id);

    public function searchByTopic($topic);

    public function searchByCusName($cusName);

    public function getById($id);

    public function getStaffName($id);

    public function getCusName($id);

    public function create($contain);

    public function updateCompetition($id, $description, $rules, $end_date_time);

    public function updateWinner($id, $cus_name);

    public function deleteCompetition($id);
}

?>
