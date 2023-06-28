<?php
namespace Model;

class ProductManager extends ModelManager{

    public function __construct()
    {
        parent::__construct("product");
    }

    public function getAllPublic()
    {
        $req = $this->bdd->prepare("SELECT * FROM product 
        WHERE product.public = 1");
        $req->execute();
        $req->setFetchMode(\PDO::FETCH_OBJ);
        return $req->fetchAll();
    }

    public function getBySearch($search)
    {
        $req = $this->bdd->prepare("SELECT * FROM product 
        WHERE product.name LIKE :search AND product.public = 1");
        $req->bindValue(":search", "%" . $search . "%");
        $req->execute();
        $req->setFetchMode(\PDO::FETCH_OBJ);
        return $req->fetchAll();
    }

    public function getByIdWithRatings($product_id)
    {
        $req =  $this->bdd->prepare("SELECT product.*, AVG(rates.rating) as averageRating FROM product 
        INNER JOIN rates
            ON rates.product_id = product.id
        WHERE product.id = :product_id");
        $req->bindParam(":product_id", $product_id);
        $req->execute();
        $req->setFetchMode(\PDO::FETCH_OBJ);
        $product = $req->fetch();
        
        if($product != false){
            $req = $this->bdd->prepare("SELECT AVG(rates.rating) as sellerRating FROM user
            INNER JOIN product
                ON product.user_id = user.id
            INNER JOIN rates
                ON rates.product_id = product.id
            WHERE user.id = :seller_id");
            $req->bindParam(":seller_id", $product->user_id);
            $req->execute();
            $req->setFetchMode(\PDO::FETCH_OBJ);
            $rating = $req->fetch();
            $product->sellerRating = $rating->sellerRating;
        }
        return $product;
    }

    public function getAllBySeller($seller_id)
    {
        $req = $this->bdd->prepare("SELECT * FROM product 
        WHERE product.user_id = :seller_id");
        $req->bindParam(":seller_id", $seller_id);
        $req->execute();
        $req->setFetchMode(\PDO::FETCH_OBJ);
        return $req->fetchAll();
    }
}