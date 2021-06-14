<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\CartModel;
use Illuminate\Http\Request;

class CartController extends Controller
{
    private $model;
    private $data;

    public function __construct()
    {
        $this->model = new CartModel();

    }

    public function index(){
        return view("pages.cart");
    }

    public function addToCart(Request $request, $id)
    {
        $product = $this->model->addToCart($id);

        if ($product) {

            $request->session()->put("cart", [
                "products" => [
                    $id => $product
                ]
            ]);

            $request->session()->push("products", $product);

            return redirect()->back()->with("message", "Product is added to cart!");
        }
        else {
            return redirect()->back()->with("message", "An server error has occurred, please try again later!");
        }

    }

    public function deleteFromCart($id){
        $products = session()->pull("products");
        //dd($products);
        $key = array_search($id, array_column($products, "id"));
        //dd($key);
        if ($key !== false){
            unset($products[$key]);
        }
        foreach ($products as $product) {
            session()->push("products", $product);
        }

        return redirect()->back();
    }

    public function insertOrders(OrderRequest $request){
        $this->model->firstName = $request->get("firstName");
        $this->model->lastName = $request->get("lastName");
        $this->model->email = $request->get("email");
        $this->model->country = $request->get("country");
        $this->model->city = $request->get("city");
        $this->model->postcode = $request->get("postcode");
        $this->model->address = $request->get("address");

        $products = $request->session()->pull("products");
        //dd($products);

        \DB::beginTransaction();
            try{
                $idCustomer = $this->model->insertCustomers();
                $idOrder = $this->model->insertOrders($idCustomer);
                foreach ($products as $product){
                    if(empty($product->newPrice)) {
                        $price = $product->price;
                        $this->model->insertOrderDetails($product->name, $price, $idOrder);
                    }
                    else{
                        $price = $product->newPrice;
                        $this->model->insertOrderDetails($product->name, $price, $idOrder);
                    }
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
}
