<?php
session_start();
ob_start();
require_once 'autoload.php';
require_once 'config/db.php';
require_once 'helpers/utils.php';
require_once 'config/parameters.php';
require_once 'views/layout/header.php';
require_once 'views/user/login.php';
require_once 'views/user/register.php';

//Connection with Database
$db = Database::connect();

function show_error()
{
    $error = new errorController();
    $error->index();
}


// Check if controller is coming in the URL
if (isset($_GET['controller'])) {
    $controller_name = $_GET['controller'] . 'Controller';

    // this elseif below loads the page automatically 
    //without the need to pass product/index
} elseif (!isset($_GET['controller']) && !isset($_GET['action'])) {
    $controller_name = default_controller;
} else {
    show_error();
    exit();
}

// If controller came, check if the class exists
if (class_exists($controller_name)) {
    $controller = new $controller_name;

    // if class exists, check if the action(which is the method inside the class) exists
    if (isset($_GET['action']) && method_exists($controller, $_GET['action'])) {
        $action = $_GET['action'];
        $controller->$action();

        // this elseif below loads the page automatically 
        //without the need to pass product/index
    } elseif (!isset($_GET['controller']) && !isset($_GET['action'])) {
        $default = default_action;
        $controller->$default();
    } else {
        show_error();
    }
} else {
    show_error();
}


require_once 'views/layout/footer.php';
