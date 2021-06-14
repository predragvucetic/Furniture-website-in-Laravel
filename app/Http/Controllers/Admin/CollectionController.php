<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CategoryModel;
use App\Models\CollectionModel;
use App\Models\ProductModel;
use Illuminate\Http\Request;

class CollectionController extends Controller
{
    private $model;
    private $data;

    public function __construct()
    {
        $this->model = new CollectionModel();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['collections'] = $this->model->getAllCollections();

        return view("admin.pages.collections", $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['form'] = 'insert';
        $categoryModel = new CategoryModel();
        $this->data['categories'] = $categoryModel->getAllCategories();

        return view("admin.pages.collections", $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            "name" => "required|string|min:2|max:30",
            //"idCategory" => "required"
        ];

        $messages = [
            "name.min" => "Minimum length for collection name is 2 characters",
            "name.max" => "Maximum length for collection name is 30 characters"
        ];

        $validator = \Validator::make($request->all(), $rules, $messages);
        $validator->validate();

        $this->model->name = $request->get("name");

        $idCategory = $request->get("idCategory");

        \DB::beginTransaction();
        try {
            $idCollection = $this->model->insertCollection();
            if($request->has("idCategory")){
                $this->model->insertCategoryCollection($idCategory, $idCollection);
            }
            \DB::commit();
            return redirect()->back()->with("message", "Collection successfully added!");
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
        $this->data['collection'] = $this->model->getOneCollection($id);
        $this->data['form'] = 'edit';

        $categoryModel = new CategoryModel();
        $this->data['categories'] = $categoryModel->getAllCategories();

        return view("admin.pages.collections", $this->data);
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
            "idCategory" => "required"
        ];

        $messages = [
            "name.min" => "Minimum length for category name is 2 characters",
            "name.max" => "Maximum length for category name is 30 characters"
        ];

        $validator = \Validator::make($request->all(), $rules, $messages);
        $validator->validate();

        $this->model->name = $request->get("name");

        $idCategory = $request->get("idCategory");

        \DB::beginTransaction();
        try{
            $this->model->updateCollection($id);
            $this->model->updateCategoryCollection($idCategory, $id);
            \DB::commit();
            return redirect(route("collections-index"))->with("message", "Collection successfully edited!");
        }
        catch (\Exception $ex){
            \Log::error($ex->getMessage());
            \DB::rollBack();
            return redirect(route("collections-index"))->with("message", "An server error has occurred, please try again later!");
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
            $this->model->deleteCollection($id);
            \DB::commit();
            return redirect(route('collections-index'))->with("message", "Collection successfully deleted!");
        }
        catch (\Exception $ex){
            \Log::error($ex->getMessage());
            \DB::rollBack();
            return redirect(route('collections-index'))->with("message", "An server error has occurred, please try again later!");
        }
    }
}
