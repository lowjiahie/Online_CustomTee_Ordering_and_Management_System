<?php
namespace App\Repositories;
use App\Models\Color;
use App\Models\Type;
use App\Models\PlainTeeSize;
use App\Models\PlainTeeTypeColor;
use Illuminate\Support\Facades\DB;
use PDO;

class PlainTeeRepository implements PlainTeeRepositoryInterface {

    public function createColor($contain){
        return Color::create($contain);
    }

    public function createType($contain){
        return Type::create($contain);
    }

    public function createSize($contain){
        return PlainTeeSize::create($contain);
    }

    public function createTypeColor($contain){
        return PlainTeeTypeColor::create($contain);
    }

    public function getAllColor(){
        return Color::all();
    }

    public function getAllType(){
        return Type::all();
    }

    public function getAllSize(){
        return PlainTeeSize::all();
    }

    public function getAllTypeColor(){
        return PlainTeeTypeColor::all();
    }

    public function listForPlainTee(){
        return DB::select("SELECT * FROM plain_tee_sizes AS S, plain_tee_type_colors AS TC, types AS T, colors AS C
        WHERE S.pt_type_color_id=TC.pt_type_color_id AND TC.type_id=T.type_id AND TC.color_id=C.color_id");
    }

    public function listForTypeColor(){
        return DB::select("SELECT * FROM plain_tee_type_colors AS TC, types AS T, colors AS C
        WHERE TC.type_id=T.type_id AND TC.color_id=C.color_id");
    }

    public function searchByColor($color){
        return DB::select("SELECT * FROM colors WHERE color_name LIKE '%$color%'");
    }

    public function searchByType($type){
        return DB::select("SELECT * FROM types WHERE name LIKE '%$type%'");
    }

    public function searchBySize($size){
        return DB::select("SELECT * FROM plain_tee_sizes AS S, plain_tee_type_colors AS TC, types AS T, colors AS C
        WHERE S.pt_type_color_id=TC.pt_type_color_id AND TC.type_id=T.type_id AND TC.color_id=C.color_id AND S.size_name LIKE '%$size%'");
    }

    public function searchByTypeColor($typeColor){
        return DB::select("SELECT * FROM plain_tee_type_colors AS TC, types AS T, colors AS C
        WHERE TC.type_id=T.type_id AND TC.color_id=C.color_id AND T.detail LIKE '%$typeColor%'");
    }

    public function getByColorId($id){
        return DB::table('colors')
        ->select('colors.*')
        ->where('colors.color_id', $id)
        ->first();
    }

    public function getByTypeId($id){
        return DB::table('types')
        ->select('types.*')
        ->where('types.type_id', $id)
        ->first();
    }

    public function getBySizeId($id){
        return DB::table('plain_tee_sizes')
        ->select('plain_tee_sizes.*')
        ->where('plain_tee_sizes.plain_tee_size_id', $id)
        ->first();
    }

    public function getByTypeColorId($id){
        return DB::table('plain_tee_type_colors')
        ->select('plain_tee_type_colors.*')
        ->where('plain_tee_type_colors.pt_type_color_id', $id)
        ->first();
    }

    public function getFullDetailBySizeId($id){
        return DB::select("SELECT S.plain_tee_size_id, S.stocks, S.size_name, T.name, C.color_name, T.detail, TC.plain_tee_img,
        T.material, T.description, T.price, C.color_code FROM plain_tee_sizes AS S, plain_tee_type_colors AS TC, types AS T, colors AS C
        WHERE S.pt_type_color_id=TC.pt_type_color_id AND TC.type_id=T.type_id AND TC.color_id=C.color_id AND S.plain_tee_size_id='$id'");
    }

    public function getFullDetailByTypeColor($id){
        return DB::select("SELECT * FROM plain_tee_type_colors AS TC, types AS T, colors AS C
        WHERE TC.type_id=T.type_id AND TC.color_id=C.color_id AND TC.pt_type_color_id='$id'");
    }

    public function updateColor($id, $color_code){
        return DB::update("UPDATE colors SET color_code='$color_code' WHERE color_id='$id'");
    }

    public function updateType($id, $description, $price){
        return DB::update("UPDATE types SET description='$description', price='$price' WHERE type_id='$id'");
    }

    public function updateSize($id, $stocks){
        return DB::update("UPDATE plain_tee_sizes SET stocks='$stocks' WHERE plain_tee_size_id='$id'");
    }

    public function updateTypeColor($id, $plain_tee_img, $color_id, $type_id){
        return DB::update("UPDATE plain_tee_type_colors SET plain_tee_img='$plain_tee_img', color_id='$color_id', type_id='$type_id' WHERE pt_type_color_id='$id'");
    }

    public function deleteColor($id){
        return DB::delete("DELETE FROM colors WHERE color_id='$id'");
    }

    public function deleteType($id){
        return DB::delete("DELETE FROM types WHERE type_id='$id'");
    }

    public function deleteSize($id){
        return DB::delete("DELETE FROM plain_tee_sizes WHERE plain_tee_size_id='$id'");
    }

    public function deleteTypeColor($id){
        return DB::delete("DELETE FROM plain_tee_type_colors WHERE pt_type_color_id='$id'");
    }

}

?>
