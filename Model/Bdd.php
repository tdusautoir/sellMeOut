<?php
namespace Model;

class Bdd {
    public $connect;
    private static $instance;

    private function __construct()
    {
        $this->connect = new \PDO("mysql:dbname=sellmeout;host=localhost","root","root");
    }

    public static function getInstance()
    {
        if (empty(self::$instance))
        {
            self::$instance = new Bdd();
        }
        return self::$instance;
    }
}