<?php


namespace App\Models;
use Illuminate\Support\Facades\DB;

class ProductModel
{
    public function getAllCollections(){
        return DB::table("collection")
                ->select("*")
                ->get();
    }

    public function getAllCategories(){
        $categories = DB::table("category")
            ->select("*")
            ->get();

        return $categories;
    }

    public function getAllProducts(){
        $products = DB::table("product AS p")
            ->join("photo AS ph", "p.id", "=", "ph.idProduct")
            ->join("price AS pr", "p.id", "=", "pr.idProduct")
            ->whereNull("ph.idParent")
            ->select("p.name", "p.description", "p.id AS idProduct", "ph.url", "pr.price", "pr.newPrice")
            ->paginate(15);

        return $products;
    }

    public function getByIdCollection($param){
        return DB::table("product AS p")
            ->join("photo AS ph", "p.id", "=", "ph.idProduct")
            ->join("price AS pr", "p.id", "=", "pr.idProduct")
            ->join("category_collection AS cc", "p.idCategoryCollection", "=", "cc.id")
            ->join("collection AS c", "c.id", "=", "cc.idCollection")
            ->whereNull("ph.idParent")
            ->where("c.name", "=", $param)
            ->select("p.name", "p.id AS idProduct", "ph.url", "pr.price", "cc.id", "pr.newPrice")
            ->paginate(15);
    }

    public function getByIdCategory($param){
        return DB::table("product AS p")
            ->join("photo AS ph", "p.id", "=", "ph.idProduct")
            ->join("price AS pr", "p.id", "=", "pr.idProduct")
            ->join("category_collection AS cc", "p.idCategoryCollection", "=", "cc.id")
            ->join("category AS c", "c.id", "=", "cc.idCategory")
            ->whereNull("ph.idParent")
            ->where("c.name", "=", $param)
            ->select("p.name", "p.id AS idProduct", "ph.url", "pr.price", "cc.id", "pr.newPrice")
            ->paginate(15);
    }

    // OVO
    public function getByIdCollectionAndIdCategory($collection, $category){
        return DB::table("product AS p")
            ->join("photo AS ph", "p.id", "=", "ph.idProduct")
            ->join("price AS pr", "p.id", "=", "pr.idProduct")
            ->join("category_collection AS cc", "p.idCategoryCollection", "=", "cc.id")
            ->join("category AS c", "c.id", "=", "cc.idCategory")
            ->join("collection AS col", "col.id", "=", "cc.idCollection")
            ->whereNull("ph.idParent")
            ->where([
                ["col.name", "=", $collection],
                ["c.name", "=", $category]
            ])
            ->select("p.name", "p.id AS idProduct", "ph.url", "pr.price", "cc.id", "pr.newPrice")
            ->paginate(15);
    }

    public function getAllProductsOnSale(){
        return DB::table("product AS p")
            ->join("photo AS ph", "p.id", "=", "ph.idProduct")
            ->join("price AS pr", "p.id", "=", "pr.idProduct")
            ->whereNull("ph.idParent")
            ->whereNotNull("pr.newPrice")
            ->select("p.name", "p.id AS idProduct", "ph.url", "pr.price", "pr.newPrice")
            ->paginate(15);
    }

    public function getSaleProductsByIdCollection($param){
        return DB::table("product AS p")
            ->join("photo AS ph", "p.id", "=", "ph.idProduct")
            ->join("price AS pr", "p.id", "=", "pr.idProduct")
            ->join("category_collection AS cc", "p.idCategoryCollection", "=", "cc.id")
            ->join("collection AS c", "c.id", "=", "cc.idCollection")
            ->whereNull("ph.idParent")
            ->whereNotNull("pr.newPrice")
            ->where("c.name", "=", $param)
            ->select("p.name", "p.id AS idProduct", "ph.url", "pr.price", "cc.id", "pr.newPrice")
            ->paginate(15);
    }

    public function getSaleProductsByIdCategory($param){
        return DB::table("product AS p")
            ->join("photo AS ph", "p.id", "=", "ph.idProduct")
            ->join("price AS pr", "p.id", "=", "pr.idProduct")
            ->join("category_collection AS cc", "p.idCategoryCollection", "=", "cc.id")
            ->join("category AS c", "c.id", "=", "cc.idCategory")
            ->whereNull("ph.idParent")
            ->whereNotNull("pr.newPrice")
            ->where("c.name", "=", $param)
            ->select("p.name", "p.id AS idProduct", "ph.url", "pr.price", "cc.id", "pr.newPrice")
            ->paginate(15);
    }

    public function getSaleProductsByIdCollectionAndIdCategory($collection, $category){
        return DB::table("product AS p")
            ->join("photo AS ph", "p.id", "=", "ph.idProduct")
            ->join("price AS pr", "p.id", "=", "pr.idProduct")
            ->join("category_collection AS cc", "p.idCategoryCollection", "=", "cc.id")
            ->join("category AS c", "c.id", "=", "cc.idCategory")
            ->join("collection AS col", "col.id", "=", "cc.idCollection")
            ->whereNull("ph.idParent")
            ->whereNotNull("pr.newPrice")
            ->where([
                ["col.name", "=", $collection],
                ["c.name", "=", $category]
            ])
            ->select("p.name", "p.id AS idProduct", "ph.url", "pr.price", "cc.id", "pr.newPrice")
            ->paginate(15);
    }

    public function searchProducts($keyword){
        $products = DB::table("product AS p")
            ->join("photo AS ph", "p.id", "=", "ph.idProduct")
            ->join("price AS pr", "p.id", "=", "pr.idProduct")
            ->whereNull("ph.idParent")
            ->where("p.name", "like", "%" . $keyword . "%")
            ->select("p.name", "p.id AS idProduct", "ph.url", "pr.price", "pr.newPrice")
            ->paginate(15);

        return $products->appends(['search-product' => $keyword]);
    }

    public function searchProductsAdmin($keyword){
        $products = DB::table("product AS p")
            ->join("photo AS ph", "p.id", "=", "ph.idProduct")
            ->join("price AS pr", "p.id", "=", "pr.idProduct")
            ->join("category_collection AS cc", "cc.id", "=", "p.idCategoryCollection")
            ->join("collection AS col", "col.id", "=", "cc.idCollection")
            ->join("category AS c", "c.id", "=", "cc.idCategory")
            ->whereNull("ph.idParent")
            ->where("p.name", "like", "%" . $keyword . "%")
            ->select("p.name", "p.id", "p.description", "ph.url", "pr.price", "pr.newPrice", "col.id AS idCollection", "col.name AS collectionName", "c.id AS idCategory", "c.name as categoryName")
            ->paginate(15);

        return $products->appends(['search-product' => $keyword]);
    }

    public function searchProductsOnSale($keyword){
        $products = DB::table("product AS p")
            ->join("photo AS ph", "p.id", "=", "ph.idProduct")
            ->join("price AS pr", "p.id", "=", "pr.idProduct")
            ->whereNull("ph.idParent")
            ->whereNotNull("pr.newPrice")
            ->where("p.name", "like", "%" . $keyword . "%")
            ->select("p.name", "p.id AS idProduct", "ph.url", "pr.price", "pr.newPrice")
            ->paginate(15);

        return $products->appends(['search-sale-product' => $keyword]);
    }

    public function single($id){
        return DB::table("product AS p")
            ->join("photo AS ph", "p.id", "=", "ph.idProduct")
            ->join("price AS pr", "p.id", "=", "pr.idProduct")
            ->join("category_collection AS cc", "p.idCategoryCollection", "=", "cc.id")
            ->join("category AS c", "cc.idCategory", "=", "c.id")
            ->join("collection AS col", "cc.idCollection", "=", "col.id")
            ->where("p.id", "=", $id)
            ->select("p.name", "p.id", "ph.url", "pr.price", "pr.newPrice", "p.description", "p.dimensions", "cc.id AS idCategoryCollection", "col.name AS collectionName", "c.name AS categoryName", "col.id AS idCollection", "c.id AS idCategory")
            ->get()
            ->first();
    }

    public function getAllProductsAdmin(){
        $products = DB::table("product AS p")
            ->join("photo AS ph", "p.id", "=", "ph.idProduct")
            ->join("price AS pr", "p.id", "=", "pr.idProduct")
            ->join("category_collection AS cc", "p.idCategoryCollection", "=", "cc.id")
            ->join("category AS c", "cc.idCategory", "=", "c.id")
            ->join("collection AS col", "cc.idCollection", "=", "col.id")
            ->whereNull("ph.idParent")
            ->orderBy("p.id")
            ->select("p.name", "p.description", "p.id", "ph.url", "pr.price", "pr.newPrice", "p.description", "col.name AS collectionName", "c.name AS categoryName", "col.id AS idCollection", "c.id AS idCategory")
            ->paginate(15);

        return $products;
    }

    public function getAllImages(){
        return DB::table("photo")
            ->select("*")
            ->get();
    }

    public function getAllCategoriesAndCollections(){
        return DB::table("category_collection AS cc")
            ->join("category AS c", "c.id", "=", "cc.idCategory")
            ->join("collection AS col", "col.id", "=", "cc.idCollection")
            ->select("cc.id", "col.name AS collectionName", "c.name AS categoryName")
            ->get();
    }

    public $name;
    public $description;
    public $size;
    public $idUser;
    public $idCategoryCollection;

    public function insertProduct(){
        $product = DB::table("product")
            ->insertGetId([
                "name" => $this->name,
                "description" => $this->description,
                "dimensions" => $this->size,
                "idUser" => $this->idUser,
                "idCategoryCollection" => $this->idCategoryCollection
            ]);

        return DB::getPdo()->lastInsertId();
    }

    public function updateProduct($id){
        return DB::table("product")
            ->where("id", "=", $id)
            ->update([
                "name" => $this->name,
                "description" => $this->description,
                "dimensions" => $this->size,
                "idUser" => $this->idUser,
                "idCategoryCollection" => $this->idCategoryCollection
            ]);
    }

    public function deleteProduct($id){
        return DB::table("product")
            ->delete($id);
    }

}
