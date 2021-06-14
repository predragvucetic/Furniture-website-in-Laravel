<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\ImageModel;
use App\Models\PriceModel;
use App\Models\ProductModel;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private $data;
    private $model;

    public function __construct()
    {
        $this->model = new ProductModel();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['products'] = $this->model->getAllProductsAdmin();
        $this->data['images'] = $this->model->getAllImages();

        return view("admin.pages.products", $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['form'] = 'insert';
        $this->data['category_collection'] = $this->model->getAllCategoriesAndCollections();

        return view("admin.pages.products", $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(ProductRequest $request)
    {
        $this->model->name = $request->get("name");
        $this->model->description = $request->get("description");
        $this->model->size = $request->get("size");
        $this->model->idUser = $request->session()->get("user")->id;
        $this->model->idCategoryCollection = $request->get("category");

        $priceModel = new PriceModel();

        $priceModel->price = $request->get("price");
        $priceModel->newPrice = $request->get("newPrice");

        $imagesArray = $this->upload($request);
        //dd($imagesArray);
        //$idProduct = $this->model->insertProduct();
        //dd($idProduct);

        \DB::beginTransaction();
        try {
            $idProduct = $this->model->insertProduct();
            //dd($idProduct);
            $priceModel->insertPrice($idProduct);
            $this->insertImages($imagesArray, $idProduct, $idParent = null);
            \DB::commit();
            return redirect()->back()->with("message", "You successfully added product!");
        }
        catch (\Exception $ex){
            \Log::error($ex->getMessage());
            \DB::rollBack();
            return redirect()->back()->with("message", "An server error has occurred, please try again later!");
        }
    }

    //OVO
    public function insertImages($imagesArray, $idProduct, $idParent = null){
        $imageModel = new ImageModel();
        //dd($imagesArray);
        $firstImage = head($imagesArray);
        try {
            $idImage = $imageModel->insertImages($firstImage, $idProduct, $idParent);
            $otherImages = array_slice($imagesArray, 1);
            foreach ($otherImages as $image) {
                $imageModel->insertImages($image, $idProduct, $idImage);
            }
        }
        catch (\Exception $ex){
            \Log::error($ex->getMessage());
            \DB::rollBack();
        }
    }

    public function upload(ProductRequest $request){
        if($request->hasFile("images")){
            $imagesArray = [];

            foreach ($request->images as $file){
                $imagesArray[] = ImageModel::upload($file);
                //print_r($fileName);
            }

            return $imagesArray;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $imageModel = new ImageModel();
        $this->data['product'] = $this->model->single($id);
        $this->data['category_collection'] = $this->model->getAllCategoriesAndCollections();
        $this->data['images'] = $imageModel->getImageByIdProduct($id);
        $this->data['form'] = 'edit';

        return view("admin.pages.products", $this->data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        $this->model->name = $request->get("name");
        $this->model->description = $request->get("description");
        $this->model->size = $request->get("size");
        $this->model->idUser = $request->session()->get("user")->id;
        $this->model->idCategoryCollection = $request->get("category");

        $priceModel = new PriceModel();

        $priceModel->price = $request->get("price");
        $priceModel->newPrice = $request->get("newPrice");

        $imagesArray = $this->upload($request);
        $idImages = $request->get("hidden");
        //dd($idImages);

        \DB::beginTransaction();
        try {
            $this->model->updateProduct($id);
            //dd($idProduct);
            $priceModel->updatePrice($id);
            $this->updateImages($imagesArray, $id, $idImages, $idParent = null);
            \DB::commit();
            return redirect()->back()->with("message", "You successfully edited product!");
        }
        catch (\Exception $ex){
            \Log::error($ex->getMessage());
            \DB::rollBack();
            return redirect()->back()->with("message", "An server error has occurred, please try again later!");
        }
    }

    public function updateImages($imagesArray, $id, $idImages, $idParent = null){
        $imageModel = new ImageModel();
        $firstImage = head($imagesArray);
        $idFirstImage = head($idImages);
        //dd($firstImage);
        //dd($idFirstImages);
        try {
            $imageModel->updateFirstImage($firstImage, $id, $idFirstImage, $idParent);
            //dd($idImage);
            $otherImages = array_slice($imagesArray, 1);
            $idOtherImages = array_slice($idImages, 1);
            $images = array_combine($idOtherImages, $otherImages);
            foreach ($images as $ids => $image){
                $imageModel->updateImages($image, $id, $ids, $idFirstImage);
            }
        }
        catch (\Exception $ex){
            \Log::error($ex->getMessage());
            \DB::rollBack();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $imageModel = new ImageModel();
        $priceModel = new PriceModel();

        \DB::beginTransaction();
        try {
            $priceModel->deletePrice($id);
            $imageModel->deleteImages($id);
            $this->model->deleteProduct($id);
            \DB::commit();
            return redirect(route('products-index'))->with("message", "Product successfully deleted!");
        }
        catch (\Exception $ex){
            \Log::error($ex->getMessage());
            \DB::rollBack();
            return redirect()->back()->with("message", "An server error has occurred, please try again later!");
            //return redirect(route('products-index'))->with("message", "An server error has occurred, please try again later!");
        }
    }

    public function searchProductsAdmin(Request $request){
        $keyword = $request->get("search-product");
        $this->data['products'] = $this->model->searchProductsAdmin($keyword);
        $this->data['images'] = $this->model->getAllImages();

        return view("admin.pages.products", $this->data);
    }
}
