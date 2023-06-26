<?php
namespace Model;

class ModelManager
{
    protected $table;
    public $bdd;
    
    public function __construct($table)
    {
        $this->table = $table;
        $this->bdd = (Bdd::getInstance())->connect;
    }

    public function getAll()
    {
        $req = $this->bdd->prepare("SELECT * FROM " . $this->table);
        $req->execute();
        $req->setFetchMode(\PDO::FETCH_OBJ);
        return $req->fetchAll();
    }

    public function getById($id)
    {
        $req = $this->bdd->prepare("SELECT * FROM " . $this->table . " WHERE id = :id");
        $req->bindParam(":id", $id);
        $req->execute();
        $req->setFetchMode(\PDO::FETCH_OBJ);
        return $req->fetch();
    }

    public function create($obj)
    {
        $sql = "INSERT INTO " . $this->table;
        $properties = array_keys(get_object_vars($obj));
        $sql .= "(" . implode(", ", $properties) . ")";
        foreach ($properties as &$property) {
            $property = ":" . $property;
        }
        $sql .= " VALUE(" . implode(", ", $properties) . ")";

        $req = $this->bdd->prepare($sql);

        $req->execute(get_object_vars($obj));

        return $req->rowCount() == 1;
    }

    public function update($obj)
    {
        //"UPDATE table SET property=value,property2=value2 WHERE id=id"

        $sql = "UPDATE " . $this->table . " SET ";
        $propertiesList = get_object_vars($obj);
        $properties = array();
        if (!empty($propertiesList["id"])) {
            $id = $propertiesList["id"];
            unset($propertiesList["id"]);
            foreach ($propertiesList as $property => $value) {
                $properties[] = $property . " = :" . $property;
            }
            $sql .= implode(", ", $properties);
            $sql .= " WHERE id= :id";

            echo $sql;
            $req = $this->bdd->prepare($sql);

            $req->execute(get_object_vars($obj));

            return $req->rowCount() == 1;
        }
        else
        {
            throw new \Exception("id introuvable");
        }
    }
    
    public function delete($id)
    {
        $req = $this->bdd->prepare("DELETE FROM " . $this->table . " WHERE id= :id");
        $req->execute(array("id" => $id));
        return $req->rowCount() == 1;
    }
}
