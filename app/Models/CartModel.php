<?php


namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CartModel
{
    public $firstName;
    public $lastName;
    public $email;
    public $country;
    public $city;
    public $postcode;
    public $address;

    public function addToCart($id){
        return DB::table("product AS p")
            ->join("photo AS ph", "p.id", "=", "ph.idProduct")
            ->join("price AS pr", "p.id", "=", "pr.idProduct")
            ->whereNull("ph.idParent")
            ->where("p.id", "=", $id)
            ->select("p.name", "p.description", "p.dimensions", "p.id", "ph.url", "pr.price", "pr.newPrice")
            ->get()
            ->first();
    }

    public function insertCustomers(){
        $customer = DB::table("customer")
                ->insertGetId([
                    "firstName" => $this->firstName,
                    "lastName" => $this->lastName,
                    "email" => $this->email,
                    "address" => $this->address,
                    "city" => $this->city,
                    "postcode" => $this->postcode,
                    "country" => $this->country
                ]);
        return DB::getPdo()->lastInsertId();

    }

    public function insertOrders($idCustomer){
        $order = DB::table("orders")
                ->insertGetId([
                    "creationDate" => Carbon::now(),
                    "idStatus" => 1,
                    "idCustomer" => $idCustomer
                ]);
        return DB::getPdo()->lastInsertId();
    }

    public function insertOrderDetails($productName, $productPrice, $idOrder){
        return DB::table("order_details")
                ->insertGetId([
                    "productName" => $productName,
                    "productPrice" => $productPrice,
                    "idOrder" => $idOrder
                ]);
    }

    public function getAllOrders(){
        return DB::table("orders AS o")
            ->join("customer AS c", "c.id", "=", "o.idCustomer")
            ->join("order_status AS os", "os.id", "=", "o.idStatus")
            ->select("o.*", "o.id AS orderId", "c.*", "os.*")
            ->get();
    }

    public function getAllOrderDetails(){
        return DB::table("order_details AS od")
                ->join("orders AS o", "o.id", "od.idOrder")
                ->select("od.productName", "od.productPrice", "od.idOrder")
                ->get();
    }

    public function getAllProducts(){
        return DB::table("product AS p")
            ->join("photo AS ph", "p.id", "=", "ph.idProduct")
            ->join("price AS pr", "p.id", "=", "pr.idProduct")
            ->whereNull("ph.idParent")
            ->select("p.name", "p.description", "p.id", "ph.url", "pr.price", "pr.newPrice")
            ->get();
    }

    public function getOneOrder($id){
        return DB::table("orders AS o")
                ->join("order_details AS od", "od.idOrder", "=", "o.id")
                ->select("o.*", "o.id AS orderId", "od.*", "od.id AS idOrderDetails")
                ->where("o.id", "=", $id)
                ->get();
    }

    /*public function getOrderDetails($id){
        return DB::table("order_details AS od")
                ->join("order AS o", "o.id", "=", "od.idOrder")
                ->select("o.*", "o.id AS orderId", "od.*", "od.id AS idOrderDetails")
                ->where("od.idOrder", "=", $id)
                ->get();
    }*/

    public function getAllStatuses(){
        return DB::table("order_status")
                ->select("*")
                ->get();
    }

    public $idStatus;
    public $idCustomer;

    public function updateOrder($id){
        return DB::table("orders")
                ->where("id", "=", $id)
                ->update([
                    "creationDate" => Carbon::now(),
                    "idStatus" => $this->idStatus,
                    "idCustomer" => $this->idCustomer
                ]);

    }

    public function updateOrderDetails($productName, $productPrice, $ids, $idOrder){
        return DB::table("order_details")
            ->where("id", "=", $ids)
            ->update([
                "productName" => $productName,
                "productPrice" => $productPrice,
                "idOrder" => $idOrder
            ]);
    }

    public function deleteOrderDetails($id){
        return DB::table("order_details")
                ->where("idOrder", "=", $id)
                ->delete();
    }

    public function deleteOrder($id){
        return DB::table("orders")
                ->delete($id);
    }

}
