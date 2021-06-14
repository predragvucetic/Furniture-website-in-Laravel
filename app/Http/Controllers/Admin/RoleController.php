<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RoleModel;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    private $data;
    private $model;

    public function __construct()
    {
        $this->model = new RoleModel();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['roles'] = $this->model->getAllRoles();

        return view("admin.pages.roles", $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['form'] = 'insert';

        return view("admin.pages.roles", $this->data);
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
            "name" => "required|string|min:2|max:15"
        ];

        $messages = [
            "name.min" => "Minimum length for role name is 2 characters",
            "name.max" => "Maximum length for role name is 15 characters"
        ];

        $validator = \Validator::make($request->all(), $rules, $messages);
        $validator->validate();

        $this->model->name = $request->get("name");

        try {
            $this->model->insertRole();
            return redirect()->back()->with("message", "Role successfully added!");
        }
        catch (\Exception $ex){
            \Log::error($ex->getMessage());
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
        $this->data['role'] = $this->model->getOneRole($id);
        $this->data['form'] = 'edit';

        return view("admin.pages.roles", $this->data);
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
            "name" => "required|string|min:2|max:15"
        ];

        $messages = [
            "name.min" => "Minimum length for role name is 2 characters",
            "name.max" => "Maximum length for role name is 15 characters"
        ];

        $validator = \Validator::make($request->all(), $rules, $messages);
        $validator->validate();

        $this->model->name = $request->get("name");

        try {
            $this->model->updateRole($id);
            return redirect(route("roles-index"))->with("message", "Role successfully edited!");
        }
        catch (\Exception $ex){
            \Log::error($ex->getMessage());
            return redirect()->back()->with("message", "An server error has occurred, please try again later!");
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
        try {
            $this->model->deleteRole($id);
            return redirect(route('roles-index'))->with("message", "Role successfully deleted!");
        }
        catch (\Exception $ex){
            \Log::error($ex->getMessage());
            return redirect(route('roles-index'))->with("message", "An server error has occurred, please try again later!");
        }
    }
}
