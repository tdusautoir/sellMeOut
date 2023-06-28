<?php 
namespace Controller;

class CartController extends Controller {
    protected $commandManager;
    protected $commandDetailManager;
    protected $productManager;

    public function showCart() {

        $products = [];
        $total = 0;
        if(isset($_SESSION["cart"])) {
            foreach($_SESSION["cart"] as $product) {
                $id = intval($product["id"]);
                $quantity = intval($product["quantity"]);

                $currentProduct = $this->productManager->getById($id);

                $products[$id] = $currentProduct;
                $products[$id]->quantity = $quantity;

                $total += $currentProduct->price * $quantity;
            };
        } 

        $this->compact([
            "cart" => $products,
            "total" => $total
        ]);

        $this->view("cart");
    }

    public function addToCart($id, $quantity) {
        if(isset($_SESSION["cart"])) {
            $cart = $_SESSION["cart"];
            $cart[] = ["id" => $id, "quantity" => $quantity];
            $_SESSION["cart"] = $cart;
        } else {
            $cart = [];
            $cart[] = ["id" => $id, "quantity" => $quantity];
            $_SESSION["cart"] = $cart;
        }
        
        create_flash_message("success", "Votre produit a été correctement ajouté !", FLASH_SUCCESS);
        header("location: /products/" . $id);
        exit;
    }

    public function removeFromCart($id) {
        if(isset($_SESSION["cart"])) {
            $cart = $_SESSION["cart"];
            $newCart = [];

            foreach($cart as $product) {
                if($product["id"] != $id) {
                    $newCart[] = $product;
                } else if($product["quantity"] > 1) {
                    $product["quantity"]--;
                    $newCart[] = $product;
                }
            }
            
            $_SESSION["cart"] = $newCart;
        }

        header("location: /cart");
        exit;
    }

    public function commandCart() {
        if(isset($_SESSION["cart"])) {
            $cart = $_SESSION["cart"];
            $total = 0;
            $products = [];

            foreach($cart as $product) {
                $id = intval($product["id"]);
                $quantity = intval($product["quantity"]);

                $currentProduct = $this->productManager->getById($id);

                $products[$id] = $currentProduct;
                $products[$id]->quantity = $quantity;

                $total += $currentProduct->price * $quantity;
            };

            $command = new \stdClass();
            $command->user_id = $_SESSION["user"]->id;
            $command->total = $total;

            $commandId = intval($this->commandManager->create($command, true));

            foreach($products as $product) {
                $commandDetail = new \stdClass();
                $commandDetail->command_id = $commandId;
                $commandDetail->product_id = $product->id;
                $commandDetail->quantity = $product->quantity;

                $this->commandDetailManager->create($commandDetail);
            }

            unset($_SESSION["cart"]);
        }

        create_flash_message("error", "Votre commande s'est déroulé avec succès.", FLASH_SUCCESS);
        header("location: /");
        exit;
    }
}
