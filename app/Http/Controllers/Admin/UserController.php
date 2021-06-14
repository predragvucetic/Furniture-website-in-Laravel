<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\RoleModel;
use App\Models\UserModel;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private $data;
    private $model;

    public function __construct()
    {
        $this->model = new UserModel();
    }

    public function index(){
        $this->data['users'] = $this->model->getAllUsers();
        return view("admin.pages.users", $this->data);
    }

    public function create(){
        $this->data['form'] = 'insert';
        $roleModel = new RoleModel();
        $this->data['roles'] = $roleModel->getAllRoles();

        return view("admin.pages.users", $this->data);
    }

    public function store(Request $request){
        $rules = [
            "firstName" => "required|alpha|min:3|max:20",
            "lastName" => "required|alpha|min:4|max:30",
            "username" => [ "required", "unique:user,username", "regex:/^[\S]{6,20}$/" ],
            "email" => "required|unique:user,email|max:50|email",
            "password" => [ "required", "regex:/^[\S]{6,32}$/" ],
            "idRole" => "required"
        ];

        $messages = [
            "firstName.min" => "Minimum length for first name is 3 characters",
            "firstName.max" => "Maximum length for first name is 20 characters",
            "lastName.min" => "Minimum length for last name is 4 characters",
            "lastName.max" => "Maximum length for last name is 30 characters",
            "username.regex" => "Username cannot have whitespace characters and must have more than 6 characters",
            "email.max" => "Maximum length for email is 50 characters",
            "password.regex" => "Password cannot have whitespace characters and must have more than 6 characters"
        ];

        $validator = \Validator::make($request->all(), $rules, $messages);
        $validator->validate();

        $this->model->firstName = $request->get("firstName");
        $this->model->lastName = $request->get("lastName");
        $this->model->username = $request->get("username");
        $this->model->email = $request->get("email");
        $this->model->password = $request->get("password");
        $this->model->idRole = $request->get("idRole");

        try{
            $this->model->insertUser();
            return redirect(route("users-index"))->with("message", "User successfully added!");
        }
        catch (\Exception $ex){
            \Log::error($ex->getMessage());
            return redirect()->back()->with("message", "An server error has occurred, please try again later!");
        }
    }

    public function show($id){
        $this->data['user'] = $this->model->getOneUser($id);
        $this->data['form'] = 'edit';

        $roleModel = new RoleModel();
        $this->data['roles'] = $roleModel->getAllRoles();

        return view("admin.pages.users", $this->data);
    }

    public function update(Request $request, $id){
        $rules = [
            "firstName" => "required|alpha|min:3|max:20",
            "lastName" => "required|alpha|min:4|max:30",
            "username" => [ "required", "regex:/^[\S]{6,20}$/" ],
            "email" => "required|max:50|email",
            "password" => [ "required", "regex:/^[\S]{6,32}$/" ],
            "idRole" => "required"
        ];

        $messages = [
            "firstName.min" => "Minimum length for first name is 3 characters",
            "firstName.max" => "Maximum length for first name is 20 characters",
            "lastName.min" => "Minimum length for last name is 4 characters",
            "lastName.max" => "Maximum length for last name is 30 characters",
            "username.regex" => "Username cannot have whitespace characters and must have more than 6 characters",
            "email.max" => "Maximum length for email is 50 characters",
            "password.regex" => "Password cannot have whitespace characters and must have more than 6 characters"
        ];

        $validator = \Validator::make($request->all(), $rules, $messages);
        $validator->validate();

        $this->model->firstName = $request->get("firstName");
        $this->model->lastName = $request->get("lastName");
        $this->model->username = $request->get("username");
        $this->model->email = $request->get("email");
        $this->model->password = $request->get("password");
        $this->model->idRole = $request->get("idRole");

        try{
            $this->model->updateUser($id);
            return redirect(route("users-index"))->with("message", "User successfully edited!");
        }
        catch (\Exception $ex){
            \Log::error($ex->getMessage());
            return redirect()->back()->with("message", "An server error has occurred, please try again later!");
        }
    }

    public function destroy($id){
        try {
            $this->model->deleteUser($id);
            return redirect(route('users-index'))->with("message", "User successfully deleted!");
        }
        catch (\Exception $ex){
            \Log::error($ex->getMessage());
            return redirect(route('users.index'))->with("message", "An server error has occurred, please try again later!");
        }
    }
}
