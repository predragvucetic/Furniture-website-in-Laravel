<?php


namespace App\Models;

use Illuminate\Support\Facades\DB;

class CustomerModel
{
    public $firstName;
    public $lastName;
    public $email;
    public $address;
    public $city;
    public $postcode;
    public $country;

    public function getAllCustomers(){
        return DB::table("customer")
                ->select("*")
                ->get();
    }

    public function insertCustomer(){
        return DB::table("customer")
                ->insertGetId([
                    "firstName" => $this->firstName,
                    "lastName" => $this->lastName,
                    "email" => $this->email,
                    "address" => $this->address,
                    "city" => $this->city,
                    "postcode" => $this->postcode,
                    "country" => $this->country,
                ]);
    }

    public function getOneCustomer($id){
        return DB::table("customer")
                ->select("*")
                ->where("id", "=", $id)
                ->first();
    }

    public function updateCustomer($id){
        return DB::table("customer")
            ->where("id", "=", $id)
            ->update([
                "firstName" => $this->firstName,
                "lastName" => $this->lastName,
                "email" => $this->email,
                "address" => $this->address,
                "city" => $this->city,
                "postcode" => $this->postcode,
                "country" => $this->country
            ]);
    }

    public function deleteCustomer($id){
        return DB::table("customer")
                ->delete($id);
    }
}
