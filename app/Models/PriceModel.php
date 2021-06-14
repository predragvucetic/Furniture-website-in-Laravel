<?php


namespace App\Models;


use App\Http\Requests\ProductRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PriceModel
{

    public $price;
    public $newPrice;

    public function insertPrice($idProduct){
        return DB::table("price")
            ->insertGetId([
                "price" => $this->price,
                "newPrice" => $this->newPrice,
                "date" => Carbon::now(),
                "idProduct" => $idProduct
            ]);
    }

    public function updatePrice($id){
        return DB::table("price")
            ->where("idProduct", "=", $id)
            ->update([
                "price" => $this->price,
                "newPrice" => $this->newPrice,
                "date" => Carbon::now(),
                "idProduct" => $id
            ]);
    }

    public function deletePrice($id){
        return DB::table("price")
            ->where("idProduct", "=", $id)
            ->delete();
    }

}
