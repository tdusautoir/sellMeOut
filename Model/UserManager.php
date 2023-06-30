<?php
namespace Model;

class UserManager extends ModelManager{

    public function __construct()
    {
        parent::__construct("user");
    }

    public function getByMail($mail) {
        $req = $this->bdd->prepare("SELECT * FROM " . $this->table . " WHERE mail = :mail");
        $req->bindParam(":mail", $mail);
        $req->execute();
        $req->setFetchMode(\PDO::FETCH_OBJ);
        return $req->fetch();
    }

    public function getByIdWithRatings($seller_id)
    {
        $req =  $this->bdd->prepare("SELECT user.*, AVG(rates_seller.rating) as averageRating FROM ". $this->table ." 
        INNER JOIN rates_seller
            ON rates_seller.seller_id = user.id
        WHERE user.id = :seller_id");
        $req->bindParam(":seller_id", $seller_id);
        $req->execute();
        $req->setFetchMode(\PDO::FETCH_OBJ);
        $user = $req->fetch();
        
        return $user;
    }

    public function getByIdWithUserRating($seller_id, $user_id)
    {
        $req =  $this->bdd->prepare("SELECT user.*, AVG(rates_seller.rating) as rating FROM ". $this->table ." 
        INNER JOIN rates_seller
            ON rates_seller.seller_id = user.id
        WHERE user.id = :seller_id AND rates_seller.user_id = :user_id");
        $req->bindParam(":seller_id", $seller_id);
        $req->bindParam(":user_id", $user_id);
        $req->execute();
        $req->setFetchMode(\PDO::FETCH_OBJ);
        $user = $req->fetch();
        
        return $user;
    }
}