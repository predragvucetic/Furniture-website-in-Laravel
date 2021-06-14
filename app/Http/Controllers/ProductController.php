<?php

namespace App\Http\Controllers;

use App\Models\ImageModel;
use App\Models\ProductModel;
use Illuminate\Http\Request;


class ProductController extends Controller
{
    private $model;
    private $data;

    public function __construct()
    {
        $this->model = new ProductModel();
        //dd($this->model);
        $this->data['collections'] = $this->model->getAllCollections();
        $this->data['categories'] = $this->model->getAllCategories();
        $this->data['products'] = $this->model->getAllProducts();
        $this->data['sale'] = $this->model->getAllProductsOnSale();
    }

    public function getAllProducts($param = null){
        //dd($param2);

        if(($param == "Madera") || ($param == "Corso")){
            $this->data['products'] = $this->model->getByIdCollection($param);

            return view("pages.products", $this->data);
        }
        if(($param == "Living room") || ($param == "Dining room") || ($param == "Bedroom") || ($param == "Children's room") || ($param == "Bathroom")){
            $this->data['products'] = $this->model->getByIdCategory($param);

            return view("pages.products", $this->data);
        }
        if(is_numeric($param)){
            $this->data['product'] = $this->model->single($param);
            $imageModel = new ImageModel();
            $this->data['images'] = $imageModel->getImageByIdProduct($param);

            \Blade::setEchoFormat('nl2br(e(%s))');

            return view("pages.single-product", $this->data);
        }

        return view("pages.products", $this->data);
    }

    public function getByIdCollectionAndIdCategory($collection = null, $category = null){
        $this->data['products'] = $this->model->getByIdCollectionAndIdCategory($collection, $category);
        return view("pages.products", $this->data);
    }

    public function getAllProductsOnSale($param = null){
        //dd($param);

        if(($param == "Madera") || ($param == "Corso")){
            $this->data['sale'] = $this->model->getSaleProductsByIdCollection($param);

            return view("pages.sale", $this->data);
        }
        if(($param == "Living room") || ($param == "Dining room") || ($param == "Bedroom") || ($param == "Children's room") || ($param == "Bathroom")){
            $this->data['sale'] = $this->model->getSaleProductsByIdCategory($param);

            return view("pages.sale", $this->data);
        }

        //$this->data['sale'] = $this->model->getAllProductsOnSale();

        return view("pages.sale", $this->data);
    }

    public function getSaleProductsByIdCollectionAndIdCategory($collection = null, $category = null){
        $this->data['sale'] = $this->model->getSaleProductsByIdCollectionAndIdCategory($collection, $category);

        return view("pages.sale", $this->data);
    }

    public function searchProducts(Request $request){
        $keyword = $request->get("search-product");
        $this->data['products'] = $this->model->searchProducts($keyword);

        return view("pages.products", $this->data);
    }

    public function searchProductsOnSale(Request $request){
        $keyword = $request->get("search-sale-product");
        $this->data['sale'] = $this->model->searchProductsOnSale($keyword);

        return view("pages.sale", $this->data);
    }
}
