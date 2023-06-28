<?php

require "functions.php";

spl_autoload_register(function($class){
    $class = str_replace('\\', '/', $class);
    include_once($class . ".php");
});

session_start();

$json = file_get_contents("route.json");

$routes = json_decode($json);

$result = [];
foreach ($routes as $route) {
    if(preg_match("|^".$route->path. "$|",$_SERVER["REQUEST_URI"]) && $route->method == $_SERVER["REQUEST_METHOD"]){
        array_push($result, $route);
    }
}

// Retrieve the data sent from the client-side by ajax
$ajax_data = json_decode(file_get_contents('php://input'), true);

if (count($result) == 1) {
    if(!empty($result[0]->auth)) {
        if(empty($_SESSION["user"])) {
            if(isset($ajax_data)) {
                header('HTTP/1.0 403 Forbidden');
                echo json_encode(["error" => "Must be logged"]);
                exit;
            }
            
            create_flash_message("error", "Vous devez être connecté", FLASH_ERROR);
            header("Location: /login");
            exit;
        }

        if(!in_array($_SESSION["user"]->role, $result[0]->auth) && $result[0]->auth[0] != "*") {
            create_flash_message("error", "Vous n'avez pas les droits", FLASH_ERROR);
            header("Location: /error");
            exit;
        }
    }

    // $match are the queries parameters
    preg_match("|^".$result[0]->path. "$|",$_SERVER["REQUEST_URI"], $match);
    unset($match[0]);

    $params = array_merge($_POST, $_GET, $match, isset($ajax_data) ? $ajax_data : []);
    $controllerName = "\\Controller\\" .$result[0]->controller."Controller";
    $controller = new $controllerName($result[0]);
    $controller->{$result[0]->action}(...$params);
} else {
    header("Location: /");
    exit;
}
