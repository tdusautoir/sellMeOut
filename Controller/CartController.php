<?php 
namespace Controller;

class CartController extends Controller {
    protected $commandManager;
    protected $productManager;

    public function showCart() {

        $products = [];
        if(isset($_SESSION["cart"])) {
            foreach($_SESSION["cart"] as $id) {
                $product = $this->productManager->getById($id);

                if(isset($products[$id])) {
                    $products[$id]->quantity = $products[$id]->quantity + 1;
                } else {
                    $products[$id] = $product;
                    $products[$id]->quantity = 1;
                }
            };
        } 

        $this->compact([
            "products" => $products
        ]);

        $this->view("cart");
    }

    // public function addToCart($id) {
    //     if(isset($_SESSION["cart"])) {
    //         $cart = $_SESSION["cart"];
    //         $cart[] = $id;
    //         $_SESSION["cart"] = $cart;
    //     } else {
    //         $cart = [];
    //         $cart[] = $id;
    //         $_SESSION["cart"] = $cart;
    //     }

    //     header("Location: /");
    // }
}
