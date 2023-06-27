<?php 
namespace Controller;

class ProductController extends Controller {
    protected $productManager;
    protected $rateManager;

    function ShowProducts(){
        $products = $this->productManager->getAll();
        $this->compact(["products" => $products]);
        $this->view("products");
    }

    function showProduct($id) {
        $product = $this->productManager->getById($id);

        if(isset($_SESSION["user"])) {
            $rate = $this->rateManager->getCurrentRate($id, $_SESSION["user"]->id);
            
            if($rate) {
                $product->rating = $rate->rating;
            }
        }

        $this->compact(["product" => $product]);
        $this->view("product");
    }

    function addProduct($name, $description, $price) {
        $product = new \stdClass();
        $product->name = $name;
        $product->description = $description;
        $product->price = $price;
        $product->user_id = $_SESSION["user"]->id;
        
        if ($this->productManager->create($product)) {
            $this->compact([
                "success" => "Produit ajouté !"
            ]);

            $this->addProductView();
        }
    }

    function rateProduct($id, $rating) {
        $rate = $this->rateManager->getCurrentRate($id, $_SESSION["user"]->id);

        if ($rate) {
            $rate->rating = $rating;
            if ($this->rateManager->update($rate)) {
                $this->json([
                    "success" => true
                ]);

                exit;
            }
        }

        $rate = new \stdClass();
        $rate->product_id = $id;
        $rate->user_id = $_SESSION["user"]->id;
        $rate->rating = $rating;
        if ($this->rateManager->create($rate)) {
            $this->json([
                "success" => true
            ]);

            exit;
        }

        $this->json([
            "success" => false
        ]);

        exit;
    }

    function addProductView() {
        $this->view("addProduct");
    }
}
