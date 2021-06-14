<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\OrderRequest;
use App\Models\CustomerModel;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    private $model;
    private $data;

    public function __construct()
    {
        $this->model = new CustomerModel();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['customers'] = $this->model->getAllCustomers();

        return view("admin.pages.customers", $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['form'] = 'insert';

        return view("admin.pages.customers", $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrderRequest $request)
    {
        $this->model->firstName = $request->get("firstName");
        $this->model->lastName = $request->get("lastName");
        $this->model->email = $request->get("email");
        $this->model->address = $request->get("address");
        $this->model->city = $request->get("city");
        $this->model->postcode = $request->get("postcode");
        $this->model->country = $request->get("country");

        try{
            $this->model->insertCustomer();
            return redirect(route("customers-index"))->with("message", "Customer successfully added!");
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
        $this->data['customer'] = $this->model->getOneCustomer($id);
        $this->data['form'] = 'edit';

        return view("admin.pages.customers", $this->data);
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
    public function update(OrderRequest $request, $id)
    {
        $this->model->firstName = $request->get("firstName");
        $this->model->lastName = $request->get("lastName");
        $this->model->email = $request->get("email");
        $this->model->address = $request->get("address");
        $this->model->city = $request->get("city");
        $this->model->postcode = $request->get("postcode");
        $this->model->country = $request->get("country");

        try {
            $this->model->updateCustomer($id);
            return redirect(route("customers-index"))->with("message", "Customer successfully edited!");
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
            $this->model->deleteCustomer($id);
            return redirect(route('customers-index'))->with("message", "Customer successfully deleted!");
        }
        catch (\Exception $ex){
            \Log::error($ex->getMessage());
            return redirect(route('customers-index'))->with("message", "An server error has occurred, please try again later!");
        }
    }
}
