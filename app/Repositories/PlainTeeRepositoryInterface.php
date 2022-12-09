<?php
namespace App\Repositories;

interface PlainTeeRepositoryInterface {

    public function createColor($contain);

    public function createType($contain);

    public function createSize($contain);

    public function createTypeColor($contain);

    public function getAllColor();

    public function getAllType();

    public function getAllSize();

    public function getAllTypeColor();

    public function listForPlainTee();

    public function listForTypeColor();

    public function searchByColor($color);

    public function searchByType($type);

    public function searchBySize($size);

    public function searchByTypeColor($typeColor);

    public function getByColorId($id);

    public function getByTypeId($id);

    public function getBySizeId($id);

    public function getByTypeColorId($id);

    public function getFullDetailBySizeId($id);

    public function getFullDetailByTypeColor($id);

    public function updateColor($id, $color_name, $color_code);

    public function updateType($id, $name, $material, $description, $detail, $price);

    public function updateSize($id, $stocks, $size_name, $pt_type_color_id);

    public function updateTypeColor($id, $plain_tee_img, $color_id, $type_id);

    public function deleteColor($id);

    public function deleteType($id);

    public function deleteSize($id);

    public function deleteTypeColor($id);
}

?>
