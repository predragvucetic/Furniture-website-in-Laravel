<?php


namespace App\Models;
use Illuminate\Support\Facades\DB;


class CategoryModel
{
    public $name;

    public function getAllCategories(){
        return DB::table("category")
                ->select("*")
                ->get();
    }

    public function insertCategory(){
        $category = DB::table("category")
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

    public function getOneCategory($id){
        return DB::table("category AS c")
                ->join("category_collection AS cc", "cc.idCategory", "=", "c.id")
                ->select("c.id AS idCategory", "c.name", "cc.*", "cc.id AS idCategoryCollection")
                ->where("c.id", "=", $id)
                ->first();
    }

    public function updateCategory($id){
        return DB::table("category")
            ->where("id", "=", $id)
            ->update([
                "name" => $this->name
            ]);
    }

    public function updateCategoryCollection($id, $idCollection){
        return DB::table("category_collection")
                ->where("idCategory", "=", $id)
                ->update([
                    "idCategory" => $id,
                    "idCollection" => $idCollection
                ]);
    }

    public function deleteCategory($id){
        return DB::table("category")
                ->delete($id);
    }

    public function deleteCategoryCollection($id){
        return DB::table("category_collection")
                ->where("idCategory", "=", $id)
                ->delete();
    }
}
