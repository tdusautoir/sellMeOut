<?php
namespace Model;

class RateManager extends ModelManager{

    public function __construct()
    {
        parent::__construct("rates");
    }

    // get rate of product according to current user
    public function getCurrentRate($product_id, $user_id) {
        $req = $this->bdd->prepare("SELECT * FROM " . $this->table . " WHERE product_id = :product_id AND user_id = :user_id");
        $req->bindParam(":product_id", $product_id);
        $req->bindParam(":user_id", $user_id);
        $req->execute();
        $req->setFetchMode(\PDO::FETCH_OBJ);
        return $req->fetch();
    }
}