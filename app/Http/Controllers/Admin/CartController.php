<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CartModel;
use App\Models\CustomerModel;
use App\Models\ProductModel;
use Illuminate\Http\Request;
use MongoDB\Driver\Exception\ExecutionTimeoutException;

class CartController extends Controller
{
    private $model;
    private $data;

    public function __construct()
    {
        $this->model = new CartModel();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->data['orders'] = $this->model->getAllOrders();
        $this->data['order_details'] = $this->model->getAllOrderDetails();

        return view("admin.pages.orders", $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->data['form'] = 'insert';
        $customerModel = new CustomerModel();
        $this->data['customers'] = $customerModel->getAllCustomers();
        $this->data['products'] = $this->model->getAllProducts();

        return view("admin.pages.orders", $this->data);
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
            "ddlProducts" => "required",
            "idCustomer" => "required"

        ];

        $messages = [
            "ddlProducts.required" => "You must select at least one product.",
            "idCustomer.required" => "The customer field is required."
        ];

        $validator = \Validator::make($request->all(), $rules, $messages);
        $validator->validate();

        $idCustomer = $request->get("idCustomer");
        //dd($idCustomer);

        $productsArray = $request->get("ddlProducts");
        //dd($productsArray);

        \DB::beginTransaction();
        try {
            $idOrder = $this->model->insertOrders($idCustomer);
            foreach ($productsArray as $product){
                $exp = explode("->", $product);
                $productName = $exp[0];
                $productPrice = $exp[1];
                $this->model->insertOrderDetails($productName, $productPrice, $idOrder);
            }
            \DB::commit();
            return redirect()->back()->with("message", "You have successfully ordered the products.");
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
        $this->data['statuses'] = $this->model->getAllStatuses();
        $this->data['order'] = $this->model->getOneOrder($id);
        //$this->data['order_details'] = $this->model->getOrderDetails($id);
        $this->data['form'] = 'edit';
        $customerModel = new CustomerModel();
        $this->data['customers'] = $customerModel->getAllCustomers();
        $this->data['products'] = $this->model->getAllProducts();

        return view("admin.pages.orders", $this->data);
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
            "ddlProducts" => "required",
            "idCustomer" => "required"
        ];

        $messages = [
            "ddlProducts.required" => "You must select at least one product.",
            "idCustomer.required" => "The customer field is required."
        ];

        $validator = \Validator::make($request->all(), $rules, $messages);
        $validator->validate();

        $products = $request->get("ddlProducts");
        //dd($products);

        $this->model->idStatus = $request->get("idStatus");
        $this->model->idCustomer = $request->get("idCustomer");

        $idOrderDetails = $request->get("hidden");
        //dd($idOrderDetails);
        $orderProducts = array_combine($idOrderDetails, $products);

        \DB::beginTransaction();
        try{
            foreach ($orderProducts as $ids => $product){
                $exp = explode("->", $product);
                $productName = $exp[0];
                //dd($productName);
                $productPrice = $exp[1];
                //dd($productPrice);
                $this->model->updateOrderDetails($productName, $productPrice, $ids, $id);
            }
            $this->model->updateOrder($id);
            \DB::commit();
            return redirect(route("orders-index"))->with("message", "Order successfully edited!");
        }
        catch (\Exception $ex){
            \Log::error($ex->getMessage());
            \DB::rollBack();
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
        \DB::beginTransaction();
        try {
            $this->model->deleteOrderDetails($id);
            $this->model->deleteOrder($id);
            \DB::commit();
            return redirect(route('orders-index'))->with("message", "Order successfully deleted!");
        }
        catch (\Exception $ex){
            \Log::error($ex->getMessage());
            \DB::rollBack();
            return redirect(route('orders-index'))->with("message", "An server error has occurred, please try again later!");
        }
    }
}
