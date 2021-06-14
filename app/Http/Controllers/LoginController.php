<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\UserModel;
use Doctrine\DBAL\Query\QueryException;
use Illuminate\Http\Request;


class LoginController extends Controller
{
    //private $data;
    private $model;

    public function __construct()
    {
        $this->model = new UserModel();
    }

    public function login(){
        return view("pages.login");
    }

    public function doLogin(LoginRequest $request){
        $this->model->email = $request->get("email");
        $this->model->password = $request->get("password");

        $user = $this->model->getByEmailAndPassword();

        if($user){
            $request->session()->put("user", $user);
            return $user->name == "admin" ? redirect(route("users-index")) : redirect("/products")->with("message", "You are logged in");
        }
        else{
            return redirect("/login")->with("message", "You are not sign up");
        }
    }

    public function register(){
        return view("pages.registration");
    }

    public function doRegister(RegisterRequest $request){
        //dd($request->all());
        $this->model->firstName = $request->get("firstName");
        $this->model->lastName = $request->get("lastName");
        $this->model->username = $request->get("username");
        $this->model->email = $request->get("email");
        $this->model->password = $request->get("password");
        $this->model->idRole = 2;

        try{
            $this->model->insertUser();
            return redirect("/login")->with("message", "Registration successful");
        }
        catch(QueryException $ex){
            \Log::error($ex->getMessage());
            return redirect()->back()->with("message", "An server error has occurred, please try again later.");
        }
    }

    public function logout(Request $request){
        $request->session()->forget(["user", "cart"]);
        $request->session()->flush();
        return redirect("/login")->with("message", "You are logged out");
    }
}
