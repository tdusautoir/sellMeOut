<?php
namespace Model;

class CommandDetailManager extends ModelManager {
    public function __construct()
    {
        parent::__construct("command_details");
    }

    public function getProductsByCommandId($command_id) {
        $req = $this->bdd->prepare("SELECT product.id, product.name, product.price, command_details.quantity, product.description FROM ". $this->table . " INNER JOIN product ON product.id = ". $this->table .".product_id WHERE command_id = :command_id;");
        $req->bindParam(":command_id", $command_id);
        $req->execute();
        $req->setFetchMode(\PDO::FETCH_OBJ);
        return $req->fetchAll();
    }
}