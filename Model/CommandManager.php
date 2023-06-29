<?php
namespace Model;

class CommandManager extends ModelManager {
    public function __construct()
    {
        parent::__construct("command");
    }

    public function getByUser($user_id) {
        $req = $this->bdd->prepare("SELECT * FROM " . $this->table . " WHERE user_id = :user_id");
        $req->bindParam(":user_id", $user_id);
        $req->execute();
        $req->setFetchMode(\PDO::FETCH_OBJ);
        return $req->fetchAll();
    }

    public function getCommandsByProductId($product_id) {
        $req = $this->bdd->prepare("SELECT command.id, user.mail, user.id as user_id, command.date, command_details.quantity 
        FROM ". $this->table . " INNER JOIN command_details ON command_details.command_id = ". $this->table .".id 
        INNER JOIN product ON command_details.product_id = product.id INNER JOIN user ON command.user_id = user.id
        WHERE product.id = :product_id;");
        $req->bindParam(":product_id", $product_id);
        $req->execute();
        $req->setFetchMode(\PDO::FETCH_OBJ);
        return $req->fetchAll();
    }
}