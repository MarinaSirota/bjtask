<?php

/**
 * Class Router
 */
class Router
{
    static function route()
    {

        $controller_name = $_REQUEST["controller"] ? $_REQUEST["controller"] : "site";
        $controller_name = ucfirst($controller_name);

        $action_name = $_REQUEST['action'] ? $_REQUEST['action'] : "index";

        $controller_file = "app/controllers/".$controller_name.'Controller.php';

        if(file_exists($controller_file)){
            include $controller_file;
        }  else{
            die ("Error! File controller $controller_file not found!");
        }

        $controller_class_name = ucfirst($controller_name).'Controller';
        $controller = new $controller_class_name;

        if(method_exists($controller, $action_name)) {
            $controller->$action_name();
        } else {
            die ("Error! Action $action_name of controller $controller_class_name not found!");
        }
    }
}
