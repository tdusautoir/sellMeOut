<?php 
namespace Controller;

class ProductController extends Controller {
    protected $productManager;

    function ShowProducts(){
        $products = $this->productManager->getAll();
        $this->compact(["products" => $products]);
        $this->view("products");
    }

    function showProduct($id) {
        $product = $this->productManager->getById($id);
        $this->compact(["product" => $product]);
        $this->view("product");
    }

    function addProduct($name, $description, $price) {
        $product = new \stdClass();
        $product->name = $name;
        $product->description = $description;
        $product->price = $price;
        if ($this->productManager->create($product)) {
            $this->compact([
                "success" => "Produit ajouté !"
            ]);

            $this->addProductView();
        }
    }

    function addProductView() {
        $this->view("addProduct");
    }
}
