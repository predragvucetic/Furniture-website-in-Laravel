<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMail;

class ContactController extends Controller
{
    private $data;

    public function index(){
        return view("pages.contact");
    }

    public function sendEmail(ContactRequest $request){
        $firstName = $request->get("firstName");
        $lastName = $request->get("lastName");
        $email = $request->get("email");
        $message = $request->get("message");

        $data = array(
            'firstName' => $firstName,
            'lastName' => $lastName,
            'email' => $email,
            'message' => $message
        );

        /*$this->data = [
            "firstName" => $firstName,
            "lastName" => $lastName,
            "email" => $email,
            "message" => $message
        ];*/

        //dd($this->data["email"]);

        try{
            Mail::to(env("MAIL_USERNAME"))->send(new SendMail($data));

            return back()->with("success", "Thanks for contacting us!");

            /*Mail::send("email", [
                "data" => $this->data
            ],
                function($message){
                    $message->from($this->data["email"]);
                    $message->to("predrag.vucetic994@gmail.com")->subject("New Customer Enquiry");
                });

            return back()->with("success", "Thanks for contacting us!");*/
        }
        catch(\Exception $ex){
            \Log::error($ex->getMessage());
            return redirect()->back()->with("message", "An server error has occurred, please try again later!");
        }

    }
}
