<?php


namespace App\Models;
use Illuminate\Support\Facades\DB;

class CollectionModel
{
    public $name;

    public function getAllCollections(){
        return DB::table("collection")
            ->select("*")
            ->get();
    }

    public function insertCollection(){
        $collection = DB::table("collection")
            ->insertGetId([
                "name" => $this->name
            ]);

        return DB::getPdo()->lastInsertId();
    }

    public function insertCategoryCollection($idCategory, $idCollection){
        return DB::table("category_collection")
            ->insertGetId([
                "idCategory" => $idCategory,
                "idCollection" => $idCollection
            ]);
    }

    public function getOneCollection($id){
        return DB::table("collection AS c")
            ->join("category_collection AS cc", "cc.idCollection", "=", "c.id")
            ->select("c.id AS idCollection", "c.name", "cc.*", "cc.id AS idCategoryCollection")
            ->where("c.id", "=", $id)
            ->first();
    }

    public function updateCollection($id){
        return DB::table("collection")
            ->where("id", "=", $id)
            ->update([
                "name" => $this->name
            ]);
    }

    public function updateCategoryCollection($idCategory, $id){
        return DB::table("category_collection")
            ->where("idCollection", "=", $id)
            ->update([
                "idCategory" => $idCategory,
                "idCollection" => $id
            ]);
    }

    public function deleteCollection($id){
        return DB::table("collection")
            ->delete($id);
    }

    public function deleteCategoryCollection($id){
        return DB::table("category_collection")
            ->where("idCollection", "=", $id)
            ->delete();
    }
}
