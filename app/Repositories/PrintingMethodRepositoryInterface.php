<?php
namespace App\Repositories;

interface PrintingMethodRepositoryInterface {

    public function getAll();

    public function getById($id);

    public function searchByName($name);

    public function getByIdSort($sort);

    public function getByNameSort($sort);

    public function getByPriceSort($sort);

    public function getByMinimumOrderSort($sort);

    public function getByStatusSort($sort);

    public function create($contain);

    public function update($id, $name, $price, $minimumOrder, $status);

    public function deleteById($id);
}

?>
