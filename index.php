<?php
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
if (count($result) == 1) {
    if(!empty($result[0]->auth)) {
        if(empty($_SESSION["user"])) {
            header("Location: /User/login");
            exit;
        }

        if(!in_array($_SESSION["user"]->role, $result[0]->auth)) {
            header("Location: /error");
            exit;
        }
    }

    // $match are the queries parameters
    preg_match("|^".$result[0]->path. "$|",$_SERVER["REQUEST_URI"],$match);
    unset($match[0]);
    $params = array_merge($_POST, $_GET, $match);
    $controllerName = "\\Controller\\" .$result[0]->controller."Controller";
    $controller = new $controllerName($result[0]);
    $controller->{$result[0]->action}(...$params);
} else {
    echo 'pas de route :(';
}
