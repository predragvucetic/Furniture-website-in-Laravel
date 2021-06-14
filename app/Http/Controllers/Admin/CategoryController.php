<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryModel;
use App\Models\ProductModel;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    private $model;
    private $data;

    public function __construct()
    {
        $this->model = new CategoryModel();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['categories'] = $this->model->getAllCategories();

        return view("admin.pages.categories", $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['form'] = 'insert';
        $productModel = new ProductModel();
        $this->data['collections'] = $productModel->getAllCollections();

        return view("admin.pages.categories", $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    /*public function store(Request $request)
    {
        $rules = [
            "name" => "required|string|min:2|max:30",
            "idCollection" => "required"
        ];

        $messages = [
            "name.min" => "Minimum length for category name is 2 characters",
            "name.max" => "Maximum length for category name is 30 characters"
        ];

        $validator = \Validator::make($request->all(), $rules, $messages);
        $validator->validate();

        $this->model->name = $request->get("name");

        $idCollection = $request->get("idCollection");

        \DB::beginTransaction();
        try {
            $idCategory = $this->model->insertCategory();
            $this->model->insertCategoryCollection($idCategory, $idCollection);
            \DB::commit();
            return redirect()->back()->with("message", "Category successfully added!");
        }
        catch (\Exception $ex){
            \Log::error($ex->getMessage());
            \DB::rollBack();
            return redirect()->back()->with("message", "An server error has occurred, please try again later!");
        }
    }*/

    public function store(Request $request)
    {
        $rules = [
            "name" => "required|string|min:2|max:30",
            //"idCollection" => "required"
        ];

        $messages = [
            "name.min" => "Minimum length for category name is 2 characters",
            "name.max" => "Maximum length for category name is 30 characters"
        ];

        $validator = \Validator::make($request->all(), $rules, $messages);
        $validator->validate();

        $this->model->name = $request->get("name");

        $idCollection = $request->get("idCollection");

        \DB::beginTransaction();
        try {
            $idCategory = $this->model->insertCategory();
            if($request->has("idCollection")){
                $this->model->insertCategoryCollection($idCategory, $idCollection);
            }
            \DB::commit();
            return redirect()->back()->with("message", "Category successfully added!");
        }
        catch (\Exception $ex){
            \Log::error($ex->getMessage());
            \DB::rollBack();
            return redirect()->back()->with("message", "An server error has occurred, please try again later!");
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
        $this->data['category'] = $this->model->getOneCategory($id);
        $this->data['form'] = 'edit';

        $productModel = new ProductModel();
        $this->data['collections'] = $productModel->getAllCollections();

        return view("admin.pages.categories", $this->data);
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
    public function update(Request $request, $id)
    {
        $rules = [
            "name" => "required|alpha|min:2|max:30",
            "idCollection" => "required"
        ];

        $messages = [
            "name.min" => "Minimum length for category name is 2 characters",
            "name.max" => "Maximum length for category name is 30 characters"
        ];

        $validator = \Validator::make($request->all(), $rules, $messages);
        $validator->validate();

        $this->model->name = $request->get("name");

        $idCollection = $request->get("idCollection");

        \DB::beginTransaction();
        try{
            $this->model->updateCategory($id);
            $this->model->updateCategoryCollection($id, $idCollection);
            \DB::commit();
            return redirect(route("categories-index"))->with("message", "Category successfully edited!");
        }
        catch (\Exception $ex){
            \Log::error($ex->getMessage());
            \DB::rollBack();
            return redirect(route("categories-index"))->with("message", "An server error has occurred, please try again later!");
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
        \DB::beginTransaction();
        try {
            $this->model->deleteCategoryCollection($id);
            $this->model->deleteCategory($id);
            \DB::commit();
            return redirect(route('categories-index'))->with("message", "Category successfully deleted!");
        }
        catch (\Exception $ex){
            \Log::error($ex->getMessage());
            \DB::rollBack();
            return redirect(route('categories-index'))->with("message", "An server error has occurred, please try again later!");
        }
    }
}
