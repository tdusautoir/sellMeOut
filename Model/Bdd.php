<?php
namespace Model;

class Bdd {
    public $connect;
    private static $instance;

    private function __construct()
    {
        $config = json_decode(file_get_contents("config.json"))->database;
        $this->connect = new \PDO("mysql:dbname=" . $config->database . ";host=" . $config->host . "",$config->user,$config->password);
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