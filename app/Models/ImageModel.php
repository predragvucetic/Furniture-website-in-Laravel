<?php


namespace App\Models;

use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\File\UploadedFile;


class ImageModel
{

    public function getImageByIdProduct($id){
        return DB::table("photo")
                ->where("idProduct", "=", $id)
                ->select("*")
                ->get();
    }

    public function insertImages($image, $idProduct, $idParent = null){
        $image = DB::table("photo")
            ->insertGetId([
                "url" => $image,
                "idProduct" => $idProduct,
                "idParent" => $idParent
            ]);

        return DB::getPdo()->lastInsertId();
    }

    public function updateFirstImage($firstImage, $id, $idFirstImage, $idParent = null){
        return DB::table("photo")
            ->where("id", "=", $idFirstImage)
            ->update([
                "url" => $firstImage,
                "idProduct" => $id,
                "idParent" => $idParent
            ]);
    }

    public function updateImages($image, $id, $ids, $idFirstImage){
        return DB::table("photo")
            ->where("id", "=", $ids)
            ->update([
                "url" => $image,
                "idProduct" => $id,
                "idParent" => $idFirstImage
            ]);
    }

    public function deleteImages($id){
        return DB::table("photo")
            ->where("idProduct", "=", $id)
            ->delete();
    }

    public static function upload(UploadedFile $file){
        $fileName = $file->getClientOriginalName();
        $file->move(\public_path('images/products'), $fileName);

        return $fileName;
    }

}
