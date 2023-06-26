<?php

namespace Controller;

class Controller {
    protected $route;
    protected $params = [];

    public function __construct($route)
    {
        $this->route = $route;
        $this->loadManager();
    }

    public function loadManager() {
        if(!empty($this->route->manager)) {
            foreach($this->route->manager as $manager) {
                $managerName = $manager . "Manager";
                $managerClass = "\\Model\\" . $managerName;
                $this->{$managerName} = new $managerClass();
            }
        }
    }

    public function view($template) 
    {
        if(file_exists("View/". $this->route->controller ."/css/$template.css")) {
            $headers[] = "<link rel='stylesheet' href='View/". $this->route->controller . "/css/$template.css'>";
        }

        if(file_exists("View/". $this->route->controller ."/scripts/$template.js")) {
            $headers[] = "<script src='View/". $this->route->controller . "/scripts/$template.js' defer></script>";
        }

        ob_start();
        extract($this->params);
        include("View/". $this->route->controller . "/$template.php");
        $content = ob_get_clean();
        include("View/layout.php");
    }

    public function json($data) 
    {
        header("Content-Type: application/json");
        echo json_encode($data);
    }

    public function compact($key, $value) 
    {
        $this->params[$key] = $value;
    }
}