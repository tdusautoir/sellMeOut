<?php 
namespace Controller;

class ProductController extends Controller {
    protected $productManager;

    function ShowProducts(){
        $products = $this->productManager->getAll();
        $this->compact("products", $products);
        $this->view("products");
    }

    function addProduct($name, $description, $price) {
        $product = new \stdClass();
        $product->name = $name;
        $product->description = $description;
        $product->price = $price;
        if ($this->productManager->create($product)) {
            header("Location: /Product");
        }
    }

    function addProductView() {
        $this->view("addProduct");
    }
}
