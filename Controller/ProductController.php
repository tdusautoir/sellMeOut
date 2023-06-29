<?php 
namespace Controller;

class ProductController extends Controller {
    protected $productManager;
    protected $rateProductManager;
    protected $userManager;

    function ShowProducts(){
        $products = $this->productManager->getAllPublic();
        $this->compact(["products" => $products]);
        $this->view("products");
    }

    function ShowProductsSeller() {
        $products = $this->productManager->getAllBySeller($_SESSION["user"]->id);
        $this->compact(["products" => $products, "seller" => true]);
        $this->view("products");
    }

    function ShowSearchProducts($search) {
        $products = $this->productManager->getBySearch($search);
        $this->compact(["products" => $products, "search" => true]);
        $this->view("products");
    }
    
    function ShowSearchProductsSeller($search) {
        $products = $this->productManager->getAllBySellerAndSearch($_SESSION["user"]->id, $search);
        $this->compact(["products" => $products, "search" => true, "seller" => true]);
        $this->view("products");
    }

    function showProduct($id) {
        $product = $this->productManager->getByIdWithRatings($id);
        $product->user = $this->userManager->getByIdWithRatings($product->user_id);

        if($product->public == 0 && $product->user_id != $_SESSION["user"]->id) {
            create_flash_message("error", "Vous n'avez pas accès à ce produit", FLASH_ERROR);
            header("Location: /products");
            exit;
        }

        $this->compact(["product" => $product, "seller" => $product->user_id == $_SESSION["user"]->id]);
        $this->view("product");
    }

    function addProduct($name, $description, $price) {
        $product = new \stdClass();
        $product->name = $name;
        $product->description = $description;
        $product->price = $price;
        $product->user_id = $_SESSION["user"]->id;
        
        if ($this->productManager->create($product)) {
            create_flash_message("success", "Produit ajouté", FLASH_SUCCESS);
            header("location: /profil/products");
        }
    }

    function publishProduct($id) {
        $product = new \stdClass();
        $product->id = $id;
        $product->public = 1;

        if($this->productManager->update($product)) {
            create_flash_message("success", "Produit publié", FLASH_SUCCESS);
            header("Location: /profil/products");
            exit;
        }   
    }

    function unpublishProduct($id) {
        $product = new \stdClass();
        $product->id = $id;
        $product->public = 0;

        if($this->productManager->update($product)) {
            create_flash_message("error", "Produit dépublié", FLASH_ERROR);
            header("Location: /profil/products");
            exit;
        }   
    }


    function rateProduct($id, $rating) {
        $rate = $this->rateProductManager->getProductCurrentRate($id, $_SESSION["user"]->id);

        if ($rate !== false) {
            $rate->rating = $rating;
            if ($this->rateProductManager->update($rate)) {
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

        if ($this->rateProductManager->create($rate)) {
            $this->json([
                "rate" => $rate,
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
