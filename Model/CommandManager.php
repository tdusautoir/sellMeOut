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
}