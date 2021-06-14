<?php


namespace App\Models;
use Illuminate\Support\Facades\DB;


class RoleModel
{
    public $name;

    public function getAllRoles(){
        return DB::table("role")
                ->select("*")
                ->get();
    }

    public function insertRole(){
        return DB::table("role")
            ->insertGetId([
                "name" => $this->name
            ]);
    }

    public function getOneRole($id){
        return DB::table("role")
            ->where("id", "=", $id)
            ->first();
    }

    public function updateRole($id){
        return DB::table("role")
            ->where("id", "=", $id)
            ->update([
                "name" => $this->name
            ]);
    }

    public function deleteRole($id){
        return DB::table("role")
            ->delete($id);
    }
}
