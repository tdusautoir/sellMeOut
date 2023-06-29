<?php
namespace Model;

class RateUserManager extends ModelManager{

    public function __construct()
    {
        parent::__construct("rates_seller");
    }

    // get rate of product according to a user
    public function getUserCurrentRate($seller_id, $user_id) {
        $req = $this->bdd->prepare("SELECT * FROM " . $this->table . " WHERE seller_id = :seller_id AND user_id = :user_id");
        $req->bindParam(":seller_id", $seller_id);
        $req->bindParam(":user_id", $user_id);
        $req->execute();
        $req->setFetchMode(\PDO::FETCH_OBJ);
        return $req->fetch();
    }
}