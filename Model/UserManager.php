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
}