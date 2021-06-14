<?php


namespace App\Models;
use Illuminate\Support\Facades\DB;

class UserModel
{
    public $firstName;
    public $lastName;
    public $username;
    public $email;
    public $password;
    public $idRole;

    public function getByEmailAndPassword(){
        return DB::table("user AS u")
                ->join("role AS r", "u.idRole", "=", "r.id")
                ->where([
                    ["email", "=", $this->email],
                    ["password", "=", md5($this->password)]
                ])
                ->select("u.*", "r.name")
                ->get()
                ->first();
    }

    public function insertUser(){
        return DB::table("user")
            ->insertGetId([
                "firstName" => $this->firstName,
                "lastName" => $this->lastName,
                "username" => $this->username,
                "email" => $this->email,
                "password" => md5($this->password),
                "idRole" => $this->idRole
            ]);
    }

    public function getAllUsers(){
        return DB::table("user AS u")
                ->join("role AS r", "r.id", "=", "u.idRole")
                ->select("u.*", "r.name")
                ->get();
    }

    public function getOneUser($id){
        return DB::table("user AS u")
                ->select("*")
                ->where("id", "=", $id)
                ->first();
    }

    public function updateUser($id){
        return DB::table("user AS u")
                ->where("id", "=", $id)
                ->update([
                    "firstName" => $this->firstName,
                    "lastName" => $this->lastName,
                    "username" => $this->username,
                    "email" => $this->email,
                    "password" => md5($this->password),
                    "idRole" => $this->idRole
                ]);
    }

    public function deleteUser($id){
        return DB::table("user")
                ->delete($id);
    }

}
